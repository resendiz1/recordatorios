-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-06-2020 a las 06:02:20
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `record`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL,
  `usuario` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `secret` text COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_user` int(11) NOT NULL,
  `nombre` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellidos` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `edad` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `img` blob NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `voluntades`
--

CREATE TABLE IF NOT EXISTS `voluntades` (
  `id_voluntad` int(11) NOT NULL,
  `titulo` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `enlace` text COLLATE utf8mb4_spanish_ci,
  `fecha_add` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha_make` text COLLATE utf8mb4_spanish_ci,
  `realizado` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `user_id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_voluntad`),
  KEY `voluntades_user_fk` (`user_id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `voluntades`
--
ALTER TABLE `voluntades`
  ADD CONSTRAINT `voluntades_user_fk` FOREIGN KEY (`user_id_user`) REFERENCES `usuario` (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
