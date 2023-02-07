<?php

declare(strict_types=1);

namespace App\Domain\Client\UseCase\Create;


use Symfony\Component\Validator\Constraints as Assert;

class Command
{
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

}