<?php

declare(strict_types=1);

namespace App\Domain\Client\UseCase\Edit;

use App\Domain\Client\Entity\Client;
use App\Domain\Client\Entity\ClientRepositoryInterface;
use App\Domain\Flusher;
use App\Domain\Client\Entity\Education;
use App\Domain\Client\Entity\Email;
use App\Domain\Client\Entity\Operator;


class Handler
{

    private Flusher $flusher;
    private ClientRepositoryInterface $clientRepository;
    public function __construct(Flusher $flusher, ClientRepositoryInterface $clientRepository)
    {
        $this->flusher = $flusher;
        $this->clientRepository = $clientRepository;
    }

    public function handle(Command $command): void{
        $client = $this->clientRepository->get($command->id);

        $client->edit(
            $command->first_name,
            $command->last_name,
            new Email($command->email),
            new Operator($command->operator),
            $command->phone,
            $command->consent_personal_data,
            new Education($command->education)
        );


        $this->flusher->flush();


    }
}