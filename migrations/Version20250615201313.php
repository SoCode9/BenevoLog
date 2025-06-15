<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250615201313 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE emergency_contact (id INT AUTO_INCREMENT NOT NULL, benevol_id INT NOT NULL, name VARCHAR(128) DEFAULT NULL, relationship VARCHAR(32) DEFAULT NULL, phone_number VARCHAR(16) DEFAULT NULL, UNIQUE INDEX UNIQ_FE1C6190126AF3C2 (benevol_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE emergency_contact ADD CONSTRAINT FK_FE1C6190126AF3C2 FOREIGN KEY (benevol_id) REFERENCES benevol (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE emergency_contact DROP FOREIGN KEY FK_FE1C6190126AF3C2
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE emergency_contact
        SQL);
    }
}
