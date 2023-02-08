<?php

declare(strict_types=1);

namespace App\Domain\Client\Entity\Operator;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;

final class OperatorRepository implements OperatorRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private \Doctrine\ORM\EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Operator::class);
    }

    public function add(Operator $operator): void
    {
        $this->entityManager->persist($operator);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function get(int $id): Operator
    {
        $user = $this->repository->find($id);
        if (!$user instanceof Operator) {
            throw new EntityNotFoundException('Operator is not found.');
        }

        return $user;
    }
}
