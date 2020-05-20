<?php
namespace CPAD\DataSet\Output;

use CPAD\DataSet\OutputDataSetInterface;
use ErrorException;
use Exception;

/**
 * Representa um arquivo csv
 *
 * @author Everton
 */
class CsvOutputDataSet implements OutputDataSetInterface
{

    /**
     *
     * @var handle ponteiro para o arquivo csv
     */
    protected $fhandle = null;

    /**
     * Opções> Deve conter:
     * 
     * [
     *  filePath => caminho para o csv,
     *  colNames => array com os nomes das colunas
     * ]
     * @param array $options
     * @throws Exception
     * @throws ErrorException
     */
    public function __construct(array $options)
    {
        try {
            if (!($this->fhandle = fopen($options['filePath'], 'w'))) {
                throw new ErrorException("Não foi possível criar o arquivo [{$options['filePath']}].");
            }

            $this->injectColNames($options['colNames']);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Coloca os nomes das colunas no csv
     * 
     * @param array $colNames
     * @return void
     * @throws Exception
     * @throws ErrorException
     */
    protected function injectColNames(array $colNames): void
    {
        try {
            if (!fwrite($this->fhandle, join(';', $colNames) . PHP_EOL)) {
                throw new ErrorException("Não foi possível gravar as colunas.");
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Salva uma linha de dados no csv
     * 
     * @param array $data
     * @throws Exception
     * @throws ErrorException
     */
    public function saveData(array $data)
    {
        try {
//            $data = $this->formatNumber($data);
            if (!fputcsv($this->fhandle, $data, ';')) {
                throw new ErrorException("Não foi possível gravar a linha.");
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * 
     * @return handler Retorna o ponteiro do arquivo. Necessário para fechar o arquivo pelo repositório
     */
    public function getFileHandle()
    {
        return $this->fhandle;
    }

    /**
     * Identifica se o valor é um número (moeda) e formata como moeda.
     * 
     * Necessário para que o Excel leia corretamente como formato de moeda.
     * @param type $data
     */
//    protected function formatNumber($data)
//    {
//        if(preg_match('/^[+|-]?[0-9]{1,}\.[0-9]{0,2}/', $data) === 1) {
//            return number_format($data, 2, ',', '.');
//        } else {
//            return $data;
//        }
//    }
}
