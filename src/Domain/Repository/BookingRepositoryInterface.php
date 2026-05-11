<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Booking;
use App\Domain\ValueObject\BookingId;

interface BookingRepositoryInterface
{
    public function save(Booking $booking) : void;
    public function findById(BookingId $id) : ?Booking;

    /** @return Booking[] */
    public function findAll(): array;
}