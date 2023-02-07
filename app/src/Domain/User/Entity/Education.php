<?php

declare(strict_types=1);

namespace App\Domain\User\Entity;

use Webmozart\Assert\Assert;

final class Education
{
    private const AVERAGE = 'AVERAGE';
    private const SPECIAL = 'SPECIAL';
    private const HIGHER = 'HIGHER';


    private string $name;

    /** @var array|string[] */
    private static array $names = [
        self::AVERAGE => 'Среднее',
        self::SPECIAL => 'Спциальное',
        self::HIGHER => 'Высшнее'
    ];

    public function __construct(string $name)
    {
        Assert::oneOf($name, [
            self::AVERAGE,
            self::SPECIAL,
            self::HIGHER
        ]);
        $this->name = $name;
    }

    public static function average(): self
    {
        return new self(self::AVERAGE);
    }

    public function isEqual(self $status): bool
    {
        return $this->getName() === $status->getName();
    }

    public function isAverage(): bool
    {
        return $this->name === self::AVERAGE;
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function getLocalizedName(): string
    {
        return (string)self::$names[$this->name];
    }

    public static function getNames(): array
    {
        return self::$names;
    }
}