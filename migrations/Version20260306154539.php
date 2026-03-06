<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260306154539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE intervention_unit (intervention_id INT NOT NULL, unit_id INT NOT NULL, INDEX IDX_D30414918EAE3863 (intervention_id), INDEX IDX_D3041491F8BD700D (unit_id), PRIMARY KEY (intervention_id, unit_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE intervention_unit ADD CONSTRAINT FK_D30414918EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention_unit ADD CONSTRAINT FK_D3041491F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intervention_unit DROP FOREIGN KEY FK_D30414918EAE3863');
        $this->addSql('ALTER TABLE intervention_unit DROP FOREIGN KEY FK_D3041491F8BD700D');
        $this->addSql('DROP TABLE intervention_unit');
    }
}
