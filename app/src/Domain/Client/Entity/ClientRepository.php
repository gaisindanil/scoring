<?php

declare(strict_types=1);

namespace App\Domain\Client\Entity;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;

final class ClientRepository implements ClientRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private \Doctrine\ORM\EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Client::class);
    }

    public function add(Client $client): void
    {
        $this->entityManager->persist($client);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function get(int $id): Client
    {
        $user = $this->repository->find($id);
        if (!$user instanceof Client) {
            throw new EntityNotFoundException('Client is not found.');
        }
        return $user;
    }

    public function all(): array
    {
        return $this->repository->findAll();
    }
}