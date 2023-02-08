<?php

declare(strict_types=1);

namespace App\Domain\Client\Entity\Education;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;

final class EducationRepository implements EducationRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private \Doctrine\ORM\EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Education::class);
    }

    public function add(Education $education): void
    {
        $this->entityManager->persist($education);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function get(int $id): Education
    {
        $user = $this->repository->find($id);
        if (!$user instanceof Education) {
            throw new EntityNotFoundException('Education is not found.');
        }

        return $user;
    }
}
