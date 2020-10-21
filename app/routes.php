<?php

$routes->get('/', 'Home::index');
$routes->get('/test', 'Test::index');


$routes->group('api', function($routes)
{
  
  $routes->get('test', 'Test::index');
    // Equivalent to the following:
  
  $routes->get('users/all',           'UserController::all');
  $routes->get('users/(:segment)',    'UserController::show/$1');
  $routes->post('users',              'UserController::create');
  $routes->put('users/(:segment)',    'UserController::update/$1');
  $routes->delete('users/(:segment)', 'UserController::delete/$1');

});