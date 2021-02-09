<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210104211106 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE llivraison (id INT AUTO_INCREMENT NOT NULL, produit_id INT NOT NULL, numl VARCHAR(50) NOT NULL, pv VARCHAR(50) NOT NULL, qte VARCHAR(50) NOT NULL, tva VARCHAR(50) NOT NULL, lig INT NOT NULL, INDEX IDX_68540739F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE llivraison ADD CONSTRAINT FK_68540739F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE llivraison');
    }
}
