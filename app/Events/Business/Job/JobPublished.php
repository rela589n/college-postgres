<?php


namespace App\Events\Business\Job;


use App\Entities\Job\Job;

final class JobPublished
{
    private Job $job;

    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    public function getJob(): Job
    {
        return $this->job;
    }
}
