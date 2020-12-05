<?php


namespace App\UseCases\Freelancer\Jobs;


final class FinishJobDto
{
    public string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }
}
