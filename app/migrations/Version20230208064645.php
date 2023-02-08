<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230208064645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE operators (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, constant VARCHAR(255) NOT NULL, grade INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clients ADD operator_id INT DEFAULT NULL, ADD scoring INT NOT NULL, DROP operator');
        $this->addSql('ALTER TABLE clients ADD CONSTRAINT FK_C82E74584598A3 FOREIGN KEY (operator_id) REFERENCES operators (id)');
        $this->addSql('CREATE INDEX IDX_C82E74584598A3 ON clients (operator_id)');
        $this->addSql('ALTER TABLE educations ADD grade INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clients DROP FOREIGN KEY FK_C82E74584598A3');
        $this->addSql('DROP TABLE operators');
        $this->addSql('ALTER TABLE educations DROP grade');
        $this->addSql('DROP INDEX IDX_C82E74584598A3 ON clients');
        $this->addSql('ALTER TABLE clients ADD operator VARCHAR(255) NOT NULL, DROP operator_id, DROP scoring');
    }
}
