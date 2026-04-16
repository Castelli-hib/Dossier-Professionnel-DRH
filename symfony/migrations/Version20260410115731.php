<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260410115731 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actualite_rh ADD document_id INT DEFAULT NULL, CHANGE validateur_id validateur_id INT NOT NULL');
        $this->addSql('ALTER TABLE actualite_rh ADD CONSTRAINT FK_204B7C2C33F7837 FOREIGN KEY (document_id) REFERENCES document (id)');
        $this->addSql('CREATE INDEX IDX_204B7C2C33F7837 ON actualite_rh (document_id)');
        $this->addSql('ALTER TABLE agent CHANGE pole pole ENUM(\'Population\',\'Développement\',\'Territoire\',\'Ressources\') NOT NULL DEFAULT \'Ressources\'');
        $this->addSql('ALTER TABLE document ADD statut VARCHAR(255) NOT NULL, ADD date_creation DATETIME NOT NULL, CHANGE type type VARCHAR(255) NOT NULL, CHANGE date_publication date_publication DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE log_consultation ADD document_id INT DEFAULT NULL, ADD actualite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE log_consultation ADD CONSTRAINT FK_4E171700C33F7837 FOREIGN KEY (document_id) REFERENCES document (id)');
        $this->addSql('ALTER TABLE log_consultation ADD CONSTRAINT FK_4E171700A2843073 FOREIGN KEY (actualite_id) REFERENCES actualite_rh (id)');
        $this->addSql('CREATE INDEX IDX_4E171700C33F7837 ON log_consultation (document_id)');
        $this->addSql('CREATE INDEX IDX_4E171700A2843073 ON log_consultation (actualite_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actualite_rh DROP FOREIGN KEY FK_204B7C2C33F7837');
        $this->addSql('DROP INDEX IDX_204B7C2C33F7837 ON actualite_rh');
        $this->addSql('ALTER TABLE actualite_rh DROP document_id, CHANGE validateur_id validateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE agent CHANGE pole pole ENUM(\'Population\', \'Développement\', \'Territoire\', \'Ressources\') DEFAULT \'Ressources\' NOT NULL');
        $this->addSql('ALTER TABLE document DROP statut, DROP date_creation, CHANGE type type VARCHAR(5) NOT NULL, CHANGE date_publication date_publication DATE NOT NULL');
        $this->addSql('ALTER TABLE log_consultation DROP FOREIGN KEY FK_4E171700C33F7837');
        $this->addSql('ALTER TABLE log_consultation DROP FOREIGN KEY FK_4E171700A2843073');
        $this->addSql('DROP INDEX IDX_4E171700C33F7837 ON log_consultation');
        $this->addSql('DROP INDEX IDX_4E171700A2843073 ON log_consultation');
        $this->addSql('ALTER TABLE log_consultation DROP document_id, DROP actualite_id');
    }
}
