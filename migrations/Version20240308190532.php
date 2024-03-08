<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240308190532 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE discount (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, start_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', end_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', percentage_discount NUMERIC(5, 2) DEFAULT NULL, amount_discount NUMERIC(20, 2) DEFAULT NULL, active TINYINT(1) NOT NULL, priority INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE discount_category (discount_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_6C4A315E4C7C611F (discount_id), INDEX IDX_6C4A315E12469DE2 (category_id), PRIMARY KEY(discount_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE discount_category ADD CONSTRAINT FK_6C4A315E4C7C611F FOREIGN KEY (discount_id) REFERENCES discount (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE discount_category ADD CONSTRAINT FK_6C4A315E12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE discount_category DROP FOREIGN KEY FK_6C4A315E4C7C611F');
        $this->addSql('ALTER TABLE discount_category DROP FOREIGN KEY FK_6C4A315E12469DE2');
        $this->addSql('DROP TABLE discount');
        $this->addSql('DROP TABLE discount_category');
    }
}
