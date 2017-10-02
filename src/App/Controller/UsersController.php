<?php

namespace App\Controller;

use App\App;
use App\Model\UsersModel;
use Core\Auth\Auth;
use Core\Auth\DatabaseAuth;
use Core\Flash\BootstrapFlash;
use Core\FlashManager;
use Core\Form\BootstrapForm;
use Core\Form\FormValidator;
use Core\GlobalsManager;

class UsersController extends AppController {

    /**
     * Connecte un utilisateur
     */
    public function login() {
        if($this->formSubmitted()) {
            $auth = new DatabaseAuth(App::getInstance()->getDatabase());
            if($auth->login(
                GlobalsManager::get('post', 'login'),
                GlobalsManager::get('post', 'password')
            )) {
                FlashManager::addFlash(new BootstrapFlash('Connexion réussie', 'success'));
                $this->router->redirect('home');
            } else {
                FlashManager::addFlash(new BootstrapFlash('Erreur de la connexion', 'danger'));
            }
        }

        if($this->checkAuth()) {
            return $this->alreadyLogin();
        }

        $form = new BootstrapForm(GlobalsManager::get('post'));

        $this->render('users.login', compact('form'));
    }


    /**
     * Enregistre un utilisateur
     */
    public function register() {
        if($this->checkAuth()) {
            return $this->alreadyLogin();
        }

        $formValidator = new FormValidator();
        if($this->formSubmitted()) {
            $formValidator = (new FormValidator(GlobalsManager::get('post')))
                ->lenght('login', 2, 12)
                ->equals(['password' => 'confirm_password', 'mail' => 'confirm_mail'])
                ->required('login', 'mail', 'confirm_mail', 'password', 'confirm_password');
        }

        if($formValidator->isValid()) {
            $params = [
                'login' => GlobalsManager::get('post', 'login'),
                'password' => GlobalsManager::get('post', 'password'),
                'mail' => GlobalsManager::get('post', 'mail'),
                'firstname' => GlobalsManager::get('post', 'firstname'),
                'lastname' => GlobalsManager::get('post', 'lastname'),
                'birthdate' => (new \DateTime(GlobalsManager::get('post', 'birthdate')))->format('Y-m-d H:i:s')
            ];
            if($this->getModel(UsersModel::class)->register($params)) {
                FlashManager::addFlash(new BootstrapFlash('Inscription réussie, vous pouvez désormais vous connectez', 'success'));
                $this->router->redirect('login');
            } else {
                FlashManager::addFlash(new BootstrapFlash("Erreur de l'enregistrement", 'danger'));
            }
        }

        $form = new BootstrapForm(GlobalsManager::get('post'), $formValidator->getErrors());

        $this->render('users.register', compact('form'));
    }


    /**
     * Déconnecte l'utlisateur
     */
    public function logout() {
        if($this->checkAuth()) {
            Auth::logout();
            FlashManager::addFlash(new BootstrapFlash('Déconnexion réussie', 'success'));
            $this->router->redirect('home');
        } else {
            $this->notConnected();
        }
    }


    /**
     * Vérifie si l'utilisateur est déjà connecté
     */
    private function alreadyLogin() {
        $this->render('users.errors.alreadyLogin');
    }

}
