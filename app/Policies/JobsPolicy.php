<?php

namespace App\Policies;

use App\Entities\Customer\Customer;
use App\Entities\Freelancer\Freelancer;
use App\Entities\Job\Job;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobsPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function fView()
    {
        return true;
    }

    public function cView()
    {
        return true;
    }

    public function cEdit(Customer $customer, Job $job): bool
    {
        return $job->isEditable() && $job->getCustomer() === $customer;
    }
}
