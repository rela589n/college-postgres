<?php


namespace App\Models\Translations;


trait HasObjectTranslations
{
    protected ?string $translationLocale = null;
    private array $translatedObjects = [];

    public function getLocale(): string
    {
        return $this->translationLocale ?? config('app.locale');
    }

    public function setLocale(string $locale): void
    {
        $this->translationLocale = $locale;

        foreach ($this->translatedObjects as $propertyName => [$locale => $object]) {
            $this->{$propertyName} = $object;
        }
    }

    public function setTranslation(string $propertyName, string $locale, $valueObject): void
    {
        $this->translatedObjects[$propertyName][$locale] = $valueObject;

        if ($this->getLocale() === $locale) {
            try {
                $previousProperty = $this->{$propertyName};
            } catch (\RuntimeException $e) {
                $previousProperty = null;
            }

            if ($previousProperty !== $valueObject) {
                $this->{$propertyName} = $valueObject;
            }

            return;
        }

        $this->fakeLocaleAndDo(
            $locale,
            $propertyName,
            fn() => $this->{$propertyName} = $valueObject
        );
    }

    public function getAllTranslations(): array
    {
        return $this->translatedObjects;
    }

    private function fakeLocaleAndDo(string $locale, string $propertyName, \Closure $callback)
    {
        if ($this->getLocale() === $locale) {
            return $callback();
        }

        $oldLocale = $this->getLocale();
        $oldValueObject = $this->{$propertyName};

        $this->setLocale($locale);

        $result = $callback();

        if ($this->getLocale() !== $locale) {
            throw new \RuntimeException('You should not manually change locale');
        }

        $this->setLocale($oldLocale);
        $this->{$propertyName} = $oldValueObject;

        return $result;
    }
}
