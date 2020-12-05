<?php


namespace App\Http\Controllers\Freelancer\Auth;


use App\Exceptions\Entities\FreelancerEmailAlreadyTaken;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Register\RegisterFreelancerRequest;
use App\UseCases\Freelancer\Register\RegisterFreelancerCommand;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

final class RegisterFreelancerController extends Controller
{
    public function showRegistrationForm(): View
    {
        return view('pages.freelancer.auth.register');
    }

    public function register(
        RegisterFreelancerRequest $request,
        RegisterFreelancerCommand $registerUserCommand
    ): RedirectResponse {
        try {
            $registerUserCommand->execute($request->createDto());
        } catch (FreelancerEmailAlreadyTaken $e) {
            return redirect()
                ->back()
                ->withErrors(['login' => trans('auth.login-already-taken')])
                ->withInput();
        }

        return redirect()->route('freelancer.auth.login');
    }
}
