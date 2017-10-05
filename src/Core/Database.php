<?php

namespace Core;

class Database extends \PDO {

    /**
     * Database constructor.
     * @param $host
     * @param $dbname
     * @param $username
     * @param $password
     */
    public function __construct($host, $dbname, $username, $password) {
        $dsn = "mysql:host={$host};dbname={$dbname}";
        try {
            parent::__construct($dsn, $username, $password);
        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }

}