<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        // 1. Seed Roles
        $this->db->table('user_role')->truncate();
        $this->db->table('user_role')->insertBatch([
            ['id' => 1, 'role' => 'Superadmin'],
            ['id' => 2, 'role' => 'Manager'],
            ['id' => 3, 'role' => 'Staff'],
            ['id' => 4, 'role' => 'User'],
        ]);
        echo "✔ Roles seeded.\n";

        // 2. Seed Users
        $this->db->table('users')->truncate();
        $this->db->table('users')->insertBatch([
            [
                'fullname'   => 'Super Admin',
                'username'   => 'admin@thread.com',
                'email'      => 'admin@thread.com',
                'password'   => password_hash('admin123', PASSWORD_DEFAULT),
                'role'       => 1,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'fullname'   => 'Manager Jane',
                'username'   => 'manager@thread.com',
                'email'      => 'manager@thread.com',
                'password'   => password_hash('manager123', PASSWORD_DEFAULT),
                'role'       => 2,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'fullname'   => 'Staff John',
                'username'   => 'staff@thread.com',
                'email'      => 'staff@thread.com',
                'password'   => password_hash('staff123', PASSWORD_DEFAULT),
                'role'       => 3,
                'created_at' => date('Y-m-d H:i:s')
            ],
        ]);
        echo "✔ Users seeded.\n";

        // 3. Seed Menu Categories
        $this->db->table('user_menu_category')->truncate();
        $this->db->table('user_menu_category')->insertBatch([
            ['id' => 1, 'menu_category' => 'Main'],
            ['id' => 2, 'menu_category' => 'Catalog'],
            ['id' => 3, 'menu_category' => 'Sales'],
            ['id' => 4, 'menu_category' => 'System'],
        ]);
        echo "✔ Menu categories seeded.\n";

        // 4. Seed Menus
        // Menu IDs:
        //  1  - Dashboard       (Main/1)
        //  2  - Products        (Catalog/2)
        //  3  - Stock Ledger    (Catalog/2)
        //  4  - Suppliers       (Catalog/2)
        //  5  - Purchase Orders (Catalog/2)
        //  6  - Point of Sale   (Sales/3)
        //  7  - Sales History   (Sales/3)
        //  8  - Customers       (Sales/3)
        //  9  - Returns         (Sales/3)   ← was missing, added here
        //  10 - Settings        (System/4)
        //  11 - Menu Management (System/4)
        $this->db->table('user_menu')->truncate();
        $this->db->table('user_menu')->insertBatch([
            ['id' => 1,  'menu_category' => 1, 'menu_category_id' => 1, 'title' => 'Dashboard',       'url' => 'dashboard',       'icon' => 'sliders',       'is_active' => 1],
            ['id' => 2,  'menu_category' => 2, 'menu_category_id' => 2, 'title' => 'Products',        'url' => 'products',        'icon' => 'box',           'is_active' => 1],
            ['id' => 3,  'menu_category' => 2, 'menu_category_id' => 2, 'title' => 'Stock Ledger',    'url' => 'inventory',       'icon' => 'clipboard',     'is_active' => 1],
            ['id' => 4,  'menu_category' => 2, 'menu_category_id' => 2, 'title' => 'Suppliers',       'url' => 'suppliers',       'icon' => 'truck',         'is_active' => 1],
            ['id' => 5,  'menu_category' => 2, 'menu_category_id' => 2, 'title' => 'Purchase Orders', 'url' => 'purchase-orders', 'icon' => 'shopping-bag',  'is_active' => 1],
            ['id' => 6,  'menu_category' => 3, 'menu_category_id' => 3, 'title' => 'Point of Sale',   'url' => 'pos',             'icon' => 'shopping-cart', 'is_active' => 1],
            ['id' => 7,  'menu_category' => 3, 'menu_category_id' => 3, 'title' => 'Sales History',   'url' => 'sales',           'icon' => 'file-text',     'is_active' => 1],
            ['id' => 8,  'menu_category' => 3, 'menu_category_id' => 3, 'title' => 'Customers',       'url' => 'customers',       'icon' => 'users',         'is_active' => 1],
            ['id' => 9,  'menu_category' => 3, 'menu_category_id' => 3, 'title' => 'Returns',         'url' => 'returns',         'icon' => 'rotate-ccw',    'is_active' => 1],
            ['id' => 10, 'menu_category' => 4, 'menu_category_id' => 4, 'title' => 'Settings',        'url' => 'users',           'icon' => 'settings',      'is_active' => 1],
            ['id' => 11, 'menu_category' => 4, 'menu_category_id' => 4, 'title' => 'Menu Management', 'url' => 'menu-management', 'icon' => 'settings',      'is_active' => 1],
        ]);
        echo "✔ Menus seeded.\n";

        // 5. Seed User Access
        // ---------------------------------------------------------------
        // SUPERADMIN (1): Full access — all categories + all menus
        // MANAGER    (2): Catalog + Sales categories, no System
        //                 Menus: Dashboard, Products, Stock Ledger,
        //                        Suppliers, Purchase Orders, POS,
        //                        Sales History, Customers, Returns
        // STAFF      (3): Catalog + Sales categories, no System
        //                 Menus: Dashboard, Products, Stock Ledger,
        //                        POS, Sales History, Customers, Returns
        //                 (No Suppliers, no Purchase Orders)
        // ---------------------------------------------------------------
        $this->db->table('user_access')->truncate();

        $accessData = [];

        // --- Superadmin: all 4 categories ---
        foreach ([1, 2, 3, 4] as $catId) {
            $accessData[] = ['role_id' => 1, 'menu_category_id' => $catId, 'menu_id' => 0];
        }
        // --- Superadmin: all 11 menus ---
        foreach (range(1, 11) as $menuId) {
            $accessData[] = ['role_id' => 1, 'menu_category_id' => 0, 'menu_id' => $menuId];
        }

        // --- Manager: categories Main, Catalog, Sales (no System) ---
        foreach ([1, 2, 3] as $catId) {
            $accessData[] = ['role_id' => 2, 'menu_category_id' => $catId, 'menu_id' => 0];
        }
        // --- Manager: menus (no Settings/11, no Menu Management/12) ---
        foreach ([1, 2, 3, 4, 5, 6, 7, 8, 9] as $menuId) {
            $accessData[] = ['role_id' => 2, 'menu_category_id' => 0, 'menu_id' => $menuId];
        }

        // --- Staff: categories Main, Catalog, Sales (no System) ---
        foreach ([1, 2, 3] as $catId) {
            $accessData[] = ['role_id' => 3, 'menu_category_id' => $catId, 'menu_id' => 0];
        }
        // --- Staff: menus (no Suppliers/4, no Purchase Orders/5, no Settings/10, no Menu Mgmt/11) ---
        foreach ([1, 2, 3, 6, 7, 8, 9] as $menuId) {
            $accessData[] = ['role_id' => 3, 'menu_category_id' => 0, 'menu_id' => $menuId];
        }

        $this->db->table('user_access')->insertBatch($accessData);
        echo "✔ User access seeded.\n";

        // 6. Seed a sample Supplier
        $this->db->table('suppliers')->truncate();
        $this->db->table('suppliers')->insert([
            'name'       => 'Thread Supply Co.',
            'phone'      => '09123456789',
            'email'      => 'supply@thread.com',
            'address'    => 'Manila, Philippines',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        echo "✔ Suppliers seeded.\n";

        // 7. Seed API Token
        $this->db->table('api_tokens')->truncate();
        $this->db->table('api_tokens')->insert([
            'name'       => 'Thread API Key',
            'token'      => hash('sha256', 'thread-api-secret-2026'),
            'created_at' => date('Y-m-d H:i:s')
        ]);
        echo "✔ API token seeded.\n";

        echo "\n✅ All seeders completed successfully!\n";
    }
}