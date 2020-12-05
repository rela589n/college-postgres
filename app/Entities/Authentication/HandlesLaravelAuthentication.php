<?php


namespace App\Entities\Authentication;


trait HandlesLaravelAuthentication
{
    public function getRememberToken(): string
    {
        return $this->{$this->getRememberTokenName()};
    }

    public function setRememberToken($value): void
    {
        $this->{$this->getRememberTokenName()} = $value;
    }

    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }
}
