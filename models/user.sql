-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 10-04-2015 a las 12:42:06
-- Versión del servidor: 5.5.41-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `singular`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(150) NOT NULL,
  `enable` tinyint(1) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `CI` varchar(10) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `salario` double DEFAULT NULL,
  `fechaRegistro` datetime NOT NULL,
  `fechaUltimoAcceso` datetime DEFAULT NULL,
  `fechaAcceso` datetime NOT NULL,
  `fk_idUser` int(11) DEFAULT NULL,
  `fk_idSucursal` int(11) NOT NULL,
  PRIMARY KEY (`idUser`),
  KEY `fk_user_user1_idx` (`fk_idUser`),
  KEY `fk_user_sucursal1_idx` (`fk_idSucursal`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`idUser`, `username`, `password`, `enable`, `role`, `apellido`, `nombre`, `CI`, `telefono`, `email`, `salario`, `fechaRegistro`, `fechaUltimoAcceso`, `fechaAcceso`, `fk_idUser`, `fk_idSucursal`) VALUES
(1, 'helier', '5629500575ffe706d9d57fca5472153e', 1, 1, 'Cortez', 'Helier', '5999242', '73221183', 'hdnymib@gmail.com', NULL, '2014-10-31 17:13:21', '2014-12-19 04:42:23', '2015-04-06 18:11:33', NULL, 1),
(2, 'erika', '99fc803d86612521f6222b9723397146', 1, 1, 'Lecoña ', 'Erika', '4846615', '77771498', '', NULL, '2014-05-26 15:46:49', '2014-12-22 08:13:42', '2015-03-23 12:57:46', NULL, 1),
(3, 'erickparcm', '131eefef31381096aac8b8b1fbdaafdb', 1, 1, 'Paredes', 'Erick', '3320192 LP', '70577783', 'erickparc@hotmail.com', NULL, '2014-10-31 17:13:21', '2014-12-18 10:08:07', '2015-03-19 09:34:01', NULL, 1),
(4, 'miriam', '27db41c5450aedffb560ecd99b5538d4', 1, 1, 'martinez', '', '123', '123', '', NULL, '2014-09-02 17:20:43', '2014-12-17 09:08:15', '2015-03-20 18:01:37', NULL, 1),
(5, 'elein', 'e10adc3949ba59abbe56e057f20f883e', 0, 3, 'CAÑAVERAL', 'ELEIN', '6874751', '00', '', NULL, '2014-10-20 13:08:10', '2014-12-22 11:15:59', '2015-03-18 08:58:35', NULL, 1),
(6, 'PEDROWU', 'e10adc3949ba59abbe56e057f20f883e', 1, 4, 'VARGAS', 'PEDRO', '6727077 ', '70150401', 'pedrovargas.dg@gmail.com', NULL, '2014-10-30 17:26:30', '2014-12-17 10:43:07', '2015-03-23 11:20:33', NULL, 1),
(7, 'DEMVER', 'cda8d509636c44e5988f04a7dec453ec', 1, 5, 'ESCOBAR', 'IVAN', '7090245', '76571553', 'ivan.demver17@gmail.com', NULL, '2014-10-30 17:31:44', '2014-11-25 08:59:43', '2015-03-23 12:23:33', NULL, 1),
(8, 'ABEL', 'e45c3160715aa0cd136b2d6b49742503', 1, 5, 'VALENCIA', 'ABEL', '6954338', '77544438', '', NULL, '2014-10-30 17:33:32', '2014-12-17 10:49:43', '2015-03-23 08:37:49', NULL, 1),
(9, 'MIGUEL', 'ff1888c2165bad08eeabb7627161c4e6', 1, 5, 'FLORES', 'MIGUEL', '6143162', '79599074', 'milkbelrous@hotmail.com', NULL, '2014-10-30 17:37:56', '2014-11-21 20:01:11', '2015-03-21 13:43:48', NULL, 1),
(10, 'JOSE', 'e10adc3949ba59abbe56e057f20f883e', 1, 4, 'HUARACHI', 'JOSE ALBERTO', '8859653', '60600515', 'jalbertohuarachi@gmail.com', NULL, '2014-10-31 12:04:06', '2014-10-31 16:35:45', '2015-03-10 14:44:59', NULL, 1),
(11, 'ISAAC', 'e38e28dbda189339e8cf6d5c15dcf56d', 1, 4, 'MELGAR', 'ISAAC ', '4690720', '77347155', 'isaac.melgar@hotmail.com', NULL, '2014-10-31 17:13:21', '2014-10-31 17:13:21', '2015-03-23 12:59:11', NULL, 1),
(12, 'edurey', '6a28dfa21f3ea9cf1b908b1e4dca6f0d', 1, 3, 'Reyes', 'Eduardo', '5991485', '70525751', '', NULL, '2014-11-11 20:07:34', '2014-11-13 08:37:26', '2014-11-13 08:37:26', NULL, 1),
(13, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 1, 2, 'demo', 'demo', '', '', '', NULL, '2014-11-20 15:58:22', '2014-10-31 17:13:21', '2014-10-31 17:13:21', NULL, 0),
(14, 'rolandocc', 'e06f1be5870ce756b542602183dede48', 1, 2, 'Condori', 'Rolando', '4882575', '79626069', 'conrolando01@gmail.com', NULL, '2014-12-06 11:10:09', '2014-12-17 08:02:01', '2015-03-23 10:20:47', NULL, 2),
(15, 'mariaisabel', '6d69d84eaa84009f7355a53b724baf8f', 1, 2, 'Herbas Garabito', 'Maria Isabel', '6591472', '60728786', 'brujita_airam@hotmail.com', NULL, '2014-12-11 16:07:23', '2014-12-12 14:39:57', '2015-03-23 08:33:54', NULL, 3),
(16, 'sergio3d', 'cc963fa9947697594e7e9d460b213c5f', 1, 1, 'Mena Arias', 'Sergio Marcelo', '6147456 L.', '77513007', 'sergio3d.mena@gmail.com', NULL, '2014-12-11 16:30:12', '2014-12-12 17:41:51', '2015-03-23 12:44:26', NULL, 3),
(17, 'leslie', 'e10adc3949ba59abbe56e057f20f883e', 1, 3, 'RAMOS DELGADO', 'LESLIE', '7031509', '79597391', 'leslieciber@hotmail.com', NULL, '2014-12-15 09:47:25', '2014-12-17 10:03:44', '2015-03-23 09:25:26', NULL, 2),
(18, 'sandy', 'e10adc3949ba59abbe56e057f20f883e', 0, 5, 'Morales Rada', 'Sandy', '8346121', '79503892', '', NULL, '2015-01-05 15:26:36', NULL, '2015-02-28 08:01:28', NULL, 3),
(19, 'jorge', '51908df75aa9185849df70b5d60f2007', 1, 2, 'Quispe Aguilar', 'Jorge Ramiro', '4893595', '78759643', '', NULL, '2015-01-05 15:28:08', NULL, '2015-03-23 08:11:08', NULL, 4),
(20, 'albarex', 'e10adc3949ba59abbe56e057f20f883e', 1, 4, 'Perez', 'Albaro', '6114734', '69824007', '', NULL, '2015-01-19 15:33:06', NULL, '2015-03-23 08:15:47', NULL, 1),
(21, 'dmiranda', 'e10adc3949ba59abbe56e057f20f883e', 1, 3, 'Miranda', 'Dayana', '9697330 Sc', '77632287', 'dayanaesther.1105@hotmail.com', NULL, '2015-02-09 16:46:32', NULL, '2015-03-23 09:45:46', NULL, 4),
(22, 'rocya', 'e10adc3949ba59abbe56e057f20f883e', 1, 3, 'Apaza', 'Rocy', '7022250 LP', '71270496', '', NULL, '2015-02-10 17:00:11', NULL, '2015-03-23 09:40:51', NULL, 1),
(23, 'erwin', 'fd8b14d90b493c6bcb9a5401b8c4c0be', 1, 5, 'cerrogrande', 'erwin', '8674358', '68578617', '', NULL, '2015-03-02 16:02:27', NULL, '2015-03-23 08:27:30', NULL, 3),
(24, 'diego', 'e10adc3949ba59abbe56e057f20f883e', 1, 5, 'villca', 'diego', '13472592', '79711509', '', NULL, '2015-03-02 16:04:15', NULL, '2015-03-17 09:00:32', NULL, 3),
(25, 'andrea', 'e10adc3949ba59abbe56e057f20f883e', 1, 5, 'cespedes', 'andrea', '9816239', '60042373', '', NULL, '2015-03-09 10:43:53', NULL, '2015-03-23 09:21:14', NULL, 4),
(26, 'eunice', 'e10adc3949ba59abbe56e057f20f883e', 0, 5, 'escobar', 'eunice', '8128611', '75523828', '', NULL, '2015-03-09 10:45:19', NULL, '2015-03-23 09:21:28', NULL, 4),
(27, 'GERMAN', '277e15a2f200970f8b598eb3907bee03', 1, 5, 'GONGORA', 'GERMAN', '7978545', '60761283', '', NULL, '2015-03-18 17:25:16', NULL, '2015-03-23 08:44:15', NULL, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
