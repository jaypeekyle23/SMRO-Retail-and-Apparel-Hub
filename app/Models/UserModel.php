<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    
    // Security: Only these fields can be inserted/updated by the user
    protected $allowedFields    = ['username', 'email', 'password_hash', 'role'];

    protected $useTimestamps = true;

    // Callbacks to hit the OWASP Hashing requirement automatically
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password_hash'])) {
            // Automatically hashes the password using BCRYPT before saving to database
            $data['data']['password_hash'] = password_hash($data['data']['password_hash'], PASSWORD_BCRYPT);
        }
        return $data;
    }
}