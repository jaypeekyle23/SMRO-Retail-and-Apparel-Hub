<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductVariantModel;
use App\Models\StockLogModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;

class Home extends BaseController
{
    public function index()
    {
        $this->cachePage(60); // Cache for 60 seconds

        // Redirect User role (4) to their own dashboard
        if (session()->get('role_id') == 4) {
            $email         = session()->get('email');
            $customerModel = new \App\Models\CustomerModel();
            $customer      = $customerModel->where('email', $email)->first();

            $orderModel     = new OrderModel();
            $orderItemModel = new OrderItemModel();

            $recentOrders = [];
            $totalOrders  = 0;
            $totalSpent   = 0;

            if ($customer) {
                $recentOrders = $orderModel
                    ->where('customer_id', $customer['id'])
                    ->orderBy('created_at', 'DESC')
                    ->limit(5)
                    ->findAll();

                foreach ($recentOrders as &$order) {
                    $order['items'] = $orderItemModel
                        ->where('order_id', $order['id'])
                        ->findAll();
                }

                $totalOrders = $orderModel
                    ->where('customer_id', $customer['id'])
                    ->countAllResults();

                $totalSpent = $orderModel
                    ->selectSum('total_amount')
                    ->where('customer_id', $customer['id'])
                    ->first()['total_amount'] ?? 0;
            }

            $data = array_merge($this->data, [
                'title'        => 'Dashboard',
                'recentOrders' => $recentOrders,
                'totalOrders'  => $totalOrders,
                'totalSpent'   => $totalSpent,
            ]);

            return view('pages/user_portal/dashboard', $data);
        }

        $productModel   = new ProductModel();
        $variantModel   = new ProductVariantModel();
        $logModel       = new StockLogModel();
        $orderModel     = new OrderModel();
        $orderItemModel = new OrderItemModel();

        // 1. Get Total Products
        $totalProducts = $productModel->countAllResults();

        // 2. Get Total Stock across all variants
        $totalStockQuery = $variantModel->selectSum('stock_quantity')->first();
        $totalStock = $totalStockQuery['stock_quantity'] ?? 0;

        // 3. Get Low Stock Alerts
        $lowStockItems = $variantModel
            ->select('product_variants.*, products.name as product_name')
            ->join('products', 'products.id = product_variants.product_id', 'left')
            ->where('stock_quantity <=', 5)
            ->orderBy('stock_quantity', 'ASC')
            ->findAll();

        // 4. Get Recent Activity (Last 5 stock movements)
        $recentActivity = $logModel
            ->select('stock_logs.*, products.name as product_name, product_variants.size, product_variants.color')
            ->join('products', 'products.id = stock_logs.product_id', 'left')
            ->join('product_variants', 'product_variants.id = stock_logs.variant_id', 'left')
            ->orderBy('stock_logs.created_at', 'DESC')
            ->limit(5)
            ->findAll();

        // 5. Daily Sales for the last 7 days (Query Builder)
        $sevenDaysAgo = date('Y-m-d', strtotime('-7 days'));

        $dailySalesRaw = $orderModel
            ->select('DATE(created_at) as sale_date, SUM(total_amount) as total')
            ->where('DATE(created_at) >=', $sevenDaysAgo)
            ->groupBy('DATE(created_at)')
            ->orderBy('sale_date', 'ASC')
            ->findAll();

        $salesLabels = [];
        $salesData   = [];
        foreach ($dailySalesRaw as $row) {
            $salesLabels[] = date('M d', strtotime($row['sale_date']));
            $salesData[]   = (float) $row['total'];
        }

        // 6. Top 5 Selling Products (Query Builder)
        $topProducts = $orderItemModel
            ->select('products.name, SUM(order_items.quantity) as total_sold')
            ->join('products', 'products.id = order_items.product_id', 'inner')
            ->groupBy('order_items.product_id')
            ->orderBy('total_sold', 'DESC')
            ->limit(5)
            ->findAll();

        $topProductLabels = [];
        $topProductData   = [];
        foreach ($topProducts as $row) {
            $topProductLabels[] = $row['name'];
            $topProductData[]   = (int) $row['total_sold'];
        }

        $data = array_merge($this->data, [
            'title'             => 'Dashboard',
            'totalProducts'     => $totalProducts,
            'totalStock'        => $totalStock,
            'lowStockItems'     => $lowStockItems,
            'recentActivity'    => $recentActivity,
            'salesLabels'       => json_encode($salesLabels),
            'salesData'         => json_encode($salesData),
            'topProductLabels'  => json_encode($topProductLabels),
            'topProductData'    => json_encode($topProductData),
        ]);

        return view('pages/dashboard/index', $data);
    }
}