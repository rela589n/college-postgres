<?php


namespace App\Filters\Job;


use App\Filters\Filter;
use Doctrine\ORM\QueryBuilder;

final class JobsDoctrineFilter extends Filter
{
    private array $filters;
    private array $descending;

    public function __construct(array $filters, array $descending)
    {
        $this->filters = $filters;
        $this->descending = $descending;
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

    protected function enabledOrderings(): array
    {
        return [
            'job.title.title'             => in_array('title', $this->descending, true) ? 'DESC' : 'ASC',
            'job.description.description' => in_array('description', $this->descending, true) ? 'DESC' : 'ASC',
        ];
    }
}
