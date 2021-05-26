<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210519123110 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create articles table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE articles 
            (
                id INT AUTO_INCREMENT NOT NULL,
                article_category_id INT NOT NULL,
                slug VARCHAR(255) NOT NULL,
                title VARCHAR(255) NOT NULL,
                description VARCHAR(255) NOT NULL,
                body LONGTEXT NOT NULL,
                favourite TINYINT(1) DEFAULT 0 NOT NULL,
                active TINYINT(1) DEFAULT 0 NOT NULL,
                created_at DATETIME NOT NULL,
                updated_at DATETIME NOT NULL,
                PRIMARY KEY(id),
                KEY `article_category_index` (`article_category_id`),
                UNIQUE KEY `slug` (`slug`),
                UNIQUE KEY `title` (`title`),
                CONSTRAINT `fk_article_categories` FOREIGN KEY (`article_category_id`) REFERENCES `articles_categories` (`id`)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE articles');
    }
}
