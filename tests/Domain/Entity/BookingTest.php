<?php

use App\Domain\Entity\Booking;
use App\Domain\ValueObject\BookingDate;
use App\Domain\ValueObject\BookingId;
use PHPUnit\Framework\TestCase;

class BookingTest extends TestCase
{
    public function testBookingShouldBeInDraftStatusInitially(): void
    {
        $dates = new BookingDate(new DateTime('2026-06-01'), new DateTime('2026-07-01'));
        $booking = new Booking(BookingId::generate(), 'Test', $dates);
        $this->assertEquals(Booking::STATUS_DRAFT, $booking->getStatus());
    }

    public function testCannotConfirmIfAlreadyConfirmed(): void
    {
        $dates = new BookingDate(new DateTime('2026-06-01'), new DateTime('2026-07-01'));
        $booking = new Booking(BookingId::generate(), 'Test', $dates);

        $booking->confirm();
        $this->expectException(InvalidArgumentException::class);
        $booking->confirm();
    }

    public function testBookingCancel(): void
    {
        $dates = new BookingDate(new DateTime('2026-06-01'), new DateTime('2026-07-01'));
        $booking = new Booking(BookingId::generate(), 'Test', $dates);

        $booking->confirm();
        $booking->cancel();
        $this->assertEquals(Booking::STATUS_CANCELLED, $booking->getStatus());
    }
}
