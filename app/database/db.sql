-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2023 a las 00:29:01
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `noticias` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `noticias`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `subtitulo` varchar(250) NOT NULL,
  `descripcion` varchar(4250) NOT NULL,
  `id_seccion` int(11) NOT NULL,
  `imagen` varchar(750) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `titulo`, `subtitulo`, `descripcion`, `id_seccion`, `imagen`) VALUES
(1, 'Criptos al Alza', 'Las novedades criptos', 'Hay criptomonedas que sus valores estan siendo incrementados infernalmente!', 1, 'images/ejemplo.png'),
(2, 'Advertencia sobre hacking y virus maliciosos', 'Ultimas noticias acerca de hackeos y pishing', 'Estafadores que se hacen pasar por grandes empresas para robar credenciales e identidades.', 3, 'images/ejemplo.png'),
(3, 'Las nuevas criptos', 'Enterate de las tendencias', 'Las ultimas criptomonedas lanzadas este mes fueron:', 1, 'images/ejemplo.png'),
(4, 'Las tecnologias de desarrollo', 'Los mejores lenguajes para el mercado 2024', 'Aprende acerca del desarrollo de criptomonedas', 2, 'images/ejemplo.png'),
(5, 'La alza de Ethereum en las ultimas horas', 'Enterate del precio del ethereum', 'Paso de valer $1500 a $4500 en tan solo unas horas, ¿Que paso?.', 1, 'images/ejemplo.png'),
(6, 'Es rentable minar criptos en 2023?', 'Aprende acerca de la mineria y las taxes', 'Que tan rentable es el mercado cripto para los mineros, algo que antes fue una revolucion.', 5, 'images/ejemplo.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE `secciones` (
  `id` int(11) NOT NULL,
  `tipo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`id`, `tipo`) VALUES
(1, 'CriptoMonedas'),
(2, 'Programacion'),
(3, 'Software Malicioso'),
(4, 'Inversiones'),
(5, 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `email` varchar(70) NOT NULL,
  `contraseña` varchar(1350) NOT NULL,
  `rol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `contraseña`, `rol`) VALUES
(1, 'webadmin', 'webadmin', 'webadmin@gmail.com', '$2y$10$4NEgpAzad7fKQd4twyYYnOL4kc2grvyaA/g/JHgZ6T9Qr.CawltJm', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
