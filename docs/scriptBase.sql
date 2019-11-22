-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema proyecto
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `proyecto` ;
USE `proyecto` ;

-- -----------------------------------------------------
-- Table `proyecto`.`tipos_documentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyecto`.`tipos_documentos` (
  `des_tipoDocumento` VARCHAR(5) NOT NULL,
  PRIMARY KEY (`des_tipoDocumento`));


-- -----------------------------------------------------
-- Table `proyecto`.`observaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyecto`.`observaciones` (
  `tipo_observacion` VARCHAR(15) NOT NULL,
  `des_observacion` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`tipo_observacion`));


-- -----------------------------------------------------
-- Table `proyecto`.`eps`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyecto`.`eps` (
  `des_eps` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`des_eps`));


-- -----------------------------------------------------
-- Table `proyecto`.`personas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyecto`.`personas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ndoc` VARCHAR(12) NOT NULL,
  `tdoc_persona` VARCHAR(5) NOT NULL,
  `tipo_persona` VARCHAR(45) NOT NULL,
  `nombre1` VARCHAR(30) NOT NULL,
  `nombre2` VARCHAR(30) NULL DEFAULT NULL,
  `apellido1` VARCHAR(30) NOT NULL,
  `apellido2` VARCHAR(30) NULL DEFAULT NULL,
  `lugar_expedicion` VARCHAR(45) NOT NULL,
  `lugar_nacimiento` VARCHAR(45) NOT NULL,
  `fecha_nacimiento` DATE NOT NULL,
  `direccion` VARCHAR(45) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `observacion_persona` VARCHAR(15) NULL DEFAULT NULL,
  `tel1` TINYINT(12) NOT NULL,
  `tel2` TINYINT(12) NULL,
  `tel3` TINYINT(12) NULL,
  `ocupacion` VARCHAR(35) NOT NULL,
  `profesion` VARCHAR(35) NOT NULL,
  `rh` VARCHAR(5) NOT NULL,
  `estrato` INT NOT NULL,
  `eps_des_eps` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tbl_persona_tbl_tipoDocumento1` (`tdoc_persona` ASC) VISIBLE,
  INDEX `fk_tbl_persona_tbl_observaciones1` (`observacion_persona` ASC) VISIBLE,
  INDEX `fk_personas_eps1_idx` (`eps_des_eps` ASC) VISIBLE,
  UNIQUE INDEX `ndoc_UNIQUE` (`ndoc` ASC) VISIBLE,
  UNIQUE INDEX `tdoc_persona_UNIQUE` (`tdoc_persona` ASC) VISIBLE,
  CONSTRAINT `fk_tbl_persona_tbl_tipoDocumento1`
    FOREIGN KEY (`tdoc_persona`)
    REFERENCES `proyecto`.`tipos_documentos` (`des_tipoDocumento`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_persona_tbl_observaciones1`
    FOREIGN KEY (`observacion_persona`)
    REFERENCES `proyecto`.`observaciones` (`tipo_observacion`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_personas_eps1`
    FOREIGN KEY (`eps_des_eps`)
    REFERENCES `proyecto`.`eps` (`des_eps`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `proyecto`.`matriculas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyecto`.`matriculas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fecha_inicial` DATE NOT NULL,
  `fecha_final` DATE NULL DEFAULT NULL,
  `estado` TINYINT NOT NULL,
  `grado` VARCHAR(15) NULL DEFAULT NULL,
  `personas_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_matriculas_personas1_idx` (`personas_id` ASC) VISIBLE,
  CONSTRAINT `fk_matriculas_personas1`
    FOREIGN KEY (`personas_id`)
    REFERENCES `proyecto`.`personas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `proyecto`.`cuotas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyecto`.`cuotas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `mes` VARCHAR(15) NOT NULL,
  `valor` FLOAT NOT NULL,
  `saldo` FLOAT NOT NULL,
  `id_matricula` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_cuotas_matriculas1_idx` (`id_matricula` ASC) VISIBLE,
  CONSTRAINT `fk_cuotas_matriculas1`
    FOREIGN KEY (`id_matricula`)
    REFERENCES `proyecto`.`matriculas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `proyecto`.`pagos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyecto`.`pagos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `consecutivo` VARCHAR(30) NOT NULL,
  `fecha_pago` DATE NOT NULL,
  `periodo_inicial` DATE NOT NULL,
  `periodo_final` DATE NOT NULL,
  `rector` VARCHAR(30) NOT NULL,
  `id_cuota` INT NOT NULL,
  PRIMARY KEY (`id`, `consecutivo`),
  INDEX `fk_pagos_cuotas1_idx` (`id_cuota` ASC) VISIBLE,
  CONSTRAINT `fk_pagos_cuotas1`
    FOREIGN KEY (`id_cuota`)
    REFERENCES `proyecto`.`cuotas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `proyecto`.`parentescos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyecto`.`parentescos` (
  `parentesco` VARCHAR(35) NOT NULL,
  `id_estudiante` INT NOT NULL,
  `id_acudiente` INT NOT NULL,
  PRIMARY KEY (`id_estudiante`, `id_acudiente`),
  INDEX `fk_parentescos_personas2_idx` (`id_acudiente` ASC) VISIBLE,
  CONSTRAINT `fk_parentescos_personas1`
    FOREIGN KEY (`id_estudiante`)
    REFERENCES `proyecto`.`personas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_parentescos_personas2`
    FOREIGN KEY (`id_acudiente`)
    REFERENCES `proyecto`.`personas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
