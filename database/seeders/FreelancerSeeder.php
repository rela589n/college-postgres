<?php

namespace Database\Seeders;

use App\Entities\Freelancer\Freelancer;
use App\ValueObjects\Email;
use App\ValueObjects\Money;
use App\ValueObjects\Password;
use Faker\Factory;
use Illuminate\Database\Seeder;
use LaravelDoctrine\ORM\Facades\EntityManager;

class FreelancerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $generator = Factory::create();

        for ($i = 0; $i < 10; ++$i) {
            $freelancer = Freelancer::register(
                Email::from($generator->unique()->email),
                Password::fromRaw('password'),
                Money::usd($generator->numberBetween(0, 50))
            );

            EntityManager::persist($freelancer);
        }

        EntityManager::flush();
    }
}
