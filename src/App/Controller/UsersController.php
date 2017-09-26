<?php

namespace App\Controller;

use App\App;
use Core\Auth\DatabaseAuth;
use Core\Helper\BootstrapForm;
use Core\Helper\FormValidator;
use Core\Helper\GlobalsManager;

class UsersController extends AppController {

    /**
     * Connecte un utilisateur
     */
    public function login(): void {
        $form = new BootstrapForm(GlobalsManager::get('post'));

        $auth = new DatabaseAuth(App::getInstance()->getDatabase());
        if($auth->login(
            GlobalsManager::get('post', 'login'),
            GlobalsManager::get('post', 'password')
        )) {
            //TODO: Générer un message flash et rediriger sur la page d'acceuil
        }

        $this->render('user.login', compact('form'));
    }


    /**
     * Enregistre un utilisateur
     */
    public function register(): void {
        $formValidator = new FormValidator();
        if(!empty(GlobalsManager::get('post'))) {
            $formValidator = (new FormValidator(GlobalsManager::get('post')))
                ->lenght('login', 2, 12)
                ->equals(['password' => 'confirm_password', 'mail' => 'confirm_mail'])
                ->required('login', 'mail', 'confirm_mail', 'password', 'confirm_password');
        }

        if($formValidator->isValid()) {
            $auth = new DatabaseAuth(App::getInstance()->getDatabase());
            $params = [
                'login' => GlobalsManager::get('post', 'login'),
                'password' => GlobalsManager::get('post', 'password'),
                'mail' => GlobalsManager::get('post', 'mail'),
                'firstname' => GlobalsManager::get('post', 'firstname'),
                'lastname' => GlobalsManager::get('post', 'lastname'),
                'birthdate' => (new \DateTime(GlobalsManager::get('post', 'birthdate')))->format('Y-m-d H:i:s')
            ];
            if($auth->register($params)) {
                //TODO: Générer un message flash et rediriger sur la page de login
            } else {
                //TODO: Générer un message flash d'erreur
            }
        }

        $form = new BootstrapForm(GlobalsManager::get('post'), $formValidator->getErrors());

        $this->render('user.register', compact('form'));
    }
}