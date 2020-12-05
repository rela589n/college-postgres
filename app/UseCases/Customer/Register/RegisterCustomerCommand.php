<?php


namespace App\UseCases\Customer\Register;


use App\Entities\Customer\Customer;
use App\Entities\Customer\CustomersRepository;
use App\Exceptions\Entities\CustomerEmailAlreadyTaken;
use App\ValueObjects\Email;
use App\ValueObjects\Password;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Illuminate\Contracts\Events\Dispatcher;

final class RegisterCustomerCommand
{
    private Dispatcher $dispatcher;
    private EntityManager $entityManager;
    private CustomersRepository $repository;

    public function __construct(Dispatcher $dispatcher, EntityManager $entityManager, CustomersRepository $repository)
    {
        $this->dispatcher = $dispatcher;
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }

    public function execute(RegisterCustomerDto $dto): void
    {
        $email = Email::from($dto->getEmail());
        $password = Password::fromRaw($dto->getPassword());

        if ($this->repository->existsCustomerWithEmail($email)) {
            throw new CustomerEmailAlreadyTaken($email);
        }

        $customer = Customer::register($email, $password);
        $this->entityManager->persist($customer);

        $this->entityManager->flush();
        foreach ($customer->releaseEvents() as $event) {
            $this->dispatcher->dispatch($event);
        }
    }
}
