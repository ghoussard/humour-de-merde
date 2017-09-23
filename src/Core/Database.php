<?php

namespace Core;

class Database {

    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct($host, $dbname, $username, $password) {
        $dsn = "mysql:host={$host};dbname={$dbname}";
        try {
            $this->pdo = new \PDO($dsn, $username, $password);
        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }

    /**
     * Retourne PDO
     * @return \PDO
     */
    public function getPDO(): \PDO {
        return $this->pdo;
    }
}