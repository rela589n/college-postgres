<?php


namespace App\ValueObjects;


final class ProposalStatus
{
    private const STATUS_NEW = 1;
    private const STATUS_ACCEPTED = 2;
    private int $status;

    private function __construct(int $status)
    {
        $this->status = $status;
    }

    public static function new(): self
    {
        return new self(self::STATUS_NEW);
    }

    public static function accepted(): self
    {
        return new self(self::STATUS_ACCEPTED);
    }

    public function changeTo(ProposalStatus $status): void
    {
        $this->status = $status->status;
    }

    public function isAccepted(): bool
    {
        return $this->status === self::STATUS_ACCEPTED;
    }

    public function value(): int
    {
        return $this->status;
    }
}
