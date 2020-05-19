<?php
namespace CPAD\DataSet;

/**
 * Interface para o dataset dos dados de entrada.
 * 
 * Atualmente representa o arquivo txt com os dados para conversão no formato de largura fixa
 * @author Everton
 */
interface InputDataSetInterface
{

    /**
     * Construtor.
     * 
     * @param string $dataset_name Nome do dataset. Atualmente o caminho para o arquivo txt
     */
    public function __construct(string $dataset_name);

    /**
     * Getter para os dados.
     * 
     * @return string Retorna os dados de cada registro do dataset. Atualmente retorna uma string com uma linha de dados.
     */
    public function getData();

    /**
     * Indica se ainda há dados para fornecer.
     * @return bool Retorna true enquanto existirem dados para fornecer.
     */
    public function hasData(): bool;

    /**
     * Retorna os metadados do dataset.
     * 
     * @return \CPAD\DataSet\InputMetadataInterface
     */
    public function getMetadata(): InputMetadataInterface;

    /**
     * Retorna o basename do dataset (nome do arquivo sem extensão ou nome da tabela)
     * @return string
     */
    public function getBasename(): string;
}
