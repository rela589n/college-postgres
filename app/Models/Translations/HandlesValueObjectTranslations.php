<?php


namespace App\Models\Translations;


use Closure;
use RuntimeException;
use Spatie\Translatable\HasTranslations;

trait HandlesValueObjectTranslations
{
    private array $translatedObjects = [];

    use HasTranslations {
        setTranslation as private doSetTranslation;
        guardAgainstNonTranslatableAttribute as private doGuardAgainstNonTranslatableAttribute;
        getTranslations as private doGetTranslations;
        getTranslation as private doGetTranslation;
        setLocale as private doSetLocale;
    }

    public function setTranslation(string $key, string $locale, $value): self
    {
        if (!$this->usesValueObject($key)) {
            return $this->doSetTranslation($key, $locale, $value);
        }

        $this->substituteLocaleAndDo(
            $locale,
            $key,
            fn() => $this->{$key} = $value
        );

        $this->translatedObjects[$key][$locale] = $value;

        return $this;
    }

    public function getTranslations(string $propertyName = null): array
    {
        if ($propertyName !== null
            && !$this->usesValueObject($propertyName)) {
            return $this->doGetTranslations($propertyName);
        }

        $hydrator = function (array $translated, string $property) {
            $valueObjectKey = $this->getValueObjectKeyByPlainTranslationKey($property);
            $result = collect($translated)
                ->map(
                    function (string $translation, string $locale) use ($valueObjectKey) {
                        return $this->getTranslation($valueObjectKey, $locale);
                    }
                )
                ->toArray();
            dd($result);
//            array_map(function($) {},$translated);
            $this->getTranslation($key, $property);
        };

        return collect($this->doGetTranslations($propertyName))
            ->map($hydrator)->toArray();
    }

    public function setLocale(string $locale): self
    {
        if ($this->getLocale() === $locale){
            return $this;
        }

        $translations = $this->getTranslations();

        foreach ($this->getTranslatableAttributes() as $propertyName => $translationName) {
            $this->{$propertyName} = $translations[$propertyName][$locale];
        }

        $this->doSetLocale($locale);

        return $this;
    }

    public function getTranslation(string $key, string $locale, bool $useFallbackLocale = true)
    {
        if (!$this->usesValueObject($key)) {
            return $this->doGetTranslation($key, $locale, $useFallbackLocale);
        }

        return $this->substituteLocaleAndDo(
            $locale,
            $key,
            fn() => $this->{$key}
        );
    }

    public function guardAgainstNonTranslatableAttribute(string $key): void
    {
        if ($this->usesValueObject($key)) {
            return;
        }

        $this->doGuardAgainstNonTranslatableAttribute($key);
    }

    private function getValueObjectKeyByPlainTranslationKey(string $key)
    {
        $result = array_search($key, $this->getTranslatableAttributes(), true);

        if (!$result) {
            throw new RuntimeException(
                'Every entry in $translatable have to have value object key with corresponding casts set up'
            );
        }

        return $result;
    }

    private function usesValueObject($key): bool
    {
        return array_key_exists($key, $this->getTranslatableAttributes());
    }

    private function substituteLocaleAndDo(string $locale, string $propertyName, Closure $callback)
    {
        $oldLocale = $this->getLocale();
        $oldValueObject = $this->{$propertyName};

        $this->setLocale($locale);
        $result = $callback();

        if ($oldLocale !== $locale) {
            $this->setLocale($oldLocale);

            $this->{$propertyName} = $oldValueObject;
        }

        return $result;
    }
}
