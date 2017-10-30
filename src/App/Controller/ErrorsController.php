<?php

namespace App\Controller;

class ErrorsController extends AppController {

    /**
     * Emet une erreur 404
     */
    public function notFound(): void {
        header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
        $this->renderer->render('errors.notFound');
    }


    /**
     * Emet une erreur de défaut de connexion
     */
    public function notConnected(): void {
        $this->renderer->render('errors.notConnected');
    }


    /**
     * Informe que l'utilisateur est déjà connecté
     */
    public function alreadyLogin(): void {
        $this->renderer->render('errors.alreadyLogin');
    }

}