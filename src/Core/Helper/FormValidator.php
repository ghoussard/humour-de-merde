<?php

namespace Core\Helper;

class FormValidator {

    /**
     * @var array
     */
    private $errors = [];


    /**
     * @var array
     */
    private $data;


    public function __construct(array $data = []) {
        $this->data = $data;
    }


    /**
     * Récupère une valeur du tableau à vérifier
     * @param string $key
     * @return mixed|null
     */
    private function getValue(string $key) {
        if(isset($this->data[$key])) {
            return $this->data[$key];
        }
        return null;
    }


    /**
     * Retourne les erreurs générées
     * @return array
     */
    public function getErrors(): array {
        return $this->errors;
    }


    /**
     * Vérifie la longueur d'un champ
     * @param string $name
     * @param int $min
     * @param int|null $max
     * @return FormValidator
     */
    public function lenght(string $name, int $min, int $max = null): self {
        if(strlen($this->getValue($name))<$min) {
            $this->errors[$name] = "Ce champ doit dépasser {$min} caractères";
        }
        if(!is_null($max) && strlen($this->getValue($name))>$max) {
            $this->errors[$name] = "Ce champ ne doit pas dépasser {$max} caractères";
        }
        return $this;
    }


    /**
     * Vérifie si un champ est renseigné
     * @param \string[] ...$names
     * @return FormValidator
     */
    public function required(string ...$names): self {
        foreach($names as $name) {
            if(!isset($this->data[$name])) {
                $this->errors[$name] = "Ce champ est requis";
            }
        }
        return $this;
    }


    /**
     * Vérifie si un champ n'est pas vide
     * @param \string[] ...$names
     * @return FormValidator
     */
    public function notEmpty(string ...$names): self {
        foreach($names as $name) {
            if(empty($this->data[$name])) {
                $this->errors[$name] = "Ce champ ne doit pas être vide";
            }
        }
        return $this;
    }


    /**
     * Vérifie si un formulaire est valide
     * @return bool
     */
    public function isValid(): bool {
        return !empty($this->data)&&empty($this->errors);
    }

}