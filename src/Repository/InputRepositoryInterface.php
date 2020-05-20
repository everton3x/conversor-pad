<?php
namespace CPAD\Repository;

use CPAD\DataSet\InputDataSetInterface;

/**
 * Interface do repositório dos dados de entrada.
 * 
 * Atualmente é um diretório com arquivos TXT.
 * 
 * @author Everton
 */
interface InputRepositoryInterface
{

    /**
     * Construtor
     * 
     * @param mixed $input Repositórios. Atualmente é uma string com o caminho do diretório onde os TXT estão armazenados.
     */
    public function __construct($input);

    /**
     * Getter para o dataset de dados. Atualmente representa o arquivo TXT com os dados.
     * 
     * @return InputDataSetInterface
     */
    public function getDataSet(): ?InputDataSetInterface;

    /**
     * Conta o número de datasets (arquivos, planilhas, tabelas)
     * @return int
     */
    public function getNumDataSets(): int;
}
