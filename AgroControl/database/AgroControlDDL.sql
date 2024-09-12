CREATE DATABASE agrocontrol;
USE agrocontrol;

CREATE TABLE usuarios (
    id_usuario CHAR(10) PRIMARY KEY,
    documento varchar(10) UNIQUE,
    nombre varchar(25),
    apellido varchar(25),
    telefono varchar(10),
    direccion varchar(50),
    rol ENUM('SUPERADMIN','ADMIN','AGRICULTORES','JARDINEROS','OPERADOR MAQUINARIA','GANADEROS','ASEADOR','PERSONAL MANTENIMIENTO','MECANICO'),
    estado ENUM('ACTIVO','INACTIVO'),
    email varchar(50),
    passw varchar(80),
    imguser varchar(255) DEFAULT 'default.png'
);

CREATE TABLE maquinaria (
    id_maquinaria CHAR(10) PRIMARY KEY,
    num_serie CHAR(10) UNIQUE,
    nombre_maquinaria varchar(25),
    fabricante varchar(25),
    fecha_adquisicion DATE,
    costo_adquisicion BIGINT(20),
    tipo_maquinaria ENUM('Maquinaria Pesada','Maquinaria Ligera','Equipos Manuales','Equipos Automatizados'),
    estado_maquinaria ENUM('ACTIVA', 'INACTIVA','SUSPENDIDA', 'MANTENIMIENTO')
);

CREATE TABLE proveedores (
    id_proveedor CHAR(10) PRIMARY KEY,
    nit CHAR(9),
    nombre_proveedor varchar(25),
    codpostal VARCHAR(6),
    direccion varchar(50),
    telefono varchar(10),
    email varchar(50)
);

CREATE TABLE actividades (
    id_actividad CHAR(10) PRIMARY KEY,
    nombre_actividad VARCHAR(50),
    descripcion VARCHAR(1000),
    ubicacion VARCHAR(255),
    estado_actividad ENUM('DISPONIBLE','NO DISPONIBLE'),
    prioridad ENUM('ALTA','MEDIA','BAJA')
);


CREATE TABLE repuestos (
    id_repuesto CHAR(10) PRIMARY KEY,
    codigo CHAR(10),
    nombre_repuesto varchar(25),
    tipo_repuesto ENUM('Motor', 'Transmision','Suspension', 'Frenos', 'Electricos', 'Carroceria','Neumaticos', 'Herramientas/Taller'),
    cantidad int(10),
    precio_compra int(10),
    descripcion varchar(220),
    id_proveedor CHAR(10), 
    estado_repuesto ENUM('DISPONIBLE', 'NO DISPONIBLE', 'PEDIDO'),

    FOREIGN KEY (id_proveedor) REFERENCES proveedores(id_proveedor) ON DELETE SET NULL
);


CREATE TABLE asignaciones (
    id_asignacion CHAR(10) PRIMARY KEY,
    id_actividad CHAR(10),
    id_usuario CHAR(10),
    id_maquinaria CHAR(10),
    estado_asignacion ENUM('En progreso', 'Completada', 'Pendiente', 'Suspendida', 'Cancelada', 'Atrasada'),
    fecha_inicio DATE,
    fecha_finalizacion DATE,
    FOREIGN KEY (id_actividad) REFERENCES actividades(id_actividad) ON DELETE SET NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE SET NULL,
    FOREIGN KEY (id_maquinaria) REFERENCES maquinaria(id_maquinaria) ON DELETE SET NULL
);


CREATE TABLE mante_repuest (
    id_mante_repuest INT AUTO_INCREMENT PRIMARY KEY,
    id_asignacion CHAR(10),
    id_repuesto CHAR(10),
    cant_usada INT(11),
    FOREIGN KEY (id_asignacion) REFERENCES asignaciones(id_asignacion) ON DELETE SET NULL,
    FOREIGN KEY (id_repuesto) REFERENCES repuestos(id_repuesto) ON DELETE SET NULL
);