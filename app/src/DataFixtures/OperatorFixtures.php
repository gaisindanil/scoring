<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Domain\Client\Entity\Operator\Constant;
use App\Domain\Client\Entity\Operator\Operator;
use App\Domain\Client\Entity\Operator\OperatorRepositoryInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

final class OperatorFixtures extends Fixture implements FixtureGroupInterface
{
    private OperatorRepositoryInterface $repository;


    public function __construct(OperatorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function load(ObjectManager $manager): void
    {
        $operator = new Operator(
            'Мегафон',
            Constant::megafon(),
            10
        );
        $this->repository->add($operator);

        $operator = new Operator(
            'Билайн',
            Constant::BEELINE(),
            5
        );
        $this->repository->add($operator);

        $operator = new Operator(
            'МТС',
            Constant::mtc(),
            3
        );
        $this->repository->add($operator);

        $operator = new Operator(
            'Иной',
            Constant::other(),
            1
        );
        $this->repository->add($operator);

        $manager->flush();

    }

    public static function getGroups(): array
    {
        return ['operator'];
    }
}