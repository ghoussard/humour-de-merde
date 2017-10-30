<?php

namespace App\Controller;

use App\App;
use App\Model\UsersModel;
use Core\Auth;
use Core\Auth\DatabaseAuth;
use Core\FlashManager;
use Core\FlashManager\BootstrapFlash;
use Core\Form\BootstrapForm;

class UsersController extends AppController {

    /**
     * Connecte un utilisateur
     */
    public function login(): void {
        if($this->checkAuth()) {
            (new ErrorsController())->alreadyLogin();
            exit();
        }

        $form = new BootstrapForm($this->getParsedGlobal('post'));

        if($this->formSubmitted()) {
            $auth = new DatabaseAuth(App::getInstance()->getDatabase());
            if($auth->login(
                $this->getParsedGlobal('post', 'login'),
                $this->getParsedGlobal('post', 'password')
            )) {
                FlashManager::addFlash(new BootstrapFlash('Connexion réussie', 'success'));
                $this->router->redirect('app.home');
            } else {
                FlashManager::addFlash(new BootstrapFlash('Erreur de la connexion', 'danger'));
            }
        }

        $this->renderer->render('users.login', compact('form'));
    }


    /**
     * Enregistre un utilisateur
     */
    public function register(): void {
        if($this->checkAuth()) {
            (new ErrorsController())->alreadyLogin();
            exit();
        }

        $form = new BootstrapForm($this->getParsedGlobal('post'));

        if($this->formSubmitted()) {
            $form->getValidator()
                ->lenght('login', 2, 12)
                ->equals(['password' => 'confirm_password', 'mail' => 'confirm_mail'])
                ->required('login', 'mail', 'confirm_mail', 'password', 'confirm_password');

            if($form->isValid()) {
                $params = [
                    'login' => $this->getParsedGlobal('post', 'login'),
                    'password' => $this->getParsedGlobal('post', 'password'),
                    'mail' => $this->getParsedGlobal('post', 'mail'),
                    'lastname' => $this->getParsedGlobal('post', 'lastname'),
                    'firstname' => $this->getParsedGlobal('post', 'firstname'),
                    'birthdate' => (new \DateTime($this->getParsedGlobal('post', 'birthdate')))->format('Y-m-d H:i:s')
                ];
                if($this->getModel(UsersModel::class)->register($params)) {
                    FlashManager::addFlash(new BootstrapFlash('Inscription réussie, vous pouvez désormais vous connectez', 'success'));
                    $this->router->redirect('users.login');
                } else {
                    FlashManager::addFlash(new BootstrapFlash("Erreur de l'enregistrement", 'danger'));
                }
            }
        }

        $this->renderer->render('users.register', compact('form'));
    }


    /**
     * Déconnecte l'utlisateur
     */
    public function logout(): void {
        if($this->checkAuth()) {
            Auth::logout();
            FlashManager::addFlash(new BootstrapFlash('Déconnexion réussie', 'success'));
            $this->router->redirect('app.home');
        } else {
            (new ErrorsController())->notConnected();
        }
    }

}
