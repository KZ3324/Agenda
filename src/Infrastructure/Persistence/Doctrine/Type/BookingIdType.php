<?php

namespace App\Infrastructure\Persistence\Doctrine\Type;

use App\Domain\ValueObject\BookingId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class BookingIdType extends StringType
{
    public const NAME = 'booking_id';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value instanceof BookingId ? $value : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?BookingId
    {
        return $value !== null ? BookingId::fromString($value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}