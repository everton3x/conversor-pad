<?php
/**
 * Interface para o repositório dos dados de entrada.
 */
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
     * @param mixed $input Lista com os repositórios. Atualmente é uma lista de strings com os caminhos dos diretórios onde os TXT estão armazenados.
     */
    public function __construct(...$input);

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
