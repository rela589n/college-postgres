<?php

namespace App\Providers;

use App\Entities\Customer\Customer;
use App\Entities\Customer\CustomersRepository;
use App\Entities\Job\Job;
use App\Entities\Job\JobsRepository;
use App\Entities\Proposal\Proposal;
use App\Entities\Proposal\ProposalsRepository;
use App\Http\Controllers\Customer\Auth\LoginCustomerController;
use App\Http\Controllers\Customer\Dashboard\Proposals\OffersController;
use App\Http\Controllers\Freelancer\Auth\LoginFreelancerController;
use App\Http\Controllers\Freelancer\Dashboard\FreelancerProposalsController;
use App\Http\Controllers\Freelancer\Dashboard\Jobs\JobsController;
use App\Http\Middleware\Guards\CustomerGuard;
use App\Http\Middleware\Guards\FreelancerGuard;
use App\Repositories\Customer\CustomersDoctrineRepository;
use App\Repositories\Job\JobsDoctrineRepository;
use App\Repositories\Proposal\ProposalsDoctrineRepository;
use App\UseCases\Customer\Login\AuthenticateCustomerCommand;
use App\UseCases\Freelancer\Jobs\FinishJobCommand;
use App\UseCases\Freelancer\Login\AuthenticateFreelancerCommand;
use App\UseCases\Freelancer\Proposals\StoreProposalCommand;
use App\UseCases\Freelancer\Proposals\UpdateProposalCommand;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use LaravelDoctrine\ORM\Facades\EntityManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerWebGuardBindings();

        $this->registerDoctrineRepositories();

        $this->registerDevDependencies();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    private function registerWebGuardBindings(): void
    {
        $this->app->when(
            [
                LoginCustomerController::class,
                AuthenticateCustomerCommand::class,
                OffersController::class,
            ]
        )->needs(StatefulGuard::class)
            ->give(
                static function () {
                    return Auth::guard(CustomerGuard::web());
                }
            );

        $this->app->when(
            [
                LoginFreelancerController::class,
                AuthenticateFreelancerCommand::class,
                JobsController::class,
                FreelancerProposalsController::class,
                StoreProposalCommand::class,
                UpdateProposalCommand::class,
                FinishJobCommand::class,
            ]
        )->needs(StatefulGuard::class)
            ->give(
                static function () {
                    return Auth::guard(FreelancerGuard::web());
                }
            );
    }

    private function registerDoctrineRepositories(): void
    {
        $this->app->bind(
            CustomersRepository::class,
            static function () {
                return new CustomersDoctrineRepository(
                    EntityManager::getRepository(Customer::class)
                );
            }
        );

        $this->app->bind(
            JobsRepository::class,
            static function () {
                return new JobsDoctrineRepository(
                    EntityManager::getRepository(Job::class)
                );
            }
        );

        $this->app->bind(
            ProposalsRepository::class,
            static function () {
                return new ProposalsDoctrineRepository(
                    EntityManager::getRepository(Proposal::class)
                );
            }
        );
    }

    private function registerDevDependencies(): void
    {
        if (config('app.env') === 'development') {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
