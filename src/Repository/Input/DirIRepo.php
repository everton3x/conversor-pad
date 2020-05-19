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

//        print_r($this->files);
//        exit();
    }

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

    public function getDataSet(): ?InputDataSetInterface
    {
//        if (($item = each($this->files)) === false) {
//            return null;
//        }
//        $file = $item['value'];
        if (($file = current($this->files)) === false) {
            return null;
        }

        next($this->files);

//        echo "!!!!!!!!!!!", PHP_EOL, $file, PHP_EOL, "--------------", PHP_EOL;
        return new FixLenghtTxtIDataSet($file);
    }

    public function getNumDataSets(): int
    {
        return count($this->files);
    }
}
