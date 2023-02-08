<?php

declare(strict_types=1);

namespace App\Domain\Client\Entity;
use App\Domain\Client\Entity\Education\Education;
use App\Domain\Client\Entity\Operator\Operator;
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

    #[ORM\Column(type: 'string')]
    private string $phone;

    #[ORM\ManyToOne(targetEntity: Operator::class)]
    #[ORM\JoinColumn(name: 'operator_id', referencedColumnName: 'id')]
    private Operator $operator;

    #[ORM\ManyToOne(targetEntity: Education::class)]
    #[ORM\JoinColumn(name: 'education_id', referencedColumnName: 'id')]
    private Education $education;

    #[ORM\Column(type: 'client_consent_personal_data_type')]
    private ConsentPersonalData $consentPersonalData;

    #[ORM\Column(type: 'integer')]
    private int $scoring = 0;

    /**
     * @param string $first_name
     * @param string $last_name
     * @param Email $email
     * @param string $phone
     * @param ConsentPersonalData $consentPersonalData
     * @param Education $education
     * @param Operator $operator
     */
    public function __construct(string $first_name, string $last_name, Email $email, string $phone, ConsentPersonalData $consentPersonalData, Education $education, Operator $operator)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->phone = $phone;
        $this->consentPersonalData = $consentPersonalData;
        $this->education = $education;
        $this->operator = $operator;
    }


    /**
     * @param string $first_name
     * @param string $last_name
     * @param Email $email
     * @param Operator $operator
     * @param string $phone
     * @param ConsentPersonalData $consentPersonalData
     * @param Education $education
     * @return void
     */
    public function edit(string $first_name, string $last_name, Email $email, Operator $operator, string $phone, ConsentPersonalData $consentPersonalData, Education $education): void
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
     * @param int $scoring
     */
    public function saveScoring(int $scoring): void
    {
        $this->scoring = $scoring;
    }


    /**
     * @return Education
     */
    public function getEducation(): Education
    {
        return $this->education;
    }

    /**
     * @return Operator
     */
    public function getOperator(): Operator
    {
        return $this->operator;
    }

    /**
     * @return ConsentPersonalData
     */
    public function getConsentPersonalData(): ConsentPersonalData
    {
        return $this->consentPersonalData;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }


    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

}