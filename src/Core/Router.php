<?php

namespace Core;

class Router {

    /**
     * @var array
     */
    private $routes = [];


    /**
     * Ajoute une route au Router
     * @param string $route
     * @param callable $callable
     */
    public function addRoute(string $route, callable $callable): void {
        $this->routes[$route] = $callable;
    }


    /**
     * Teste une route
     * @param string $route
     */
    public function match(string $route): void {
        if(isset($this->routes[$route])) {
            call_user_func($this->routes[$route]);
        } else {
            $this->notFound();
        }
    }


    /**
     * Renvoie vers une erreur 404
     */
    private function notFound(): void {
        header('Location:?p=errors.404');
    }

}