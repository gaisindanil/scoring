<?php

declare(strict_types=1);

namespace App\Domain\Client\Entity;

use Webmozart\Assert\Assert;

final class ConsentPersonalData
{
    private const true = 1;
    private const false = 0;

    private int $value;


    private static array $grades = [
        self::true => 4,
        self::false => 0,
    ];

    public function __construct(int $value)
    {
        Assert::oneOf($value, [
            self::true,
            self::false,
        ]);
        $this->value = $value;
    }

    public function isEqual(self $status): bool
    {
        return $this->getValue() === $status->getValue();
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getGrade(): int
    {
        return (int) self::$grades[$this->value];
    }
}
