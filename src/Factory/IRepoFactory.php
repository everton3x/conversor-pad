<?php
namespace CPAD\Factory;

use CPAD\Exception\EmergencyException;
use CPAD\Repository\Input\DirIRepo;
use CPAD\Repository\InputRepositoryInterface;

/**
 * Factory para InputRepositoryInterface
 * 
 * Retorna uma instância de InputRepositoryInterface conforme o tipo de repositório.
 *
 * @author Everton
 */
class IRepoFactory
{

    /**
     * Tipo de repositório: diretório
     */
    const REPO_TYPE_DIR = 'directory';

    /**
     *
     * @var string string de repositórios.
     */
    protected string $repo;

    /**
     * 
     * @param string $repo As strings de repositórios. Exige que todos os repositórios sejam do mesmo tipo.
     */
    public function __construct(string $repo)
    {
        $this->repo = $repo;
    }

    /**
     * 
     * @return InputRepositoryInterface
     */
    public function createRepo(): InputRepositoryInterface
    {
        $firstRepoType = ''; //armazenza o tipo do primeiro repositório para ver se são todos do mesmo tipo.
        $type = $this->detectRepoType($this->repo);

        if (!$firstRepoType)
            $firstRepoType = $type;
        if ($firstRepoType !== $type) {
            throw new EmergencyException("Tipo [$type] para [{$this->repo}] é diferente dos demais tipos.");
        }

        switch ($type) {
            case self::REPO_TYPE_DIR:
                return new DirIRepo($this->repo);
        }
    }

    /**
     * Detecta o tipo de repositório
     * 
     * @param type $repo
     * @return string
     * @throws EmergencyException
     */
    protected function detectRepoType($repo): string
    {
        if (is_dir($repo))
            return self::REPO_TYPE_DIR;

        throw new EmergencyException("Repositório [$repo] não tem suporte.");
    }
}
