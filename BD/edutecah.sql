-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 01-08-2019 a las 20:19:30
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

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `ActualizarDias`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarDias` ()  UPDATE tblplan SET DiasPrueba = DiasPrueba - 1 WHERE tblplan.IDTipoPlan = 1 AND DiasPrueba != '0'$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbldocxinstituto`
--

DROP TABLE IF EXISTS `tbldocxinstituto`;
CREATE TABLE IF NOT EXISTS `tbldocxinstituto` (
  `IDDocente` int(10) NOT NULL,
  `IDInstituto` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbldocxinstituto`
--

INSERT INTO `tbldocxinstituto` (`IDDocente`, `IDInstituto`) VALUES
(1, 1);

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
(1, '080100001', 'Colegio 1', 'QKPN56OM', 1, 'Aqui', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbllogs`
--

DROP TABLE IF EXISTS `tbllogs`;
CREATE TABLE IF NOT EXISTS `tbllogs` (
  `IDLog` int(10) NOT NULL AUTO_INCREMENT,
  `Evento` varchar(20) NOT NULL,
  `Descripcion` varchar(60) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `IPUsuario` varchar(20) NOT NULL,
  `IDUsuario` int(10) NOT NULL,
  PRIMARY KEY (`IDLog`),
  KEY `IDUsuario` (`IDUsuario`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbllogs`
--

INSERT INTO `tbllogs` (`IDLog`, `Evento`, `Descripcion`, `Fecha`, `Hora`, `IPUsuario`, `IDUsuario`) VALUES
(1, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-01', '13:25:58', '::1', 1),
(2, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-01', '13:33:24', '::1', 1),
(3, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-01', '13:33:45', '::1', 1),
(4, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-01', '13:33:59', '::1', 1),
(5, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-01', '13:34:27', '::1', 1),
(6, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-01', '13:35:05', '::1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblplan`
--

DROP TABLE IF EXISTS `tblplan`;
CREATE TABLE IF NOT EXISTS `tblplan` (
  `IDPlan` int(10) NOT NULL AUTO_INCREMENT,
  `IDTipoPlan` int(10) NOT NULL,
  `IDInstituto` int(10) NOT NULL,
  `DiasPrueba` int(2) DEFAULT NULL,
  `AulasDisponibles` int(3) NOT NULL,
  PRIMARY KEY (`IDPlan`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblplan`
--

INSERT INTO `tblplan` (`IDPlan`, `IDTipoPlan`, `IDInstituto`, `DiasPrueba`, `AulasDisponibles`) VALUES
(1, 1, 1, 30, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbltipoplan`
--

DROP TABLE IF EXISTS `tbltipoplan`;
CREATE TABLE IF NOT EXISTS `tbltipoplan` (
  `IDTIpoPlan` int(10) NOT NULL AUTO_INCREMENT,
  `TipoPlan` varchar(15) NOT NULL,
  PRIMARY KEY (`IDTIpoPlan`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbltipoplan`
--

INSERT INTO `tbltipoplan` (`IDTIpoPlan`, `TipoPlan`) VALUES
(1, 'Prueba'),
(2, 'Básico'),
(3, 'Medio'),
(4, 'Completo');

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

DELIMITER $$
--
-- Eventos
--
DROP EVENT `jobDecDiasPrueba`$$
CREATE DEFINER=`root`@`localhost` EVENT `jobDecDiasPrueba` ON SCHEDULE EVERY 1 DAY STARTS '2019-08-01 10:53:00' ON COMPLETION NOT PRESERVE ENABLE DO CALL ActualizarDias()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
