<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250107170914 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__customer_address AS SELECT id, customer_id, address_line_one, address_line_two, zip, city, country FROM customer_address');
        $this->addSql('DROP TABLE customer_address');
        $this->addSql('CREATE TABLE customer_address (id BLOB NOT NULL --(DC2Type:uuid)
        , customer_id BLOB NOT NULL --(DC2Type:uuid)
        , address_line_one VARCHAR(255) NOT NULL, address_line_two VARCHAR(255) DEFAULT NULL, zip INTEGER NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_1193CB3F9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO customer_address (id, customer_id, address_line_one, address_line_two, zip, city, country) SELECT id, customer_id, address_line_one, address_line_two, zip, city, country FROM __temp__customer_address');
        $this->addSql('DROP TABLE __temp__customer_address');
        $this->addSql('CREATE INDEX IDX_1193CB3F9395C3F3 ON customer_address (customer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__customer_address AS SELECT id, customer_id, address_line_one, address_line_two, zip, city, country FROM customer_address');
        $this->addSql('DROP TABLE customer_address');
        $this->addSql('CREATE TABLE customer_address (id BLOB NOT NULL --(DC2Type:uuid)
        , customer_id BLOB DEFAULT NULL --(DC2Type:uuid)
        , address_line_one VARCHAR(255) NOT NULL, address_line_two VARCHAR(255) DEFAULT NULL, zip INTEGER NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_1193CB3F9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO customer_address (id, customer_id, address_line_one, address_line_two, zip, city, country) SELECT id, customer_id, address_line_one, address_line_two, zip, city, country FROM __temp__customer_address');
        $this->addSql('DROP TABLE __temp__customer_address');
        $this->addSql('CREATE INDEX IDX_1193CB3F9395C3F3 ON customer_address (customer_id)');
    }
}
