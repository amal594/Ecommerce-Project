<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260526202000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Align unique index name on app_user.email';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('DROP INDEX UNIQ_APP_USER_EMAIL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88BDF3E9E7927C74 ON app_user (email)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX UNIQ_88BDF3E9E7927C74');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_APP_USER_EMAIL ON app_user (email)');
    }
}

