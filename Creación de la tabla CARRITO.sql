-- Creación de la tabla CARRITO
CREATE TABLE IF NOT EXISTS CARRITO (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    libro_id INT NOT NULL,
    cantidad INT NOT NULL,
    monto_total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES USUARIOS(id),
    FOREIGN KEY (libro_id) REFERENCES LIBROS(id)
);
