<?php


namespace App\UseCases\Freelancer\Jobs;


use App\Entities\Job\JobsRepository;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Illuminate\Contracts\Auth\StatefulGuard;

final class FinishJobCommand
{
    private EntityManager $entityManager;
    private StatefulGuard $guard;
    private JobsRepository $repository;

    public function __construct(
        EntityManager $entityManager,
        JobsRepository $repository,
        StatefulGuard $guard
    ) {
        $this->entityManager = $entityManager;
        $this->guard = $guard;
        $this->repository = $repository;
    }

    public function execute(FinishJobDto $dto): void
    {
        $job = $this->repository->find($dto->id);
        $job->finish();

        $this->entityManager->flush();
    }
}
