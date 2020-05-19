<?php

use CPAD\DataSet\Input\FixLenghtTxtIDataSet;
use CPAD\DataSet\InputDataSetInterface;
use CPAD\Repository\InputRepositoryInterface;

/**
 * Repositório na forma de diretório.
 */
namespace CPAD\Repository\Input;

/**
 * Repositório na forma de diretório.
 *
 * @author Everton
 */
class DirIRepo implements InputRepositoryInterface
{

    /**
     *
     * @var array Diretório considerado
     */
    protected string $dir;

    /**
     *
     * @var array Lista de arquivos txt encontrados no diretório
     */
    protected array $files = [];

    /**
     * 
     * @param string $input Caminho de diretório.
     */
    public function __construct($input)
    {
        $this->dir = $input;

        try {
            $this->loadTxtFiles();
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    /**
     * Carrega a lista de arquivos txt
     */
    protected function loadTxtFiles()
    {
        $it = new DirectoryIterator($this->dir);
        foreach ($it as $entry) {
            if (!$entry->isFile())
                continue;
            if (strtolower($entry->getExtension()) !== 'txt')
                continue;

            $fpath = $entry->getPathname();
            $this->files[] = $fpath;
        }

        $this->hasFile = true;
    }

    /**
     * Retorna o dataset
     * 
     * @return \CPAD\Repository\Input\InputDataSetInterface|null
     */
    public function getDataSet(): ?InputDataSetInterface
    {
        if (($file = current($this->files)) === false) {
            return null;
        }

        next($this->files);

        return new FixLenghtTxtIDataSet($file);
    }

    /**
     * Retorna o número de arquivos
     * 
     * @return int
     */
    public function getNumDataSets(): int
    {
        return count($this->files);
    }
}
