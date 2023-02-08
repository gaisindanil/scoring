<?php

declare(strict_types=1);

namespace App\Domain\Client\Entity\Operator;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class ConstantType extends StringType
{
    public const NAME = 'client_operator_type';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Constant ? $value->getName() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Constant
    {
        return !empty($value) ? new Constant((string) $value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
