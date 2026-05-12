<?php

namespace App\Application\UseCase;

use App\Domain\Entity\Booking;
use App\Domain\Repository\BookingRepositoryInterface;
use App\Domain\ValueObject\BookingDate;
use App\Domain\ValueObject\BookingId;
use DateTime;

final class CreateBookingUseCase
{
    public function __construct(private BookingRepositoryInterface $booking_repository) {}

    public function execute(string $customerName, string $start, string $end) : Booking
    {
        $dates = new BookingDate(new DateTime($start), new DateTime($end));
        $booking = new Booking(BookingId::generate(), $customerName, $dates);
        $this->booking_repository->save($booking);
        return $booking;
    }
}
