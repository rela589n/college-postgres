<?php

namespace App\Entities\Freelancer;


use App\Entities\Authentication\HandlesLaravelAuthentication;
use App\Entities\Job\Job;
use App\Entities\Proposal\Proposal;
use App\Events\Business\Freelancer\FreelancerRegistered;
use App\ValueObjects\CoverLetter;
use App\ValueObjects\Email;
use App\ValueObjects\EstimatedTime;
use App\ValueObjects\Money;
use App\ValueObjects\Password;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Str;

class Freelancer implements Authenticatable
{
    use HandlesLaravelAuthentication;
    use Authorizable;

    private string $uuid;
    private string $rememberToken;
    private Email $email;
    private Password $password;
    private Money $hourRate;

    private Collection $proposals;

    private array $recordedEvents = [];

    private function __construct(
        Email $email,
        Password $password,
        Money $hourRate
    ) {
        $this->uuid = Str::orderedUuid();
        $this->rememberToken = '';
        $this->email = $email;
        $this->password = $password;
        $this->hourRate = $hourRate;

        $this->proposals = new ArrayCollection();
    }

    public static function register(Email $email, Password $password, Money $hourRate): self
    {
        $freelancer = new self($email, $password, $hourRate);

        $freelancer->recordedEvents[] = new FreelancerRegistered($freelancer);

        return $freelancer;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }

    public function getHourRate(): Money
    {
        return $this->hourRate;
    }

    public function applyForJob(Job $job, EstimatedTime $estimatedTime, CoverLetter $coverLetter): Proposal
    {
        return Proposal::post($coverLetter, $estimatedTime, $job, $this);
    }

    public function addProposal(Proposal $proposal): void
    {
        $this->proposals->add($proposal);
    }

    public function getProposals()
    {
        return $this->proposals;
    }

    public function equalsTo(self $other): bool
    {
        return $this->uuid === $other->uuid;
    }

    public function isAuthorOf(Proposal $proposal): bool
    {
        return $this->equalsTo($proposal->getFreelancer());
    }

    public function releaseEvents(): array
    {
        $events = $this->recordedEvents;
        $this->recordedEvents = [];
        return $events;
    }

    public function getAuthIdentifierName(): string
    {
        return 'uuid';
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberTokenName(): string
    {
        return 'rememberToken';
    }
}
