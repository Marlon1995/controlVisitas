CREATE DATABASE control_personas;

USE control_personas;

CREATE TABLE Roles (
idRol int primary key,
Rol varchar(50) not null
);

CREATE TABLE Users (
  id int AUTO_INCREMENT Primary Key,
  name varchar(191) NOT NULL,
  email varchar(191) NOT NULL,
  email_verified_at timestamp NULL DEFAULT NULL,
  UserName varchar(150)not null,
  password varchar(191) NOT NULL,
  remember_token varchar(100),
  Estado boolean default 1,
  created_at datetime null,
  updated_at datetime null
);

create table Permisos(
idPermiso int AUTO_INCREMENT primary key,
idRol int null,
idUsuario int null,
Estado boolean default 1,
Creacion datetime default current_timestamp,
Modificacion datetime default current_timestamp,
foreign key (idUsuario)references Users(id),
foreign key (idRol)references Roles(idRol)
);

insert into Users(name,email,UserName,password)values('Super Admin','pruebascrosoft@gmail.com','pruebascrosoft@gmail.com','$2y$10$Vv2hhMuhJ3EIRWs0tRz4Huz2.8.EBPk307hgpGznoL.LWEUgH7/re');
insert into Roles(idRol,Rol)values(1,'Super Admin'),(2,'Usuario'),(3,'Encargado Edificio'),(4,'Encargado Organización'),(5,'Encargado Puerta'),(6,'Administrador');
insert into Permisos(idRol,idUsuario) values(1,1),(6,1),(3,1),(4,1),(5,1),(2,1);

create table Personas(
  idPersona int AUTO_INCREMENT Primary Key,
  Nombres varchar(255) NOT NULL,
  Cedula varchar (10) not null,
  Foto  text null,
  Sexo varchar(50) null default 'M',
  Direccion varchar (500) null,
  Estado boolean default 1,
  Creacion datetime default current_timestamp,
  Modificacion datetime default current_timestamp
);

create table Edificios(
  idEdificio int AUTO_INCREMENT Primary Key,
  Nombre varchar(50) NOT NULL,
  Estado boolean default 1,
  Creacion datetime default current_timestamp,
  Modificacion datetime default current_timestamp
  );

create table AsignacionEdificio(
  idAsignacionEdificio int AUTO_INCREMENT Primary Key,
  idUsuario int null,
  idEdificio int null,
  Estado boolean default 1,
  Creacion datetime default current_timestamp,
  Modificacion datetime default current_timestamp,
  foreign key (idUsuario)references Users(id),
  foreign key (idEdificio)references Edificios(idEdificio)
);

create table DuenoEdificio(
  idDuenoEdificio int AUTO_INCREMENT Primary Key,
  idUsuario int null,
  idEdificio int null,
  Estado boolean default 1,
  Creacion datetime default current_timestamp,
  Modificacion datetime default current_timestamp,
  foreign key (idUsuario)references Users(id),
  foreign key (idEdificio)references Edificios(idEdificio)
);

create table Impresoras(
  idImpresora int AUTO_INCREMENT Primary Key,
  Nombre varchar(50) not null,
  Descripcion varchar(50),
  Estado boolean default 1,
  Creacion datetime default current_timestamp,
  Modificacion datetime default current_timestamp
);


create table Pisos(
  idPiso int AUTO_INCREMENT Primary Key,
  Nombre varchar(50) NOT NULL,
  idEdificio int null,
  idImpresora int null,
  Estado boolean default 1,
  Creacion datetime default current_timestamp,
  Modificacion datetime default current_timestamp,
  foreign key (idEdificio)references Edificios(idEdificio),
  foreign key (idImpresora)references Impresoras(idImpresora)
);

create table Organizaciones(
  idOrganizacion int AUTO_INCREMENT Primary Key,
  idPiso int null,
  idUsuario int null,
  Nombre varchar(50) NOT NULL,
  NombreEncargado varchar (50) not null,
  Estado boolean default 1,
  Creacion datetime default current_timestamp,
  Modificacion datetime default current_timestamp,
  foreign key (idUsuario)references Users(id),
  foreign key (idPiso)references Pisos(idPiso)
);

-- USE control_personas;
-- ALTER TABLE Organizaciones ADD  NombreEncargado VARCHAR (50) NOT NULL;
-- ALTER DATABASE control_personas COLLATE=latin1_general_ci;

create table Visitas(
  idVisita int AUTO_INCREMENT Primary Key,
  idEdificio int null,
  Fecha date not null,
  foreign key (idEdificio)references Edificios(idEdificio)
);

create table Accesos(
  idAcceso int AUTO_INCREMENT Primary Key,
  idVisita int null,
  idPersona int null,
  idOrganizacion int null,
  idUsuario int null ,
  CodigoTarjeta varchar(500) not null,
  Estado boolean default 1,
  Creacion datetime default current_timestamp,
  Modificacion datetime default current_timestamp,
  foreign key (idVisita)references Visitas(idVisita),
  foreign key (idPersona)references Personas(idPersona),
  foreign key (idUsuario) references Users(id),
  foreign key (idOrganizacion)references Organizaciones(idOrganizacion)
);

CREATE TABLE migrations(
  id int AUTO_INCREMENT Primary Key,
  migration varchar(255) NOT NULL,
  batch int NOT NULL
);

CREATE TABLE password_resets (
  email varchar(191) NOT NULL,
  token varchar(191)  NOT NULL,
  created_at timestamp NULL DEFAULT NULL
);

create table Auditorias(
id integer primary key auto_increment,
idUsuario integer null,
Accion varchar(1000) not null,
Creacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
foreign key (idUsuario)references Users(id)
);

create table Configuraciones(
idConfiguracion integer primary key auto_increment,
Nombre varchar(50) not null,
Data1 varchar(50) null,
Data2 varchar(50) null,
Data3 varchar(50) null,
Data4 varchar(50) null,
Data5 varchar(50) null,
Data6 varchar(50) null,
Data7 varchar(50) null,
Data8 varchar(50) null,
Data9 varchar(50) null,
Data10 varchar(50) null,
Creacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE pisos DROP INDEX idImpresora;
ALTER TABLE pisos DROP FOREIGN KEY idImpresora;
ALTER TABLE Pisos DROP idImpresora;

ALTER TABLE Users ADD idImpresora int null;
alter table Users ADD FOREIGN KEY (idImpresora)references Impresoras(idImpresora);
