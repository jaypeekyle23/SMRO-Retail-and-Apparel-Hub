<?php

namespace App\Controllers;

use App\Models\PurchaseOrderModel;
use App\Models\PurchaseOrderItemModel;
use App\Models\SupplierModel;
use App\Models\ProductVariantModel;
use App\Models\ProductModel;
use App\Models\StockLogModel;

class PurchaseOrders extends BaseController
{
    public function index()
    {
        $poModel       = new PurchaseOrderModel();
        $supplierModel = new SupplierModel();

        $search  = $this->request->getGet('search') ?? '';
        $perPage = 10;

        $builder = $poModel->select('purchase_orders.*, suppliers.name as supplier_name')
                           ->join('suppliers', 'suppliers.id = purchase_orders.supplier_id', 'left')
                           ->orderBy('purchase_orders.created_at', 'DESC');

        if ($search) {
            $builder->like('po_number', $search)
                    ->orLike('suppliers.name', $search);
        }

        $purchaseOrders = $builder->paginate($perPage, 'default');

        $data = array_merge($this->data ?? [], [
            'title'          => 'Purchase Orders',
            'purchaseOrders' => $purchaseOrders,
            'pager'          => $poModel->pager,
            'search'         => $search
        ]);

        return view('pages/purchase_orders/index', $data);
    }

    public function create()
    {
        $supplierModel = new SupplierModel();
        $variantModel  = new ProductVariantModel();

        $suppliers = $supplierModel->findAll();
        $variants  = $variantModel->select('product_variants.*, products.name as product_name, products.cost_price')
                                  ->join('products', 'products.id = product_variants.product_id', 'inner')
                                  ->orderBy('products.name', 'ASC')
                                  ->findAll();

        $data = array_merge($this->data ?? [], [
            'title'     => 'Create Purchase Order',
            'suppliers' => $suppliers,
            'variants'  => $variants
        ]);

        return view('pages/purchase_orders/create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'supplier_id' => 'required',
            'variants'    => 'required'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $poModel     = new PurchaseOrderModel();
        $poItemModel = new PurchaseOrderItemModel();

        $poNumber = 'PO-' . strtoupper(uniqid());

        $poId = $poModel->insert([
            'supplier_id' => $this->request->getPost('supplier_id'),
            'po_number'   => $poNumber,
            'status'      => 'pending',
            'notes'       => $this->request->getPost('notes'),
        ], true);

        $variants = $this->request->getPost('variants');
        foreach ($variants as $variant) {
            if (!empty($variant['variant_id']) && (int)$variant['quantity'] > 0) {
                $poItemModel->insert([
                    'purchase_order_id' => $poId,
                    'variant_id'        => $variant['variant_id'],
                    'product_id'        => $variant['product_id'],
                    'quantity'          => $variant['quantity'],
                    'cost_price'        => $variant['cost_price'],
                ]);
            }
        }

        return redirect()->to('purchase-orders')->with('success', 'Purchase Order ' . $poNumber . ' created successfully!');
    }

    public function show($id)
    {
        $poModel       = new PurchaseOrderModel();
        $poItemModel   = new PurchaseOrderItemModel();
        $supplierModel = new SupplierModel();

        $po = $poModel->find($id);

        if (!$po) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $supplier = $supplierModel->find($po['supplier_id']);

        $items = $poItemModel->select('purchase_order_items.*, products.name as product_name, product_variants.sku, product_variants.size, product_variants.color')
                             ->join('products', 'products.id = purchase_order_items.product_id', 'left')
                             ->join('product_variants', 'product_variants.id = purchase_order_items.variant_id', 'left')
                             ->where('purchase_order_id', $id)
                             ->findAll();

        $data = array_merge($this->data ?? [], [
            'title'    => 'Purchase Order — ' . $po['po_number'],
            'po'       => $po,
            'supplier' => $supplier,
            'items'    => $items
        ]);

        return view('pages/purchase_orders/show', $data);
    }

    public function receive($id)
    {
        $poModel       = new PurchaseOrderModel();
        $poItemModel   = new PurchaseOrderItemModel();
        $variantModel  = new ProductVariantModel();
        $productModel  = new ProductModel();
        $stockLogModel = new StockLogModel();

        $po = $poModel->find($id);

        if (!$po || $po['status'] !== 'pending') {
            return redirect()->to('purchase-orders')->with('error', 'This order cannot be received.');
        }

        $items = $poItemModel->where('purchase_order_id', $id)->findAll();

        foreach ($items as $item) {
            $variant = $variantModel->find($item['variant_id']);

            if ($variant) {
                $newStock = $variant['stock_quantity'] + $item['quantity'];
                $variantModel->update($item['variant_id'], ['stock_quantity' => $newStock]);

                $stockLogModel->insert([
                    'product_id'    => $item['product_id'],
                    'variant_id'    => $item['variant_id'],
                    'movement_type' => 'in',
                    'quantity'      => $item['quantity'],
                    'remarks'       => 'Purchase Order received (' . $po['po_number'] . ')'
                ]);

                // Recalculate total stock for the product
                $allVariants = $variantModel->where('product_id', $item['product_id'])->findAll();
                $totalStock  = 0;
                foreach ($allVariants as $v) {
                    $totalStock += (int)$v['stock_quantity'];
                }
                $productModel->update($item['product_id'], ['total_stock' => $totalStock]);
            }
        }

        $poModel->update($id, ['status' => 'received']);

        return redirect()->to('purchase-orders/' . $id)->with('success', 'Purchase Order received! Stock has been updated.');
    }

    public function cancel($id)
    {
        $poModel = new PurchaseOrderModel();
        $po      = $poModel->find($id);

        if (!$po || $po['status'] !== 'pending') {
            return redirect()->to('purchase-orders')->with('error', 'This order cannot be cancelled.');
        }

        $poModel->update($id, ['status' => 'cancelled']);

        return redirect()->to('purchase-orders/' . $id)->with('success', 'Purchase Order cancelled.');
    }
}