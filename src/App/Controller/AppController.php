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

}