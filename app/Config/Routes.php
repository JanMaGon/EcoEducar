<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/sobre-o-projeto', 'Pages::sobreOProjeto');
$routes->get('/locais-de-descarte', 'Pages::locaisDeDescarte');
$routes->get('/participe', 'Pages::participe');
$routes->get('/blog', 'Blog::index');
$routes->get('/blog/post/(:num)/(:any)', 'Blog::post/$1');
