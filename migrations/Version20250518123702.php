<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250518123702 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE alimentation (id INT AUTO_INCREMENT NOT NULL, animal_id INT NOT NULL, quantite NUMERIC(10, 0) NOT NULL, nourriture VARCHAR(255) NOT NULL, date_alimentation DATETIME NOT NULL, INDEX IDX_8E65DFA08E962C16 (animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, habitat_id INT NOT NULL, img VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, espece VARCHAR(255) NOT NULL, INDEX IDX_6AAB231FAFFE2D26 (habitat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE habitat (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, img VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, roles JSON NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE visite_veterinaire (id INT AUTO_INCREMENT NOT NULL, animal_id INT NOT NULL, diagnostic_animal VARCHAR(255) NOT NULL, nourriture_propose VARCHAR(255) NOT NULL, grammage_nourriture NUMERIC(10, 0) NOT NULL, date_passage DATE NOT NULL, INDEX IDX_5C10220E8E962C16 (animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE alimentation ADD CONSTRAINT FK_8E65DFA08E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FAFFE2D26 FOREIGN KEY (habitat_id) REFERENCES habitat (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE visite_veterinaire ADD CONSTRAINT FK_5C10220E8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE alimentation DROP FOREIGN KEY FK_8E65DFA08E962C16
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FAFFE2D26
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE visite_veterinaire DROP FOREIGN KEY FK_5C10220E8E962C16
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE alimentation
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE animal
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE habitat
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE `user`
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE visite_veterinaire
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
