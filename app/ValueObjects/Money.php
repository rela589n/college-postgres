<?php

declare(strict_types=1);

namespace App\ValueObjects;


final class Money
{
    private const MULTIPLY_FACTOR = 100;
    private int $cents;

    private function __construct(int $inCents)
    {
        $this->cents = $inCents;
    }

    public static function usd(float $valueInUsd): self
    {
        return new static((int)($valueInUsd * self::MULTIPLY_FACTOR));
    }

    public function inUsd(): float
    {
        return $this->cents / self::MULTIPLY_FACTOR;
    }

    public function formatInUsd(): string
    {
        return $this->inUsd().' $ per hour';
    }

    public function equalsTo(Money $other): bool
    {
        return $this->cents === $other->cents;
    }

    public function add(Money $other): Money
    {
        return new static($this->cents + $other->cents);
    }
}
