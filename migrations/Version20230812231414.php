<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230812231414 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post_taxonomy (post_id INT NOT NULL, taxonomy_id INT NOT NULL, INDEX IDX_42FF319C4B89032C (post_id), INDEX IDX_42FF319C9557E6F6 (taxonomy_id), PRIMARY KEY(post_id, taxonomy_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post_taxonomy ADD CONSTRAINT FK_42FF319C4B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_taxonomy ADD CONSTRAINT FK_42FF319C9557E6F6 FOREIGN KEY (taxonomy_id) REFERENCES taxonomy (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post_taxonomy DROP FOREIGN KEY FK_42FF319C4B89032C');
        $this->addSql('ALTER TABLE post_taxonomy DROP FOREIGN KEY FK_42FF319C9557E6F6');
        $this->addSql('DROP TABLE post_taxonomy');
    }
}
