<?php
namespace CPAD\Repository;

use CPAD\DataSet\SpecDataSetInterface;

/**
 * Interface do repositório das especificações de conversão
 * 
 * Atualmente as especificações são armazenadas em arquivos yml, um yml para cada txt.
 * 
 * @author Everton
 */
interface SpecRepositoryInterface
{

    /**
     * Construtor.
     * 
     * @param mixed $specSet O conjunto de especificações. Atualmente é o caminho para o diretório onde estão os yml das especificações.
     */
    public function __construct($specSet);
    
    /**
     * Retorna um dataset de especificações para um dado input dataset
     * @param string $idataset
     * @return SpecDataSetInterface
     */
    public function getSpecFor(string $idataset): SpecDataSetInterface;
}
