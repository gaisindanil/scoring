<?php

declare(strict_types=1);

namespace App\Domain\Client\Query\FindOne;

class ClientDetailView
{
    public function __construct(
        public readonly int $id,
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly string $operator,
        public readonly string $phone,
        public readonly string $email,
        public readonly int $consent_personal_data,
        public readonly string $education
    )
    {
    }

}