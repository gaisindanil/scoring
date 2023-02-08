<?php

declare(strict_types=1);

namespace App\Domain\Client\Entity\Operator;

interface OperatorRepositoryInterface
{
    public function add(Operator $operator): void;

    public function get(int $id): Operator;
}
