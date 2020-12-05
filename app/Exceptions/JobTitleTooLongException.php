<?php


namespace App\Exceptions;


final class JobTitleTooLongException extends \RuntimeException
{
    private string $title;
    private int $maxLength;

    public function __construct(string $title, int $maxLength)
    {
        parent::__construct(
            trans(
                'exceptions/value-objects/job-title.too-long',
                [
                    'currentLength' => mb_strlen($title),
                    'maxLength'     => $maxLength,
                ]
            )
        );

        $this->title = $title;
        $this->maxLength = $maxLength;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getMaxLength(): int
    {
        return $this->maxLength;
    }
}
