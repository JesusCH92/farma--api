<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231028172823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE farmacia (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE punto (id INT AUTO_INCREMENT NOT NULL, cliente_id INT NOT NULL, farmacia_id INT NOT NULL, farmacia_canjeada_id INT DEFAULT NULL, creado DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', cantidad INT NOT NULL, INDEX IDX_B706616DDE734E51 (cliente_id), INDEX IDX_B706616D55617F3D (farmacia_id), INDEX IDX_B706616D8087F9F3 (farmacia_canjeada_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tarjeta (id INT AUTO_INCREMENT NOT NULL, saldo NUMERIC(5, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE punto ADD CONSTRAINT FK_B706616DDE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('ALTER TABLE punto ADD CONSTRAINT FK_B706616D55617F3D FOREIGN KEY (farmacia_id) REFERENCES farmacia (id)');
        $this->addSql('ALTER TABLE punto ADD CONSTRAINT FK_B706616D8087F9F3 FOREIGN KEY (farmacia_canjeada_id) REFERENCES farmacia (id)');
        $this->addSql('ALTER TABLE cliente ADD CONSTRAINT FK_F41C9B25D8720997 FOREIGN KEY (tarjeta_id) REFERENCES tarjeta (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cliente DROP FOREIGN KEY FK_F41C9B25D8720997');
        $this->addSql('ALTER TABLE punto DROP FOREIGN KEY FK_B706616DDE734E51');
        $this->addSql('ALTER TABLE punto DROP FOREIGN KEY FK_B706616D55617F3D');
        $this->addSql('ALTER TABLE punto DROP FOREIGN KEY FK_B706616D8087F9F3');
        $this->addSql('DROP TABLE farmacia');
        $this->addSql('DROP TABLE punto');
        $this->addSql('DROP TABLE tarjeta');
    }
}
