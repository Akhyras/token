<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250714161532 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE url_statistic (id SERIAL NOT NULL, url_id INT NOT NULL, clicks INT DEFAULT NULL, date DATE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_F09D1D7681CFDAE7 ON url_statistic (url_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE url_statistic ADD CONSTRAINT FK_F09D1D7681CFDAE7 FOREIGN KEY (url_id) REFERENCES url (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE url_statistic DROP CONSTRAINT FK_F09D1D7681CFDAE7
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE url_statistic
        SQL);
    }
}
