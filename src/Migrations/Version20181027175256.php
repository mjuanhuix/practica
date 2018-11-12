<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181027175256 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aplicacion CHANGE id id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE aplicacion_traduccion CHANGE id id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE aplicacion_traduccion ADD CONSTRAINT FK_C248FDEA3AF686C8 FOREIGN KEY (aplicacion_id) REFERENCES aplicacion (id)');
        $this->addSql('CREATE INDEX IDX_C248FDEA3AF686C8 ON aplicacion_traduccion (aplicacion_id)');
        $this->addSql('ALTER TABLE caracteristica CHANGE id id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE caracteristica ADD CONSTRAINT FK_999DAE493AF686C8 FOREIGN KEY (aplicacion_id) REFERENCES aplicacion (id)');
        $this->addSql('CREATE INDEX IDX_999DAE493AF686C8 ON caracteristica (aplicacion_id)');
        $this->addSql('ALTER TABLE caracteristica_traduccion CHANGE id id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE caracteristica_traduccion ADD CONSTRAINT FK_70888B4DA7300D78 FOREIGN KEY (caracteristica_id) REFERENCES caracteristica (id)');
        $this->addSql('CREATE INDEX IDX_70888B4DA7300D78 ON caracteristica_traduccion (caracteristica_id)');
        $this->addSql('ALTER TABLE cliente CHANGE id id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE proyecto CHANGE id id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE proyecto ADD CONSTRAINT FK_6FD202B91CB9D6E4 FOREIGN KEY (solicitud_id) REFERENCES solicitud (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6FD202B91CB9D6E4 ON proyecto (solicitud_id)');
        $this->addSql('ALTER TABLE solicitud CHANGE id id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE solicitud ADD CONSTRAINT FK_96D27CC0DE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('ALTER TABLE solicitud ADD CONSTRAINT FK_96D27CC03AF686C8 FOREIGN KEY (aplicacion_id) REFERENCES aplicacion (id)');
        $this->addSql('CREATE INDEX IDX_96D27CC0DE734E51 ON solicitud (cliente_id)');
        $this->addSql('CREATE INDEX IDX_96D27CC03AF686C8 ON solicitud (aplicacion_id)');
        $this->addSql('ALTER TABLE solicitud_caracteristica ADD PRIMARY KEY (solicitud_id, caracteristica_id)');
        $this->addSql('ALTER TABLE solicitud_caracteristica ADD CONSTRAINT FK_4B5CDAB91CB9D6E4 FOREIGN KEY (solicitud_id) REFERENCES solicitud (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE solicitud_caracteristica ADD CONSTRAINT FK_4B5CDAB9A7300D78 FOREIGN KEY (caracteristica_id) REFERENCES caracteristica (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_4B5CDAB91CB9D6E4 ON solicitud_caracteristica (solicitud_id)');
        $this->addSql('CREATE INDEX IDX_4B5CDAB9A7300D78 ON solicitud_caracteristica (caracteristica_id)');
        $this->addSql('ALTER TABLE tarea CHANGE id id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE tarea ADD CONSTRAINT FK_3CA05366F625D1BA FOREIGN KEY (proyecto_id) REFERENCES proyecto (id)');
        $this->addSql('ALTER TABLE tarea ADD CONSTRAINT FK_3CA05366DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_3CA05366F625D1BA ON tarea (proyecto_id)');
        $this->addSql('CREATE INDEX IDX_3CA05366DB38439E ON tarea (usuario_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aplicacion MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE aplicacion DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE aplicacion CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE aplicacion_traduccion MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE aplicacion_traduccion DROP FOREIGN KEY FK_C248FDEA3AF686C8');
        $this->addSql('DROP INDEX IDX_C248FDEA3AF686C8 ON aplicacion_traduccion');
        $this->addSql('ALTER TABLE aplicacion_traduccion DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE aplicacion_traduccion CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE caracteristica MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE caracteristica DROP FOREIGN KEY FK_999DAE493AF686C8');
        $this->addSql('DROP INDEX IDX_999DAE493AF686C8 ON caracteristica');
        $this->addSql('ALTER TABLE caracteristica DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE caracteristica CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE caracteristica_traduccion MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE caracteristica_traduccion DROP FOREIGN KEY FK_70888B4DA7300D78');
        $this->addSql('DROP INDEX IDX_70888B4DA7300D78 ON caracteristica_traduccion');
        $this->addSql('ALTER TABLE caracteristica_traduccion DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE caracteristica_traduccion CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE cliente MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE cliente DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE cliente CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE proyecto MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE proyecto DROP FOREIGN KEY FK_6FD202B91CB9D6E4');
        $this->addSql('DROP INDEX UNIQ_6FD202B91CB9D6E4 ON proyecto');
        $this->addSql('ALTER TABLE proyecto DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE proyecto CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE solicitud MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE solicitud DROP FOREIGN KEY FK_96D27CC0DE734E51');
        $this->addSql('ALTER TABLE solicitud DROP FOREIGN KEY FK_96D27CC03AF686C8');
        $this->addSql('DROP INDEX IDX_96D27CC0DE734E51 ON solicitud');
        $this->addSql('DROP INDEX IDX_96D27CC03AF686C8 ON solicitud');
        $this->addSql('ALTER TABLE solicitud DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE solicitud CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE solicitud_caracteristica DROP FOREIGN KEY FK_4B5CDAB91CB9D6E4');
        $this->addSql('ALTER TABLE solicitud_caracteristica DROP FOREIGN KEY FK_4B5CDAB9A7300D78');
        $this->addSql('DROP INDEX IDX_4B5CDAB91CB9D6E4 ON solicitud_caracteristica');
        $this->addSql('DROP INDEX IDX_4B5CDAB9A7300D78 ON solicitud_caracteristica');
        $this->addSql('ALTER TABLE solicitud_caracteristica DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE tarea MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE tarea DROP FOREIGN KEY FK_3CA05366F625D1BA');
        $this->addSql('ALTER TABLE tarea DROP FOREIGN KEY FK_3CA05366DB38439E');
        $this->addSql('DROP INDEX IDX_3CA05366F625D1BA ON tarea');
        $this->addSql('DROP INDEX IDX_3CA05366DB38439E ON tarea');
        $this->addSql('ALTER TABLE tarea DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE tarea CHANGE id id INT NOT NULL');
    }
}
