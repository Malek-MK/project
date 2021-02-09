<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210209200611 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F9AF8E3A3');
        $this->addSql('DROP INDEX IDX_A60C9F1F9AF8E3A3 ON livraison');
        $this->addSql('ALTER TABLE livraison ADD commande_id INT DEFAULT NULL, DROP id_commande_id');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_A60C9F1F82EA2E54 ON livraison (commande_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F82EA2E54');
        $this->addSql('DROP INDEX IDX_A60C9F1F82EA2E54 ON livraison');
        $this->addSql('ALTER TABLE livraison ADD id_commande_id INT NOT NULL, DROP commande_id');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F9AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_A60C9F1F9AF8E3A3 ON livraison (id_commande_id)');
    }
}
