<?php

namespace CPAD\Exception;

use Exception;
use Throwable;

/**
 * Erro
 * 
 * Evento anormal que pode prejudicar o resultado final mas que o sistema prossegue.
 *
 * @author Everton
 */
class ErrorException extends Exception{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = NULL) {
        parent::__construct($message, $code, $previous);
    }
}
