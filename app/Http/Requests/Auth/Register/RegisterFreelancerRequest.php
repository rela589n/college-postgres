<?php


namespace App\Http\Requests\Auth\Register;


use App\Http\Requests\AppFormRequest;
use App\Rules\Groups\Customer\LoginRules;
use App\Rules\Groups\Customer\PasswordRules;
use App\UseCases\Freelancer\Register\RegisterFreelancerDto;

final class RegisterFreelancerRequest extends AppFormRequest
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
            'login'                 => $loginRules->get(),
//            'hour_rate'             => [
//                'required',
//                'float',
//                'min:'. 1,
//                'max:'. 25,
//            ],
            'password'              => $passwordRules->merge(['confirmed'])->get(),
            'password_confirmation' => $passwordRules->get()
        ];
    }

    public function createDto(): RegisterFreelancerDto
    {
        return new RegisterFreelancerDto(
            $this->input('login'),
            $this->input('password'),
        );
    }
}
