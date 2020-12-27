<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201223175513 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, create_at DATETIME NOT NULL, update_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, thumbnail VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE console (id INT AUTO_INCREMENT NOT NULL, create_at DATETIME NOT NULL, update_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, thumbnail VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, release_date DATE NOT NULL, release_price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, license_id INT NOT NULL, create_at DATETIME NOT NULL, update_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, thumbnail VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, history LONGTEXT DEFAULT NULL, release_date DATE NOT NULL, nb_players SMALLINT NOT NULL, copies_sold INT NOT NULL, background_desktop VARCHAR(255) DEFAULT NULL, background_mobile VARCHAR(255) DEFAULT NULL, background_position VARCHAR(255) DEFAULT NULL, first_block_min_height INT DEFAULT NULL, after_bottom INT DEFAULT NULL, INDEX IDX_232B318C460F904B (license_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_console (game_id INT NOT NULL, console_id INT NOT NULL, INDEX IDX_A3C1B099E48FD905 (game_id), INDEX IDX_A3C1B09972F9DD9F (console_id), PRIMARY KEY(game_id, console_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_genre (game_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_B1634A77E48FD905 (game_id), INDEX IDX_B1634A774296D31F (genre_id), PRIMARY KEY(game_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_character (id INT AUTO_INCREMENT NOT NULL, game_id INT NOT NULL, current_character_id INT NOT NULL, create_at DATETIME NOT NULL, update_at DATETIME DEFAULT NULL, thumbnail VARCHAR(255) NOT NULL, INDEX IDX_41DC7136E48FD905 (game_id), INDEX IDX_41DC7136EE8700AE (current_character_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_item (id INT AUTO_INCREMENT NOT NULL, game_id INT NOT NULL, item_id INT NOT NULL, create_at DATETIME NOT NULL, update_at DATETIME DEFAULT NULL, thumbnail VARCHAR(255) NOT NULL, INDEX IDX_F40E4932E48FD905 (game_id), INDEX IDX_F40E4932126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, create_at DATETIME NOT NULL, update_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, thumbnail VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE license (id INT AUTO_INCREMENT NOT NULL, create_at DATETIME NOT NULL, update_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, thumbnail VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, logo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, create_at DATETIME NOT NULL, update_at DATETIME DEFAULT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, active TINYINT(1) DEFAULT \'0\' NOT NULL, token VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C460F904B FOREIGN KEY (license_id) REFERENCES license (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_console ADD CONSTRAINT FK_A3C1B099E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_console ADD CONSTRAINT FK_A3C1B09972F9DD9F FOREIGN KEY (console_id) REFERENCES console (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_genre ADD CONSTRAINT FK_B1634A77E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_genre ADD CONSTRAINT FK_B1634A774296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_character ADD CONSTRAINT FK_41DC7136E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_character ADD CONSTRAINT FK_41DC7136EE8700AE FOREIGN KEY (current_character_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_item ADD CONSTRAINT FK_F40E4932E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_item ADD CONSTRAINT FK_F40E4932126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game_character DROP FOREIGN KEY FK_41DC7136EE8700AE');
        $this->addSql('ALTER TABLE game_console DROP FOREIGN KEY FK_A3C1B09972F9DD9F');
        $this->addSql('ALTER TABLE game_console DROP FOREIGN KEY FK_A3C1B099E48FD905');
        $this->addSql('ALTER TABLE game_genre DROP FOREIGN KEY FK_B1634A77E48FD905');
        $this->addSql('ALTER TABLE game_character DROP FOREIGN KEY FK_41DC7136E48FD905');
        $this->addSql('ALTER TABLE game_item DROP FOREIGN KEY FK_F40E4932E48FD905');
        $this->addSql('ALTER TABLE game_genre DROP FOREIGN KEY FK_B1634A774296D31F');
        $this->addSql('ALTER TABLE game_item DROP FOREIGN KEY FK_F40E4932126F525E');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C460F904B');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE console');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_console');
        $this->addSql('DROP TABLE game_genre');
        $this->addSql('DROP TABLE game_character');
        $this->addSql('DROP TABLE game_item');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE license');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE user');
    }
}
