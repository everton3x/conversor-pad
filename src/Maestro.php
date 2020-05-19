<?php
/**
 * Controller geral da aplicação.
 */
namespace CPAD;

use CPAD\Exception\WarningException;
use CPAD\Repository\InputRepositoryInterface;
use CPAD\Repository\OutputRepositoryInterface;
use CPAD\Repository\SpecRepositoryInterface;
use Exception;
use Psr\Log\LoggerInterface;

/**
 * Controle geral da aplicação.
 *
 * @author Everton
 */
class Maestro
{

    protected InputRepositoryInterface $irepo;
    protected OutputRepositoryInterface $orepo;
    protected SpecRepositoryInterface $specrepo;
    protected array $logger = [];

    /**
     * Construtor.
     * 
     * Configura e prepara o ambiente.
     * 
     * @param InputRepositoryInterface $irepo
     * @param OutputRepositoryInterface $orepo
     * @param SpecRepositoryInterface $specrepo
     * @param LoggerInterface $logger
     */
    public function __construct(InputRepositoryInterface $irepo, OutputRepositoryInterface $orepo, SpecRepositoryInterface $specrepo, LoggerInterface ...$logger)
    {
        $this->irepo = $irepo;
        $this->orepo = $orepo;
        $this->specrepo = $specrepo;
        $this->logger = $logger;
    }

    /**
     * Executa a aplicação.
     */
    public function run()
    {
        $timeStart = time();
        $this->info(sprintf("Conversão iniciada em %s ás %s", date('d/m/Y', $timeStart), date('H:i:s', $timeStart)));

        //loop sobre cada arquivo txt
        while (($idataset = $this->irepo->getDataSet())) {
            $this->notice(sprintf("Processando %s", strtoupper($idataset->getBasename())));


            try {
                $spec = $this->specrepo->getSpecFor($idataset->getBasename());
            } catch (WarningException $ex) {
                $this->warning($ex->getMessage());
                continue;
            } catch (Exception $ex) {
                throw $ex;
            }
            
            try {
                $datasetName = $idataset->getBasename();
                $dataSet = $this->orepo->prepare($datasetName, $spec);
            } catch (Exception $ex) {
                throw $ex;
            }
            
            try{
                $parser = new Parser($spec);
                $lineCounter = 0;
                do{
                    $unparsed = $idataset->getData();
                    if($unparsed){
                    $data = $parser->parse($unparsed);
                        $lineCounter++;
                    }
                }while ($idataset->hasData());
                $this->debug("Processadas [$lineCounter] linhas.");
                
            } catch (Exception $ex) {
                throw $ex;
            }
            
            try{
                $this->orepo->closeDataSet($dataSet);
            } catch (Exception $ex) {
                throw $ex;
            }
        }//fim do loop dos txt

        try{
            $this->orepo->closeRepository();
        } catch (Exception $ex) {
            throw $ex;
        }

        $timeEnd = time();
        $this->info(sprintf("Conversão terminada em %s ás %s", date('d/m/Y', $timeEnd), date('H:i:s', $timeEnd)));
    }

    protected function alert(string $message)
    {
        foreach ($this->logger as $logger) {
            $logger->alert($message);
        }
    }

    protected function critical(string $message)
    {
        foreach ($this->logger as $logger) {
            $logger->critical($message);
        }
    }

    protected function debug(string $message)
    {
        foreach ($this->logger as $logger) {
            $logger->debug($message);
        }
    }

    protected function emergency(string $message)
    {
        foreach ($this->logger as $logger) {
            $logger->emergency($message);
        }
    }

    protected function error(string $message)
    {
        foreach ($this->logger as $logger) {
            $logger->error($message);
        }
    }

    protected function info(string $message)
    {
        foreach ($this->logger as $logger) {
            $logger->info($message);
        }
    }

    protected function notice(string $message)
    {
        foreach ($this->logger as $logger) {
//            $logger->notice($message);
        }
    }

    protected function warning(string $message)
    {
        foreach ($this->logger as $logger) {
//            $logger->warning($message);
        }
    }
}
