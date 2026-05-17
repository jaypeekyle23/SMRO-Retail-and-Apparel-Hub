<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\OrderItemModel;

class Sales extends BaseController
{
    public function index()
    {
        $orderModel     = new OrderModel();
        $orderItemModel = new OrderItemModel();

        $dateFrom = $this->request->getGet('date_from') ?? date('Y-m-01');
        $dateTo   = $this->request->getGet('date_to')   ?? date('Y-m-d');
        $search   = $this->request->getGet('search')    ?? '';
        $perPage  = 10;

        $builder = $orderModel
            ->select('orders.*, customers.name as customer_name')
            ->join('customers', 'customers.id = orders.customer_id', 'left')
            ->where('DATE(orders.created_at) >=', $dateFrom)
            ->where('DATE(orders.created_at) <=', $dateTo);

        if ($search) {
            $builder->groupStart()
                    ->like('order_number', $search)
                    ->orLike('customers.name', $search)
                    ->groupEnd();
        }

        $orders       = $builder->orderBy('orders.created_at', 'DESC')->paginate($perPage, 'default');
        $totalRevenue = $orderModel
            ->where('DATE(created_at) >=', $dateFrom)
            ->where('DATE(created_at) <=', $dateTo)
            ->selectSum('total_amount')
            ->first()['total_amount'] ?? 0;

        // Top selling products using Query Builder
        $topProducts = $orderItemModel
            ->select('products.name, SUM(order_items.quantity) as total_sold, SUM(order_items.quantity * order_items.price) as revenue')
            ->join('orders', 'orders.id = order_items.order_id', 'inner')
            ->join('products', 'products.id = order_items.product_id', 'inner')
            ->where('DATE(orders.created_at) >=', $dateFrom)
            ->where('DATE(orders.created_at) <=', $dateTo)
            ->groupBy('order_items.product_id')
            ->orderBy('total_sold', 'DESC')
            ->limit(5)
            ->findAll();

        $data = array_merge($this->data ?? [], [
            'title'        => 'Sales Reports',
            'orders'       => $orders,
            'totalRevenue' => $totalRevenue,
            'topProducts'  => $topProducts,
            'dateFrom'     => $dateFrom,
            'dateTo'       => $dateTo,
            'search'       => $search,
            'pager'        => $orderModel->pager,
        ]);

        return view('pages/sales/index', $data);
    }

    public function show($id)
    {
        $orderModel     = new OrderModel();
        $orderItemModel = new OrderItemModel();

        $order = $orderModel
            ->select('orders.*, customers.name as customer_name, customers.phone as customer_phone')
            ->join('customers', 'customers.id = orders.customer_id', 'left')
            ->find($id);

        if (!$order) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $items = $orderItemModel
            ->select('order_items.*, products.name as product_name, product_variants.sku, product_variants.size, product_variants.color')
            ->join('products', 'products.id = order_items.product_id', 'left')
            ->join('product_variants', 'product_variants.id = order_items.variant_id', 'left')
            ->where('order_id', $id)
            ->findAll();

        $data = array_merge($this->data ?? [], [
            'title' => 'Order Detail — ' . $order['order_number'],
            'order' => $order,
            'items' => $items
        ]);

        return view('pages/sales/show', $data);
    }

    public function export()
    {
        $orderModel = new OrderModel();

        $dateFrom = $this->request->getGet('date_from') ?? date('Y-m-01');
        $dateTo   = $this->request->getGet('date_to')   ?? date('Y-m-d');

        $orders = $orderModel
            ->select('orders.*, customers.name as customer_name')
            ->join('customers', 'customers.id = orders.customer_id', 'left')
            ->where('DATE(orders.created_at) >=', $dateFrom)
            ->where('DATE(orders.created_at) <=', $dateTo)
            ->orderBy('orders.created_at', 'DESC')
            ->findAll();

        $filename = 'sales_' . $dateFrom . '_to_' . $dateTo . '.csv';

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');

        fputcsv($output, ['Order Number', 'Customer', 'Total Amount', 'Date & Time']);

        foreach ($orders as $order) {
            fputcsv($output, [
                $order['order_number'],
                $order['customer_name'] ?? 'Walk-in',
                $order['total_amount'],
                $order['created_at']
            ]);
        }

        fclose($output);
        exit;
    }
}