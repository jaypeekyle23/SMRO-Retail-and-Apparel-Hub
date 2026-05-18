<?php
use CodeIgniter\Router\RouteCollection;
/**
 * @var RouteCollection $routes
 */
// Authentication & Core Routes
$routes->get('/', 'Auth::index');
$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::index');
$routes->get('logout', 'Auth::logout');
$routes->get('blocked', 'Auth::forbiddenPage');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::registration');
$routes->get('dashboard', 'Home::index');
// --------------------------------------------------------------------
// Setting Routes (Handles User Management, Roles, and Permissions)
// --------------------------------------------------------------------
$routes->group('users', static function ($routes) {
    $routes->get('/', 'Settings::users');
    $routes->post('create-role', 'Settings::createRole');
    $routes->post('update-role', 'Settings::updateRole');
    $routes->delete('delete-role/(:num)', 'Settings::deleteRole/$1');
    $routes->get('role-access', 'Settings::roleAccess');
    $routes->post('create-user', 'Settings::createUser');
    $routes->post('update-user', 'Settings::updateUser');
    $routes->delete('delete-user/(:num)', 'Settings::deleteUser/$1');
    $routes->post('change-menu-permission', 'Settings::changeMenuPermission');
    $routes->post('change-menu-category-permission', 'Settings::changeMenuCategoryPermission');
    $routes->post('change-submenu-permission', 'Settings::changeSubMenuPermission');
});
// --------------------------------------------------------------------
// Menu Management Routes
// --------------------------------------------------------------------
$routes->group('menu-management', static function ($routes) {
    $routes->get('/', 'Settings::menuManagement');
    $routes->post('create-menu-category', 'Settings::createMenuCategory');
    $routes->post('create-menu', 'Settings::createMenu');
    $routes->post('create-submenu', 'Settings::createSubMenu');
});
$routes->get('menu', 'Menu::index');
// --------------------------------------------------------------------
// Web Dashboard Routes (For UI Access)
// --------------------------------------------------------------------
$routes->group('dashboard', ['filter' => 'isLoggedIn'], static function ($routes) {
    $routes->resource('products', ['controller' => 'ProductController']);
});
// --------------------------------------------------------------------
// RESTful API Routes (For External Systems)
// --------------------------------------------------------------------
$routes->group('api', ['namespace' => 'App\Controllers\Api', 'filter' => 'bearerToken'], static function ($routes) {
    $routes->get('products',        'ProductController::index');
    $routes->get('products/(:num)', 'ProductController::show/$1');
    $routes->get('inventory',       'ProductController::inventory');
    $routes->get('sales',           'ProductController::sales');
});
// --------------------------------------------------------------------
// THREAD Core Modules
// --------------------------------------------------------------------
$routes->get('products', 'Products::index');
$routes->get('products/create', 'Products::create');
$routes->post('products/store', 'Products::store');
$routes->get('products/delete/(:num)', 'Products::delete/$1');
$routes->get('products/edit/(:num)', 'Products::edit/$1');
$routes->post('products/update/(:num)', 'Products::update/$1');
// Inventory Routes
$routes->get('inventory', 'Inventory::index');
$routes->post('inventory/adjust', 'Inventory::adjust');
// --- POS / ORDERS ---
$routes->get('pos', 'Pos::index');
$routes->post('pos/checkout', 'Pos::checkout');
$routes->get('sales', 'Sales::index');
$routes->get('sales/(:num)', 'Sales::show/$1');
$routes->get('sales/export', 'Sales::export');
$routes->get('inventory/export', 'Inventory::export');
$routes->get('customers', 'Customers::index');
$routes->get('customers/(:num)', 'Customers::show/$1');
// Supplier Routes
$routes->get('suppliers', 'Suppliers::index');
$routes->get('suppliers/create', 'Suppliers::create');
$routes->post('suppliers/store', 'Suppliers::store');
$routes->get('suppliers/edit/(:num)', 'Suppliers::edit/$1');
$routes->post('suppliers/update/(:num)', 'Suppliers::update/$1');
$routes->get('suppliers/delete/(:num)', 'Suppliers::delete/$1');
// Purchase Order Routes
$routes->get('purchase-orders', 'PurchaseOrders::index');
$routes->get('purchase-orders/create', 'PurchaseOrders::create');
$routes->post('purchase-orders/store', 'PurchaseOrders::store');
$routes->get('purchase-orders/(:num)', 'PurchaseOrders::show/$1');
$routes->post('purchase-orders/receive/(:num)', 'PurchaseOrders::receive/$1');
$routes->get('purchase-orders/cancel/(:num)', 'PurchaseOrders::cancel/$1');

// User Profile Routes
$routes->get('profile', 'Profile::index');
$routes->post('profile/update', 'Profile::update');
$routes->post('profile/change-password', 'Profile::changePassword');

// Returns Routes
$routes->get('returns', 'Returns::index');
$routes->get('returns/create/(:num)', 'Returns::create/$1');
$routes->post('returns/store', 'Returns::store');
$routes->post('returns/approve/(:num)', 'Returns::approve/$1');
$routes->post('returns/reject/(:num)', 'Returns::reject/$1');