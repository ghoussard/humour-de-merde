<?php

namespace App\Controller;

use App\Model\CategoriesModel;
use Core\Helper\BoostrapForm;

class JokesController extends AppController {

    /**
     * Crée une blague
     */
    public function add(): void {
        $categoriesModel = $this->getModel(CategoriesModel::class);
        $categories = $categoriesModel->findList();

        $form = new BoostrapForm($_POST);

        $this->render('jokes.add', compact('form', 'categories'));
    }

}