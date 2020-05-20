<?php
/**
 * Arquivo para testes rápidos
 */

require_once 'vendor/autoload.php';

foreach (['+1234.56', '-1234.56', '1234.56', 'aas54d6'] as $subject){
    echo $subject, " -> ", preg_match('/^[+|-]?[0-9]{1,}\.[0-9]{0,2}/', $subject), PHP_EOL;
}