<?php


namespace App\ValueObjects;


use App\Exceptions\PasswordTooLongException;
use App\Exceptions\PasswordTooShortException;
use Illuminate\Support\Facades\Hash;

final class Password
{
    public const MIN_LENGTH = 6;
    public const MAX_LENGTH = 64;

    private string $passwordHash;

    private function __construct(string $hash)
    {
        $this->passwordHash = $hash;
    }

    public static function fromRaw(string $rawPassword): self
    {
        $len = mb_strlen($rawPassword);
        if ($len < self::MIN_LENGTH) {
            throw new PasswordTooShortException($rawPassword, self::MIN_LENGTH);
        }

        if ($len > self::MAX_LENGTH) {
            throw new PasswordTooLongException($rawPassword, self::MAX_LENGTH);
        }

        return new self(Hash::make($rawPassword));
    }

    public static function fromHash(string $hash): self
    {
        return new self($hash);
    }

    public function __toString(): string
    {
        return $this->hash();
    }

    public function hash(): string
    {
        return $this->passwordHash;
    }

    public function verify(string $rawPassword): bool
    {
        return password_verify($rawPassword, $this);
    }
}
