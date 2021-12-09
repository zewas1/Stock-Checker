<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211209211853 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE stock_information (id INT AUTO_INCREMENT NOT NULL, `change` DOUBLE PRECISION DEFAULT NULL, change_percent DOUBLE PRECISION DEFAULT NULL, company_name VARCHAR(255) DEFAULT NULL, currency VARCHAR(255) NOT NULL, latest_price DOUBLE PRECISION DEFAULT NULL, symbol VARCHAR(10) NOT NULL, year_high DOUBLE PRECISION DEFAULT NULL, year_low DOUBLE PRECISION DEFAULT NULL, ytd_change DOUBLE PRECISION DEFAULT NULL, is_us_market_open TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE stock_information');
    }
}
