-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 24-09-2018 a las 14:07:42
-- Versión del servidor: 5.7.17-log
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vivecorp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `codRole` int(11) NOT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`codRole`, `role`) VALUES
(1, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `codUsuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `ci` varchar(50) DEFAULT NULL,
  `cel` varchar(50) DEFAULT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `codRole` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`codUsuario`, `nombre`, `ci`, `cel`, `direccion`, `usuario`, `password`, `estado`, `fechaNacimiento`, `codRole`) VALUES
(1, 'gonzalo veizaga', '4309729', '76420670', 'av dorbigni s/n', 'gon', 'gon', 1, '1983-09-20', 1),
(2, 'andrea villarroel', '787', '89', 'sda', 'gon', 'hjh', 1, '2018-09-11', 1),
(3, 'juan perez', 'JOPJ', 'IOPI', 'UIUO', 'gon', 'hjh', 1, '2018-09-12', 1),
(4, 'boris villarroel', '4564', '78465', 'fasjkl', '5446', 'jkfdslj', 1, '2018-09-01', 1),
(5, 'carlos', '323', '8979', 'jklfsd', '89', 'jijo', 1, '2018-09-04', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`codRole`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codUsuario`),
  ADD KEY `R_2` (`codRole`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`codRole`) REFERENCES `role` (`codRole`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
