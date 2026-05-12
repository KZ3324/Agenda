<?php

namespace App\Application\UseCase;

use App\Application\DTO\BookingResponseDto;
use App\Domain\Repository\BookingRepositoryInterface;

class ListBookings
{
    public function __construct(private BookingRepositoryInterface $booking_repository) {}

    public function execute() : array
    {
        $bookings = $this->booking_repository->findAll();

        return array_map(
            fn($booking) => BookingResponseDto::fromEntity($booking),
            $bookings
        );
    }
}
