<?php

namespace Core\Auth;

use Core\Database;

class DatabaseAuth extends Auth {

    /**
     * @var Database
     */
    private $db;


    /**
     * @var string
     */
    private $table = 'users';


    /**
     * DatabaseAuth constructor.
     * @param Database $db
     */
    public function __construct(Database $db) {
        $this->db = $db;
    }


    /**
     * Vérifie le login et le mot de passe
     * @param null|string $login
     * @param null|string $password
     * @return User|bool
     */
    public function checkLogin(?string $login, ?string $password) {
        if(is_null($login)||is_null($password)) {
            return false;
        }

        $req = $this->db->prepare("SELECT * FROM {$this->table} WHERE login = :login OR mail = :login");
        $req->execute([':login' => $login]);
        $req->setFetchMode(\PDO::FETCH_CLASS, User::class);
        $user = $req->fetch();

        if(($password==$user->password)||(password_verify($password, $user->password))) {
            $user->authType = 'database';
            return $user;
        };

        return false;
    }

}