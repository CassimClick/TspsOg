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
$routes->setDefaultController('HomePage');
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
$routes->get('/', 'HomePage::index');
//$routes->get('aboutUs', 'HomePage::aboutUs');
$myRoutes = [];
$myRoutes['aboutUs'] = 'Pages::aboutUs';
$myRoutes['preSchool'] = 'Pages::preSchool';
$myRoutes['primarySchool'] = 'Pages::primarySchool';
$myRoutes['secondarySchool'] = 'Pages::secondarySchool';
$myRoutes['journey'] = 'Pages::journey';
$myRoutes['sports'] = 'Pages::sports';
$myRoutes['joiningInstruction'] = 'Pages::joiningInstruction';
$myRoutes['achievements'] = 'Pages::achievements';
$myRoutes['environment'] = 'Pages::environment';
$myRoutes['downloads'] = 'Pages::downloads';
$myRoutes['selfReliance'] = 'Pages::selfReliance';
$myRoutes['nurturing'] = 'Pages::nurturing';
$myRoutes['examinationResults'] = 'Pages::results';

//=================Admin====================
$myRoutes['login'] = 'Auth::login';
$myRoutes['logout'] = 'Auth::logout';
// $myRoutes['logUser'] = 'Auth::logUser';
$myRoutes['register'] = 'Auth::register';
$myRoutes['registerUser'] = 'Auth::registerUser';
$myRoutes['dashBoard'] = 'Admin::dashBoard';
$myRoutes['announcements'] = 'Admin::announcements';
$myRoutes['deleteAnnouncement'] = 'Admin::deleteAnnouncement';
$myRoutes['joining'] = 'Admin::joining';
$myRoutes['deleteJoiningInstruction'] = 'Admin::deleteJoiningInstruction';
$myRoutes['updateAnnouncement'] = 'Admin::updateAnnouncement';
$myRoutes['publishAnnouncement'] = 'Admin::publishAnnouncement';
$myRoutes['viewSingleAnnouncement'] = 'Admin::viewSingleAnnouncement';
$myRoutes['sendFeedback'] = 'Admin::sendFeedback';
$myRoutes['viewFeedback'] = 'Admin::viewFeedback';
$myRoutes['deleteFeedback'] = 'Admin::deleteFeedback';
$myRoutes['fileUpload'] = 'Admin::fileUpload';
$myRoutes['deleteUploadedFile'] = 'Admin::deleteUploadedFile';
$myRoutes['publishResult'] = 'Admin::publishResult';
$myRoutes['publishResult'] = 'Admin::publishResult';
$myRoutes['deleteResult'] = 'Admin::deleteResult';
//=================Events====================
$myRoutes['events'] = 'Events::events';
$myRoutes['allEvents'] = 'Events::allEvents';
$myRoutes['singleEvent/(:num)'] = 'Events::singleEvent/$1';
// $myRoutes['singleEvent'] = 'Events::singleEvent';
$myRoutes['publishEvent'] = 'Events::publishEvent';
$myRoutes['viewSingleEvent'] = 'Events::viewSingleEvent';
$myRoutes['deleteEvent'] = 'Events::deleteEvent';
$myRoutes['updateEvent'] = 'Events::updateEvent';


$myRoutes['results'] = 'Admin::results';


$routes->map($myRoutes);

/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}