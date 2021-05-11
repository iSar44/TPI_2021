-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema tournamentManager
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema tournamentManager
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tournamentManager` DEFAULT CHARACTER SET utf8mb4 ;
USE `tournamentManager` ;

-- -----------------------------------------------------
-- Table `tournamentManager`.`TOURNOIS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tournamentManager`.`TOURNOIS` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `TITRE` VARCHAR(50) NOT NULL,
  `DESCRIPTION` VARCHAR(100) NOT NULL,
  `DATE_HEURE_DEMARRAGE` DATETIME NOT NULL,
  `NB_EQUIPES` INT NOT NULL,
  `DATE_HEURE_DEBUT_INSCRIPTION` DATETIME NOT NULL,
  `DATE_HEURE_FIN_INSCRIPTION` DATETIME NOT NULL,
  `TEMPS_ENTRE_RONDES` TIME NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tournamentManager`.`UTILISATEUR`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tournamentManager`.`UTILISATEUR` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `NICKNAME` VARCHAR(45) NOT NULL,
  `EMAIL` VARCHAR(50) NOT NULL,
  `MDP` VARCHAR(255) NOT NULL,
  `ADMIN` TINYINT(0) NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tournamentManager`.`EQUIPE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tournamentManager`.`EQUIPE` (
  `UTILISATEUR_ID` INT NOT NULL,
  `NOM_EQUIPE` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`UTILISATEUR_ID`),
  INDEX `fk_EQUIPE_UTILISATEUR2_idx` (`UTILISATEUR_ID` ASC),
  CONSTRAINT `fk_EQUIPE_UTILISATEUR2`
    FOREIGN KEY (`UTILISATEUR_ID`)
    REFERENCES `tournamentManager`.`UTILISATEUR` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tournamentManager`.`MATCHES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tournamentManager`.`MATCHES` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `EQUIPE_UTILISATEUR_ID1` INT NOT NULL,
  `EQUIPE_UTILISATEUR_ID2` INT NOT NULL,
  `VAINQUEUR_ID` INT NULL,
  PRIMARY KEY (`ID`),
  INDEX `fk_MATCHES_EQUIPE1_idx` (`EQUIPE_UTILISATEUR_ID1` ASC),
  INDEX `fk_MATCHES_EQUIPE2_idx` (`EQUIPE_UTILISATEUR_ID2` ASC),
  INDEX `fk_MATCHES_EQUIPE3_idx` (`VAINQUEUR_ID` ASC),
  CONSTRAINT `fk_MATCHES_EQUIPE1`
    FOREIGN KEY (`EQUIPE_UTILISATEUR_ID1`)
    REFERENCES `tournamentManager`.`EQUIPE` (`UTILISATEUR_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_MATCHES_EQUIPE2`
    FOREIGN KEY (`EQUIPE_UTILISATEUR_ID2`)
    REFERENCES `tournamentManager`.`EQUIPE` (`UTILISATEUR_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_MATCHES_EQUIPE3`
    FOREIGN KEY (`VAINQUEUR_ID`)
    REFERENCES `tournamentManager`.`EQUIPE` (`UTILISATEUR_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tournamentManager`.`RONDE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tournamentManager`.`RONDE` (
  `TOURNOIS_ID` INT NOT NULL,
  `ETAPE` INT NOT NULL,
  `NB_MATCHES` INT NOT NULL,
  `TEMPS_PREPARATION` TIME NOT NULL,
  PRIMARY KEY (`TOURNOIS_ID`, `ETAPE`),
  INDEX `fk_RONDE_TOURNOIS1_idx` (`TOURNOIS_ID` ASC),
  CONSTRAINT `fk_RONDE_TOURNOIS1`
    FOREIGN KEY (`TOURNOIS_ID`)
    REFERENCES `tournamentManager`.`TOURNOIS` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tournamentManager`.`RONDE_has_MATCHES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tournamentManager`.`RONDE_has_MATCHES` (
  `RONDE_TOURNOIS_ID` INT NOT NULL,
  `RONDE_ETAPE` INT NOT NULL,
  `MATCHES_ID` INT NOT NULL,
  PRIMARY KEY (`RONDE_TOURNOIS_ID`, `RONDE_ETAPE`, `MATCHES_ID`),
  INDEX `fk_RONDE_has_MATCHES_MATCHES1_idx` (`MATCHES_ID` ASC),
  INDEX `fk_RONDE_has_MATCHES_RONDE1_idx` (`RONDE_TOURNOIS_ID` ASC, `RONDE_ETAPE` ASC),
  CONSTRAINT `fk_RONDE_has_MATCHES_RONDE1`
    FOREIGN KEY (`RONDE_TOURNOIS_ID` , `RONDE_ETAPE`)
    REFERENCES `tournamentManager`.`RONDE` (`TOURNOIS_ID` , `ETAPE`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_RONDE_has_MATCHES_MATCHES1`
    FOREIGN KEY (`MATCHES_ID`)
    REFERENCES `tournamentManager`.`MATCHES` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
