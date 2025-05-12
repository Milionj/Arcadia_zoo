<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250512085436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alimentation ADD animal_id INT NOT NULL');
        $this->addSql('ALTER TABLE alimentation ADD CONSTRAINT FK_8E65DFA08E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('CREATE INDEX IDX_8E65DFA08E962C16 ON alimentation (animal_id)');
        $this->addSql('ALTER TABLE animal ADD habitat_id INT NOT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FAFFE2D26 FOREIGN KEY (habitat_id) REFERENCES habitat (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231FAFFE2D26 ON animal (habitat_id)');
        $this->addSql('ALTER TABLE visite_veterinaire ADD animal_id INT NOT NULL');
        $this->addSql('ALTER TABLE visite_veterinaire ADD CONSTRAINT FK_5C10220E8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('CREATE INDEX IDX_5C10220E8E962C16 ON visite_veterinaire (animal_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alimentation DROP FOREIGN KEY FK_8E65DFA08E962C16');
        $this->addSql('DROP INDEX IDX_8E65DFA08E962C16 ON alimentation');
        $this->addSql('ALTER TABLE alimentation DROP animal_id');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FAFFE2D26');
        $this->addSql('DROP INDEX IDX_6AAB231FAFFE2D26 ON animal');
        $this->addSql('ALTER TABLE animal DROP habitat_id');
        $this->addSql('ALTER TABLE visite_veterinaire DROP FOREIGN KEY FK_5C10220E8E962C16');
        $this->addSql('DROP INDEX IDX_5C10220E8E962C16 ON visite_veterinaire');
        $this->addSql('ALTER TABLE visite_veterinaire DROP animal_id');
    }
}
