<?php

namespace App\Controller;

use App\Model\CategoriesModel;
use Core\Flash\BootstrapFlash;
use Core\Flash\FlashManager;
use Core\Form\BootstrapForm;
use Core\Form\FormValidator;
use Core\GlobalsManager\GlobalsManager;

class JokesController extends AppController {

    /**
     * Crée une blague
     */
    public function add(): void {
        if(!$this->checkAuth()) {
            $this->notConnected();
            exit();
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
            FlashManager::addFlash(new BootstrapFlash("Votre blague a bien été soumise !", "success"));
        }

        $form = new BootstrapForm(GlobalsManager::get('post'), $formValidator->getErrors());

        $this->renderer->render('jokes.add', compact('form', 'categories'));
    }

}