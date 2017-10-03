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
     * @param string $path
     * @param array $controller
     * @internal param callable $callable
     */
    public function addRoute(string $route, string $path, array $controller): void {
        $this->routes[$route] = [$path, $controller];
    }


    /**
     * Teste une route
     * @param string $path
     * @internal param string $route
     */
    public function match(?string $path): void {
        if(!is_null($path)&&!empty($path)) {
            $paths = array_column($this->routes, 0);

            if(in_array($path, $paths)) {
                foreach ($this->routes as $key => $route) {
                    if($route[0] === $path) {
                        $route = $key;
                        break;
                    }
                }
            } else {
                $this->notFound();
            }

        } else {
            $route = array_keys($this->routes)[0];
        }

        $controller = $this->routes[$route][1][0];
        $controller = new $controller();
        $controller($this->routes[$route][1][1]);
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
     */
    public function generateUrl(string $route, ?int $id = null, ?int $page = null): string {
        $url = '?p=' . $this->routes[$route][0];

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
        $this->redirect('app.errors.404');
    }

}