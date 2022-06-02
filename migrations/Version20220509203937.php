<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220509203937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE califica (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, articulo_id INT NOT NULL, positivo INT NOT NULL, negativo INT NOT NULL, INDEX IDX_D0BDD4A7DB38439E (usuario_id), INDEX IDX_D0BDD4A72DBC2FC9 (articulo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE califica ADD CONSTRAINT FK_D0BDD4A7DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE califica ADD CONSTRAINT FK_D0BDD4A72DBC2FC9 FOREIGN KEY (articulo_id) REFERENCES articulo (id)');
        $this->addSql('DROP TABLE articulo_usuario');
        $this->addSql('ALTER TABLE articulo ADD tipo VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articulo_usuario (articulo_id INT NOT NULL, usuario_id INT NOT NULL, INDEX IDX_45AB41D2DBC2FC9 (articulo_id), INDEX IDX_45AB41DDB38439E (usuario_id), PRIMARY KEY(articulo_id, usuario_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE articulo_usuario ADD CONSTRAINT FK_45AB41D2DBC2FC9 FOREIGN KEY (articulo_id) REFERENCES articulo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articulo_usuario ADD CONSTRAINT FK_45AB41DDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE califica');
        $this->addSql('ALTER TABLE articulo DROP tipo');
    }
}
