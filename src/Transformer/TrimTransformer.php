<?php
namespace CPAD\Transformer;

use CPAD\Utils;

/**
 * Executa trim em textos.
 *
 * @author Everton
 */
class TrimTransformer implements TransformerInterface
{

    public function __construct()
    {
        
    }

    public function transform(string $data): string
    {
        return trim($data);
    }
}
