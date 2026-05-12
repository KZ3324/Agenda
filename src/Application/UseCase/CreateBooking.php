<?php

namespace App\Application\UseCase;

use App\Domain\Entity\Booking;
use App\Domain\Repository\BookingRepositoryInterface;
use App\Domain\ValueObject\BookingDate;
use App\Domain\ValueObject\BookingId;
use DateTime;

final class CreateBooking
{
    public function __construct(private BookingRepositoryInterface $booking_repository) {}

    public function execute(string $customerName, DateTime $start, DateTime $end) : Booking
    {
        $booking = new Booking(
            BookingId::generate(),
            $customerName,
            new BookingDate($start, $end)
        );


        $this->booking_repository->save($booking);
        return $booking;
    }
}
