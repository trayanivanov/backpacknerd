<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210519091021 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create articles categories table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE articles_categories
            (
                id INT AUTO_INCREMENT NOT NULL,
                slug VARCHAR(255) NOT NULL,
                name VARCHAR(255) NOT NULL,
                active TINYINT(1) DEFAULT 1 NOT NULL,
                created_at DATETIME NOT NULL,
                updated_at DATETIME NOT NULL,
                PRIMARY KEY(id),
                UNIQUE KEY `slug` (`slug`),
                UNIQUE KEY `name` (`name`)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE articles_categories');
    }
}
