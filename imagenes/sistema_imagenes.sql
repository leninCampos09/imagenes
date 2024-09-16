CREATE DATABASE sistema_imagenes;

USE sistema_imagenes;

CREATE TABLE imagenes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_imagen VARCHAR(255) NOT NULL,
    ruta_imagen VARCHAR(255) NOT NULL,
    fecha_subida TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    hash_imagen CHAR(32) AS (MD5(ruta_imagen)) PERSISTENT
);
