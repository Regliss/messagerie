<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200206151520 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE groupe CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE users users VARCHAR(255) NOT NULL, CHANGE users_p users_p VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL, ADD groupe VARCHAR(255) DEFAULT NULL, DROP groupes, CHANGE username username VARCHAR(180) NOT NULL, CHANGE email email VARCHAR(180) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL, CHANGE photo photo VARCHAR(180) NOT NULL, CHANGE messages messages VARCHAR(180) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64914B78418 ON user (photo)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6494B98C21 ON user (groupe)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649DB021E96 ON user (messages)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE groupe CHANGE nom nom VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE users users VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE users_p users_p VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D64914B78418 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D6494B98C21 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649DB021E96 ON user');
        $this->addSql('ALTER TABLE user ADD groupes VARCHAR(100) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, DROP roles, DROP groupe, CHANGE username username VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE email email VARCHAR(80) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE password password VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE photo photo VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE messages messages VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
    }
}
