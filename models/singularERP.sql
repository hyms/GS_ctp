-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 07, 2015 at 02:57 PM
-- Server version: 5.5.43-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `singularERP`
--

-- --------------------------------------------------------

--
-- Table structure for table `caja`
--

CREATE TABLE IF NOT EXISTS `caja` (
  `idCaja` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `monto` double NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  `fechaUltimoMovimiento` datetime DEFAULT NULL,
  `enable` tinyint(4) DEFAULT NULL,
  `fk_idServicio` int(11) DEFAULT NULL,
  `fk_idSucursal` int(11) NOT NULL,
  `fk_idCaja` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCaja`),
  KEY `fk_caja_sucursal1_idx` (`fk_idSucursal`),
  KEY `fk_caja_servicio1_idx` (`fk_idServicio`),
  KEY `fk_caja_caja1_idx` (`fk_idCaja`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `caja`
--

INSERT INTO `caja` (`idCaja`, `nombre`, `descripcion`, `monto`, `fechaCreacion`, `fechaUltimoMovimiento`, `enable`, `fk_idServicio`, `fk_idSucursal`, `fk_idCaja`) VALUES
(1, 'administracion', NULL, 0, '2014-12-22 15:15:17', NULL, 1, NULL, 1, NULL),
(2, 'CTP Central', NULL, 0, '2014-12-22 15:15:17', NULL, 1, 2, 1, 1),
(3, 'CTP Cochabamba', 'cochabamnba', 0, '2015-01-05 15:02:35', '2015-01-05 15:02:42', 1, 2, 3, 1),
(4, 'CTP El Alto', 'el alto', 0, '2015-01-21 12:34:22', NULL, 1, 2, 2, 1),
(5, 'CTP SCZ', 'SCZ', 0, '2015-02-09 17:27:15', '2015-02-09 17:27:24', 1, 2, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cantidadPlacas`
--

CREATE TABLE IF NOT EXISTS `cantidadPlacas` (
  `idCantidadPlacas` int(11) NOT NULL AUTO_INCREMENT,
  `valor` double NOT NULL,
  `enable` tinyint(4) NOT NULL,
  PRIMARY KEY (`idCantidadPlacas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cantidadPlacas`
--

INSERT INTO `cantidadPlacas` (`idCantidadPlacas`, `valor`, `enable`) VALUES
(1, 1, 1),
(2, 25, 1),
(3, 61, 1),
(4, 121, 1),
(5, 201, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `fk_idTipoCliente` int(11) DEFAULT NULL,
  `nombreCompleto` varchar(100) NOT NULL,
  `nombreNegocio` varchar(100) NOT NULL,
  `nombreResponsable` varchar(100) DEFAULT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `fechaRegistro` datetime NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `nitCi` varchar(20) DEFAULT NULL,
  `codigoCliente` varchar(45) NOT NULL,
  `enable` tinyint(4) NOT NULL,
  `fk_idSucursal` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCliente`),
  KEY `fk_cliente_tipoCliente1_idx` (`fk_idTipoCliente`),
  KEY `fk_cliente_sucursal1_idx` (`fk_idSucursal`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `horaPlacas`
--

CREATE TABLE IF NOT EXISTS `horaPlacas` (
  `idHoraPlacas` int(11) NOT NULL AUTO_INCREMENT,
  `value` time NOT NULL,
  `enable` tinyint(4) NOT NULL,
  PRIMARY KEY (`idHoraPlacas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `horaPlacas`
--

INSERT INTO `horaPlacas` (`idHoraPlacas`, `value`, `enable`) VALUES
(1, '08:00:00', 1),
(2, '20:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `movimientoCaja`
--

CREATE TABLE IF NOT EXISTS `movimientoCaja` (
  `idMovimientoCaja` int(11) NOT NULL AUTO_INCREMENT,
  `fk_idCajaOrigen` int(11) DEFAULT NULL,
  `fk_idCajaDestino` int(11) DEFAULT NULL,
  `time` datetime NOT NULL,
  `fk_idUser` int(11) NOT NULL,
  `monto` double NOT NULL,
  `tipoMovimiento` tinyint(4) NOT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `fechaCierre` datetime DEFAULT NULL,
  `saldoCierre` double DEFAULT NULL,
  `correlativoCierre` int(11) DEFAULT NULL,
  `idParent` int(11) DEFAULT NULL,
  `nroDoc` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`idMovimientoCaja`),
  KEY `fk_movimientoCaja_caja1_idx` (`fk_idCajaDestino`),
  KEY `fk_movimientoCaja_caja2_idx` (`fk_idCajaOrigen`),
  KEY `fk_movimientoCaja_user1_idx` (`fk_idUser`),
  KEY `fk_movimientoCaja_movimientoCaja1_idx` (`idParent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Table structure for table `movimientoStock`
--

CREATE TABLE IF NOT EXISTS `movimientoStock` (
  `idMovimientoStock` int(11) NOT NULL AUTO_INCREMENT,
  `fk_idProducto` int(11) NOT NULL,
  `fk_idStockOrigen` int(11) DEFAULT NULL,
  `fk_idStockDestino` int(11) DEFAULT NULL,
  `time` datetime NOT NULL,
  `fk_idUser` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `cierre` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idMovimientoStock`),
  KEY `fk_movimientoStock_producto1_idx` (`fk_idProducto`),
  KEY `fk_movimientoStock_user1_idx` (`fk_idUser`),
  KEY `fk_movimientoStock_productoStock1_idx` (`fk_idStockOrigen`),
  KEY `fk_movimientoStock_productoStock2_idx` (`fk_idStockDestino`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `OrdenCTP`
--

CREATE TABLE IF NOT EXISTS `OrdenCTP` (
  `idOrdenCTP` int(11) NOT NULL AUTO_INCREMENT,
  `fechaGenerada` datetime NOT NULL,
  `fechaCobro` datetime DEFAULT NULL,
  `cfSF` tinyint(4) DEFAULT NULL,
  `tipoPago` tinyint(4) DEFAULT NULL,
  `fechaPlazo` datetime DEFAULT NULL,
  `codigoServicio` varchar(100) DEFAULT NULL,
  `secuencia` int(11) NOT NULL,
  `serie` int(11) NOT NULL,
  `correlativo` int(11) NOT NULL,
  `montoVenta` double DEFAULT NULL,
  `montoDescuento` double DEFAULT NULL,
  `estado` tinyint(4) NOT NULL,
  `autorizado` varchar(100) DEFAULT NULL,
  `observaciones` varchar(200) DEFAULT NULL,
  `observacionesCaja` varchar(45) DEFAULT NULL,
  `fk_idCliente` int(11) DEFAULT NULL,
  `fk_idMovimientoCaja` int(11) DEFAULT NULL,
  `fk_idSucursal` int(11) NOT NULL,
  `fk_idUserD` int(11) DEFAULT NULL,
  `fk_idUserV` int(11) DEFAULT NULL,
  `fk_idUserD2` int(11) DEFAULT NULL,
  `responsable` varchar(50) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `observacionAdicional` varchar(200) DEFAULT NULL,
  `factura` varchar(200) DEFAULT NULL,
  `fk_idParent` int(11) DEFAULT NULL,
  `tipoOrden` int(11) DEFAULT NULL,
  PRIMARY KEY (`idOrdenCTP`),
  KEY `fk_servicioVenta_movimientoCaja1_idx` (`fk_idMovimientoCaja`),
  KEY `fk_servicioVenta_cliente1_idx` (`fk_idCliente`),
  KEY `fk_servicioVenta_sucursal1_idx` (`fk_idSucursal`),
  KEY `fk_servicioVenta_user1_idx` (`fk_idUserD`),
  KEY `fk_servicioVenta_user2_idx` (`fk_idUserV`),
  KEY `fk_OrdenCTP_OrdenCTP1_idx` (`fk_idParent`),
  KEY `fk_OrdenCTP_user3_idx` (`fk_idUserD2`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `ordenDetalle`
--

CREATE TABLE IF NOT EXISTS `ordenDetalle` (
  `idOrdenDetalleServicio` int(11) NOT NULL AUTO_INCREMENT,
  `fk_idProductoStock` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `C` tinyint(4) DEFAULT NULL,
  `M` tinyint(4) DEFAULT NULL,
  `Y` tinyint(4) DEFAULT NULL,
  `K` tinyint(4) DEFAULT NULL,
  `trabajo` varchar(30) NOT NULL,
  `pinza` decimal(10,0) NOT NULL,
  `resolucion` decimal(10,0) NOT NULL,
  `costo` double DEFAULT NULL,
  `adicional` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `fk_idOrden` int(11) NOT NULL,
  `fk_idMovimientoStock` int(11) DEFAULT NULL,
  PRIMARY KEY (`idOrdenDetalleServicio`),
  KEY `fk_detalleServicio_servicioVenta1_idx` (`fk_idOrden`),
  KEY `fk_detalleServicio_productoStock1_idx` (`fk_idProductoStock`),
  KEY `fk_detalleServicio_movimientoStock1_idx` (`fk_idMovimientoStock`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `precioProductoOrden`
--

CREATE TABLE IF NOT EXISTS `precioProductoOrden` (
  `idPrecioProductoOrden` int(11) NOT NULL AUTO_INCREMENT,
  `fk_idProductoStock` int(11) NOT NULL,
  `fk_idTipoCliente` int(11) NOT NULL,
  `hora` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precioSF` double NOT NULL,
  `precioCF` double NOT NULL,
  PRIMARY KEY (`idPrecioProductoOrden`),
  KEY `fk_precioProductoServicio_tipoCliente1_idx` (`fk_idTipoCliente`),
  KEY `fk_precioProductoOrden_productoStock1_idx` (`fk_idProductoStock`),
  KEY `fk_precioProductoOrden_horaPlacas1_idx` (`hora`),
  KEY `fk_precioProductoOrden_cantidadPlacas1_idx` (`cantidad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- Table structure for table `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL,
  `codigoPersonalizado` varchar(50) DEFAULT NULL,
  `dimension` varchar(200) DEFAULT NULL,
  `toBuy` tinyint(4) DEFAULT NULL,
  `toSell` tinyint(4) DEFAULT NULL,
  `importKey` varchar(15) DEFAULT NULL,
  `cantidadPaquete` int(11) NOT NULL,
  `material` varchar(50) NOT NULL,
  `formato` varchar(50) NOT NULL,
  PRIMARY KEY (`idProducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`idProducto`, `codigo`, `codigoPersonalizado`, `dimension`, `toBuy`, `toSell`, `importKey`, `cantidadPaquete`, `material`, `formato`) VALUES
(1, 'P180', '', '(65x55x0.20)', 1, 1, '', 50, 'PLACAS CTP', 'MO020'),
(2, 'P183', '', '(45x37x0.15)', 1, 1, '', 100, 'PLACAS CTP', 'GTO46'),
(3, 'P184', '', '(51x40x0.15)', 1, 1, '', 100, 'PLACAS CTP', 'GTO52'),
(4, 'P185', '', '(52.5x49.5x0.15)', 1, 1, '', 100, 'PLACAS CTP', 'SM52'),
(5, 'P186', '', '(74.5x60.5x0.30)', 1, 1, '', 50, 'PLACAS CTP', 'ROLAND'),
(6, 'P187', '', '(79x103x0.30)', 1, 1, '', 30, 'PLACAS CTP', 'RESMA'),
(7, 'P198', '', '(74.5x93x0.30)', 1, 1, '', 30, 'PLACAS CTP', 'ROLAND +'),
(8, 'P199', '', '(84x69x0.30)', 1, 1, '', 40, 'PLACAS CTP', 'SOR');

-- --------------------------------------------------------

--
-- Table structure for table `productoStock`
--

CREATE TABLE IF NOT EXISTS `productoStock` (
  `idProductoStock` int(11) NOT NULL AUTO_INCREMENT,
  `fk_idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `enable` tinyint(4) NOT NULL,
  `alertaCantidad` int(11) NOT NULL,
  `fk_idSucursal` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProductoStock`),
  KEY `fk_productoStock_producto1_idx` (`fk_idProducto`),
  KEY `fk_productoStock_sucursal1_idx` (`fk_idSucursal`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `productoStock`
--

INSERT INTO `productoStock` (`idProductoStock`, `fk_idProducto`, `cantidad`, `enable`, `alertaCantidad`, `fk_idSucursal`) VALUES
  (1, 1, 192, 1, 5, NULL),
  (2, 2, 10, 1, 5, NULL),
  (3, 3, 20, 1, 5, NULL),
  (4, 4, 6, 1, 2, NULL),
  (5, 5, 20, 1, 5, NULL),
  (6, 6, 50, 1, 5, NULL),
  (7, 7, 18, 1, 5, NULL),
  (8, 8, 18, 1, 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `recibo`
--

CREATE TABLE IF NOT EXISTS `recibo` (
  `idRecibo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(100) NOT NULL,
  `secuencia` int(11) NOT NULL,
  `fk_idSucursal` int(11) NOT NULL,
  `detalle` varchar(500) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `ciNit` varchar(20) NOT NULL,
  `saldo` double NOT NULL,
  `monto` double NOT NULL,
  `acuenta` double NOT NULL,
  `fechaRegistro` datetime NOT NULL,
  `fk_idUser` int(11) NOT NULL,
  `codigoVenta` varchar(100) DEFAULT NULL,
  `fk_idServicio` int(11) NOT NULL,
  `tipoRecibo` tinyint(4) NOT NULL,
  `fk_idMovimientoCaja` int(11) NOT NULL,
  `observaciones` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idRecibo`),
  KEY `fk_recibo_sucursal1_idx` (`fk_idSucursal`),
  KEY `fk_recibo_user1_idx` (`fk_idUser`),
  KEY `fk_recibo_servicio1_idx` (`fk_idServicio`),
  KEY `fk_recibo_movimientoCaja1_idx` (`fk_idMovimientoCaja`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `servicio`
--

CREATE TABLE IF NOT EXISTS `servicio` (
  `idServicio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `enable` tinyint(4) NOT NULL,
  `tableName` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idServicio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `servicio`
--

INSERT INTO `servicio` (`idServicio`, `nombre`, `descripcion`, `enable`, `tableName`) VALUES
(1, 'papeles', 'venta de material', 1, ''),
(2, 'CTP', 'servicio de CTP', 1, ''),
(3, 'imprenta', 'servicio de imprenta', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `sucursal`
--

CREATE TABLE IF NOT EXISTS `sucursal` (
  `idSucursal` int(11) NOT NULL AUTO_INCREMENT,
  `codigoSucursal` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `enable` tinyint(4) NOT NULL,
  `central` tinyint(4) NOT NULL,
  `gmap` varchar(100) DEFAULT NULL,
  `fk_idParent` int(11) DEFAULT NULL,
  `independiente` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idSucursal`),
  KEY `fk_sucursal_sucursal1_idx` (`fk_idParent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sucursal`
--

INSERT INTO `sucursal` (`idSucursal`, `codigoSucursal`, `nombre`, `descripcion`, `enable`, `central`, `gmap`, `fk_idParent`, `independiente`) VALUES
(1, '01', 'la paz ', 'la paz', 1, 1, 'https://mapsengine.google.com/map/embed?mid=zrmEsoTG6JSM.k4EAih9attt4&z=18', NULL, 1),
(2, 'ea', 'El Alto', 'Villa dolores calle 5 Nro.', 1, 0, 'https://mapsengine.google.com/map/embed?mid=zrmEsoTG6JSM.kXWPEpETCSKk&z=18', NULL, 0),
(3, 'Cbba', 'Cochabamba', 'calle Ecuador 178, entre Junin y Ayacucho', 1, 0, 'https://mapsengine.google.com/map/embed?mid=zrmEsoTG6JSM.kWNpRrEvf8hk&z=18', NULL, 0),
(4, 'Scz', 'Santa Cruz', 'CALLE CAÑOTO 431, ENTRE AYACUCHO E INGAVI', 1, 0, 'https://mapsengine.google.com/map/embed?mid=zrmEsoTG6JSM.kCbDoK-i20lI&z=18', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tipoCliente`
--

CREATE TABLE IF NOT EXISTS `tipoCliente` (
  `idTipoCliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`idTipoCliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tipoCliente`
--

INSERT INTO `tipoCliente` (`idTipoCliente`, `nombre`) VALUES
(1, 'preferencial A'),
(2, 'Preferencial B'),
(3, 'nuevo');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(150) NOT NULL,
  `enable` tinyint(4) NOT NULL,
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
  `fk_idSucursal` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUser`),
  KEY `fk_user_user1_idx` (`fk_idUser`),
  KEY `fk_user_sucursal1_idx` (`fk_idSucursal`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `user`
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
(13, 'rolandocc', 'e06f1be5870ce756b542602183dede48', 1, 2, 'Condori', 'Rolando', '4882575', '79626069', 'conrolando01@gmail.com', NULL, '2014-12-06 11:10:09', '2014-12-17 08:02:01', '2015-03-23 10:20:47', NULL, 2),
(14, 'mariaisabel', '6d69d84eaa84009f7355a53b724baf8f', 1, 2, 'Herbas Garabito', 'Maria Isabel', '6591472', '60728786', 'brujita_airam@hotmail.com', NULL, '2014-12-11 16:07:23', '2014-12-12 14:39:57', '2015-03-23 08:33:54', NULL, 3),
(15, 'sergio3d', 'cc963fa9947697594e7e9d460b213c5f', 1, 1, 'Mena Arias', 'Sergio Marcelo', '6147456 L.', '77513007', 'sergio3d.mena@gmail.com', NULL, '2014-12-11 16:30:12', '2014-12-12 17:41:51', '2015-03-23 12:44:26', NULL, 3),
(16, 'leslie', 'e10adc3949ba59abbe56e057f20f883e', 1, 3, 'RAMOS DELGADO', 'LESLIE', '7031509', '79597391', 'leslieciber@hotmail.com', NULL, '2014-12-15 09:47:25', '2014-12-17 10:03:44', '2015-03-23 09:25:26', NULL, 2),
(17, 'sandy', 'e10adc3949ba59abbe56e057f20f883e', 0, 5, 'Morales Rada', 'Sandy', '8346121', '79503892', '', NULL, '2015-01-05 15:26:36', NULL, '2015-02-28 08:01:28', NULL, 3),
(18, 'jorge', '51908df75aa9185849df70b5d60f2007', 1, 2, 'Quispe Aguilar', 'Jorge Ramiro', '4893595', '78759643', '', NULL, '2015-01-05 15:28:08', NULL, '2015-03-23 08:11:08', NULL, 4),
(19, 'albarex', 'e10adc3949ba59abbe56e057f20f883e', 1, 4, 'Perez', 'Albaro', '6114734', '69824007', '', NULL, '2015-01-19 15:33:06', NULL, '2015-03-23 08:15:47', NULL, 1),
(20, 'dmiranda', 'e10adc3949ba59abbe56e057f20f883e', 1, 3, 'Miranda', 'Dayana', '9697330 Sc', '77632287', 'dayanaesther.1105@hotmail.com', NULL, '2015-02-09 16:46:32', NULL, '2015-03-23 09:45:46', NULL, 4),
(21, 'rocya', 'e10adc3949ba59abbe56e057f20f883e', 1, 3, 'Apaza', 'Rocy', '7022250 LP', '71270496', '', NULL, '2015-02-10 17:00:11', NULL, '2015-03-23 09:40:51', NULL, 1),
(22, 'erwin', 'fd8b14d90b493c6bcb9a5401b8c4c0be', 1, 5, 'cerrogrande', 'erwin', '8674358', '68578617', '', NULL, '2015-03-02 16:02:27', NULL, '2015-03-23 08:27:30', NULL, 3),
(23, 'diego', 'e10adc3949ba59abbe56e057f20f883e', 1, 5, 'villca', 'diego', '13472592', '79711509', '', NULL, '2015-03-02 16:04:15', NULL, '2015-03-17 09:00:32', NULL, 3),
(24, 'andrea', 'e10adc3949ba59abbe56e057f20f883e', 1, 5, 'cespedes', 'andrea', '9816239', '60042373', '', NULL, '2015-03-09 10:43:53', NULL, '2015-03-23 09:21:14', NULL, 4),
(25, 'eunice', 'e10adc3949ba59abbe56e057f20f883e', 0, 5, 'escobar', 'eunice', '8128611', '75523828', '', NULL, '2015-03-09 10:45:19', NULL, '2015-03-23 09:21:28', NULL, 4),
(26, 'GERMAN', '277e15a2f200970f8b598eb3907bee03', 1, 5, 'GONGORA', 'GERMAN', '7978545', '60761283', '', NULL, '2015-03-18 17:25:16', NULL, '2015-03-23 08:44:15', NULL, 3);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `caja`
--
ALTER TABLE `caja`
  ADD CONSTRAINT `fk_caja_caja1` FOREIGN KEY (`fk_idCaja`) REFERENCES `caja` (`idCaja`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_caja_servicio1` FOREIGN KEY (`fk_idServicio`) REFERENCES `servicio` (`idServicio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_caja_sucursal1` FOREIGN KEY (`fk_idSucursal`) REFERENCES `sucursal` (`idSucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_cliente_sucursal1` FOREIGN KEY (`fk_idSucursal`) REFERENCES `sucursal` (`idSucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cliente_tipoCliente1` FOREIGN KEY (`fk_idTipoCliente`) REFERENCES `tipoCliente` (`idTipoCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `movimientoCaja`
--
ALTER TABLE `movimientoCaja`
  ADD CONSTRAINT `fk_movimientoCaja_caja1` FOREIGN KEY (`fk_idCajaDestino`) REFERENCES `caja` (`idCaja`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movimientoCaja_caja2` FOREIGN KEY (`fk_idCajaOrigen`) REFERENCES `caja` (`idCaja`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movimientoCaja_movimientoCaja1` FOREIGN KEY (`idParent`) REFERENCES `movimientoCaja` (`idMovimientoCaja`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movimientoCaja_user1` FOREIGN KEY (`fk_idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `movimientoStock`
--
ALTER TABLE `movimientoStock`
  ADD CONSTRAINT `fk_movimientoStock_producto1` FOREIGN KEY (`fk_idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movimientoStock_productoStock1` FOREIGN KEY (`fk_idStockOrigen`) REFERENCES `productoStock` (`idProductoStock`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movimientoStock_productoStock2` FOREIGN KEY (`fk_idStockDestino`) REFERENCES `productoStock` (`idProductoStock`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movimientoStock_user1` FOREIGN KEY (`fk_idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `OrdenCTP`
--
ALTER TABLE `OrdenCTP`
  ADD CONSTRAINT `fk_OrdenCTP_cliente1` FOREIGN KEY (`fk_idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_OrdenCTP_movimientoCaja1` FOREIGN KEY (`fk_idMovimientoCaja`) REFERENCES `movimientoCaja` (`idMovimientoCaja`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_OrdenCTP_OrdenCTP1` FOREIGN KEY (`fk_idParent`) REFERENCES `OrdenCTP` (`idOrdenCTP`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_OrdenCTP_user1` FOREIGN KEY (`fk_idUserD`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_OrdenCTP_user2` FOREIGN KEY (`fk_idUserV`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_OrdenCTP_user3` FOREIGN KEY (`fk_idUserD2`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_servicioVenta_sucursal1` FOREIGN KEY (`fk_idSucursal`) REFERENCES `sucursal` (`idSucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ordenDetalle`
--
ALTER TABLE `ordenDetalle`
  ADD CONSTRAINT `fk_detalleServicio_movimientoStock1` FOREIGN KEY (`fk_idMovimientoStock`) REFERENCES `movimientoStock` (`idMovimientoStock`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalleServicio_productoStock1` FOREIGN KEY (`fk_idProductoStock`) REFERENCES `productoStock` (`idProductoStock`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalleServicio_servicioVenta1` FOREIGN KEY (`fk_idOrden`) REFERENCES `OrdenCTP` (`idOrdenCTP`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `precioProductoOrden`
--
ALTER TABLE `precioProductoOrden`
  ADD CONSTRAINT `fk_precioProductoOrden_cantidadPlacas1` FOREIGN KEY (`cantidad`) REFERENCES `cantidadPlacas` (`idCantidadPlacas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_precioProductoOrden_horaPlacas1` FOREIGN KEY (`hora`) REFERENCES `horaPlacas` (`idHoraPlacas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_precioProductoOrden_productoStock1` FOREIGN KEY (`fk_idProductoStock`) REFERENCES `productoStock` (`idProductoStock`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_precioProductoServicio_tipoCliente1` FOREIGN KEY (`fk_idTipoCliente`) REFERENCES `tipoCliente` (`idTipoCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `productoStock`
--
ALTER TABLE `productoStock`
  ADD CONSTRAINT `fk_productoStock_producto1` FOREIGN KEY (`fk_idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productoStock_sucursal1` FOREIGN KEY (`fk_idSucursal`) REFERENCES `sucursal` (`idSucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `recibo`
--
ALTER TABLE `recibo`
  ADD CONSTRAINT `fk_recibo_movimientoCaja1` FOREIGN KEY (`fk_idMovimientoCaja`) REFERENCES `movimientoCaja` (`idMovimientoCaja`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_recibo_servicio1` FOREIGN KEY (`fk_idServicio`) REFERENCES `servicio` (`idServicio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_recibo_sucursal1` FOREIGN KEY (`fk_idSucursal`) REFERENCES `sucursal` (`idSucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_recibo_user1` FOREIGN KEY (`fk_idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sucursal`
--
ALTER TABLE `sucursal`
  ADD CONSTRAINT `fk_sucursal_sucursal1` FOREIGN KEY (`fk_idParent`) REFERENCES `sucursal` (`idSucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_sucursal1` FOREIGN KEY (`fk_idSucursal`) REFERENCES `sucursal` (`idSucursal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
