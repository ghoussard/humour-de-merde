-- MySQL Script generated by MySQL Workbench
-- Tue Sep 26 09:31:57 2017
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema hdm
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema hdm
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `hdm` DEFAULT CHARACTER SET utf8 ;
USE `hdm` ;

-- -----------------------------------------------------
-- Table `hdm`.`ranks`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hdm`.`ranks` ;

CREATE TABLE IF NOT EXISTS `hdm`.`ranks` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `level` INT NOT NULL,
  PRIMARY KEY (`id`))
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hdm`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hdm`.`users` ;

CREATE TABLE IF NOT EXISTS `hdm`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(12) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `mail` VARCHAR(255) NOT NULL,
  `firstname` VARCHAR(255) NULL,
  `lastname` VARCHAR(255) NULL,
  `birthdate` DATETIME NULL,
  `registred_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  `last_logged` DATETIME NULL,
  `rank_id` INT NOT NULL DEFAULT 5,
  PRIMARY KEY (`id`),
  INDEX `fk_users_ranks_idx` (`rank_id` ASC),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC),
  UNIQUE INDEX `mail_UNIQUE` (`mail` ASC),
  CONSTRAINT `fk_users_ranks`
  FOREIGN KEY (`rank_id`)
  REFERENCES `hdm`.`ranks` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hdm`.`categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hdm`.`categories` ;

CREATE TABLE IF NOT EXISTS `hdm`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`))
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hdm`.`jokes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hdm`.`jokes` ;

CREATE TABLE IF NOT EXISTS `hdm`.`jokes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `content` LONGTEXT NOT NULL,
  `posted_at` DATETIME NOT NULL,
  `confirmed_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  `user_id` INT NOT NULL,
  `categories_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_jokes_users1_idx` (`user_id` ASC),
  INDEX `fk_jokes_categories1_idx` (`categories_id` ASC),
  CONSTRAINT `fk_jokes_users1`
  FOREIGN KEY (`user_id`)
  REFERENCES `hdm`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_jokes_categories1`
  FOREIGN KEY (`categories_id`)
  REFERENCES `hdm`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hdm`.`votes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hdm`.`votes` ;

CREATE TABLE IF NOT EXISTS `hdm`.`votes` (
  `user_id` INT NOT NULL,
  `joke_id` INT NOT NULL,
  `type` INT NOT NULL,
  PRIMARY KEY (`user_id`, `joke_id`),
  INDEX `fk_jokes_has_users_users1_idx` (`user_id` ASC),
  INDEX `fk_jokes_has_users_jokes1_idx` (`joke_id` ASC),
  CONSTRAINT `fk_jokes_has_users_jokes1`
  FOREIGN KEY (`joke_id`)
  REFERENCES `hdm`.`jokes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_jokes_has_users_users1`
  FOREIGN KEY (`user_id`)
  REFERENCES `hdm`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hdm`.`reasons`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hdm`.`reasons` ;

CREATE TABLE IF NOT EXISTS `hdm`.`reasons` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hdm`.`banning`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hdm`.`banning` ;

CREATE TABLE IF NOT EXISTS `hdm`.`banning` (
  `user_id` INT NOT NULL,
  `reason_id` INT NOT NULL,
  `stopped_at` DATETIME NULL,
  `expired_at` DATETIME NULL,
  PRIMARY KEY (`user_id`, `reason_id`),
  INDEX `fk_users_has_bans_bans1_idx` (`reason_id` ASC),
  INDEX `fk_users_has_bans_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_users_has_bans_users1`
  FOREIGN KEY (`user_id`)
  REFERENCES `hdm`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_bans_bans1`
  FOREIGN KEY (`reason_id`)
  REFERENCES `hdm`.`reasons` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `hdm`.`ranks`
-- -----------------------------------------------------
START TRANSACTION;
USE `hdm`;
INSERT INTO `hdm`.`ranks` (`id`, `name`, `level`) VALUES (DEFAULT, 'Webmaster', 1);
INSERT INTO `hdm`.`ranks` (`id`, `name`, `level`) VALUES (DEFAULT, 'Administrateur', 2);
INSERT INTO `hdm`.`ranks` (`id`, `name`, `level`) VALUES (DEFAULT, 'Modérateur', 3);
INSERT INTO `hdm`.`ranks` (`id`, `name`, `level`) VALUES (DEFAULT, 'VIP', 4);
INSERT INTO `hdm`.`ranks` (`id`, `name`, `level`) VALUES (DEFAULT, 'Membre', 5);

COMMIT;


-- -----------------------------------------------------
-- Data for table `hdm`.`categories`
-- -----------------------------------------------------
START TRANSACTION;
USE `hdm`;
INSERT INTO `hdm`.`categories` (`id`, `name`, `deleted_at`) VALUES (DEFAULT, 'Blague courte', NULL);
INSERT INTO `hdm`.`categories` (`id`, `name`, `deleted_at`) VALUES (DEFAULT, 'Devinette', NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `hdm`.`reasons`
-- -----------------------------------------------------
START TRANSACTION;
USE `hdm`;
INSERT INTO `hdm`.`reasons` (`id`, `name`) VALUES (DEFAULT, 'Insulte');
INSERT INTO `hdm`.`reasons` (`id`, `name`) VALUES (DEFAULT, 'Flood');

COMMIT;