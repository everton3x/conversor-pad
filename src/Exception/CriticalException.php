<?php


namespace CPAD\Exception;

use Exception;
use Throwable;

/**
 * Erro crítico
 * 
 * Evento anormal que prejudica o resultado final e termina o sistema
 *
 * @author Everton
 */
class CriticalException extends Exception {
    public function __construct(string $message = "", int $code = 0, Throwable $previous = NULL) {
        parent::__construct($message, $code, $previous);
    }
}
