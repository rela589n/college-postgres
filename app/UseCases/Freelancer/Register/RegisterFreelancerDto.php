<?php


namespace App\UseCases\Freelancer\Register;


final class RegisterFreelancerDto
{
    private string $email;
    private string $password;
    private float $hourRate;

    public function __construct(string $email, string $password, float $hourRate = 1)
    {
        $this->email = $email;
        $this->password = $password;
        $this->hourRate = $hourRate;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getHourRate(): float
    {
        return $this->hourRate;
    }
}
