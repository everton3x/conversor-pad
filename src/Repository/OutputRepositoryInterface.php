<?php

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
interface OutputRepositoryInterface {
    
    /**
     * Construtor
     * @param string $output O repositório de saída. é um caminho de um arquvio coma extensão de acordo com o repositório suportado.
     */
    public function __construct(string $output);
    
}
