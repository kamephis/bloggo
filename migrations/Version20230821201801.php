<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230821201801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE orm_redirects (id INT AUTO_INCREMENT NOT NULL, host VARCHAR(255) NOT NULL, schemes LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', methods LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', defaults LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', requirements LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', options LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', `condition` VARCHAR(255) NOT NULL, variable_pattern VARCHAR(255) DEFAULT NULL, staticPrefix VARCHAR(255) DEFAULT NULL, routeName VARCHAR(255) NOT NULL, uri VARCHAR(255) DEFAULT NULL, permanent TINYINT(1) NOT NULL, routeTargetId INT DEFAULT NULL, UNIQUE INDEX UNIQ_6CA17E0391F30BA8 (routeName), INDEX IDX_6CA17E034C0848C6 (routeTargetId), INDEX IDX_6CA17E03A5B5867E (staticPrefix), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orm_routes (id INT AUTO_INCREMENT NOT NULL, host VARCHAR(255) NOT NULL, schemes LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', methods LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', defaults LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', requirements LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', options LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', `condition` VARCHAR(255) NOT NULL, variable_pattern VARCHAR(255) DEFAULT NULL, staticPrefix VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, position INT NOT NULL, INDEX IDX_5793FCA5B5867E (staticPrefix), UNIQUE INDEX name_idx (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orm_redirects ADD CONSTRAINT FK_6CA17E034C0848C6 FOREIGN KEY (routeTargetId) REFERENCES orm_routes (id)');
        $this->addSql('ALTER TABLE page DROP route');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orm_redirects DROP FOREIGN KEY FK_6CA17E034C0848C6');
        $this->addSql('DROP TABLE orm_redirects');
        $this->addSql('DROP TABLE orm_routes');
        $this->addSql('ALTER TABLE page ADD route VARCHAR(255) NOT NULL');
    }
}
