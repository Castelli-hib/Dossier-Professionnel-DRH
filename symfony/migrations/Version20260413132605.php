<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260413132605 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(180) NOT NULL, code VARCHAR(50) DEFAULT NULL, description LONGTEXT DEFAULT NULL, direction VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, responsable_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_E19D9AD277153098 (code), INDEX IDX_E19D9AD253C59D72 (responsable_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD253C59D72 FOREIGN KEY (responsable_id) REFERENCES agent (id)');
        $this->addSql('ALTER TABLE actualite_rh DROP FOREIGN KEY `FK_204B7C2C33F7837`');
        $this->addSql('DROP INDEX IDX_204B7C2C33F7837 ON actualite_rh');
        $this->addSql('ALTER TABLE actualite_rh DROP document_id, CHANGE validateur_id validateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE agent ADD service_id INT DEFAULT NULL, DROP service, CHANGE direction direction VARCHAR(255) NOT NULL, CHANGE pole pole VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9DED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('CREATE INDEX IDX_268B9C9DED5CA9E6 ON agent (service_id)');
        $this->addSql('ALTER TABLE document ADD actualite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76A2843073 FOREIGN KEY (actualite_id) REFERENCES actualite_rh (id)');
        $this->addSql('CREATE INDEX IDX_D8698A76A2843073 ON document (actualite_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD253C59D72');
        $this->addSql('DROP TABLE service');
        $this->addSql('ALTER TABLE actualite_rh ADD document_id INT DEFAULT NULL, CHANGE validateur_id validateur_id INT NOT NULL');
        $this->addSql('ALTER TABLE actualite_rh ADD CONSTRAINT `FK_204B7C2C33F7837` FOREIGN KEY (document_id) REFERENCES document (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_204B7C2C33F7837 ON actualite_rh (document_id)');
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9DED5CA9E6');
        $this->addSql('DROP INDEX IDX_268B9C9DED5CA9E6 ON agent');
        $this->addSql('ALTER TABLE agent ADD service VARCHAR(100) NOT NULL, DROP service_id, CHANGE direction direction VARCHAR(100) NOT NULL, CHANGE pole pole ENUM(\'Population\', \'Développement\', \'Territoire\', \'Ressources\') DEFAULT \'Ressources\' NOT NULL');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76A2843073');
        $this->addSql('DROP INDEX IDX_D8698A76A2843073 ON document');
        $this->addSql('ALTER TABLE document DROP actualite_id');
    }
}
