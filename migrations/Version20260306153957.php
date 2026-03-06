<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260306153957 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intervention ADD type_intervention_id INT NOT NULL');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814AB799AAC17 FOREIGN KEY (type_intervention_id) REFERENCES type_intervention (id)');
        $this->addSql('CREATE INDEX IDX_D11814AB799AAC17 ON intervention (type_intervention_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814AB799AAC17');
        $this->addSql('DROP INDEX IDX_D11814AB799AAC17 ON intervention');
        $this->addSql('ALTER TABLE intervention DROP type_intervention_id');
    }
}
