<?php


namespace App\UseCases\Customer\Login;


final class LoginCustomerDto
{
    private string $email;
    private string $password;
    private bool $remember;

    public function __construct(string $email, string $password, bool $remember)
    {
        $this->email = $email;
        $this->password = $password;
        $this->remember = $remember;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function needRemember(): bool
    {
        return $this->remember;
    }
}
