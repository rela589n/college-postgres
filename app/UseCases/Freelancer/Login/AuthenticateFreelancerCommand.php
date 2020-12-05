<?php


namespace App\UseCases\Freelancer\Login;


use App\Events\Business\Freelancer\FreelancerLoggedIn;
use App\Events\Business\Freelancer\FreelancerLoggedOut;
use App\Exceptions\Authentication\FreelancerAuthenticationFailed;
use App\ValueObjects\Email;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Events\Dispatcher;

final class AuthenticateFreelancerCommand
{
    private Dispatcher $dispatcher;
    private StatefulGuard $guard;

    public function __construct(Dispatcher $dispatcher, StatefulGuard $guard)
    {
        $this->dispatcher = $dispatcher;
        $this->guard = $guard;
    }

    public function login(LoginFreelancerDto $dto): void
    {
        if (!$this->guard->attempt(
            [
                'email.email'    => $dto->getEmail(),
                'password' => $dto->getPassword(),
            ],
            $dto->needRemember()
        )) {
            throw new FreelancerAuthenticationFailed($dto->getEmail());
        }

        $this->dispatcher->dispatch(new FreelancerLoggedIn($this->guard->id()));
    }

    public function logout(): void
    {
        $id = $this->guard->id();

        $this->guard->logout();

        $this->dispatcher->dispatch(new FreelancerLoggedOut($id));
    }
}
