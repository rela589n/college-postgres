<?php


namespace App\UseCases\Freelancer\Jobs;


use App\Entities\Job\Job;
use App\Entities\Proposal\Proposal;
//use App\Support\PHPWord\TemplateProcessor;
use PhpOffice\PhpWord\TemplateProcessor;
use Doctrine\Common\Collections\Collection;
use PhpOffice\PhpWord\Settings as PhpWordSettings;

final class GenerateJobPdfDetails
{
    private Job $job;

    public function __construct()
    {
    }

    public function __invoke(Job $job): string
    {
        $this->job = $job;

        return $this->generate();
    }

    public function generate(): string
    {
        PhpWordSettings::setOutputEscapingEnabled(true);

        $templateProcessor = new TemplateProcessor($this->templateResourcePath());
        $this->doGenerate($templateProcessor);

        $filePath = storage_path("app/public/reports/job/{$this->job->getId()}.docx");
        $templateProcessor->saveAs($filePath);

        PhpWordSettings::setOutputEscapingEnabled(false);
        return $filePath;
    }

    private function doGenerate(TemplateProcessor $processor): void
    {
        /** @var Proposal[]|Collection $proposals */
        $proposals = $this->job->getProposals();

        $processor->setValues(
            [
                'jobName' => $this->job->getTitle(),
                'jobDescription' => $this->job->getDescription(),
                'totalProposals' => $proposals->count(),
            ]
        );

        $processor->cloneBlock(
            'proposalBlock',
            $proposals->count(),
            true,
            true
        );

        $i = 1;
        foreach ($proposals as $proposal) {
            $processor->setValues(
                [
                    "proposalIndex#$i"       => $i,
                    "proposalSender#$i" => $proposal->getFreelancer()->getEmail(),
                    "proposalCoverLetter#$i" => $proposal->getCoverLetter(),
                    "proposalEstimate#$i"    => $proposal->getEstimatedTime()->formatInHours(),
                ]
            );

            ++$i;
        }
    }

    private function templateResourcePath(): string
    {
        return resource_path('reports/job/job-report.docx');
    }
}
