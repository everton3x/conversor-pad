<?php

use CPAD\DataSet\Output\CsvOutputDataSet;
use CPAD\DataSet\OutputDataSetInterface;
use CPAD\DataSet\SpecDataSetInterface;
use CPAD\Repository\OutputRepositoryInterface;

/**
 * Repositório do tipo CSV
 * 
 * O repositório é um diretório cujo conteúdo sãoarquivos csv, um para cada dataset (arquivo txt)
 */
namespace CPAD\Repository\Output;

/**
 * repositório tipo csv
 *
 * @author Everton
 */
class CsvORepo implements OutputRepositoryInterface
{

    /**
     *
     * @var string O diretório no qual os arquivos csv serão criados.
     */
    protected string $dir = '';
    
    /**
     *
     * @var OutputDataSetInterface O dataset 
     */
    protected OutputDataSetInterface $dataset;

    /**
     * 
     * @param string $output Caminho para o diretório onde os arquivos csv serão criados.
     */
    public function __construct($output)
    {
        $this->dir = $output;
        if (file_exists($output)) {
            throw new AlertException("Diretório [$output] já existe.");
        }

        if (!mkdir($output, '0777', true)) {
            throw new CriticalException("Diretório [$output] não pôde ser criado.");
        }
    }

    /**
     * Fecha o handle do arquivo csv
     * @param \CPAD\Repository\Output\OutputDataSetInterface $dataSet
     */
    public function closeDataSet(OutputDataSetInterface $dataSet)
    {
        fclose($this->dataset->getFileHandle());
    }

    /**
     * Fecha o repositório como um todo. No caso de csv, é um diretório, então não precisa fazer nada.
     */
    public function closeRepository()
    {
        //não precisa fazer nada
    }

    /**
     * Cria o arquivo csv
     * 
     * @param string $datasetName
     * @param \CPAD\Repository\Output\SpecDataSetInterface $spec
     * @return \CPAD\Repository\Output\OutputDataSetInterface
     * @throws \CPAD\Repository\Output\Exception
     */
    public function prepare(string $datasetName, SpecDataSetInterface $spec): OutputDataSetInterface
    {
        $filePath = "{$this->dir}/$datasetName.csv";

        $colNames = $spec->getColNames();
        try {
            $this->dataset = new CsvOutputDataSet([
                'filePath' => $filePath,
                'colNames' => $colNames
            ]);
        } catch (Exception $ex) {
            throw $ex;
        }

        return $this->dataset;
    }
}
