<?php


namespace App\Exceptions;


final class JobDescriptionTooShortException extends \RuntimeException
{
    private string $description;
    private int $minLength;

    public function __construct(string $description, int $minLength)
    {
        parent::__construct(
            trans(
                'exceptions/value-objects/job-description.too-short',
                [
                    'currentLength' => mb_strlen($description),
                    'minLength'     => $minLength,
                ]
            )
        );

        $this->description = $description;
        $this->minLength = $minLength;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getMinLength(): int
    {
        return $this->minLength;
    }
}
