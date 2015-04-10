USE singularERP;


INSERT INTO `caja`
(`nombre`, `descripcion`, `monto`, `fechaCreacion`, `fechaUltimoMovimiento`, `enable`, `fk_idServicio`, `fk_idSucursal`, `fk_idCaja`)
VALUES
('CTP Central', NULL, 11925.5, '2014-12-22 15:15:17', NULL, 1, 2, 1, 1),
('CTP Cochabamba', 'cochabamnba', 1456.7, '2015-01-05 15:02:35', '2015-01-05 15:02:42', 1, 2, 3, 1),
('CTP El Alto', 'el alto', 6712, '2015-01-21 12:34:22', NULL, 1, 2, 2, 1),
('CTP SCZ', 'SCZ', 1431, '2015-02-09 17:27:15', '2015-02-09 17:27:24', 1, 2, 4, 1);
