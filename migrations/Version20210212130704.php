<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210212130704 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actor ADD created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE categories ADD created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE movie ADD created_at DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actor DROP created_at');
        $this->addSql('ALTER TABLE categories DROP created_at');
        $this->addSql('ALTER TABLE movie DROP created_at');
    }
}
