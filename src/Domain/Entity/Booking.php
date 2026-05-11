<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\BookingDate;
use App\Domain\ValueObject\BookingId;
use InvalidArgumentException;

final class Booking
{
    public const STATUS_DRAFT = "DRAFT";
    public const STATUS_CONFIRMED = "CONFIRMED";
    public const STATUS_CANCELLED = "CANCELLED";

    private string $status;

    public function __construct(
        private BookingId $id,
        private string $customerName,
        private BookingDate $dates
    )
    {
        $this->status = self::STATUS_DRAFT;
    }

    public function getId() : string {return $this->id;}
    public function getStatus() : string {return $this->status;}
    public function getCustomerName() : string {return $this->customerName;}
    public function getDates() : BookingDate {return $this->dates;}

    public function confirm() {
        if($this->status != self::STATUS_DRAFT) throw new InvalidArgumentException("Erreur le status doit être en draft");
        $this->status = self::STATUS_CONFIRMED;
    }

    public function cancel() {
        if($this->status != self::STATUS_CONFIRMED) throw new InvalidArgumentException('Erreur le status doit être en confirmé');
        $this->status = self::STATUS_CANCELLED;
    }
}