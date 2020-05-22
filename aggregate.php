<?php

use CPAD\Exception\CriticalException;
use CPAD\Exception\EmergencyException;
use CPAD\Exception\ErrorException;

/**
 * Executa o comando de agregação, unindo duas ou mais pastas de arquivos txt
 */
require_once 'vendor/autoload.php';

try {

//    print_r($argv);exit();
    if ($argc === 1) {
        throw new EmergencyException("Nenhum argumento foi passado.");
    }

    // carrega argumentos passados    
    $destinyDirPath = $argv[1]; //diretório de destino para os txt agregados
//    $destinyDirPath = $destinyDirPath.DIRECTORY_SEPARATOR.'tmp'. rand(); //para debug

    $sourceDirPathList = []; //lista de diretórios de origem dos txt

    for ($i = 2; $i < $argc; $i++) {
        $sourceDirPathList[] = realpath($argv[$i]);
    }

    //testa existência dos diretórios de origem e destino
    foreach ($sourceDirPathList as $sourceDirPath) {
        if (is_dir($sourceDirPath) === false) {
            throw new CriticalException("Caminho [$sourceDirPath] não existe ou não é um diretório.");
        }
    }

    if (file_exists($destinyDirPath)) {
        throw new CriticalException("Diretório de destino [$destinyDirPath] já existe");
    }

    // cria o diretório de destino
    if (mkdir($destinyDirPath, '0777', true) === false) {
        throw new CriticalException("Não foi possível criar [$destinyDirPath]");
    }

    // carrega a lista de arquivos de origem
    $sourceFileList = []; //lista de arquivos do origem
    $rowCounter = []; //contador de linhas totais

    foreach ($sourceDirPathList as $sourceDirPath) {
        foreach (new DirectoryIterator($sourceDirPath) as $sourceFileInfo) {
            if ($sourceFileInfo->isFile()) {
                $sourceFileList[] = $sourceFileInfo->getPathname();
                $rowCounter[strtoupper($sourceFileInfo->getBasename('.' . $sourceFileInfo->getExtension()))] = 0;
            }
        }
    }

//    print_r($sourceFileList);exit();
    // cria o cabeçalho padrão
    $defaultHeader = sprintf('AGREGAÇÃO DE DADOS EM %s', date('d-m-Y H:i:s')) . PHP_EOL;

    $destinyFileList = []; //lista com os arquivos de destino
    //inicia o loop fazendo a agregação
    foreach ($sourceFileList as $sourceFile) {

        // cria o arquivo de destino
        $destinyFilePath = $destinyDirPath . DIRECTORY_SEPARATOR . strtoupper(basename($sourceFile));
        $fileExists = file_exists($destinyFilePath); //necessário para controlar se o cabeçalho vai ser gravado ou não

        $destinyFileList[basename(strtoupper($destinyFilePath), '.TXT')] = $destinyFilePath;

        $destinyFileHandle = fopen($destinyFilePath, 'a');
        if ($destinyFileHandle === false) {
            throw new ErrorException("Não foi possível criar o arquivo [$destinyFilePath]");
        }

        //grava o cabeçalho no arquivo
        if ($fileExists === false) {
            if (fwrite($destinyFileHandle, $defaultHeader) === false) {
                throw new ErrorException("Não foi possível gravar o cabeçalho padrão em [$destinyFilePath]");
            }
        }

        // abre o arquivo de origem
        $sourceFileHandle = fopen($sourceFile, 'r');
        if ($sourceFileHandle === false) {
            throw new ErrorException("Não foi possível abrir o arquivo [$sourceFile]");
        }

        $basename = basename(strtoupper($sourceFile), '.TXT');
        //começa a leitura/gravação das linhas da origem para o destino
        fgets($sourceFileHandle); //pula a primeira linha

        while (($line = fgets($sourceFileHandle)) !== false) {
            if (substr(strtoupper($line), 0, 11) === 'FINALIZADOR') {
                break;
            }

            $rowCounter[$basename]++;

            if (fwrite($destinyFileHandle, $line) === false) {
                throw new ErrorException("Não foi possível gravar a linha [{$rowCounter[$basename]}] de [$sourceFile] em [$destinyFilePath]");
            }
        }//fim da gravação das linhas
        // fechando ponteiros
        fclose($destinyFileHandle);
        fclose($sourceFileHandle);
    }//fim do loop da agregação
    //grava a linha de finalizador
    foreach ($destinyFileList as $basename => $destinyFile) {
        if (($destinyFileHandle = fopen($destinyFile, 'a')) === false) {
            throw new ErrorException("Falha ao abrir [$destinyFile] para gravar o finalizador.");
        }

        $finalizador = 'FINALIZADOR' . str_pad($rowCounter[$basename], 10, '0', STR_PAD_LEFT) . PHP_EOL;
        if (fwrite($destinyFileHandle, $finalizador) === false) {
            throw new ErrorException("Falha ao gravar o finalizador em [$destinyFile].");
        }

        fclose($destinyFileHandle);

        echo "-> {$rowCounter[$basename]} registros agregados em $basename", PHP_EOL;
    }
} catch (Exception $ex) {
    echo '!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!', PHP_EOL;
    echo $ex->getMessage(), PHP_EOL;
    echo '!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!', PHP_EOL;
}