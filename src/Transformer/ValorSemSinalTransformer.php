<?php
namespace CPAD\Transformer;

/**
 * pega ######## e trasnforma em valor
 *
 * @author Everton
 */
class ValorSemSinalTransformer implements TransformerInterface
{

    public function __construct()
    {
        
    }

    public function transform(string $data): string
    {
        $sinal = '';
        
        
        $int = (int) substr($data, 0, strlen($data) - 2);
        $decimal = (string) substr($data, strlen($data) - 2, 2);

        if($data[0] === '-' && $int === 0){
            $sinal = '-';
        }

        return "$sinal$int.$decimal";
    }
}
