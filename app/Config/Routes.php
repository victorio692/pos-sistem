<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
$routes->setAutoRoute(true);

// Custom routes BEFORE system routes
$routes->get('/', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->post('proses-login', 'Auth::prosesLogin');
$routes->get('logout', 'Auth::logout');
$routes->get('tables', 'Tabels::index');

// Load system routes last
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}
