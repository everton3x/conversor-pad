<?php
namespace CPAD\Factory;

use CPAD\Exception\EmergencyException;
use CPAD\Repository\Output\CsvORepo;
use CPAD\Repository\OutputRepositoryInterface;

/**
 * Factory para OutputRepositoryInterface
 *
 * @author Everton
 */
class ORepoFactory
{

    /**
     * Repositório do tipo csv
     */
    const TYPE_CSV = 'csv';

    /**
     *
     * @var string Caminho para o repositório
     */
    protected $repo = '';

    /**
     * 
     * @param type $output O repositório para ser criado
     */
    public function __construct(string $output)
    {
        $this->repo = $output;
    }

    /**
     * 
     * @return string Retorna o valor da constante TYPE_* de acordo com a extensão do $output
     */
    protected function detectRepoType(): string
    {
        $ext = strtolower(pathinfo($this->repo, PATHINFO_EXTENSION));
        switch ($ext) {
            case self::TYPE_CSV:
                return self::TYPE_CSV;

            default :
                throw new EmergencyException("Não há suporte para saída no formato [$ext].");
        }
    }

    /**
     * Cria o repositório.
     * 
     * @return \CPAD\Factory\OutputRepositoryInterface
     * @throws \CPAD\Factory\Exception
     */
    public function createRepo(): OutputRepositoryInterface
    {
        try {
            $type = $this->detectRepoType();

            if ($type === self::TYPE_CSV)
                return new CsvORepo($this->repo);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
