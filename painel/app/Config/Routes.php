<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->add('/validate-login', 'Auth::processLogin');
$routes->add('/recover-password', 'Auth::recoverPassword');
$routes->get('/encryptar-senha', 'Auth::senha');

$routes->get('/dashboard', 'Dashboard::index');