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
            if(is_null($this->getValue($name)) || empty($this->getValue($name))) {
                $this->errors[$name] = "Ce champ est requis";
            }
        }
        return $this;
    }


    /**
     * Vérifie que deux champs sont égaux
     * @param array $values
     * @return FormValidator
     */
    public function equals(array $values): self {
        foreach ($values as $v1 => $v2) {
            if($this->getValue($v1)!==$this->getValue($v2)) {
                $this->errors[$v2] = "Les champs ne sont pas égaux";
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

}