<?php

namespace App;

use Core\Database;
use Core\Router;

class App {

    /**
     * @var App
     */
    private static $_instance;


    /**
     * @var string[]
     */
    private $config = [];


    /**
     * @var Database
     */
    private $db;


    /**
     * @var Router
     */
    private $router;


    /**
     * Retourne l'instance de l'application
     * @return App
     */
    public static function getInstance(): App {
        if(!is_null(self::$_instance)) {
            return self::$_instance;
        }
        return self::$_instance = new App();
    }


    private function __construct()
    {
        require_once ROOT . '/config/config.php';
        $this->config = $config;

        $this->router = new Router();
    }


    /**
     * Lance l'application
     */
    public function run(): void {
        $this->initRouter();

        if(isset($_GET['p'])) {
            $page = $_GET['p'];
        } else {
            $page = 'home';
        }

        $this->router->match($page);
    }


    /**
     * Retourne la configuration de l'application
     * @param string $key
     * @return string|null
     */
    public function getConfig(string $key): ?string
    {
        if(array_key_exists($key, $this->config)) {
            return $this->config[$key];
        }
        return null;
    }


    /**
     * Retourne la connexion à la base de donnée
     * @return Database
     */
    public function getDatabase(): Database {
        if(!is_null($this->db)) {
            return $this->db;
        }
        return new Database(
            $this->getConfig('db.host'),
            $this->getConfig('db.dbname'),
            $this->getConfig('db.username'),
            $this->getConfig('db.password')
        );
    }


    /**
     * Initialise le router
     */
    private function initRouter(): void {
        require_once ROOT . '/config/routes.php';
        foreach ($routes as $route => $callable) {
            $this->router->addRoute($route, $callable);
        }
    }

}