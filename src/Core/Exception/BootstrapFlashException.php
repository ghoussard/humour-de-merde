<?php

namespace Core\Exception;

use Throwable;

class BootstrapFlashException extends \Exception {

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}