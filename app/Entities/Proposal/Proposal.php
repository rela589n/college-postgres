<?php

namespace App\Entities\Proposal;


use App\Entities\Freelancer\Freelancer;
use App\Entities\Job\Job;
use App\Events\Business\Proposal\ProposalPosted;
use App\ValueObjects\CoverLetter;
use App\ValueObjects\EstimatedTime;
use App\ValueObjects\JobStatus;
use App\ValueObjects\ProposalStatus;
use Illuminate\Support\Str;

class Proposal
{
    private string $uuid;
    private CoverLetter $coverLetter;
    private EstimatedTime $estimatedTime;
    private Job $job;
    private Freelancer $freelancer;
    private ProposalStatus $status;

    private array $recordedEvents = [];

    private function __construct(
        CoverLetter $coverLetter,
        EstimatedTime $estimatedTime,
        Job $job,
        Freelancer $freelancer,
        ProposalStatus $status
    ) {
        $this->uuid = Str::orderedUuid();
        $this->coverLetter = $coverLetter;
        $this->estimatedTime = $estimatedTime;
        $this->job = $job;
        $this->freelancer = $freelancer;
        $this->status = $status;

        $job->addProposal($this);
        $freelancer->addProposal($this);
    }

    public function getCoverLetter(): CoverLetter
    {
        return $this->coverLetter;
    }

    public function getEstimatedTime(): EstimatedTime
    {
        return $this->estimatedTime;
    }

    public function getJob(): Job
    {
        return $this->job;
    }

    public function getFreelancer(): Freelancer
    {
        return $this->freelancer;
    }

    public static function post(
        CoverLetter $coverLetter,
        EstimatedTime $estimatedTime,
        Job $job,
        Freelancer $freelancer
    ): self {
        $proposal = new self(
            $coverLetter,
            $estimatedTime,
            $job,
            $freelancer,
            ProposalStatus::new(),
        );

        $proposal->recordedEvents[] = new ProposalPosted($proposal);

        return $proposal;
    }

    public function hasSameAuthorAs(self $other): bool
    {
        return $this->freelancer->equalsTo($other->freelancer);
    }

    public function releaseEvents(): array
    {
        $events = $this->recordedEvents;
        $this->recordedEvents = [];
        return $events;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function updateFrom(CoverLetter $coverLetter, EstimatedTime $estimatedTime): void
    {
        $this->coverLetter = $coverLetter;
        $this->estimatedTime = $estimatedTime;
    }

    public function accept(): void
    {
        $this->status->changeTo(ProposalStatus::accepted());
        $this->job->acceptProposal($this);
    }

    public function isAccepted(): bool
    {
        return $this->status->isAccepted();
    }
}
