<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210519150242 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create articles media table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE articles_media 
            (
                id INT AUTO_INCREMENT NOT NULL, 
                article_id INT NOT NULL,
                type VARCHAR(255) NOT NULL,
                name VARCHAR(255) NOT NULL,
                thumb_name VARCHAR(255) NULL,
                title VARCHAR(255) DEFAULT NULL,
                created_at DATETIME NOT NULL,
                updated_at DATETIME NOT NULL,
                PRIMARY KEY(id),
                KEY `article_index` (`article_id`),
                CONSTRAINT `fk_articles` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE articles_media');
    }
}
