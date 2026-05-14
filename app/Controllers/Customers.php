<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\OrderModel;

class Customers extends BaseController
{
    public function index()
    {
        $customerModel = new CustomerModel();

        $search  = $this->request->getGet('search') ?? '';
        $perPage = 10;

        if ($search) {
            $customers = $customerModel
                ->like('name', $search)
                ->orLike('phone', $search)
                ->orLike('email', $search)
                ->paginate($perPage, 'default');
        } else {
            $customers = $customerModel->paginate($perPage, 'default');
        }

        $data = array_merge($this->data ?? [], [
            'title'     => 'Customers',
            'customers' => $customers,
            'pager'     => $customerModel->pager,
            'search'    => $search
        ]);

        return view('pages/customers/index', $data);
    }

    public function show($id)
    {
        $customerModel = new CustomerModel();
        $orderModel    = new OrderModel();

        $customer = $customerModel->find($id);

        if (!$customer) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $orders = $orderModel->where('customer_id', $id)
                             ->orderBy('created_at', 'DESC')
                             ->findAll();

        $totalSpent = array_sum(array_column($orders, 'total_amount'));

        $data = array_merge($this->data ?? [], [
            'title'      => 'Customer — ' . $customer['name'],
            'customer'   => $customer,
            'orders'     => $orders,
            'totalSpent' => $totalSpent
        ]);

        return view('pages/customers/show', $data);
    }
}