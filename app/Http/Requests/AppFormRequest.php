<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class AppFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Returns true, because authorization has to be in another place.
     *
     * @return true
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function validationData(): array
    {
        if ($this->isJson()) {
            return $this->json()->all();
        }

        return parent::validationData();
    }
}
