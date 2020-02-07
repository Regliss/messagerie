<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200206131515 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_8D93D6494B98C21 ON user');
        $this->addSql('ALTER TABLE user ADD groupes VARCHAR(180) DEFAULT NULL, DROP groupe');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649576366D9 ON user (groupes)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_8D93D649576366D9 ON user');
        $this->addSql('ALTER TABLE user ADD groupe VARCHAR(180) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, DROP groupes');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6494B98C21 ON user (groupe)');
    }
}
