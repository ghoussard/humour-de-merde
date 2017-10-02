<?php

namespace App\Controller;

use App\App;
use Core\Auth\AuthException;
use Core\Auth\DatabaseAuth;
use Core\Controller;
use Core\GlobalsManager;
use Core\Model;

class AppController extends Controller {

    public function __construct() {
        $this->viewPath = (App::getInstance())->getConfig('viewPath');
    }


    /**
     * Retourne un model
     * @param $classname
     * @return mixed
     */
    protected function getModel($classname): Model {
        return new $classname((App::getInstance())->getDatabase());
    }


    /**
     * Vérifie si l'utilisateur est connecté
     * @return bool
     * @throws AuthException
     */
    protected function checkAuth() {
        $user = GlobalsManager::get('session', 'Auth');
        if(is_null($user)) {
            return false;
        }

        if(!isset($user->authType)) {
            throw new AuthException("User auth type does'nt defined");
        }

        switch ($user->authType) {
            case "database":
                $auth = new DatabaseAuth(App::getInstance()->getDatabase());
                break;
            default:
                throw new AuthException("User auth type is'nt correct");
                break;
        }

        return $auth->checkLogin($user->login, $user->password);
    }


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