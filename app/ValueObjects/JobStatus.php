<?php


namespace App\ValueObjects;


final class JobStatus
{
    private const STATUS_NEW = 1;
    private const STATUS_IN_WORK = 2;
    private const STATUS_FINISHED = 3;

    private int $status;

    private function __construct(int $status)
    {
        $this->status = $status;
    }

    public static function new(): self
    {
        return new self(self::STATUS_NEW);
    }

    public static function inWork(): self
    {
        return new self(self::STATUS_IN_WORK);
    }

    public static function finished(): self
    {
        return new self(self::STATUS_FINISHED);
    }

    public function isNew(): bool
    {
        return $this->status === self::STATUS_NEW;
    }

    public function isInWork(): bool
    {
        return $this->status === self::STATUS_IN_WORK;
    }

    public function isFinished(): bool
    {
        return $this->status === self::STATUS_FINISHED;
    }

    public function value()
    {
        return $this->status;
    }

    public function changeTo(JobStatus $next)
    {
        if ($this->status > $next->status) {
            throw new \InvalidArgumentException('Could not change status to previous');
        }

        $this->status = $next->status;
    }
}
