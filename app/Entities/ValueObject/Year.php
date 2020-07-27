<?php

namespace App\Entities\ValueObject;

class Year
{
    private int $year;

    static public function set(int $year)
    {
        return new self($year);
    }

    private function __construct(int $year)
    {
        $this->year = $year;
    }

    public function getValue(): int
    {
        return $this->year;
    }

    public function __toString()
    {
        return (string)$this->year;
    }
}
