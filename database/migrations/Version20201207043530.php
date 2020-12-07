<?php

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema as Schema;
use Doctrine\Migrations\AbstractMigration;

class Version20201207043530 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'postgresql',
            'Migration can only be executed safely on \'postgresql\'.'
        );

        $this->addSql(
            <<< SQL
CREATE TABLE proposal_events (id BIGSERIAL, name VARCHAR(255) NOT NULL, proposal_id VARCHAR(255) NOT NULL, PRIMARY KEY(id));
CREATE INDEX IDX_A5BA3A8FBE043QF ON proposal_events (proposal_id);
ALTER TABLE proposal_events ADD CONSTRAINT FK_A5BA3A8FBE043QF FOREIGN KEY (proposal_id) REFERENCES proposals (id) NOT DEFERRABLE INITIALLY IMMEDIATE;
SQL
        );
    }

    public function down(Schema $schema): void
    {
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'postgresql',
            'Migration can only be executed safely on \'postgresql\'.'
        );

        $this->addSql(<<< SQL
ALTER TABLE proposal_events DROP CONSTRAINT FK_A5BA3A8FBE043QF;
DROP TABLE proposal_events;
SQL);
    }
}
