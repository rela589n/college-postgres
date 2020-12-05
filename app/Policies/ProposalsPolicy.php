<?php


namespace App\Policies;


use App\Entities\Customer\Customer;
use App\Entities\Freelancer\Freelancer;
use App\Entities\Job\Job;
use App\Entities\Proposal\Proposal;
use Illuminate\Auth\Access\HandlesAuthorization;

final class ProposalsPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function fCreate(Freelancer $freelancer, Job $parentJob): bool
    {
        return $parentJob->isNew()
            && !$parentJob->freelancerApplied($freelancer);
    }

    public function fEdit(Freelancer $freelancer, Proposal $proposal): bool
    {
        return !$proposal->isAccepted()
            && $freelancer->isAuthorOf($proposal);
    }

    public function cAccept(Customer $customer, Proposal $proposal): bool
    {
        return $proposal->getJob()->acceptsProposals()
            && $proposal->getJob()->isOwnedBy($customer);
    }
}
