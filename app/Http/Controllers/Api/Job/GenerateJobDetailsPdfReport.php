<?php


namespace App\Http\Controllers\Api\Job;


use App\Entities\Job\JobsRepository;
use App\Http\Controllers\Controller;
use App\UseCases\Freelancer\Jobs\GenerateJobPdfDetails;
use Dompdf\Dompdf;
use Spipu\Html2Pdf\Html2Pdf;

class GenerateJobDetailsPdfReport extends Controller
{
    private JobsRepository $repository;

    public function __construct(JobsRepository $repository, Html2Pdf $mpdf)
    {
        $this->repository = $repository;
    }

    public function __invoke($id, GenerateJobPdfDetails $generateJobPdfDetails)
    {
        $job = $this->repository->find($id);
        $path = $generateJobPdfDetails($job);

        return response()->download($path);
    }
}
