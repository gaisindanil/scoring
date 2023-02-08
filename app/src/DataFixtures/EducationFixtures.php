<?php

declare(strict_types=1);

namespace App\DataFixtures;


use App\Domain\Client\Entity\Education\Constant;
use App\Domain\Client\Entity\Education\Education;
use App\Domain\Client\Entity\Education\EducationRepositoryInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

final class EducationFixtures extends Fixture implements FixtureGroupInterface
{
    private EducationRepositoryInterface $repository;


    public function __construct(EducationRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function load(ObjectManager $manager): void
    {
        $education = new Education(
            'Среднее образование',
            Constant::average()
        );
        $this->repository->add($education);

        $education = new Education(
            'Специальное образование',
            Constant::special()
        );
        $this->repository->add($education);

        $education = new Education(
            'Высшее образование',
            Constant::higher()
        );
        $this->repository->add($education);
        $manager->flush();

    }

    public static function getGroups(): array
    {
        return ['education'];
    }
}