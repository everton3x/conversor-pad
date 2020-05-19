<?php

use CPAD\DataSet\OutputDataSetInterface;
use CPAD\DataSet\SpecDataSetInterface;

/**
 * Interface para o repositório de saída dos dados.
 */
namespace CPAD\Repository;

/**
 * Interface para o repositório de saída dos dados.
 * 
 * Se for ..., representa ...
 * 
 * - CSV        ->  o diretório dos arquivos CSV
 * - XLS/XLSX   ->  o arquivo do excel
 * - SQLite     ->  o arquivo de banco de dados
 * 
 * @author Everton
 */
interface OutputRepositoryInterface
{

    /**
     * Construtor
     * @param string $output O repositório de saída. é um caminho de um arquivo coma extensão de acordo com o repositório suportado.
     */
    public function __construct(string $output);

    /**
     * Prepara o dataset para receber os dados.
     * 
     * - CSV        ->  cria o arquivo csv
     * - XLS/XLSX   ->  cria a guia na planilha
     * - SQLite     ->  cria a tabela no banco de dados e inicia uma transação
     * 
     * @param string $datasetName
     * @param SpecDataSetInterface $spec
     * @return OutputDataSetInterface
     */
    public function prepare(string $datasetName, SpecDataSetInterface $spec): OutputDataSetInterface;

    /**
     * Fecha o dataset fornecido.
     * 
     * - CSV        -> chama fclose no arquivo csv
     * - XLS/XLSX   -> fecha o objeto que representa a guia aberta
     * - SQLite     -> faz o commit na transação
     * @param OutputDataSetInterface $dataSet
     */
    public function closeDataSet(OutputDataSetInterface $dataSet);

    /**
     * Fecha todo o repositório
     * 
     * - CSV        -> não faz nada, já que é um diretório
     * - XLS/XLSX   -> fecha o manipúlador da planilha
     * - SQLite     -> fecha a conexão com o banco de dados
     */
    public function closeRepository();
}
