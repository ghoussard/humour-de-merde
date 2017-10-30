<?php

namespace Core;

use App\App;

class Controller {

    /**
     * @var Renderer
     */
    protected $renderer;


    /**
     * @var Router
     */
    protected $router;


    /**
     * Retourne un model
     * @param $classname
     * @return mixed
     */
    protected function getModel($classname): Model {
        return new $classname(App::getInstance()->getDatabase());
    }
}