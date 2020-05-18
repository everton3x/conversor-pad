<?php

/**
 * Factory para InputRepositoryInterface
 */

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
class IRepoFactory {

    /**
     * Tipo de repositório: diretório
     */
    const REPO_TYPE_DIR = 'directory';

    /**
     *
     * @var array Lista de string de repositórios.
     */
    protected array $repo = [];

    /**
     * 
     * @param string $repo Lista com as strings de repositórios. Exige que todos os repositórios sejam do mesmo tipo.
     */
    public function __construct(string ...$repo) {
        $this->repo = $repo;
    }

    /**
     * 
     * @return InputRepositoryInterface
     */
    public function createRepo(): InputRepositoryInterface {
        $firstRepoType = ''; //armazenza o tipo do primeiro repositório para ver se são todos do mesmo tipo.
        foreach ($this->repo as $repo) {
            $type = $this->detectRepoType($repo);

            if (!$firstRepoType)
                $firstRepoType = $type;
            if ($firstRepoType !== $type)
                throw new EmergencyException("Tipo [$type] para [$repo] é diferente dos demais tipos.");
        }

        switch ($type) {
            case self::REPO_TYPE_DIR:
                return new DirIRepo(...$this->repo);
        }
    }

    protected function detectRepoType($repo): string {
        if (is_dir($repo))
            return self::REPO_TYPE_DIR;

        throw new EmergencyException("Repositório [$repo] não tem suporte.");
    }

}