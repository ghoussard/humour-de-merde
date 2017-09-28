<?php

namespace Core\Auth;

abstract class Auth {

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
    abstract function checkLogin(?string $login, ?string $password): bool;


    /**
     * Déconnecte l'utilisateur
     */
    public function logout(): void {
        unset($_SESSION['Auth']);
    }

}