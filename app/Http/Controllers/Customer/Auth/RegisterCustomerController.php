<?php


namespace App\Http\Controllers\Customer\Auth;


use App\Exceptions\Entities\CustomerEmailAlreadyTaken;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Register\RegisterCustomerRequest;
use App\UseCases\Customer\Register\RegisterCustomerCommand;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

final class RegisterCustomerController extends Controller
{
    public function showRegistrationForm(): View
    {
        return view('pages.client.auth.register');
    }

    public function register(
        RegisterCustomerRequest $request,
        RegisterCustomerCommand $registerUserCommand
    ): RedirectResponse {
        try {
            $registerUserCommand->execute($request->createDto());
        } catch (CustomerEmailAlreadyTaken $e) {
            return redirect()
                ->back()
                ->withErrors(['login' => trans('auth.login-already-taken')])
                ->withInput();
        }

        return redirect()->route('customer.auth.login');
    }
}
