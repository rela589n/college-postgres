<?php


namespace App\Exceptions\Authentication;


final class CustomerAuthenticationFailed extends AuthenticationFailed
{
    private string $email;

    public function __construct(string $email)
    {
        parent::__construct(
            trans('exceptions/entities/customer.auth-failed')
        );

        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
