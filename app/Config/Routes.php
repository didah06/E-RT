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

//login
$routes->get('/login', 'Login::index');
$routes->post('/login', 'login::prosesLogin');
$routes->get('/logout', 'login::logout');

//profile
$routes->get('/profile', 'User::profile');
$routes->get('/profile_edit', 'User::profile_edit');
$routes->post('/profile_update', 'User::profile_update');
$routes->post('/change_password', 'User::change_password');

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
// security
$routes->get('/security', 'User::security');
//user akses
$routes->get('/user_akses', 'User::akses');

// sistem manajemen
// transportasi
$routes->get('/tp', 'Transportasi::index');
$routes->post('/tp/form', 'Transportasi::form');
$routes->get('/tp/jadwal', 'Transportasi::index/jadwal');
$routes->get('/tp/record_perjalanan', 'Transportasi::record');
$routes->get('/tp/pemeliharaan_kendaraan', 'Transportasi::maintenance');
$routes->get('/tp/inventaris', 'Transportasi::inventaris');

// keamanan
// Dapur
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
