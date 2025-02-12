<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250212161248 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE leave_request DROP CONSTRAINT fk_7dc8f778d32632e8');
        $this->addSql('DROP INDEX idx_7dc8f778d32632e8');
        $this->addSql('ALTER TABLE leave_request RENAME COLUMN _user_id TO user_id');
        $this->addSql('ALTER TABLE leave_request ADD CONSTRAINT FK_7DC8F778A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_7DC8F778A76ED395 ON leave_request (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE leave_request DROP CONSTRAINT FK_7DC8F778A76ED395');
        $this->addSql('DROP INDEX IDX_7DC8F778A76ED395');
        $this->addSql('ALTER TABLE leave_request RENAME COLUMN user_id TO _user_id');
        $this->addSql('ALTER TABLE leave_request ADD CONSTRAINT fk_7dc8f778d32632e8 FOREIGN KEY (_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_7dc8f778d32632e8 ON leave_request (_user_id)');
        $this->addSql('DROP INDEX UNIQ_IDENTIFIER_EMAIL');
    }
}
