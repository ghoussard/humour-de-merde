<?php

namespace Core;

use App\App;

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
    protected function render(string $view, array $data = null) {
       $view = str_replace('.', '/', $view);

       if(!is_null($data)) {
           extract($data);
       }

       ob_start();
       require_once $this->viewPath . '/' . $view . '.php';
       $content = ob_get_clean();

       require_once $this->viewPath . '/templates/default.php';
    }

}