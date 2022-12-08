<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221013133950 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movie CHANGE slug slug VARCHAR(355) NOT NULL');
        $this->addSql('ALTER TABLE season ADD realease_date DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', DROP release_date');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE season ADD release_date DATE DEFAULT NULL, DROP realease_date');
        $this->addSql('ALTER TABLE movie CHANGE slug slug VARCHAR(255) NOT NULL');
    }
}
