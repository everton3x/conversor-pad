<?php
namespace CPAD\Transformer;

/**
 * Formata um número com separador de decimal, milhar e dois decimais.
 *
 * @author Everton
 */
class FormataMoedaTransformer implements TransformerInterface
{

    public function __construct()
    {
        
    }

    public function transform(string $data): string
    {
        return number_format((float) $data, 2, ',', '.');
    }
}
