-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-08-2024 a las 01:50:52
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `login`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `set_dispositivos`
--

CREATE TABLE `set_dispositivos` (
  `ip` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `so` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nav` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario` int(11) NOT NULL,
  `pin` int(11) NOT NULL,
  `valid` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sesion` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actual` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `set_imagenes`
--

CREATE TABLE `set_imagenes` (
  `id` int(11) NOT NULL,
  `imagen` longblob NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `set_sesiones`
--

CREATE TABLE `set_sesiones` (
  `idSesion` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `sesion` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `set_usuarios`
--

CREATE TABLE `set_usuarios` (
  `usuario` int(11) NOT NULL,
  `pw` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apPaterno` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apMaterno` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` int(10) DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `set_usuarios`
--

INSERT INTO `set_usuarios` (`usuario`, `pw`, `nombre`, `apPaterno`, `apMaterno`, `telefono`, `email`) VALUES
(1234, '$2y$10$gWJe2wSbA7jT5YtObxGKPufx9lO3YTws9tev9CAtX1GhcMND6Wdta', NULL, NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `set_imagenes`
--
ALTER TABLE `set_imagenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `set_sesiones`
--
ALTER TABLE `set_sesiones`
  ADD PRIMARY KEY (`idSesion`);

--
-- Indices de la tabla `set_usuarios`
--
ALTER TABLE `set_usuarios`
  ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `set_sesiones`
--
ALTER TABLE `set_sesiones`
  MODIFY `idSesion` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
