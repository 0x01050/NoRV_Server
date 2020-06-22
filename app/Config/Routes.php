<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
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

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}


/**
 * Custom Routing Hanlder
 */

$routes->post('machine', 'Machine::create');									// New Machine
$routes->post('machine/(:segment)', 'Machine::update/$1');						// Update Machine
$routes->get('machine/master/(:segment)', 'Machine::getMachine/master/$1');		// Get Machine From Master
$routes->get('machine/slave/(:segment)', 'Machine::getMachine/slave/$1');		// Get Master From Slave

$routes->post('status', 'Status::search');										// Search Machines on Base With Status Filter
$routes->get('status/(:segment)', 'Status::getById/$1');						// Get Machine Status By Id
$routes->get('status/obs/(:segment)', 'Status::getOBSActivity/$1');				// Get OBS Activity By Id
$routes->post('status/master', 'Status::reportMaster');							// Report Master Status
$routes->post('status/slave', 'Status::reportSlave');							// Report Slave Status
$routes->post('status/obs', 'Status::reportOBS');								// Report OBS Status

$routes->post('info', 'Info::update');											// Update Info
$routes->get('info', 'Info::retrieve');											// Get Info