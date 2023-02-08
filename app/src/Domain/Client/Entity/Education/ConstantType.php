<?php

declare(strict_types=1);

namespace App\Domain\Client\Entity\Education;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class ConstantType extends StringType
{
    public const NAME = 'client_education_type';

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
