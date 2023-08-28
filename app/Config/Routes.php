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
$routes->setAutoRoute(true);

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
$routes->get('/user', 'User::index');
$routes->get('/user/profile_edit', 'User::profile_edit');
$routes->post('/user/profile_update', 'User::profile_update');
$routes->post('/user/change_password', 'User::change_password');
// user pengguna
// security
$routes->get('/user/security', 'User::user_security');
// OB
$routes->get('/user/OB', 'User::user_officeBoy');
// driver
$routes->get('/user/driver', 'User::user_driver');


//user akses
$routes->get('/user_akses', 'User::akses');


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
