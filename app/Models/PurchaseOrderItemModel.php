<?php

namespace App\Models;

use CodeIgniter\Model;

class PurchaseOrderItemModel extends Model
{
    protected $table         = 'purchase_order_items';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['purchase_order_id', 'variant_id', 'product_id', 'quantity', 'cost_price'];
    protected $useTimestamps = true;
}