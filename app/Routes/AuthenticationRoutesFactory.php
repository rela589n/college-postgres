<?php


namespace App\Routes;


use App\Entities\Customer\Customer;
use App\Entities\Freelancer\Freelancer;
use App\Http\Middleware\Guards\CustomerRoutes;
use App\Http\Middleware\Guards\FreelancerRoutes;
use RuntimeException;

final class AuthenticationRoutesFactory
{
    /**
     * @param  string  $model
     * @return string|AuthenticationRoutes
     */
    public static function resolve(string $model): string
    {
        if ($model === Customer::class) {
            return CustomerRoutes::class;
        }

        if ($model === Freelancer::class) {
            return FreelancerRoutes::class;
        }

        throw new RuntimeException('Auth routes not defined for model: '.$model);
    }
}
