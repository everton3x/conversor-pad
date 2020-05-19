<?php
require_once './vendor/autoload.php';

use CPAD\Factory\IRepoFactory;
use CPAD\Factory\ORepoFactory;
use CPAD\Log\ConsoleLogger;
use CPAD\Maestro;
use CPAD\Repository\Spec\YamlDirSpecRepo;

/**
 * Arquivo para teste da ferramenta.
 */
//if (file_exists('./test.csv')) {
//    rmdir('./test.csv');
//}

define('DEBUG_MODE', true);

$irepo = new IRepoFactory('./tests/assets/pm/');
$orepo = new ORepoFactory('./test.csv');
$specrepo = new YamlDirSpecRepo('./spec');
$consoleLogger = new ConsoleLogger();


$cpad = new Maestro($irepo->createRepo(), $orepo->createRepo(), $specrepo, $consoleLogger);
$cpad->run();
