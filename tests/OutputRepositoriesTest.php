<?php
namespace Test;

use CPAD\Factory\ORepoFactory;
use \PHPUnit\Framework\TestCase;

/**
 * Testes das classes OutputRepositoryInterface
 *
 * @author Everton
 */
class OutputRepositoriesTest extends TestCase
{
    
    /**
     * Testa a criação de repositório do tipo csv
     */
    public function testCsvSuccessOnCreate()
    {
        $output = './tests/assets/repo.csv';
        
        if(file_exists($output)){
            rmdir($output);
        }
        
        $factory = new ORepoFactory($output);
        $this->assertInstanceOf(\CPAD\Repository\Output\CsvORepo::class, $factory->createRepo());
    }
}
