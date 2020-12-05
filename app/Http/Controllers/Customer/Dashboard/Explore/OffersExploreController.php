<?php


namespace App\Http\Controllers\Customer\Dashboard\Explore;


use App\Entities\Job\JobsRepository;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

final class OffersExploreController extends Controller
{
    private JobsRepository $repository;

    public function __construct(JobsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): View
    {
        return view('pages.client.dashboard.explore.index', [
            'offers' => $this->repository->findAll()
        ]);
    }

    public function show($id): View
    {
        return view(
            'pages.client.dashboard.offers.show',
            [
                'job' => $this->repository->find($id)
            ]
        );
    }
}
