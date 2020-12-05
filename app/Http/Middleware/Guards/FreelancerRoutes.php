<?php


namespace App\Http\Middleware\Guards;


use App\Routes\AuthenticationRoutes;

final class FreelancerRoutes implements AuthenticationRoutes
{
    public static function login(): string
    {
        return route('freelancer.auth.login');
    }

    public static function home(): string
    {
        return route('freelancer.dashboard.home');
    }
}
