<?php

namespace App;

use Core\Config;
use Core\Database;
use Core\Router;

class App {


    /**
     * @var App
     */
    private static $_instance;


    /**
     * @var Config
     */
    private $config;


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


    /**
     * Retourne la configuration de l'application
     * @param string $key
     * @return mixed
     */
    public function getConfig(?string $key = null) {
        return $this->config->get($key);
    }


    /**
     * Retourne la connexion à la base de données
     * @return Database
     */
    public function getDatabase(): Database {
        if(!is_null($this->db)) {
            return $this->db;
        }
        return new Database(
            $this->config->get('db.host'),
            $this->config->get('db.dbname'),
            $this->config->get('db.username'),
            $this->config->get('db.password')
        );
    }


    /**
     * Retourne le routeur
     * @return Router
     */
    public function getRouter(): Router {
        return $this->router;
    }


    /**
     * Lance l'application
     */
    public function run(): void {
        session_start();

        $this->initRouter();

        $p = $_GET['p'] ?? '';
        $this->router->match($p);
    }


    /**
     * App constructor.
     */
    private function __construct() {
        $this->config = new Config(ROOT . '/config/config.php');
        $this->router = new Router();
    }


    /**
     * Initialise le router
     */
    private function initRouter(): void {
        $routes = require(ROOT . '/config/routes.php');
        foreach ($routes as $path => $route) {
            $this->router->addRoute($path, $route);
        }
    }

}