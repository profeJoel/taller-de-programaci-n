-- Base de datos para monitoreo ambiental de ríos
CREATE DATABASE IF NOT EXISTS MonitoreoFluvial;
USE MonitoreoFluvial;

-- Tabla de puntos de muestreo
CREATE TABLE PuntoMuestreo (
    id_punto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    rio VARCHAR(100),
    comuna VARCHAR(100),
    latitud DECIMAL(10, 7),
    longitud DECIMAL(10, 7)
);

-- Tabla de mediciones diarias
CREATE TABLE Medicion (
    id_medicion INT AUTO_INCREMENT PRIMARY KEY,
    id_punto INT,
    fecha DATE,
    temperatura DECIMAL(5,2),
    ph DECIMAL(4,2),
    oxigeno_disuelto DECIMAL(5,2),
    caudal DECIMAL(6,2),
    turbidez DECIMAL(6,2),
    conductividad DECIMAL(6,2),
    FOREIGN KEY (id_punto) REFERENCES PuntoMuestreo(id_punto)
);