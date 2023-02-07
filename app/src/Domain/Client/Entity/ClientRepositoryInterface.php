<?php

declare(strict_types=1);

namespace App\Domain\Client\Entity;

interface ClientRepositoryInterface
{
    public function add(Client $client): void;

    public function get(int $id): Client;

}