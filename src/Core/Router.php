<?php

namespace Core;

use Core\Router\RouterException;

class Router {

    /**
     * @var array
     */
    private $routes = [];


    /**
     * Ajoute une route
     * @param string $path
     * @param string $route
     */
    public function addRoute(string $path, string $route): void {
        $this->routes[$path] = $route;
    }


    /**
     * Teste une route
     * @param string $path
     */
    public function match(?string $path): void {
        if(is_null($path)||empty($path)) {
            $path = array_keys($this->routes)[0];
        }

        if(!array_key_exists($path, $this->routes)) {
            $this->notFound();
            exit();
        }

        $action = $this->routes[$path];

        $action = explode('.', $action);

        if($action[0]==='admin') {
            $controller = $controller = '\\App\\Controller\\Admin\\'.ucfirst($action[1]).'Controller';
            $method = $action[2];
        } else {
            $controller = '\\App\\Controller\\'.ucfirst($action[0]).'Controller';
            $method = $action[1];
        }

        $controller = new $controller();
        $controller->$method();
    }


    /**
     * Fait une redirection
     * @param string $route
     * @param int|null $id
     * @param int|null $page
     */
    public function redirect(string $route, ?int $id = null, ?int $page = null): void {
        $url = $this->generateUrl($route, $id, $page);
        header("Location:{$url}");
        exit();
    }


    /**
     * Génère une url
     * @param string $route
     * @param int|null $id
     * @param int|null $page
     * @return string
     * @throws RouterException
     */
    public function generateUrl(string $route, ?int $id = null, ?int $page = null): string {
        $path = array_search($route, $this->routes);

        if(!$path) {
            throw new RouterException("This route doesn't exists");
        }

        $url = '?p=' . $path;

        if($id) {
            $url .= "&id={$id}";
        }

        if($page) {
            $url .= "&page={$page}";
        }

        return $url;
    }


    /**
     * Renvoie vers une erreur 404
     */
    private function notFound(): void {
        $this->redirect('errors.notFound');
    }

}