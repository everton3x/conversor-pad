<?php
namespace CPAD\DataSet;

/**
 * Interface para o dataset de saída. Representa um arquivo csv, uma guia em planilha ou tabela em banco de dados
 * @author Everton
 */
interface OutputDataSetInterface
{
    public function __construct();
    
    public function saveData(array $data);
}
