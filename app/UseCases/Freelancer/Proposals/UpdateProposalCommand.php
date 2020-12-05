<?php


namespace App\UseCases\Freelancer\Proposals;


use App\Entities\Freelancer\Freelancer;
use App\Entities\Proposal\ProposalsRepository;
use App\ValueObjects\CoverLetter;
use App\ValueObjects\EstimatedTime;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Events\Dispatcher as EventsDispatcher;

final class UpdateProposalCommand
{
    private EventsDispatcher $dispatcher;
    private EntityManager $entityManager;
    private StatefulGuard $guard;
    private ProposalsRepository $repository;

    public function __construct(
        EventsDispatcher $dispatcher,
        EntityManager $entityManager,
        ProposalsRepository $repository,
        StatefulGuard $guard
    ) {
        $this->dispatcher = $dispatcher;
        $this->entityManager = $entityManager;
        $this->guard = $guard;
        $this->repository = $repository;
    }

    public function execute($proposalId, UpdateProposalDto $dto): void
    {
        /** @var $freelancer Freelancer */
        $freelancer = $this->guard->user();
        $proposal = $this->repository->find($proposalId);

        $proposal->updateFrom(
            CoverLetter::create($dto->coverLetter),
            EstimatedTime::hours($dto->timeInHours)
        );

        $this->entityManager->persist($proposal);
        $this->entityManager->flush();

        foreach ($proposal->releaseEvents() as $event) {
            $this->dispatcher->dispatch($event);
        }
    }
}
