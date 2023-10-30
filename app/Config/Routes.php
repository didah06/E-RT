<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('details_timeline/(:num)', 'Home::details/$1');
$routes->get('get_menu_dapur/(:num)', 'Dapur::get_penilaian/$1');
$routes->put('penilaian_menu_dapur', 'Dapur::set_penilaian');
$routes->get('edit_menu_dapur/(:num)', 'Dapur::penilaian_edit/$1');
$routes->put('penilaian_menu', 'Dapur::penilaian_update');

//Login
$routes->get('/login', 'Login::index');
$routes->post('/login', 'login::prosesLogin');
$routes->get('/logout', 'login::logout');

//Profile
$routes->get('/profile', 'User::profile');
$routes->get('/profile_edit', 'User::profile_edit');
$routes->post('/profile_update', 'User::profile_update');
$routes->post('/change_password', 'User::change_password');
$routes->post('signature', 'User::signature');

// User Pengguna
$routes->get('/user', 'User::index');
$routes->post('/user', 'User::user_save');
$routes->put('/user', 'User::user_update');
$routes->post('/user/delete', 'User::user_delete');
$routes->get('/select_divisi/(:num)', 'User::select_divisi/$1');
$routes->get('/select_departemen/(:num)', 'User::select_departemen/$1');
$routes->get('/select_user/(:segment)', 'User::select_user/$1');
$routes->get('/select_userDept/(:segment)', 'User::select_userDept/$1');
$routes->get('/user_edit/(:num)', 'User::user_edit/$1');
// User RT
// driver
$routes->get('/driver', 'User::driver');
$routes->post('/driver', 'User::driver_save');
$routes->get('/driver_edit/(:num)', 'User::driver_edit/$1');
$routes->put('/driver', 'User::driver_update');
// security
$routes->get('security', 'User::security');
$routes->post('security', 'User::security_save');
$routes->get('/security_edit/(:num)', 'User::security_edit/$1');
$routes->put('security', 'User::security_update');
// user dapur
$routes->get('user_dapur', 'User::user_dapur');
$routes->post('user_dapur', 'User::user_dapur_save');
$routes->get('/user_dapur_edit/(:num)', 'User::user_dapur_edit/$1');
$routes->put('user_dapur', 'User::user_dapur_update');
// user akses
$routes->get('/user_akses', 'User::akses');

// Transportasi
// booking
$routes->resource('transportasi'); // api
$routes->get('/booking', 'Transportasi::booking');
$routes->get('booking_edit/(:num)', 'Transportasi::edit/$1');
$routes->post('transportasi/booking_update', 'Transportasi::update');
$routes->post('transportasi/delete/(:num)', 'Transportasi::delete/$1');
$routes->get('validasi_jadwal/(:segment)/(:segment)/(:segment)', 'Transportasi::validasi_jadwal/$1/$2/$3');
$routes->get('/details/(:num)', 'Transportasi::booking_details/$1');
$routes->post('/details', 'Transportasi::details_save');
$routes->post('approved_kadep/(:num)', 'Transportasi::approved_kadep/$1');
$routes->post('approved_kadiv/(:num)', 'Transportasi::approved_kadiv/$1');
$routes->post('approved_RT/(:num)', 'Transportasi::approved_RT/$1');
$routes->post('unapproved/(:num)', 'Transportasi::unapproved/$1');
$routes->get('select_jadwal_start/(:segment)', 'Transportasi::select_jadwal_start/$1');
$routes->get('select_jadwal_end/(:segment)', 'Transportasi::select_jadwal_end/$1');
// jadwal
$routes->get('/jadwal', 'Transportasi::jadwal');
$routes->get('details_jadwal/(:num)', 'Transportasi::details_jadwal/$1');
$routes->post('jadwal_save', 'Transportasi::jadwal_save');
// record perjalanan
$routes->get('/record', 'Transportasi::record');
// inventaris transport
$routes->get('/inventaris', 'Transportasi::inventaris');
$routes->post('inventaris_save', 'Transportasi::inventaris_save');
$routes->get('inventaris_edit/(:num)', 'Transportasi::inventaris_edit/$1');
$routes->put('/inventaris', 'Transportasi::inventaris_update');
$routes->get('pemeliharaan/(:num)', 'Transportasi::pemeliharaan/$1');
$routes->post('asuransi_save', 'Transportasi::asuransi_save');
$routes->get('asuransi_edit/(:num)', 'Transportasi::asuransi_edit/$1');
$routes->put('asuransi_update', 'Transportasi::asuransi_update');
$routes->post('pajak_save', 'Transportasi::pajak_save');
$routes->get('pajak_edit/(:num)', 'Transportasi::pajak_edit/$1');
$routes->put('pajak_update', 'Transportasi::pajak_update');
$routes->post('steam_save', 'Transportasi::steam_save');
$routes->get('steam_edit/(:num)', 'Transportasi::steam_edit/$1');
$routes->put('steam_update', 'Transportasi::steam_update');
$routes->post('service_save', 'Transportasi::service_save');
$routes->get('service_edit/(:num)', 'Transportasi::service_edit/$1');
$routes->put('service_update', 'Transportasi::service_update');

