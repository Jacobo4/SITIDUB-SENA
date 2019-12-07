
-- -----------------------------------------------------
-- -- -- Schema -- -----------------------------------------------------
drop database if exists proyecto;
CREATE SCHEMA IF NOT EXISTS proyecto;
USE proyecto;

-- -----------------------------------------------------
-- Table rol
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS rol (
  id INT NOT NULL AUTO_INCREMENT,
  desc_rol VARCHAR(45) NOT NULL,
  PRIMARY KEY (id));


-- -----------------------------------------------------
-- Table users
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS users (
  id INT NOT NULL AUTO_INCREMENT,
  id_rol INT NOT NULL,
  username VARCHAR(30) NOT NULL,
  password VARCHAR(30) NOT NULL,
  palabra_seguridad VARCHAR(30) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX username_UNIQUE (username ASC),
  CONSTRAINT fk_users_rol
    FOREIGN KEY (id_rol)
    REFERENCES rol (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table tipos_documentos
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS tipos_documentos (
  id INT NOT NULL AUTO_INCREMENT,
  descripcion_tdoc VARCHAR(5) NOT NULL,
  PRIMARY KEY (id));


-- -----------------------------------------------------
-- Table observaciones
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS observaciones (
  id INT NOT NULL AUTO_INCREMENT,
  des_observacion VARCHAR(200) NOT NULL,
  PRIMARY KEY (id));



CREATE TABLE IF NOT EXISTS personas (
  id INT NOT NULL AUTO_INCREMENT,
  ndoc VARCHAR(12) NOT NULL,
  tdoc_persona INT NOT NULL,
  tipo_persona VARCHAR(45) NOT NULL,
  nombre1 VARCHAR(30) NOT NULL,
  nombre2 VARCHAR(30) NULL DEFAULT NULL,
  apellido1 VARCHAR(30) NOT NULL,
  apellido2 VARCHAR(30) NULL DEFAULT NULL,
  lugar_expedicion VARCHAR(45) NULL DEFAULT NULL,
  lugar_nacimiento VARCHAR(45) NULL DEFAULT NULL,
  fecha_nacimiento DATE NULL DEFAULT NULL,
  direccion VARCHAR(45) NOT NULL,
  email VARCHAR(50) NOT NULL,
  id_observacion INT NULL DEFAULT NULL,
  tel1 VARCHAR(12) NOT NULL,
  tel2 VARCHAR(12) NULL DEFAULT NULL,
  tel3 VARCHAR(12) NULL DEFAULT NULL,
  ocupacion VARCHAR(35) NULL DEFAULT NULL,
  profesion VARCHAR(35) NULL DEFAULT NULL,
  rh VARCHAR(5) NULL DEFAULT NULL,
  estrato INT NULL DEFAULT NULL,
  eps VARCHAR(30) NULL DEFAULT NULL,
  PRIMARY KEY (id),
    UNIQUE INDEX ndoc_tdoc_UNIQUE (ndoc, tdoc_persona ASC),
  CONSTRAINT fk_tbl_persona_tbl_observaciones1
    FOREIGN KEY (id_observacion)
    REFERENCES observaciones (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_personas_tipos_documentos1
    FOREIGN KEY (tdoc_persona)
    REFERENCES tipos_documentos (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE);

-- -----------------------------------------------------
-- Table matriculas
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS matriculas (
  id INT NOT NULL AUTO_INCREMENT,
  descripcion_matricula VARCHAR(12) NOT NULL,
  fecha_inicial DATE NOT NULL,
  fecha_final DATE NULL DEFAULT NULL,
  estado TINYINT NOT NULL,
  grado VARCHAR(15) NULL DEFAULT NULL,
  id_persona INT NOT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX descripcion_matriculas_UNIQUE (descripcion_matricula ASC),
  CONSTRAINT fk_matriculas_personas1
    FOREIGN KEY (id_persona)
    REFERENCES personas (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table cuotas
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS cuotas (
  id INT NOT NULL AUTO_INCREMENT,
  mes VARCHAR(15) NOT NULL,
  valor FLOAT NOT NULL,
  saldo FLOAT NOT NULL,
  id_matricula INT NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT fk_cuotas_matriculas1
    FOREIGN KEY (id_matricula)
    REFERENCES matriculas (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table pagos
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS pagos (
  id INT NOT NULL AUTO_INCREMENT,
  consecutivo VARCHAR(30) NOT NULL,
  fecha_pago DATE NOT NULL,
  periodo_inicial DATE NOT NULL,
  periodo_final DATE NOT NULL,
  valor_cancelado FLOAT NOT NULL,
  rector VARCHAR(30) NOT NULL,
  id_cuota INT NOT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX consecutivo_UNIQUE (consecutivo ASC),
  CONSTRAINT fk_pagos_cuotas1
    FOREIGN KEY (id_cuota)
    REFERENCES cuotas (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table parentescos
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS parentescos (
  parentesco VARCHAR(35) NOT NULL,
  id_estudiante INT NOT NULL,
  id_acudiente INT NOT NULL,
  PRIMARY KEY (id_estudiante, id_acudiente),
  CONSTRAINT fk_parentescos_personas1
    FOREIGN KEY (id_estudiante)
    REFERENCES personas (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_parentescos_personas2
    FOREIGN KEY (id_acudiente)
    REFERENCES personas (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE);



INSERT INTO rol (id, desc_rol) VALUES
(null, 'Administrador'),
(null, 'Tesorero'),
(null, 'Coordinador');

INSERT INTO users (id,id_rol, username, password, palabra_seguridad) VALUES
(null,'1','wilmer', 'admin123', 'oso'),
(null,'2','juanjacobo', 'teso123', 'oso'),
(null,'3','alvaro', 'coor123', 'oso');

INSERT INTO tipos_documentos (id,descripcion_tdoc) VALUES
(null,'TI'),
(null,'CC'),
(null,'CE');


INSERT INTO personas (id, ndoc, tdoc_persona, tipo_persona, nombre1, nombre2, apellido1, apellido2, lugar_expedicion, lugar_nacimiento, fecha_nacimiento, direccion, email, id_observacion, tel1, tel2, tel3, ocupacion, profesion, rh, estrato, eps) VALUES
(null, '1001097692', '1', 'estudiante', 'Juan', 'Jacobo', 'Izquierdo', 'Becerra', 'Bogotá', 'Bogotá', '2001-03-28', 'Calle A', 'jacobo@gmail.com', null, 3058194685, 313202902, null, null, null, 'O+', '3', 'Compensar'),
(null, '1001097693', '1', 'estudiante', 'Camila', null, 'Izquierdo', 'Camacho', 'Bogotá', 'Bogotá', '2001-07-18', 'Calle A', 'camila@gmail.com', null, 369874521, null, null, null, null, 'A+', '3', 'Sanitas'),
(null, '3546976', '2', 'responsable', 'Adelaida', null, 'Becerra', 'Cano', 'Bogotá', 'Bogotá', '1956-03-28', 'Calle A', 'adeliada@gmail.com', null, 3154207893, null, null, null, null, 'O-', '3', 'Compensar'),
(null, '1001097692', '3', 'estudiante', 'Juan', 'Jacobo', 'Izquierdo', 'Becerra', 'Bogotá', 'Bogotá', '2001-03-28', 'Calle A', 'jacobo@gmail.com', null, 3058194685, 313202902, null, null, null, 'O+', '3', 'Compensar');


INSERT INTO parentescos (parentesco, id_estudiante, id_acudiente) VALUES
('mama', '1', '3'),
('tia', '2', '3');


INSERT INTO matriculas (id, descripcion_matricula, fecha_inicial, fecha_final, estado, grado, id_persona) VALUES
(null, 'ESTU-1','2018-02-24', null, '1', 'octavo', '1'),
(null, 'ESTU-2','2018-02-24', null, '1', 'septimo', '2');


INSERT INTO cuotas (id, mes, valor, saldo, id_matricula) VALUES
(null, 'febrero', '500000', '500000', '1'),
(null, 'marzo', '300000', '300000', '1'),
(null, 'abril', '300000', '300000', '1'),
(null, 'mayo', '300000', '300000', '1'),
(null, 'junio', '300000', '300000', '1'),
(null, 'julio', '300000', '300000', '1'),
(null, 'agosto', '300000', '300000', '1'),
(null, 'septiembre', '300000', '300000', '1'),
(null, 'octubre', '300000', '300000', '1'),
(null, 'noviembre', '300000', '300000', '1'),

(null, 'febrero', '500000', '500000', '2'),
(null, 'marzo', '300000', '300000', '2'),
(null, 'abril', '300000', '300000', '2'),
(null, 'mayo', '300000', '300000', '2'),
(null, 'junio', '300000', '300000', '2'),
(null, 'julio', '300000', '300000', '2'),
(null, 'agosto', '300000', '300000', '2'),
(null, 'septiembre', '300000', '300000', '2'),
(null, 'octubre', '300000', '300000', '2'),
(null, 'noviembre', '300000', '300000', '2');


INSERT INTO pagos (id, consecutivo, fecha_pago, periodo_inicial, periodo_final, valor_cancelado, rector, id_cuota) VALUES
(null, '1234', '2018-03-02', '2018-02-02', '2018-03-02', '300000', 'Pereson', '1'),
(null, '12345', '2018-03-05', '2018-02-02', '2018-03-02', '200000', 'Pereson', '1'),
(null, '45645', '2018-04-02', '2018-02-02', '2018-03-02', '500000', 'Pereson', '11'),
(null, '12312', '2018-04-02', '2018-03-02', '2018-04-02', '300000', 'Pereson', '12');
