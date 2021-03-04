<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210303103242 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('DROP INDEX IDX_1193CB3F9395C3F3');
        $this->addSql('CREATE TEMPORARY TABLE __temp__customer_address AS SELECT id, customer_id, address_line_one, address_line_two, zip, city, country FROM customer_address');
        $this->addSql('DROP TABLE customer_address');
        $this->addSql('CREATE TABLE customer_address (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, customer_id INTEGER DEFAULT NULL, address_line_one VARCHAR(255) NOT NULL COLLATE BINARY, address_line_two VARCHAR(255) DEFAULT NULL COLLATE BINARY, zip INTEGER NOT NULL, city VARCHAR(255) NOT NULL COLLATE BINARY, country VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_1193CB3F9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO customer_address (id, customer_id, address_line_one, address_line_two, zip, city, country) SELECT id, customer_id, address_line_one, address_line_two, zip, city, country FROM __temp__customer_address');
        $this->addSql('DROP TABLE __temp__customer_address');
        $this->addSql('CREATE INDEX IDX_1193CB3F9395C3F3 ON customer_address (customer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_1193CB3F9395C3F3');
        $this->addSql('CREATE TEMPORARY TABLE __temp__customer_address AS SELECT id, customer_id, address_line_one, address_line_two, zip, city, country FROM customer_address');
        $this->addSql('DROP TABLE customer_address');
        $this->addSql('CREATE TABLE customer_address (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, customer_id INTEGER DEFAULT NULL, address_line_one VARCHAR(255) NOT NULL, address_line_two VARCHAR(255) DEFAULT NULL, zip INTEGER NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO customer_address (id, customer_id, address_line_one, address_line_two, zip, city, country) SELECT id, customer_id, address_line_one, address_line_two, zip, city, country FROM __temp__customer_address');
        $this->addSql('DROP TABLE __temp__customer_address');
        $this->addSql('CREATE INDEX IDX_1193CB3F9395C3F3 ON customer_address (customer_id)');
    }
}
