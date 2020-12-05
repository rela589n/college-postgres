<?php


namespace App\Http\Middleware\Guards;


use App\Entities\Freelancer\Freelancer;

final class FreelancerProvider
{
    public static function doctrine(): string
    {
        return 'doctrine_'.Freelancer::class;
    }
}
