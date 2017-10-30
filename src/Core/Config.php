<?php

namespace Core;

class Config {

    /**
     * @var array
     */
    private $config = [];


    /**
     * Config constructor.
     * @param string $configFile
     */
    public function __construct(string $configFile) {
        $this->config = require($configFile);
    }


    /**
     * Retourne la config
     * @param null|string $key
     * @return $this|mixed|null
     */
    public function get(?string $key = null) {
        if(is_null($key)) {
            return $this;
        }
        if(isset($this->config[$key])) {
            return $this->config[$key];
        }
        return null;
    }

}