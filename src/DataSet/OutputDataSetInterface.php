<?php
namespace CPAD\DataSet;

/**
 * Interface para o dataset de saída. Representa um arquivo csv, uma guia em planilha ou tabela em banco de dados
 * @author Everton
 */
interface OutputDataSetInterface
{
    public function __construct();
    
    /**
     * Salva uma linha convertida.
     * 
     * @param array $data
     */
    public function saveData(array $data);
}
