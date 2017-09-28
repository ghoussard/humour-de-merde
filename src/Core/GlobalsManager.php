<?php

namespace Core;

use Core\GlobalsManager\GlobalsManagerException;

class GlobalsManager {

    /**
     * Sécurise et retourne la variable globale demandée
     * @param string $global
     * @param string $key
     * @return mixed
     */
    public static function get(string $global, string $key = null) {
        $global = self::getGlobal($global);
        if(is_null($key)) {
            return $global;
        }
        if(isset($global[$key])) {
            if(is_string($global[$key])) {
                return htmlspecialchars($global[$key]);
            }
            if(is_array($global[$key])) {
                return array_map('htmlspecialchars', $global[$key]);
            }
            return $global[$key];
        }
        return null;
    }


    /**
     * Retourne le global appelé
     * @param string $global
     * @return array|null
     * @throws GlobalsManagerException
     */
    private static function getGlobal(string $global): ?array {
        switch ($global) {
            case "post":
                return $_POST;
                break;
            case "get":
                return $_GET;
                break;
            case "session":
                return $_SESSION;
                break;
            default:
                throw new GlobalsManagerException("Specified global does'nt exists");
                break;
        }
    }

}