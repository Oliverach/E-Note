-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema enoteDB
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `enoteDB` ;

-- -----------------------------------------------------
-- Schema enoteDB
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `enoteDB` DEFAULT CHARACTER SET utf8 ;
USE `enoteDB` ;

-- -----------------------------------------------------
-- Table `enoteDB`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `enoteDB`.`user` ;

CREATE TABLE IF NOT EXISTS `enoteDB`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(260) NOT NULL,
  `email` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `enoteDB`.`category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `enoteDB`.`category` ;

CREATE TABLE IF NOT EXISTS `enoteDB`.`category` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `user_id` INT NOT NULL,
  `color` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_category_user_idx` (`user_id` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `enoteDB`.`task`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `enoteDB`.`task` ;

CREATE TABLE IF NOT EXISTS `enoteDB`.`task` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(45) NOT NULL,
  `dueDate` DATE NOT NULL,
  `status` TINYINT NOT NULL,
  `category_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_task_category1_idx` (`category_id` ASC) VISIBLE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- User Creation
-- -----------------------------------------------------
CREATE USER enote_user IDENTIFIED BY "";
GRANT
  SELECT,
  INSERT,
  UPDATE,
  DELETE
ON
  enoteDB.*
TO
  enote_user;