// Keamanan
$routes->get('laporan', 'Keamanan::laporan');
$routes->post('laporan', 'Keamanan::laporan_save');
$routes->get('laporan_edit/(:num)', 'Keamanan::laporan_edit/$1');
$routes->put('laporan', 'Keamanan::laporan_update');
$routes->get('pengawasan', 'Keamanan::pengawasan');
$routes->post('pengawasan', 'Keamanan::pengawasan_save');
$routes->get('pengawasan_edit/(:num)', 'Keamanan::pengawasan_edit/$1');
$routes->put('pengawasan', 'Keamanan::pengawasan_update');
$routes->resource('keamanan'); // api
$routes->get('informasi_keamanan', 'Keamanan::informasi');
$routes->get('informasi_edit/(:num)', 'Keamanan::informasi_edit/$1');
$routes->get('inventaris_keamanan', 'Keamanan::inventaris');
$routes->post('inventaris_keamanan', 'Keamanan::inventaris_save');
$routes->get('inventaris_keamanan_edit/(:num)', 'Keamanan::inventaris_edit/$1');
$routes->put('inventaris_keamanan', 'Keamanan::inventaris_update');
$routes->delete('inventaris_keamanan', 'Keamanan::inventaris_delete');

//  Dapur
// daftar menu
$routes->get('menu', 'Dapur::index');
$routes->post('menu', 'Dapur::menu_save');
$routes->get('menu_edit/(:num)', 'Dapur::menu_edit/$1');
$routes->put('menu', 'Dapur::menu_update');
$routes->post('menu_delete/(:num)', 'Dapur::delete/$1');
// kebersihan
$routes->get('kebersihan', 'Dapur::kebersihan');
$routes->post('kebersihan', 'Dapur::kebersihan_save');
$routes->get('kebersihan_edit/(:num)', 'Dapur::kebersihan_edit/$1');
$routes->put('kebersihan', 'Dapur::kebersihan_update');
$routes->post('filter_data', 'Dapur::filter_data');
$routes->post('kebersihan_delete', 'Dapur::kebersihan_delete');
// porsi makanan
$routes->get('porsi', 'Dapur::porsi');
$routes->post('porsi', 'Dapur::porsi_save');
$routes->get('porsi_edit/(:num)', 'Dapur::porsi_edit/$1');
$routes->put('porsi', 'Dapur::porsi_update');
$routes->post('porsi_delete', 'Dapur::porsi_delete');
// petugas dapur
$routes->get('petugas', 'Dapur::petugas_dapur');
$routes->get('/select_user/(:segment)', 'Dapur::select_user/$1');
$routes->post('petugas', 'Dapur::petugas_dapur_save');
$routes->get('petugas_edit/(:num)', 'Dapur::petugas_dapur_edit/$1');
$routes->put('petugas', 'Dapur::petugas_dapur_update');
$routes->post('petugas_delete', 'Dapur::petugas_dapur_delete');
// penilaian dan saran
$routes->get('penilaian', 'Dapur::penilaian');
$routes->get('penilaian_get/(:num)', 'Dapur::get_penilaian/$1');
$routes->put('penilaian', 'Dapur::set_penilaian');
$routes->get('penilaian_edit/(:num)', 'Dapur::penilaian_edit/$1');
$routes->put('penilaian_update', 'Dapur::penilaian_update');



// Seragam
$routes->get('seragam', 'Seragam::index');
$routes->post('seragam', 'Seragam::seragam_save');
$routes->get('data_vendor', 'Seragam::data_vendor');
$routes->post('data_vendor', 'Seragam::data_vendor_save');
$routes->get('pemesanan', 'Seragam::pemesanan_seragam');
$routes->post('pemesanan', 'Seragam::pemesanan_save');
$routes->get('update_status/(:num)', 'Seragam::update_status/$1');
$routes->post('update_status', 'Seragam::update_dikirim');
$routes->post('update_diterima', 'Seragam::update_diterima');
$routes->get('persediaan', 'Seragam::persediaan');
$routes->get('pengeluaran/(:num)', 'pengeluaran/$1');
// Fotokopi


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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
