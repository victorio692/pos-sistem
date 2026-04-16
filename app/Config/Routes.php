<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
$routes->setAutoRoute(false); 


$routes->get('/', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->post('proses-login', 'Auth::prosesLogin');
$routes->get('logout', 'Auth::logout');


$routes->get('tables', 'Tabels::index');


$routes->get('order/new/(:any)', 'Order::new/$1');
$routes->get('order/success', 'Order::success');
$routes->get('order/(:any)', 'Order::index/$1');
$routes->post('order', 'Order::store');

// KASIR
$routes->group('kasir', ['filter' => 'auth'], function($routes){
    $routes->get('/', 'Kasir::index');
    $routes->get('order/(:num)', 'Kasir::order/$1');
    $routes->post('order/create', 'Kasir::createOrder');
    $routes->get('payment/(:num)', 'Kasir::payment/$1');
    $routes->post('payment/process', 'Kasir::processPayment');
    $routes->get('receipt/(:num)', 'Kasir::receipt/$1');
    $routes->get('history', 'Kasir::history');
    $routes->get('profile', 'Kasir::profile');
    $routes->post('finishTable/(:num)', 'Kasir::finishTable/$1');
    $routes->get('getHistoryData', 'Kasir::getHistoryData');
    $routes->get('getOrderDetail/(:num)', 'Kasir::getOrderDetail/$1');
    $routes->get('printReceipt/(:num)', 'Kasir::printReceipt/$1');
    $routes->get('api/tables', 'Kasir::getTables');
    $routes->get('api/menu/(:any)', 'Kasir::getMenuByCategory/$1');
    $routes->post('api/table/status/(:num)/(:any)', 'Kasir::updateTableStatus/$1/$2');
});

// ADMIN
$routes->group('admin', ['filter' => 'auth'], function($routes){

    $routes->get('/', 'Admin::index');

    // Tables
    $routes->get('tables', 'Admin::tables');
    $routes->get('tables/create', 'Admin::createTable');
    $routes->post('tables/store', 'Admin::storeTable');
    $routes->get('tables/delete/(:num)', 'Admin::deleteTable/$1');

    // Menu
    $routes->get('menu', 'Admin::menu');
    $routes->get('menu/create', 'Admin::createMenu');
    $routes->post('menu/store', 'Admin::storeMenu');
    $routes->get('menu/delete/(:num)', 'Admin::deleteMenu/$1');

    // Orders
    $routes->get('orders', 'Admin::orders');
    $routes->get('orders/detail/(:num)', 'Admin::detailOrder/$1');

    // Users
    $routes->get('users', 'Admin::users');
    $routes->post('users/store', 'Admin::storeUser');
});