<?php

namespace App\Http\Requests;

use App\UseCases\Customer\Jobs\PublishJobDto;
use App\UseCases\Customer\Jobs\UpdateJobDto;
use App\ValueObjects\JobDescription;
use App\ValueObjects\JobTitle;
use Illuminate\Foundation\Http\FormRequest;

class UpdateJobRequest extends FormRequest
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
    public function makeDto(): UpdateJobDto
    {
        return new UpdateJobDto($this->input('public_name'), $this->input('description'));
    }
}
