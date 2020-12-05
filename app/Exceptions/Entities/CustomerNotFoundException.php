<?php


namespace App\Exceptions\Entities;


final class CustomerNotFoundException extends EntityNotFoundException
{
    public function __construct()
    {
        parent::__construct(trans('exceptions/entities/customer.not-found'));
    }
}
