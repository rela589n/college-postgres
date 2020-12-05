<?php

namespace App\Http\Requests;

use App\UseCases\Customer\Jobs\PublishJobDto;
use App\ValueObjects\JobDescription;
use App\ValueObjects\JobTitle;
use Illuminate\Foundation\Http\FormRequest;

class StoreJobOfferRequest extends FormRequest
{
    public function rules()
    {
        return [
            'public_name' => [
                'required',
                'string',
                'min:'.JobTitle::MIN_LENGTH,
                'max:'.JobTitle::MAX_LENGTH,
            ],
            'description' => [
                'required',
                'string',
                'min:'.JobDescription::MIN_LENGTH,
                'max:'.JobDescription::MAX_LENGTH,
            ]
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function makeDto(): PublishJobDto
    {
        return new PublishJobDto($this->input('public_name'), $this->input('description'));
    }
}
