<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240203093649 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE consulta (id INT AUTO_INCREMENT NOT NULL, mascota_id INT NOT NULL, tratamiento_id INT DEFAULT NULL, fecha DATE NOT NULL, observaciones VARCHAR(50) DEFAULT NULL, INDEX IDX_A6FE3FDEFB60C59E (mascota_id), INDEX IDX_A6FE3FDE44168F7D (tratamiento_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mascota (id INT AUTO_INCREMENT NOT NULL, raza_id INT DEFAULT NULL, tipo_id INT DEFAULT NULL, propietario_id INT DEFAULT NULL, nombre VARCHAR(30) NOT NULL, fecha DATE DEFAULT NULL, fecha_nac DATE DEFAULT NULL, INDEX IDX_11298D778CCBB6A9 (raza_id), INDEX IDX_11298D77A9276E6C (tipo_id), INDEX IDX_11298D7753C8D32C (propietario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE propietario (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(40) NOT NULL, direccion VARCHAR(40) NOT NULL, telefono VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE raza (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(30) NOT NULL, tamanio VARCHAR(15) NOT NULL, origen VARCHAR(20) DEFAULT NULL, descripcion VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipo (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tratamiento (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(30) NOT NULL, duracion INT NOT NULL, descripcion VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consulta ADD CONSTRAINT FK_A6FE3FDEFB60C59E FOREIGN KEY (mascota_id) REFERENCES mascota (id)');
        $this->addSql('ALTER TABLE consulta ADD CONSTRAINT FK_A6FE3FDE44168F7D FOREIGN KEY (tratamiento_id) REFERENCES tratamiento (id)');
        $this->addSql('ALTER TABLE mascota ADD CONSTRAINT FK_11298D778CCBB6A9 FOREIGN KEY (raza_id) REFERENCES raza (id)');
        $this->addSql('ALTER TABLE mascota ADD CONSTRAINT FK_11298D77A9276E6C FOREIGN KEY (tipo_id) REFERENCES tipo (id)');
        $this->addSql('ALTER TABLE mascota ADD CONSTRAINT FK_11298D7753C8D32C FOREIGN KEY (propietario_id) REFERENCES propietario (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consulta DROP FOREIGN KEY FK_A6FE3FDEFB60C59E');
        $this->addSql('ALTER TABLE consulta DROP FOREIGN KEY FK_A6FE3FDE44168F7D');
        $this->addSql('ALTER TABLE mascota DROP FOREIGN KEY FK_11298D778CCBB6A9');
        $this->addSql('ALTER TABLE mascota DROP FOREIGN KEY FK_11298D77A9276E6C');
        $this->addSql('ALTER TABLE mascota DROP FOREIGN KEY FK_11298D7753C8D32C');
        $this->addSql('DROP TABLE consulta');
        $this->addSql('DROP TABLE mascota');
        $this->addSql('DROP TABLE propietario');
        $this->addSql('DROP TABLE raza');
        $this->addSql('DROP TABLE tipo');
        $this->addSql('DROP TABLE tratamiento');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
