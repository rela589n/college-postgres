<?php


namespace App\UseCases\Customer\Jobs;


use App\Entities\Customer\Customer;
use App\Entities\Job\JobsRepository;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Illuminate\Contracts\Events\Dispatcher as EventsDispatcher;

final class DestroyJobCommand
{
    private EventsDispatcher $dispatcher;
    private EntityManager $entityManager;
    private JobsRepository $repository;

    public function __construct(EventsDispatcher $dispatcher, EntityManager $entityManager, JobsRepository $repository)
    {
        $this->dispatcher = $dispatcher;
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }

    public function execute(Customer $customer, string $id): void
    {
        $job = $this->repository->find($id);

        $this->entityManager->remove($job);

        $this->entityManager->flush();
    }
}
