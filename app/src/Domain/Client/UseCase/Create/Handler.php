<?php

declare(strict_types=1);

namespace App\Domain\Client\UseCase\Create;



use App\Domain\Client\Entity\Client;
use App\Domain\Client\Entity\ClientRepositoryInterface;
use App\Domain\Client\Entity\Education\Education;
use App\Domain\Client\Entity\Email;
use App\Domain\Client\Entity\Operator;
use App\Domain\Flusher;

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
        $client = new Client(
            $command->first_name,
            $command->last_name,
            new Email($command->email),
            new Operator($command->operator),
            $command->phone,
            $command->consent_personal_data,
            new Education($command->education)

        );

        $this->clientRepository->add($client);

        $this->flusher->flush();


    }
}