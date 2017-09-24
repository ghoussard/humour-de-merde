<?php

namespace Core\Helper;

class BoostrapForm {

    /**
     * @var array
     */
    private $data;


    public function __construct(array $data = []) {
        $this->data = $data;
    }


    /**
     * Retourne une valeur du formulaire
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

        return $this->surround($html);
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

        return $this->surround($html);
    }


    /**
     * Retourn un textarea
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

        return $this->surround($html);
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
     * @param string $class
     * @return string
     */
    private function surround(string $html, $class = 'form-group'): string {
        return '<div class="'. $class . '">' . $html . '</div>';
    }

}