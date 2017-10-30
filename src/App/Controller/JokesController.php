<?php

namespace App\Controller;

use App\Model\CategoriesModel;
use Core\FlashManager\BootstrapFlash;
use Core\FlashManager;
use Core\Form\BootstrapForm;
use Core\Form\FormValidator;

class JokesController extends AppController {

    /**
     * Crée une blague
     */
    public function add(): void {
        if(!$this->checkAuth()) {
            (new ErrorsController())->notConnected();
            exit();
        }

        $categoriesModel = $this->getModel(CategoriesModel::class);
        $categories = $categoriesModel->findList();

        $formValidator = new FormValidator();
        if($this->formSubmitted()) {
            $formValidator = (new FormValidator($this->getParsedGlobal('post')))
                ->lenght('content', 50)
                ->required('category', 'content');
        }

        if($formValidator->isValid()) {
            FlashManager::addFlash(new BootstrapFlash("Votre blague a bien été soumise !", "success"));
        }

        $form = new BootstrapForm($this->getParsedGlobal('post'), $formValidator->getErrors());

        $this->renderer->render('jokes.add', compact('form', 'categories'));
    }

}