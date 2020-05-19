<?php
namespace CPAD\Exception;

use Exception;
use Throwable;

/**
 * Warning
 * 
 * Evento anormal que não prejudica o resultado final
 *
 * @author Everton
 */
class WarningException extends Exception
{

    public function __construct(string $message = "", int $code = 0, Throwable $previous = NULL)
    {
        parent::__construct($message, $code, $previous);
    }
}
