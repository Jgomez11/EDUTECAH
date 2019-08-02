-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 02-08-2019 a las 18:42:19
-- Versión del servidor: 5.7.23
-- Versión de PHP: 7.2.10

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
-- Estructura de tabla para la tabla `tblcursos`
--

DROP TABLE IF EXISTS `tblcursos`;
CREATE TABLE IF NOT EXISTS `tblcursos` (
  `IDCurso` int(11) NOT NULL AUTO_INCREMENT,
  `NombreCurso` varchar(30) NOT NULL,
  PRIMARY KEY (`IDCurso`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblcursos`
--

INSERT INTO `tblcursos` (`IDCurso`, `NombreCurso`) VALUES
(1, 'Ciclo Comun'),
(2, 'Bachillerato En Humanidades'),
(3, 'Bachillerato En Informatica'),
(4, 'Finanzas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcursoxinstituto`
--

DROP TABLE IF EXISTS `tblcursoxinstituto`;
CREATE TABLE IF NOT EXISTS `tblcursoxinstituto` (
  `IDInstituto` int(11) NOT NULL,
  `IDCurso` int(11) NOT NULL,
  `IDGrado` int(1) NOT NULL,
  `IDSeccion` int(1) NOT NULL,
  KEY `IDInstitutoCXIfk` (`IDInstituto`),
  KEY `IDCursoCXIfk` (`IDCurso`),
  KEY `IDGradoCXIfk` (`IDGrado`),
  KEY `IDSeccionesCXIfk` (`IDSeccion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblcursoxinstituto`
--

INSERT INTO `tblcursoxinstituto` (`IDInstituto`, `IDCurso`, `IDGrado`, `IDSeccion`) VALUES
(1, 1, 1, 1),
(1, 2, 1, 1),
(1, 3, 1, 1),
(1, 4, 1, 1),
(1, 1, 2, 1),
(1, 2, 2, 1),
(1, 3, 2, 1),
(1, 4, 2, 1),
(1, 1, 2, 1),
(1, 2, 3, 1),
(1, 3, 3, 1),
(1, 4, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbldepartamentos`
--

DROP TABLE IF EXISTS `tbldepartamentos`;
CREATE TABLE IF NOT EXISTS `tbldepartamentos` (
  `IDDepartamento` int(10) NOT NULL AUTO_INCREMENT,
  `NombreDepartamento` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IDDepartamento`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbldepartamentos`
--

INSERT INTO `tbldepartamentos` (`IDDepartamento`, `NombreDepartamento`) VALUES
(2, 'Colón'),
(3, 'Comayagua'),
(4, 'Copán'),
(5, 'Cortés'),
(6, 'Choluteca'),
(7, 'El Paraíso'),
(8, 'Francisco Morazán'),
(9, 'Gracias a Dios'),
(10, 'Intibucá'),
(11, 'Islas de la Bahía'),
(12, 'La Paz'),
(13, 'Lempira'),
(14, 'Ocotepeque'),
(15, 'Olancho'),
(16, 'Santa Bárbara'),
(17, 'Valle'),
(18, 'Yoro'),
(1, 'Atlántida');

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
-- Estructura de tabla para la tabla `tblgrado`
--

DROP TABLE IF EXISTS `tblgrado`;
CREATE TABLE IF NOT EXISTS `tblgrado` (
  `IDGrado` int(11) NOT NULL AUTO_INCREMENT,
  `Grado` varchar(10) NOT NULL,
  PRIMARY KEY (`IDGrado`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblgrado`
--

INSERT INTO `tblgrado` (`IDGrado`, `Grado`) VALUES
(1, 'Primero'),
(2, 'Segundo'),
(3, 'Tercero');

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
-- Estructura de tabla para la tabla `tbljornada`
--

DROP TABLE IF EXISTS `tbljornada`;
CREATE TABLE IF NOT EXISTS `tbljornada` (
  `IDJornada` int(11) NOT NULL AUTO_INCREMENT,
  `Jornada` varchar(10) NOT NULL,
  PRIMARY KEY (`IDJornada`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbljornada`
--

INSERT INTO `tbljornada` (`IDJornada`, `Jornada`) VALUES
(1, 'Matutina'),
(2, 'Vespertina');

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
-- Estructura de tabla para la tabla `tblmunicipio`
--

DROP TABLE IF EXISTS `tblmunicipio`;
CREATE TABLE IF NOT EXISTS `tblmunicipio` (
  `IDMunicipio` int(10) NOT NULL AUTO_INCREMENT,
  `NombreMunicipio` varchar(50) DEFAULT NULL,
  `IDDepartamento` int(10) DEFAULT NULL,
  PRIMARY KEY (`IDMunicipio`),
  KEY `IDDepartamento` (`IDDepartamento`)
) ENGINE=MyISAM AUTO_INCREMENT=299 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblmunicipio`
--

INSERT INTO `tblmunicipio` (`IDMunicipio`, `NombreMunicipio`, `IDDepartamento`) VALUES
(14, 'Santa Fe', 2),
(15, 'Santa Rosa de Aguán', 2),
(16, 'Sonaguera', 2),
(17, 'Tocoa', 2),
(18, 'Bonito Oriental', 2),
(19, 'Comayagua', 3),
(20, 'Ajuterique', 3),
(21, 'El Rosario', 3),
(22, 'Esquías', 3),
(23, 'Humuya', 3),
(24, 'La libertad', 3),
(25, 'Lamaní', 3),
(26, 'La Trinidad', 3),
(27, 'Lejamani', 3),
(28, 'Meambar', 3),
(29, 'Minas de Oro', 3),
(30, 'Ojos de Agua', 3),
(31, 'San Jerónimo', 3),
(32, 'San José de Comayagua', 3),
(33, 'San José del Potrero', 3),
(1, 'La Ceiba', 1),
(2, 'El Porvenir', 1),
(3, 'Tela', 1),
(4, 'Jutiapa', 1),
(5, 'La Masica', 1),
(6, 'San Francisco', 1),
(7, 'Arizona', 1),
(8, 'Esparta', 1),
(9, 'Trujillo', 2),
(10, 'Balfate', 2),
(11, 'Iriona', 2),
(12, 'Limón', 2),
(13, 'Sabá', 2),
(34, 'San Luis', 3),
(35, 'San Sebastián', 3),
(36, 'Siguatepeque', 3),
(37, 'Villa de San Antonio', 3),
(38, 'Las Lajas', 3),
(39, 'Taulabé', 3),
(40, 'Santa Rosa de Copán', 4),
(41, 'Cabañas', 4),
(42, 'Concepción', 4),
(43, 'Copán Ruinas', 4),
(44, 'Corquín', 4),
(45, 'Cucuyagua', 4),
(46, 'Dolores', 4),
(47, 'Dulce Nombre', 4),
(48, 'El Paraíso', 4),
(49, 'Florida', 4),
(50, 'La Jigua', 4),
(51, 'La Unión', 4),
(52, 'Nueva Arcadia', 4),
(53, 'San Agustín', 4),
(54, 'San Antonio', 4),
(55, 'San Jerónimo', 4),
(56, 'San José', 4),
(57, 'San Juan de Opoa', 4),
(58, 'San Nicolás', 4),
(59, 'San Pedro', 4),
(60, 'Santa Rita', 4),
(61, 'Trinidad de Copán', 4),
(62, 'Veracruz', 4),
(63, 'San Pedro Sula', 5),
(64, 'Choloma', 5),
(65, 'Omoa', 5),
(66, 'Pimienta', 5),
(67, 'Potrerillos', 5),
(68, 'Puerto Cortés', 5),
(69, 'San Antonio de Cortés', 5),
(70, 'San Francisco de Yojoa', 5),
(71, 'San Manuel', 5),
(72, 'Santa Cruz de Yojoa', 5),
(73, 'Villanueva', 5),
(74, 'La Lima', 5),
(75, 'Choluteca', 6),
(76, 'Apacilagua', 6),
(77, 'Concepción de María', 6),
(78, 'Duyure', 6),
(79, 'El Corpus', 6),
(80, 'El Triunfo', 6),
(81, 'Marcovia', 6),
(82, 'Morolica', 6),
(83, 'Namasigue', 6),
(84, 'Orocuina', 6),
(85, 'Pespire', 6),
(86, 'San Antonio de Flores', 6),
(87, 'San Isidro', 6),
(88, 'San José', 6),
(89, 'San Marcos de Colón', 6),
(90, 'Santa Ana de Yusguare', 6),
(91, 'Yuscarán', 7),
(92, 'Alauca', 7),
(93, 'Danlí', 7),
(94, 'El Paraíso', 7),
(95, 'Güinope', 7),
(96, 'Jacaleapa', 7),
(97, 'Liure', 7),
(98, 'Morocelí', 7),
(99, 'Oropolí', 7),
(100, 'Potrerillos', 7),
(101, 'San Antonio de Flores', 7),
(102, 'San Lucas', 7),
(103, 'San Matías', 7),
(104, 'Soledad', 7),
(105, 'Teupasenti', 7),
(106, 'Texiguat', 7),
(107, 'Vado Ancho', 7),
(108, 'Yauyupe', 7),
(109, 'Trojes', 7),
(110, 'Distrito Central (Tegucigalpa)', 8),
(111, 'Alubarén', 8),
(112, 'Cedros', 8),
(113, 'Curarén', 8),
(114, 'El Porvenir', 8),
(115, 'Guaimaca', 8),
(116, 'La Libertad', 8),
(117, 'La Venta', 8),
(118, 'Lepaterique', 8),
(119, 'Maraita', 8),
(120, 'Marale', 8),
(121, 'Nueva Armenia', 8),
(122, 'Ojojona', 8),
(123, 'Orica', 8),
(124, 'Reitoca', 8),
(125, 'Sabanagrande', 8),
(126, 'San Antonio de Oriente', 8),
(127, 'San Buenaventura', 8),
(128, 'San Ignacio', 8),
(129, 'San Juan de Flores', 8),
(130, 'San Miguelito', 8),
(131, 'Santa Ana', 8),
(132, 'Santa Lucía', 8),
(133, 'Talanga', 8),
(134, 'Tatumbla', 8),
(135, 'Valle de Ángeles', 8),
(136, 'Villa de San Francisco', 8),
(137, 'Vallecillo', 8),
(138, 'Puerto Lempira', 9),
(139, 'Brus Laguna', 9),
(140, 'Ahuas', 9),
(141, 'Juan Francisco Bulnes', 9),
(142, 'Ramón Villeda Morales', 9),
(143, 'Wampusirpe', 9),
(144, 'La Esperanza', 10),
(145, 'Camasca', 10),
(146, 'Colomoncagua', 10),
(147, 'Concepción', 10),
(148, 'Dolores', 10),
(149, 'Intibucá', 10),
(150, 'Jesús de Otoro', 10),
(151, 'Magdalena', 10),
(152, 'Masaguara', 10),
(153, 'San Antonio', 10),
(154, 'San Isidro', 10),
(155, 'San Juan', 10),
(156, 'San Marcos de la Sierra', 10),
(157, 'San Miguel Guancapla', 10),
(158, 'Santa Lucía', 10),
(159, 'Yamaranguila', 10),
(160, 'San Francisco de Opalaca', 10),
(161, 'Roatán', 11),
(162, 'Guanaja', 11),
(163, 'José Santos Guardiola', 11),
(164, 'Utila', 11),
(165, 'La Paz', 12),
(166, 'Aguanqueterique', 12),
(167, 'Cabañas', 12),
(168, 'Cane', 12),
(169, 'Chinacla', 12),
(170, 'Guajiquiro', 12),
(171, 'Lauterique', 12),
(172, 'Marcala', 12),
(173, 'Mercedes de Oriente', 12),
(174, 'Opatoro', 12),
(175, 'San Antonio del Norte', 12),
(176, 'San José', 12),
(177, 'San Juan', 12),
(178, 'San Pedro de Tutule', 12),
(179, 'Santa Ana', 12),
(180, 'Santa Elena', 12),
(181, 'Santa María', 12),
(182, 'Santiago de Puringla', 12),
(183, 'Yarula', 12),
(184, 'Gracias', 13),
(185, 'Belén', 13),
(186, 'Candelaria', 13),
(187, 'Cololaca', 13),
(188, 'Erandique', 13),
(189, 'Gualcince', 13),
(190, 'Guarita', 13),
(191, 'La Campa', 13),
(192, 'La Iguala', 13),
(193, 'Las Flores', 13),
(194, 'La Unión', 13),
(195, 'La Virtud', 13),
(196, 'Lepaera', 13),
(197, 'Mapulaca', 13),
(198, 'Piraera', 13),
(199, 'San Andrés', 13),
(200, 'San Francisco', 13),
(201, 'San Juan Guarita', 13),
(202, 'San Manuel Colohete', 13),
(203, 'San Rafael', 13),
(204, 'San Sebastián', 13),
(205, 'Santa Cruz', 13),
(206, 'Talgua', 13),
(207, 'Tambla', 13),
(208, 'Tomalá', 13),
(209, 'Valladolid', 13),
(210, 'Virginia', 13),
(211, 'San Marcos de Caiquín', 13),
(212, 'Ocotepeque', 14),
(213, 'Belén Gualcho', 14),
(214, 'Concepción', 14),
(215, 'Dolores Merendón', 14),
(216, 'Fraternidad', 14),
(217, 'La Encarnación', 14),
(218, 'La Labor', 14),
(219, 'Lucerna', 14),
(220, 'Mercedes', 14),
(221, 'San Fernando', 14),
(222, 'San Francisco del Valle', 14),
(223, 'San Jorge', 14),
(224, 'San Marcos', 14),
(225, 'Santa Fe', 14),
(226, 'Sensenti', 14),
(227, 'Sinuapa', 14),
(228, 'Juticalpa', 15),
(229, 'Campamento', 15),
(230, 'Catacamas', 15),
(231, 'Concordia', 15),
(232, 'Dulce Nombre de Culmí', 15),
(233, 'El Rosario', 15),
(234, 'Esquipulas del Norte', 15),
(235, 'Gualaco', 15),
(236, 'Guarizama', 15),
(237, 'Guata', 15),
(238, 'Guayape', 15),
(239, 'Jano', 15),
(240, 'La Unión', 15),
(241, 'Mangulile', 15),
(242, 'Manto', 15),
(243, 'Salamá', 15),
(244, 'San Esteban', 15),
(245, 'San Francisco de Becerra', 15),
(246, 'San Francisco de la Paz', 15),
(247, 'Santa María del Real', 15),
(248, 'Silca', 15),
(249, 'Yocón', 15),
(250, 'Patuca', 15),
(251, 'Santa Bárbara', 16),
(252, 'Arada', 16),
(253, 'Atima', 16),
(254, 'Azacualpa', 16),
(255, 'Ceguaca', 16),
(256, 'Concepcion del Norte', 16),
(257, 'Concepción del Sur', 16),
(258, 'Chinda', 16),
(259, 'El Níspero', 16),
(260, 'Gualala', 16),
(261, 'Ilama', 16),
(262, 'Las Vegas', 16),
(263, 'Macuelizo', 16),
(264, 'Naranjito', 16),
(265, 'Nuevo Celilac', 16),
(266, 'Nueva Frontera', 16),
(267, 'Petoa', 16),
(268, 'Protección', 16),
(269, 'Quimistán', 16),
(270, 'San Francisco de Ojuera', 16),
(271, 'San José de Colinas', 16),
(272, 'San Luis', 16),
(273, 'San Marcos', 16),
(274, 'San Nicolás', 16),
(275, 'San Pedro Zacapa', 16),
(276, 'San Vicente Centenario', 16),
(277, 'Santa Rita', 16),
(278, 'Trinidad', 16),
(279, 'Nacaome', 17),
(280, 'Alianza', 17),
(281, 'Amapala', 17),
(282, 'Aramecina', 17),
(283, 'Caridad', 17),
(284, 'Goascorán', 17),
(285, 'Langue', 17),
(286, 'San Francisco de Coray', 17),
(287, 'San Lorenzo', 17),
(288, 'Yoro', 18),
(289, 'Arenal', 18),
(290, 'El Negrito', 18),
(291, 'El Progreso', 18),
(292, 'Jocón', 18),
(293, 'Morazán', 18),
(294, 'Olanchito', 18),
(295, 'Santa Rita', 18),
(296, 'Sulaco', 18),
(297, 'Victoria', 18),
(298, 'Yorito', 18);

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
-- Estructura de tabla para la tabla `tblsecciones`
--

DROP TABLE IF EXISTS `tblsecciones`;
CREATE TABLE IF NOT EXISTS `tblsecciones` (
  `IDSeccion` int(11) NOT NULL AUTO_INCREMENT,
  `nombreSeccion` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`IDSeccion`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblsecciones`
--

INSERT INTO `tblsecciones` (`IDSeccion`, `nombreSeccion`) VALUES
(1, 'I'),
(2, 'II'),
(3, 'III');

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
