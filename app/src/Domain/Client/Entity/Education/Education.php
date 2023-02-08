<?php

declare(strict_types=1);

namespace App\Domain\Client\Entity\Education;

use App\Domain\Client\Entity\Client;
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

    #[ORM\Column(type: 'education_type')]
    private Constant $constant;

    #[Orm\OneToMany(targetEntity: Client::class, mappedBy: 'client', cascade: ['persist'])]
    private Client $client;

    /**
     * @param string $name
     * @param Constant $constant
     */
    public function __construct(string $name, Constant $constant)
    {
        $this->name = $name;
        $this->constant = $constant;
    }


}