<?php

namespace App\Controller;

use App\Model\CategoriesModel;
use Core\Helper\BootstrapForm;
use Core\Helper\FormValidator;
use Core\Helper\GlobalXSSFilter;

class JokesController extends AppController {

    /**
     * Crée une blague
     */
    public function add(): void {
        $categoriesModel = $this->getModel(CategoriesModel::class);
        $categories = $categoriesModel->findList();

        $formValidator = new FormValidator();
        if(!empty(GlobalXSSFilter::get('post'))) {
            $formValidator = (new FormValidator(GlobalXSSFilter::get('post')))
                ->lenght('content', 50)
                ->notEmpty('category', 'content')
                ->required('category', 'content');
        }

        if($formValidator->isValid()) {
            var_dump('
            
            
            enregistré');
        }

        $form = new BootstrapForm(GlobalXSSFilter::get('post'), $formValidator->getErrors());

        $this->render('jokes.add', compact('form', 'categories'));
    }

}