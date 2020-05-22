<?php
namespace CPAD\DataSet\Output;

/**
 * Data set para saída em SQLite
 *
 * @author Everton
 */
class SQLiteOutputDataSet implements \CPAD\DataSet\OutputDataSetInterface
{
    
    /**
     *
     * @var \PDO Instância do repositório.
     */
    protected \PDO $repo;
    
    /**
     *
     * @var string Nome da tabela
     */
    protected string $dataset = '';
    
    /**
     *
     * @var array Nomes das colunas
     */
    protected array $cols = [];


    public function __construct(array $options)
    {
        if(key_exists('repo', $options)){
            $this->repo = $options['repo'];
        }else{
            throw new CriticalException("Parâmetro [repo] ausente nas opções.");
        }
        if(key_exists('dataset', $options)){
            $this->dataset = $options['dataset'];
        }else{
            throw new CriticalException("Parâmetro [dataset] ausente nas opções.");
        }
        if(key_exists('cols', $options)){
            $this->cols = $options['cols'];
        }else{
            throw new CriticalException("Parâmetro [cols] ausente nas opções.");
        }
    }

    public function saveData(array $data)
    {
        try{
            $colslabel = array_map(function($colname){
                return ":$colname";
            }, $this->cols);
            
            $colnames = join(', ', $this->cols);
            
            $colvalues = join(', ', $colslabel);
            
            $data_prepared = [];
            
            foreach ($data as $k => $v){
                $data_prepared[":$k"] = $v;
            }
            
            $sql = "INSERT INTO {$this->dataset} ($colnames) VALUES ($colvalues)";
            
            $stmt = $this->repo->prepare($sql);
            $stmt->execute($data_prepared);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}
