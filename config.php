<?php   
    // database values
    $dbhost="127.0.0.1";
    $dbname='escola';
    $dbuser='escoles';
    $dbpass='marc';
    $driver='mysql';
    $dsn=$driver.':host='.$dbhost.';dbname='.$dbname.';';
    

    //"userdaw1", "M3phpdaw@"
    //CREATE DATABASE IF NOT EXISTS escola;
    //CREATE USER 'escoles'@'localhost' IDENTIFIED BY 'marc';

    //GRANT ALL PRIVILEGES ON escola.* TO 'escoles'@'localhost';

    /**
    CREATE TABLE ROLES(
    ID INT PRIMARY KEY,
    DEPARTAMENTO VARCHAR(255) NOT NULL
);

CREATE TABLE USERS(
    USER_ID INT AUTO_INCREMENT PRIMARY KEY,
    NOMBRE VARCHAR(255) NOT NULL, 
    APELLIDOS VARCHAR(255) NOT NULL,
    EMAIL VARCHAR(255) NOT NULL UNIQUE,
    PASSWORD VARCHAR(255) NOT NULL,
    ID_ROLE INT NOT NULL,

    FOREIGN KEY (ID_ROLE) REFERENCES
    ROLES(ID)
);

CREATE TABLE ALUMNOS(
    USER_ID INT NOT NULL,
    ID INT PRIMARY KEY AUTO_INCREMENT,
    FECHA_NACIMIENTO DATE,
    DIRECCION VARCHAR(255),

    FOREIGN KEY (USER_ID) REFERENCES
    USERS(USER_ID)
);

CREATE TABLE PROFESORES(
    USER_ID INT NOT NULL,
    ID INT PRIMARY KEY AUTO_INCREMENT,
    DEPARTAMENTO VARCHAR(255) NOT NULL,

    FOREIGN KEY (USER_ID) REFERENCES
    USERS(USER_ID)
);

CREATE TABLE ASIGNATURAS(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    NOMBRE_ASIGNATURA VARCHAR(255) NOT NULL,
    DURACION INT NOT NULL,
    DESCRIPCION VARCHAR(255) NULL,
    ID_PROFESOR INT NOT NULL,
    
    FOREIGN KEY (ID_PROFESOR) REFERENCES
    PROFESORES(ID)
);

CREATE TABLE MATRICULA(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    ID_ALUMNO INT NOT NULL, 
    CURSO VARCHAR(255) NOT NULL,
    PRECIO FLOAT NOT NULL,
    FECHA DATE NOT NULL,
    ID_ASIGNATURA INT NOT NULL,

    FOREIGN KEY (ID_ALUMNO) REFERENCES
    ALUMNOS(ID),
    
    FOREIGN KEY (ID_ASIGNATURA) REFERENCES
    ASIGNATURAS (ID)
);

CREATE TABLE CALIFICACIONES(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    ID_ALUMNO INT NOT NULL, 
    ID_ASIGNATURA INT NOT NULL,
    NOTA FLOAT NOT NULL,
    ID_PROFESOR INT NOT NULL,

    FOREIGN KEY (ID_ALUMNO) REFERENCES
    ALUMNOS(ID),

    FOREIGN KEY (ID_PROFESOR) REFERENCES
    PROFESORES (ID),

    FOREIGN KEY (ID_ASIGNATURA) REFERENCES
    ASIGNATURAS (ID)
);
CREATE TABLE settings (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    USER_ID INT NOT NULL,
    THEME VARCHAR(255),
    LANGUAGE VARCHAR(255),
    FOREIGN KEY (USER_ID) REFERENCES users(USER_ID)
);


create table prueba(
    id int AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(255) not null,
    apellidos varchar(255) not null,
    pais varchar(255) not null
    )

    insert into prueba values (1, 'Marc' ,'Rodriguez', 'Spain')
    insert into roles values (1, 'Alumno'), (2, 'Profesor');

    INSERT INTO users VALUES
    (1, 'Toni', 'Jimenez', 't.jimenez@gmail.com', '$2y$10$s7jTpYPa6m6UghbuJPuG0uggAEuHyhYypHMgWuNkm8xqk8ELOc0be', 2),
    (2, 'Jose', 'Meseguer', 'j.meseguer@gmail.com', '$2y$10$s7jTpYPa6m6UghbuJPuG0uggAEuHyhYypHMgWuNkm8xqk8ELOc0be', 2),
    (3, 'Jose Antonio', 'Piqueras', 'j.piqueras@gmail.com', '$2y$10$s7jTpYPa6m6UghbuJPuG0uggAEuHyhYypHMgWuNkm8xqk8ELOc0be', 2),
    (4, 'Jennifer', 'Tejero', 'j.tejero@gmail.com', '$2y$10$s7jTpYPa6m6UghbuJPuG0uggAEuHyhYypHMgWuNkm8xqk8ELOc0be', 2)


    INSERT INTO asignaturas (nombre_asignatura, duracion, descripcion ,id_profesor)
    VALUES
  ('Entornos de desarrollo', 150,'Gestion de los Entornos de Desarrollo mas utilizados en el mundo de la programacion para obtener un codigo depurado y optimizado. Herramientas para la representacion grafica de las clases y su comportamiento.' ,2),
  ('Desarrollo de aplicaciones web en entorno cliente', 170,'Desarrollo web en entorno cliente' ,3),
  ('Desarrollo de aplicaciones web en entorno servidor', 300,'Desarrollo backend de webapps. (basadas en PHP)' ,1),
  ('Despliegue de aplicaciones web', 200, 'Implantar aplicaciones web en distintos entornos de servidor y cliente.' ,1),
  ('Despliegue avanzado de proyectos en servidor', 230,'Despliegue avanzado de proyectos en servidor.' ,2),
  ('Proyecto empresarial', 230, 'Gestion de un proyecto real basado en web' ,4);

  INSERT INTO profesores VALUES 
  (1, 1,'DAW'),
  (2, 2,'DAW'),
  (3, 3,'DAW'),
  (4, 4,'EMPRESA')
     */

     //Insert into alumnos values ('11111111X', 'Marc', 'Rodriguez', 'example@example.com', '2003-03-26', 'Av2', '12345');


?>