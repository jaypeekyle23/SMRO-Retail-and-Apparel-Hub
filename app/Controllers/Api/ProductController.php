<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ProductModel;
use App\Models\ProductVariantModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\StockLogModel;

class ProductController extends ResourceController
{
    protected $format = 'json';

    // GET /api/products
    public function index()
    {
        $productModel = new ProductModel();
        $variantModel = new ProductVariantModel();

        $products = $productModel->findAll();

        if (empty($products)) {
            return $this->failNotFound('No products found in the inventory.');
        }

        foreach ($products as &$product) {
            $product['variants'] = $variantModel
                ->where('product_id', $product['id'])
                ->findAll();
        }

        return $this->respond([
            'status'  => 200,
            'message' => 'Products retrieved successfully.',
            'data'    => $products
        ], 200);
    }

    // GET /api/products/{id}
    public function show($id = null)
    {
        $productModel = new ProductModel();
        $variantModel = new ProductVariantModel();

        $product = $productModel->find($id);

        if (!$product) {
            return $this->failNotFound('Product with ID ' . $id . ' not found.');
        }

        $product['variants'] = $variantModel
            ->where('product_id', $id)
            ->findAll();

        return $this->respond([
            'status'  => 200,
            'message' => 'Product retrieved successfully.',
            'data'    => $product
        ], 200);
    }

    // GET /api/inventory
    public function inventory()
    {
        $logModel = new StockLogModel();

        $logs = $logModel
            ->select('stock_logs.*, products.name as product_name, product_variants.sku, product_variants.size, product_variants.color')
            ->join('products', 'products.id = stock_logs.product_id', 'left')
            ->join('product_variants', 'product_variants.id = stock_logs.variant_id', 'left')
            ->orderBy('stock_logs.created_at', 'DESC')
            ->limit(50)
            ->findAll();

        return $this->respond([
            'status'  => 200,
            'message' => 'Inventory logs retrieved successfully.',
            'data'    => $logs
        ], 200);
    }

    // GET /api/sales
    public function sales()
    {
        $orderModel     = new OrderModel();
        $orderItemModel = new OrderItemModel();

        $orders = $orderModel
            ->orderBy('created_at', 'DESC')
            ->limit(50)
            ->findAll();

        foreach ($orders as &$order) {
            $order['items'] = $orderItemModel
                ->select('order_items.*, products.name as product_name, product_variants.sku, product_variants.size, product_variants.color')
                ->join('products', 'products.id = order_items.product_id', 'left')
                ->join('product_variants', 'product_variants.id = order_items.variant_id', 'left')
                ->where('order_id', $order['id'])
                ->findAll();
        }

        return $this->respond([
            'status'  => 200,
            'message' => 'Sales retrieved successfully.',
            'data'    => $orders
        ], 200);
    }
}