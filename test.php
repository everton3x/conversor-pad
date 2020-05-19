<?php
/**
 * Arquivo para testes rápidos
 */

require_once 'vendor/autoload.php';

$t = new CPAD\Transformer\FormataRubricaTransformer();
echo $t->transform('339030000000000');