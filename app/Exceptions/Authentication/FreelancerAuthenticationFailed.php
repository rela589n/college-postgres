<?php


namespace App\Exceptions\Authentication;


final class FreelancerAuthenticationFailed extends AuthenticationFailed
{
    private string $email;

    public function __construct(string $email)
    {
        parent::__construct(
            trans('exceptions/entities/freelancer.auth-failed')
        );

        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
