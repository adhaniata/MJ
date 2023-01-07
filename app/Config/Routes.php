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
    $routes->get('produk/edit/(:any)', 'Admin\Produk::edit/$1');
    $routes->get('produk/(:any)', 'Admin\Produk::detail/$1');
    $routes->post('produk/update/(:num)', 'Admin\Produk::update/$1');
    $routes->delete('produk/delete/(:num)', 'Admin\Produk::delete/$1');

    $routes->get('ongkir', 'Admin\Ongkir::index');
    $routes->get('ongkir/create', 'Admin\Ongkir::create');
    $routes->post('ongkir/save', 'Admin\Ongkir::save');
    $routes->get('ongkir/edit/(:any)', 'Admin\Ongkir::edit/$1');
    $routes->get('ongkir/(:any)', 'Admin\Ongkir::detail/$1');
    $routes->post('ongkir/update/(:num)', 'Admin\Ongkir::update/$1');
    $routes->delete('ongkir/delete/(:num)', 'Admin\Ongkir::delete/$1');

    $routes->get('kategori', 'Admin\Kategori::index');
    $routes->get('kategori/create', 'Admin\Kategori::create');
    $routes->post('kategori/save', 'Admin\Kategori::save');
    $routes->get('kategori/edit/(:any)', 'Admin\Kategori::edit/$1');
    $routes->post('kategori/update/(:num)', 'Admin\Kategori::update/$1');
    $routes->delete('kategori/delete/(:num)', 'Admin\Kategori::delete/$1');

    $routes->get('transaksi', 'Admin\transaksi::index');
    $routes->get('transaksi/(:num)', 'Admin\transaksi::detail/$1');
    $routes->get('transaksi/edit/(:num)', 'Admin\transaksi::edit/$1');
    $routes->post('transaksi/update/(:num)', 'Admin\transaksi::update/$1');

    $routes->get('transaksi/konfirmasi/(:num)', 'Admin\transaksi::konfirmasi/$1');
    $routes->post('transaksi/konfirmasi/update/(:num)', 'Admin\transaksi::updateKonfirmasi/$1');

    $routes->get('akun/profil', 'Admin\Akun::profil');
    $routes->post('akun/update-profil', 'Admin\Akun::update_profil');
    $routes->get('akun/password', 'Admin\Akun::password');
    $routes->post('akun/update-password', 'Admin\Akun::update_password');
});

//hak akses untuk user
$routes->group('', ['filter' => 'role:user'], function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('keranjang', 'Keranjang::index');
    $routes->post('keranjang/update/(:num)', 'Keranjang::update/$1');
    $routes->get('keranjang/delete/(:num)', 'Keranjang::delete/$1');
    $routes->post('keranjang/tambah-keranjang', 'Keranjang::tambahKeranjang');   //niatnya keranjang/id_usernya

    $routes->get('keranjang/checkout', 'Keranjang::checkout');

    $routes->get('ongkir', 'Ongkir::index');
    $routes->get('ongkir/(:any)', 'Ongkir::detail/$1');

    $routes->get('transaksi', 'Transaksi::index');
    $routes->post('transaksi/save', 'Transaksi::save');
    $routes->get('transaksi/(:num)', 'Transaksi::detail/$1');
    $routes->get('transaksi/delete/(:num)', 'Transaksi::delete/$1');
    $routes->get('transaksi/konfirmasi/(:num)', 'Konfirmasi::index/$1');
    $routes->post('transaksi/konfirmasi/save', 'Konfirmasi::save');

    $routes->get('akun/profil', 'Akun::profil');
    $routes->post('akun/update-profil', 'Akun::update_profil');
    $routes->get('akun/password', 'Akun::password');
    $routes->post('akun/update-password', 'Akun::update_password');
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
