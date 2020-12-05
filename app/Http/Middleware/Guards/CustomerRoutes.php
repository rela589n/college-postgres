<?php


namespace App\Http\Middleware\Guards;


use App\Routes\AuthenticationRoutes;

final class CustomerRoutes implements AuthenticationRoutes
{
    public static function login(): string
    {
        return route('customer.auth.login');
    }

    public static function home(): string
    {
        return route('customer.dashboard.home');
    }
}
