<?php

namespace App\Tests\Unit\Domain\Services;

use App\Domain\Client\Services\ScoringServices;
use App\Tests\Builder\Client\ClientBuilder;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class ScoringServicesTest extends TestCase
{
    public function testCalculation(){
        $client  = (new ClientBuilder("Иван", "Иванов"))
            ->withEmail()
            ->withEducation()
            ->withOperator()
            ->withConsentPersonalData()
            ->build();

        $scoringServices = new ScoringServices($client);
        $result = $scoringServices->calculation();
        Assert::assertIsNumeric($result);
        Assert::assertNotNull($result);
    }


}