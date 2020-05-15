<?php
namespace CPAD\Repository\Spec;

use CPAD\DataSet\Spec\YamlSpecDataSet;
use CPAD\DataSet\SpecDataSetInterface;
use CPAD\Exception\EmergencyException;
use CPAD\Exception\WarningException;
use CPAD\Repository\SpecRepositoryInterface;
use Exception;

/**
 * Repositório de especificações no formato diretório de yaml
 *
 * @author Everton
 */
class YamlDirSpecRepo implements SpecRepositoryInterface
{

    /**
     *
     * @var string Caminho para o diretório das especificações
     */
    protected string $dir = '';

    public function __construct($specSet)
    {
        if (!is_dir($specSet))
            throw new EmergencyException("[$specSet] não é um diretório.");

        $this->dir = $this->normalizeDirPath($specSet);
    }

    public function getSpecFor(string $idataset): SpecDataSetInterface
    {
        $specpath = "{$this->dir}$idataset.yml";
        if(!file_exists($specpath))
            throw new WarningException ("Especificação para [$idataset] não encontrada em [$specpath]");
        
        try{
            return new YamlSpecDataSet($specpath);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    protected function normalizeDirPath($dirpath): string
    {
        $last_char = substr($dirpath, -1, 1);
        if($last_char !== '/' && $last_char !== '\\')
            $dirpath .= DIRECTORY_SEPARATOR;
        
        return $dirpath;
    }
}
