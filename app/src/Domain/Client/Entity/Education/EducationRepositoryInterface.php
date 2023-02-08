<?php

declare(strict_types=1);

namespace App\Domain\Client\Entity\Education;

interface EducationRepositoryInterface
{
    public function add(Education $education): void;

    public function get(int $id): Education;
}
