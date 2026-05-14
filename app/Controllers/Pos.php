<?php

namespace App\Controllers;

use App\Models\ProductVariantModel;
use App\Models\StockLogModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\CustomerModel;

class Pos extends BaseController
{
    public function index()
    {
        $variantModel = new ProductVariantModel();

        $availableItems = $variantModel->select('product_variants.*, products.name as product_name, products.selling_price')
                                       ->join('products', 'products.id = product_variants.product_id', 'inner')
                                       ->where('stock_quantity >', 0)
                                       ->findAll();

        $data = array_merge($this->data, [
            'title'          => 'Point of Sale (POS)',
            'availableItems' => $availableItems
        ]);

        return view('pages/pos/index', $data);
    }

    public function checkout()
    {
        $cartData = $this->request->getPost('cart_data');

        if (empty($cartData)) {
            return redirect()->back()->with('error', 'The cart is empty. Cannot complete sale.');
        }

        $cartItems = json_decode($cartData, true);

        $variantModel   = new ProductVariantModel();
        $stockLogModel  = new StockLogModel();
        $orderModel     = new OrderModel();
        $orderItemModel = new OrderItemModel();
        $customerModel  = new CustomerModel();

        // Handle customer
        $customerName  = trim($this->request->getPost('customer_name'));
        $customerPhone = trim($this->request->getPost('customer_phone'));
        $customerEmail = trim($this->request->getPost('customer_email'));

        $customerId = null;

        if (!empty($customerName)) {
            // Check if customer already exists by phone or email
            $existingCustomer = null;

            if (!empty($customerPhone)) {
                $existingCustomer = $customerModel->where('phone', $customerPhone)->first();
            }

            if (!$existingCustomer && !empty($customerEmail)) {
                $existingCustomer = $customerModel->where('email', $customerEmail)->first();
            }

            if ($existingCustomer) {
                $customerId = $existingCustomer['id'];
            } else {
                $customerId = $customerModel->insert([
                    'name'  => $customerName,
                    'phone' => $customerPhone ?: null,
                    'email' => $customerEmail ?: null,
                ], true);
            }
        }

        // Calculate total
        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += ($item['price'] * $item['quantity']);
        }

        $db = \Config\Database::connect();
        $db->transStart();

        $orderNumber = 'ORD-' . strtoupper(uniqid());

        $orderId = $orderModel->insert([
            'customer_id'  => $customerId,
            'order_number' => $orderNumber,
            'total_amount' => $totalAmount
        ], true);

        foreach ($cartItems as $item) {
            $variantId    = $item['id'];
            $quantitySold = $item['quantity'];
            $price        = $item['price'];

            $variant = $variantModel->find($variantId);

            if ($variant) {
                $orderItemModel->insert([
                    'order_id'   => $orderId,
                    'product_id' => $variant['product_id'],
                    'variant_id' => $variantId,
                    'quantity'   => $quantitySold,
                    'price'      => $price
                ]);

                $newStock = $variant['stock_quantity'] - $quantitySold;
                $newStock = ($newStock < 0) ? 0 : $newStock;

                $variantModel->update($variantId, ['stock_quantity' => $newStock]);

                $stockLogModel->insert([
                    'product_id'    => $variant['product_id'],
                    'variant_id'    => $variantId,
                    'movement_type' => 'OUT',
                    'quantity'      => $quantitySold,
                    'remarks'       => 'POS Sale (' . $orderNumber . ')'
                ]);
            }
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->to('/pos')->with('error', 'Something went wrong while processing the sale.');
        }

        return redirect()->to('sales/' . $orderId);
    }
}