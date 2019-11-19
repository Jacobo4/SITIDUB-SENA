

-- -----------------------------------------------------
-- Schema- -----------------------------------------------------
drop database proyecto;
CREATE SCHEMA IF NOT EXISTS `proyecto` ;
USE proyecto ;

-- -----------------------------------------------------
-- Table `tbl_estrato`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS tbl_estrato (
  `estrato` INT NOT NULL,
  PRIMARY KEY (`estrato`));

-- -----------------------------------------------------
-- Table `proyecto`.`tbl_tipoDocumento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tbl_tipoDocumento` (
  `des_tipoDocumento` VARCHAR(5) NOT NULL,
  PRIMARY KEY (`des_tipoDocumento`));


-- -----------------------------------------------------
-- Table `tbl_observaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tbl_observaciones` (
  `tipoObservacion` VARCHAR(15) NOT NULL,
  `des_observacion` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`tipoObservacion`));


-- -----------------------------------------------------
-- Table `tbl_persona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tbl_persona` (
  `numeroDocumento` VARCHAR(12) NOT NULL,
  `nombre1` VARCHAR(30) NOT NULL,
  `nombre2` VARCHAR(30) NULL DEFAULT NULL,
  `apellido1` VARCHAR(30) NOT NULL,
  `apellido2` VARCHAR(30) NULL DEFAULT NULL,
  `lugarNacimiento` VARCHAR(45) NOT NULL,
  `fechaNacimiento` DATE NOT NULL,
  `direccion` VARCHAR(45) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `pk_fk_tipoDocumento_persona` VARCHAR(5) NOT NULL,
  `fk_observacion_persona` VARCHAR(15) NULL DEFAULT NULL,
  `lugarExpedicion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`numeroDocumento`, `pk_fk_tipoDocumento_persona`),
  CONSTRAINT `fk_tbl_persona_tbl_tipoDocumento1`
    FOREIGN KEY (`pk_fk_tipoDocumento_persona`)
    REFERENCES `tbl_tipoDocumento` (`des_tipoDocumento`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_persona_tbl_observaciones1`
    FOREIGN KEY (`fk_observacion_persona`)
    REFERENCES `tbl_observaciones` (`tipoObservacion`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `tbl_rh`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tbl_rh` (
  `des_rh` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`des_rh`));


-- -----------------------------------------------------
-- Table `tbl_eps`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tbl_eps` (
  `des_eps` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`des_eps`));


-- -----------------------------------------------------
-- Table `tbl_teléfono`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tbl_teléfono` (
  `clase` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`clase`));


-- -----------------------------------------------------
-- Table `tbl_pagoMes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tbl_pagoMes` (
  `numeroComprobante` VARCHAR(30) NOT NULL,
  `formaPago` VARCHAR(15) NOT NULL,
  `fechaPago` DATE NOT NULL,
  `mesCancelado` VARCHAR(30) NOT NULL,
  `responsableColegio` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`numeroComprobante`));


-- -----------------------------------------------------
-- Table `tbl_matricula`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tbl_matricula` (
  `id_matricula` INT NOT NULL AUTO_INCREMENT,
  `curso` INT NOT NULL,
  `fechaInicial` DATE NOT NULL,
  `fechaFinal` DATE NULL DEFAULT NULL,
  `estado` TINYINT NOT NULL,
  `grado` VARCHAR(15) NULL DEFAULT NULL,
  PRIMARY KEY (`id_matricula`));


-- -----------------------------------------------------
-- Table `tbl_estudiante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tbl_estudiante` (
  `fk_id_matricula_estudiante` INT NOT NULL,
  `pk_fk_numeroDocumento_estudiante` VARCHAR(12) NOT NULL,
  `pk_fk_tipoDocumento_estudiante` VARCHAR(5) NOT NULL,
  `fk_eps_estudiante` VARCHAR(30) NOT NULL,
  `fk_rh_estudiante` VARCHAR(50) NOT NULL,
  `fk_estrato_estudiante` INT NOT NULL,
  PRIMARY KEY (`pk_fk_numeroDocumento_estudiante`, `pk_fk_tipoDocumento_estudiante`),
  CONSTRAINT `fk_tbl_estudiante_tbl_matricula1`
    FOREIGN KEY (`fk_id_matricula_estudiante`)
    REFERENCES `tbl_matricula` (`id_matricula`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_estudiante_tbl_persona1`
    FOREIGN KEY (`pk_fk_numeroDocumento_estudiante` , `pk_fk_tipoDocumento_estudiante`)
    REFERENCES `tbl_persona` (`numeroDocumento` , `pk_fk_tipoDocumento_persona`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_estudiante_tbl_eps1`
    FOREIGN KEY (`fk_eps_estudiante`)
    REFERENCES `tbl_eps` (`des_eps`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_estudiante_tbl_rh1`
    FOREIGN KEY (`fk_rh_estudiante`)
    REFERENCES `tbl_rh` (`des_rh`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_estudiante_tbl_estrato1`
    FOREIGN KEY (`fk_estrato_estudiante`)
    REFERENCES `tbl_estrato` (`estrato`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `tbl_responsable`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tbl_responsable` (
  `ocupacion` VARCHAR(35) NOT NULL,
  `profesion` VARCHAR(35) NOT NULL,
  `pk_fk_numeroDocumento_responsable` VARCHAR(12) NOT NULL,
  `pk_fk_tipoDocumento_responsable` VARCHAR(5) NOT NULL,
  PRIMARY KEY (`pk_fk_numeroDocumento_responsable`, `pk_fk_tipoDocumento_responsable`),
  CONSTRAINT `fk_tbl_responsable_tbl_persona1`
    FOREIGN KEY (`pk_fk_numeroDocumento_responsable` , `pk_fk_tipoDocumento_responsable`)
    REFERENCES `tbl_persona` (`numeroDocumento` , `pk_fk_tipoDocumento_persona`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `tbl_matricula_has_tbl_pagoMes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tbl_matricula_has_tbl_pagoMes` (
  `pk_fk_id_matricula` INT NOT NULL,
  `pk_fk_numeroComprobante` VARCHAR(30) NOT NULL,
  `mes` VARCHAR(15) NOT NULL,
  `valorCancelado` FLOAT NOT NULL,
  `saldo` FLOAT NOT NULL,
  PRIMARY KEY (`pk_fk_id_matricula`, `pk_fk_numeroComprobante`),
  CONSTRAINT `fk_tbl_matricula_has_tbl_pagoMes_tbl_matricula1`
    FOREIGN KEY (`pk_fk_id_matricula`)
    REFERENCES `tbl_matricula` (`id_matricula`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_matricula_has_tbl_pagoMes_tbl_pagoMes1`
    FOREIGN KEY (`pk_fk_numeroComprobante`)
    REFERENCES `tbl_pagoMes` (`numeroComprobante`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `tbl_persona_has_tbl_teléfono`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tbl_persona_has_tbl_teléfono` (
  `pk_fk_numeroDocumento` VARCHAR(12) NOT NULL,
  `pk_fk_tipoDocumento` VARCHAR(5) NOT NULL,
  `pk_fk_teléfono_clase` VARCHAR(15) NOT NULL,
  `numero` INT(15) NOT NULL,
  PRIMARY KEY (`pk_fk_numeroDocumento`, `pk_fk_tipoDocumento`, `pk_fk_teléfono_clase`),
  CONSTRAINT `fk_tbl_persona_has_tbl_teléfono_tbl_persona1`
    FOREIGN KEY (`pk_fk_numeroDocumento` , `pk_fk_tipoDocumento`)
    REFERENCES `tbl_persona` (`numeroDocumento` , `pk_fk_tipoDocumento_persona`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_persona_has_tbl_teléfono_tbl_teléfono1`
    FOREIGN KEY (`pk_fk_teléfono_clase`)
    REFERENCES `tbl_teléfono` (`clase`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `tbl_responsable_has_tbl_estudiante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tbl_responsable_has_tbl_estudiante` (
  `tbl_responsable_pk_fk_numeroDocumento_responsable` VARCHAR(12) NOT NULL,
  `tbl_responsable_pk_fk_tipoDocumento_responsable` VARCHAR(5) NOT NULL,
  `tbl_estudiante_pk_fk_numeroDocumento_estudiante` VARCHAR(12) NOT NULL,
  `tbl_estudiante_pk_fk_tipoDocumento_estudiante` VARCHAR(5) NOT NULL,
  `parentesco` VARCHAR(35) NOT NULL,
  PRIMARY KEY (`tbl_responsable_pk_fk_numeroDocumento_responsable`, `tbl_responsable_pk_fk_tipoDocumento_responsable`, `tbl_estudiante_pk_fk_numeroDocumento_estudiante`, `tbl_estudiante_pk_fk_tipoDocumento_estudiante`),
  CONSTRAINT `fk_tbl_responsable_has_tbl_estudiante_tbl_responsable1`
    FOREIGN KEY (`tbl_responsable_pk_fk_numeroDocumento_responsable` , `tbl_responsable_pk_fk_tipoDocumento_responsable`)
    REFERENCES `tbl_responsable` (`pk_fk_numeroDocumento_responsable` , `pk_fk_tipoDocumento_responsable`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_responsable_has_tbl_estudiante_tbl_estudiante1`
    FOREIGN KEY (`tbl_estudiante_pk_fk_numeroDocumento_estudiante` , `tbl_estudiante_pk_fk_tipoDocumento_estudiante`)
    REFERENCES `tbl_estudiante` (`pk_fk_numeroDocumento_estudiante` , `pk_fk_tipoDocumento_estudiante`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


    INSERT INTO tbl_tipodocumento (des_tipoDocumento) VALUES
    ("CC"),
    ("TI"),
    ("CE");

    INSERT INTO tbl_persona (numeroDocumento,nombre1,nombre2,apellido1,apellido2,lugarNacimiento,fechaNacimiento,direccion,email,pk_fk_tipoDocumento_persona,fk_observacion_persona,lugarExpedicion) VALUES

    ('d1', 'Juan', 'Jacobo', 'Izquierdo', 'Becerra', 'Bogotá', '2001-03-28', 'Calle A', 'juanjacobo@gmail.com', 'CC',null,'Bogotá'),
    ('d2', 'Camila', null, 'Camacho', 'Nonsoque', 'Bogotá', '2001-08-18', 'Calle B', 'camila@gmail.com', 'CC',null,'Bogotá'),
    ('d3', 'Aracely', null, 'Marentes', 'Becerra', 'Bogotá', '1994-04-30', 'Calle C', 'aracely@gmail.com', 'CC',null,'Bogotá'),

    ('d4', 'Sergio', null, 'Medina', 'Becerra', 'Cali', '2006-05-16', 'Avenida A', 'sergio@gmail.com', 'TI',null,'Cali'),
    ('d5', 'Alejandro', null, 'Medina', 'Becerra', 'Cali', '2005-05-24', 'Avenida A', 'alejandro@gmail.com', 'TI',null,'Cali'),
    ('d6', 'Nicol', null, 'Camacho', 'Nonsoque', 'Cali', '2004-05-16', 'Avenida B', 'nicol@gmail.com', 'TI',null,'Cali'),
    ('d7', 'Monica', 'Camila', 'Camacho', 'Nonsoque', 'Cali', '2006-03-20', 'Avenida A', 'monica@gmail.com', 'TI',null,'Cali'),
    ('d8', 'Sergio', null, 'Lopez', 'Guio', 'Cali', '2001-10-28', 'Carrera A', 'guio@gmail.com', 'TI',null,'Cali'),
    ('d9', 'Sebastian', null, 'Vasquez', 'Uribe', 'Cali', '2002-01-15', 'Carrera A', 'vasquez@gmail.com', 'TI',null,'Cali'),
    ('d10', 'Mauricio', 'German', 'Real', 'Becerra', 'Cali', '1996-05-16', 'Avenida A', 'sergio@gmail.com', 'TI',null,'Cali');

INSERT INTO tbl_matricula(id_matricula,curso,fechaInicial,fechaFinal,estado,grado) VALUES
(1, 602, '2018-02-24', null, 1, null),
(2, 801, '2018-02-24', null, 1, null),
(3, 903, '2018-02-24', null, 1, null),
(4, 502, '2018-02-24', null, 1, null),
(5, 1004, '2018-02-24', null, 1, null),
(6, 502, '2018-02-24', null, 1, null),
(7, 602, '2018-02-24', null, 1, null);

INSERT INTO tbl_estrato (estrato) VALUES
(1),
(2),
(3),
(4),
(5);

INSERT INTO tbl_eps (des_eps) VALUES
('Compensar'),
('Sanitas'),
('Otro');

INSERT INTO tbl_rh (des_rh) VALUES
('O+'),
('O-'),
('A+');

INSERT INTO tbl_estudiante (fk_id_matricula_estudiante, pk_fk_numeroDocumento_estudiante,pk_fk_tipoDocumento_estudiante,fk_eps_estudiante, fk_rh_estudiante, fk_estrato_estudiante) VALUES
(1, 'd4', 'TI', 'Compensar', 'O+', 3),
(2, 'd5', 'TI', 'Sanitas', 'O-', 2),
(3, 'd6', 'TI', 'Compensar', 'O+', 4),
(4, 'd7', 'TI', 'Sanitas', 'O-', 1),
(5, 'd8', 'TI', 'Compensar', 'O+', 4),
(6, 'd9', 'TI', 'Sanitas', 'O-', 3),
(7, 'd10', 'TI', 'Sanitas', 'O+', 5);

INSERT INTO tbl_responsable (ocupacion, profesion, pk_fk_numeroDocumento_responsable, pk_fk_tipoDocumento_responsable) VALUES
('Lechero', 'Ingeniero', 'd1', 'CC'),
('Mama luchona', 'Ingeniera', 'd2', 'CC'),
('Estudiante', 'Administradora', 'd3', 'CC');

INSERT INTO tbl_responsable_has_tbl_estudiante (tbl_responsable_pk_fk_numeroDocumento_responsable, tbl_responsable_pk_fk_tipoDocumento_responsable, tbl_estudiante_pk_fk_numeroDocumento_estudiante, tbl_estudiante_pk_fk_tipoDocumento_estudiante, parentesco) VALUES
('d1', 'CC', 'd4', 'TI', 'hermano'),
('d1', 'CC', 'd5', 'TI', 'papá'),

('d2', 'CC', 'd6', 'TI', 'hermana'),
('d2', 'CC', 'd7', 'TI', 'mamá'),

('d3', 'CC', 'd8', 'TI', 'mamá'),
('d3', 'CC', 'd9', 'TI', 'mamá'),
('d3', 'CC', 'd10', 'TI', 'mamá');



select tbl_responsable_pk_fk_numeroDocumento_responsable AS numeroDocumento_responsable,parentesco,tbl_estudiante_pk_fk_numeroDocumento_estudiante as numeroDocumento_estudiante,nombre1,nombre2,apellido1,apellido2
  FROM tbl_responsable_has_tbl_estudiante
  INNER JOIN tbl_estudiante on tbl_estudiante_pk_fk_numeroDocumento_estudiante = pk_fk_numeroDocumento_estudiante
  INNER JOIN tbl_persona on pk_fk_numeroDocumento_estudiante = numeroDocumento;
