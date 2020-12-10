<?php


namespace App\Filters\Job;


use App\Filters\Filter;
use Doctrine\ORM\QueryBuilder;

final class JobsDoctrineFilter extends Filter
{
    private array $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    protected function enabledFilters(): array
    {
        return $this->filters;
    }

    public function title(QueryBuilder $builder, string $title): void
    {
        $builder->andWhere('job.title.title LIKE :job_title_param');

        $builder->setParameter('job_title_param', "%$title%");
    }

    public function description(QueryBuilder $builder, string $description): void
    {
        $builder->andWhere('job.description.description LIKE :job_description_param');

        $builder->setParameter('job_description_param', "%$description%");
    }
}
