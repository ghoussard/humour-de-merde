<?php

namespace Core;

class Controller {

    /**
     * @var $string
     */
    protected $viewPath;


    /**
     * Rends une vue
     * @param string $view
     * @param array|null $data
     */
    protected function render(string $view, array $data = null): void {
       $view = str_replace('.', '/', $view);

       if(!is_null($data)) {
           extract($data);
       }

       ob_start();
       echo FlashManager::getFlash();
       require_once $this->viewPath . '/' . $view . '.php';
       $content = ob_get_clean();

       require_once $this->viewPath . '/templates/default.php';
    }


    /**
     * Vérifie si un formulaire a été soumis
     * @return bool
     */
    protected function formSubmitted(): bool {
        return !empty(GlobalsManager::get('post'));
    }

}