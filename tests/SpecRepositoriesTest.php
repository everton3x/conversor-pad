<?php
namespace Test;

use CPAD\Factory\IRepoFactory;
use CPAD\Repository\Input\DirIRepo;
use PHPUnit\Framework\TestCase;

/**
 * Testes para o repositório de especificações
 *
 * @author Everton
 */
class SpecRepositoriesTest extends TestCase
{

    /**
     * Testa a correta leitura do repositório de especificaçoes yaml
     */
    public function testYamlDirRepoSuccessOnCreate()
    {
        $repo = new \CPAD\Repository\Spec\YamlDirSpecRepo('./spec/');

        //testa o tipo de classe
        $this->assertInstanceOf(\CPAD\Repository\Spec\YamlDirSpecRepo::class, $repo);
    }
    
    /**
     * Testes
     */
    public function testYamlDirRepoGetDataSet()
    {
        $repo = new \CPAD\Repository\Spec\YamlDirSpecRepo('./spec/');
        
        $this->assertInstanceOf(\CPAD\DataSet\Spec\YamlSpecDataSet::class, $repo->getSpecFor('empenho'));
    }
}
