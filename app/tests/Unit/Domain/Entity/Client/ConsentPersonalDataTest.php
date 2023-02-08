<?php

namespace App\Tests\Unit\Domain\Entity\Client;

use App\Domain\Client\Entity\ConsentPersonalData;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class ConsentPersonalDataTest extends TestCase
{
    public function testCreate(){
        $consentPersonalData = new ConsentPersonalData(1);
        Assert::assertEquals(1, $consentPersonalData->getValue());
    }

}