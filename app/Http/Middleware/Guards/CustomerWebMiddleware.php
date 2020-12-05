<?php


namespace App\Http\Middleware\Guards;


final class CustomerWebMiddleware
{
    public static function guest(): string
    {
        return 'guest:'.CustomerGuard::web();
    }

    public static function auth(): string
    {
        return 'auth:'.CustomerGuard::web();
    }
}
