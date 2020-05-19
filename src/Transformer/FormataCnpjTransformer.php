<?php
namespace CPAD\Transformer;

use CPAD\Utils;

/**
 * formata ############## para ##.###.###/####-##
 *
 * @author Everton
 */
class FormataCnpjTransformer implements TransformerInterface
{

    public function __construct()
    {
        
    }

    public function transform(string $data): string
    {
        return Utils::applyMask($data, '##.###.###/####-##');
    }
}
