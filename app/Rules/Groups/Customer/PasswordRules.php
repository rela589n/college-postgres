<?php


namespace App\Rules\Groups\Customer;


use App\Rules\Groups\RulesGroup;
use App\ValueObjects\Password;

final class PasswordRules extends RulesGroup
{
    protected function rules(): array
    {
        return [
            'required',
            'string',
            'min:'.Password::MIN_LENGTH,
        ];
    }
}
