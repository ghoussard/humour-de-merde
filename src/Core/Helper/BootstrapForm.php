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

        $params = $this->extractOptions($options);

        $value = "";
        if(!empty($this->getValue($name))) {
            $value = 'value="' . $this->getValue($name) . '" ';
        }

        $html = $this->getLabel($name, $label);
        $html .= "<input class=\"form-control\" name=\"{$name}\" id=\"{$name}\" ";
        $html .= "{$params} {$value}></input>";

        return $this->surround($html, $name);
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
        $params = $this->extractOptions($options);

        $html = $this->getLabel($name, $label);
        $html .= "<select class=\"form-control\" ";
        $html .= "name=\"{$name}\" id=\"{$name}\" {$params}>";
        foreach ($data as $item) {
            $selected = ($this->getValue($name)==$item->id) ? 'selected ' : '';
            $html .= "<option value=\"{$item->id}\" {$selected}>{$item->name}</option>";
        }
        $html .= "</select>";

        return $this->surround($html, $name);
    }


    /**
     * Retourne un textarea
     * @param string $name
     * @param string $label
     * @param array $options
     * @return string
     */
    public function textarea(string $name, string $label, array $options = ['rows' => '3']): string {
        $params = $this->extractOptions($options);

        $html = $this->getLabel($name, $label);
        $html .= "<textarea class=\"form-control\" ";
        $html .= "name=\"{$name}\" id=\"{$name}\" ";
        $html .= "{$params}>{$this->getValue($name)}</textarea>";

        return $this->surround($html, $name);
    }


    /**
     * Retourne un submit
     * @return string
     */
    public function submit(): string {
        return '<button type="submit" class="btn btn-primary">Proposer</button>';
    }


    /**
     * Entoure un champ de la balise adaptée et d'une erreur s'il y en a une et le retourne
     * @param string $html
     * @param string $name
     * @param string $class
     * @return string
     * @internal param bool $valid
     */
    private function surround(string $html, string $name, string $class = 'form-group'): string {
        if($this->isValid($name)) {
            return '<div class="' . $class . '">' . $html . '</div>';
        }
        return '<div class="' . $class . '">' . $html . $this->writeError($name) . '</div>';
    }


    /**
     * Ecris l'erreur concernant un champ si il y en a une
     * @param string $name
     * @return string
     */
    private function writeError(string $name): string {
        return "<small class=\"form-text text-muted\">{$this->getError($name)}</small>";
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
     * Retourne une valeur des données générées par le formulaire
     * @param string $key
     * @return string|null
     */
    private function getValue(string $key): ?string {
        if(isset($this->data[$key])) {
            return $this->data[$key];
        }
        return null;
    }


    /**
     * Retourne un label
     * @param string $name
     * @param string $label
     * @return string
     */
    private function getLabel(string $name, string $label): string {
        return "<label for=\"{$name}\">{$label}</label>";
    }


    /**
     * Retourne l'erreur associée à un champ
     * @param string $name
     * @return string|null
     */
    private function getError(string $name): ?string {
        return $this->errors[$name];
    }


    /**
     * Extraie les options
     * @param array $options
     * @return string
     */
    private function extractOptions(array $options): string {
        $params = "";
        foreach ($options as $param => $value) {
            $params .= "{$param}=\"{$value}\" ";
        }
        return $params;
    }

}