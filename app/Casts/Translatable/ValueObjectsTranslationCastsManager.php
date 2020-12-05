<?php


namespace App\Casts\Translatable;


use App\Casts\NullCast;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class ValueObjectsTranslationCastsManager
{
    private string $translationsAttribute;

    public function __construct(string $translationsAttribute)
    {
        $this->translationsAttribute = $translationsAttribute;
    }

    public function translate(Model $model, string $key, string $valueToSet): array
    {
        $clone = clone $model;
        $clone->mergeCasts([$key => NullCast::class]);
        $clone->{$this->translationsAttribute} = $valueToSet;

        return $clone->getAttributes();
    }

    public function translateMultiple(User $model, string $key, Collection $values): array
    {
        $clone = clone $model;
        $clone->mergeCasts([$key => NullCast::class]);

        $values->map(
            fn(string $localizedName, string $locale) => $clone->setTranslation(
                $this->translationsAttribute,
                $locale,
                $localizedName
            ),
        );

        return $clone->getAttributes();
    }
}
