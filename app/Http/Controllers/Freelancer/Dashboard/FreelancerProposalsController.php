<?php


namespace App\Http\Controllers\Freelancer\Dashboard;


use App\Entities\Job\JobsRepository;
use App\Entities\Proposal\ProposalsRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Freelancer\Proposals\CreateProposalRequest;
use App\Http\Requests\Freelancer\Proposals\UpdateProposalRequest;
use App\UseCases\Freelancer\Proposals\StoreProposalCommand;
use App\UseCases\Freelancer\Proposals\UpdateProposalCommand;
use Illuminate\Contracts\Auth\StatefulGuard;

final class FreelancerProposalsController extends Controller
{
    private JobsRepository $jobsRepository;
    private StatefulGuard $guard;
    private ProposalsRepository $proposalsRepository;

    public function __construct(
        JobsRepository $jobsRepository,
        ProposalsRepository $proposalsRepository,
        StatefulGuard $guard
    ) {
        $this->jobsRepository = $jobsRepository;
        $this->guard = $guard;
        $this->proposalsRepository = $proposalsRepository;
    }


    public function create($jobId)
    {
        return view(
            'pages.freelancer.dashboard.proposals.create',
            [
                'job' => $this->jobsRepository->find($jobId)
            ]
        );
    }

    public function store($id, CreateProposalRequest $request, StoreProposalCommand $command)
    {
        $command->execute($id, $request->getDto());

        return redirect()->route('freelancer.dashboard.offers.show', $id);
    }

    public function edit($jobId, $proposalId)
    {
        return view(
            'pages.freelancer.dashboard.proposals.edit',
            [
                'proposal' => $this->proposalsRepository->find($proposalId)
            ]
        );
    }

    public function update($jobId, $proposalId, UpdateProposalRequest $request, UpdateProposalCommand $command)
    {
        $command->execute($proposalId, $request->getDto());

        return redirect()->route('freelancer.dashboard.offers.show', $jobId);
    }
}
