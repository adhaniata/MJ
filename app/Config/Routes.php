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
$routes->get('/chatbot', 'Chatbot::index');
$routes->post('/chatbot/kirim', 'Chatbot::kirim');

// hak akses untuk admin
$routes->group('admin', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('/', 'Admin\Home::index');
    $routes->get('tampilan-produk', 'Admin\TampilanProduk::index');
    $routes->get('tampilan-produk/cari', 'Admin\TampilanProduk::cari');
    $routes->get('tampilan-produk/kategori', 'Admin\TampilanProduk::kategori');

    $routes->get('produk', 'Admin\Produk::index');
    $routes->get('produk/create', 'Admin\Produk::create');
    $routes->post('produk/save', 'Admin\Produk::save');
    $routes->get('produk/edit/(:any)', 'Admin\Produk::edit/$1');
    $routes->get('produk/(:any)', 'Admin\Produk::detail/$1');
    $routes->post('produk/update/(:num)', 'Admin\Produk::update/$1');
    $routes->delete('produk/delete/(:num)', 'Admin\Produk::delete/$1');
    $routes->get('produk/cari', 'Admin\Produk::cari');
    $routes->post('produk/proses', 'Admin\produk::proses');

    $routes->get('ongkir', 'Admin\Ongkir::index');
    $routes->get('ongkir/create', 'Admin\Ongkir::create');
    $routes->post('ongkir/save', 'Admin\Ongkir::save');
    $routes->get('ongkir/edit/(:any)', 'Admin\Ongkir::edit/$1');
    $routes->get('ongkir/(:any)', 'Admin\Ongkir::detail/$1');
    $routes->post('ongkir/update/(:num)', 'Admin\Ongkir::update/$1');
    $routes->delete('ongkir/delete/(:num)', 'Admin\Ongkir::delete/$1');
    $routes->get('ongkir/cari', 'Admin\Ongkir::cari');

    $routes->get('chatbot', 'Admin\Chatbot::index');
    $routes->get('chatbot/create', 'Admin\Chatbot::create');
    $routes->post('chatbot/save', 'Admin\Chatbot::save');
    $routes->get('chatbot/edit/(:num)', 'Admin\Chatbot::edit/$1');
    $routes->post('chatbot/update/(:num)', 'Admin\Chatbot::update/$1');
    $routes->delete('chatbot/delete/(:num)', 'Admin\Chatbot::delete/$1');

    $routes->get('kategori', 'Admin\Kategori::index');
    $routes->get('kategori/create', 'Admin\Kategori::create');
    $routes->post('kategori/save', 'Admin\Kategori::save');
    $routes->get('kategori/edit/(:any)', 'Admin\Kategori::edit/$1');
    $routes->post('kategori/update/(:num)', 'Admin\Kategori::update/$1');
    $routes->delete('kategori/delete/(:num)', 'Admin\Kategori::delete/$1');
    $routes->get('kategori/cari', 'Admin\kategori::cari');

    $routes->get('transaksi', 'Admin\transaksi::index');
    $routes->get('transaksi/(:num)', 'Admin\transaksi::detail/$1');
    $routes->get('transaksi/edit/(:num)', 'Admin\transaksi::edit/$1');
    $routes->post('transaksi/update/(:num)', 'Admin\transaksi::update/$1');
    $routes->delete('transaksi/delete/(:num)', 'Admin\transaksi::delete/$1');
    $routes->post('transaksi/proses', 'Admin\transaksi::proses');
    $routes->post('transaksi/fillter', 'Admin\transaksi::fillter_tp');
    $routes->post('transaksi/print/(:num)', 'Admin\transaksi::cetakdetail/$1');
    $routes->get('transaksi/cari', 'Admin\transaksi::cari');
    $routes->get('transaksi/batal', 'Admin\Transaksi::tampilanBatal');
    $routes->get('transaksi/belum-bayar', 'Admin\Transaksi::tampilanBelumBayar');
    $routes->get('transaksi/proses', 'Admin\Transaksi::tampilanProses');
    $routes->get('transaksi/selesai', 'Admin\Transaksi::tampilanSelesai');
    // $routes->get('transaksi/print/(:num)', 'Admin\transaksi::printdetail/$1');
    // $routes->get('transaksi/export-pdf', 'Admin\transaksi::exportPDF');
    // $routes->get('transaksi/export-excel', 'Admin\transaksi::exportExcel');
    $routes->get('transaksi/konfirmasi/(:num)', 'Admin\transaksi::konfirmasi/$1');
    $routes->post('transaksi/konfirmasi/update', 'Admin\transaksi::updateKonfirmasi');

    $routes->get('pengembalian', 'Admin\Pengembalian::index');
    $routes->get('pengembalian/(:num)', 'Admin\Pengembalian::detail/$1');
    $routes->post('pengembalian/update/(:num)', 'Admin\Pengembalian::update/$1');

    $routes->get('akun/profil', 'Admin\Akun::profil');
    $routes->post('akun/update-profil', 'Admin\Akun::update_profil');
    $routes->get('akun/password', 'Admin\Akun::password');
    $routes->post('akun/update-password', 'Admin\Akun::update_password');
});

