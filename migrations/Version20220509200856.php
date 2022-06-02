<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220509200856 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articulo (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, descripcion VARCHAR(255) NOT NULL, subtitulo VARCHAR(255) NOT NULL, titulo VARCHAR(255) NOT NULL, foto VARCHAR(255) NOT NULL, INDEX IDX_69E94E91DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE articulo_usuario (articulo_id INT NOT NULL, usuario_id INT NOT NULL, INDEX IDX_45AB41D2DBC2FC9 (articulo_id), INDEX IDX_45AB41DDB38439E (usuario_id), PRIMARY KEY(articulo_id, usuario_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partida (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, puntuacion INT NOT NULL, INDEX IDX_A9C1580CDB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nick VARCHAR(255) NOT NULL, contrasena VARCHAR(255) NOT NULL, telefono INT DEFAULT NULL, UNIQUE INDEX UNIQ_2265B05DE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articulo ADD CONSTRAINT FK_69E94E91DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE articulo_usuario ADD CONSTRAINT FK_45AB41D2DBC2FC9 FOREIGN KEY (articulo_id) REFERENCES articulo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articulo_usuario ADD CONSTRAINT FK_45AB41DDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partida ADD CONSTRAINT FK_A9C1580CDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articulo_usuario DROP FOREIGN KEY FK_45AB41D2DBC2FC9');
        $this->addSql('ALTER TABLE articulo DROP FOREIGN KEY FK_69E94E91DB38439E');
        $this->addSql('ALTER TABLE articulo_usuario DROP FOREIGN KEY FK_45AB41DDB38439E');
        $this->addSql('ALTER TABLE partida DROP FOREIGN KEY FK_A9C1580CDB38439E');
        $this->addSql('DROP TABLE articulo');
        $this->addSql('DROP TABLE articulo_usuario');
        $this->addSql('DROP TABLE partida');
        $this->addSql('DROP TABLE usuario');
    }
}
