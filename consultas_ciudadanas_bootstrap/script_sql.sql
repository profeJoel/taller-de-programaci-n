CREATE DATABASE IF NOT EXISTS consultas_ciudadanas;
USE consultas_ciudadanas;

CREATE TABLE Ciudadano (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    rut VARCHAR(12) UNIQUE NOT NULL,
    email VARCHAR(100),
    telefono VARCHAR(20)
);

CREATE TABLE Consulta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_ciudadano INT NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    asunto VARCHAR(150) NOT NULL,
    mensaje TEXT NOT NULL,
    estado ENUM('pendiente', 'en proceso', 'resuelta') DEFAULT 'pendiente',
    respuesta TEXT,
    fecha_respuesta DATETIME,
    FOREIGN KEY (id_ciudadano) REFERENCES Ciudadano(id)
);