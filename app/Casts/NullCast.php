<?php


namespace App\Casts;


use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

final class NullCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return [];
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return [];
    }
}
