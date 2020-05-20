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
    protected $file = '';

    /**
     *
     * @var handle Ponteiro para o arquivo txt
     */
    protected $fhandle;

    /**
     *
     * @var bool controla se ainda tem linhas para exportar
     */
    protected $hasData = true;

    /**
     * 
     * @param string $dataset_name arquivo que vai ser lido
     * 
     * @throws ErrorException
     */
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

        if (strtoupper(substr($data, 0, 11)) === 'FINALIZADOR') {
            $this->hasData = false;
            $data = '';
        }

        return $data;
    }

    /**
     * Pega os dados do cabeçalho do txt
     * @todo Implementar
     * @return InputMetadataInterface
     */
    public function getMetadata(): InputMetadataInterface
    {
        
    }

    /**
     * Verifica se tem linhas de dados para ler
     * @return bool
     */
    public function hasData(): bool
    {
        return $this->hasData;
    }

    /**
     * Pega o nome do arquivo sem o caminho e a extensão
     * @return string
     */
    public function getBasename(): string
    {
        return basename(strtolower($this->file), '.txt');
    }
}
