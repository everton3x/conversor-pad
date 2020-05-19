<?php

namespace CPAD;

use CPAD\DataSet\InputDataSetInterface;
use CPAD\DataSet\SpecDataSetInterface;

/**
 * Realiza a conversão
 *
 * @author Everton
 */
class Parser
{
    
    protected SpecDataSetInterface $spec;
    
    public function __construct(SpecDataSetInterface $spec)
    {
        $this->spec = $spec;
    }
    
    public function parse(string $data): array
    {
        $spec = $this->spec->getSpec();
        $parsed = [];
        
//        print_r($spec);exit();
        foreach ($spec as $key => $fieldSpec){
            $size = $fieldSpec['byte'];
            $start = $fieldSpec['start'] - 1;
            $type = $fieldSpec['type'];
            $transform = $fieldSpec['transform'];
            $chunked = substr($data, $start, $size);
            
//            if($transform){
//                $chunked = $transform($chunked);
//            }
            
            $parsed[$key] = $chunked;
        }
        
        return $parsed;
    }
    
    protected function typeTransform(string $type, $value)
    {
        switch ($type){
            case 'int':
                settype($value, 'int');
                break;
            case 'float':
                $value = number_format($value, 2, ',', '.');
                break;
            case 'string':
                settype($value, 'string');
                break;
            default :
                throw new CriticalException("Tipo [$type] não suportado.");
        }
        
        return $value;
    }
}
