<?php

namespace App\Tests\Unit\Domain\Client\Edit;

use App\Domain\Client\Entity\Client;
use App\Domain\Client\Entity\ConsentPersonalData;
use App\Domain\Client\Entity\Email;
use PHPUnit\Framework\TestCase;

class ClientEditTest extends TestCase
{
    public function testSuccess(): void{
        $client = new Client(
            "Ivan",
            "Ivanov",
            new Email("example@yandex.ru"),
            "79177732122",
            new ConsentPersonalData(true),



        );
    }

}