<?php


namespace App\Events\Business\Proposal;


use App\Entities\Proposal\Proposal;

final class ProposalPosted
{
    private Proposal $proposal;

    public function __construct(Proposal $proposal)
    {
        $this->proposal = $proposal;
    }

    public function getProposal(): Proposal
    {
        return $this->proposal;
    }
}
