<?php


namespace App\UseCases\Customer\Proposals;


final class AcceptProposalDto
{
    public string $proposalId;

    public function __construct(string $proposalId)
    {
        $this->proposalId = $proposalId;
    }
}
