<?php

namespace App\Models;

use CodeIgniter\Model;

class ReturnModel extends Model
{
    protected $table         = 'returns';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['order_id', 'variant_id', 'product_id', 'quantity', 'reason', 'refund_amount', 'status'];
    protected $useTimestamps = true;
}