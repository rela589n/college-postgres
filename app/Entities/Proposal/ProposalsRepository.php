<?php


namespace App\Entities\Proposal;


interface ProposalsRepository
{
    public function find($id): Proposal;
}
