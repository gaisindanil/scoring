<?php

declare(strict_types=1);

namespace App\Domain\Client\Services;

use App\Domain\Client\Entity\Client;
use App\Domain\Client\Entity\Email;

class ScoringServices
{

    private static array $grades = [
        'yandex.ru' => 8,
        'gmail.com'=> 10,
        'mail.ru' => 6,
        'other' => 3
    ];

    public function calculation(Client $client): int
    {
        $scoring = 0;

        $scoring += $client->getConsentPersonalData()->getGrade();
        $scoring += $client->getEducation()->getGrade();
        $scoring += $client->getOperator()->getGrade();

        $scoring += $this->getGradeEmail($client->getEmail());

        return $scoring;
    }

    private function getGradeEmail(Email $email): int{

        $domain = explode("@", $email->getValue());

        if (isset(self::$grades[$domain[1]])){
            return (int)self::$grades[$domain[1]];
        }else{
            $grade = (int)self::$grades['other'];
        }


       return $grade;
    }
}