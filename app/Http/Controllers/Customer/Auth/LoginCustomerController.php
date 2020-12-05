<?php


namespace App\Http\Controllers\Customer\Auth;


use App\Exceptions\Authentication\CustomerAuthenticationFailed;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Guards\CustomerRoutes;
use App\Http\Requests\Auth\Login\LoginCustomerRequest;
use App\UseCases\Customer\Login\AuthenticateCustomerCommand;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

final class LoginCustomerController extends Controller
{
    protected AuthenticateCustomerCommand $command;

    public function __construct(AuthenticateCustomerCommand $command)
    {
        $this->command = $command;
    }

    public function showLoginForm(): View
    {
        return view('pages.client.auth.login');
    }

    public function login(LoginCustomerRequest $request): RedirectResponse
    {
        try {
            $this->command->login($request->createDto());
        } catch (CustomerAuthenticationFailed $e) {
            return redirect()->back()
                ->withErrors(['login' => trans('auth.failed')])
                ->withInput();
        }

        return redirect()->to(route('customer.dashboard.home'));
    }

    public function logout(): RedirectResponse
    {
        $this->command->logout();

        return redirect()->to(CustomerRoutes::login());
    }
}
