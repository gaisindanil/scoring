<?php

declare(strict_types=1);

namespace App\Domain\Client\Entity;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class OperatorType extends StringType
{
    public const NAME = 'user_operator_type';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        return $value instanceof Operator ? $value->getName() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Operator
    {
        return !empty($value) ? new Operator((string)$value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}