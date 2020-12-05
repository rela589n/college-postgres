<?php

namespace App\Exceptions;

use App\Entities\Proposal\Proposal;

class FreelancerAlreadyAppliedForThisJobException extends \RuntimeException
{
    private Proposal $proposal;

    public function __construct(Proposal $proposal)
    {
        parent::__construct(
            trans('exceptions/entities/job.freelancer-already-applied')
        );
        $this->proposal = $proposal;
    }

    public function getProposal(): Proposal
    {
        return $this->proposal;
    }
}
