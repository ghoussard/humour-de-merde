<?php

namespace Core\Helper;

class BootstrapForm {

    /**
     * @var array
     */
    private $data;


    /**
     * @var array
     */
    private $errors;


    public function __construct(array $data = [], array $errors = []) {
        $this->data = $data;
        $this->errors = $errors;
    }


    /**
     * Retourne une valeur des données générées par le formulaire
     * @param string $key
     * @return mixed
     */
    private function getValue(string $key) {
        if(isset($this->data[$key])) {
            return $this->data[$key];
        }
        return null;
    }


    /**
     * Retourne un input
     * @param string $name
     * @param string $label
     * @param array $options
     * @return string
     */
    public function input(string $name, string $label, array $options = []): string {
        if(!isset($options['type'])) {
            $options['type'] = 'text';
        }

        $params = "";
        foreach ($options as $param => $value) {
            $params .= "{$param}=\"{$value}\" ";
        }

        $html = "<label for=\"{$name}\">{$label}</label>";
        $html .= "<input class=\"form-control\" ";
        $html .= "name=\"{$name}\" id=\"{$name}\" ";
        $html .= "{$params} value=\"{$this->getValue($name)}\"></input>";
        $html .= $this->writeError($name);

        return $this->surround($html, $this->isValid($name));
    }


    /**
     * Retourne un select
     * @param string $name
     * @param string $label
     * @param array $data
     * @param array $options
     * @return string
     */
    public function select(string $name, string $label, array $data = [], array $options = []): string {
        $params = "";
        foreach ($options as $param => $value) {
            $params .= "{$param}=\"{$value}\" ";
        }

        $html = "<label for=\"{$name}\">{$label}</label>";
        $html .= "<select class=\"form-control\" ";
        $html .= "name=\"{$name}\" id=\"{$name}\" {$params}>";
        foreach ($data as $item) {
            $selected = ($this->getValue($name)==$item->id) ? 'selected ' : '';
            $html .= "<option value=\"{$item->id}\" {$selected}>{$item->name}</option>";
        }
        $html .= "</select>";
        $html .= $this->writeError($name);

        return $this->surround($html, $this->isValid($name));
    }


    /**
     * Retourne un textarea
     * @param string $name
     * @param string $label
     * @param array $options
     * @return string
     */
    public function textarea(string $name, string $label, array $options = ['rows' => '3']): string {
        $params = "";
        foreach ($options as $param => $value) {
            $params .= "{$param}=\"{$value}\" ";
        }

        $html = "<label for=\"{$name}\">{$label}</label>";
        $html .= "<textarea class=\"form-control\" ";
        $html .= "name=\"{$name}\" id=\"{$name}\" ";
        $html .= "{$params}>{$this->getValue($name)}</textarea>";
        $html .= $this->writeError($name);

        return $this->surround($html, $this->isValid($name));
    }


    /**
     * Retourne un submit
     * @return string
     */
    public function submit(): string {
        return '<button type="submit" class="btn btn-primary">Proposer</button>';
    }


    /**
     * Entoure un champ de la balise adaptée et le retourne
     * @param string $html
     * @param bool $valid
     * @param string $class
     * @return string
     */
    private function surround(string $html, bool $valid, string $class = 'form-group'): string {
        if(!$valid) {
            return '<div class="'. $class . ' has-danger">' . $html . '</div>';
        }
        return '<div class="'. $class . '">' . $html . '</div>';
    }


    /**
     * Ecris l'erreur concernant un champ si il y en a une
     * @param string $name
     * @return string
     */
    private function writeError(string $name): string {
        if(!$this->isValid($name)) {
            $html = "<small class=\"form-text text-muted\">{$this->getError($name)}</small>";
            return $html;
        }
        return "";
    }


    /**
     * Vérifie si un champ est valide
     * @param string $name
     * @return bool
     */
    private function isValid(string $name): bool {
        return !isset($this->errors[$name]);
    }


    /**
     * Retourne l'erreur associée à un champ
     * @param string $name
     * @return string
     */
    private function getError(string $name): string {
        return $this->errors[$name];
    }

}