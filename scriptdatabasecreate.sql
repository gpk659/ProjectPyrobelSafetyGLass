-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema safetyglass_db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema safetyglass_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `safetyglass_db` DEFAULT CHARACTER SET latin1 ;
USE `safetyglass_db` ;

-- -----------------------------------------------------
-- Table `safetyglass_db`.`plateau`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `safetyglass_db`.`plateau` (
  `idPlateau` INT(10) NOT NULL AUTO_INCREMENT,
  `idEmplacement` INT(10) NOT NULL,
  `numCadre` VARCHAR(45) NULL DEFAULT NULL,
  `positionCadre` INT(4) NOT NULL,
  `numPlateau` VARCHAR(45) NOT NULL,
  `largeur` INT(4) NOT NULL,
  `hauteur` INT(4) NOT NULL,
  `commentaire` VARCHAR(255) NULL DEFAULT NULL,
  `date` DATE NOT NULL,
  `nomFournisseur` VARCHAR(45) NOT NULL,
  `numCommande` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idPlateau`),
  UNIQUE INDEX `idPlateau_UNIQUE` (`idPlateau` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `safetyglass_db`.`defaut_agc`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `safetyglass_db`.`defaut_agc` (
  `idDefaut_AGC` INT(11) NOT NULL AUTO_INCREMENT,
  `initialeTypeDefaut` VARCHAR(1) NOT NULL,
  `X0` INT(4) NOT NULL,
  `Y0` INT(4) NOT NULL,
  `X1` INT(4) NOT NULL,
  `Y1` INT(4) NOT NULL,
  `plateau_idPlateau` INT(10) NOT NULL,
  PRIMARY KEY (`idDefaut_AGC`),
  UNIQUE INDEX `idDefaut_AGC_UNIQUE` (`idDefaut_AGC` ASC) VISIBLE,
  INDEX `fk_defaut_agc_plateau1_idx` (`plateau_idPlateau` ASC) VISIBLE,
  CONSTRAINT `fk_defaut_agc_plateau1`
    FOREIGN KEY (`plateau_idPlateau`)
    REFERENCES `safetyglass_db`.`plateau` (`idPlateau`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `safetyglass_db`.`usine`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `safetyglass_db`.`usine` (
  `idUsine` INT(10) NOT NULL AUTO_INCREMENT,
  `abreviation` VARCHAR(2) NULL DEFAULT NULL,
  `nomUsine` VARCHAR(45) NULL DEFAULT NULL,
  `description` VARCHAR(45) NULL DEFAULT NULL,
  `largeur` INT(6) NULL DEFAULT NULL,
  `longueur` INT(6) NULL DEFAULT NULL,
  `subdivisionLargeur` INT(4) NULL DEFAULT NULL,
  `subdivisionLongueur` INT(4) NULL DEFAULT NULL,
  `nomFichierPlan` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idUsine`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `safetyglass_db`.`zone`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `safetyglass_db`.`zone` (
  `idZone` INT(11) NOT NULL AUTO_INCREMENT,
  `abreviation` VARCHAR(2) NULL DEFAULT NULL,
  `nomZone` VARCHAR(45) NULL DEFAULT NULL,
  `description` VARCHAR(45) NULL DEFAULT NULL,
  `largeur` INT(6) NULL DEFAULT NULL,
  `longueur` INT(6) NULL DEFAULT NULL,
  `X0` INT(6) NULL DEFAULT NULL,
  `Y0` INT(6) NULL DEFAULT NULL,
  `usine_idUsine` INT(10) NOT NULL,
  PRIMARY KEY (`idZone`),
  INDEX `fk_zone_usine1_idx` (`usine_idUsine` ASC) VISIBLE,
  CONSTRAINT `fk_zone_usine1`
    FOREIGN KEY (`usine_idUsine`)
    REFERENCES `safetyglass_db`.`usine` (`idUsine`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `safetyglass_db`.`rack`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `safetyglass_db`.`rack` (
  `idRack` INT(10) NOT NULL AUTO_INCREMENT,
  `abreviation` VARCHAR(5) NULL DEFAULT NULL,
  `nomRack` VARCHAR(45) NULL DEFAULT NULL,
  `description` VARCHAR(45) NULL DEFAULT NULL,
  `largeur` INT(6) NULL DEFAULT NULL,
  `longueur` INT(6) NULL DEFAULT NULL,
  `X0` INT(6) NULL DEFAULT NULL,
  `Y0` INT(6) NULL DEFAULT NULL,
  `zone_idZone` INT(11) NOT NULL,
  PRIMARY KEY (`idRack`),
  INDEX `fk_rack_zone_idx` (`zone_idZone` ASC) VISIBLE,
  CONSTRAINT `fk_rack_zone`
    FOREIGN KEY (`zone_idZone`)
    REFERENCES `safetyglass_db`.`zone` (`idZone`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `safetyglass_db`.`emplacement`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `safetyglass_db`.`emplacement` (
  `idEmplacement` INT(10) NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(45) NULL DEFAULT NULL,
  `largeurPied` INT(4) NULL DEFAULT NULL,
  `poidsMax` INT(6) NULL DEFAULT NULL,
  `usine_idUsine` INT(10) NOT NULL,
  `zone_idZone` INT(11) NOT NULL,
  `rack_idRack` INT(10) NOT NULL,
  PRIMARY KEY (`idEmplacement`),
  INDEX `fk_emplacement_usine1_idx` (`usine_idUsine` ASC) VISIBLE,
  INDEX `fk_emplacement_zone1_idx` (`zone_idZone` ASC) VISIBLE,
  INDEX `fk_emplacement_rack1_idx` (`rack_idRack` ASC) VISIBLE,
  CONSTRAINT `fk_emplacement_rack1`
    FOREIGN KEY (`rack_idRack`)
    REFERENCES `safetyglass_db`.`rack` (`idRack`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_emplacement_usine1`
    FOREIGN KEY (`usine_idUsine`)
    REFERENCES `safetyglass_db`.`usine` (`idUsine`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_emplacement_zone1`
    FOREIGN KEY (`zone_idZone`)
    REFERENCES `safetyglass_db`.`zone` (`idZone`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `safetyglass_db`.`fammille_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `safetyglass_db`.`fammille_type` (
  `idFammille_Type` INT(11) NOT NULL AUTO_INCREMENT,
  `nomFammille_Type` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idFammille_Type`),
  UNIQUE INDEX `idFammille_Type_UNIQUE` (`idFammille_Type` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `safetyglass_db`.`listechutte`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `safetyglass_db`.`listechutte` (
  `idChutte` INT(10) NOT NULL AUTO_INCREMENT,
  `largeur` INT(4) NULL DEFAULT NULL,
  `hauteur` INT(4) NULL DEFAULT NULL,
  `X0` INT(4) NULL DEFAULT NULL,
  `Y0` INT(4) NULL DEFAULT NULL,
  `dateMiseStock` DATE NULL DEFAULT NULL,
  `heureMiseStock` TIME NULL DEFAULT NULL,
  `commentaire` VARCHAR(255) NOT NULL,
  `dateReutilisation` DATE NULL DEFAULT NULL,
  `heureReutilisation` TIME NULL DEFAULT NULL,
  `positionEmp` INT(4) NULL DEFAULT NULL,
  `plateau_idPlateau` INT(10) NOT NULL,
  `emplacement_idEmplacement` INT(10) NOT NULL,
  `type_idType` INT(11) NOT NULL,
  PRIMARY KEY (`idChutte`),
  UNIQUE INDEX `idChutte_UNIQUE` (`idChutte` ASC) VISIBLE,
  INDEX `fk_listechutte_plateau1_idx` (`plateau_idPlateau` ASC) VISIBLE,
  INDEX `fk_listechutte_emplacement1_idx` (`emplacement_idEmplacement` ASC) VISIBLE,
  CONSTRAINT `fk_listechutte_emplacement1`
    FOREIGN KEY (`emplacement_idEmplacement`)
    REFERENCES `safetyglass_db`.`emplacement` (`idEmplacement`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_listechutte_plateau1`
    FOREIGN KEY (`plateau_idPlateau`)
    REFERENCES `safetyglass_db`.`plateau` (`idPlateau`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 15
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `safetyglass_db`.`listedefaut`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `safetyglass_db`.`listedefaut` (
  `idDefaut` INT(10) NOT NULL AUTO_INCREMENT,
  `X0` INT(10) NULL DEFAULT NULL,
  `Y0` INT(10) NULL DEFAULT NULL,
  `X1` INT(10) NULL DEFAULT NULL,
  `Y1` INT(10) NULL DEFAULT NULL,
  `commentaire` VARCHAR(255) NULL DEFAULT NULL,
  `plateau_idPlateau` INT(10) NOT NULL,
  PRIMARY KEY (`idDefaut`),
  UNIQUE INDEX `idDefaut_UNIQUE` (`idDefaut` ASC) VISIBLE,
  INDEX `fk_listedefaut_plateau1_idx` (`plateau_idPlateau` ASC) VISIBLE,
  CONSTRAINT `fk_listedefaut_plateau1`
    FOREIGN KEY (`plateau_idPlateau`)
    REFERENCES `safetyglass_db`.`plateau` (`idPlateau`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `safetyglass_db`.`listeoperateur`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `safetyglass_db`.`listeoperateur` (
  `idOperateur` INT(11) NOT NULL AUTO_INCREMENT,
  `initialesOp` VARCHAR(3) NULL DEFAULT NULL,
  `nomOp` VARCHAR(45) NULL DEFAULT NULL,
  `usine_idUsine` INT(10) NOT NULL,
  `zone_idZone` INT(11) NOT NULL,
  PRIMARY KEY (`idOperateur`),
  UNIQUE INDEX `idOperateur_UNIQUE` (`idOperateur` ASC) VISIBLE,
  INDEX `fk_listeoperateur_usine1_idx` (`usine_idUsine` ASC) VISIBLE,
  INDEX `fk_listeoperateur_zone1_idx` (`zone_idZone` ASC) VISIBLE,
  CONSTRAINT `fk_listeoperateur_usine1`
    FOREIGN KEY (`usine_idUsine`)
    REFERENCES `safetyglass_db`.`usine` (`idUsine`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_listeoperateur_zone1`
    FOREIGN KEY (`zone_idZone`)
    REFERENCES `safetyglass_db`.`zone` (`idZone`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `safetyglass_db`.`listevolume`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `safetyglass_db`.`listevolume` (
  `idListeVolume` INT(11) NOT NULL AUTO_INCREMENT,
  `numCom` VARCHAR(45) NOT NULL,
  `lettre` VARCHAR(3) NOT NULL,
  `x` INT(11) NULL DEFAULT NULL,
  `nnn` INT(11) NULL DEFAULT NULL,
  `datelivraison` DATE NULL DEFAULT NULL,
  `typeverre` VARCHAR(45) NULL DEFAULT NULL,
  `largeur` VARCHAR(45) NOT NULL,
  `hauteur` VARCHAR(45) NOT NULL,
  `faconnage` VARCHAR(45) NULL DEFAULT NULL,
  `commentaire` VARCHAR(255) NULL DEFAULT NULL,
  `chutesug` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idListeVolume`))
ENGINE = InnoDB
AUTO_INCREMENT = 18
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `safetyglass_db`.`listevolumesbons`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `safetyglass_db`.`listevolumesbons` (
  `idVolume` INT(11) NOT NULL AUTO_INCREMENT,
  `numCom` VARCHAR(45) NOT NULL,
  `lettre` VARCHAR(3) NOT NULL,
  `numVol` INT(4) NULL DEFAULT NULL,
  `largeur` INT(4) NOT NULL,
  `hauteur` INT(4) NOT NULL,
  `X0` INT(4) NULL DEFAULT NULL,
  `Y0` INT(4) NULL DEFAULT NULL,
  `dateFabrication` DATE NOT NULL,
  `heureFabrication` TIME NULL DEFAULT NULL,
  `commentaire` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`idVolume`),
  UNIQUE INDEX `idVolume_UNIQUE` (`idVolume` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 41
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `safetyglass_db`.`sousfamille_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `safetyglass_db`.`sousfamille_type` (
  `idSousFamille_Type` INT(10) NOT NULL AUTO_INCREMENT,
  `nomSousFamilleType` VARCHAR(45) NULL DEFAULT NULL,
  `fammille_type_idFammille_Type` INT(11) NOT NULL,
  PRIMARY KEY (`idSousFamille_Type`),
  UNIQUE INDEX `idSousFamille_Type_UNIQUE` (`idSousFamille_Type` ASC) VISIBLE,
  INDEX `fk_sousfamille_type_fammille_type1_idx` (`fammille_type_idFammille_Type` ASC) VISIBLE,
  CONSTRAINT `fk_sousfamille_type_fammille_type1`
    FOREIGN KEY (`fammille_type_idFammille_Type`)
    REFERENCES `safetyglass_db`.`fammille_type` (`idFammille_Type`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `safetyglass_db`.`type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `safetyglass_db`.`type` (
  `idType` INT(10) NOT NULL AUTO_INCREMENT,
  `nomType` VARCHAR(45) NULL DEFAULT NULL,
  `epType` DOUBLE NULL DEFAULT NULL,
  `masseType` DOUBLE NULL DEFAULT NULL,
  `codeAGCType` VARCHAR(45) NULL DEFAULT NULL,
  `sousfamille_type_idSousFamille_Type` INT(10) NOT NULL,
  `descriptionCourte` VARCHAR(45) NOT NULL,
  `descriptionComplete` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idType`),
  UNIQUE INDEX `idType_UNIQUE` (`idType` ASC) VISIBLE,
  INDEX `fk_type_sousfamille_type1_idx` (`sousfamille_type_idSousFamille_Type` ASC) VISIBLE,
  CONSTRAINT `fk_type_sousfamille_type1`
    FOREIGN KEY (`sousfamille_type_idSousFamille_Type`)
    REFERENCES `safetyglass_db`.`sousfamille_type` (`idSousFamille_Type`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `safetyglass_db`.`typedefautagc`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `safetyglass_db`.`typedefautagc` (
  `idTypeDefautAGC` VARCHAR(1) NOT NULL AUTO_INCREMENT,
  `descriptionTypeDefaut` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idTypeDefautAGC`),
  UNIQUE INDEX `idTypeDefautAGC_UNIQUE` (`idTypeDefautAGC` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `safetyglass_db`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `safetyglass_db`.`user` (
  `iduser` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `dateLastLogin` VARCHAR(25) NULL DEFAULT NULL,
  `nivdroit` INT(1) NOT NULL,
  PRIMARY KEY (`iduser`),
  UNIQUE INDEX `iduser_UNIQUE` (`iduser` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
