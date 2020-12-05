<?php


namespace App\ValueObjects;


use App\Exceptions\JobTitleTooLongException;
use App\Exceptions\JobTitleTooShortException;

final class JobTitle
{
    public const MIN_LENGTH = 2;
    public const MAX_LENGTH = 64;
    private string $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public static function create(string $title): self
    {
        $len = mb_strlen($title);
        if ($len < self::MIN_LENGTH) {
            throw new JobTitleTooShortException($title, self::MIN_LENGTH);
        }

        if ($len > self::MAX_LENGTH) {
            throw new JobTitleTooLongException($title, self::MAX_LENGTH);
        }

        return new static($title);
    }

    public function __toString()
    {
        return $this->title;
    }
}
