<?php

/*
 * Arquivo que inicia o processo de conversão
 */

require_once './vendor/autoload.php';

use CPAD\Factory\IRepoFactory;
use CPAD\Factory\ORepoFactory;
use CPAD\Log\ConsoleLogger;
use CPAD\Maestro;
use CPAD\Repository\Spec\YamlDirSpecRepo;

//define('DEBUG_MODE', true);

$command_line_options = getopt('i:o:', [
    'input:',
    'output:'
]);

if(!$command_line_options) {
    throw new EmergencyException("Parâmetros de conversão inexistentes ou inválidos.\n\r");
}

if(key_exists('i', $command_line_options)){
    $i = $command_line_options['i'];
}
if(key_exists('input', $command_line_options)){
    $i = $command_line_options['input'];
}
if(key_exists('o', $command_line_options)){
    $o = $command_line_options['o'];
}
if(key_exists('output', $command_line_options)){
    $o = $command_line_options['output'];
}


$irepo = new IRepoFactory($i);
$orepo = new ORepoFactory($o);
$specrepo = new YamlDirSpecRepo('./spec');
$consoleLogger = new ConsoleLogger();

$cpad = new Maestro($irepo->createRepo(), $orepo->createRepo(), $specrepo, $consoleLogger);
$cpad->run();
