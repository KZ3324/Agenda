<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Entity\Booking;
use App\Domain\Repository\BookingRepositoryInterface;
use App\Domain\ValueObject\BookingId;
use Doctrine\ORM\EntityManagerInterface;
use Override;

class DoctrineBookingRepository implements BookingRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    #[Override]
    public function save(Booking $booking): void
    {
        $this->em->persist($booking);
        $this->em->flush();
    }

    #[Override]
    public function findById(BookingId $id): ?Booking
    {
        return $this->em->find(Booking::class, $id);
    }

    #[Override]
    public function findAll(): array
    {
        return $this->em->getRepository(Booking::class)->findAll();
    }
}
