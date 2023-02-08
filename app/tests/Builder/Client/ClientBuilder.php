<?php

namespace App\Tests\Builder\Client;

use App\Domain\Client\Entity\Client;
use App\Domain\Client\Entity\ConsentPersonalData;
use App\Domain\Client\Entity\Education\Constant;
use App\Domain\Client\Entity\Education\Education;
use App\Domain\Client\Entity\Email;
use App\Domain\Client\Entity\Operator\Operator;

class ClientBuilder
{
    private int $id;
    private string $first_name;
    private string $last_name;
    private Email $email;
    private string $phone;
    private ConsentPersonalData $consentPersonalData;
    private Education $education;
    private Operator $operator;

    public function __construct(string $first_name, string $last_name)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->phone = "88005553535";
    }

    public function withEmail(Email $email = null): ClientBuilder
    {
        $clone = clone $this;
        $clone->email = $email ?? new Email("test@yandex.ru");

        return $clone;
    }

    public function withConsentPersonalData(ConsentPersonalData $consentPersonalData = null): ClientBuilder
    {
        $clone = clone $this;
        $clone->consentPersonalData = $consentPersonalData ?? new ConsentPersonalData(true);

        return $clone;
    }

    public function withEducation(Education $education = null): ClientBuilder
    {
        $clone = clone $this;
        $clone->education = $education ?? new Education("Среднее", Constant::average(), 5);

        return $clone;
    }

    public function withOperator(Operator $operator = null): ClientBuilder
    {
        $clone = clone $this;
        $clone->operator = $operator ?? new Operator("Мегафон", \App\Domain\Client\Entity\Operator\Constant::megafon(), 5);

        return $clone;
    }


    public function build(): Client
    {
        return new Client(
            $this->first_name,
            $this->last_name,
            $this->email, $this->phone,
            $this->consentPersonalData,
            $this->education,
            $this->operator
        );
    }
}