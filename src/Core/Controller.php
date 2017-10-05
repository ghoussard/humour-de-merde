<?php

namespace Core;

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
     * @param string $method
     */
    public function __invoke(string $method) {
        $this->$method();
    }

}