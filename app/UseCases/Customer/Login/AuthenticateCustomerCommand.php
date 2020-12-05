<?php


namespace App\UseCases\Customer\Login;


use App\Events\Business\Customer\CustomerLoggedIn;
use App\Events\Business\Customer\CustomerLoggedOut;
use App\Exceptions\Authentication\CustomerAuthenticationFailed;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Events\Dispatcher;

final class AuthenticateCustomerCommand
{
    private Dispatcher $dispatcher;
    private StatefulGuard $guard;

    public function __construct(Dispatcher $dispatcher, StatefulGuard $guard)
    {
        $this->dispatcher = $dispatcher;
        $this->guard = $guard;
    }

    public function login(LoginCustomerDto $dto): void
    {
        if (!$this->guard->attempt(
            [
                'email.email' => $dto->getEmail(),
                'password'    => $dto->getPassword(),
            ],
            $dto->needRemember()
        )) {
            throw new CustomerAuthenticationFailed($dto->getEmail());
        }

        $this->dispatcher->dispatch(new CustomerLoggedIn($this->guard->id()));
    }

    public function logout(): void
    {
        $id = $this->guard->id();

        $this->guard->logout();

        if ($id !== null) {
            $this->dispatcher->dispatch(new CustomerLoggedOut($id));
        }
    }
}
