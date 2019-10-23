-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 23, 2019 at 04:48 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edutecah`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarDias` ()  UPDATE tblplan SET DiasPrueba = DiasPrueba - 1 WHERE tblplan.IDTipoPlan = 1 AND DiasPrueba != '0'$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tblanuncios`
--

CREATE TABLE `tblanuncios` (
  `IDAnuncio` int(11) NOT NULL,
  `IDUsuario` int(11) NOT NULL,
  `IDInstituto` int(11) NOT NULL,
  `Anuncio` text NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblanuncios`
--

INSERT INTO `tblanuncios` (`IDAnuncio`, `IDUsuario`, `IDInstituto`, `Anuncio`, `Fecha`, `Hora`) VALUES
(1, 1, 1, 'Hola, esta es una prueba', '2019-10-23', '10:00:00'),
(2, 1, 1, 'Hola, esta es una prueba 2', '2019-10-23', '10:08:00'),
(3, 2, 1, 'Hey', '2019-10-23', '10:37:41');

-- --------------------------------------------------------

--
-- Table structure for table `tblaula`
--

CREATE TABLE `tblaula` (
  `IDAula` int(11) NOT NULL,
  `IDDocente` int(11) NOT NULL,
  `IDInstituto` int(11) NOT NULL,
  `CodigoCurso` varchar(8) NOT NULL,
  `Asignatura` varchar(30) NOT NULL,
  `IDEstado` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblaula`
--

INSERT INTO `tblaula` (`IDAula`, `IDDocente`, `IDInstituto`, `CodigoCurso`, `Asignatura`, `IDEstado`) VALUES
(1, 2, 1, 'WICWCNVT', 'Informatica', 1),
(2, 2, 1, 'WICWCNVT', 'Sociologia', 2),
(3, 2, 1, 'WICWCNVT', 'Finanzas', 2),
(4, 2, 1, 'E9I1OM6Q', 'Lo que sea', 1),
(5, 2, 1, 'KNNFIPQ1', 'Mate', 1),
(6, 2, 1, 'E9I1OM6Q', 'Otra', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategorias`
--

CREATE TABLE `tblcategorias` (
  `IDCategoria` int(10) NOT NULL,
  `Categoria` varchar(30) NOT NULL,
  `Color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcategorias`
--

INSERT INTO `tblcategorias` (`IDCategoria`, `Categoria`, `Color`) VALUES
(1, 'Ciencia', 'teal'),
(2, 'Tecnologia', 'gray'),
(3, 'Literatura', 'brown'),
(4, 'Matematica', 'blue'),
(5, 'Fisica', 'yellow'),
(6, 'Quimica', 'green'),
(7, 'Arte', 'orange');

-- --------------------------------------------------------

--
-- Table structure for table `tblcolor`
--

CREATE TABLE `tblcolor` (
  `IDColor` int(11) NOT NULL,
  `Color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcolor`
--

INSERT INTO `tblcolor` (`IDColor`, `Color`) VALUES
(1, 'teal'),
(2, 'blue'),
(3, 'orange'),
(4, 'red'),
(5, 'brown'),
(6, 'green');

-- --------------------------------------------------------

--
-- Table structure for table `tblcursos`
--

CREATE TABLE `tblcursos` (
  `IDCurso` int(11) NOT NULL,
  `NombreCurso` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcursos`
--

INSERT INTO `tblcursos` (`IDCurso`, `NombreCurso`) VALUES
(1, 'Ciclo Comun'),
(2, 'Bachillerato En Humanidades'),
(3, 'Bachillerato En Informatica'),
(4, 'Finanzas');

-- --------------------------------------------------------

--
-- Table structure for table `tblcursoxinstituto`
--

CREATE TABLE `tblcursoxinstituto` (
  `IDCurso` int(11) NOT NULL,
  `IDGrado` int(11) NOT NULL,
  `CodigoCurso` varchar(8) NOT NULL,
  `IDInstituto` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcursoxinstituto`
--

INSERT INTO `tblcursoxinstituto` (`IDCurso`, `IDGrado`, `CodigoCurso`, `IDInstituto`) VALUES
(1, 1, 'NN3NHZ0W', 1),
(1, 1, 'UI5A3B9V', 1),
(1, 3, 'KNNFIPQ1', 1),
(2, 2, 'WICWCNVT', 1),
(3, 2, 'E9I1OM6Q', 1),
(1, 1, 'Q3WUSW08', 1),
(4, 3, 'SJ9X3V22', 1),
(4, 2, 'LZ34GVZT', 1),
(4, 1, 'KL27B77S', 1),
(1, 1, 'UA1FU69C', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartamentos`
--

CREATE TABLE `tbldepartamentos` (
  `IDDepartamento` int(10) NOT NULL,
  `NombreDepartamento` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldepartamentos`
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
-- Table structure for table `tbldocxinstituto`
--

CREATE TABLE `tbldocxinstituto` (
  `IDDocente` int(10) NOT NULL,
  `IDInstituto` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldocxinstituto`
--

INSERT INTO `tbldocxinstituto` (`IDDocente`, `IDInstituto`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 2),
(5, 2),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 3),
(18, 3),
(19, 3),
(20, 3),
(21, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tblestado`
--

CREATE TABLE `tblestado` (
  `IDEstado` int(10) NOT NULL,
  `Estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblestado`
--

INSERT INTO `tblestado` (`IDEstado`, `Estado`) VALUES
(1, 'Oculta'),
(2, 'Publica');

-- --------------------------------------------------------

--
-- Table structure for table `tblgrado`
--

CREATE TABLE `tblgrado` (
  `IDGrado` int(11) NOT NULL,
  `Grado` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblgrado`
--

INSERT INTO `tblgrado` (`IDGrado`, `Grado`) VALUES
(1, 'Primero'),
(2, 'Segundo'),
(3, 'Tercero');

-- --------------------------------------------------------

--
-- Table structure for table `tblinstituto`
--

CREATE TABLE `tblinstituto` (
  `IDInstituto` int(10) NOT NULL,
  `CodigoIns` varchar(9) NOT NULL,
  `NombreIns` varchar(30) NOT NULL,
  `Pase` varchar(8) NOT NULL,
  `IDMunicipio` int(3) NOT NULL,
  `Direccion` varchar(50) NOT NULL,
  `Director` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblinstituto`
--

INSERT INTO `tblinstituto` (`IDInstituto`, `CodigoIns`, `NombreIns`, `Pase`, `IDMunicipio`, `Direccion`, `Director`) VALUES
(1, '080100001', 'Colegio 1', 'QKPN56OM', 1, 'Aqui', 1),
(2, '080100004', 'Colegio Prueba', 'W6NB5JT7', 2, 'Alla', 3),
(3, '000123451', 'Instituto Gomez', 'OP4D59XM', 110, 'col. miraflores', 17);

-- --------------------------------------------------------

--
-- Table structure for table `tbllogs`
--

CREATE TABLE `tbllogs` (
  `IDLog` int(10) NOT NULL,
  `Evento` varchar(20) NOT NULL,
  `Descripcion` varchar(60) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `IPUsuario` varchar(20) NOT NULL,
  `IDUsuario` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbllogs`
--

INSERT INTO `tbllogs` (`IDLog`, `Evento`, `Descripcion`, `Fecha`, `Hora`, `IPUsuario`, `IDUsuario`) VALUES
(1, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-01', '13:25:58', '::1', 1),
(2, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-01', '13:33:24', '::1', 1),
(3, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-01', '13:33:45', '::1', 1),
(4, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-01', '13:33:59', '::1', 1),
(5, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-01', '13:34:27', '::1', 1),
(6, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-01', '13:35:05', '::1', 1),
(7, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-02', '19:21:47', '::1', 1),
(8, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-02', '19:25:29', '::1', 1),
(9, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-02', '19:55:51', '::1', 1),
(10, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-02', '20:49:52', '::1', 1),
(11, 'Nuevo registro', 'Nuevo usuario con la direccion de correo: prueba@algo.hn', '2019-08-02', '21:55:18', '::1', 3),
(12, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-02', '21:59:17', '::1', 2),
(13, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-02', '22:01:09', '::1', 1),
(14, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-02', '22:31:06', '::1', 1),
(15, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-02', '22:43:38', '::1', 1),
(16, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-02', '22:45:24', '::1', 1),
(17, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-02', '22:57:59', '::1', 1),
(18, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-02', '23:13:22', '::1', 1),
(19, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-02', '23:15:28', '::1', 1),
(20, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-02', '23:20:16', '::1', 1),
(21, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-02', '23:21:16', '::1', 1),
(22, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-02', '23:49:38', '::1', 1),
(23, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-03', '01:03:14', '::1', 1),
(24, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-03', '01:05:57', '::1', 1),
(25, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-03', '01:07:51', '::1', 1),
(26, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-03', '10:18:52', '::1', 1),
(27, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: 5WXRGPN8', '2019-08-03', '10:29:44', '::1', 1),
(28, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: 5IHNO943', '2019-08-03', '10:31:31', '::1', 1),
(29, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: KYZXRJ7K', '2019-08-03', '10:34:24', '::1', 1),
(30, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: LRWHNWAM', '2019-08-03', '10:37:39', '::1', 1),
(31, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: JY5RJQRT', '2019-08-03', '10:39:15', '::1', 1),
(32, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: OBD5AY3T', '2019-08-03', '10:39:44', '::1', 1),
(33, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-03', '11:59:43', '::1', 2),
(34, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-03', '12:38:15', '::1', 1),
(35, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: ZW54WZK5', '2019-08-03', '12:53:37', '::1', 1),
(36, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: D2MYDJUY', '2019-08-03', '12:53:46', '::1', 1),
(37, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: C9DU8ZTG', '2019-08-03', '12:53:57', '::1', 1),
(38, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: I4EDPQD1', '2019-08-03', '12:54:10', '::1', 1),
(39, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: 8Z85FZB7', '2019-08-03', '12:54:37', '::1', 1),
(40, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: CQZ4UG6D', '2019-08-03', '12:57:42', '::1', 1),
(41, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: D004LHNS', '2019-08-03', '12:57:53', '::1', 1),
(42, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-03', '12:59:00', '::1', 2),
(43, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-03', '12:59:29', '::1', 1),
(44, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: 6M2HMOEW', '2019-08-03', '12:59:52', '::1', 1),
(45, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: KZ4MYVA8', '2019-08-03', '13:00:40', '::1', 1),
(46, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-03', '13:04:08', '::1', 1),
(47, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: 0R2W5J2O', '2019-08-03', '13:04:19', '::1', 1),
(48, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: IIPCC9QI', '2019-08-03', '13:05:53', '::1', 1),
(49, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: 38KO89CK', '2019-08-03', '13:07:54', '::1', 1),
(50, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: LW4ZA2G7', '2019-08-03', '13:08:05', '::1', 1),
(51, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: IYTE0VTF', '2019-08-03', '13:09:55', '::1', 1),
(52, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: 4M0RAM68', '2019-08-03', '13:15:48', '::1', 1),
(53, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: 8I0ZD1PD', '2019-08-03', '13:15:57', '::1', 1),
(54, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: 490TP5A3', '2019-08-03', '13:17:07', '::1', 1),
(55, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: 4H6AM678', '2019-08-03', '13:17:48', '::1', 1),
(56, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: BUX0JQC3', '2019-08-03', '13:17:57', '::1', 1),
(57, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: O3MJBVKQ', '2019-08-03', '13:18:58', '::1', 1),
(58, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: KJOKUKOZ', '2019-08-03', '13:19:54', '::1', 1),
(59, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: PDRXSUPH', '2019-08-03', '13:20:05', '::1', 1),
(60, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: 4TVTOJOU', '2019-08-03', '13:21:38', '::1', 1),
(61, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: 8U4DVL43', '2019-08-03', '13:21:47', '::1', 1),
(62, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: YQWGF20M', '2019-08-03', '13:24:19', '::1', 1),
(63, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: CV9F2BJY', '2019-08-03', '13:27:04', '::1', 1),
(64, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: P4UPIL4H', '2019-08-03', '13:27:15', '::1', 1),
(65, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-03', '13:28:04', '::1', 1),
(66, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: DEN5729G', '2019-08-03', '14:38:25', '::1', 1),
(67, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: IS0I2PVZ', '2019-08-03', '14:38:33', '::1', 1),
(68, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: UY6VCKTQ', '2019-08-03', '14:39:11', '::1', 1),
(69, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: 7FN2M19E', '2019-08-03', '14:39:19', '::1', 1),
(70, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: WO15FI3A', '2019-08-03', '14:41:26', '::1', 1),
(71, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: 0CKTBFE4', '2019-08-03', '14:41:52', '::1', 1),
(72, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: L7DMOB90', '2019-08-03', '14:43:20', '::1', 1),
(73, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: T6QAG5XL', '2019-08-03', '14:43:27', '::1', 1),
(74, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: 1XFMZQQA', '2019-08-03', '14:45:27', '::1', 1),
(75, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: 3S6Y9V8O', '2019-08-03', '14:46:07', '::1', 1),
(76, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: VXV3EGF9', '2019-08-03', '14:46:13', '::1', 1),
(77, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: WKRXXHHU', '2019-08-03', '14:50:52', '::1', 1),
(78, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: X8WI09RC', '2019-08-03', '14:50:59', '::1', 1),
(79, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: 7PKL1LKJ', '2019-08-03', '14:51:38', '::1', 1),
(80, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: ZMV1UXIJ', '2019-08-03', '14:51:45', '::1', 1),
(81, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: Y29UJJVB', '2019-08-03', '14:52:11', '::1', 1),
(82, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: QR5WBO3O', '2019-08-03', '14:52:18', '::1', 1),
(83, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: KIJQ2N74', '2019-08-03', '14:52:58', '::1', 1),
(84, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: BWGX3F08', '2019-08-03', '14:53:08', '::1', 1),
(85, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: BT0VA018', '2019-08-03', '14:59:25', '::1', 1),
(86, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: XQ3CGV1N', '2019-08-03', '14:59:27', '::1', 1),
(87, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: ZJMKOJ10', '2019-08-03', '14:59:28', '::1', 1),
(88, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: HY9C47TD', '2019-08-03', '14:59:29', '::1', 1),
(89, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: NN3NHZ0W', '2019-08-03', '15:00:57', '::1', 1),
(90, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: UI5A3B9V', '2019-08-03', '15:02:48', '::1', 1),
(91, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: KNNFIPQ1', '2019-08-03', '15:03:26', '::1', 1),
(92, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: WICWCNVT', '2019-08-03', '15:03:33', '::1', 1),
(93, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-03', '15:03:54', '::1', 2),
(94, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: HJ68HAE7', '2019-08-03', '15:04:05', '::1', 2),
(95, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-03', '19:52:33', '::1', 1),
(96, 'Inicio de sesion', 'El usuario con correo: guevara@algo.hn ha iniciado sesion', '2019-08-03', '19:57:33', '::1', 4),
(97, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-03', '20:35:04', '::1', 1),
(98, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-03', '20:37:51', '::1', 1),
(99, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-04', '01:15:29', '::1', 1),
(100, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-04', '02:49:47', '::1', 1),
(101, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-04', '03:12:50', '::1', 1),
(102, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-04', '03:16:20', '::1', 1),
(103, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-04', '03:34:52', '::1', 1),
(104, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-04', '04:57:55', '::1', 1),
(105, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: ', '2019-08-04', '05:17:12', '::1', 1),
(106, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: ', '2019-08-04', '05:17:36', '::1', 1),
(107, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: ', '2019-08-04', '05:18:03', '::1', 1),
(108, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario con id: ', '2019-08-04', '05:19:45', '::1', 1),
(109, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario con id: ', '2019-08-04', '05:21:42', '::1', 1),
(110, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario', '2019-08-04', '05:24:26', '::1', 1),
(111, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario', '2019-08-04', '05:24:34', '::1', 1),
(112, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario', '2019-08-04', '05:35:13', '::1', 1),
(113, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario', '2019-08-04', '05:35:53', '::1', 1),
(114, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario', '2019-08-04', '05:38:55', '::1', 1),
(115, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario', '2019-08-04', '05:39:06', '::1', 1),
(116, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario', '2019-08-04', '05:54:18', '::1', 1),
(117, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-04', '05:57:58', '::1', 1),
(118, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario', '2019-08-04', '05:58:10', '::1', 1),
(119, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario', '2019-08-04', '05:58:18', '::1', 1),
(120, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario', '2019-08-04', '05:58:32', '::1', 1),
(121, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario', '2019-08-04', '06:00:36', '::1', 1),
(122, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario', '2019-08-04', '06:03:54', '::1', 1),
(123, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario', '2019-08-04', '06:04:02', '::1', 1),
(124, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario', '2019-08-04', '06:07:52', '::1', 1),
(125, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario', '2019-08-04', '06:08:40', '::1', 1),
(126, 'Nuevo registro', 'Nuevo usuario con la direccion de correo: jairo@algo.hn', '2019-08-04', '07:46:46', '::1', 17),
(127, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-04', '11:25:00', '::1', 1),
(128, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario', '2019-08-04', '12:07:24', '::1', 1),
(129, 'Inicio de sesion', 'El usuario con correo: su@algo.hn ha iniciado sesion', '2019-08-04', '12:21:47', '::1', 3),
(130, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-04', '12:32:21', '::1', 1),
(131, 'Inicio de sesion', 'El usuario con correo: su@algo.hn ha iniciado sesion', '2019-08-04', '12:39:37', '::1', 3),
(132, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario', '2019-08-04', '13:46:06', '::1', 3),
(133, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario', '2019-08-04', '14:04:05', '::1', 3),
(134, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario', '2019-08-04', '14:10:39', '::1', 3),
(135, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario', '2019-08-04', '14:14:20', '::1', 3),
(136, 'Inicio de sesion', 'El usuario con correo: su@algo.hn ha iniciado sesion', '2019-08-07', '12:10:14', '::1', 3),
(137, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-07', '12:19:23', '190.53.248.215', 1),
(138, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-09', '09:03:43', '::1', 1),
(139, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-09', '09:07:13', '::1', 2),
(140, 'Nueva aula', 'Se ha registrado una nuevo aula para el curso: ', '2019-08-09', '09:07:30', '::1', 2),
(141, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-09', '09:42:10', '::1', 2),
(142, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-09', '09:44:34', '::1', 2),
(143, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-09', '09:45:14', '::1', 1),
(144, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-09', '09:48:10', '::1', 1),
(145, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-09', '09:53:52', '127.0.0.1', 1),
(146, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-09', '10:13:43', '127.0.0.1', 1),
(147, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-09', '10:14:05', '127.0.0.1', 2),
(148, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-09', '10:16:08', '127.0.0.1', 1),
(149, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-09', '10:17:48', '127.0.0.1', 2),
(150, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-09', '10:33:53', '127.0.0.1', 1),
(151, 'Inicio de sesion', 'El usuario con correo: su@algo.hn ha iniciado sesion', '2019-08-09', '10:34:12', '127.0.0.1', 3),
(152, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-09', '10:35:48', '127.0.0.1', 2),
(153, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-09', '11:29:56', '127.0.0.1', 2),
(154, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-09', '11:37:24', '::1', 2),
(155, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-09', '11:39:41', '::1', 1),
(156, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-09', '11:42:26', '::1', 1),
(157, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-09', '11:46:20', '::1', 2),
(158, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-09', '11:49:11', '::1', 2),
(159, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-09', '12:30:42', '::1', 1),
(160, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-09', '12:36:08', '::1', 2),
(161, 'Nueva aula', 'Se ha registrado una nuevo aula para el curso: ', '2019-08-09', '12:59:36', '::1', 2),
(162, 'Nueva aula', 'Se ha registrado una nuevo aula para el curso: ', '2019-08-09', '13:01:03', '::1', 2),
(163, 'Nueva aula', 'Se ha registrado una nuevo aula para el curso: ', '2019-08-09', '13:02:18', '::1', 2),
(164, 'Nueva aula', 'Se ha registrado una nuevo aula para el curso: ', '2019-08-09', '13:02:29', '::1', 2),
(165, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-10', '11:50:33', '::1', 2),
(166, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-10', '11:58:49', '::1', 2),
(167, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-10', '12:14:08', '::1', 2),
(168, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-10', '13:44:50', '::1', 2),
(169, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-10', '14:49:28', '::1', 2),
(170, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-10', '14:49:51', '::1', 1),
(171, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-10', '14:51:48', '::1', 2),
(172, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-08-13', '19:57:21', '::1', 1),
(173, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: E9I1OM6Q', '2019-08-13', '20:01:17', '::1', 1),
(174, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-13', '20:01:44', '::1', 2),
(175, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-13', '20:15:43', '::1', 2),
(176, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-13', '20:29:15', '::1', 2),
(177, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-13', '20:31:44', '::1', 2),
(178, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-13', '20:40:26', '::1', 2),
(179, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-24', '09:08:10', '::1', 2),
(180, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-08-24', '09:18:26', '::1', 2),
(181, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-09-23', '17:21:32', '::1', 1),
(182, 'Inicio de sesion', 'El usuario con correo: su@algo.hn ha iniciado sesion', '2019-09-23', '17:25:54', '::1', 3),
(183, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario', '2019-09-23', '17:27:28', '::1', 3),
(184, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario', '2019-09-23', '17:29:37', '::1', 3),
(185, 'Inicio de sesion', 'El usuario con correo: su@algo.hn ha iniciado sesion', '2019-09-23', '17:30:05', '::1', 3),
(186, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario', '2019-09-23', '17:30:15', '::1', 3),
(187, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario', '2019-09-23', '17:30:26', '::1', 3),
(188, 'Nuevos datos', 'Se ha actualizado un registro en la tabla usuario', '2019-09-23', '17:32:00', '::1', 3),
(189, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-09-23', '17:43:14', '::1', 2),
(190, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-09-23', '17:53:35', '::1', 1),
(191, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-09-23', '17:54:51', '::1', 2),
(192, 'Nuevos datos', 'Se ha actualizado un registro en la tabla aulas', '2019-09-23', '18:34:05', '::1', 1),
(193, 'Nuevos datos', 'Se ha actualizado un registro en la tabla aulas', '2019-09-23', '18:34:23', '::1', 1),
(194, 'Nuevos datos', 'Se ha actualizado un registro en la tabla aulas', '2019-09-23', '18:36:58', '::1', 1),
(195, 'Nuevos datos', 'Se ha actualizado un registro en la tabla aulas', '2019-09-23', '18:37:37', '::1', 1),
(196, 'Nuevos datos', 'Se ha actualizado un registro en la tabla aulas', '2019-09-23', '18:37:43', '::1', 1),
(197, 'Nuevos datos', 'Se ha actualizado un registro en la tabla aulas', '2019-09-23', '18:39:36', '::1', 1),
(198, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-09-23', '18:43:05', '::1', 2),
(199, 'Nuevos datos', 'Se ha actualizado un registro en la tabla aulas', '2019-09-23', '18:51:06', '::1', 1),
(200, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-09-23', '19:19:21', '::1', 2),
(201, 'Nuevos datos', 'Se ha actualizado un registro en la tabla aulas', '2019-09-23', '19:19:28', '::1', 2),
(202, 'Nuevos datos', 'Se ha actualizado un registro en la tabla aulas', '2019-09-23', '19:19:41', '::1', 2),
(203, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-10-21', '13:09:46', '::1', 1),
(204, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-10-21', '13:11:39', '::1', 1),
(205, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-10-21', '14:03:33', '::1', 1),
(206, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: Q3WUSW08', '2019-10-21', '15:34:57', '::1', 1),
(207, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-10-21', '15:40:01', '::1', 2),
(208, 'Nueva aula', 'Se ha registrado una nuevo aula para el curso: ', '2019-10-21', '15:40:33', '::1', 2),
(209, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-10-21', '16:01:10', '::1', 1),
(210, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-10-21', '16:01:29', '::1', 2),
(211, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-10-21', '16:17:59', '::1', 2),
(212, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-10-21', '16:19:31', '::1', 1),
(213, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-10-21', '16:20:45', '::1', 2),
(214, 'Nueva aula', 'Se ha registrado una nuevo aula para el curso: ', '2019-10-21', '16:20:53', '::1', 2),
(215, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-10-21', '16:55:36', '::1', 1),
(216, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-10-21', '16:59:13', '::1', 1),
(217, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-10-21', '17:00:52', '::1', 1),
(218, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-10-21', '17:23:13', '::1', 2),
(219, 'Nueva aula', 'Se ha registrado una nuevo aula para el curso: ', '2019-10-21', '17:25:49', '::1', 2),
(220, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-10-21', '17:27:03', '::1', 1),
(221, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: SJ9X3V22', '2019-10-22', '10:24:01', '::1', 1),
(222, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: LZ34GVZT', '2019-10-22', '10:25:16', '::1', 1),
(223, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: KL27B77S', '2019-10-22', '10:26:05', '::1', 1),
(224, 'Nuevo curso', 'Se ha registrado un nuevo curso con el codigo: UA1FU69C', '2019-10-22', '10:26:16', '::1', 1),
(225, 'Nuevos datos', 'Se ha actualizado un registro en la tabla aulas', '2019-10-22', '10:29:04', '::1', 1),
(226, 'Nuevos datos', 'Se ha actualizado un registro en la tabla aulas', '2019-10-22', '10:50:08', '::1', 1),
(227, 'Nuevos datos', 'Se ha actualizado un registro en la tabla aulas', '2019-10-22', '10:50:18', '::1', 1),
(228, 'Nuevos datos', 'Se ha actualizado un registro en la tabla aulas', '2019-10-22', '10:50:19', '::1', 1),
(229, 'Nuevos datos', 'Se ha actualizado un registro en la tabla aulas', '2019-10-22', '10:50:19', '::1', 1),
(230, 'Nuevos datos', 'Se ha actualizado un registro en la tabla aulas', '2019-10-22', '10:50:42', '::1', 1),
(231, 'Nuevos datos', 'Se ha actualizado un registro en la tabla aulas', '2019-10-22', '10:50:48', '::1', 1),
(232, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-10-22', '12:11:46', '::1', 1),
(233, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-10-22', '12:11:52', '::1', 1),
(234, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-10-22', '12:11:53', '::1', 1),
(235, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-10-22', '12:11:53', '::1', 1),
(236, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-10-22', '12:11:53', '::1', 1),
(237, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-10-22', '12:11:53', '::1', 1),
(238, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-10-22', '12:11:53', '::1', 1),
(239, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-10-22', '12:12:34', '::1', 1),
(240, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-10-22', '12:13:39', '::1', 1),
(241, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-10-22', '12:37:48', '::1', 1),
(242, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-10-22', '13:50:34', '::1', 1),
(243, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-10-22', '14:50:56', '::1', 1),
(244, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-10-22', '14:51:52', '::1', 2),
(245, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-10-22', '14:52:14', '::1', 1),
(246, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-10-22', '15:51:04', '::1', 1),
(247, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-10-22', '15:54:11', '::1', 2),
(248, 'Nuevos datos', 'Se ha actualizado un registro en la tabla aulas', '2019-10-22', '15:57:50', '::1', 2),
(249, 'Nuevos datos', 'Se ha actualizado un registro en la tabla aulas', '2019-10-22', '16:00:01', '::1', 2),
(250, 'Nuevos datos', 'Se ha actualizado un registro en la tabla aulas', '2019-10-22', '16:05:31', '::1', 2),
(251, 'Inicio de sesion', 'El usuario con correo: abner@algo.hn ha iniciado sesion', '2019-10-23', '09:31:05', '::1', 1),
(252, 'Inicio de sesion', 'El usuario con correo: truman@algo.hn ha iniciado sesion', '2019-10-23', '10:37:34', '::1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblmunicipio`
--

CREATE TABLE `tblmunicipio` (
  `IDMunicipio` int(10) NOT NULL,
  `NombreMunicipio` varchar(50) DEFAULT NULL,
  `IDDepartamento` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblmunicipio`
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
-- Table structure for table `tblplan`
--

CREATE TABLE `tblplan` (
  `IDPlan` int(10) NOT NULL,
  `IDTipoPlan` int(10) NOT NULL,
  `IDInstituto` int(10) NOT NULL,
  `DiasPrueba` int(2) DEFAULT NULL,
  `AulasDisponibles` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblplan`
--

INSERT INTO `tblplan` (`IDPlan`, `IDTipoPlan`, `IDInstituto`, `DiasPrueba`, `AulasDisponibles`) VALUES
(1, 1, 1, 3, 10),
(2, 1, 2, 28, 10),
(3, 1, 3, 29, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tblrecurso`
--

CREATE TABLE `tblrecurso` (
  `IDRecurso` int(11) NOT NULL,
  `IDAula` int(10) NOT NULL,
  `Titulo` varchar(45) NOT NULL,
  `Tipo` varchar(10) NOT NULL,
  `Categorias` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblrecurso`
--

INSERT INTO `tblrecurso` (`IDRecurso`, `IDAula`, `Titulo`, `Tipo`, `Categorias`) VALUES
(17, 1, 'FOXIT', '.pdf', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tbltema`
--

CREATE TABLE `tbltema` (
  `IDUsuario` int(11) NOT NULL,
  `IDColor` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltema`
--

INSERT INTO `tbltema` (`IDUsuario`, `IDColor`) VALUES
(1, 1),
(2, 1),
(3, 1),
(5, 1),
(6, 1),
(8, 1),
(20, 1),
(17, 1),
(18, 1),
(1, 1),
(2, 1),
(3, 1),
(5, 1),
(6, 1),
(8, 1),
(20, 1),
(17, 1),
(18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbltipoplan`
--

CREATE TABLE `tbltipoplan` (
  `IDTIpoPlan` int(10) NOT NULL,
  `TipoPlan` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltipoplan`
--

INSERT INTO `tbltipoplan` (`IDTIpoPlan`, `TipoPlan`) VALUES
(1, 'Prueba'),
(2, 'Básico'),
(3, 'Medio'),
(4, 'Completo');

-- --------------------------------------------------------

--
-- Table structure for table `tbltipousuario`
--

CREATE TABLE `tbltipousuario` (
  `IDTipoUs` int(10) NOT NULL,
  `Tipo` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltipousuario`
--

INSERT INTO `tbltipousuario` (`IDTipoUs`, `Tipo`) VALUES
(1, 'Admin'),
(2, 'Director'),
(3, 'Docente');

-- --------------------------------------------------------

--
-- Table structure for table `tblusuario`
--

CREATE TABLE `tblusuario` (
  `IDUsuario` int(10) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Apellido` varchar(30) NOT NULL,
  `Correo` varchar(30) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `TipoUsuario` int(10) NOT NULL,
  `Cedula` varchar(13) DEFAULT NULL,
  `Telefono` varchar(8) DEFAULT NULL,
  `Imagen` mediumblob
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusuario`
--

INSERT INTO `tblusuario` (`IDUsuario`, `Nombre`, `Apellido`, `Correo`, `Password`, `TipoUsuario`, `Cedula`, `Telefono`, `Imagen`) VALUES
(1, 'Abner', 'Betancourt', 'abner@algo.hn', '7c4a8d09ca3762af61e59520943dc26494f8941b', 2, '0801199022222', '96989852', NULL),
(2, 'Truman', 'Harper', 'truman@algo.hn', '7c4a8d09ca3762af61e59520943dc26494f8941b', 3, '0801199585855', '98969698', NULL),
(3, 'Super', 'User', 'su@algo.hn', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '0801198754185', '97854252', NULL),
(5, 'Nahun', 'Lopez', 'nahun@algo.hn', '7c4a8d09ca3762af61e59520943dc26494f8941b', 3, '0808199658472', '96325481', NULL),
(6, 'Juan', 'Zapata', 'josez@algo.hn', '7c4a8d09ca3762af61e59520943dc26494f8941b', 3, '0804196945875', '98548756', NULL),
(8, 'David', 'Garcia', 'davidg@algo.hn', '7c4a8d09ca3762af61e59520943dc26494f8941b', 3, '0816198736524', '96321458', NULL),
(20, 'Pedro', 'Picapiedra', 'yabadabadu@algo.hn', '7c4a8d09ca3762af61e59520943dc26494f8941b', 3, '0809198766881', '96587452', NULL),
(17, 'Jairo', 'Gomez', 'jairo@algo.hn', '7c4a8d09ca3762af61e59520943dc26494f8941b', 2, '0810199022443', '96584587', NULL),
(18, 'Doris', 'Garcia', 'doris@algo.hn', '7c4a8d09ca3762af61e59520943dc26494f8941b', 3, '0801199322764', '98548511', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblanuncios`
--
ALTER TABLE `tblanuncios`
  ADD PRIMARY KEY (`IDAnuncio`);

--
-- Indexes for table `tblaula`
--
ALTER TABLE `tblaula`
  ADD PRIMARY KEY (`IDAula`);

--
-- Indexes for table `tblcategorias`
--
ALTER TABLE `tblcategorias`
  ADD PRIMARY KEY (`IDCategoria`);

--
-- Indexes for table `tblcolor`
--
ALTER TABLE `tblcolor`
  ADD PRIMARY KEY (`IDColor`);

--
-- Indexes for table `tblcursos`
--
ALTER TABLE `tblcursos`
  ADD PRIMARY KEY (`IDCurso`);

--
-- Indexes for table `tbldepartamentos`
--
ALTER TABLE `tbldepartamentos`
  ADD PRIMARY KEY (`IDDepartamento`);

--
-- Indexes for table `tblestado`
--
ALTER TABLE `tblestado`
  ADD PRIMARY KEY (`IDEstado`);

--
-- Indexes for table `tblgrado`
--
ALTER TABLE `tblgrado`
  ADD PRIMARY KEY (`IDGrado`);

--
-- Indexes for table `tblinstituto`
--
ALTER TABLE `tblinstituto`
  ADD PRIMARY KEY (`IDInstituto`),
  ADD KEY `Director` (`Director`);

--
-- Indexes for table `tbllogs`
--
ALTER TABLE `tbllogs`
  ADD PRIMARY KEY (`IDLog`),
  ADD KEY `IDUsuario` (`IDUsuario`);

--
-- Indexes for table `tblmunicipio`
--
ALTER TABLE `tblmunicipio`
  ADD PRIMARY KEY (`IDMunicipio`),
  ADD KEY `IDDepartamento` (`IDDepartamento`);

--
-- Indexes for table `tblplan`
--
ALTER TABLE `tblplan`
  ADD PRIMARY KEY (`IDPlan`);

--
-- Indexes for table `tblrecurso`
--
ALTER TABLE `tblrecurso`
  ADD PRIMARY KEY (`IDRecurso`);

--
-- Indexes for table `tbltipoplan`
--
ALTER TABLE `tbltipoplan`
  ADD PRIMARY KEY (`IDTIpoPlan`);

--
-- Indexes for table `tbltipousuario`
--
ALTER TABLE `tbltipousuario`
  ADD PRIMARY KEY (`IDTipoUs`);

--
-- Indexes for table `tblusuario`
--
ALTER TABLE `tblusuario`
  ADD PRIMARY KEY (`IDUsuario`),
  ADD KEY `TipoUsuario` (`TipoUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblanuncios`
--
ALTER TABLE `tblanuncios`
  MODIFY `IDAnuncio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblaula`
--
ALTER TABLE `tblaula`
  MODIFY `IDAula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblcategorias`
--
ALTER TABLE `tblcategorias`
  MODIFY `IDCategoria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblcolor`
--
ALTER TABLE `tblcolor`
  MODIFY `IDColor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblcursos`
--
ALTER TABLE `tblcursos`
  MODIFY `IDCurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbldepartamentos`
--
ALTER TABLE `tbldepartamentos`
  MODIFY `IDDepartamento` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tblestado`
--
ALTER TABLE `tblestado`
  MODIFY `IDEstado` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblgrado`
--
ALTER TABLE `tblgrado`
  MODIFY `IDGrado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblinstituto`
--
ALTER TABLE `tblinstituto`
  MODIFY `IDInstituto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbllogs`
--
ALTER TABLE `tbllogs`
  MODIFY `IDLog` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT for table `tblmunicipio`
--
ALTER TABLE `tblmunicipio`
  MODIFY `IDMunicipio` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=299;

--
-- AUTO_INCREMENT for table `tblplan`
--
ALTER TABLE `tblplan`
  MODIFY `IDPlan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblrecurso`
--
ALTER TABLE `tblrecurso`
  MODIFY `IDRecurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbltipoplan`
--
ALTER TABLE `tbltipoplan`
  MODIFY `IDTIpoPlan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbltipousuario`
--
ALTER TABLE `tbltipousuario`
  MODIFY `IDTipoUs` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblusuario`
--
ALTER TABLE `tblusuario`
  MODIFY `IDUsuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `jobDecDiasPrueba` ON SCHEDULE EVERY 1 DAY STARTS '2019-08-01 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO CALL ActualizarDias()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
