<?php


namespace App\UseCases\Customer\Jobs;


use App\Entities\Customer\Customer;
use App\Entities\Job\Job;
use App\Entities\Job\JobsRepository;
use App\ValueObjects\JobDescription;
use App\ValueObjects\JobTitle;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Illuminate\Contracts\Events\Dispatcher as EventsDispatcher;

final class UpdateJobCommand
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

    public function execute(string $id, Customer $customer, UpdateJobDto $dto): Job
    {
        $job = $this->repository->find($id);
        $job->updateFrom(JobTitle::create($dto->publicName), JobDescription::create($dto->description));

        $this->entityManager->persist($job);
        $this->entityManager->flush();

        foreach ($job->releaseEvents() as $event) {
            $this->dispatcher->dispatch($event);
        }

        return $job;
    }
}
