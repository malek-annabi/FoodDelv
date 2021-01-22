<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210122111755 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE delivery_food');
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10427FB44');
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10A76ED395');
        $this->addSql('DROP INDEX IDX_3781EC10A76ED395 ON delivery');
        $this->addSql('DROP INDEX IDX_3781EC10427FB44 ON delivery');
        $this->addSql('ALTER TABLE delivery DROP user_id, DROP delivery_guy_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE delivery_food (delivery_id INT NOT NULL, food_id INT NOT NULL, INDEX IDX_5A4E16D12136921 (delivery_id), INDEX IDX_5A4E16DBA8E87C4 (food_id), PRIMARY KEY(delivery_id, food_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE delivery_food ADD CONSTRAINT FK_5A4E16D12136921 FOREIGN KEY (delivery_id) REFERENCES delivery (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE delivery_food ADD CONSTRAINT FK_5A4E16DBA8E87C4 FOREIGN KEY (food_id) REFERENCES food (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE delivery ADD user_id INT NOT NULL, ADD delivery_guy_id INT NOT NULL');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10427FB44 FOREIGN KEY (delivery_guy_id) REFERENCES delivery_guy (id)');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3781EC10A76ED395 ON delivery (user_id)');
        $this->addSql('CREATE INDEX IDX_3781EC10427FB44 ON delivery (delivery_guy_id)');
    }
}
