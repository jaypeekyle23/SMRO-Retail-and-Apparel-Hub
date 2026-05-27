<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserToRoleEnum extends Migration
{
    public function up(): void
    {
        $this->db->query("ALTER TABLE users MODIFY COLUMN role ENUM('SuperAdmin', 'Manager', 'Staff', 'User') NOT NULL DEFAULT 'Staff'");
    }

    public function down(): void
    {
        $this->db->query("ALTER TABLE users MODIFY COLUMN role ENUM('SuperAdmin', 'Manager', 'Staff') NOT NULL DEFAULT 'Staff'");
    }
}