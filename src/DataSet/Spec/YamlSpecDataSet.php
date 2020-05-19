<?php
namespace CPAD\DataSet\Spec;

/**
 * Especificação no formato yaml
 *
 * @author Everton
 */
class YamlSpecDataSet implements \CPAD\DataSet\SpecDataSetInterface
{
    /**
     *
     * @var string Caminho para o arquivo yaml
     */
    protected string $file = '';
    
    public function __construct($specfile)
    {
        if(!file_exists($specfile))
            throw new WarningException ("Especificação não encontrada em [$specfile]");
        
        $this->file = $specfile;
    }
    
    public function getSpec(): array
    {
        if(($spec = yaml_parse_file($this->file, 0)) === false)
            throw new WarningException ("Falha ao corregar a especificação [{$this->file}]");
            
        return $spec;
    }
    
    public function getColNames(): array
    {
        $colNames = [];
        foreach ($this->getSpec() as $key => $value){
            $colNames[] = $key;
        }
        
        return $colNames;
    }
}
