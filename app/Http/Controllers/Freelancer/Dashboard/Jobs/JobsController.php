<?php


namespace App\Http\Controllers\Freelancer\Dashboard\Jobs;


use App\Entities\Job\JobsRepository;
use App\UseCases\Freelancer\Jobs\FinishJobCommand;
use App\UseCases\Freelancer\Jobs\FinishJobDto;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;

final class JobsController
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
        $offers = $this->repository->filteredJobs(
            array_filter(
                Arr::wrap($request->filters)
            ),
            array_keys(
                Arr::wrap($request->desc)
            )
        );

        return view(
            'pages.freelancer.dashboard.offers.index',
            [
                'offers' => $offers,
            ]
        );
    }

    public function appliedOn()
    {
        return view(
            'pages.freelancer.dashboard.offers.applied-on',
            [
                'offers' => $this->repository->findFreelancerAppliedOn($this->guard->id())
            ]
        );
    }

    public function finished()
    {
        return view(
            'pages.freelancer.dashboard.offers.finished',
            [
                'offers' => $this->repository->finishedByFreelancer($this->guard->id())
            ]
        );
    }

    public function inWork()
    {
        return view(
            'pages.freelancer.dashboard.offers.in-work',
            [
                'offers' => $this->repository->inWorkByFreelancer($this->guard->id())
            ]
        );
    }

    public function show($id): View
    {
        return view(
            'pages.freelancer.dashboard.offers.show',
            [
                'job' => $this->repository->find($id)
            ]
        );
    }

    public function finish(Request $request, FinishJobCommand $command)
    {
        $command->execute(new FinishJobDto($request->input('offer')));

        return redirect()->route('freelancer.dashboard.offers.finished');
    }
}