//hak akses untuk user
$routes->group('', ['filter' => 'role:user'], function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('cari', 'Home::cari');
    $routes->post('fillter', 'Home::fillter_tp');
    $routes->get('keranjang', 'Keranjang::index');
    $routes->post('keranjang/update/(:num)', 'Keranjang::update/$1');
    $routes->get('keranjang/delete/(:num)', 'Keranjang::delete/$1');
    $routes->post('keranjang/tambah-keranjang', 'Keranjang::tambahKeranjang');   //niatnya keranjang/id_usernya
    $routes->get('keranjang/checkout', 'Keranjang::checkout');

    $routes->get('kategori', 'Home::kategori');

    $routes->get('ongkir', 'Ongkir::index');
    $routes->get('ongkir/(:any)', 'Ongkir::detail/$1');

    $routes->get('transaksi', 'Transaksi::index');
    $routes->get('transaksi/belum-bayar', 'Transaksi::tampilanBelumBayar');
    $routes->get('transaksi/batal', 'Transaksi::tampilanBatal');
    $routes->get('transaksi/batal/(:num)', 'Transaksi::batal/$1');
    $routes->get('transaksi/detail-semua/(:num)', 'Transaksi::detailAll/$1');
    $routes->get('transaksi/detail-selesai/(:num)', 'Transaksi::detailSelesai/$1');
    $routes->get('transaksi/proses', 'Transaksi::tampilanProses');
    $routes->get('transaksi/selesai', 'Transaksi::tampilanSelesai');
    $routes->get('transaksi/pengembalian', 'Transaksi::tampilanPengembalian');
    $routes->post('transaksi/save', 'Transaksi::save');
    $routes->get('transaksi/(:num)', 'Transaksi::detail/$1');
    $routes->get('transaksi/delete/(:num)', 'Transaksi::delete/$1');
    $routes->get('transaksi/konfirmasi/(:num)', 'Transaksi::konfirmasi/$1');
    $routes->post('transaksi/konfirmasi/save', 'Transaksi::save_konfirmasi');
    $routes->get('transaksi/pengembalian/(:num)', 'Transaksi::pengembalian/$1');
    $routes->post('transaksi/proses-pengembalian/(:num)', 'Transaksi::proses_pengembalian/$1');
    $routes->post('transaksi/pengembalian/update/(:num)', 'Transaksi::update_pengembalian/$1');
    $routes->get('transaksi/ulasan/(:num)', 'Transaksi::ulasan/$1');
    $routes->post('transaksi/ulasan/save/(:num)', 'Transaksi::save_ulasan/$1');

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
