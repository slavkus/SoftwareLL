-- MySQL Script generated by MySQL Workbench
-- Wed Mar 27 12:37:52 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema SoftwareLL
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema SoftwareLL
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `SoftwareLL`.`uloga_korisnika`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SoftwareLL`.`uloga_korisnika` (
  `id_uloga` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_uloga`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SoftwareLL`.`dnevnik_rada`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SoftwareLL`.`dnevnik_rada` (
  `id_dnevnik_rada` INT NOT NULL AUTO_INCREMENT,
  `opis_zahtjeva` VARCHAR(400) NOT NULL,
  `datum_unosa` DATE NOT NULL,
  PRIMARY KEY (`id_dnevnik_rada`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SoftwareLL`.`korisnik`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SoftwareLL`.`korisnik` (
  `id_korisnik` INT NOT NULL AUTO_INCREMENT,
  `uloga_korisnika_id_uloga` INT NOT NULL,
  `dnevnik_rada_id_dnevnik_rada` INT NOT NULL,
  `ime` VARCHAR(45) NOT NULL,
  `prezime` VARCHAR(45) NOT NULL,
  `korisnicko_ime` VARCHAR(45) NOT NULL,
  `lozinka` VARCHAR(45) NOT NULL,
  `email` TEXT NOT NULL,
  `datum_vrijeme_uvjeta` DATETIME NULL,
  PRIMARY KEY (`id_korisnik`),
  INDEX `fk_korisnik_uloga_idx` (`uloga_korisnika_id_uloga` ASC),
  INDEX `fk_korisnik_dnevnik_rada1_idx` (`dnevnik_rada_id_dnevnik_rada` ASC)  ,
  CONSTRAINT `fk_korisnik_uloga`
    FOREIGN KEY (`uloga_korisnika_id_uloga`)
    REFERENCES `SoftwareLL`.`uloga_korisnika` (`id_uloga`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_korisnik_dnevnik_rada1`
    FOREIGN KEY (`dnevnik_rada_id_dnevnik_rada`)
    REFERENCES `SoftwareLL`.`dnevnik_rada` (`id_dnevnik_rada`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SoftwareLL`.`kategorije_licenca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SoftwareLL`.`kategorije_licenca` (
  `id_kategorije_licenca` INT NOT NULL AUTO_INCREMENT,
  `naziv_kategorije` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_kategorije_licenca`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SoftwareLL`.`zahtjev_odobrenje`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SoftwareLL`.`zahtjev_odobrenje` (
  `id_zahtjev_odobrenje` INT NOT NULL AUTO_INCREMENT,
  `status_zahtjeva` CHAR NOT NULL,
  `datum_odobrenja_odbijanja` DATETIME NOT NULL,
  PRIMARY KEY (`id_zahtjev_odobrenje`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SoftwareLL`.`licence`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SoftwareLL`.`licence` (
  `id_licence` INT NOT NULL AUTO_INCREMENT,
  `kategorije_licenca_id_kategorije_licenca` INT NOT NULL,
  `zahtjev_odobrenje_id_zahtjev_odobrenje` INT NOT NULL,
  `naziv` VARCHAR(45) NOT NULL,
  `slika_licence` VARCHAR(45) NULL,
  `kolicina` INT NOT NULL,
  `iznos` DECIMAL NOT NULL,
  `datum_stvaranja` DATE NOT NULL,
  `datum_isteka` DATE NOT NULL,
  PRIMARY KEY (`id_licence`),
  INDEX `fk_licence_kategorije_licenca1_idx` (`kategorije_licenca_id_kategorije_licenca` ASC)  ,
  INDEX `fk_licence_zahtjev_odobrenje1_idx` (`zahtjev_odobrenje_id_zahtjev_odobrenje` ASC)  ,
  CONSTRAINT `fk_licence_kategorije_licenca1`
    FOREIGN KEY (`kategorije_licenca_id_kategorije_licenca`)
    REFERENCES `SoftwareLL`.`kategorije_licenca` (`id_kategorije_licenca`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_licence_zahtjev_odobrenje1`
    FOREIGN KEY (`zahtjev_odobrenje_id_zahtjev_odobrenje`)
    REFERENCES `SoftwareLL`.`zahtjev_odobrenje` (`id_zahtjev_odobrenje`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SoftwareLL`.`korisnik_has_licence`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SoftwareLL`.`korisnik_has_licence` (
  `korisnik_id_korisnik` INT NOT NULL,
  `licence_id_licence` INT NOT NULL,
  INDEX `fk_korisnik_has_licence_licence1_idx` (`licence_id_licence` ASC)  ,
  INDEX `fk_korisnik_has_licence_korisnik1_idx` (`korisnik_id_korisnik` ASC)  ,
  CONSTRAINT `fk_korisnik_has_licence_korisnik1`
    FOREIGN KEY (`korisnik_id_korisnik`)
    REFERENCES `SoftwareLL`.`korisnik` (`id_korisnik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_korisnik_has_licence_licence1`
    FOREIGN KEY (`licence_id_licence`)
    REFERENCES `SoftwareLL`.`licence` (`id_licence`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
