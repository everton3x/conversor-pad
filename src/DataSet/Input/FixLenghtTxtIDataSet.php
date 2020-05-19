<?php
namespace CPAD\DataSet\Input;

use CPAD\DataSet\InputDataSetInterface;
use CPAD\DataSet\InputMetadataInterface;
use CPAD\Exception\ErrorException;

/**
 * Dataset para arquivos de texto de largura fixa
 *
 * @author Everton
 */
class FixLenghtTxtIDataSet implements InputDataSetInterface
{

    /**
     *
     * @var string Caminho para o arquivo txt.
     */
    protected string $file = '';
    protected $fhandle;
    protected bool $hasData = true;

    public function __construct(string $dataset_name)
    {
        if (!file_exists($dataset_name)) {
            throw new ErrorException("Arquivo [$dataset_name] não encontrado.");
        }

        $this->file = $dataset_name;

        if (!($this->fhandle = fopen($this->file, 'r'))) {
            throw new ErrorException("Não foi possível abrir para leitura [{$this->file}].");
        }
        
        //pula a primeira linha
        fgets($this->fhandle);
        
    }

    public function getData(): string
    {
        $data = trim(fgets($this->fhandle));
        
        if(strtoupper(substr($data, 0, 11)) === 'FINALIZADOR'){
            $this->hasData = false;
            $data = '';
        }
        
        return $data;
    }

    public function getMetadata(): InputMetadataInterface
    {
        
    }

    public function hasData(): bool
    {
        return $this->hasData;
    }

    public function getBasename(): string
    {
        return basename(strtolower($this->file), '.txt');
    }
}
