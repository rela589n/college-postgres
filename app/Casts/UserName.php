<?php


namespace App\Casts;


use App\Models\User;

final class UserName
{
    private string $firstName;

    public function __construct(string $name)
    {
        $this->firstName = $name;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }
}
