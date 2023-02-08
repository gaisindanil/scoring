<?php

declare(strict_types=1);

namespace App\Domain\Client\Entity\Operator;

use Webmozart\Assert\Assert;

final class Constant
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

    public static function BEELINE(): self
    {
        return new self(self::BEELINE);
    }

    public static function mtc(): self
    {
        return new self(self::MTC);
    }

    public static function other(): self
    {
        return new self(self::OTHER);
    }

    public function isEqual(self $status): bool
    {
        return $this->getName() === $status->getName();
    }

    public function isMegafon(): bool
    {
        return self::MEGAFON === $this->name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLocalizedName(): string
    {
        return (string) self::$names[$this->name];
    }

    public static function getNames(): array
    {
        return self::$names;
    }
}
