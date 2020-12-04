<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201204122526 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE delivery_food (delivery_id INT NOT NULL, food_id INT NOT NULL, INDEX IDX_5A4E16D12136921 (delivery_id), INDEX IDX_5A4E16DBA8E87C4 (food_id), PRIMARY KEY(delivery_id, food_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wallet (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE delivery_food ADD CONSTRAINT FK_5A4E16D12136921 FOREIGN KEY (delivery_id) REFERENCES delivery (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE delivery_food ADD CONSTRAINT FK_5A4E16DBA8E87C4 FOREIGN KEY (food_id) REFERENCES food (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE delivery DROP wallet');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE delivery_food');
        $this->addSql('DROP TABLE wallet');
        $this->addSql('ALTER TABLE delivery ADD wallet LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\'');
    }
}
