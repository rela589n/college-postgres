<?php

namespace App\Entities\Job;


use App\Entities\Customer\Customer;
use App\Entities\Freelancer\Freelancer;
use App\Entities\Proposal\Proposal;
use App\Events\Business\Job\JobPublished;
use App\Exceptions\FreelancerAlreadyAppliedForThisJobException;
use App\ValueObjects\JobDescription;
use App\ValueObjects\JobStatus;
use App\ValueObjects\JobTitle;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Illuminate\Support\Str;

class Job
{
    private string $uuid;
    private JobTitle $title;
    private JobDescription $description;
    private Customer $customer;
    private Collection $proposals;
    private JobStatus $status;
    private array $recordedEvents = [];

    private function __construct(
        JobTitle $title,
        JobDescription $description,
        JobStatus $status,
        Customer $customer
    ) {
        $this->uuid = Str::orderedUuid();
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->customer = $customer;
        $this->proposals = new ArrayCollection();

        $customer->addPublishedJob($this);
    }

    public static function publish(
        JobTitle $title,
        JobDescription $description,
        Customer $customer
    ): self {
        $job = new self(
            $title,
            $description,
            JobStatus::new(),
            $customer,
        );

        $job->recordedEvents[] = new JobPublished($job);

        return $job;
    }

    public function getDescription(): JobDescription
    {
        return $this->description;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function getTitle(): JobTitle
    {
        return $this->title;
    }

    public function freelancerApplied(Freelancer $freelancer): bool
    {
        return $this->proposals->exists(fn($key, Proposal $entity) => $freelancer->isAuthorOf($entity));
    }

    public function addProposal(Proposal $proposal): void
    {
        if ($this->freelancerApplied($proposal->getFreelancer())) {
            throw new FreelancerAlreadyAppliedForThisJobException($proposal);
        }

        $this->proposals->add($proposal);
    }

    public function getProposals(): Collection
    {
        return $this->proposals;
    }

    public function releaseEvents(): array
    {
        $events = $this->recordedEvents;
        $this->recordedEvents = [];
        return $events;
    }

    public function getId(): string
    {
        return $this->uuid;
    }

    public function acceptProposal(Proposal $proposal): void
    {
        $this->status->changeTo(JobStatus::inWork());
    }

    public function updateFrom(JobTitle $jobTitle, JobDescription $jobDescription): void
    {
        $this->title = $jobTitle;
        $this->description = $jobDescription;
    }

    public function isEditable(): bool
    {
        return $this->status->isNew();
    }

    public function acceptsProposals(): bool
    {
        return $this->status->isNew();
    }

    public function isOwnedBy(Customer $customer): bool
    {
        return $this->customer === $customer;
    }

    public function isNew(): bool
    {
        return $this->status->isNew();
    }

    public function finish(): void
    {
        $this->status->changeTo(JobStatus::finished());
    }
}
