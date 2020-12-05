<?php

namespace Database\Seeders;

use App\Entities\Customer\Customer;
use App\ValueObjects\Email;
use App\ValueObjects\Password;
use Faker\Factory;
use Illuminate\Database\Seeder;
use LaravelDoctrine\ORM\Facades\EntityManager;

class CustomerSeeder extends Seeder
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
            $customer = Customer::register(Email::from($generator->unique()->email), Password::fromRaw('password'));
            EntityManager::persist($customer);
        }

        EntityManager::flush();
    }
}
