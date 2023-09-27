<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230927183043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin_notes (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT NOT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE application (id INT AUTO_INCREMENT NOT NULL, candidate_id INT NOT NULL, job_offer_id INT NOT NULL, status_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_A45BDDC191BD8781 (candidate_id), INDEX IDX_A45BDDC13481D195 (job_offer_id), INDEX IDX_A45BDDC16BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE application_status (id INT AUTO_INCREMENT NOT NULL, status_value VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidate (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, gender_id INT DEFAULT NULL, passport_file_id INT DEFAULT NULL, curriculum_vitae_id INT DEFAULT NULL, profile_picture_id INT DEFAULT NULL, job_category_id INT DEFAULT NULL, experience_id INT DEFAULT NULL, notes_id INT DEFAULT NULL, first_name VARCHAR(100) DEFAULT NULL, last_name VARCHAR(100) DEFAULT NULL, adress LONGTEXT DEFAULT NULL, country VARCHAR(100) DEFAULT NULL, nationality VARCHAR(100) DEFAULT NULL, is_passport_valid TINYINT(1) DEFAULT NULL, current_location LONGTEXT DEFAULT NULL, date_of_birth DATE DEFAULT NULL, place_of_birth LONGTEXT DEFAULT NULL, is_available TINYINT(1) DEFAULT NULL, short_description VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_C8B28E44A76ED395 (user_id), INDEX IDX_C8B28E44708A0E0 (gender_id), UNIQUE INDEX UNIQ_C8B28E44631C839D (passport_file_id), UNIQUE INDEX UNIQ_C8B28E444AF29A35 (curriculum_vitae_id), UNIQUE INDEX UNIQ_C8B28E44292E8AE2 (profile_picture_id), INDEX IDX_C8B28E44712A86AB (job_category_id), INDEX IDX_C8B28E4446E90E27 (experience_id), UNIQUE INDEX UNIQ_C8B28E44FC56F556 (notes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, status_id INT NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, phone_number VARCHAR(16) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_4C62E6386BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_status (id INT AUTO_INCREMENT NOT NULL, status_value VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, notes_id INT DEFAULT NULL, company_name VARCHAR(100) NOT NULL, activity_type VARCHAR(100) NOT NULL, contact_name VARCHAR(100) NOT NULL, position VARCHAR(100) NOT NULL, contact_phone_number VARCHAR(16) NOT NULL, contact_email VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_81398E09FC56F556 (notes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience (id INT AUTO_INCREMENT NOT NULL, experience_value VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gender_list (id INT AUTO_INCREMENT NOT NULL, gender_value VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_category (id INT AUTO_INCREMENT NOT NULL, category_value VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_offer (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, notes_id INT DEFAULT NULL, job_type_id INT NOT NULL, job_category_id INT NOT NULL, reference VARCHAR(10) NOT NULL, is_active TINYINT(1) NOT NULL, job_title VARCHAR(100) NOT NULL, location LONGTEXT NOT NULL, closing_date DATE NOT NULL, salary INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_288A3A4E9395C3F3 (customer_id), UNIQUE INDEX UNIQ_288A3A4EFC56F556 (notes_id), INDEX IDX_288A3A4E5FA33B08 (job_type_id), INDEX IDX_288A3A4E712A86AB (job_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_type (id INT AUTO_INCREMENT NOT NULL, type_value VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC191BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id)');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC13481D195 FOREIGN KEY (job_offer_id) REFERENCES job_offer (id)');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC16BF700BD FOREIGN KEY (status_id) REFERENCES application_status (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44708A0E0 FOREIGN KEY (gender_id) REFERENCES gender_list (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44631C839D FOREIGN KEY (passport_file_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E444AF29A35 FOREIGN KEY (curriculum_vitae_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44292E8AE2 FOREIGN KEY (profile_picture_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44712A86AB FOREIGN KEY (job_category_id) REFERENCES job_category (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E4446E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44FC56F556 FOREIGN KEY (notes_id) REFERENCES admin_notes (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6386BF700BD FOREIGN KEY (status_id) REFERENCES contact_status (id)');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09FC56F556 FOREIGN KEY (notes_id) REFERENCES admin_notes (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4EFC56F556 FOREIGN KEY (notes_id) REFERENCES admin_notes (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E5FA33B08 FOREIGN KEY (job_type_id) REFERENCES job_type (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E712A86AB FOREIGN KEY (job_category_id) REFERENCES job_category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC191BD8781');
        $this->addSql('ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC13481D195');
        $this->addSql('ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC16BF700BD');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44A76ED395');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44708A0E0');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44631C839D');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E444AF29A35');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44292E8AE2');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44712A86AB');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E4446E90E27');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44FC56F556');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6386BF700BD');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09FC56F556');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E9395C3F3');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4EFC56F556');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E5FA33B08');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E712A86AB');
        $this->addSql('DROP TABLE admin_notes');
        $this->addSql('DROP TABLE application');
        $this->addSql('DROP TABLE application_status');
        $this->addSql('DROP TABLE candidate');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE contact_status');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE gender_list');
        $this->addSql('DROP TABLE job_category');
        $this->addSql('DROP TABLE job_offer');
        $this->addSql('DROP TABLE job_type');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
