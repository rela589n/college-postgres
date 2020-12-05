<?php

namespace App\Providers;

use App\Http\Middleware\Guards\CustomerGuard;
use App\Http\Middleware\Guards\FreelancerGuard;
use App\Http\ViewComposers\AuthUserViewComposer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        View::composer(
            [
                'pages.client.*',
                'components.entities.offers.table',
                'components.entities.offers.table-explore',
                'components.entities.offers.table-in-work',
                'components.entities.offers.table-finished',
                'components.proposals.list-for-c',
            ],
            function ($view) {
                (new AuthUserViewComposer(Auth::guard(CustomerGuard::web())))->compose($view);
            }
        );

        View::composer(
            [
                'pages.freelancer.*',
                'components.proposals.list-for-f',
            ],
            function ($view) {
                (new AuthUserViewComposer(Auth::guard(FreelancerGuard::web())))->compose($view);
            }
        );
    }
}
