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

    #[ORM\Column(type: 'user_email_type', unique: true)]
    private Email $email;

    #[ORM\Column(type: 'user_operator_type')]
    private Operator $operator;

    #[ORM\Column(type: 'string')]
    private string $phone;

    #[ORM\Column(type: 'boolean')]
    private bool $consentPersonalData;

    #[ORM\Column(type: 'user_education_type')]
    private Education $education;

    /**
     * @param string $first_name
     * @param string $last_name
     * @param Email $email
     * @param Operator $operator
     * @param string $phone
     * @param bool $consentPersonalData
     * @param array $roles
     * @param Education $education
     */
    public function __construct(string $first_name, string $last_name, Email $email, Operator $operator, string $phone, bool $consentPersonalData, Education $education)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->operator = $operator;
        $this->phone = $phone;
        $this->consentPersonalData = $consentPersonalData;
        $this->education = $education;
    }


}