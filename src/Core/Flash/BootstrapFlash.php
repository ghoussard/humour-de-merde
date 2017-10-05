<?php

namespace Core\Flash;

class BootstrapFlash extends Flash {

    /**
     * @var string
     */
    private $message;


    /**
     * @var string
     */
    private $type;


    /**
     * BootstrapFlash constructor.
     * @param string $message
     * @param string $type
     * @throws BootstrapFlashException
     */
    public function __construct(string $message, string $type) {
        $this->message = $message;
        if(!in_array($type, ['success', 'info', 'warning', 'danger'])) {
            throw new BootstrapFlashException("Message type does'nt exists");
        }
        $this->type = $type;
    }


    /**
     * @return string
     */
    public function __toString() {
        return "<div class=\"alert alert-{$this->type}\" role=\"alert\">{$this->message}</div>";
    }

}