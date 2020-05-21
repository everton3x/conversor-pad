<?php
namespace CPAD\DataSet\Spec;

use CPAD\DataSet\SpecDataSetInterface;
use CPAD\Exception\WarningException;

/**
 * Especificação no formato yaml
 *
 * @author Everton
 */
class YamlSpecDataSet implements SpecDataSetInterface
{

    /**
     *
     * @var string Caminho para o arquivo yaml
     */
    protected string $file = '';

    /**
     * 
     * @param string $specfile Caminho para o arquivo *.yml
     * @throws WarningException
     */
    public function __construct($specfile)
    {
        if (!file_exists($specfile))
            throw new WarningException("Especificação não encontrada em [$specfile]");

        $this->file = $specfile;
    }

    /**
     * Retorna a especificação no formato de array
     * 
     * @return array
     * @throws WarningException
     */
    public function getSpec(): array
    {
        if (($spec = yaml_parse_file($this->file, 0)) === false)
            throw new WarningException("Falha ao corregar a especificação [{$this->file}]");

        return $spec;
    }

    /**
     * Pega os nomes das colunas.
     * 
     * @return array
     */
    public function getColNames(): array
    {
        $colNames = [];
        foreach ($this->getSpec() as $key => $value) {
            $colNames[] = $key;
        }

        return $colNames;
    }
}
