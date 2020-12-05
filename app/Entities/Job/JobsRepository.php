<?php


namespace App\Entities\Job;


use Doctrine\Common\Collections\Collection;

interface JobsRepository
{
    public function find($id): Job;

    /**
     * @param  string  $customerId
     * @return Collection|Job[]
     */
    public function findByCustomerId(string $customerId): Collection;

    /**
     * @return Collection|Job[]
     */
    public function findAll(): Collection;

    /**
     * @param $customerId
     * @return Collection|Job[]
     */
    public function inWorkByCustomer(string $customerId): Collection;

    /**
     * @param $customerId
     * @return Collection|Job[]
     */
    public function finishedByCustomer(string $customerId): Collection;

    /**
     * @param  string  $freelancerId
     * @return Collection|Job[]
     */
    public function findFreelancerAppliedOn(string $freelancerId): Collection;

    /**
     * @param  string  $freelancerId
     * @return Collection|Job[]
     */
    public function finishedByFreelancer(string $freelancerId): Collection;

    /**
     * @param $freelancerId
     * @return Collection|Job[]
     */
    public function inWorkByFreelancer(string $freelancerId): Collection;
}
