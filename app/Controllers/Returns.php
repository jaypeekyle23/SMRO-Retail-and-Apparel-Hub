<?php

namespace App\Controllers;

use App\Models\ReturnModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\ProductVariantModel;
use App\Models\ProductModel;
use App\Models\StockLogModel;

class Returns extends BaseController
{
    public function index()
    {
        $returnModel = new ReturnModel();

        $returns = $returnModel
            ->select('returns.*, orders.order_number, products.name as product_name, product_variants.sku, product_variants.size, product_variants.color')
            ->join('orders', 'orders.id = returns.order_id', 'left')
            ->join('products', 'products.id = returns.product_id', 'left')
            ->join('product_variants', 'product_variants.id = returns.variant_id', 'left')
            ->orderBy('returns.created_at', 'DESC')
            ->findAll();

        $data = array_merge($this->data ?? [], [
            'title'   => 'Returns & Refunds',
            'returns' => $returns
        ]);

        return view('pages/returns/index', $data);
    }

    public function create($orderId)
    {
        $orderModel     = new OrderModel();
        $orderItemModel = new OrderItemModel();

        $order = $orderModel->find($orderId);

        if (!$order) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $items = $orderItemModel
            ->select('order_items.*, products.name as product_name, product_variants.sku, product_variants.size, product_variants.color')
            ->join('products', 'products.id = order_items.product_id', 'left')
            ->join('product_variants', 'product_variants.id = order_items.variant_id', 'left')
            ->where('order_id', $orderId)
            ->findAll();

        $data = array_merge($this->data ?? [], [
            'title' => 'Create Return — ' . $order['order_number'],
            'order' => $order,
            'items' => $items
        ]);

        return view('pages/returns/create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'order_id'   => 'required',
            'variant_id' => 'required',
            'product_id' => 'required',
            'quantity'   => 'required|integer|greater_than[0]',
            'reason'     => 'required'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $orderItemModel = new OrderItemModel();
        $returnModel    = new ReturnModel();

        // Get the original order item to calculate refund
        $orderItem = $orderItemModel
            ->where('order_id', $this->request->getPost('order_id'))
            ->where('variant_id', $this->request->getPost('variant_id'))
            ->first();

        $refundAmount = $orderItem ? ($orderItem['price'] * $this->request->getPost('quantity')) : 0;

        $returnModel->insert([
            'order_id'      => $this->request->getPost('order_id'),
            'variant_id'    => $this->request->getPost('variant_id'),
            'product_id'    => $this->request->getPost('product_id'),
            'quantity'      => $this->request->getPost('quantity'),
            'reason'        => $this->request->getPost('reason'),
            'refund_amount' => $refundAmount,
            'status'        => 'pending'
        ]);

        return redirect()->to('returns')->with('success', 'Return request submitted successfully!');
    }

    public function approve($id)
    {
        $returnModel    = new ReturnModel();
        $variantModel   = new ProductVariantModel();
        $productModel   = new ProductModel();
        $stockLogModel  = new StockLogModel();

        $return = $returnModel->find($id);

        if (!$return || $return['status'] !== 'pending') {
            return redirect()->to('returns')->with('error', 'This return cannot be approved.');
        }

        // Add stock back
        $variant  = $variantModel->find($return['variant_id']);
        $newStock = $variant['stock_quantity'] + $return['quantity'];
        $variantModel->update($return['variant_id'], ['stock_quantity' => $newStock]);

        // Log stock movement
        $stockLogModel->insert([
            'product_id'    => $return['product_id'],
            'variant_id'    => $return['variant_id'],
            'movement_type' => 'in',
            'quantity'      => $return['quantity'],
            'remarks'       => 'Return approved — refund ₱' . number_format($return['refund_amount'], 2)
        ]);

        // Recalculate product total stock
        $allVariants = $variantModel->where('product_id', $return['product_id'])->findAll();
        $totalStock  = 0;
        foreach ($allVariants as $v) {
            $totalStock += (int)$v['stock_quantity'];
        }
        $productModel->update($return['product_id'], ['total_stock' => $totalStock]);

        // Update return status
        $returnModel->update($id, ['status' => 'approved']);

        return redirect()->to('returns')->with('success', 'Return approved! Stock has been restocked.');
    }

    public function reject($id)
    {
        $returnModel = new ReturnModel();
        $return      = $returnModel->find($id);

        if (!$return || $return['status'] !== 'pending') {
            return redirect()->to('returns')->with('error', 'This return cannot be rejected.');
        }

        $returnModel->update($id, ['status' => 'rejected']);

        return redirect()->to('returns')->with('success', 'Return rejected.');
    }
}