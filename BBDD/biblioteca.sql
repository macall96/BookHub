-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2023 a las 17:03:38
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--
-- Eliminamos la base de datos si existe
DROP DATABASE IF EXISTS `biblioteca`;
-- Creamos la base de datos
CREATE DATABASE `biblioteca`;
-- Seleccionamos la base de datos biblioteca
USE `biblioteca`;
--

CREATE TABLE `libros` (
  `id` int(6) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `editorial` varchar(100) NOT NULL,
  `alquilado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `isbn`, `titulo`, `autor`, `editorial`, `alquilado`) VALUES
(1, '9781234567890', 'La Aventura de la Montaña', 'Juan Pérez', 'Editorial ABC', 0),
(2, '9789876543210', 'El Secreto del Bosque', 'Ana González', 'Editorial XYZ', 0),
(3, '9785432109876', 'Misterio en la Ciudad', 'Pedro Rodríguez', 'Editorial 123 Libros', 0),
(4, '9781111222233', 'Viaje al Pasado', 'Laura Sánchez', 'Editorial Cuadernos', 0),
(5, '9783333444455', 'El Tesoro Perdido', 'Carlos López', 'Editorial Letras Doradas', 0),
(6, '9788888777776', 'Los Secretos del Universo', 'María Martínez', 'Editorial Universo', 0),
(7, '9784321098765', 'Misterios Cósmicos', 'Alberto López', 'Universo Ediciones', 0),
(8, '9788765432109', 'Secretos en la Sombra', 'Pedro Gómez', 'Libros de Intriga', 0),
(9, 'D456E789F012G', 'El Arte de la Cocina', 'Ricardo Sánchez', 'Editorial Gastronómica', 0),
(10, 'WXYZ123456789', 'Romance en París 2', 'Luisa Martínez', 'Novelas Románticas S.A.', 0),
(11, 'WXYZ5678UV12', 'Viaje a lo Desconocido', 'Ana Rodríguez', 'Editorial Aventuras', 0),
(12, 'EFGH5678IJK9', 'El Enigma de la Pirámide', 'Isabel Gómez', 'Libros de Misterio', 0),
(13, '824897439AFGPL', 'Juego de Tronos', 'George R.R.Martin', 'Norma Editorial', 0),
(14, '7447HGYIW3984LK', 'Harry Potter y el Cáliz de Fuego', 'J.K.Rowling', 'Norma Editorial', 0),
(15, 'HJBBJH8789327', 'Fundación ', 'Isaac Asimov', 'Álgebra', 0),
(16, '3838DCSP0922', 'Don Quijote de la Mancha', 'Miguel de Cervantes', 'Planeta', 0),
(17, '12345HGDE', 'Harry Potter y la Piedra Filosofal', 'J.K.Rowling', 'Norma Editorial', 0),
(18, '12YZX5HGDE', 'Harry Potter y la Cámara Secreta', 'J.K.Rowling', 'Norma Editorial', 0),
(19, '12345HTRE', 'Harry Potter y el Prisionero de Azkaban', 'J.K.Rowling', 'Norma Editorial', 0),
(20, '12345OPZE', 'Harry Potter y la Orden del Fénix', 'J.K.Rowling', 'Norma Editorial', 0),
(21, '1234512DE', 'Harry Potter y el Misterio del Príncipe', 'J.K.Rowling', 'Norma Editorial', 0),
(22, '178345HPJDE', 'Harry Potter y las Reliquias de la Muerte', 'J.K.Rowling', 'Norma Editorial', 0),
(23, '48938749884HSGBH', 'El día que se perdió la cordura ', 'Javier Castillo', 'Alfaguara', 0),
(24, 'XSWXW43400JJD', 'Reina Roja', 'Juan Gómez-Jurado', 'Penguin', 0),
(25, 'JIOJOICE09234', 'Watchmen', 'Alan Moore', 'Norma Editorial', 0),
(26, 'ÑLCLCKLSCIJ903442', 'El Señor de los Anillos: La comunidad del Anillo', 'J.R.R.Tolkien', 'Alfaguara', 0),
(27, 'PPPPSSSI4532', 'El Señor de los Anillos: Las Dos Torres', 'J.R.R.Tolkien', 'Alfaguara', 0),
(28, 'ZXVBNNNN45611', 'El Señor de los Anillos: El Retorno del Rey', 'J.R.R.Tolkien', 'Alfaguara', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id_prestamo` int(50) NOT NULL,
  `id_usuario` int(50) NOT NULL,
  `id_libro` int(50) NOT NULL,
  `nombre_libro` varchar(500) NOT NULL,
  `fin_prestamo` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id_prestamo`, `id_usuario`, `id_libro`, `nombre_libro`, `fin_prestamo`) VALUES
(1, 17, 13, 'Juego de Tronos', NULL),
(3, 17, 13, 'Juego de Tronos', NULL),
(4, 17, 14, 'Harry Potter y el Cáliz de Fuego', NULL),
(5, 17, 1, 'La Aventura de la Montaña', NULL),
(6, 17, 18, 'Harry Potter y la Cámara Secreta', NULL),
(7, 17, 21, 'Harry Potter y el Misterio del Príncipe', NULL),
(8, 17, 22, 'Harry Potter y las Reliquias de la Muerte', NULL),
(9, 28, 13, 'Juego de Tronos', NULL),
(10, 17, 23, 'El día que se perdió la cordura ', NULL),
(11, 17, 4, 'Viaje al Pasado', NULL),
(12, 29, 5, 'El Tesoro Perdido', NULL),
(13, 30, 23, 'El día que se perdió la cordura ', NULL),
(14, 17, 27, 'El Señor de los Anillos: Las Dos Torres', NULL),
(15, 17, 26, 'El Señor de los Anillos: La comunidad del Anillo', NULL),
(16, 17, 2, 'El Secreto del Bosque', NULL),
(17, 17, 17, 'Harry Potter y la Piedra Filosofal', NULL),
(18, 17, 3, 'Misterio en la Ciudad', NULL),
(19, 17, 11, 'Viaje a lo Desconocido', NULL),
(20, 17, 18, 'Harry Potter y la Cámara Secreta', NULL),
(21, 17, 9, 'El Arte de la Cocina', NULL),
(22, 17, 12, 'El Enigma de la Pirámide', NULL),
(23, 17, 13, 'Juego de Tronos', NULL),
(24, 35, 4, 'Viaje al Pasado', NULL),
(25, 35, 11, 'Viaje a lo Desconocido', NULL),
(26, 35, 27, 'El Señor de los Anillos: Las Dos Torres', NULL),
(27, 35, 19, 'Harry Potter y el Prisionero de Azkaban', NULL),
(28, 17, 1, 'La Aventura de la Montaña', NULL),
(29, 17, 25, 'Watchmen', NULL),
(30, 17, 17, 'Harry Potter y la Piedra Filosofal', NULL),
(31, 17, 5, 'El Tesoro Perdido', NULL),
(32, 17, 1, 'La Aventura de la Montaña', NULL),
(33, 17, 3, 'Misterio en la Ciudad', NULL),
(34, 17, 8, 'Secretos en la Sombra', NULL),
(35, 17, 12, 'El Enigma de la Pirámide', NULL),
(36, 17, 15, 'Fundación ', NULL),
(37, 17, 27, 'El Señor de los Anillos: Las Dos Torres', NULL),
(38, 17, 1, 'La Aventura de la Montaña', NULL),
(39, 17, 2, 'El Secreto del Bosque', NULL),
(40, 17, 6, 'Los Secretos del Universo', NULL),
(41, 17, 11, 'Viaje a lo Desconocido', NULL),
(42, 17, 5, 'El Tesoro Perdido', NULL),
(43, 17, 5, 'El Tesoro Perdido', NULL),
(44, 17, 12, 'El Enigma de la Pirámide', NULL),
(45, 17, 16, 'Don Quijote de la Mancha', NULL),
(46, 17, 19, 'Harry Potter y el Prisionero de Azkaban', NULL),
(47, 38, 27, 'El Señor de los Anillos: Las Dos Torres', NULL),
(48, 38, 23, 'El día que se perdió la cordura ', NULL),
(49, 40, 25, 'Watchmen', NULL),
(50, 43, 11, 'Viaje a lo Desconocido', NULL),
(51, 44, 26, 'El Señor de los Anillos: La comunidad del Anillo', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(6) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido1` varchar(50) NOT NULL,
  `apellido2` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `fecha_registro` date NOT NULL,
  `rol` varchar(50) NOT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido1`, `apellido2`, `usuario`, `password`, `correo`, `fecha_registro`, `rol`, `borrado`) VALUES
(9, 'Miguel', 'de la Calle', 'Cuadra', 'admin', '$2y$10$T.81XWGXDhFOc6G00aEbn.EN3PxdjFD95TUcopP3vkJkStI40W2QK', 'miguel_3396@gmail.com', '2023-10-21', 'admin', 0),
(44, 'Anónimo', 'García', 'Jiménez', 'usuarioEstandar1', '$2y$10$rrD0ytquFPRsQ2phWP/u9Ouh0nZUWaWBYUPduQlG2aS/8DuLDX/PC', 'usuarioEstandar1@gmail.com', '2023-11-20', 'usuario', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id_prestamo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id_prestamo` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
