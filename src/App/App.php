<?php

namespace App;

use Core\Database;

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
    private $dbinstance;


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
        require_once ROOT . '/config.php';
        $this->config = $config;
    }


    /**
     * Retourne la configuration
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
        if(!is_null($this->dbinstance)) {
            return $this->dbinstance;
        }
        return new Database(
            $this->getConfig('db.host'),
            $this->getConfig('db.dbname'),
            $this->getConfig('db.username'),
            $this->getConfig('db.password')
        );
    }

}