SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `singularERP` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;

USE `singularERP` ;

-- -----------------------------------------------------
-- Table `singularERP`.`servicio`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `singularERP`.`servicio` (
  `idServicio` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(50) NOT NULL ,
  `descripcion` VARCHAR(100) NOT NULL ,
  `enable` TINYINT(4) NOT NULL ,
  `tableName` VARCHAR(50) NOT NULL ,
  PRIMARY KEY (`idServicio`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = latin1_swedish_ci;


-- -----------------------------------------------------
-- Table `singularERP`.`sucursal`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `singularERP`.`sucursal` (
  `idSucursal` INT(11) NOT NULL AUTO_INCREMENT ,
  `codigoSucursal` VARCHAR(50) NOT NULL ,
  `nombre` VARCHAR(50) NOT NULL ,
  `descripcion` VARCHAR(100) NOT NULL ,
  `enable` TINYINT(4) NOT NULL ,
  `central` TINYINT(4) NOT NULL ,
  `gmap` VARCHAR(100) NULL DEFAULT NULL ,
  `fk_idParent` INT(11) NULL DEFAULT NULL ,
  `independiente` TINYINT(4) NULL DEFAULT NULL ,
  PRIMARY KEY (`idSucursal`) ,
  INDEX `fk_sucursal_sucursal1` (`fk_idParent` ASC) ,
  CONSTRAINT `fk_sucursal_sucursal1`
    FOREIGN KEY (`fk_idParent` )
    REFERENCES `singularERP`.`sucursal` (`idSucursal` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = latin1_swedish_ci;


-- -----------------------------------------------------
-- Table `singularERP`.`caja`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `singularERP`.`caja` (
  `idCaja` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(50) NOT NULL ,
  `descripcion` VARCHAR(100) NULL DEFAULT NULL ,
  `monto` DOUBLE(11) NOT NULL ,
  `fechaCreacion` DATETIME NOT NULL ,
  `fechaUltimoMovimiento` DATETIME NULL DEFAULT NULL ,
  `enable` TINYINT(4) NULL DEFAULT NULL ,
  `fk_idServicio` INT(11) NULL DEFAULT NULL ,
  `fk_idSucursal` INT(11) NOT NULL ,
  `fk_idCaja` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`idCaja`) ,
  INDEX `fk_caja_sucursal1_idx` (`fk_idSucursal` ASC) ,
  INDEX `fk_caja_servicio1_idx` (`fk_idServicio` ASC) ,
  INDEX `fk_caja_caja1_idx` (`fk_idCaja` ASC) ,
  CONSTRAINT `fk_caja_caja1`
    FOREIGN KEY (`fk_idCaja` )
    REFERENCES `singularERP`.`caja` (`idCaja` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_caja_servicio1`
    FOREIGN KEY (`fk_idServicio` )
    REFERENCES `singularERP`.`servicio` (`idServicio` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_caja_sucursal1`
    FOREIGN KEY (`fk_idSucursal` )
    REFERENCES `singularERP`.`sucursal` (`idSucursal` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = latin1_swedish_ci;


-- -----------------------------------------------------
-- Table `singularERP`.`tipoCliente`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `singularERP`.`tipoCliente` (
  `idTipoCliente` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idTipoCliente`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = latin1_swedish_ci;


-- -----------------------------------------------------
-- Table `singularERP`.`cliente`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `singularERP`.`cliente` (
  `idCliente` INT(11) NOT NULL AUTO_INCREMENT ,
  `fk_idTipoCliente` INT(11) NULL DEFAULT NULL ,
  `nombreCompleto` VARCHAR(100) NOT NULL ,
  `nombreNegocio` VARCHAR(100) NOT NULL ,
  `nombreResponsable` VARCHAR(100) NULL DEFAULT NULL ,
  `correo` VARCHAR(150) NULL DEFAULT NULL ,
  `fechaRegistro` DATETIME NOT NULL ,
  `telefono` VARCHAR(30) NOT NULL ,
  `direccion` VARCHAR(150) NULL DEFAULT NULL ,
  `nitCi` VARCHAR(20) NULL DEFAULT NULL ,
  `codigoCliente` VARCHAR(45) NOT NULL ,
  `enable` TINYINT(4) NOT NULL ,
  `fk_idSucursal` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`idCliente`) ,
  INDEX `fk_cliente_tipoCliente1_idx` (`fk_idTipoCliente` ASC) ,
  INDEX `fk_cliente_sucursal1_idx` (`fk_idSucursal` ASC) ,
  CONSTRAINT `fk_cliente_sucursal1`
    FOREIGN KEY (`fk_idSucursal` )
    REFERENCES `singularERP`.`sucursal` (`idSucursal` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cliente_tipoCliente1`
    FOREIGN KEY (`fk_idTipoCliente` )
    REFERENCES `singularERP`.`tipoCliente` (`idTipoCliente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = latin1_swedish_ci;


-- -----------------------------------------------------
-- Table `singularERP`.`producto`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `singularERP`.`producto` (
  `idProducto` INT(11) NOT NULL AUTO_INCREMENT ,
  `codigo` VARCHAR(50) NOT NULL ,
  `codigoPersonalizado` VARCHAR(50) NULL DEFAULT NULL ,
  `descripcion` VARCHAR(200) NULL DEFAULT NULL ,
  `nota` VARCHAR(100) NULL DEFAULT NULL ,
  `toBuy` TINYINT(4) NULL DEFAULT NULL ,
  `toSell` TINYINT(4) NULL DEFAULT NULL ,
  `importKey` VARCHAR(15) NOT NULL ,
  `cantidadPaquete` INT(11) NOT NULL ,
  `material` VARCHAR(50) NOT NULL ,
  `color` VARCHAR(50) NULL DEFAULT NULL ,
  `marca` VARCHAR(50) NULL DEFAULT NULL ,
  `familia` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idProducto`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = latin1_swedish_ci;


-- -----------------------------------------------------
-- Table `singularERP`.`user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `singularERP`.`user` (
  `idUser` INT(11) NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(20) NOT NULL ,
  `password` VARCHAR(150) NOT NULL ,
  `enable` TINYINT(4) NOT NULL ,
  `role` TINYINT(4) NOT NULL ,
  `apellido` VARCHAR(30) NOT NULL ,
  `nombre` VARCHAR(30) NULL DEFAULT NULL ,
  `CI` VARCHAR(10) NOT NULL ,
  `telefono` VARCHAR(15) NOT NULL ,
  `email` VARCHAR(50) NULL DEFAULT NULL ,
  `salario` DOUBLE(11) NULL DEFAULT NULL ,
  `fechaRegistro` DATETIME NOT NULL ,
  `fechaUltimoAcceso` DATETIME NULL DEFAULT NULL ,
  `fechaAcceso` DATETIME NOT NULL ,
  `fk_idUser` INT(11) NULL DEFAULT NULL ,
  `fk_idSucursal` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`idUser`) ,
  INDEX `fk_user_user1_idx` (`fk_idUser` ASC) ,
  INDEX `fk_user_sucursal1_idx` (`fk_idSucursal` ASC) ,
  CONSTRAINT `fk_user_sucursal1`
    FOREIGN KEY (`fk_idSucursal` )
    REFERENCES `singularERP`.`sucursal` (`idSucursal` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_user1`
    FOREIGN KEY (`fk_idUser` )
    REFERENCES `singularERP`.`user` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = latin1_swedish_ci;


-- -----------------------------------------------------
-- Table `singularERP`.`productoStock`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `singularERP`.`productoStock` (
  `idProductoStock` INT(11) NOT NULL AUTO_INCREMENT ,
  `fk_idProducto` INT(11) NOT NULL ,
  `cantidad` INT(11) NOT NULL ,
  `enable` TINYINT(4) NOT NULL ,
  `alertaCantidad` INT(11) NOT NULL ,
  `fk_idSucursal` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`idProductoStock`) ,
  INDEX `fk_productoStock_producto1_idx` (`fk_idProducto` ASC) ,
  INDEX `fk_productoStock_sucursal1` (`fk_idSucursal` ASC) ,
  CONSTRAINT `fk_productoStock_producto1`
    FOREIGN KEY (`fk_idProducto` )
    REFERENCES `singularERP`.`producto` (`idProducto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_productoStock_sucursal1`
    FOREIGN KEY (`fk_idSucursal` )
    REFERENCES `singularERP`.`sucursal` (`idSucursal` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = latin1_swedish_ci;


-- -----------------------------------------------------
-- Table `singularERP`.`movimientoStock`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `singularERP`.`movimientoStock` (
  `idMovimientoStock` INT(11) NOT NULL AUTO_INCREMENT ,
  `fk_idProducto` INT(11) NOT NULL ,
  `fk_idStockOrigen` INT(11) NULL DEFAULT NULL ,
  `fk_idStockDestino` INT(11) NULL DEFAULT NULL ,
  `time` DATETIME NOT NULL ,
  `fk_idUser` INT(11) NOT NULL ,
  `cantidad` INT(11) NOT NULL ,
  `obseraciones` VARCHAR(100) NULL DEFAULT NULL ,
  `cierre` TINYINT(4) NULL DEFAULT NULL ,
  PRIMARY KEY (`idMovimientoStock`) ,
  INDEX `fk_movimientoStock_producto1_idx` (`fk_idProducto` ASC) ,
  INDEX `fk_movimientoStock_user1_idx` (`fk_idUser` ASC) ,
  INDEX `fk_movimientoStock_productoStock1` (`fk_idStockOrigen` ASC) ,
  INDEX `fk_movimientoStock_productoStock2` (`fk_idStockDestino` ASC) ,
  CONSTRAINT `fk_movimientoStock_producto1`
    FOREIGN KEY (`fk_idProducto` )
    REFERENCES `singularERP`.`producto` (`idProducto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimientoStock_user1`
    FOREIGN KEY (`fk_idUser` )
    REFERENCES `singularERP`.`user` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimientoStock_productoStock1`
    FOREIGN KEY (`fk_idStockOrigen` )
    REFERENCES `singularERP`.`productoStock` (`idProductoStock` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimientoStock_productoStock2`
    FOREIGN KEY (`fk_idStockDestino` )
    REFERENCES `singularERP`.`productoStock` (`idProductoStock` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = latin1_swedish_ci;


-- -----------------------------------------------------
-- Table `singularERP`.`movimientoCaja`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `singularERP`.`movimientoCaja` (
  `idMovimientoCaja` INT(11) NOT NULL AUTO_INCREMENT ,
  `fk_idCajaOrigen` INT(11) NULL DEFAULT NULL ,
  `fk_idCajaDestino` INT(11) NULL DEFAULT NULL ,
  `time` DATETIME NOT NULL ,
  `fk_idUser` INT(11) NOT NULL ,
  `monto` DOUBLE(11) NOT NULL ,
  `tipoMovimiento` TINYINT(4) NOT NULL ,
  `obseraciones` VARCHAR(100) NULL DEFAULT NULL ,
  `fechaCierre` DATETIME NULL DEFAULT NULL ,
  `saldoCierre` DOUBLE(11) NULL DEFAULT NULL ,
  `correlativoCierre` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`idMovimientoCaja`) ,
  INDEX `fk_movimientoCaja_caja1_idx` (`fk_idCajaDestino` ASC) ,
  INDEX `fk_movimientoCaja_caja2_idx` (`fk_idCajaOrigen` ASC) ,
  INDEX `fk_movimientoCaja_user1_idx` (`fk_idUser` ASC) ,
  CONSTRAINT `fk_movimientoCaja_caja1`
    FOREIGN KEY (`fk_idCajaDestino` )
    REFERENCES `singularERP`.`caja` (`idCaja` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimientoCaja_caja2`
    FOREIGN KEY (`fk_idCajaOrigen` )
    REFERENCES `singularERP`.`caja` (`idCaja` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimientoCaja_user1`
    FOREIGN KEY (`fk_idUser` )
    REFERENCES `singularERP`.`user` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = latin1_swedish_ci;


-- -----------------------------------------------------
-- Table `singularERP`.`OrdenCTP`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `singularERP`.`OrdenCTP` (
  `idOrdenCTP` INT(11) NOT NULL AUTO_INCREMENT ,
  `fechaGenerada` DATETIME NOT NULL ,
  `fechaCobro` DATETIME NULL DEFAULT NULL ,
  `cfSF` TINYINT(4) NOT NULL ,
  `tipoPago` TINYINT(4) NOT NULL ,
  `fechaPlazo` DATETIME NULL DEFAULT NULL ,
  `codigoServicio` VARCHAR(100) NOT NULL ,
  `secuencia` INT(11) NOT NULL ,
  `serie` INT(11) NOT NULL ,
  `correlativo` INT(11) NOT NULL ,
  `montoVenta` DOUBLE(11) NOT NULL ,
  `montoDescuento` DOUBLE(11) NULL DEFAULT NULL ,
  `estado` TINYINT(4) NOT NULL ,
  `autorizado` VARCHAR(100) NULL DEFAULT NULL ,
  `obseraciones` VARCHAR(200) NULL DEFAULT NULL ,
  `obseracionesCaja` VARCHAR(45) NULL DEFAULT NULL ,
  `fk_idCliente` INT(11) NULL DEFAULT NULL ,
  `fk_idMovimientoCaja` INT(11) NULL DEFAULT NULL ,
  `fk_idSucursal` INT(11) NOT NULL ,
  `fk_idUserD` INT(11) NULL DEFAULT NULL ,
  `fk_idUserV` INT(11) NULL DEFAULT NULL ,
  `fk_idUserD2` INT(11) NULL DEFAULT NULL ,
  `responsable` VARCHAR(50) NULL DEFAULT NULL ,
  `telefono` VARCHAR(20) NULL DEFAULT NULL ,
  `obseracionesAdicional` VARCHAR(200) NULL DEFAULT NULL ,
  `factura` VARCHAR(200) NULL DEFAULT NULL ,
  `fk_idParent` INT(11) NULL DEFAULT NULL ,
  `tipoOrden` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`idOrdenCTP`) ,
  INDEX `fk_servicioVenta_movimientoCaja1_idx` (`fk_idMovimientoCaja` ASC) ,
  INDEX `fk_servicioVenta_cliente1_idx` (`fk_idCliente` ASC) ,
  INDEX `fk_servicioVenta_sucursal1_idx` (`fk_idSucursal` ASC) ,
  INDEX `fk_servicioVenta_user1_idx` (`fk_idUserD` ASC) ,
  INDEX `fk_servicioVenta_user2_idx` (`fk_idUserV` ASC) ,
  INDEX `fk_OrdenCTP_OrdenCTP1` (`fk_idParent` ASC) ,
  CONSTRAINT `fk_servicioVenta_cliente1`
    FOREIGN KEY (`fk_idCliente` )
    REFERENCES `singularERP`.`cliente` (`idCliente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_servicioVenta_movimientoCaja1`
    FOREIGN KEY (`fk_idMovimientoCaja` )
    REFERENCES `singularERP`.`movimientoCaja` (`idMovimientoCaja` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_servicioVenta_sucursal1`
    FOREIGN KEY (`fk_idSucursal` )
    REFERENCES `singularERP`.`sucursal` (`idSucursal` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_servicioVenta_user1`
    FOREIGN KEY (`fk_idUserD` )
    REFERENCES `singularERP`.`user` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_servicioVenta_user2`
    FOREIGN KEY (`fk_idUserV` )
    REFERENCES `singularERP`.`user` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_OrdenCTP_OrdenCTP1`
    FOREIGN KEY (`fk_idParent` )
    REFERENCES `singularERP`.`OrdenCTP` (`idOrdenCTP` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = latin1_swedish_ci;


-- -----------------------------------------------------
-- Table `singularERP`.`ordenDetalle`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `singularERP`.`ordenDetalle` (
  `idDetalleServicio` INT(11) NOT NULL AUTO_INCREMENT ,
  `fk_idProductoStock` INT(11) NOT NULL ,
  `cantidad` INT(11) NOT NULL ,
  `C` TINYINT(4) NULL DEFAULT NULL ,
  `M` TINYINT(4) NULL DEFAULT NULL ,
  `Y` TINYINT(4) NULL DEFAULT NULL ,
  `K` TINYINT(4) NULL DEFAULT NULL ,
  `trabajo` VARCHAR(30) NOT NULL ,
  `pinza` DECIMAL(10,0) NOT NULL ,
  `resolucion` DECIMAL(10,0) NOT NULL ,
  `costo` DOUBLE(11) NULL DEFAULT NULL ,
  `adicional` DOUBLE(11) NULL DEFAULT NULL ,
  `total` DOUBLE(11) NULL DEFAULT NULL ,
  `fk_idServicioVenta` INT(11) NOT NULL ,
  `fk_idMovimientoStock` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`idDetalleServicio`) ,
  INDEX `fk_detalleServicio_servicioVenta1_idx` (`fk_idServicioVenta` ASC) ,
  INDEX `fk_detalleServicio_productoStock1_idx` (`fk_idProductoStock` ASC) ,
  INDEX `fk_detalleServicio_movimientoStock1_idx` (`fk_idMovimientoStock` ASC) ,
  CONSTRAINT `fk_detalleServicio_movimientoStock1`
    FOREIGN KEY (`fk_idMovimientoStock` )
    REFERENCES `singularERP`.`movimientoStock` (`idMovimientoStock` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalleServicio_productoStock1`
    FOREIGN KEY (`fk_idProductoStock` )
    REFERENCES `singularERP`.`productoStock` (`idProductoStock` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalleServicio_servicioVenta1`
    FOREIGN KEY (`fk_idServicioVenta` )
    REFERENCES `singularERP`.`OrdenCTP` (`idOrdenCTP` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = latin1_swedish_ci;


-- -----------------------------------------------------
-- Table `singularERP`.`precioProductoOrden`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `singularERP`.`precioProductoOrden` (
  `idPrecioProductoOrden` INT(11) NOT NULL AUTO_INCREMENT ,
  `fk_idProducto` INT(11) NOT NULL ,
  `fk_idTipoCliente` INT(11) NOT NULL ,
  `hora` TIME NOT NULL ,
  `cantidad` DOUBLE(11) NOT NULL ,
  `precioSF` DOUBLE(11) NOT NULL ,
  `precioCF` DOUBLE(11) NOT NULL ,
  PRIMARY KEY (`idPrecioProductoOrden`) ,
  INDEX `fk_precioProducto_producto_idx` (`fk_idProducto` ASC) ,
  INDEX `fk_precioProductoServicio_tipoCliente1_idx` (`fk_idTipoCliente` ASC) ,
  CONSTRAINT `fk_precioProductoServicio_tipoCliente1`
    FOREIGN KEY (`fk_idTipoCliente` )
    REFERENCES `singularERP`.`tipoCliente` (`idTipoCliente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_precioProducto_producto0`
    FOREIGN KEY (`fk_idProducto` )
    REFERENCES `singularERP`.`producto` (`idProducto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = latin1_swedish_ci;


-- -----------------------------------------------------
-- Table `singularERP`.`recibo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `singularERP`.`recibo` (
  `idRecibo` INT(11) NOT NULL AUTO_INCREMENT ,
  `codigo` VARCHAR(100) NOT NULL ,
  `secuencia` INT(11) NOT NULL ,
  `fk_idSucursal` INT(11) NOT NULL ,
  `detalle` VARCHAR(500) NOT NULL ,
  `nombre` VARCHAR(50) NOT NULL ,
  `ciNit` VARCHAR(20) NOT NULL ,
  `saldo` DOUBLE(11) NOT NULL ,
  `monto` DOUBLE(11) NOT NULL ,
  `acuenta` DOUBLE(11) NOT NULL ,
  `fechaRegistro` DATETIME NOT NULL ,
  `fk_idUser` INT(11) NOT NULL ,
  `codigoVenta` VARCHAR(100) NULL DEFAULT NULL ,
  `fk_idServicio` INT(11) NOT NULL ,
  `tipoRecibo` TINYINT(4) NOT NULL ,
  `fk_idMovimientoCaja` INT(11) NOT NULL ,
  `obseraciones` VARCHAR(200) NULL DEFAULT NULL ,
  PRIMARY KEY (`idRecibo`) ,
  INDEX `fk_recibo_sucursal1_idx` (`fk_idSucursal` ASC) ,
  INDEX `fk_recibo_user1_idx` (`fk_idUser` ASC) ,
  INDEX `fk_recibo_servicio1_idx` (`fk_idServicio` ASC) ,
  INDEX `fk_recibo_movimientoCaja1_idx` (`fk_idMovimientoCaja` ASC) ,
  CONSTRAINT `fk_recibo_movimientoCaja1`
    FOREIGN KEY (`fk_idMovimientoCaja` )
    REFERENCES `singularERP`.`movimientoCaja` (`idMovimientoCaja` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_recibo_servicio1`
    FOREIGN KEY (`fk_idServicio` )
    REFERENCES `singularERP`.`servicio` (`idServicio` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_recibo_sucursal1`
    FOREIGN KEY (`fk_idSucursal` )
    REFERENCES `singularERP`.`sucursal` (`idSucursal` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_recibo_user1`
    FOREIGN KEY (`fk_idUser` )
    REFERENCES `singularERP`.`user` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = latin1_swedish_ci;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
