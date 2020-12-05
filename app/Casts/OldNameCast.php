<?php

namespace App\Casts;

use App\Casts\Translatable\ValueObjectsTranslationCastsManager;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Arr;

class OldNameCast implements CastsAttributes
{
    private string $translationsAttribute;
    private ValueObjectsTranslationCastsManager $valueObjectsTranslator;

    public function __construct(string $translationsAttribute)
    {
        $this->translationsAttribute = $translationsAttribute;
        $this->valueObjectsTranslator = new ValueObjectsTranslationCastsManager($translationsAttribute);
    }

    /**
     * Cast the given value.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string                              $key
     * @param mixed                               $value
     * @param array                               $attributes
     *
     * @return mixed
     */
    public function get($model, $key, $value, $attributes)
    {
        return new UserName($model->{$this->translationsAttribute});
    }

    /**
     * Prepare the given value for storage.
     *
     * @param User   $model
     * @param string $key
     * @param mixed  $value
     * @param array  $attributes
     *
     * @return string|array
     */
    public function set($model, $key, $value, $attributes)
    {
        if ($value instanceof UserName) {
            return $this->valueObjectsTranslator->translate($model, $key, $value->getFirstName());
        }
        if (is_array($value)) {
            $values = collect($value);

            return $this->valueObjectsTranslator->translateMultiple(
                $model,
                $key,
                $values->map(fn(UserName $localizedName) => $localizedName->getFirstName()),
            );
        }

        throw new \InvalidArgumentException('Only username or array of usernames is supported');
    }
}
