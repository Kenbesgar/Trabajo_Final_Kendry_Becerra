-- Crear base de datos
CREATE DATABASE IF NOT EXISTS venta_ropa;
USE venta_ropa;

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'cliente') NOT NULL
);

-- Insertar usuario administrador
INSERT INTO usuarios (nombre_usuario, contrasena, rol) 
VALUES ('admin', MD5('admin123'), 'admin');

-- Tabla de productos
CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_producto VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    talla VARCHAR(10),
    color VARCHAR(50),
    cantidad_disponible INT NOT NULL,
    categoria VARCHAR(50)
);

-- Tabla de ventas
CREATE TABLE IF NOT EXISTS ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL,
    fecha_venta TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10, 2),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_producto) REFERENCES productos(id) ON DELETE CASCADE -- Agregar ON DELETE CASCADE
);


