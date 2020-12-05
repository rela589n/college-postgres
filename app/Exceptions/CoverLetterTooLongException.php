<?php


namespace App\Exceptions;


final class CoverLetterTooLongException extends \RuntimeException
{
    private string $letter;
    private int $maxLength;

    public function __construct(string $letter, int $maxLength)
    {
        parent::__construct(
            trans(
                'exceptions/value-objects/cover-letter.too-long',
                [
                    'currentLength' => mb_strlen($letter),
                    'maxLength'     => $maxLength,
                ]
            )
        );

        $this->letter = $letter;
        $this->maxLength = $maxLength;
    }

    public function getLetter(): string
    {
        return $this->letter;
    }

    public function getMaxLength(): int
    {
        return $this->maxLength;
    }
}
