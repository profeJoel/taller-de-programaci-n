-- Crear base de datos
CREATE DATABASE IF NOT EXISTS formulario_contacto CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE formulario_contacto;

-- Crear tabla para almacenar los mensajes
CREATE TABLE mensajes (
    id_mensaje INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    mensaje TEXT NOT NULL,
    fecha_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

