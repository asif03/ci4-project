<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/dashboard', 'Dashboard::index');

$routes->get('/honorariums', 'Honorarium::getIndex');
$routes->get('/fetch-honorariums', 'Honorarium::getSearchedHonorariums');

service('auth')->routes($routes);
