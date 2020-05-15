<?php


namespace CPAD\Exception;

use Exception;
use Throwable;

/**
 * Alerta
 * 
 * Evento anormal que requer ação do usuário
 *
 * @author Everton
 */
class AlertException extends Exception {
    public function __construct(string $message = "", int $code = 0, Throwable $previous = NULL) {
        parent::__construct($message, $code, $previous);
    }
}
