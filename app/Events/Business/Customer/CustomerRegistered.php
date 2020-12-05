<?php


namespace App\Events\Business\Customer;


use App\Entities\Customer\Customer;

final class CustomerRegistered
{
    private Customer $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }
}
