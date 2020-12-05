<?php

namespace Database\Migrations;

use App\ValueObjects\JobStatus;
use Doctrine\DBAL\Schema\Schema as Schema;
use Doctrine\Migrations\AbstractMigration;

class Version20201206114236 extends AbstractMigration
{
    /**
     * @param  Schema  $schema
     */
    public function up(Schema $schema): void
    {
        $workStatus = JobStatus::inWork()->value();

        $this->addSql(
            <<<SQL
CREATE OR REPLACE VIEW jobs_in_work AS
SELECT * from jobs
WHERE job_status='$workStatus'
SQL
        );
    }

    /**
     * @param  Schema  $schema
     */
    public function down(Schema $schema): void
    {
        $this->addSql(
            <<< SQL
DROP VIEW jobs_in_work
SQL
        );
    }
}
