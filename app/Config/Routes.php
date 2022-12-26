<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/produk/(:segment)', 'Home::detail/$1');

// hak akses untuk admin
$routes->group('admin', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('/', 'Admin\Home::index');

    $routes->get('produk', 'Admin\Produk::index');
    $routes->get('produk/create', 'Admin\Produk::create');
    $routes->post('produk/save', 'Admin\Produk::save');
    $routes->get('produk/:any', 'Admin\Produk::edit/$1');
    $routes->get('produk/update/:num', 'Admin\Produk::update/$1');

    $routes->get('ongkir', 'Admin\Ongkir::index');
    $routes->get('ongkir/create', 'Admin\Ongkir::create');
    $routes->post('ongkir/save', 'Admin\Ongkir::save');
    $routes->get('ongkir/:any', 'Admin\Ongkir::edit/$1');
    $routes->get('ongkir/update/:num', 'Admin\Ongkir::update/$1');
});

//hak akses untuk user
$routes->group('user', ['filter' => 'role:user'], function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('keranjang', 'Keranjang::index');
    //$routes->get('keranjang/:num', 'Keranjang::index/$1');   //niatnya keranjang/id_usernya
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
