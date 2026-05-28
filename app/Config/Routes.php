<?php
use CodeIgniter\Router\RouteCollection;
/**
 * @var RouteCollection $routes
 */

// --------------------------------------------------------------------
// Public Routes — No Authentication Required
// --------------------------------------------------------------------
$routes->get('/', 'Auth::index');
$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::index');
$routes->get('logout', 'Auth::logout');
$routes->get('blocked', 'Auth::forbiddenPage');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::registration');

// --------------------------------------------------------------------
// RESTful API Routes — Bearer Token Protected
// --------------------------------------------------------------------
$routes->group('api', ['namespace' => 'App\Controllers\Api', 'filter' => 'bearerToken'], static function ($routes) {
    $routes->get('products',        'ProductController::index');
    $routes->get('products/(:num)', 'ProductController::show/$1');
    $routes->get('inventory',       'ProductController::inventory');
    $routes->get('sales',           'ProductController::sales');
});

// --------------------------------------------------------------------
// Authenticated Web Routes — isLoggedIn Filter Applied to All
// --------------------------------------------------------------------
$routes->group('', ['filter' => 'isLoggedIn'], static function ($routes) {

    // Dashboard
    $routes->get('dashboard', 'Home::index');

    // --- Settings ---
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

    $routes->group('menu-management', static function ($routes) {
        $routes->get('/', 'Settings::menuManagement');
        $routes->post('create-menu-category', 'Settings::createMenuCategory');
        $routes->post('create-menu', 'Settings::createMenu');
        $routes->post('create-submenu', 'Settings::createSubMenu');
    });

    // --- Products ---
    $routes->get('products', 'Products::index');
    $routes->get('products/create', 'Products::create');
    $routes->post('products/store', 'Products::store');
    $routes->get('products/delete/(:num)', 'Products::delete/$1');
    $routes->get('products/edit/(:num)', 'Products::edit/$1');
    $routes->post('products/update/(:num)', 'Products::update/$1');

    // --- Inventory ---
    $routes->get('inventory', 'Inventory::index');
    $routes->post('inventory/adjust', 'Inventory::adjust');
    $routes->get('inventory/export', 'Inventory::export');

    // --- POS & Sales ---
    $routes->get('pos', 'Pos::index');
    $routes->post('pos/checkout', 'Pos::checkout');
    $routes->get('sales', 'Sales::index');
    $routes->get('sales/(:num)', 'Sales::show/$1');
    $routes->get('sales/export', 'Sales::export');

    // --- Customers ---
    $routes->get('customers', 'Customers::index');
    $routes->get('customers/(:num)', 'Customers::show/$1');

    // --- Suppliers ---
    $routes->group('suppliers', static function ($routes) {
        $routes->get('/', 'Suppliers::index');
        $routes->get('create', 'Suppliers::create');
        $routes->post('store', 'Suppliers::store');
        $routes->get('edit/(:num)', 'Suppliers::edit/$1');
        $routes->post('update/(:num)', 'Suppliers::update/$1');
        $routes->get('delete/(:num)', 'Suppliers::delete/$1');
    });

    // --- Purchase Orders ---
    $routes->group('purchase-orders', static function ($routes) {
        $routes->get('/', 'PurchaseOrders::index');
        $routes->get('create', 'PurchaseOrders::create');
        $routes->post('store', 'PurchaseOrders::store');
        $routes->get('(:num)', 'PurchaseOrders::show/$1');
        $routes->post('receive/(:num)', 'PurchaseOrders::receive/$1');
        $routes->get('cancel/(:num)', 'PurchaseOrders::cancel/$1');
    });

    // --- Profile ---
    $routes->group('profile', static function ($routes) {
        $routes->get('/', 'Profile::index');
        $routes->post('update', 'Profile::update');
        $routes->post('change-password', 'Profile::changePassword');
    });

    // --- Returns ---
    $routes->group('returns', static function ($routes) {
        $routes->get('/', 'Returns::index');
        $routes->get('create/(:num)', 'Returns::create/$1');
        $routes->post('store', 'Returns::store');
        $routes->post('approve/(:num)', 'Returns::approve/$1');
        $routes->post('reject/(:num)', 'Returns::reject/$1');
    });

    // --- User Portal ---
    $routes->get('shop', 'UserPortal::shop');
    $routes->get('my-orders', 'UserPortal::myOrders');
    $routes->post('shop/add-to-cart', 'UserPortal::addToCart');
    $routes->post('cart/remove', 'UserPortal::removeFromCart');
    $routes->post('cart/clear', 'UserPortal::clearCart');
    $routes->get('checkout', 'UserPortal::checkout');
    $routes->post('checkout/place-order', 'UserPortal::placeOrder');
    $routes->get('order-confirmed/(:num)', 'UserPortal::orderConfirmed/$1');
    $routes->post('my-orders/return', 'UserPortal::submitReturn');
    $routes->post('cart/update', 'UserPortal::updateCart');
});