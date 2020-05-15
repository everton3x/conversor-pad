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

    public function __construct(string $dataset_name)
    {
        if (!file_exists($dataset_name))
            throw new ErrorException("Arquivo [$dataset_name] não encontrado.");

        $this->file = $dataset_name;
    }

    public function getData(): string
    {
        
    }

    public function getMetadata(): InputMetadataInterface
    {
        
    }

    public function hasData(): bool
    {
        
    }

    public function getBasename(): string
    {
        return basename(strtolower($this->file), '.txt');
    }
}
