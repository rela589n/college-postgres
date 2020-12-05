<?php


namespace App\Events\Business\Freelancer;


use App\Entities\Freelancer\Freelancer;

final class FreelancerRegistered
{
    private Freelancer $freelancer;

    public function __construct(Freelancer $freelancer)
    {
        $this->freelancer = $freelancer;
    }

    public function getFreelancer(): Freelancer
    {
        return $this->freelancer;
    }
}
