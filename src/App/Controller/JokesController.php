<?php

namespace App\Controller;

use App\Model\CategoriesModel;
use Core\Helper\BootstrapForm;
use Core\Helper\FormValidator;
use Core\Helper\GlobalsManager;

class JokesController extends AppController {

    /**
     * Crée une blague
     */
    public function add() {
        if(!$this->checkAuth()) {
            return $this->notConnected();
        }

        $categoriesModel = $this->getModel(CategoriesModel::class);
        $categories = $categoriesModel->findList();

        $formValidator = new FormValidator();
        if($this->formSubmitted()) {
            $formValidator = (new FormValidator(GlobalsManager::get('post')))
                ->lenght('content', 50)
                ->required('category', 'content');
        }

        if($formValidator->isValid()) {
            //TODO: sauvegarder les données en bdd et génerer un message flash
        }

        $form = new BootstrapForm(GlobalsManager::get('post'), $formValidator->getErrors());

        $this->render('jokes.add', compact('form', 'categories'));
    }

}