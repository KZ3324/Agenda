<?php

namespace App\Infrastructure\Persistence\InMemory;

use App\Domain\Entity\Booking;
use App\Domain\Repository\BookingRepositoryInterface;

class InMemoryBookingRepository implements BookingRepositoryInterface
{
    private array $bookings = [];
    public function save(Booking $booking): void
    {
        $this->bookings[$booking->getId()] = $booking;
    }
    public function findById(string $id): ?Booking
    {
        return $this->bookings[$id] ?? null;
    }
    public function findAll(): array
    {
        return $this->bookings;
    }
}
