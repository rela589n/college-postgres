<?php


namespace App\UseCases\Customer\Jobs;


final class PublishJobDto
{
    public string $publicName;
    public string $description;

    public function __construct(string $publicName, string $description)
    {
        $this->publicName = $publicName;
        $this->description = $description;
    }
}
