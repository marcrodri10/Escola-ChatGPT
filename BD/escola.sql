-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-10-2023 a las 19:34:43
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `escola`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `USER_ID` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `FECHA_NACIMIENTO` date DEFAULT NULL,
  `DIRECCION` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`USER_ID`, `ID`, `FECHA_NACIMIENTO`, `DIRECCION`) VALUES
(6, 4, '2023-01-03', 'Av3'),
(25, 19, NULL, NULL),
(26, 20, NULL, NULL),
(27, 21, NULL, NULL),
(29, 22, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas`
--

CREATE TABLE `asignaturas` (
  `ID` int(11) NOT NULL,
  `NOMBRE_ASIGNATURA` varchar(255) NOT NULL,
  `DURACION` int(11) NOT NULL,
  `ID_PROFESOR` int(11) NOT NULL,
  `DESCRIPCION` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignaturas`
--

INSERT INTO `asignaturas` (`ID`, `NOMBRE_ASIGNATURA`, `DURACION`, `ID_PROFESOR`, `DESCRIPCION`) VALUES
(1, 'Entornos de desarrollo', 150, 2, 'Gestión de los Entornos de Desarrollo más utilizados en el mundo de la programación para obtener un código depurado y optimizado. Herramientas para la representación gráfica de las clases y su comportamiento.'),
(2, 'Desarrollo de aplicaciones web en entorno cliente', 170, 3, 'Desarrollo web en entorno cliente'),
(3, 'Desarrollo de aplicaciones web en entorno servidor', 300, 1, 'Desarrollo backend de webapps. (basadas en PHP)'),
(4, 'Despliegue de aplicaciones web', 200, 1, 'Implantar aplicaciones web en distintos entornos de servidor y cliente.'),
(5, 'Despliegue avanzado de proyectos en servidor', 230, 2, 'Despliegue avanzado de proyectos en servidor.'),
(6, 'Proyecto empresarial', 80, 4, 'Proyecto empresarial basado en un producto real');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `ID_NOTA` int(11) NOT NULL,
  `ID_ALUMNO` int(11) NOT NULL,
  `ID_ASIGNATURA` int(11) NOT NULL,
  `NOTA` float NOT NULL,
  `ID_PROFESOR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`ID_NOTA`, `ID_ALUMNO`, `ID_ASIGNATURA`, `NOTA`, `ID_PROFESOR`) VALUES
(3, 4, 3, 7, 1),
(4, 20, 3, 3, 1),
(5, 21, 4, 2, 1),
(6, 4, 4, 9, 1),
(7, 4, 2, 5, 3),
(8, 20, 2, 4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `ID` int(11) NOT NULL,
  `ID_ALUMNO` int(11) NOT NULL,
  `CURSO` varchar(255) NOT NULL,
  `PRECIO` float NOT NULL,
  `FECHA` date NOT NULL,
  `ID_ASIGNATURA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `matricula`
--

INSERT INTO `matricula` (`ID`, `ID_ALUMNO`, `CURSO`, `PRECIO`, `FECHA`, `ID_ASIGNATURA`) VALUES
(65, 4, '2023-2024', 300, '2023-10-26', 2),
(67, 4, '2023-2024', 300, '2023-10-26', 3),
(68, 4, '2023-2024', 300, '2023-10-26', 4),
(69, 4, '2023-2024', 300, '2023-10-26', 5),
(70, 4, '2023-2024', 300, '2023-10-26', 6),
(71, 19, '2023-2024', 300, '2023-10-26', 3),
(72, 19, '2023-2024', 300, '2023-10-26', 4),
(74, 20, '2023-2024', 300, '2023-10-26', 2),
(75, 20, '2023-2024', 300, '2023-10-26', 3),
(76, 21, '2023-2024', 300, '2023-10-26', 4),
(77, 21, '2023-2024', 300, '2023-10-26', 5),
(78, 21, '2023-2024', 300, '2023-10-26', 6),
(79, 19, '2023-2024', 300, '2023-10-27', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `USER_ID` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `DEPARTAMENTO` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`USER_ID`, `ID`, `DEPARTAMENTO`) VALUES
(1, 1, 'DAW'),
(2, 2, 'DAW'),
(3, 3, 'DAW'),
(4, 4, 'EMPRESA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `ID` int(11) NOT NULL,
  `DEPARTAMENTO` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`ID`, `DEPARTAMENTO`) VALUES
(1, 'Alumno'),
(2, 'Profesor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `THEME` varchar(255) DEFAULT NULL,
  `LANGUAGE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`ID`, `USER_ID`, `THEME`, `LANGUAGE`) VALUES
(7, 6, 'light', 'de'),
(8, 1, 'light', 'ca'),
(9, 2, 'light', 'es'),
(10, 25, 'light', 'ca'),
(11, 26, 'light', 'ca'),
(12, 27, 'light', 'ca'),
(13, 3, 'light', 'es');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `USER_ID` int(11) NOT NULL,
  `NOMBRE` varchar(255) NOT NULL,
  `APELLIDOS` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `ID_ROLE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`USER_ID`, `NOMBRE`, `APELLIDOS`, `EMAIL`, `PASSWORD`, `ID_ROLE`) VALUES
(1, 'Toni', 'Jimenez', 't.jimenez@gmail.com', '$2y$10$s7jTpYPa6m6UghbuJPuG0uggAEuHyhYypHMgWuNkm8xqk8ELOc0be', 2),
(2, 'Jose', 'Meseguer', 'j.meseguer@gmail.com', '$2y$10$s7jTpYPa6m6UghbuJPuG0uggAEuHyhYypHMgWuNkm8xqk8ELOc0be', 2),
(3, 'Jose Antonio', 'Piqueras', 'j.piqueras@gmail.com', '$2y$10$s7jTpYPa6m6UghbuJPuG0uggAEuHyhYypHMgWuNkm8xqk8ELOc0be', 2),
(4, 'Jennifer', 'Tejero', 'j.tejero@gmail.com', '$2y$10$s7jTpYPa6m6UghbuJPuG0uggAEuHyhYypHMgWuNkm8xqk8ELOc0be', 2),
(6, 'Marc', 'Rodriguez', 'marcrodrimartin@gmail.com', '$2y$10$nPIbhqlvqad/UMZTxETuje0aKcKWHtggcG1KQPQzV1avtGv1sZVdi', 1),
(21, 'alumno', 'alumno', 'it@gmail.com', '$2y$10$zTcMwM6MVMYNMS.cY/YEw.pEEoCMLEmB/m961opqncyV0GN2jM8gq', 1),
(23, 'alumno', 'alumno', 'dwdwd@dwd', '$2y$10$BC9akl5eyYO0j.avRC6EkehbEeZSkheZ0qduLdhqclzExybn2012K', 1),
(25, 'Carlos', 'Rodriguez', 'c@gmail.com', '$2y$10$ecip06CpZ1DTMjNwwlAABOMmv7Xt4HmLX2IRfjVx91E5.r4cPHaCu', 1),
(26, 'Fran', 'Martinez', 'f@gmail.com', '$2y$10$/i6UMpQneUaZIEIUCR/qWODAMHNHy6ziMWywLCy5mdm7CSn4egDzi', 1),
(27, 'Enrique', 'Rodriguez', 'e@gmail.com', '$2y$10$VUPUcVNyk0qfhKJmTYlMWuyBY38EHU01Smcoo3L0rQ98sQV6yJ9.y', 1),
(29, 'Toni', 'Lopez', 'tlr@gmail.com', '$2y$10$8H.Bs3lHGML1PO0EABD.8OqC7YSaTs6gS5LXpyWHEAaxs9.Xh1QDS', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- Indices de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_PROFESOR` (`ID_PROFESOR`);

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`ID_NOTA`),
  ADD KEY `ID_ALUMNO` (`ID_ALUMNO`),
  ADD KEY `ID_PROFESOR` (`ID_PROFESOR`),
  ADD KEY `ID_ASIGNATURA` (`ID_ASIGNATURA`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_ALUMNO` (`ID_ALUMNO`),
  ADD KEY `ID_ASIGNATURA` (`ID_ASIGNATURA`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USER_ID`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`),
  ADD KEY `ID_ROLE` (`ID_ROLE`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `ID_NOTA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `matricula`
--
ALTER TABLE `matricula`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`USER_ID`);

--
-- Filtros para la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD CONSTRAINT `asignaturas_ibfk_1` FOREIGN KEY (`ID_PROFESOR`) REFERENCES `profesores` (`ID`);

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `calificaciones_ibfk_1` FOREIGN KEY (`ID_ALUMNO`) REFERENCES `alumnos` (`ID`),
  ADD CONSTRAINT `calificaciones_ibfk_2` FOREIGN KEY (`ID_PROFESOR`) REFERENCES `profesores` (`ID`),
  ADD CONSTRAINT `calificaciones_ibfk_3` FOREIGN KEY (`ID_ASIGNATURA`) REFERENCES `asignaturas` (`ID`);

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matricula_ibfk_1` FOREIGN KEY (`ID_ALUMNO`) REFERENCES `alumnos` (`ID`),
  ADD CONSTRAINT `matricula_ibfk_2` FOREIGN KEY (`ID_ASIGNATURA`) REFERENCES `asignaturas` (`ID`);

--
-- Filtros para la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD CONSTRAINT `profesores_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`USER_ID`);

--
-- Filtros para la tabla `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`USER_ID`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`ID_ROLE`) REFERENCES `roles` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
