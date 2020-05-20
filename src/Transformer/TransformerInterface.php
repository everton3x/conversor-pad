<?php
namespace CPAD\Transformer;

/**
 * Interface para os transformers
 * @author Everton
 */
interface TransformerInterface
{
    /**
     * 
     */
    public function __construct();

    /**
     * Aplica trasnformações em dados brutos.
     * 
     * @param string $data String de dados para processar
     * @return string
     */
    public function transform(string $data): string;
}
