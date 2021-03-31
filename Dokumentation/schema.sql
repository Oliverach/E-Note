-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema enotedb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `enotedb` ;

-- -----------------------------------------------------
-- Schema enotedb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `enotedb` DEFAULT CHARACTER SET utf8 ;
USE `enotedb` ;

-- -----------------------------------------------------
-- Table `enotedb`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `enotedb`.`user` ;

CREATE TABLE IF NOT EXISTS `enotedb`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(260) NOT NULL,
  `email` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `enotedb`.`category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `enotedb`.`category` ;

CREATE TABLE IF NOT EXISTS `enotedb`.`category` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `user_id` INT NOT NULL,
  `color` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_category_user_idx` (`user_id` ASC) VISIBLE,
  CONSTRAINT `fk_category_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `enotedb`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `enotedb`.`task`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `enotedb`.`task` ;

CREATE TABLE IF NOT EXISTS `enotedb`.`task` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(45) NOT NULL,
  `dueDate` DATE NOT NULL,
  `status` TINYINT NOT NULL,
  `category_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_task_category1_idx` (`category_id` ASC) VISIBLE,
  CONSTRAINT `fk_task_category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `enotedb`.`category` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- User Creation
-- -----------------------------------------------------
CREATE USER enote_user IDENTIFIED BY "1234";
GRANT
  SELECT,
  INSERT,
  UPDATE,
  DELETE
ON
  enotedb.*
TO
  enote_user;