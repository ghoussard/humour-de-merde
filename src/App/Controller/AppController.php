<?php

namespace App\Controller;

use Core\Controller;

class AppController extends Controller {

    /**
     * Affiche la page d'acceuil
     */
    public function home() {
        $this->render('app.home');
    }


    /**
     * Emet une erreur 404
     */
    public function notFound() {
        $this->render('app.errors.404');
    }


    /**
     * Emet une erreur 403
     */
    public function forbidden() {
        $this->render('app.errors.403');
    }


    /**
     * Emet une erreur de défaut de connexion
     */
    public function notConnected() {
        $this->render('app.errors.notConnected');
    }

}