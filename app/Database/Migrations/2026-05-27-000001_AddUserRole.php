<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserRole extends Migration
{
    public function up(): void
    {
        $this->db->table('user_role')->insert([
            'id'   => 4,
            'role' => 'User',
        ]);
    }

    public function down(): void
    {
        $this->db->table('user_role')->where('id', 4)->delete();
    }
}