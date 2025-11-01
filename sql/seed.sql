USE sistema_ventas;

INSERT INTO cliente (nombre,dni,telefono,correo,estado) VALUES
('Juan Perez','12345678','999111222','juan@example.com',1),
('Maria Gomez','87654321','988777666','maria@example.com',1);

INSERT INTO vendedor (nombre,codigo,genero) VALUES
('Carlos Ruiz','VEN001','M'),
('Ana Lopez','VEN002','F');

INSERT INTO almacen (nombre,direccion,area) VALUES
('Central','Av. Principal 123','100m2'),
('Sucursal','Calle Secundaria 456','80m2');

INSERT INTO producto (nombre,precio,stock,tipo) VALUES
('Laptop',2500.00,0,'Electrónicos'),
('Mouse',30.00,0,'Accesorios'),
('Teclado',45.00,0,'Accesorios');

-- Cargar stock por almacén
INSERT INTO producto_almacen(idproducto,idalmacen,fecha,cantidad) VALUES
(1,1,CURRENT_DATE,10),
(2,1,CURRENT_DATE,100),
(3,2,CURRENT_DATE,50);
