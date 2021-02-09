<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210103205545 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, base0 VARCHAR(50) NOT NULL, base1 VARCHAR(50) NOT NULL, tva1 VARCHAR(50) NOT NULL, base2 VARCHAR(50) NOT NULL, tva2 VARCHAR(50) NOT NULL, base3 VARCHAR(50) NOT NULL, tva3 VARCHAR(50) NOT NULL, totht VARCHAR(50) NOT NULL, totrem VARCHAR(50) NOT NULL, tottva VARCHAR(50) NOT NULL, timbre VARCHAR(50) NOT NULL, tottc VARCHAR(50) NOT NULL, rs VARCHAR(50) NOT NULL, montrs VARCHAR(5) NOT NULL, net VARCHAR(50) NOT NULL, INDEX IDX_FE86641019EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
       // $this->addSql('CREATE TABLE compteur (id INT ,compteur int NOT NULL) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');

        //$this->addSql('CREATE TABLE produit_commande (produit_id INT NOT NULL, commande_id INT NOT NULL, INDEX IDX_47F5946EF347EFB (produit_id), INDEX IDX_47F5946E82EA2E54 (commande_id), PRIMARY KEY(produit_id, commande_id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        //$this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641019EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        //$this->addSql('ALTER TABLE produit_commande ADD CONSTRAINT FK_47F5946EF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        //$this->addSql('ALTER TABLE produit_commande ADD CONSTRAINT FK_47F5946E82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        //$this->addSql('ALTER TABLE compteur CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('DROP INDEX id ON user');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE produit_commande');
        $this->addSql('ALTER TABLE compteur CHANGE id id INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX id ON user (id)');
    }
}
