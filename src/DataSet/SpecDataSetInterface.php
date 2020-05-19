<?php
namespace CPAD\DataSet;

/**
 * Representa a especificação de um arquivo.
 * 
 * @author Everton
 */
interface SpecDataSetInterface
{

    /**
     * Retorna um array com a especificaçãopara determinado input dataset
     * 
     * @return array
     */
    public function getSpec(): array;

    /**
     * Retorna os nomes das colunas
     * @return array
     */
    public function getColNames(): array;
}
