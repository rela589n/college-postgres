<?php


namespace App\UseCases\Freelancer\Proposals;


use App\Entities\Freelancer\Freelancer;
use App\Entities\Job\JobsRepository;
use App\Entities\Proposal\Proposal;
use App\ValueObjects\CoverLetter;
use App\ValueObjects\EstimatedTime;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Events\Dispatcher as EventsDispatcher;

final class StoreProposalCommand
{
    private EventsDispatcher $dispatcher;
    private EntityManager $entityManager;
    private StatefulGuard $guard;
    private JobsRepository $repository;

    public function __construct(EventsDispatcher $dispatcher, EntityManager $entityManager, JobsRepository $repository, StatefulGuard $guard)
    {
        $this->dispatcher = $dispatcher;
        $this->entityManager = $entityManager;
        $this->guard = $guard;
        $this->repository = $repository;
    }

    public function execute($jobId, StoreProposalDto $dto): void
    {
        /** @var $freelancer Freelancer */
        $freelancer = $this->guard->user();
        $job = $this->repository->find($jobId);

        $proposal = Proposal::post(
            CoverLetter::create($dto->coverLetter),
            EstimatedTime::hours($dto->timeInHours),
            $job,
            $freelancer
        );

        $this->entityManager->persist($proposal);
        $this->entityManager->flush();

        foreach ($proposal->releaseEvents() as $event) {
            $this->dispatcher->dispatch($event);
        }
    }
}
