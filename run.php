<?php
require_once './vendor/autoload.php';

use CPAD\Factory\IRepoFactory;
use CPAD\Factory\ORepoFactory;
use CPAD\Log\ConsoleLogger;
use CPAD\Maestro;
use CPAD\Repository\Spec\YamlDirSpecRepo;

//define('DEBUG_MODE', true);

$irepo = new IRepoFactory('/mnt/c/Users/Everton/OneDrive/Prefeitura/2020/PAD/2020-06/pm/MES06');
//$orepo = new ORepoFactory('./test.csv');
$orepo = new ORepoFactory('/mnt/e/mundb/2020/pm.csv');
$specrepo = new YamlDirSpecRepo('./spec');
$consoleLogger = new ConsoleLogger();


$cpad = new Maestro($irepo->createRepo(), $orepo->createRepo(), $specrepo, $consoleLogger);
$cpad->run();
