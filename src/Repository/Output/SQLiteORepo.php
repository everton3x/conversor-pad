<?php
namespace CPAD\Repository\Output;

use CPAD\DataSet\Output\SQLiteOutputDataSet;
use CPAD\DataSet\OutputDataSetInterface;
use CPAD\DataSet\SpecDataSetInterface;
use CPAD\Exception\CriticalException;
use CPAD\Repository\OutputRepositoryInterface;
use Exception;
use PDO;

/**
 * Repositório para SQLite
 *
 * @author Everton
 */
class SQLiteORepo implements OutputRepositoryInterface
{
    /**
     *
     * @var PDO Objeto PDO para o banco de dados.
     */
    protected PDO $repo;
    
    /**
     *
     * @var OutputDataSetInterface Dataset da tabela
     */
    protected OutputDataSetInterface $dataset;


    /**
     * 
     * @param string $output
     * @throws Exception
     */
    public function __construct(string $output)
    {
        try {
            $this->repo = new PDO("sqlite:$output");
            $this->repo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Faz o commit da transação.
     * 
     * @param OutputDataSetInterface $dataSet
     */
    public function closeDataSet(OutputDataSetInterface $dataSet)
    {
       try{
           $this->repo->commit();
       } catch (Exception $ex) {
           $this->repo->rollBack();
           throw $ex;
       } 
    }

    /**
     * Fecha o banco de dados.
     */
    public function closeRepository()
    {
        unset($this->repo);
    }

    /**
     * Cria a tabela e inicia a transação.
     * 
     * @param string $datasetName
     * @param SpecDataSetInterface $spec
     * @return OutputDataSetInterface
     */
    public function prepare(string $datasetName, SpecDataSetInterface $spec): OutputDataSetInterface
    {
        try{//cria a tabela
            $this->tableCreate($datasetName, $spec);
            $this->dataset = new SQLiteOutputDataSet([
                'repo' => $this->repo,
                'dataset' => $datasetName,
                'cols' => $spec->getColNames()
            ]);
        } catch (Exception $ex) {
            throw $ex;
        }
        
        try{//inicia a transação
            $this->repo->beginTransaction();
        } catch (Exception $ex) {
            throw $ex;
        }
        
        return $this->dataset;
    }
    
    /**
     * Cria a tabela.
     * 
     * @param string $tableName
     * @param SpecDataSetInterface $spec
     */
    protected function tableCreate(string $tableName, SpecDataSetInterface $spec)
    {
       $coldef = [];
       $cols = $spec->getSpec();
       foreach ($cols as $colId => $col){
           $coltype = $this->translateColTypes($col['type']);
           $coldef[$colId] = "$colId $coltype";
       }
       
       $coldef = join(', ', $coldef);
       
       $sql = "CREATE TABLE IF NOT EXISTS $tableName ($coldef)";
       
       try{
           $this->repo->exec($sql);
       } catch (Exception $ex) {
           throw $ex;
       }
    }
    
    /**
     * Traduz os tipos nativos da especificação em tipos do sqlite.
     * 
     * @param string $native
     * @return string
     * @throws CriticalException
     */
    protected function translateColTypes(string $native): string
    {
        switch ($native) {
            case 'int':
                return 'INTEGER';
            case 'string':
                return 'TEXT';
            case 'float':
                return 'DECIMAL';
            default:
                throw new CriticalException("Tipo nativo [$native] sem suporte no SQLite");
        }
    }
}
