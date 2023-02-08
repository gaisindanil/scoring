<?php

namespace App\Tests\Unit\Domain\Entity\Client;

use App\Domain\Client\Entity\ConsentPersonalData;
use App\Domain\Client\Entity\Education\Constant;
use App\Domain\Client\Entity\Education\Education;
use App\Domain\Client\Entity\Email;
use App\Domain\Client\Entity\Operator\Operator;
use App\Tests\Builder\Client\ClientBuilder;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testSaveScoring()
    {
        $client = (new ClientBuilder('Иван', 'Иванович'))
            ->withEmail()
            ->withConsentPersonalData()
            ->withEducation()
            ->withOperator()
            ->build();

        $client->saveScoring(5);
        Assert::assertIsNumeric($client->getScoring());
    }

    public function testEdit()
    {
        $client = (new ClientBuilder('Иван', 'Иванович'))
            ->withEmail()
            ->withConsentPersonalData()
            ->withEducation()
            ->withOperator()
            ->build();

        $client->edit(
            $firstName = 'Иван',
            $lastName = 'Иванов',
            $email = new Email('zell12345@yandex.ru'),
            $operator = new Operator(
                'Мегафон',
                \App\Domain\Client\Entity\Operator\Constant::megafon(),
                5
            ),
            $phone = '88005553535',
            $consentPersonalData = new ConsentPersonalData(true),
            $education = new Education(
                'Среднее',
                Constant::average(),
                5
            ),
        );

        Assert::assertEquals($client->getFirstName(), $firstName);
        Assert::assertEquals($client->getLastName(), $lastName);
        Assert::assertEquals($client->getEmail(), $email);
        Assert::assertEquals($client->getOperator(), $operator);
        Assert::assertEquals($client->getPhone(), $phone);
        Assert::assertEquals($client->getConsentPersonalData(), $consentPersonalData);
        Assert::assertEquals($client->getEducation(), $education);
    }
}