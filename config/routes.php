<?php

$routes = [
    'app.home' => ['accueil', [\App\Controller\AppController::class, 'home']],
    'users.register' => ['inscription', [\App\Controller\UsersController::class, 'register']],
    'users.login' => ['connexion', [\App\Controller\UsersController::class, 'login']],
    'users.logout' => ['deconnexion', [\App\Controller\UsersController::class, 'logout']],
    'app.errors.404' => ['404', [\App\Controller\AppController::class, 'notFound']],
    'jokes.add' => ['blagues.proposer', [\App\Controller\JokesController::class, 'add']]
];