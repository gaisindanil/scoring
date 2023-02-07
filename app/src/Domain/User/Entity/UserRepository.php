<?php

declare(strict_types=1);

namespace App\Domain\User\Entity;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;

final class UserRepository implements UserRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private \Doctrine\ORM\EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(User::class);
    }

    public function add(User $user): void
    {
        $this->entityManager->persist($user);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function get(int $id): User
    {
        $user = $this->repository->find($id);
        if (!$user instanceof User) {
            throw new EntityNotFoundException('User is not found.');
        }
        return $user;
    }

}