<?php


namespace App\Http\Controllers\Freelancer\Auth;


use App\Exceptions\Authentication\FreelancerAuthenticationFailed;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Guards\FreelancerRoutes;
use App\Http\Requests\Auth\Login\LoginFreelancerRequest;
use App\UseCases\Freelancer\Login\AuthenticateFreelancerCommand;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

final class LoginFreelancerController extends Controller
{
    protected AuthenticateFreelancerCommand $command;

    public function __construct(AuthenticateFreelancerCommand $command)
    {
        $this->command = $command;
    }

    public function showLoginForm(): View
    {
        return view('pages.freelancer.auth.login');
    }

    public function login(LoginFreelancerRequest $request): RedirectResponse
    {
        try {
            $this->command->login($request->createDto());
        } catch (FreelancerAuthenticationFailed $e) {
            return redirect()->back()
                ->withErrors(['login' => trans('auth.failed')])
                ->withInput();
        }

        return redirect()->to(route('freelancer.dashboard.home'));
    }

    public function logout(): RedirectResponse
    {
        $this->command->logout();

        return redirect()->to(FreelancerRoutes::login());
    }
}
