<?php


namespace App\Rules\Groups;


abstract class RulesGroup
{
    private array $toMerge = [];

    /**
     * @param  array  $otherRules
     * @return RulesGroup
     */
    public function merge(array $otherRules): self
    {
        $this->toMerge = $otherRules;

        return $this;
    }

    public function get(): array
    {
        $rules = array_merge($this->rules(), $this->toMerge);

        $this->flush();

        return $rules;
    }

    protected function flush(): void
    {
        $this->toMerge = [];
    }

    abstract protected function rules(): array;
}
