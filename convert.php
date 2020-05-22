<?php

/*
 * Arquivo que inicia o processo de conversão
 */

require_once './vendor/autoload.php';

use CPAD\Exception\EmergencyException;
use CPAD\Factory\IRepoFactory;
use CPAD\Factory\ORepoFactory;
use CPAD\Log\ConsoleLogger;
use CPAD\Maestro;
use CPAD\Repository\Spec\YamlDirSpecRepo;

//define('DEBUG_MODE', true);

$command_line_options = getopt('i:o:d', [
    'input:',
    'output:',
    'debug'
]);

if(!$command_line_options) {
    throw new EmergencyException("Parâmetros de conversão inexistentes ou inválidos.\n\r");
}

$i = false;
if(key_exists('i', $command_line_options)){
    $i = $command_line_options['i'];
}
if(key_exists('input', $command_line_options)){
    $i = $command_line_options['input'];
}

if(!$i){
    throw new EmergencyException("Parâmetro -i|--input é obrigatório.");
}

$o = false;
if(key_exists('o', $command_line_options)){
    $o = $command_line_options['o'];
}
if(key_exists('output', $command_line_options)){
    $o = $command_line_options['output'];
}
if(!$o){
    throw new EmergencyException("Parâmetro -o|--output é obrigatório.");
}

if(key_exists('debug', $command_line_options)){
    define('DEBUG_MODE', true);
}

if(key_exists('d', $command_line_options)){
    define('DEBUG_MODE', true);
}

$irepo = new IRepoFactory($i);
$orepo = new ORepoFactory($o);
$specrepo = new YamlDirSpecRepo('./spec');
$consoleLogger = new ConsoleLogger();

$cpad = new Maestro($irepo->createRepo(), $orepo->createRepo(), $specrepo, $consoleLogger);
$cpad->run();
