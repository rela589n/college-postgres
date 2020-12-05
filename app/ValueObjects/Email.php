<?php


namespace App\ValueObjects;


use App\Exceptions\EmailInvalidException;

final class Email
{
    private string $email;

    private function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new EmailInvalidException("Email \"$email\" is invalid.");
        }

        $this->email = $email;
    }

    public static function from(string $email): self
    {
        return new static($email);
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
