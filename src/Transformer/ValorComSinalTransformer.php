<?php
namespace CPAD\Transformer;

/**
 * pega ########+ e trasnforma em valor com sinal
 *
 * @author Everton
 */
class ValorComSinalTransformer implements TransformerInterface
{

    public function __construct()
    {
        
    }

    public function transform(string $data): string
    {
        $signal = substr($data, -1, 1);
        $int = (int) substr($data, 0, strlen($data) - 3);
        $decimal = (int) substr($data, strlen($data) - 3, 2);

        return "$signal$int.$decimal";
    }
}
