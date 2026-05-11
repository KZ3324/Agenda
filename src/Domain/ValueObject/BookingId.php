<?php

namespace App\Domain\ValueObject;

final readonly class BookingId
{
    private function __construct(private string $value)
    {
    
    }   
    public static function fromString(string $id) : self
    {
        return new self($id);
    }
    public static function generate() : self
    {
        return new self(uniqid());
    }
    public function toString() : string
    {
        return $this->value;
    }
    public function __toString()
    {
        return $this->value;
    }
}