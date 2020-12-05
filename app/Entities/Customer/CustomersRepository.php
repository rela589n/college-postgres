<?php


namespace App\Entities\Customer;


use App\ValueObjects\Email;

interface CustomersRepository
{
    public function find($id): Customer;

    public function findOneBy(array $criteria): Customer;

    public function findByEmail(Email $email): Customer;

    public function existsCustomerWithEmail(Email $email): bool;
}
