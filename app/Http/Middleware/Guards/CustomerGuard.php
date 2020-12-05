<?php


namespace App\Http\Middleware\Guards;


use App\Entities\Customer\Customer;

final class CustomerGuard
{
    public static function web(): string
    {
        return 'web_'. Customer::class;
    }
}
