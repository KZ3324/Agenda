<?php

namespace App\Application\DTO;

use App\Domain\Entity\Booking;

readonly class BookingResponseDto
{
    public function __construct(
        public string $id,
        public string $customerName,
        public string $status,
        public string $startDate,
        public string $endDate
    ) {}

    public static function fromEntity(Booking $booking) : self
    {
        return new self(
            (string) $booking->getId(),
            $booking->getCustomerName(),
            $booking->getStatus(),
            $booking->getDates()->getStartDate()->format('Y-m-d H:i:s'),
            $booking->getDates()->getEndDate()->format('Y-m-d H:i:s')
        );
    }
}
