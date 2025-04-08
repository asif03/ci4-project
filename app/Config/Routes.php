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
    $routes->post('fetch-files', 'Application::getFilesInfo');
    $routes->post('approve-applicant', 'Application::approveApplicant');
    $routes->post('reject-applicant', 'Application::rejectApplicant');

});

$routes->group('bills', static function ($routes) {
    $routes->get('/', 'Honorarium::index');
    $routes->post('get-statistics', 'Honorarium::getStatistics');
    $routes->post('fetch-honorariums', 'Honorarium::getSearchedHonorariums');
    $routes->post('approve-honorarium', 'Honorarium::approveHonorarium');
    $routes->post('reject-honorarium', 'Honorarium::rejectHonorarium');

    $routes->get('fetch-honorarium/(:num)', 'Honorarium::getHonorarium/$1');
    $routes->get('fetch-honorarium/edit/(:num)', 'Honorarium::getBillInfo/$1');

    $routes->get('download-honorarium-form', 'Honorarium::downloadHonorariumForm');
    $routes->get('export-excel', 'Honorarium::exportExcel');

    /*$routes->get('/users', 'Admin::users', ['as' => 'admin.users']);
$routes->get('/users/(:num)', 'Admin::user/$1', ['as' => 'admin.user']);
$routes->get('/roles', 'Admin::roles', ['as' => 'admin.roles']);
$routes->get('/roles/(:num)', 'Admin::role/$1', ['as' => 'admin.role']);
$routes->get('/permissions', 'Admin::permissions', ['as' => 'admin.permissions']);
$routes->get('/permissions/(:num)', 'Admin::permission/$1', ['as' => 'admin.permission']);*/
});
//$routes->get('/honorariums', 'Honorarium::getIndex', ['as' => 'honorariums']);

$routes->group('users', static function ($routes) {
    $routes->get('assign-user-role', 'UserController::assignRoleViewForm');
});

service('auth')->routes($routes);
