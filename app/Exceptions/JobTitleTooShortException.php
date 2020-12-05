<?php


namespace App\Exceptions;


final class JobTitleTooShortException extends \RuntimeException
{
    private string $title;
    private int $minLength;

    public function __construct(string $title, int $minLength)
    {
        parent::__construct(
            trans(
                'exceptions/value-objects/job-title.too-short',
                [
                    'currentLength' => mb_strlen($title),
                    'minLength'     => $minLength,
                ]
            )
        );

        $this->title = $title;
        $this->minLength = $minLength;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getMinLength(): int
    {
        return $this->minLength;
    }
}
