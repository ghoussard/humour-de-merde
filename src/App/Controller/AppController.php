<?php

namespace App\Controller;

use Core\Controller;

class AppController extends Controller {

    public function home() {
        $this->render('app.home');
    }

}