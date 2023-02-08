<?php

declare(strict_types=1);

namespace App\Domain\Client\Entity;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class ConsentPersonalDataType extends StringType
{
    public const NAME = 'client_consent_personal_data_type';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof ConsentPersonalData ? $value->getValue() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?ConsentPersonalData
    {
        return !empty($value) ? new ConsentPersonalData((int) $value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
