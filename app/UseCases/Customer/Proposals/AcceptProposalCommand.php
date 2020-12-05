<?php


namespace App\UseCases\Customer\Proposals;


use App\Entities\Proposal\ProposalsRepository;
use Doctrine\ORM\EntityManagerInterface;

final class AcceptProposalCommand
{
    private ProposalsRepository $proposalsRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(ProposalsRepository $proposalsRepository, EntityManagerInterface $entityManager)
    {
        $this->proposalsRepository = $proposalsRepository;
        $this->entityManager = $entityManager;
    }

    public function execute(AcceptProposalDto $dto): void
    {
        $proposal = $this->proposalsRepository->find($dto->proposalId);
        $proposal->accept();

        $this->entityManager->flush();
    }
}
