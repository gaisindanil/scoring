<?php

declare(strict_types=1);

namespace App\Domain\Client\Services;

use App\Domain\Client\Entity\Client;
use App\Domain\Client\Entity\Email;

class ScoringServices
{
    private const YANDEX_RU = 'yandex.ru';
    private const GMAIL_COM = 'gmail.com';
    private const MAIL_RU = 'mail.ru';
    private const OTHER = 'other';

    private static array $grades = [
        self::YANDEX_RU => 8,
        self::GMAIL_COM => 10,
        self::MAIL_RU => 6,
        self::OTHER => 3,
    ];

    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    public function calculation(): int
    {
        $scoring = 0;

        $scoring += $this->client->getConsentPersonalData()->getGrade();
        $scoring += $this->client->getEducation()->getGrade();
        $scoring += $this->client->getOperator()->getGrade();

        $scoring += $this->getGradeEmail($this->client->getEmail());

        return $scoring;
    }

    private function getGradeEmail(Email $email): int
    {
        $domain = explode('@', $email->getValue());

        if (isset(self::$grades[$domain[1]])) {
            return (int) self::$grades[$domain[1]];
        } else {
            $grade = (int) self::$grades['other'];
        }

        return $grade;
    }
}
