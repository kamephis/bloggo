<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230814230457 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page ADD host VARCHAR(255) NOT NULL, ADD schemes LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ADD methods LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ADD defaults LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ADD requirements LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ADD options LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ADD `condition` VARCHAR(255) NOT NULL, ADD variable_pattern VARCHAR(255) DEFAULT NULL, ADD staticPrefix VARCHAR(255) DEFAULT NULL, CHANGE id id VARCHAR(255) NOT NULL');
        $this->addSql('CREATE INDEX IDX_140AB620A5B5867E ON page (staticPrefix)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_140AB620A5B5867E ON page');
        $this->addSql('ALTER TABLE page DROP host, DROP schemes, DROP methods, DROP defaults, DROP requirements, DROP options, DROP `condition`, DROP variable_pattern, DROP staticPrefix, CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }
}
