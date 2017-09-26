<?php

namespace Core\Auth;

use App\App;

class DatabaseAuth {


    /**
     * @var string
     */
    private $table = 'users';


    /**
     * Connecte un utilisateur
     * @param null|string $login
     * @param null|string $password
     * @return bool
     */
    public function login(?string $login, ?string $password): bool {
        if($this->checkLogin($login, $password)) {
            $_SESSION['Auth'] = $this;
            return true;
        }
        return false;
    }


    /**
     * Vérifie le login et le mot de passe
     * @param null|string $login
     * @param null|string $password
     * @return bool
     */
    public function checkLogin(?string $login, ?string $password): bool {
        if(is_null($login)||is_null($password)) {
            return false;
        }

        $req = App::getInstance()->getDatabase()->getPDO()
            ->prepare("SELECT * FROM {$this->table} WHERE login = :login OR mail = :login");
        $req->execute([':login' => $login]);
        $req->setFetchMode(\PDO::FETCH_INTO, $this);
        $req->fetch();

        if(!isset($this->password)) {
            return false;
        }

        return ($password==$this->password)||(password_verify($password, $this->password));
    }


    /**
     * Déconnecte l'utilisateur
     */
    public function logout(): void {
        unset($_SESSION['Auth']);
    }

}