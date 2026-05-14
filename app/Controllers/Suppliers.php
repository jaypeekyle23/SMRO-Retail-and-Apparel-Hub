<?php

namespace App\Controllers;

use App\Models\SupplierModel;

class Suppliers extends BaseController
{
    public function index()
    {
        $supplierModel = new SupplierModel();

        $search  = $this->request->getGet('search') ?? '';
        $perPage = 10;

        if ($search) {
            $suppliers = $supplierModel
                ->like('name', $search)
                ->orLike('phone', $search)
                ->orLike('email', $search)
                ->paginate($perPage, 'default');
        } else {
            $suppliers = $supplierModel->paginate($perPage, 'default');
        }

        $data = array_merge($this->data ?? [], [
            'title'     => 'Suppliers',
            'suppliers' => $suppliers,
            'pager'     => $supplierModel->pager,
            'search'    => $search
        ]);

        return view('pages/suppliers/index', $data);
    }

    public function create()
    {
        $data = array_merge($this->data ?? [], [
            'title' => 'Add Supplier'
        ]);

        return view('pages/suppliers/create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'name' => 'required|min_length[2]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $supplierModel = new SupplierModel();
        $supplierModel->insert([
            'name'    => $this->request->getPost('name'),
            'phone'   => $this->request->getPost('phone'),
            'email'   => $this->request->getPost('email'),
            'address' => $this->request->getPost('address'),
        ]);

        return redirect()->to('suppliers')->with('success', 'Supplier added successfully!');
    }

    public function edit($id)
    {
        $supplierModel = new SupplierModel();
        $supplier      = $supplierModel->find($id);

        if (!$supplier) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = array_merge($this->data ?? [], [
            'title'    => 'Edit Supplier',
            'supplier' => $supplier
        ]);

        return view('pages/suppliers/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'name' => 'required|min_length[2]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $supplierModel = new SupplierModel();
        $supplierModel->update($id, [
            'name'    => $this->request->getPost('name'),
            'phone'   => $this->request->getPost('phone'),
            'email'   => $this->request->getPost('email'),
            'address' => $this->request->getPost('address'),
        ]);

        return redirect()->to('suppliers')->with('success', 'Supplier updated successfully!');
    }

    public function delete($id)
    {
        $supplierModel = new SupplierModel();
        $supplierModel->delete($id);

        return redirect()->to('suppliers')->with('success', 'Supplier deleted successfully!');
    }
}