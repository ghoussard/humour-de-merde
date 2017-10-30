<?php

namespace App\Controller;

use App\Model\CategoriesModel;
use Core\FlashManager\BootstrapFlash;
use Core\FlashManager;
use Core\Form\BootstrapForm;

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

        $form = new BootstrapForm($this->getParsedGlobal('post'));

        if($this->formSubmitted()) {
            $form->getValidator()
                ->lenght('content', 50)
                ->required ('category', 'content');

            if($form->isValid()) {
                //TODO: implémenter l'enregistrement d'une blague
                $form->initialize();
                FlashManager::addFlash(new BootstrapFlash("Votre blague a bien été soumise !", "success"));
            }
        }

        $this->renderer->render('jokes.add', compact('form', 'categories'));
    }

}