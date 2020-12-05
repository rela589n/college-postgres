<?php


namespace App\UseCases\Customer\Jobs;


use App\Entities\Customer\Customer;
use App\ValueObjects\JobDescription;
use App\ValueObjects\JobTitle;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Illuminate\Contracts\Events\Dispatcher as EventsDispatcher;

final class PublishJobCommand
{
    private EventsDispatcher $dispatcher;
    private EntityManager $entityManager;

    public function __construct(EventsDispatcher $dispatcher, EntityManager $entityManager)
    {
        $this->dispatcher = $dispatcher;
        $this->entityManager = $entityManager;
    }

    public function execute(Customer $customer, PublishJobDto $dto): void
    {
        $job = $customer->publishJob(JobTitle::create($dto->publicName), JobDescription::create($dto->description));
        $this->entityManager->persist($job);
        $this->entityManager->flush();

        foreach ($job->releaseEvents() as $event) {
            $this->dispatcher->dispatch($event);
        }
    }
}
