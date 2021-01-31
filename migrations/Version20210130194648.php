<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210130194648 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE delivery ADD deliveryguy_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10800508C4 FOREIGN KEY (deliveryguy_id) REFERENCES delivery_guy (id)');
        $this->addSql('CREATE INDEX IDX_3781EC10800508C4 ON delivery (deliveryguy_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10800508C4');
        $this->addSql('DROP INDEX IDX_3781EC10800508C4 ON delivery');
        $this->addSql('ALTER TABLE delivery DROP deliveryguy_id');
    }
}
