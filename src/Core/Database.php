<?php

namespace Core;

class Database extends \PDO {

    public function __construct($host, $dbname, $username, $password) {
        $dsn = "mysql:host={$host};dbname={$dbname}";
        try {
            parent::__construct($dsn, $username, $password);
        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }

}