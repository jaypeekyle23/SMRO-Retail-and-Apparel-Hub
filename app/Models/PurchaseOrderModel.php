<?php

namespace App\Models;

use CodeIgniter\Model;

class PurchaseOrderModel extends Model
{
    protected $table         = 'purchase_orders';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['supplier_id', 'po_number', 'status', 'notes'];
    protected $useTimestamps = true;
}