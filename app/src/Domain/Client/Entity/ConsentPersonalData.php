<?php

declare(strict_types=1);

namespace App\Domain\Client\Entity;

use Webmozart\Assert\Assert;

final class ConsentPersonalData
{
    private const true = true;
    private const false = false;

    private bool $value;


    /** @var array|int[]  */
    private static array $grades = [
        self::true => 4,
        self::false => 0
    ];


    public function __construct(bool $value)
    {
        Assert::oneOf($value, [
            self::true,
            self::false
        ]);
        $this->value = $value;
    }

    public function isEqual(self $status): bool
    {
        return $this->getValue() === $status->getValue();
    }

    public function getValue(): bool
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function getGrade(): int
    {
        return (int)self::$grades[$this->value];
    }
}