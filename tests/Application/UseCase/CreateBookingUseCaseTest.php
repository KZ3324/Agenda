<?php

namespace App\Tests\Application\UseCase;

use App\Application\UseCase\CreateBooking;
use App\Domain\Entity\Booking;
use App\Domain\Repository\BookingRepositoryInterface;
use DateTime;
use PHPUnit\Framework\TestCase;

class CreateBookingUseCaseTest extends TestCase
{
    public function testItShouldCreateABookingSuccessfully() : void
    {
        $repositoryMock = $this->createMock(BookingRepositoryInterface::class);
        $repositoryMock->expects($this->once())->method('save');

        $useCase = new CreateBooking($repositoryMock);
        $booking = $useCase->execute("Test", new DateTime("2026-06-01"), new DateTime("2026-07-01"));

        $this->assertInstanceOf(Booking::class, $booking);
        $this->assertEquals("Test", $booking->getCustomerName());
    }
}