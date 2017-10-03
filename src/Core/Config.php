<?php

namespace Core;

class Config {

    private $config = [];


    private $routes = [];


    public function __construct(string $configFile, string $routesFile) {
        require $configFile;
        $this->config = $config;
        require $routesFile;
        $this->routes = $routes;
    }


    public function get(string $key = null) {
        if(isset($this->config[$key])) {
            return $this->config[$key];
        }
        return null;
    }


    public function getRoutes(): array {
        return $this->routes;
    }

}