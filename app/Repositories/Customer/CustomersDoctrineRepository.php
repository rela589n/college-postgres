<?php


namespace App\Repositories\Customer;


use App\Entities\Customer\Customer;
use App\Entities\Customer\CustomersRepository;
use App\Exceptions\Entities\CustomerNotFoundException;
use App\ValueObjects\Email;
use Doctrine\Persistence\ObjectRepository;

final class CustomersDoctrineRepository implements CustomersRepository
{
    private ObjectRepository $repository;

    public function __construct(ObjectRepository $objectsRepository)
    {
        $this->repository = $objectsRepository;
    }

    public function find($id): Customer
    {
        $customer = $this->repository->find($id);

        return $this->notNull($customer);
    }

    public function findOneBy(array $criteria): Customer
    {
        $entity = $this->repository->findOneBy($criteria);

        return $this->notNull($entity);
    }

    public function findByEmail(Email $email): Customer
    {
        $entity = $this->repository->findOneBy(
            [
                'email.email' => (string)$email,
            ]
        );

        return $this->notNull($entity);
    }

    public function existsCustomerWithEmail(Email $email): bool
    {
        try {
            $this->findByEmail($email);
            return true;
        } catch (CustomerNotFoundException $e) {
            return false;
        }
    }

    private function notNull($customer): Customer
    {
        if ($customer === null) {
            throw new CustomerNotFoundException();
        }

        return $customer;
    }
}
