<?php

namespace Core;

use App\App;
use Core\Helper\GlobalsManager;

class Controller {

    /**
     * @var $string
     */
    private $viewPath;


    public function __construct() {
        $this->viewPath = (App::getInstance())->getConfig('viewPath');
    }


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
     * Retourne un model
     * @param $classname
     * @return mixed
     */
    protected function getModel($classname): Model {
        return new $classname((App::getInstance())->getDatabase());
    }


    /**
     * Vérifie si l'utilisateur est connecté
     * @return bool
     */
    protected function checkAuth(): bool {
        $auth = GlobalsManager::get('session', 'Auth');
        if(is_null($auth)) {
            return false;
        }

        return $auth->checkLogin($auth->login, $auth->password);
    }


    /**
     * Vérifie si un formulaire a été soumis
     * @return bool
     */
    protected function formSubmitted(): bool {
        return !empty(GlobalsManager::get('post'));
    }

}