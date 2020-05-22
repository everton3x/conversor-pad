<?php
namespace CPAD\Transformer;

use CPAD\Utils;

/**
 * formata ############## para ##.###.###/####-## ou ###.###.###-##
 *
 * @author Everton
 */
class FormataCpfCnpjTransformer implements TransformerInterface
{

    public function __construct()
    {
        
    }

    public function transform(string $data): string
    {
        if(substr($data, 0,3) === '000'){
            return Utils::applyMask(substr($data, 3,11), '###.###.###-##');
        }else{
            return Utils::applyMask($data, '##.###.###/####-##');
        }
    }
}
