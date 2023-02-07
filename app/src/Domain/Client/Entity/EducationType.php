<?php

declare(strict_types=1);

namespace App\Domain\Client\Entity;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class EducationType extends StringType
{
    public const NAME = 'user_education_type';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        return $value instanceof Education ? $value->getName() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Education
    {
        return !empty($value) ? new Education((string)$value) : null;

    }

    public function getName(): string
    {
        return self::NAME;
    }
}