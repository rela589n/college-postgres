<?php


namespace App\Http\Requests\Auth\Login;


use App\Http\Requests\AppFormRequest;
use App\Rules\Groups\Customer\LoginRules;
use App\Rules\Groups\Customer\PasswordRules;
use App\UseCases\Freelancer\Login\LoginFreelancerDto;

final class LoginFreelancerRequest extends AppFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @param  LoginRules  $loginRules
     * @param  PasswordRules  $passwordRules
     * @return array
     */
    public function rules(LoginRules $loginRules, PasswordRules $passwordRules): array
    {
        return [
            'login'    => $loginRules->get(),
            'password' => $passwordRules->get(),
        ];
    }

    public function createDto(): LoginFreelancerDto
    {
        return new LoginFreelancerDto(
            $this->input('login'),
            $this->input('password'),
            $this->has('remember')
        );
    }
}
