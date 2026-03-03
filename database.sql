CREATE DATABASE IF NOT EXISTS sistema_web;
USE sistema_web;

CREATE TABLE tipo_usuario (
    id_tipo INT AUTO_INCREMENT PRIMARY KEY,
    nombre_tipo VARCHAR(50) NOT NULL
);

CREATE TABLE usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre_completo VARCHAR(100) NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    id_tipo INT,
    FOREIGN KEY (id_tipo) REFERENCES tipo_usuario(id_tipo)
);

CREATE TABLE bitacora (
    id_registro INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    fecha_acceso DATETIME DEFAULT CURRENT_TIMESTAMP,
    direccion_ip VARCHAR(45),
    exito BOOLEAN,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);

-- Datos requeridos para la práctica
INSERT INTO tipo_usuario (nombre_tipo) VALUES ('Administrador'), ('Operador'), ('Invitado');

INSERT INTO usuario (nombre_completo, correo, password, id_tipo) VALUES 
('Usuario Admin', 'admin@tecnologico.com', 'admin123', 1),
('Usuario Prueba', 'prueba@tecnologico.com', 'pass123', 2);

-- Ejemplo para la bitácora
INSERT INTO bitacora (id_usuario, direccion_ip, exito) VALUES (1, '127.0.0.1', 1), (2, '192.168.1.1', 0);