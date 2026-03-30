CREATE DATABASE IF NOT EXISTS rentacar CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE rentacar;

CREATE TABLE IF NOT EXISTS usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(120) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS vehiculo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipoVehiculo ENUM('Coche','Motocicleta') NOT NULL,
    marca VARCHAR(100) NOT NULL,
    modelo VARCHAR(100) NOT NULL,
    matricula VARCHAR(50) NOT NULL UNIQUE,
    precioDia DECIMAL(10,2) NOT NULL,
    numeroPuertas INT NULL,
    tipoCombustible VARCHAR(30) NULL,
    cilindrada INT NULL,
    incluyeCasco TINYINT(1) NULL
);