<?php

declare(strict_types=1);

namespace App\Domain\Client\Entity\Education;

use App\Domain\Client\Entity\Client;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: 'educations')]
final class Education
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

    #[ORM\Column(type: 'client_education_type')]
    private Constant $constant;

    #[Orm\OneToMany(targetEntity: Client::class, mappedBy: 'education', cascade: ['persist'])]
    private Collection $client;

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
        $this->client = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getGrade(): int
    {
        return $this->grade;
    }

}