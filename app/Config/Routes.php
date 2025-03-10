<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/profile', 'UserController::profile');

$routes->get('/dashboard', 'Dashboard::index');

$routes->group('applications', static function ($routes) {
    $routes->get('/', 'Application::index');
    $routes->post('fetch-applicants', 'Application::getSearchedApplicants');

});

$routes->group('bills', static function ($routes) {
    $routes->get('/', 'Honorarium::index');
    $routes->get('fetch-honorariums', 'Honorarium::getSearchedHonorariums');
    /*$routes->get('/users', 'Admin::users', ['as' => 'admin.users']);
$routes->get('/users/(:num)', 'Admin::user/$1', ['as' => 'admin.user']);
$routes->get('/roles', 'Admin::roles', ['as' => 'admin.roles']);
$routes->get('/roles/(:num)', 'Admin::role/$1', ['as' => 'admin.role']);
$routes->get('/permissions', 'Admin::permissions', ['as' => 'admin.permissions']);
$routes->get('/permissions/(:num)', 'Admin::permission/$1', ['as' => 'admin.permission']);*/
});
//$routes->get('/honorariums', 'Honorarium::getIndex', ['as' => 'honorariums']);

service('auth')->routes($routes);
