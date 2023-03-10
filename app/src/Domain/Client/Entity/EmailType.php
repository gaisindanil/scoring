<?php

declare(strict_types=1);

namespace App\Domain\Client\Entity;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class EmailType extends StringType
{
    public const NAME = 'user_email_type';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Email ? $value->getValue() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Email
    {
        return !empty($value) ? new Email((string) $value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
