<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230610071338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY id1');
        $this->addSql('DROP INDEX id1 ON cart');
        $this->addSql('DROP INDEX id_product ON cart');
        $this->addSql('ALTER TABLE cart CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE coupons CHANGE id id INT NOT NULL, CHANGE descr descr LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE deposits DROP FOREIGN KEY id_product2');
        $this->addSql('DROP INDEX id_product2 ON deposits');
        $this->addSql('ALTER TABLE deposits CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` CHANGE id id INT NOT NULL, CHANGE date date DATETIME NOT NULL, CHANGE pay_info pay_info LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE prices DROP FOREIGN KEY id_product');
        $this->addSql('DROP INDEX id_product ON prices');
        $this->addSql('ALTER TABLE prices CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE products CHANGE id id INT NOT NULL, CHANGE name name LONGTEXT NOT NULL, CHANGE description description LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT id1 FOREIGN KEY (id_order) REFERENCES `order` (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('CREATE INDEX id1 ON cart (id_order)');
        $this->addSql('CREATE INDEX id_product ON cart (id_product)');
        $this->addSql('ALTER TABLE coupons CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE descr descr TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE deposits CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE deposits ADD CONSTRAINT id_product2 FOREIGN KEY (id_product) REFERENCES products (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('CREATE INDEX id_product2 ON deposits (id_product)');
        $this->addSql('ALTER TABLE `order` CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE date date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE pay_info pay_info TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE prices CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE prices ADD CONSTRAINT id_product FOREIGN KEY (id_product) REFERENCES products (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('CREATE INDEX id_product ON prices (id_product)');
        $this->addSql('ALTER TABLE products CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE name name TEXT NOT NULL, CHANGE description description TEXT DEFAULT NULL');
    }
}
