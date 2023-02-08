<?php

namespace App\Tests\Unit\Domain\Entity\Client;

use App\Domain\Client\Entity\Email;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{

    public function testValid(){
        $email = new Email($value = "admin@yandex.ru");
        Assert::assertEquals($value, $email->getValue());
    }

    public function testNoValid(){
      $this->expectException(\InvalidArgumentException::class);
      new Email("testtest123");
    }


}