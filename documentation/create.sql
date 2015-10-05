-- MySQL Script generated by MySQL Workbench
-- mié 22 jul 2015 02:08:17 CDT
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema alerta
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema alerta
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `alerta` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `alerta` ;

-- -----------------------------------------------------
-- Table `alerta`.`city`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `alerta`.`city` (
  `id_city` INT(10) UNSIGNED NOT NULL COMMENT '',
  `name` VARCHAR(99) NOT NULL COMMENT '',
  `active` ENUM('0', '1') NOT NULL DEFAULT '1' COMMENT '',
  PRIMARY KEY (`id_city`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `alerta`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `alerta`.`user` (
  `id_user` INT(10) UNSIGNED NOT NULL COMMENT '',
  `id_city` INT(10) UNSIGNED NOT NULL COMMENT '',
  `username` VARCHAR(45) NOT NULL COMMENT '',
  `token` VARCHAR(45) NOT NULL COMMENT '',
  `secret` VARCHAR(45) NOT NULL COMMENT '',
  `followers` INT(10) NOT NULL DEFAULT 0 COMMENT '',
  `active` ENUM('0', '1') NOT NULL DEFAULT '1' COMMENT '',
  PRIMARY KEY (`id_user`)  COMMENT '',
  INDEX `fk_user_city1_idx` (`id_city` ASC)  COMMENT '',
  CONSTRAINT `fk_user_city1`
    FOREIGN KEY (`id_city`)
    REFERENCES `alerta`.`city` (`id_city`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `alerta`.`dog`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `alerta`.`dog` (
  `id_dog` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `id_city` INT(10) UNSIGNED NOT NULL COMMENT '',
  `id_user` INT(10) UNSIGNED NOT NULL COMMENT '',
  `name` VARCHAR(99) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL COMMENT '',
  `neighbourhood` VARCHAR(99) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL COMMENT '',
  `description` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL COMMENT '',
  `date` DATETIME NOT NULL COMMENT '',
  `phone` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL COMMENT '',
  `email` VARCHAR(99) NOT NULL COMMENT '',
  `status` ENUM('new', 'lost', 'found') NOT NULL DEFAULT 'new' COMMENT '',
  `active` ENUM('0', '1') NOT NULL DEFAULT '1' COMMENT '',
  PRIMARY KEY (`id_dog`)  COMMENT '',
  INDEX `fk_dog_city_idx` (`id_city` ASC)  COMMENT '',
  INDEX `fk_dog_user1_idx` (`id_user` ASC)  COMMENT '',
  CONSTRAINT `fk_dog_city`
    FOREIGN KEY (`id_city`)
    REFERENCES `alerta`.`city` (`id_city`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_dog_user1`
    FOREIGN KEY (`id_user`)
    REFERENCES `alerta`.`user` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;