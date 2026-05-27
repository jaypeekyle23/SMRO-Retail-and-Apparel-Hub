<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserRole extends Migration
{
    public function up(): void
    {
        // Only insert if role_id=4 doesn't already exist (seeder may have added it)
        $exists = $this->db->table('user_role')->where('id', 4)->countAllResults();

        if (!$exists) {
            $this->db->table('user_role')->insert([
                'id'   => 4,
                'role' => 'User',
            ]);
        }
    }

    public function down(): void
    {
        $this->db->table('user_role')->where('id', 4)->delete();
    }
}