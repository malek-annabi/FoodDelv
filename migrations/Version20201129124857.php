<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201129124857 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, firstname VARCHAR(30) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE delivery_guy (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, firstname VARCHAR(30) NOT NULL, cin INT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE delivery ADD delivery_guy_id INT NOT NULL');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10427FB44 FOREIGN KEY (delivery_guy_id) REFERENCES delivery_guy (id)');
        $this->addSql('CREATE INDEX IDX_3781EC10427FB44 ON delivery (delivery_guy_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10427FB44');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE delivery_guy');
        $this->addSql('DROP INDEX IDX_3781EC10427FB44 ON delivery');
        $this->addSql('ALTER TABLE delivery DROP delivery_guy_id');
    }
}
