<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230813180026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD bio VARCHAR(255) DEFAULT NULL, ADD profile_img VARCHAR(255) DEFAULT NULL, ADD linked_in VARCHAR(255) DEFAULT NULL, ADD instagram VARCHAR(255) DEFAULT NULL, ADD github VARCHAR(255) DEFAULT NULL, ADD tiktok VARCHAR(255) DEFAULT NULL, ADD xing VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP bio, DROP profile_img, DROP linked_in, DROP instagram, DROP github, DROP tiktok, DROP xing');
    }
}
