<?php


namespace App\ValueObjects;


use App\Exceptions\JobDescriptionTooLongException;
use App\Exceptions\JobDescriptionTooShortException;

final class JobDescription
{
    public const MIN_LENGTH = 8;
    public const MAX_LENGTH = 256;
    private string $description;

    public function __construct(string $description)
    {
        $this->description = $description;
    }

    public static function create(string $description): self
    {
        $len = mb_strlen($description);
        if ($len < self::MIN_LENGTH) {
            throw new JobDescriptionTooShortException($description, self::MIN_LENGTH);
        }

        if ($len > self::MAX_LENGTH) {
            throw new JobDescriptionTooLongException($description, self::MAX_LENGTH);
        }

        return new static($description);
    }

    public function __toString()
    {
        return $this->description;
    }
}
