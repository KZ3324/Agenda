<?php

namespace App\Tests\Application\UseCase;

use App\Application\UseCase\CreateBookingUseCase;
use App\Domain\Entity\Booking;
use App\Domain\Repository\BookingRepositoryInterface;
use PHPUnit\Framework\TestCase;

class CreateBookingUseCaseTest extends TestCase
{
    public function testItShouldCreateABookingSuccessfully() : void
    {
        $repositoryMock = $this->createMock(BookingRepositoryInterface::class);
        $repositoryMock->expects($this->once())->method('save');

        $useCase = new CreateBookingUseCase($repositoryMock);
        $booking = $useCase->execute("Test", "2026-06-01", "2026-07-01");

        $this->assertInstanceOf(Booking::class, $booking);
        $this->assertEquals("Test", $booking->getCustomerName());
    }
}