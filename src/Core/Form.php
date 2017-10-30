<?php

namespace Core;

use Core\Form\FormValidator;

class Form {

    /**
     * @var array
     */
    protected $data;


    /**
     * @var FormValidator
     */
    protected $validator;


    /**
     * Form constructor.
     * @param array $data
     */
    public function __construct(array $data = []) {
        $this->data = $data;
    }


    /**
     * Vérifie si un champ est valide
     * @param string $name
     * @return bool
     */
    public function isValid(?string $name = null): bool {
        if(is_null($name)) {
            return empty($this->getValidator()->getErrors());
        }
        return !isset($this->getValidator()->getErrors()[$name]);
    }


    /**
     * Retourne le validateur
     * @return FormValidator
     */
    public function getValidator(): FormValidator {
        if(is_null($this->validator)) {
            return $this->validator = new FormValidator($this->data);
        }
        return $this->validator;
    }


    /**
     * Efface les données du formulaire
     */
    public function initialize() {
        $this->data = [];
    }


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
        return $this->validator->getErrors()[$name];
    }
}