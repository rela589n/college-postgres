<?php

namespace App\Casts;

use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class NameCast implements CastsAttributes
{
    private string $valueObjectKey;
    private string $translationKey;

    public function __construct(string $valueObjectKey, string $translationKey)
    {
        $this->valueObjectKey = $valueObjectKey;
        $this->translationKey = $translationKey;
    }

    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, $key, $value, $attributes)
    {
        dd('get');
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  User  $model
     * @param  string  $key
     * @param  UserName  $value
     * @param  array  $attributes
     * @return string|array
     * @throws \JsonException
     */
    public function set($model, $key, $value, $attributes)
    {
        $model->setTranslation($this->valueObjectKey, $model->getLocale(), $value);

        return [
            $this->translationKey => json_encode(
                array_merge(
                    json_decode($model->{$this->translationKey} ?? '{}', true, 512, JSON_THROW_ON_ERROR),
                    [
                        $model->getLocale() => [
                            'first_name' => $value->getFirstName(),
                        ],
                    ],
                ),
                JSON_THROW_ON_ERROR
            )
        ];
    }
}
