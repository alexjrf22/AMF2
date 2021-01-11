<?php

$router = new ALEX\Router;

$router['/'] = [
    'class'  => App\Controllers\UsersController::class,
    'action' => 'index'
];

$router['/registro'] = [
    'class'   => App\Controllers\UsersController::class,
    'action'  => 'create'
];

$router['/produtos'] = [
    'class'   => App\Controllers\ProductsController::class,
    'action'  => 'index'
];


return $router;