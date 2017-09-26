<?php

namespace Core\Helper;

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
        if(!is_null($global) && isset($global[$key])) {
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
     */
    private static function getGlobal(string $global): ?array {
        switch ($global) {
            case "post":
                return $_POST;
                break;
            case "get":
                return $_GET;
                break;
            default:
                return null;
                break;
        }
    }

}