create database sitidob1;
  use sitidob1;

create table tbl_personas
(
   numeroDocumento varchar (12) not null,
   nombre1 varchar (30) not null,
   nombre2 varchar (30),
   apellido1 varchar (30) not null,
   apellido2 varchar (30),
   lugarNacimiento varchar (45) not null,
   fechaNacimiento date not null,
   direccion varchar (45) not null,
   email varchar (50) not null,
   pk_fk_tbl_tipoDocumento_des_tipoDocumento varchar (5),
   fk_tbl_observaciones_tipoObservacion varchar (15) not null,
   primary key (numeroDocumento,pk_fk_tbl_tipoDocumento_des_tipoDocumento)
);

alter table tbl_personas
add constraint const_desTipoDoc_tbl_Personas
foreign key (pk_fk_tbl_tipoDocumento_des_tipoDocumento) references tbl_tipoDocumento(des_tipoDocumento);

alter table tbl_personas
add foreign key(fk_tbl_observaciones_tipoObservacion) references tbl_observaciones(tipoObservacion);

create table tbl_persona_has_tbl_telefono
(
    pk_fk_tbl_persona_numeroDocumento varchar (12),
    pk_fk_tbl_persona_tbl_tipoDocumento_des_tipoDocumento varchar (5),
    pk_fk_tbl_telefono_clase varchar (15),
    numero int (5) not null,
    primary key (pk_fk_tbl_persona_numeroDocumento,pk_fk_tbl_persona_tbl_tipoDocumento_des_tipoDocumento,pk_fk_tbl_telefono_clase)
);

alter table tbl_persona_has_tbl_telefono
add constraint const_numeroDocumento_tbl_persona_has_tbl_telefono
foreign key (pk_fk_tbl_persona_numeroDocumento) references tbl_personas(numeroDocumento);

alter table tbl_persona_has_tbl_telefono
add constraint const_desTipoDoc_tbl_persona_has_tbl_telefono
foreign key (pk_fk_tbl_persona_tbl_tipoDocumento_des_tipoDocumento) references tbl_personas(pk_fk_tbl_tipoDocumento_des_tipoDocumento);

alter table tbl_persona_has_tbl_telefono
add constraint const_clase_tbl_persona_has_tbl_telefono
foreign key (pk_fk_tbl_telefono_clase) references tbl_telefono(tel_clase);


create table tbl_tipoDocumento
(
    des_tipoDocumento varchar (5) not null,
    lugarExpedicion varchar (45) not null,
    primary key (des_tipoDocumento)
);

create table tbl_observaciones
(
    tipoObservacion varchar (15) not null,
    des_observacion varchar (200) not null,
    primary key (tipoObservacion)
);


create table tbl_telefono
(
    tel_clase varchar (15) not null,
    primary key (tel_clase)
);




create table tbl_estudiante
(
    fk_tbl_matricula_id_matricula int not null,
    pk_fk_tbl_persona_numeroDocumento varchar (12) not null ,
    pk_fk_tbl_persona_numeroDocumento_des_tipoDocumento varchar (5) not null,
    fk_tbl_eps_des_eps varchar (30) not null,
    fk_tbl_rh_des_rh varchar (50) not null,
    primary key (pk_fk_tbl_persona_numeroDocumento,pk_fk_tbl_persona_numeroDocumento_des_tipoDocumento)
);

alter table tbl_estudiante
add foreign key(fk_tbl_eps_des_eps) references tbl_eps(des_eps);

alter table tbl_estudiante
add foreign key(fk_tbl_rh_des_rh) references tbl_rh(des_rh);

alter table tbl_estudiante
add foreign key(fk_tbl_matricula_id_matricula) references tbl_matricula(id_matricula);

alter table tbl_estudiante
add constraint const_numeroDocumento_tbl_persona
foreign key (pk_fk_tbl_persona_numeroDocumento) references tbl_personas(numeroDocumento);

alter table tbl_estudiante
add constraint const_tipoDocumento_tbl_persona
foreign key (pk_fk_tbl_persona_numeroDocumento_des_tipoDocumento) references tbl_personas(pk_fk_tbl_tipoDocumento_des_tipoDocumento);

create table tbl_eps
(
    des_eps varchar (30) not null,
    estrato int not null,
    primary key (des_eps)
);

create table tbl_rh(
    des_rh varchar (5) not null,
    primary key (des_rh)
);

create table tbl_matricula
(
    id_matricula int not null,
    curso int not null,
    fechaInicial date not null,
    fechaFinal date,
    estado tinyint not null,
    grado varchar (15),
    primary key (id_matricula)
);
--


--
-- create table tbl_responsable
-- (
--     ocupacion varchar (35) not null,
--     profesion varchar (35) not null,
--     tbl_persona_tbl_tipoDocumento_des_tipoDocumento varchar (5),
--     tbl_parentesco_des_parentesco varchar (30)
-- );
--
-- create table tbl_parentesco
-- (
--     des_parentesco varchar (30) not null,
--     primary key (des_parentesco)
-- );
--

--
-- create table tbl_matricula_id_matricula
-- (
--     id_matricula int not null,
--     curso int not null,
--     fechaInicial date not null,
--     fechaFinal date,
--     estado tinyint not null,
--     grado varchar (15)
--     primary key (id_matricula)
-- );
--

--
-- create table tbl_pagoMes
-- (
--     numeroComprobante varchar (30) not null,
--     formaPago varchar (15) not null,
--     fechaPago date not null,
--     mesCancelado varchar (15) not null,
--     responsableColegio varchar (30) not null,
--     primary key (numeroComprobante)
-- );
--
-- create table tbl_matricula_has_tbl_pagoMes
-- (
--     tbl_matricula_id_matricula int,
--     tbl_pagoMes_numeroComprobante varchar (30),
--     mes varchar (15) not null,
--     valorCancelado float not null,
--     saldo float
-- );
