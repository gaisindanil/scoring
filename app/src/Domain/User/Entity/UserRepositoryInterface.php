<?php

declare(strict_types=1);

namespace App\Domain\User\Entity;

interface UserRepositoryInterface
{
    public function add(User $user): void;

    public function get(int $id): User;

}