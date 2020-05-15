<?php
/**
 * Repositório na forma de diretório.
 */
namespace CPAD\Repository\Input;

use CPAD\DataSet\Input\FixLenghtTxtIDataSet;
use CPAD\DataSet\InputDataSetInterface;
use CPAD\Repository\InputRepositoryInterface;
use DirectoryIterator;
use Exception;

/**
 * Repositório na forma de diretório.
 *
 * @author Everton
 */
class DirIRepo implements InputRepositoryInterface
{

    /**
     *
     * @var array Lista de diretórios considerados
     */
    protected array $dir = [];

    /**
     *
     * @var array Lista de arquivos txt encontrados no diretório
     */
    protected array $files = [];

    /**
     * 
     * @param string $input Lista de caminhos de diretório.
     */
    public function __construct(...$input)
    {
        $this->dir = $input;

        try {
            $this->loadTxtFiles();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    protected function loadTxtFiles()
    {
        foreach ($this->dir as $dirPath) {
            $it = new DirectoryIterator($dirPath);
            foreach ($it as $entry) {
                if (!$entry->isFile())
                    continue;
                if (strtolower($entry->getExtension()) !== 'txt')
                    continue;

                $fpath = $entry->getPathname();
                $this->files[] = $fpath;
            }
        }

        $this->hasFile = true;
    }

    public function getDataSet(): ?InputDataSetInterface
    {
        if (($file = current($this->files)) === false) {
            return null;
        }
        
        next($this->files);
        
        return new FixLenghtTxtIDataSet($file);
    }

    public function getNumDataSets(): int
    {
        return count($this->files);
    }
}
