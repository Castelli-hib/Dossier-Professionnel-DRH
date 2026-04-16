<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260408075340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actualite_rh (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, contenu LONGTEXT NOT NULL, est_public TINYINT NOT NULL, statut VARCHAR(50) NOT NULL, date_creation DATETIME NOT NULL, date_publication DATETIME DEFAULT NULL, date_archivage DATETIME DEFAULT NULL, auteur_id INT NOT NULL, validateur_id INT DEFAULT NULL, INDEX IDX_204B7C260BB6FE6 (auteur_id), INDEX IDX_204B7C2E57AEF2F (validateur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE agent (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, roles JSON NOT NULL, poste VARCHAR(100) NOT NULL, service VARCHAR(100) NOT NULL, direction VARCHAR(100) NOT NULL, pole VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_268B9C9DE7927C74 (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE categorie_document (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, service VARCHAR(255) DEFAULT NULL, est_public TINYINT NOT NULL, date_publication DATE NOT NULL, categorie_id INT NOT NULL, agent_id INT NOT NULL, INDEX IDX_D8698A76BCF5E72D (categorie_id), INDEX IDX_D8698A763414710B (agent_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE log_consultation (id INT AUTO_INCREMENT NOT NULL, date_consultation DATETIME NOT NULL, type_ressource VARCHAR(50) NOT NULL, id_ressource INT NOT NULL, action VARCHAR(50) NOT NULL, origine VARCHAR(100) NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_4E171700FB88E14F (utilisateur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE actualite_rh ADD CONSTRAINT FK_204B7C260BB6FE6 FOREIGN KEY (auteur_id) REFERENCES agent (id)');
        $this->addSql('ALTER TABLE actualite_rh ADD CONSTRAINT FK_204B7C2E57AEF2F FOREIGN KEY (validateur_id) REFERENCES agent (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie_document (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A763414710B FOREIGN KEY (agent_id) REFERENCES agent (id)');
        $this->addSql('ALTER TABLE log_consultation ADD CONSTRAINT FK_4E171700FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES agent (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actualite_rh DROP FOREIGN KEY FK_204B7C260BB6FE6');
        $this->addSql('ALTER TABLE actualite_rh DROP FOREIGN KEY FK_204B7C2E57AEF2F');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76BCF5E72D');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A763414710B');
        $this->addSql('ALTER TABLE log_consultation DROP FOREIGN KEY FK_4E171700FB88E14F');
        $this->addSql('DROP TABLE actualite_rh');
        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP TABLE categorie_document');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE log_consultation');
    }
}
