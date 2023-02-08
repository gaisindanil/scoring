<?php

declare(strict_types=1);

namespace App\Domain\Client\Entity;
use App\Domain\Client\Entity\Education\Education;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: 'clients')]
class Client
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

    #[ORM\ManyToOne(targetEntity: Education::class)]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id')]
    private Education $education;


    /**
     * @param string $first_name
     * @param string $last_name
     * @param Email $email
     * @param Operator $operator
     * @param string $phone
     * @param bool $consentPersonalData
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


    /**
     * @param string $first_name
     * @param string $last_name
     * @param Email $email
     * @param Operator $operator
     * @param string $phone
     * @param bool $consentPersonalData
     * @param Education $education
     * @return void
     */
    public function edit(string $first_name, string $last_name, Email $email, Operator $operator, string $phone, bool $consentPersonalData, Education $education): void
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