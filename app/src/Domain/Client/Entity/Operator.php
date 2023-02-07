<?php

declare(strict_types=1);

namespace App\Domain\Client\Entity;

use Webmozart\Assert\Assert;

final class Operator
{
    private const MEGAFON = 'MEGAFON';
    private const BEELINE = 'BEELINE';
    private const MTC = 'MTC';
    private const OTHER = 'OTHER';

    private string $name;

    /** @var array|string[] */
    private static array $names = [
        self::MEGAFON => 'Мегафон',
        self::BEELINE => 'Билайн',
        self::MTC => 'Мтс',
        self::OTHER => 'Иной',
    ];

    public function __construct(string $name)
    {
        Assert::oneOf($name, [
            self::MEGAFON,
            self::BEELINE,
            self::MTC,
            self::OTHER,
        ]);
        $this->name = $name;
    }

    public static function megafon(): self
    {
        return new self(self::MEGAFON);
    }

    public function isEqual(self $status): bool
    {
        return $this->getName() === $status->getName();
    }

    public function isMegafon(): bool
    {
        return $this->name === self::MEGAFON;
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