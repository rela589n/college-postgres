<?php


namespace App\Exceptions\Entities;


final class ProposalNotFoundException extends EntityNotFoundException
{
    public function __construct()
    {
        parent::__construct(trans('exceptions/entities/proposal.not-found'));
    }
}
