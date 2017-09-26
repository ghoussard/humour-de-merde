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
    public function add(): void {
        $categoriesModel = $this->getModel(CategoriesModel::class);
        $categories = $categoriesModel->findList();

        $formValidator = new FormValidator();
        if(!empty(GlobalsManager::get('post'))) {
            $formValidator = (new FormValidator(GlobalsManager::get('post')))
                ->lenght('content', 50)
                ->required('category', 'content');
        }

        if($formValidator->isValid()) {
            //TODO: save in database
        }

        $form = new BootstrapForm(GlobalsManager::get('post'), $formValidator->getErrors());

        $this->render('jokes.add', compact('form', 'categories'));
    }

}