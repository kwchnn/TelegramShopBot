<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221214124238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blizzard (id INT AUTO_INCREMENT NOT NULL, blizzard_games_id INT DEFAULT NULL, sort INT NOT NULL, account_name VARCHAR(255) NOT NULL, account_password VARCHAR(255) NOT NULL, secret_question VARCHAR(255) DEFAULT NULL, date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP, account_is_enable TINYINT(1) NOT NULL, INDEX IDX_3D22A718EE69B129 (blizzard_games_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blizzard_games (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, game_available TINYINT(1) NOT NULL, game_price INT NOT NULL, game_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_history (id INT AUTO_INCREMENT NOT NULL, user_profile_id INT DEFAULT NULL, account_type VARCHAR(255) NOT NULL, account_game VARCHAR(255) NOT NULL, account_name VARCHAR(255) NOT NULL, account_password VARCHAR(255) NOT NULL, account_security_question VARCHAR(255) DEFAULT NULL, INDEX IDX_D1C0D9006B9DD454 (user_profile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE origin (id INT AUTO_INCREMENT NOT NULL, game INT NOT NULL, sort INT NOT NULL, account_name VARCHAR(255) NOT NULL, account_password VARCHAR(255) NOT NULL, secret_question VARCHAR(255) DEFAULT NULL, date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP, account_is_enable TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE origin_games (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, game_available TINYINT(1) NOT NULL, game_price INT NOT NULL, game_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE steam (id INT AUTO_INCREMENT NOT NULL, game INT NOT NULL, sort INT NOT NULL, account_name VARCHAR(255) NOT NULL, account_password VARCHAR(255) NOT NULL, secret_question VARCHAR(255) DEFAULT NULL, date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP, account_is_enable TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE steam_games (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, game_available TINYINT(1) NOT NULL, game_price INT NOT NULL, game_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ubisoft (id INT AUTO_INCREMENT NOT NULL, game INT NOT NULL, sort INT NOT NULL, account_name VARCHAR(255) NOT NULL, account_password VARCHAR(255) NOT NULL, secret_question VARCHAR(255) DEFAULT NULL, date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP, account_is_enable TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ubisoft_games (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, game_available TINYINT(1) NOT NULL, game_price INT NOT NULL, game_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_profile (id INT AUTO_INCREMENT NOT NULL, tg_user_id INT NOT NULL, user_name VARCHAR(255) NOT NULL, buy_count INT NOT NULL, account_balance DOUBLE PRECISION NOT NULL, last_game_id INT NOT NULL, UNIQUE INDEX UNIQ_D95AB405922E4C78 (tg_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blizzard ADD CONSTRAINT FK_3D22A718EE69B129 FOREIGN KEY (blizzard_games_id) REFERENCES blizzard_games (id)');
        $this->addSql('ALTER TABLE order_history ADD CONSTRAINT FK_D1C0D9006B9DD454 FOREIGN KEY (user_profile_id) REFERENCES user_profile (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blizzard DROP FOREIGN KEY FK_3D22A718EE69B129');
        $this->addSql('ALTER TABLE order_history DROP FOREIGN KEY FK_D1C0D9006B9DD454');
        $this->addSql('DROP TABLE blizzard');
        $this->addSql('DROP TABLE blizzard_games');
        $this->addSql('DROP TABLE order_history');
        $this->addSql('DROP TABLE origin');
        $this->addSql('DROP TABLE origin_games');
        $this->addSql('DROP TABLE steam');
        $this->addSql('DROP TABLE steam_games');
        $this->addSql('DROP TABLE ubisoft');
        $this->addSql('DROP TABLE ubisoft_games');
        $this->addSql('DROP TABLE user_profile');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
