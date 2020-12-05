<?php


namespace App\Rules\Groups\Customer;


use App\Rules\Groups\RulesGroup;

final class LoginRules extends RulesGroup
{
    protected function rules(): array
    {
        return [
            'required',
            'email',
        ];
    }
}
