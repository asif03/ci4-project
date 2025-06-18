<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/profile', 'UserController::profile');

$routes->get('/dashboard', 'Dashboard::index');

$routes->group('api', static function ($routes) {

});

$routes->group('applications', static function ($routes) {
    $routes->get('/', 'Application::index');
    $routes->post('fetch-applicants', 'Application::getSearchedApplicants');
    $routes->get('fetch-application/(:num)', 'Application::getApplication/$1');
    $routes->get('edit/(:num)', 'Application::edit/$1');
    $routes->put('update-basic', 'Application::updateBasicInfo');
    $routes->put('update-fcps', 'Application::updateFcpsInfo');
    $routes->put('update-mbbs', 'Application::updateMbbsInfo');
    $routes->put('update-bank', 'Application::updateBankInfo');

    $routes->post('fetch-files', 'Application::getFilesInfo');
    $routes->post('approve-applicant', 'Application::approveApplicant');
    $routes->post('reject-applicant', 'Application::rejectApplicant');

});

$routes->group('bills', ['filter' => 'groups:admin'], static function ($routes) {
    $routes->get('/', 'Honorarium::index', ['as' => 'bills.index']);
    $routes->post('get-statistics', 'Honorarium::getStatistics');
    $routes->post('fetch-honorariums', 'Honorarium::getSearchedHonorariums');
    $routes->post('approve-honorarium', 'Honorarium::approveHonorarium');
    $routes->post('reject-honorarium', 'Honorarium::rejectHonorarium');

    $routes->get('fetch-honorarium/(:num)', 'Honorarium::getHonorarium/$1');
    $routes->get('fetch-honorarium/edit/(:num)', 'Honorarium::getBillInfo/$1');
    $routes->put('update-honorarium/(:num)', 'Honorarium::update/$1');
    $routes->get('download-honorarium-form/(:num)', 'Honorarium::downloadHonorariumForm/$1');

    /*$routes->get('/users', 'Admin::users', ['as' => 'admin.users']);
$routes->get('/users/(:num)', 'Admin::user/$1', ['as' => 'admin.user']);
$routes->get('/roles', 'Admin::roles', ['as' => 'admin.roles']);
$routes->get('/roles/(:num)', 'Admin::role/$1', ['as' => 'admin.role']);
$routes->get('/permissions', 'Admin::permissions', ['as' => 'admin.permissions']);
$routes->get('/permissions/(:num)', 'Admin::permission/$1', ['as' => 'admin.permission']);*/
});

$routes->group('reports', static function ($routes) {
    $routes->get('applications', 'Report::applications');
    $routes->get('bills', 'Report::bills');
    $routes->post('get-bills', 'Report::getBillInfo');
    $routes->post('get-applications', 'Report::getApplicationInfo');
    $routes->post('export-bill-to-excel', 'Report::exportBillToExcel');
    $routes->post('export-application-to-excel', 'Report::exportApplicationToExcel');
});

$routes->group('users', static function ($routes) {
    $routes->get('assign-user-role', 'UserController::assignRoleViewForm');
});

service('auth')->routes($routes);
