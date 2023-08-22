<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230821215112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orm_redirects DROP FOREIGN KEY FK_6CA17E034C0848C6');
        $this->addSql('DROP TABLE orm_redirects');
        $this->addSql('DROP INDEX IDX_5793FCA5B5867E ON orm_routes');
        $this->addSql('DROP INDEX name_idx ON orm_routes');
        $this->addSql('ALTER TABLE orm_routes ADD path VARCHAR(255) NOT NULL, DROP host, DROP schemes, DROP methods, DROP defaults, DROP requirements, DROP options, DROP `condition`, DROP variable_pattern, DROP staticPrefix, DROP name, DROP position');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5793FCB548B0F ON orm_routes (path)');
        $this->addSql('ALTER TABLE page ADD route_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB62034ECB4E6 FOREIGN KEY (route_id) REFERENCES orm_routes (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_140AB62034ECB4E6 ON page (route_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE orm_redirects (id INT AUTO_INCREMENT NOT NULL, host VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, schemes LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', methods LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', defaults LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', requirements LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', options LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', `condition` VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, variable_pattern VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, staticPrefix VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, routeName VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, uri VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, permanent TINYINT(1) NOT NULL, routeTargetId INT DEFAULT NULL, INDEX IDX_6CA17E03A5B5867E (staticPrefix), UNIQUE INDEX UNIQ_6CA17E0391F30BA8 (routeName), INDEX IDX_6CA17E034C0848C6 (routeTargetId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE orm_redirects ADD CONSTRAINT FK_6CA17E034C0848C6 FOREIGN KEY (routeTargetId) REFERENCES orm_routes (id)');
        $this->addSql('DROP INDEX UNIQ_5793FCB548B0F ON orm_routes');
        $this->addSql('ALTER TABLE orm_routes ADD schemes LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ADD methods LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ADD defaults LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ADD requirements LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ADD options LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ADD `condition` VARCHAR(255) NOT NULL, ADD variable_pattern VARCHAR(255) DEFAULT NULL, ADD staticPrefix VARCHAR(255) DEFAULT NULL, ADD name VARCHAR(255) NOT NULL, ADD position INT NOT NULL, CHANGE path host VARCHAR(255) NOT NULL');
        $this->addSql('CREATE INDEX IDX_5793FCA5B5867E ON orm_routes (staticPrefix)');
        $this->addSql('CREATE UNIQUE INDEX name_idx ON orm_routes (name)');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB62034ECB4E6');
        $this->addSql('DROP INDEX UNIQ_140AB62034ECB4E6 ON page');
        $this->addSql('ALTER TABLE page DROP route_id');
    }
}
