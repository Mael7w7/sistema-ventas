-- Base de datos: sistema_ventas
-- Ajusta el nombre si lo deseas
CREATE DATABASE IF NOT EXISTS sistema_ventas CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sistema_ventas;

-- Tabla: cliente
CREATE TABLE IF NOT EXISTS cliente (
  idcliente INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(120) NOT NULL,
  dni VARCHAR(20) NOT NULL UNIQUE,
  telefono VARCHAR(30) NULL,
  correo VARCHAR(120) NULL,
  estado TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabla: vendedor
CREATE TABLE IF NOT EXISTS vendedor (
  idvendedor INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(120) NOT NULL,
  codigo VARCHAR(40) NOT NULL UNIQUE,
  genero ENUM('M','F','O') NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabla: almacen
CREATE TABLE IF NOT EXISTS almacen (
  idalmacen INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(120) NOT NULL,
  direccion VARCHAR(200) NULL,
  area VARCHAR(80) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabla: producto
CREATE TABLE IF NOT EXISTS producto (
  idproducto INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(160) NOT NULL,
  precio DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  stock INT NOT NULL DEFAULT 0,
  tipo VARCHAR(60) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabla: producto_almacen (stock por almacén)
CREATE TABLE IF NOT EXISTS producto_almacen (
  idproducto_almacen INT AUTO_INCREMENT PRIMARY KEY,
  idproducto INT NOT NULL,
  idalmacen INT NOT NULL,
  fecha DATE NOT NULL DEFAULT (CURRENT_DATE),
  cantidad INT NOT NULL DEFAULT 0,
  UNIQUE KEY uk_producto_almacen (idproducto, idalmacen),
  CONSTRAINT fk_pa_producto FOREIGN KEY (idproducto) REFERENCES producto(idproducto) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT fk_pa_almacen FOREIGN KEY (idalmacen) REFERENCES almacen(idalmacen) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

-- Tabla: venta
CREATE TABLE IF NOT EXISTS venta (
  idventa INT AUTO_INCREMENT PRIMARY KEY,
  idcliente INT NOT NULL,
  idvendedor INT NOT NULL,
  fechahora DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  tipopago ENUM('EFECTIVO','TARJETA','TRANSFERENCIA') NOT NULL DEFAULT 'EFECTIVO',
  estado ENUM('PENDIENTE','PAGADA','ANULADA') NOT NULL DEFAULT 'PENDIENTE',
  total DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  CONSTRAINT fk_venta_cliente FOREIGN KEY (idcliente) REFERENCES cliente(idcliente) ON UPDATE CASCADE,
  CONSTRAINT fk_venta_vendedor FOREIGN KEY (idvendedor) REFERENCES vendedor(idvendedor) ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Tabla: detalle_venta
CREATE TABLE IF NOT EXISTS detalle_venta (
  iddetalle_venta INT AUTO_INCREMENT PRIMARY KEY,
  idventa INT NOT NULL,
  idproducto INT NOT NULL,
  cantidad INT NOT NULL,
  precio_unit DECIMAL(10,2) NOT NULL,
  subtotal DECIMAL(12,2) AS (cantidad * precio_unit) STORED,
  CONSTRAINT fk_detalle_venta FOREIGN KEY (idventa) REFERENCES venta(idventa) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_detalle_producto FOREIGN KEY (idproducto) REFERENCES producto(idproducto) ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Trigger para recalcular total de venta después de insertar detalle
DROP TRIGGER IF EXISTS trg_detalle_venta_ai;
DELIMITER $$
CREATE TRIGGER trg_detalle_venta_ai AFTER INSERT ON detalle_venta
FOR EACH ROW
BEGIN
  UPDATE venta v
    SET v.total = (SELECT IFNULL(SUM(subtotal),0) FROM detalle_venta dv WHERE dv.idventa = NEW.idventa)
  WHERE v.idventa = NEW.idventa;
END$$
DELIMITER ;

-- Trigger para actualizar total al eliminar detalle
DROP TRIGGER IF EXISTS trg_detalle_venta_ad;
DELIMITER $$
CREATE TRIGGER trg_detalle_venta_ad AFTER DELETE ON detalle_venta
FOR EACH ROW
BEGIN
  UPDATE venta v
    SET v.total = (SELECT IFNULL(SUM(subtotal),0) FROM detalle_venta dv WHERE dv.idventa = OLD.idventa)
  WHERE v.idventa = OLD.idventa;
END$$
DELIMITER ;
