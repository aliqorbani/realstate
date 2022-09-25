<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH.'Config/Routes.php')) {
    require SYSTEMPATH.'Config/Routes.php';
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
$routes->get('/', 'Home::index',['as'=>'front-page']);
$routes->get('property/(:num)', 'Home::show/$1', ['as' => 'single-property']);

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
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], static function ($routes) {
    $routes->get('/', 'Dashboard::index', ['as' => 'admin-dashboard']);
    $routes->post('upload-gallery-items','UploadController::uploadGalleryItems',['as'=>'admin-upload-gallery-items']);
//    $routes->post('property-gallery-items/(:num)','UploadController::uploadGalleryItems',['as'=>'admin-upload-gallery-items']);
//    $routes->post('property-gallery-items/(:num)','PropertyController::getPropertyGalleryItems/$1',['as'=>'admin-property-gallery-items']);
    $routes->group('property', ['namespace' => 'App\Controllers\Admin'], static function ($routes) {
        $routes->get('', 'PropertyController::index', ['as' => 'admin-property-index']);
        $routes->get('new', 'PropertyController::create', ['as' => 'admin-property-new']);
        $routes->post('store', 'PropertyController::store', ['as' => 'admin-property-store']);
        $routes->get('(:num)/gallery-items', 'PropertyController::getPropertyGalleryItems/$1', ['as' => 'admin-property-gallery-items']);
        $routes->get('(:num)/edit', 'PropertyController::show/$1', ['as' => 'admin-property-show']);
        $routes->post('(:num)/update', 'PropertyController::update/$1', ['as' => 'admin-property-update']);
        $routes->get('(:num)/delete', 'PropertyController::delete/$1', ['as' => 'admin-property-delete']);
    });
    $routes->group('property-types', ['namespace' => 'App\Controllers\Admin'], static function ($routes) {
        $routes->get('', 'PropertyTypeController::index', ['as' => 'admin-property-types-index']);
        $routes->get('new', 'PropertyTypeController::create', ['as' => 'admin-property-types-new']);
        $routes->post('store', 'PropertyTypeController::store', ['as' => 'admin-property-types-store']);
        $routes->get('(:num)/edit', 'PropertyTypeController::show/$1', ['as' => 'admin-property-types-show']);
        $routes->post('(:num)/update', 'PropertyTypeController::update/$1', ['as' => 'admin-property-types-update']);
        $routes->get('(:num)/delete', 'PropertyTypeController::delete/$1', ['as' => 'admin-property-types-delete']);
    });
    $routes->group('groups', ['namespace' => 'App\Controllers\Admin'], static function ($routes) {
        $routes->get('', 'PropertyTypeController::index', ['as' => 'admin-property-types-index']);
        $routes->get('new', 'PropertyTypeController::create', ['as' => 'admin-property-types-new']);
        $routes->post('store', 'PropertyTypeController::store', ['as' => 'admin-property-types-store']);
        $routes->get('(:num)/edit', 'PropertyTypeController::show/$1', ['as' => 'admin-property-types-show']);
        $routes->post('(:num)/update', 'PropertyTypeController::update/$1', ['as' => 'admin-property-types-update']);
        $routes->get('(:num)/delete', 'PropertyTypeController::delete/$1', ['as' => 'admin-property-types-delete']);
    });
});


if (is_file(APPPATH.'Config/'.ENVIRONMENT.'/Routes.php')) {
    require APPPATH.'Config/'.ENVIRONMENT.'/Routes.php';
}
