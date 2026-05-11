<?php

namespace App\Tests\Domain\ValueObject;

use App\Domain\ValueObject\BookingDate;
use DateTime;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class BookingDateTest extends TestCase
{
    public function testBookingDateIsGood() : void
    {
        $dates = new BookingDate(new DateTime('2026-06-01'), new DateTime('2026-06-10'));
        $this->assertInstanceOf(BookingDate::class, $dates);
    }

    public function testBookingDateIsNotGood() : void
    {
        $this->expectException(InvalidArgumentException::class);
        $dates = new BookingDate(new DateTime('2026-06-01'), new DateTime('2026-05-10'));
    }

    public function testBookingDateIfSupperiorTo30() : void
    {
        $this->expectException(InvalidArgumentException::class);
        $dates = new BookingDate(new DateTime('2026-10-01 00:00:00'), new DateTime('2026-10-01 00:10:00'));
    }
}