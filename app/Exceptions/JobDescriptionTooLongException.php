<?php


namespace App\Exceptions;


final class JobDescriptionTooLongException extends \RuntimeException
{
    private string $description;
    private int $maxLength;

    public function __construct(string $description, int $maxLength)
    {
        parent::__construct(
            trans(
                'exceptions/value-objects/job-description.too-long',
                [
                    'currentLength' => mb_strlen($description),
                    'maxLength'     => $maxLength,
                ]
            )
        );

        $this->description = $description;
        $this->maxLength = $maxLength;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getMaxLength(): int
    {
        return $this->maxLength;
    }
}
