<?php

namespace Database\Seeders;

use App\Entities\Customer\Customer;
use App\Entities\Freelancer\Freelancer;
use App\Entities\Job\Job;
use App\Entities\Proposal\Proposal;
use App\ValueObjects\CoverLetter;
use App\ValueObjects\Email;
use App\ValueObjects\EstimatedTime;
use App\ValueObjects\JobDescription;
use App\ValueObjects\JobTitle;
use App\ValueObjects\Money;
use App\ValueObjects\Password;
use Faker\Factory;
use Illuminate\Database\Seeder;
use LaravelDoctrine\ORM\Facades\EntityManager;

class ProposalSeeder extends Seeder
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
            $proposal = Proposal::post(
                CoverLetter::create($generator->text),
                EstimatedTime::hours($generator->numberBetween(0, 50)),
                Job::publish(
                    JobTitle::create($generator->text(JobTitle::MAX_LENGTH)),
                    JobDescription::create($generator->text(JobDescription::MAX_LENGTH)),
                    Customer::register(
                        Email::from($generator->unique()->email),
                        Password::fromRaw('password'),
                    )
                ),
                Freelancer::register(
                    Email::from($generator->unique()->email),
                    Password::fromRaw('password'),
                    Money::usd($generator->numberBetween(0, 70)),
                )
            );

            EntityManager::persist($proposal);
        }

        EntityManager::flush();
    }
}
