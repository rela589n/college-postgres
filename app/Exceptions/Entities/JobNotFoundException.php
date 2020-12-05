<?php


namespace App\Exceptions\Entities;


final class JobNotFoundException extends EntityNotFoundException
{
    public function __construct()
    {
        parent::__construct(trans('exceptions/entities/job.not-found'));
    }
}
