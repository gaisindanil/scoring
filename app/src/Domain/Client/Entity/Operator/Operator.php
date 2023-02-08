<?php

declare(strict_types=1);

namespace App\Domain\Client\Entity\Operator;

use App\Domain\Client\Entity\Client;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: 'operators')]
final class Operator
{
    /**
     * @psalm-suppress PropertyNotSetInConstructor
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'client_operator_type')]
    private Constant $constant;

    #[Orm\OneToMany(targetEntity: Client::class, mappedBy: 'client', cascade: ['persist'])]
    private Client $client;

    #[ORM\Column(type: 'integer')]
    private int $grade;

    /**
     * @param string $name
     * @param Constant $constant
     * @param int $grade
     */
    public function __construct(string $name, Constant $constant, int $grade)
    {
        $this->name = $name;
        $this->constant = $constant;
        $this->grade = $grade;
    }

    /**
     * @return int
     */
    public function getGrade(): int
    {
        return $this->grade;
    }


}