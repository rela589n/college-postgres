<?php


namespace App\Filters;


use Doctrine\ORM\QueryBuilder;

abstract class Filter
{
    protected function applyFilters(array $filters, &$filterParam): bool
    {
        foreach ($filters as $filter => $value) {
            if (method_exists($this, $filter)) {
                $methodName = $filter;
                $methodParam = $value;
            } elseif (method_exists($this, $value)) {
                $methodName = $value;
                $methodParam = $filter;
            }

            if (isset($methodName) && $this->$methodName($filterParam, $methodParam ?? null) === false) {
                return false;
            }
        }

        return true;
    }

    protected function applyOrders(array $enabledOrderings, QueryBuilder $builder): void
    {
        foreach ($enabledOrderings as $field => $ordering) {
            $builder->addOrderBy($field, $ordering);
        }
    }

    public function filterQuery(QueryBuilder $builder): QueryBuilder
    {
        $this->applyFilters($this->enabledFilters(), $builder);
        $this->applyOrders($this->enabledOrderings(), $builder);

        return $builder;
    }

    abstract protected function enabledFilters(): array;

    abstract protected function enabledOrderings(): array;
}
