<?php
namespace CPAD\DataSet\Output;

/**
 * Representa um arquivo csv
 *
 * @author Everton
 */
class CsvOutputDataSet implements \CPAD\DataSet\OutputDataSetInterface
{
    protected $fhandle = null;
    
    public function __construct(array $options)
    {
        try {
            if(!($this->fhandle = fopen($options['filePath'], 'w'))){
                throw new ErrorException("Não foi possível criar o arquivo [{$options['filePath']}].");
            }
            
            $this->injectColNames($options['colNames']);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
    
    protected function injectColNames(array $colNames): void
    {
        try{
            if(!fwrite($this->fhandle, join(';', $colNames).PHP_EOL)){
                throw new ErrorException("Não foi possível gravar as colunas.");
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function saveData(array $data)
    {
        
    }
    
    public function getFileHandle()
    {
        return $this->fhandle;
    }
}
