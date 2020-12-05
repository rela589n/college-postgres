<?php

namespace App\Entities\Customer;

use App\Entities\Authentication\HandlesLaravelAuthentication;
use App\Entities\Job\Job;
use App\Events\Business\Customer\CustomerRegistered;
use App\ValueObjects\Email;
use App\ValueObjects\JobDescription;
use App\ValueObjects\JobTitle;
use App\ValueObjects\Password;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Str;

class Customer implements Authenticatable
{
    use HandlesLaravelAuthentication;
    use Authorizable;

    private string $uuid;
    private string $rememberToken;
    private Email $email;
    private Password $password;
    private Collection $postedJobs;

    private array $recordedEvents = [];

    private function __construct(Email $email, Password $password)
    {
        $this->uuid = Str::orderedUuid();
        $this->rememberToken = '';
        $this->email = $email;
        $this->password = $password;
        $this->postedJobs = new ArrayCollection();
    }

    public static function register(Email $email, Password $password): self
    {
        $customer = new self($email, $password);

        $customer->recordedEvents[] = new CustomerRegistered($customer);

        return $customer;
    }

    public function publishJob(JobTitle $title, JobDescription $description): Job
    {
        return Job::publish($title, $description, $this);
    }

    public function addPublishedJob(Job $job): void
    {
        $this->postedJobs->add($job);
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }

    public function releaseEvents(): array
    {
        $events = $this->recordedEvents;
        $this->recordedEvents = [];

        return $events;
    }

    public function getPostedJobs(): Collection
    {
        return $this->postedJobs;
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getAuthIdentifierName(): string
    {
        return 'uuid';
    }

    public function getRememberTokenName(): string
    {
        return 'rememberToken';
    }
}
