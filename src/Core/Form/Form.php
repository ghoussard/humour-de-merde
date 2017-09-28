<?php

namespace Core\Form;

class Form {

    /**
     * @var array
     */
    protected $data;


    /**
     * @var array
     */
    protected $errors;


    /**
     * Extraie les options
     * @param array $options
     * @return string
     */
    protected function extractOptions(array $options): string {
        $params = "";
        foreach ($options as $param => $value) {
            $params .= "{$param}=\"{$value}\" ";
        }
        return $params;
    }


    /**
     * Retourne une valeur des données générées par le formulaire
     * @param string $key
     * @return string|null
     */
    protected function getValue(string $key): ?string {
        if(isset($this->data[$key])) {
            return $this->data[$key];
        }
        return null;
    }


    /**
     * Retourne l'erreur associée à un champ
     * @param string $name
     * @return string|null
     */
    protected function getError(string $name): ?string {
        return $this->errors[$name];
    }


    /**
     * Vérifie si un champ est valide
     * @param string $name
     * @return bool
     */
    protected function isValid(string $name): bool {
        return !isset($this->errors[$name]);
    }

}