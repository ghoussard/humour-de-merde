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
        $user = $this->checkLogin($login, $password);
        if($user) {
            $_SESSION['Auth'] = $user;
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
    abstract function checkLogin(?string $login, ?string $password);


    /**
     * Déconnecte l'utilisateur
     */
    public static function logout(): void {
        unset($_SESSION['Auth']);
    }


    /**
     * Vérifie si un utilisateur est connecté
     * @return bool
     */
    public static function logged(): bool {
        return isset($_SESSION['Auth'])&&!empty($_SESSION['Auth']);
    }

}