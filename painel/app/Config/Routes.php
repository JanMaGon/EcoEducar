<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->add('/validate-login', 'Auth::processLogin');
$routes->get('/logout', 'Auth::logout');
$routes->add('/recover-password', 'Auth::recoverPassword');
$routes->get('/encryptar-senha', 'Auth::senha');

$routes->get('/dashboard', 'Dashboard::index');

$routes->get('/posts', 'Posts::index');
$routes->get('/posts/trash', 'Posts::trash');
$routes->get('/posts/delete/(:num)', 'Posts::delete/$1');
$routes->get('/posts/forceDelete/(:num)', 'Posts::forceDelete/$1');
$routes->get('/posts/restore/(:num)', 'Posts::restore/$1');
$routes->get('/posts/create', 'Posts::create');
$routes->add('/posts/create-post', 'Posts::store');
$routes->get('/posts/edit/(:num)', 'Posts::edit/$1');
$routes->post('/posts/update/(:num)', 'Posts::update/$1');
$routes->post('/posts/upload-gallery', 'Posts::uploadGallery');
$routes->post('/posts/remove-gallery-image/(:num)', 'Posts::removeGalleryImage/$1');
