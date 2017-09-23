<?php

$routes = [
    'home' => [new \App\Controller\AppController(), 'home'],
    'errors.404' => [new \App\Controller\AppController(), 'notFound']
];