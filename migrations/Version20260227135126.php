<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260227135126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intervention ADD technician_id INT NOT NULL');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814ABE6C5D496 FOREIGN KEY (technician_id) REFERENCES technician (id)');
        $this->addSql('CREATE INDEX IDX_D11814ABE6C5D496 ON intervention (technician_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814ABE6C5D496');
        $this->addSql('DROP INDEX IDX_D11814ABE6C5D496 ON intervention');
        $this->addSql('ALTER TABLE intervention DROP technician_id');
    }
}
