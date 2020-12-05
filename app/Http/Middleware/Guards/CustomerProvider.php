<?php


namespace App\Http\Middleware\Guards;


use App\Entities\Customer\Customer;

final class CustomerProvider
{
    public static function doctrine(): string
    {
        return 'doctrine_'.Customer::class;
    }
}
