-- Creación de la base de datos
CREATE DATABASE IF NOT EXISTS LIBRERIA;

-- Usar la base de datos
USE LIBRERIA;

-- Creación de la tabla USUARIOS
CREATE TABLE IF NOT EXISTS USUARIOS (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    telefono VARCHAR(20)
);
