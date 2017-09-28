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


    public function __construct(string $message, string $type) {
        $this->message = $message;
        if(!in_array($type, ['success', 'info', 'warning', 'danger'])) {
            throw new BootstrapFlashException("Message type does'nt exists");
        }
        $this->type = $type;
    }


    public function __toString() {
        return "<div class=\"alert alert-{$this->type}\" role=\"alert\">{$this->message}</div>";
    }

}