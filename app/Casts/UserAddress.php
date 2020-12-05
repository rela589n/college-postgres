<?php


namespace App\Casts;


final class UserAddress
{
    private string $country;
    private string $city;

    public function __construct(string $country, string $city)
    {
        $this->country = $country;
        $this->city = $city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCity(): string
    {
        return $this->city;
    }
}
