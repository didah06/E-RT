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

//login
$routes->get('/login', 'Login::index');
$routes->post('/login', 'login::prosesLogin');
$routes->get('/logout', 'login::logout');

//profile
$routes->get('/profile', 'User::profile');
$routes->get('/profile_edit', 'User::profile_edit');
$routes->post('/profile_update', 'User::profile_update');
$routes->post('/change_password', 'User::change_password');
$routes->post('signature', 'User::signature');

// user pengguna
$routes->get('/user', 'User::index');
$routes->post('/user', 'User::user_save');
$routes->put('/user', 'User::user_update');
$routes->post('/user/delete', 'User::user_delete');
$routes->get('/select_divisi/(:num)', 'User::select_divisi/$1');
$routes->get('/select_departemen/(:num)', 'User::select_departemen/$1');
$routes->get('/select_user/(:segment)', 'User::select_user/$1');
$routes->get('/select_userDept/(:segment)', 'User::select_userDept/$1');
$routes->get('/user_edit/(:num)', 'User::user_edit/$1');
// user rumah tangga
// driver
$routes->get('/driver', 'User::driver');
$routes->post('/driver', 'User::driver_save');
$routes->put('/driver', 'User::driver_update');
// security
$routes->get('security', 'User::security');
$routes->post('security', 'User::security_save');
$routes->put('security', 'User::security_update');
// user akses
$routes->get('/user_akses', 'User::akses');

// transportasi
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

// keamanan
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

// Dapur
$routes->get('menu', 'Dapur::index');
$routes->post('menu', 'Dapur::menu_save');
$routes->get('menu_edit/(:num)', 'Dapur::menu_edit/$1');
$routes->put('menu', 'Dapur::menu_update');
$routes->delete('menu_delete', 'Dapur::menu_delete');
// Seragam
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
