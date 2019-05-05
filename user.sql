CREATE DATABASE app;

USE app;

CREATE TABLE usuarios
(
    id               MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre           CHAR(100),
    apellidos        CHAR(100),
    fecha_nacimiento DATE,
    email            CHAR(100),
    nif              CHAR(9),
    direccion        CHAR(200),
    provincia        CHAR(30),
    cp               CHAR(5),
    telefono         CHAR(20),
    sexo             CHAR(10)
);

GRANT ALL ON app.* to webadmin@localhost IDENTIFIED BY '1234';