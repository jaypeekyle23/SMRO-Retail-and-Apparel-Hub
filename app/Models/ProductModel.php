<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    // We enable soft deletes here so if you delete a product, it hides it instead of wiping it out completely
    protected $useSoftDeletes   = true; 
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'description', 'base_image'];

    protected $useTimestamps = true;
}