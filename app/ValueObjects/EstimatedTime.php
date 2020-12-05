<?php


namespace App\ValueObjects;


final class EstimatedTime
{
    private int $seconds;

    private function __construct(int $seconds)
    {
        $this->seconds = $seconds;
    }

    public static function minutes(int $minutes): self
    {
        return new self($minutes * 60);
    }

    public static function hours(int $hours): self
    {
        return self::minutes($hours * 60);
    }

    public function toFullHours(): int
    {
        return $this->seconds / 60 / 60;
    }

    public static function days(int $days): self
    {
        return self::hours($days * 24);
    }

    public static function create(int $days, int $hours, int $minutes): self
    {
        return self::days($days)
            ->plus(self::hours($hours))
            ->plus(self::minutes($minutes));
    }

    public function inSeconds(): int
    {
        return $this->seconds;
    }

    public function equals(self $other): bool
    {
        return $this->seconds === $other->seconds;
    }

    public function plus(EstimatedTime $other): self
    {
        return new self($this->seconds + $other->seconds);
    }

    public function formatInHours(): string
    {
        return sprintf(
            '%s hours',
            $this->toFullHours()
        );
    }
}
