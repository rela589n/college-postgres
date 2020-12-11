<?php

namespace App\Console\Commands;

use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Console\Command;
use LaravelDoctrine\ORM\Facades\EntityManager;

class TryJobsInWorkViewQuery extends Command
{
    protected $signature = 'check-out:jobs-in-work-view';

    public function handle()
    {
        $builder = new QueryBuilder(EntityManager::getConnection());
        $array = iterator_to_array(
            $builder->select('*')
                ->from('jobs_in_work')
                ->execute()
        );

        dd($array);
    }
}
