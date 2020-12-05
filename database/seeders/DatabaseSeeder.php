<?php

namespace Database\Seeders;

use App\Entities\Customer\Customer;
use App\ValueObjects\Email;
use App\ValueObjects\Password;
use Faker\Factory;
use Illuminate\Database\Seeder;
use LaravelDoctrine\ORM\Facades\EntityManager;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CustomerSeeder::class);
        $this->call(FreelancerSeeder::class);
        $this->call(ProposalSeeder::class);
    }
}
