<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220513101711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE oferta (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, modelo VARCHAR(255) NOT NULL, precio INT NOT NULL, cv INT NOT NULL, descripcion VARCHAR(255) NOT NULL, cilindrada INT NOT NULL, color VARCHAR(255) NOT NULL, km INT NOT NULL, cambio VARCHAR(255) NOT NULL, plazas INT NOT NULL, puertas INT NOT NULL, INDEX IDX_7479C8F2DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE oferta ADD CONSTRAINT FK_7479C8F2DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE oferta');
    }
}
