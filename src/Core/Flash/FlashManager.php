<?php

namespace Core\Flash;

class FlashManager {

    /**
     * Ajoute un message flash dans le buffer
     * @param Flash $flash
     */
    public static function addFlash(Flash $flash) {
        $_SESSION['Flash'][] = $flash;
    }


    /**
     * Retourne le premier message flash dans le buffer
     * @return null
     */
    public static function getFlash() {
        if(self::hasFlash()) {
            $flash = $_SESSION['Flash'][0];
            self::clearBuffer();
            return $flash;
        }
        return null;
    }


    /**
     * Vérifie si il y a un message flash dans le buffer
     * @return bool
     */
    private static function hasFlash(): bool {
        return isset($_SESSION['Flash']);
    }


    /**
     * Nettoie le buffer
     */
    private static function clearBuffer() {
        unset($_SESSION['Flash']);
    }

}