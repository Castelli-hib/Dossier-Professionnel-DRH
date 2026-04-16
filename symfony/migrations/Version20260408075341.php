<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260408XXXXXX extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Transform pole column from VARCHAR to ENUM';
    }

    public function up(Schema $schema): void
    {
        // Transformation de pole en ENUM
        $this->addSql("ALTER TABLE agent MODIFY COLUMN pole ENUM('Population','Développement','Territoire','Ressources') NOT NULL DEFAULT 'Ressources'");
    }

    public function down(Schema $schema): void
    {
        // Retour arrière : back to VARCHAR
        $this->addSql("ALTER TABLE agent MODIFY COLUMN pole VARCHAR(100) NOT NULL");
    }
}
