use singularERP;

INSERT INTO `sucursal`
(`idSucursal`, `codigoSucursal`, `nombre`, `descripcion`, `enable`, `central`, `gmap`,`fk_idParent`,`independiente`)
VALUES
(1, 'clz', 'La Paz', 'Ubicada en la Juan de la Riva Nro. 1567', 1, 1, 'https://mapsengine.google.com/map/embed?mid=zrmEsoTG6JSM.k4EAih9attt4&z=18',NULL,0),
(2, 'ea', 'El Alto', 'Villa dolores calle 5 Nro.', 1, 0, 'https://mapsengine.google.com/map/embed?mid=zrmEsoTG6JSM.kXWPEpETCSKk&z=18',NULL,0),
(3, 'Cbba', 'Cochabamba', 'calle Ecuador 178, entre Junin y Ayacucho', 1, 0, 'https://mapsengine.google.com/map/embed?mid=zrmEsoTG6JSM.kWNpRrEvf8hk&z=18',NULL,0),
(4, 'Scz', 'Santa Cruz', 'CALLE CAÑOTO 431, ENTRE AYACUCHO E INGAVI', 1, 0, 'https://mapsengine.google.com/map/embed?mid=zrmEsoTG6JSM.kCbDoK-i20lI&z=18',NULL,0);
