<?php


namespace App\Http\Controllers\Customer\Dashboard\Proposals;


use App\Entities\Customer\Customer;
use App\Entities\Freelancer\Freelancer;
use App\Entities\Job\JobsRepository;
use App\Entities\Proposal\Proposal;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Guards\FreelancerGuard;
use App\Http\Requests\StoreJobOfferRequest;
use App\Http\Requests\UpdateJobRequest;
use App\UseCases\Customer\Jobs\DestroyJobCommand;
use App\UseCases\Customer\Jobs\PublishJobCommand;
use App\UseCases\Customer\Jobs\UpdateJobCommand;
use App\UseCases\Customer\Proposals\AcceptProposalCommand;
use App\UseCases\Customer\Proposals\AcceptProposalDto;
use App\ValueObjects\CoverLetter;
use App\ValueObjects\EstimatedTime;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use LaravelDoctrine\ORM\Facades\EntityManager;

final class OffersController extends Controller
{
    private JobsRepository $repository;
    private StatefulGuard $guard;

    public function __construct(JobsRepository $repository, StatefulGuard $guard)
    {
        $this->repository = $repository;
        $this->guard = $guard;
    }

    public function index(Request $request): View
    {
        return view(
            'pages.client.dashboard.offers.index',
            [
                'offers' => $this->repository->findByCustomerId($this->guard->id())
            ]
        );
    }

    public function inWork(): View
    {
        return view('pages.client.dashboard.offers.in-work', [
            'offers' => $this->repository->inWorkByCustomer($this->guard->id()),
        ]);
    }

    public function finished(): View
    {
        return view('pages.client.dashboard.offers.finished', [
            'offers' => $this->repository->finishedByCustomer($this->guard->id()),
        ]);
    }

    public function create(): View
    {
        return view('pages.client.dashboard.offers.create');
    }

    public function store(StoreJobOfferRequest $request, PublishJobCommand $command): RedirectResponse
    {
        /** @var Customer $customer */
        $customer = $this->guard->user();

        $command->execute($customer, $request->makeDto());

        return redirect()->route('customer.dashboard.offers.index');
    }

    public function show(string $id): View
    {
        return view(
            'pages.client.dashboard.offers.show',
            [
                'job' => $this->repository->find($id)
            ]
        );
    }

    public function edit(string $id): View
    {
        return view(
            'pages.client.dashboard.offers.edit',
            [
                'job' => $this->repository->find($id)
            ]
        );
    }

    public function update(string $id, UpdateJobRequest $request, UpdateJobCommand $command)
    {
        /** @var Customer $customer */
        $customer = $this->guard->user();
        $job = $command->execute($id, $customer, $request->makeDto());

        return redirect()->route(
            'customer.dashboard.offers.show',
            [
                'offer' => $job->getId()
            ]
        );
    }

    public function accept(Request $request, AcceptProposalCommand $command)
    {
        $command->execute(new AcceptProposalDto($request->input('proposal_id')));

        return redirect()->route('customer.dashboard.offers.in-work');
    }

    public function destroy($id, DestroyJobCommand $command)
    {
        /** @var Customer $customer */
        $customer = $this->guard->user();

        $command->execute($customer, $id);

        return redirect()->route('customer.dashboard.offers.index');
    }
}
