<?php

$routes->get('/', 'Home::index');
$routes->get('/test', 'Test::index');
$routes->get('/bechmark', 'Test::bechmark');


$routes->group('api', function($routes)
{
  
  $routes->get('test', 'Test::index');
    // Equivalent to the following:
  
  $routes->get('users/all',           'UserController::all');
  $routes->get('users/(:segment)',    'UserController::show/$1');
  $routes->post('users',              'UserController::create');
  $routes->put('users/(:segment)',    'UserController::update/$1');
  $routes->delete('users/(:segment)', 'UserController::delete/$1');



  $routes->get('posts/all',           'PostController::all');
  $routes->get('posts/(:segment)',    'PostController::show/$1');
  $routes->post('posts',              'PostController::create');
  $routes->put('posts/(:segment)',    'PostController::update/$1');
  $routes->delete('posts/(:segment)', 'PostController::delete/$1');



  $routes->get('taxonomys/all',           'TaxonomyController::all');
  $routes->get('taxonomys/(:segment)',    'TaxonomyController::show/$1');
  $routes->post('taxonomys',              'TaxonomyController::create');
  $routes->put('taxonomys/(:segment)',    'TaxonomyController::update/$1');
  $routes->delete('taxonomys/(:segment)', 'TaxonomyController::delete/$1');


  $routes->get('terms/all',           'TermController::all');
  $routes->get('terms/(:segment)',    'TermController::show/$1');
  $routes->post('terms',              'TermController::create');
  $routes->put('terms/(:segment)',    'TermController::update/$1');
  $routes->delete('terms/(:segment)', 'TermController::delete/$1');

});