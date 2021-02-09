<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210207114214 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D99DED506');
        $this->addSql('ALTER TABLE commande ADD livraison_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D8E54FB25 FOREIGN KEY (livraison_id) REFERENCES livraison (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D8E54FB25 ON commande (livraison_id)');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641019EB6921');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641019EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE lcommande DROP FOREIGN KEY FK_57961F0AAABEFE2C');
        $this->addSql('ALTER TABLE lcommande ADD CONSTRAINT FK_57961F0AAABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F19EB6921');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE llivraison DROP FOREIGN KEY FK_68540739F347EFB');
        $this->addSql('ALTER TABLE llivraison ADD CONSTRAINT FK_68540739F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27322DFB53');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27322DFB53 FOREIGN KEY (id_famille_id) REFERENCES famille (id)');
        $this->addSql('ALTER TABLE produit_commande DROP FOREIGN KEY FK_47F5946E82EA2E54');
        $this->addSql('ALTER TABLE produit_commande DROP FOREIGN KEY FK_47F5946EF347EFB');
        $this->addSql('ALTER TABLE produit_commande ADD CONSTRAINT FK_47F5946E82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_commande ADD CONSTRAINT FK_47F5946EF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reglement DROP FOREIGN KEY FK_EBE4C14C19EB6921');
        $this->addSql('ALTER TABLE reglement DROP FOREIGN KEY FK_EBE4C14C7F2DEE08');
        $this->addSql('ALTER TABLE reglement ADD CONSTRAINT FK_EBE4C14C19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE reglement ADD CONSTRAINT FK_EBE4C14C7F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D8E54FB25');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D99DED506');
        $this->addSql('DROP INDEX IDX_6EEAA67D8E54FB25 ON commande');
        $this->addSql('ALTER TABLE commande DROP livraison_id');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641019EB6921');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641019EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lcommande DROP FOREIGN KEY FK_57961F0AAABEFE2C');
        $this->addSql('ALTER TABLE lcommande ADD CONSTRAINT FK_57961F0AAABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F19EB6921');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE llivraison DROP FOREIGN KEY FK_68540739F347EFB');
        $this->addSql('ALTER TABLE llivraison ADD CONSTRAINT FK_68540739F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27322DFB53');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27322DFB53 FOREIGN KEY (id_famille_id) REFERENCES famille (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_commande DROP FOREIGN KEY FK_47F5946EF347EFB');
        $this->addSql('ALTER TABLE produit_commande DROP FOREIGN KEY FK_47F5946E82EA2E54');
        $this->addSql('ALTER TABLE produit_commande ADD CONSTRAINT FK_47F5946EF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_commande ADD CONSTRAINT FK_47F5946E82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reglement DROP FOREIGN KEY FK_EBE4C14C19EB6921');
        $this->addSql('ALTER TABLE reglement DROP FOREIGN KEY FK_EBE4C14C7F2DEE08');
        $this->addSql('ALTER TABLE reglement ADD CONSTRAINT FK_EBE4C14C19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reglement ADD CONSTRAINT FK_EBE4C14C7F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
