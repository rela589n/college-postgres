<?php


namespace App\Exceptions\Entities;


use App\ValueObjects\Email;

final class FreelancerEmailAlreadyTaken extends \RuntimeException
{
    private Email $email;

    public function __construct(Email $email)
    {
        parent::__construct(
            trans('exceptions/entities/freelancer.email-already-taken')
        );

        $this->email = $email;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }
}
