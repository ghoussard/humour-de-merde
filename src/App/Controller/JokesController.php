<?php

namespace App\Controller;

use App\Model\CategoriesModel;
use App\Model\JokesModel;
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
                if($this->getModel(JokesModel::class)->proposeJoke([
                    'content' => $this->getParsedGlobal('post', 'content'),
                    'user_id' => $this->getParsedGlobal('session', 'Auth')->id,
                    'category_id' => $this->getParsedGlobal('post', 'category')
                ])) {
                    $form->initialize();
                    FlashManager::addFlash(new BootstrapFlash("Votre blague a bien été soumise !", "success"));
                } else {
                    FlashManager::addFlash(new BootstrapFlash("Erreur de l'enregistrement de la blague.", "danger"));
                }

            }
        }

        $this->renderer->render('jokes.add', compact('form', 'categories'));
    }

}