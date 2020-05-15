<?php


/**
 * Repositório do tipo CSV
 * 
 * O repositório é um diretório cujo conteúdo sãoarquivos csv, um para cada dataset (arquivo txt)
 */
namespace CPAD\Repository\Output;

use CPAD\Exception\AlertException;
use CPAD\Exception\CriticalException;
use CPAD\Repository\OutputRepositoryInterface;

/**
 * repositório tipo csv
 *
 * @author Everton
 */
class CsvORepo implements OutputRepositoryInterface
{
    /**
     *
     * @var string O diretório no qual os arquivos csv serão criados.
     */
    protected string $dir = '';
    
    /**
     * 
     * @param string $output Caminho para o diretório onde os arquivos csv serão criados.
     */
    public function __construct($output)
    {
        $this->dir = $output;
        if(file_exists($output)) throw new AlertException("Diretório [$output] já existe.");
        
        if(!mkdir($output, '0777', true)) throw new CriticalException ("Diretório [$output] não pôde ser criado.");
    }
}
