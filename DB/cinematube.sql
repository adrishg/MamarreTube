CREATE DATABASE cinematube;
USE cinematube;

CREATE TABLE usuarios(USUARIO_TYPE INT(1),USUARIO_CORREO VARCHAR(30),USUARIO_NOMBRE VARCHAR(20),USUARIO_PATERNO VARCHAR(15),USUARIO_MATERNO VARCHAR(15),USUARIO_CONTRASENIA VARCHAR(25),FECHA_REGISTRO DATE, PRIMARY KEY (USUARIO_CORREO));

CREATE TABLE pelicula(ID_PELICULA INT(7) NOT NULL AUTO_INCREMENT, NOMBRE_PELICULA VARCHAR(25), PORTADA_PELICULA MEDIUMBLOB, ANIO_PELICULA INT(4), DIRECTOR_PELICULA VARCHAR(25), DESCRIPCÏON_PELICULA VARCHAR(450), VISIBILIDAD_PELICULA BOOLEAN, PRIMARY KEY(ID_PELICULA));