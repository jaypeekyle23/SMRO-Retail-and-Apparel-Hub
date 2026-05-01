<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();

        $users = [
            [
                'username'      => 'superadmin',
                'email'         => 'admin@smro.com',
                'password_hash' => 'admin123', // The Model will automatically hash this!
                'role'          => 'SuperAdmin',
            ],
            [
                'username'      => 'manager_jane',
                'email'         => 'jane@smro.com',
                'password_hash' => 'manager123',
                'role'          => 'Manager',
            ],
            [
                'username'      => 'staff_john',
                'email'         => 'john@smro.com',
                'password_hash' => 'staff123',
                'role'          => 'Staff',
            ]
        ];

        // Insert each user into the database
        foreach ($users as $user) {
            $userModel->insert($user);
        }
        
        echo "Successfully seeded 3 users (SuperAdmin, Manager, Staff)!\n";
    }
}