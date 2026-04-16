<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260409075827 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actualite_rh CHANGE statut statut VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE agent CHANGE pole pole ENUM(\'Population\',\'Développement\',\'Territoire\',\'Ressources\') NOT NULL DEFAULT \'Ressources\'');
        $this->addSql('ALTER TABLE document CHANGE type type VARCHAR(5) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actualite_rh CHANGE statut statut VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE agent CHANGE pole pole ENUM(\'Population\', \'Développement\', \'Territoire\', \'Ressources\') DEFAULT \'Ressources\' NOT NULL');
        $this->addSql('ALTER TABLE document CHANGE type type VARCHAR(255) NOT NULL');
    }
}
