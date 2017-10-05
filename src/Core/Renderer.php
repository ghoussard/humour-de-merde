<?php

namespace Core;

use Core\Flash\FlashManager;

class Renderer {

    /**
     * @var string
     */
    private $viewPath;


    /**
     * @var string
     */
    private $templateDir;


    /**
     * @var Config
     */
    private $config;


    /**
     * @var Router
     */
    private $router;


    /**
     * Renderer constructor.
     * @param string $viewPath
     * @param string $templateDir
     * @param Config $config
     * @param Router $router
     */
    public function __construct(string $viewPath, string $templateDir, Config $config, Router $router) {
        $this->viewPath = $viewPath;
        $this->templateDir = $templateDir;
        $this->config = $config;
        $this->router = $router;
    }


    /**
     * Rend une vue
     * @param string $view
     * @param array|null $vars
     */
    public function render(string $view, array $vars = null): void {
        $view = str_replace('.', '/', $view);

        if(!is_null($vars)) {
            extract($vars);
        }

        ob_start();
        echo FlashManager::getFlash();
        require_once $this->viewPath . '/' . $view . '.php';
        $content = ob_get_clean();

        require_once $this->viewPath . $this->templateDir . '/default.php';
    }


    /**
     * Génère une url
     * @param string $route
     * @param int|null $id
     * @param int|null $page
     * @return string
     */
    private function url(string $route, ?int $id = null, ?int $page = null): string {
        return $this->router->generateUrl($route, $id, $page);
    }


    /**
     * Rend une clé de la config
     * @param null|string $key
     * @return string
     */
    private function getConfig(string $key): string {
        return $this->config->get($key);
    }

}