<?php

namespace App\Domain\ValueObject;

use DateTime;
use InvalidArgumentException;

final class BookingDate {
    public function __construct(private DateTime $startDate, private DateTime $endDate)
    {
        if($startDate > $endDate) throw new InvalidArgumentException('La date de début de ne peux pas être supérieur a la date de fin');
        if(($endDate->getTimestamp() - $startDate->getTimestamp()) < 1800) throw new InvalidArgumentException('La différence entre les 2 dates ne peux pas être inférieur a 30 minutes');
    }
}
