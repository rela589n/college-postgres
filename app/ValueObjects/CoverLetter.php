<?php


namespace App\ValueObjects;


use App\Exceptions\CoverLetterTooLongException;
use App\Exceptions\CoverLetterTooShortException;

final class CoverLetter
{
    public const MIN_LENGTH = 10;
    public const MAX_LENGTH = 255;
    private string $letter;

    public function __construct(string $letter)
    {
        $len = mb_strlen($letter);
        if ($len < self::MIN_LENGTH) {
            throw new CoverLetterTooShortException($letter, self::MIN_LENGTH);
        }
        if ($len > self::MAX_LENGTH) {
            throw new CoverLetterTooLongException($letter, self::MAX_LENGTH);
        }

        $this->letter = $letter;
    }

    public static function create(string $letter): self
    {
        return new self($letter);
    }

    public function __toString(): string
    {
        return $this->letter;
    }
}
