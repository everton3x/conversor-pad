<?php

namespace CPAD\Exception;

use Exception;
use Throwable;

/**
 * Exceção para emergências
 * 
 * O sistema não pode iniciar.
 *
 * @author Everton
 */
class EmergencyException extends Exception {
    public function __construct(string $message = "", int $code = 0, Throwable $previous = NULL) {
        parent::__construct($message, $code, $previous);
    }
}
