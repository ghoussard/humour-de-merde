<?php

$routes = [
    'home' => [new \App\Controller\AppController(), 'home'],
    'errors.404' => [new \App\Controller\AppController(), 'notFound'],
    'jokes.add' => [new \App\Controller\JokesController(), 'add'],
    'user.login' => [new \App\Controller\UserController(), 'login'],
    'user.register' => [new \App\Controller\UserController(), 'register']
];