<?php


namespace App\Repositories\Proposal;


use App\Entities\Proposal\Proposal;
use App\Entities\Proposal\ProposalsRepository;
use App\Exceptions\Entities\ProposalNotFoundException;
use Doctrine\Persistence\ObjectRepository;

final class ProposalsDoctrineRepository implements ProposalsRepository
{
    private ObjectRepository $repository;

    public function __construct(ObjectRepository $objectsRepository)
    {
        $this->repository = $objectsRepository;
    }

    public function find($id): Proposal
    {
        return $this->notNull($this->repository->find($id));
    }

    private function notNull($proposal): Proposal
    {
        if ($proposal === null) {
            throw new ProposalNotFoundException();
        }

        return $proposal;
    }
}
