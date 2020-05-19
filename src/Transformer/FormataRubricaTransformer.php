<?php
namespace CPAD\Transformer;

use CPAD\Utils;

/**
 * formata ############### para #.#.##.##.##.##.##.##
 *
 * @author Everton
 */
class FormataRubricaTransformer implements TransformerInterface
{

    public function __construct()
    {
        
    }

    public function transform(string $data): string
    {
        return Utils::applyMask(Utils::deslocZerosToRight($data), '#.#.##.##.##.##.##.##');
    }
}
