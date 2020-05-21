<?php
namespace CPAD;

use CPAD\DataSet\SpecDataSetInterface;
use CPAD\Exception\CriticalException;

/**
 * Realiza a conversão
 *
 * @author Everton
 */
class Parser
{

    /**
     *
     * @var SpecDataSetInterface Especificação do dataset input 
     */
    protected SpecDataSetInterface $spec;

    /**
     * 
     * @param \CPAD\SpecDataSetInterface $spec
     */
    public function __construct(SpecDataSetInterface $spec)
    {
        $this->spec = $spec;
    }

    /**
     * Realiza a conversão de uma linha de dados brutos.
     * 
     * @param string $data
     * @return array
     */
    public function parse(string $data): array
    {
        $spec = $this->spec->getSpec();
        $parsed = [];

        foreach ($spec as $key => $fieldSpec) {
            $size = $fieldSpec['byte'];
            $start = $fieldSpec['start'] - 1;
            $type = $fieldSpec['type'];
            $transform = $fieldSpec['transform'];
            $chunked = substr($data, $start, $size);

            if ($transform) {
                $transformClassName = "\\CPAD\Transformer\\{$transform}Transformer";
                $transformInstance = new $transformClassName();
                $chunked = $transformInstance->transform($chunked);
            }

            $parsed[$key] = $chunked;
        }
        
        return $parsed;
    }
}
