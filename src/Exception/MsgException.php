<?php

namespace Kibiubiu\Exception;

use Throwable;

class MsgException extends \Exception {
    public function __construct(string $message = "", int $code = 200, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}