<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductVariantModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\CustomerModel;
use App\Models\StockLogModel;

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
                ->where('stock_quantity >', 0)
                ->findAll();
        }

        $data = array_merge($this->data, [
            'title'    => 'Shop',
            'products' => $products,
            'pager'    => $productModel->pager,
            'search'   => $search,
            'cart'     => session()->get('cart') ?? []
        ]);

        return view('pages/user_portal/shop', $data);
    }

    public function addToCart()
    {
        $variantId = $this->request->getPost('variant_id');
        $quantity  = (int) $this->request->getPost('quantity');

        if (!$variantId || $quantity < 1) {
            return redirect()->to('shop')->with('error', 'Invalid item selection.');
        }

        $variantModel = new ProductVariantModel();
        $variant      = $variantModel
            ->select('product_variants.*, products.name as product_name, products.selling_price, products.base_image')
            ->join('products', 'products.id = product_variants.product_id', 'inner')
            ->where('product_variants.id', $variantId)
            ->first();

        if (!$variant || $variant['stock_quantity'] < $quantity) {
            return redirect()->to('shop')->with('error', 'Insufficient stock.');
        }

        $cart = session()->get('cart') ?? [];

        if (isset($cart[$variantId])) {
            $cart[$variantId]['quantity'] += $quantity;
        } else {
            $cart[$variantId] = [
                'variant_id'   => $variantId,
                'product_id'   => $variant['product_id'],
                'product_name' => $variant['product_name'],
                'sku'          => $variant['sku'],
                'size'         => $variant['size'],
                'color'        => $variant['color'],
                'price'        => $variant['selling_price'],
                'quantity'     => $quantity,
                'base_image'   => $variant['base_image'],
            ];
        }

        session()->set('cart', $cart);

        return redirect()->to('shop')->with('success', $variant['product_name'] . ' added to cart!');
    }

    public function removeFromCart()
    {
        $variantId = $this->request->getPost('variant_id');
        $cart      = session()->get('cart') ?? [];

        if (isset($cart[$variantId])) {
            unset($cart[$variantId]);
            session()->set('cart', $cart);
        }

        return redirect()->to('checkout')->with('success', 'Item removed from cart.');
    }

    public function clearCart()
    {
        session()->remove('cart');
        return redirect()->to('shop')->with('success', 'Cart cleared.');
    }

    public function checkout()
    {
        $cart         = session()->get('cart') ?? [];
        $variantModel = new ProductVariantModel();

        $total = 0;
        foreach ($cart as &$item) {
            $total += $item['price'] * $item['quantity'];

            // Fetch all variants for this product so user can switch
            $item['all_variants'] = $variantModel
                ->where('product_id', $item['product_id'])
                ->where('stock_quantity >', 0)
                ->findAll();
        }

        $data = array_merge($this->data, [
            'title' => 'Cart',
            'cart'  => $cart,
            'total' => $total
        ]);

        return view('pages/user_portal/checkout', $data);
    }

    public function placeOrder()
    {
        $cart = session()->get('cart') ?? [];

        if (empty($cart)) {
            return redirect()->to('shop')->with('error', 'Your cart is empty.');
        }

        $email         = session()->get('email');
        $customerModel = new CustomerModel();
        $customer      = $customerModel->where('email', $email)->first();

        if (!$customer) {
            return redirect()->to('shop')->with('error', 'Customer record not found.');
        }

        $variantModel   = new ProductVariantModel();
        $orderModel     = new OrderModel();
        $orderItemModel = new OrderItemModel();
        $stockLogModel  = new StockLogModel();

        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        $db = \Config\Database::connect();
        $db->transStart();

        $orderNumber = 'ORD-' . strtoupper(uniqid());

        $orderId = $orderModel->insert([
            'customer_id'  => $customer['id'],
            'order_number' => $orderNumber,
            'total_amount' => $totalAmount
        ], true);

        foreach ($cart as $item) {
            $variantId    = $item['variant_id'];
            $quantitySold = $item['quantity'];
            $price        = $item['price'];

            $variant = $variantModel->find($variantId);

            if ($variant) {
                $orderItemModel->insert([
                    'order_id'   => $orderId,
                    'product_id' => $item['product_id'],
                    'variant_id' => $variantId,
                    'quantity'   => $quantitySold,
                    'price'      => $price
                ]);

                $newStock = $variant['stock_quantity'] - $quantitySold;
                $newStock = ($newStock < 0) ? 0 : $newStock;

                $variantModel->update($variantId, ['stock_quantity' => $newStock]);

                $stockLogModel->insert([
                    'product_id'    => $item['product_id'],
                    'variant_id'    => $variantId,
                    'movement_type' => 'out',
                    'quantity'      => $quantitySold,
                    'remarks'       => 'Online order (' . $orderNumber . ')'
                ]);
            }
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->to('checkout')->with('error', 'Something went wrong. Please try again.');
        }

        session()->remove('cart');

        return redirect()->to('order-confirmed/' . $orderId);
    }

    public function orderConfirmed($orderId)
    {
        $orderModel     = new OrderModel();
        $orderItemModel = new OrderItemModel();

        $order = $orderModel->find($orderId);

        if (!$order) {
            return redirect()->to('shop');
        }

        $order['items'] = $orderItemModel
            ->select('order_items.*, products.name as product_name, product_variants.sku, product_variants.size, product_variants.color')
            ->join('products', 'products.id = order_items.product_id', 'left')
            ->join('product_variants', 'product_variants.id = order_items.variant_id', 'left')
            ->where('order_id', $orderId)
            ->findAll();

        $data = array_merge($this->data, [
            'title' => 'Order Confirmed',
            'order' => $order
        ]);

        return view('pages/user_portal/order_confirmed', $data);
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
            $db             = \Config\Database::connect();

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

                // Fetch any return requests for this order
                $order['returns'] = $db->table('returns')
                    ->where('order_id', $order['id'])
                    ->orderBy('created_at', 'DESC')
                    ->get()
                    ->getResultArray();
            }
        }

        $data = array_merge($this->data, [
            'title'  => 'My Orders',
            'orders' => $orders
        ]);

        return view('pages/user_portal/my_orders', $data);
    }

    public function submitReturn()
    {
        $orderId   = $this->request->getPost('order_id');
        $variantId = $this->request->getPost('variant_id');
        $quantity  = (int) $this->request->getPost('quantity');
        $reason    = htmlspecialchars($this->request->getPost('reason', FILTER_UNSAFE_RAW));

        if (!$orderId || !$variantId || $quantity < 1 || empty($reason)) {
            return redirect()->to('my-orders')->with('error', 'Please fill in all required fields.');
        }

        // Verify the order belongs to the logged-in user
        $email         = session()->get('email');
        $customerModel = new CustomerModel();
        $customer      = $customerModel->where('email', $email)->first();

        if (!$customer) {
            return redirect()->to('my-orders')->with('error', 'Customer record not found.');
        }

        $orderModel = new OrderModel();
        $order      = $orderModel
            ->where('id', $orderId)
            ->where('customer_id', $customer['id'])
            ->first();

        if (!$order) {
            return redirect()->to('my-orders')->with('error', 'Order not found.');
        }

        // Get the specific order item to calculate refund amount and get product_id
        $orderItemModel = new OrderItemModel();
        $orderItem      = $orderItemModel
            ->where('order_id', $orderId)
            ->where('variant_id', $variantId)
            ->first();

        if (!$orderItem) {
            return redirect()->to('my-orders')->with('error', 'Order item not found.');
        }

        $refundAmount = $orderItem['price'] * $quantity;

        $db = \Config\Database::connect();
        $db->table('returns')->insert([
            'order_id'      => $orderId,
            'variant_id'    => $variantId,
            'product_id'    => $orderItem['product_id'],
            'quantity'      => $quantity,
            'reason'        => $reason,
            'refund_amount' => $refundAmount,
            'status'        => 'pending',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('my-orders')->with('success', 'Your return/refund request has been submitted. Our team will review it shortly.');
    }

    public function updateCart()
    {
        $variantId    = $this->request->getPost('variant_id');
        $newVariantId = $this->request->getPost('new_variant_id');
        $quantity     = (int) $this->request->getPost('quantity');

        if (!$variantId || $quantity < 1) {
            return redirect()->to('checkout')->with('error', 'Invalid update.');
        }

        $cart         = session()->get('cart') ?? [];
        $variantModel = new ProductVariantModel();

        // If variant changed, validate new variant and replace
        if ($newVariantId && $newVariantId != $variantId) {
            $newVariant = $variantModel
                ->select('product_variants.*, products.name as product_name, products.selling_price, products.base_image')
                ->join('products', 'products.id = product_variants.product_id', 'inner')
                ->where('product_variants.id', $newVariantId)
                ->first();

            if (!$newVariant) {
                return redirect()->to('checkout')->with('error', 'Selected variant not found.');
            }

            if ($newVariant['stock_quantity'] < $quantity) {
                return redirect()->to('checkout')->with('error', 'Insufficient stock for selected variant.');
            }

            // Remove old variant from cart
            unset($cart[$variantId]);

            // Add new variant (merge if already in cart)
            if (isset($cart[$newVariantId])) {
                $cart[$newVariantId]['quantity'] += $quantity;
            } else {
                $cart[$newVariantId] = [
                    'variant_id'   => $newVariantId,
                    'product_id'   => $newVariant['product_id'],
                    'product_name' => $newVariant['product_name'],
                    'sku'          => $newVariant['sku'],
                    'size'         => $newVariant['size'],
                    'color'        => $newVariant['color'],
                    'price'        => $newVariant['selling_price'],
                    'quantity'     => $quantity,
                    'base_image'   => $newVariant['base_image'],
                ];
            }
        } else {
            // Just update quantity
            $variant = $variantModel->find($variantId);

            if (!$variant || $variant['stock_quantity'] < $quantity) {
                return redirect()->to('checkout')->with('error', 'Insufficient stock.');
            }

            if (isset($cart[$variantId])) {
                $cart[$variantId]['quantity'] = $quantity;
            }
        }

        session()->set('cart', $cart);

        return redirect()->to('checkout')->with('success', 'Cart updated.');
    }
}