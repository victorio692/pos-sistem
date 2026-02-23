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