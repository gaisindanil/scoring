<?php

declare(strict_types=1);

namespace App\Domain\User\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: 'users')]
class User
{
    /**
     * @psalm-suppress PropertyNotSetInConstructor
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $first_name;

    #[ORM\Column(type: 'string')]
    private string $last_name;

    #[ORM\Column(type: 'user_operator_type')]
    private Operator $operator;

    #[ORM\Column(type: 'string')]
    private string $phone;

    #[ORM\Column(length: 180, unique: true)]
    private string $email;

    #[ORM\Column(type: 'boolean')]
    private bool $consentPersonalData;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(type: 'user_education_type')]
    private Education $education;




}