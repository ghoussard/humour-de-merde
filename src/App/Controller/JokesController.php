<?php

namespace App\Controller;

use App\Model\CategoriesModel;
use Core\Helper\BootstrapForm;
use Core\Helper\FormValidator;

class JokesController extends AppController {

    /**
     * Crée une blague
     */
    public function add(): void {
        $categoriesModel = $this->getModel(CategoriesModel::class);
        $categories = $categoriesModel->findList();

        $formValidator = new FormValidator();
        if(isset($_POST)&&!empty($_POST)) {
            $formValidator = (new FormValidator($_POST))
                ->lenght('content', 50)
                ->notEmpty('category', 'content')
                ->required('category', 'content');
        }

        if($formValidator->isValid()) {
            var_dump('
            
            
            enregistré');
        }

        $form = new BootstrapForm($_POST, $formValidator->getErrors());

        $this->render('jokes.add', compact('form', 'categories'));
    }

}