<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210209194150 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D8E54FB25');
        $this->addSql('DROP INDEX IDX_6EEAA67D8E54FB25 ON commande');
        $this->addSql('ALTER TABLE commande ADD obs VARCHAR(50) NOT NULL, ADD montht DOUBLE PRECISION NOT NULL, DROP livraison_id');
        $this->addSql('ALTER TABLE compteur CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE numcomp numcomp INT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE facture DROP base1, DROP tva1, DROP base2, DROP tva2, DROP base3, DROP tva3, DROP rs, DROP montrs');
        $this->addSql('ALTER TABLE lcommande DROP FOREIGN KEY FK_57961F0A9AF8E3A3');
        $this->addSql('DROP INDEX IDX_57961F0A9AF8E3A3 ON lcommande');
        $this->addSql('ALTER TABLE lcommande ADD lig VARCHAR(50) NOT NULL, ADD numc VARCHAR(50) NOT NULL, DROP id_commande_id');
        $this->addSql('ALTER TABLE livraison ADD id_commande_id INT NOT NULL, CHANGE dateliv dateliv DATE NOT NULL');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F9AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_A60C9F1F9AF8E3A3 ON livraison (id_commande_id)');
        $this->addSql('ALTER TABLE produit CHANGE image image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE login login VARCHAR(20) NOT NULL, CHANGE pwd pwd VARCHAR(20) NOT NULL, CHANGE role role VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD livraison_id INT NOT NULL, DROP obs, DROP montht');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D8E54FB25 FOREIGN KEY (livraison_id) REFERENCES livraison (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D8E54FB25 ON commande (livraison_id)');
        $this->addSql('ALTER TABLE compteur MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE compteur DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE compteur CHANGE id id INT DEFAULT NULL, CHANGE numcomp numcomp INT DEFAULT NULL');
        $this->addSql('ALTER TABLE facture ADD base1 VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, ADD tva1 VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, ADD base2 VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, ADD tva2 VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, ADD base3 VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, ADD tva3 VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, ADD rs VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, ADD montrs VARCHAR(5) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE lcommande ADD id_commande_id INT NOT NULL, DROP lig, DROP numc');
        $this->addSql('ALTER TABLE lcommande ADD CONSTRAINT FK_57961F0A9AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_57961F0A9AF8E3A3 ON lcommande (id_commande_id)');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F9AF8E3A3');
        $this->addSql('DROP INDEX IDX_A60C9F1F9AF8E3A3 ON livraison');
        $this->addSql('ALTER TABLE livraison DROP id_commande_id, CHANGE dateliv dateliv VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE produit CHANGE image image VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE login login INT NOT NULL, CHANGE pwd pwd INT NOT NULL, CHANGE role role VARCHAR(1) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`');
    }
}
