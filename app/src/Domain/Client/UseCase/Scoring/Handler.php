<?php

declare(strict_types=1);

namespace App\Domain\Client\UseCase\Scoring;

use App\Domain\Client\Entity\ClientRepositoryInterface;
use App\Domain\Flusher;

class Handler
{
    private ClientRepositoryInterface $repository;
    private Flusher $flusher;
    public function __construct(
        Flusher $flusher,
        ClientRepositoryInterface $repository
    )
    {
        $this->flusher = $flusher;
        $this->repository = $repository;
    }

    public function handle(Command $command): void{
        $client = $this->repository->get($command->id);

        $scoring = 0;

        if ($client->isConsentPersonalData()){
            $scoring += 4;
        }

        $scoring += $client->getEducation()->getGrade();
        $scoring += $client->getOperator()->getGrade();

        $client->saveScoring($scoring);

        $this->flusher->flush();
    }
}