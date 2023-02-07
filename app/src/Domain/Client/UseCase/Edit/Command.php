<?php

declare(strict_types=1);

namespace App\Domain\Client\UseCase\Edit;


use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    #[Assert\NotBlank]
    public int $id;

    #[Assert\NotBlank]
    public string $first_name = '';

    #[Assert\NotBlank]
    public string $last_name = '';

    #[Assert\NotBlank]
    public string $phone = '';

    #[Assert\Email]
    public string $email = '';

    #[Assert\NotBlank]
    public string $operator = '';

    #[Assert\NotBlank]
    public string $education = '';

    public bool $consent_personal_data = false;

    /**
     * @param int $id
     * @param string $first_name
     * @param string $last_name
     * @param string $phone
     * @param string $email
     * @param string $operator
     * @param string $education
     * @param bool $consent_personal_data
     */
    public function __construct(int $id, string $first_name, string $last_name, string $phone, string $email, string $operator, string $education, bool $consent_personal_data)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->phone = $phone;
        $this->email = $email;
        $this->operator = $operator;
        $this->education = $education;
        $this->consent_personal_data = $consent_personal_data;
    }


}