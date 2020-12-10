<?php


namespace App\Repositories\Job;


use App\Entities\Job\Job;
use App\Entities\Job\JobsRepository;
use App\Exceptions\Entities\JobNotFoundException;
use App\Filters\Job\JobsDoctrineFilter;
use App\ValueObjects\JobStatus;
use App\ValueObjects\ProposalStatus;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ObjectRepository;
use LaravelDoctrine\ORM\Facades\EntityManager;

final class JobsDoctrineRepository implements JobsRepository
{
    private ObjectRepository $repository;

    public function __construct(ObjectRepository $objectsRepository)
    {
        $this->repository = $objectsRepository;
    }

    public function find($id): Job
    {
        $customer = $this->repository->find($id);

        return $this->notNull($customer);
    }

    public function notNull($job): Job
    {
        if ($job === null) {
            throw new JobNotFoundException();
        }

        return $job;
    }

    public function findByCustomerId(string $customerId): Collection
    {
        return new ArrayCollection($this->repository->findBy(['customer' => $customerId]));
    }

    public function findAll(): Collection
    {
        return new ArrayCollection($this->repository->findAll());
    }

    public function inWorkByCustomer(string $customerId): Collection
    {
        return new ArrayCollection(
            $this->repository->findBy(
                [
                    'status.status' => JobStatus::inWork()->value()
                ]
            )
        );
    }

    public function finishedByCustomer(string $customerId): Collection
    {
        return new ArrayCollection(
            $this->repository->findBy(
                [
                    'status.status' => JobStatus::finished()->value(),
                    'customer'      => $customerId,
                ]
            )
        );
    }

    public function findFreelancerAppliedOn(string $freelancerId): Collection
    {
        $dql = EntityManager::createQueryBuilder()
            ->select('j')
            ->from(Job::class, 'j')
            ->innerJoin('j.proposals', 'p')
            ->where('p.freelancer=:fr_id')
            ->getDQL();

        $query = EntityManager::createQuery($dql);
        $query->setParameter('fr_id', $freelancerId);

        return new ArrayCollection($query->getResult());
    }

    public function finishedByFreelancer(string $freelancerId): Collection
    {
        return new ArrayCollection(
            $this->repository->findBy(
                [
                    'status.status' => JobStatus::finished()->value(),
                ]
            )
        );
    }

    public function inWorkByFreelancer(string $freelancerId): Collection
    {
        $dql = EntityManager::createQueryBuilder()
            ->select('j')
            ->from(Job::class, 'j')
            ->innerJoin('j.proposals', 'p')
            ->where('p.freelancer=:fr_id')
            ->andWhere('p.status.status=:p_status')
            ->andWhere('j.status.status=:job_stat')
            ->getDQL();

        $query = EntityManager::createQuery($dql);
        $query->setParameter('fr_id', $freelancerId);
        $query->setParameter('p_status', ProposalStatus::accepted()->value());
        $query->setParameter('job_stat', JobStatus::inWork()->value());

//        dump($query->getSQL());
//        dd($query->getResult(AbstractQuery::HYDRATE_SCALAR));
        return new ArrayCollection($query->getResult());
    }

    public function filteredJobs(array $filters): Collection
    {
        $builder = EntityManager::createQueryBuilder()
            ->select('job')
            ->from(Job::class, 'job');

        $filter = new JobsDoctrineFilter($filters);
        $filter->filterQuery($builder);

        $query = $builder->getQuery();

        return new ArrayCollection($query->getResult());
    }
}
