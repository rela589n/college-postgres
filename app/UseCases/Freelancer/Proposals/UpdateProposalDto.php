<?php


namespace App\UseCases\Freelancer\Proposals;


final class UpdateProposalDto
{
    public string $coverLetter;
    public int $timeInHours;

    public function __construct(string $coverLetter, int $timeInHours)
    {
        $this->coverLetter = $coverLetter;
        $this->timeInHours = $timeInHours;
    }
}
