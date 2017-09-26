<?php

$routes = [
    'home' => [new \App\Controller\AppController(), 'home'],
    'register' => [new \App\Controller\UsersController(), 'register'],
    'login' => [new \App\Controller\UsersController(), 'login'],
    'logout' => [new \App\Controller\UsersController(), 'logout'],
    'errors.403' => [new \App\Controller\AppController(), 'forbidden'],
    'errors.404' => [new \App\Controller\AppController(), 'notFound'],
    'jokes.add' => [new \App\Controller\JokesController(), 'add']
];