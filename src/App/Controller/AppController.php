<?php

namespace App\Controller;

use App\App;
use Core\Auth\AuthException;
use Core\Auth\DatabaseAuth;
use Core\Controller;
use Core\GlobalsManager;
use Core\Renderer;

class AppController extends Controller {

    use GlobalsManager;

    /**
     * AppController constructor.
     */
    public function __construct() {
        $this->router = App::getInstance()->getRouter();
        $this->renderer = new Renderer(
            ROOT . '/src/App/views',
            '/templates',
            App::getInstance()->getConfig(),
            $this->router
        );
    }


    /**
     * Affiche la page d'acceuil
     */
    public function home(): void {
        $this->renderer->render('app.home');
    }


    /**
     * Vérifie si l'utilisateur est connecté
     * @return bool
     * @throws AuthException
     */
    protected function checkAuth(): bool {
        $user = $this->getParsedGlobal('session', 'Auth');
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

        return !is_null($auth->checkLogin($user->login, $user->password));
    }


    /**
     * Vérifie si un formulaire a été soumis
     * @return bool
     */
    protected function formSubmitted(): bool {
        return !empty($this->getParsedGlobal('post'));
    }

}