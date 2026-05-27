<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductVariantModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\CustomerModel;

class UserPortal extends BaseController
{
    public function shop()
    {
        $productModel = new ProductModel();

        $search  = $this->request->getGet('search') ?? '';
        $perPage = 12;

        if ($search) {
            $products = $productModel
                ->where('status', 'Active')
                ->like('name', $search)
                ->orLike('category', $search)
                ->paginate($perPage, 'default');
        } else {
            $products = $productModel
                ->where('status', 'Active')
                ->paginate($perPage, 'default');
        }

        $variantModel = new ProductVariantModel();
        foreach ($products as &$product) {
            $product['variants'] = $variantModel
                ->where('product_id', $product['id'])
                ->findAll();
        }

        $data = array_merge($this->data, [
            'title'    => 'Shop',
            'products' => $products,
            'pager'    => $productModel->pager,
            'search'   => $search
        ]);

        return view('pages/user_portal/shop', $data);
    }

    public function myOrders()
    {
        $email         = session()->get('email');
        $customerModel = new CustomerModel();
        $customer      = $customerModel->where('email', $email)->first();

        $orders = [];

        if ($customer) {
            $orderModel     = new OrderModel();
            $orderItemModel = new OrderItemModel();

            $orders = $orderModel
                ->where('customer_id', $customer['id'])
                ->orderBy('created_at', 'DESC')
                ->findAll();

            foreach ($orders as &$order) {
                $order['items'] = $orderItemModel
                    ->select('order_items.*, products.name as product_name, product_variants.sku, product_variants.size, product_variants.color')
                    ->join('products', 'products.id = order_items.product_id', 'left')
                    ->join('product_variants', 'product_variants.id = order_items.variant_id', 'left')
                    ->where('order_id', $order['id'])
                    ->findAll();
            }
        }

        $data = array_merge($this->data, [
            'title'  => 'My Orders',
            'orders' => $orders
        ]);

        return view('pages/user_portal/my_orders', $data);
    }
}