-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 01-08-2019 a las 05:00:50
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `edutecah`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblinstituto`
--

DROP TABLE IF EXISTS `tblinstituto`;
CREATE TABLE IF NOT EXISTS `tblinstituto` (
  `IDInstituto` int(10) NOT NULL AUTO_INCREMENT,
  `CodigoIns` varchar(9) NOT NULL,
  `NombreIns` varchar(30) NOT NULL,
  `Pase` varchar(8) NOT NULL,
  `IDMunicipio` int(3) NOT NULL,
  `Direccion` varchar(50) NOT NULL,
  `Director` int(10) NOT NULL,
  PRIMARY KEY (`IDInstituto`),
  KEY `Director` (`Director`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblinstituto`
--

INSERT INTO `tblinstituto` (`IDInstituto`, `CodigoIns`, `NombreIns`, `Pase`, `IDMunicipio`, `Direccion`, `Director`) VALUES
(1, '080100001', 'Colegio 123', 'KZPLO3RS', 1, 'aqui', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbllogs`
--

DROP TABLE IF EXISTS `tbllogs`;
CREATE TABLE IF NOT EXISTS `tbllogs` (
  `IDLog` int(10) NOT NULL AUTO_INCREMENT,
  `Evento` varchar(10) NOT NULL,
  `Descripcion` varchar(30) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `IPUsuario` varchar(20) NOT NULL,
  `IDUsuario` int(10) NOT NULL,
  PRIMARY KEY (`IDLog`),
  KEY `IDUsuario` (`IDUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbltipousuario`
--

DROP TABLE IF EXISTS `tbltipousuario`;
CREATE TABLE IF NOT EXISTS `tbltipousuario` (
  `IDTipoUs` int(10) NOT NULL AUTO_INCREMENT,
  `Tipo` varchar(10) NOT NULL,
  PRIMARY KEY (`IDTipoUs`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbltipousuario`
--

INSERT INTO `tbltipousuario` (`IDTipoUs`, `Tipo`) VALUES
(1, 'Admin'),
(2, 'Director'),
(3, 'Docente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusuario`
--

DROP TABLE IF EXISTS `tblusuario`;
CREATE TABLE IF NOT EXISTS `tblusuario` (
  `IDUsuario` int(10) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(30) NOT NULL,
  `Apellido` varchar(30) NOT NULL,
  `Correo` varchar(30) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `TipoUsuario` int(10) NOT NULL,
  PRIMARY KEY (`IDUsuario`),
  KEY `TipoUsuario` (`TipoUsuario`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblusuario`
--

INSERT INTO `tblusuario` (`IDUsuario`, `Nombre`, `Apellido`, `Correo`, `Password`, `TipoUsuario`) VALUES
(1, 'Abner', 'Betancourt', 'abner@algo.hn', '7c4a8d09ca3762af61e59520943dc26494f8941b', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
