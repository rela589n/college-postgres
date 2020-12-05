<?php


namespace App\UseCases\Freelancer\Register;


use App\Entities\Freelancer\Freelancer;
use App\ValueObjects\Email;
use App\ValueObjects\Money;
use App\ValueObjects\Password;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Illuminate\Contracts\Events\Dispatcher;

final class RegisterFreelancerCommand
{
    private Dispatcher $dispatcher;
    private EntityManager $entityManager;

    public function __construct(Dispatcher $dispatcher, EntityManager $entityManager)
    {
        $this->dispatcher = $dispatcher;
        $this->entityManager = $entityManager;
    }

    public function execute(RegisterFreelancerDto $dto): void
    {
        $email = Email::from($dto->getEmail());
        $password = Password::fromRaw($dto->getPassword());
        $hourRate = Money::usd($dto->getHourRate());

        $freelancer = Freelancer::register($email, $password, $hourRate);
        $this->entityManager->persist($freelancer);

        $this->entityManager->flush();

        foreach ($freelancer->releaseEvents() as $event) {
            $this->dispatcher->dispatch($event);
        }
    }
}
