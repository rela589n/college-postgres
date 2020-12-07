<?php

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema as Schema;
use Doctrine\Migrations\AbstractMigration;

class Version20201207050544 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'postgresql',
            'Migration can only be executed safely on \'postgresql\'.'
        );

        $this->addSql(
            <<< SQL
CREATE OR REPLACE FUNCTION write_inserted_to_proposal_events()
  RETURNS TRIGGER
  LANGUAGE PLPGSQL
  AS
$$
BEGIN
    INSERT INTO proposal_events(name, proposal_id) VALUES ('inserted', NEW.id);

	RETURN NEW;
END;
$$
SQL
        );

        $this->addSql(
            <<< SQL
CREATE TRIGGER on_proposals_insert
  AFTER INSERT
  ON proposals
  FOR EACH ROW
  EXECUTE PROCEDURE write_inserted_to_proposal_events();
SQL
        );
    }

    public function down(Schema $schema): void
    {
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'postgresql',
            'Migration can only be executed safely on \'postgresql\'.'
        );

        $this->addSql(
            <<< SQL
DROP TRIGGER on_proposals_insert
ON proposals;
SQL
        );

        $this->addSql(
            <<< SQL
DROP FUNCTION write_inserted_to_proposal_events;
SQL
        );
    }
}
