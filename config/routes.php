<?php

$routes = [
    'home' => [new \App\Controller\AppController(), 'home'],
    'login' => [new \App\Controller\UsersController(), 'login'],
    'register' => [new \App\Controller\UsersController(), 'register'],
    'errors.404' => [new \App\Controller\AppController(), 'notFound'],
    'jokes.add' => [new \App\Controller\JokesController(), 'add']
];