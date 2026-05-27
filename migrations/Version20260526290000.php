<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260526290000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add category imageUrl and product isTop';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE category ADD COLUMN image_url VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD COLUMN is_top BOOLEAN NOT NULL DEFAULT FALSE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product DROP COLUMN is_top');
        $this->addSql('ALTER TABLE category DROP COLUMN image_url');
    }
}

