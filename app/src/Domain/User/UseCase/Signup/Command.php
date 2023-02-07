<?php

declare(strict_types=1);

namespace App\Domain\User\UseCase\Signup;

final class Command
{
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $operator;

}