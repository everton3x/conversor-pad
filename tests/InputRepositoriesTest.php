<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Test;

use CPAD\DataSet\InputDataSetInterface;
use CPAD\Factory\IRepoFactory;
use CPAD\Repository\Input\DirIRepo;
use PHPUnit\Framework\TestCase;

/**
 * Description of InputRepositoriesTest
 *
 * @author Everton
 */
class InputRepositoriesTest extends TestCase
{

    /**
     * Testa a correta criação do repositório do tipo diretório
     */
    public function testRepoDirSuccessOnCreate()
    {
        $factory = new IRepoFactory('./tests/assets/cm', './tests/assets/pm');
        $repo = $factory->createRepo();

        //testa se retornou o tipo correto
        $this->assertInstanceOf(DirIRepo::class, $repo);

        //testa se carregou todos os arquivos
        $this->assertEquals(54, $repo->getNumDataSets());
    }
    
    /**
     * Testa operações com datasets no repositóiro do tipo diretório
     */
    public function testRepoDirDataSet()
    {
        $factory = new IRepoFactory('./tests/assets/cm', './tests/assets/pm');
        $repo = $factory->createRepo();
        
        $this->assertInstanceOf(InputDataSetInterface::class, $repo->getDataSet());
    }
}
