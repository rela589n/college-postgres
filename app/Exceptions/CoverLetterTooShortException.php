<?php


namespace App\Exceptions;


final class CoverLetterTooShortException extends \RuntimeException
{
    private string $letter;
    private int $minLength;

    public function __construct(string $letter, int $minLength)
    {
        parent::__construct(
            trans(
                'exceptions/value-objects/cover-letter.too-short',
                [
                    'currentLength' => mb_strlen($letter),
                    'minLength'     => $minLength,
                ]
            )
        );

        $this->letter = $letter;
        $this->minLength = $minLength;
    }

    public function getLetter(): string
    {
        return $this->letter;
    }

    public function getMinLength(): int
    {
        return $this->minLength;
    }
}
