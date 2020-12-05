<?php

namespace App\Providers;

use App\Entities\Job\Job;
use App\Entities\Proposal\Proposal;
use App\Policies\JobsPolicy;
use App\Policies\ProposalsPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Job::class      => JobsPolicy::class,
        Proposal::class => ProposalsPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //
    }
}
