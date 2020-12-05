<?php


namespace App\Http\Middleware\Guards;


use App\Entities\Freelancer\Freelancer;

final class FreelancerGuard
{
    public static function web(): string
    {
        return 'web_'. Freelancer::class;
    }
}
