USE MonitoreoFluvial;

-- Insertar puntos de muestreo
INSERT INTO PuntoMuestreo (nombre, rio, comuna, latitud, longitud) VALUES
('Estación Puelo Alto', 'Río Puelo', 'Cochamó', -41.516667, -72.383333),
('Estación Maullín Bajo', 'Río Maullín', 'Maullín', -41.616667, -73.600000),
('Estación Rahue Centro', 'Río Rahue', 'Osorno', -40.570000, -73.120000);

-- Insertar mediciones para 10 días
INSERT INTO Medicion (id_punto, fecha, temperatura, ph, oxigeno_disuelto, caudal, turbidez, conductividad) VALUES
(1, '2025-10-10', 12.5, 7.1, 8.3, 95.2, 3.5, 210),
(1, '2025-10-11', 12.3, 7.0, 8.1, 94.0, 3.7, 212),
(1, '2025-10-12', 12.6, 7.2, 8.0, 92.5, 4.0, 208),
(2, '2025-10-10', 13.1, 7.5, 7.9, 150.0, 6.2, 300),
(2, '2025-10-11', 13.3, 7.4, 7.8, 148.9, 6.0, 298),
(2, '2025-10-12', 13.0, 7.6, 8.1, 151.3, 5.8, 302),
(3, '2025-10-10', 11.5, 6.8, 9.0, 130.0, 4.5, 250),
(3, '2025-10-11', 11.3, 6.9, 9.2, 129.5, 4.2, 248),
(3, '2025-10-12', 11.8, 6.7, 8.9, 131.0, 4.6, 252);