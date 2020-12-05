<?php


namespace App\Http\Middleware\Guards;


final class FreelancerWebMiddleware
{
    public static function guest(): string
    {
        return 'guest:'.FreelancerGuard::web();
    }

    public static function auth(): string
    {
        return 'auth:'.FreelancerGuard::web();
    }
}
