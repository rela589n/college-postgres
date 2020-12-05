<?php


namespace App\Exceptions\Entities;


use App\ValueObjects\Email;

final class CustomerEmailAlreadyTaken extends \RuntimeException
{
    private Email $email;

    public function __construct(Email $email)
    {
        parent::__construct(
            trans('exceptions/entities/customer.email-already-taken')
        );

        $this->email = $email;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }
}
