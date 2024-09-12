-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-09-2024 a las 03:54:25
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agrocontrol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id_actividad` char(10) NOT NULL,
  `nombre_actividad` varchar(50) DEFAULT NULL,
  `descripcion` varchar(1000) DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `estado_actividad` enum('DISPONIBLE','NO DISPONIBLE') DEFAULT NULL,
  `prioridad` enum('ALTA','MEDIA','BAJA') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id_actividad`, `nombre_actividad`, `descripcion`, `ubicacion`, `estado_actividad`, `prioridad`) VALUES
('gFiJPr0B1w', 'Pastorear el ganado', 'sacar el ganado de las cercas', 'Establo A1', 'DISPONIBLE', 'MEDIA'),
('Log6ujZUCX', 'Recoger la tierra abonada', 'los jardineros deben recoger la tierra abonada', 'Jardin trasero', 'DISPONIBLE', 'MEDIA'),
('xEld6nCFVL', 'Reparar fallas en el tractor', 'reparar las fallas encontradas', 'garaje principal', 'DISPONIBLE', 'ALTA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones`
--

CREATE TABLE `asignaciones` (
  `id_asignacion` char(10) NOT NULL,
  `id_actividad` char(10) DEFAULT NULL,
  `id_usuario` char(10) DEFAULT NULL,
  `id_maquinaria` char(10) DEFAULT NULL,
  `estado_asignacion` enum('En progreso','Completada','Pendiente','Suspendida','Cancelada','Atrasada') DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_finalizacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignaciones`
--

INSERT INTO `asignaciones` (`id_asignacion`, `id_actividad`, `id_usuario`, `id_maquinaria`, `estado_asignacion`, `fecha_inicio`, `fecha_finalizacion`) VALUES
('aCj2ocVHck', 'xEld6nCFVL', 'bFeLsc37vz', 'WaCUXJjyQ7', 'Completada', '2024-01-24', '2024-01-28'),
('c85h5YAT8P', 'Log6ujZUCX', 'XqS3OKfJV3', 'SSDOHOmA3p', 'Completada', '2024-06-10', '2024-06-10'),
('Qxp1V7pq6k', 'gFiJPr0B1w', 'XqS3OKfJV3', 'SSDOHOmA3p', 'Completada', '2024-01-23', '2024-01-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mante_repuest`
--

CREATE TABLE `mante_repuest` (
  `id_mante_repuest` int(11) NOT NULL,
  `id_asignacion` char(10) DEFAULT NULL,
  `id_repuesto` char(10) DEFAULT NULL,
  `cant_usada` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mante_repuest`
--

INSERT INTO `mante_repuest` (`id_mante_repuest`, `id_asignacion`, `id_repuesto`, `cant_usada`) VALUES
(1, 'aCj2ocVHck', 'mXbneHwOlU', 3),
(2, 'aCj2ocVHck', 'GNCrhnh7cB', 1),
(3, 'aCj2ocVHck', 'mXbneHwOlU', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinaria`
--

CREATE TABLE `maquinaria` (
  `id_maquinaria` char(10) NOT NULL,
  `num_serie` char(10) DEFAULT NULL,
  `nombre_maquinaria` varchar(25) DEFAULT NULL,
  `fabricante` varchar(25) DEFAULT NULL,
  `fecha_adquisicion` date DEFAULT NULL,
  `costo_adquisicion` bigint(20) DEFAULT NULL,
  `tipo_maquinaria` enum('Maquinaria Pesada','Maquinaria Ligera','Equipos Manuales','Equipos Automatizados') DEFAULT NULL,
  `estado_maquinaria` enum('ACTIVA','INACTIVA','SUSPENDIDA','MANTENIMIENTO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `maquinaria`
--

INSERT INTO `maquinaria` (`id_maquinaria`, `num_serie`, `nombre_maquinaria`, `fabricante`, `fecha_adquisicion`, `costo_adquisicion`, `tipo_maquinaria`, `estado_maquinaria`) VALUES
('SSDOHOmA3p', '098776', 'Cosechadora FP87G', 'HansBurgh', '2024-01-11', 100000000, 'Maquinaria Pesada', 'ACTIVA'),
('WaCUXJjyQ7', '23479', 'Tractor', 'Etore Bugatti', '2024-01-07', 720000000, 'Maquinaria Pesada', 'ACTIVA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` char(10) NOT NULL,
  `nit` char(9) DEFAULT NULL,
  `nombre_proveedor` varchar(25) DEFAULT NULL,
  `codpostal` varchar(6) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nit`, `nombre_proveedor`, `codpostal`, `direccion`, `telefono`, `email`) VALUES
('COEMTskqPT', '987654', 'Chevrolet', '100008', 'GM Industries USA', '5550000', 'cheGM@cars.com'),
('qsn56DZv8D', '2139123', 'Savake Colombia', '100110', 'Bogota calle 64 #73-12', '3123982', 'savake@colombia.agro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repuestos`
--

CREATE TABLE `repuestos` (
  `id_repuesto` char(10) NOT NULL,
  `codigo` char(10) DEFAULT NULL,
  `nombre_repuesto` varchar(25) DEFAULT NULL,
  `tipo_repuesto` enum('Motor','Transmision','Suspension','Frenos','Electricos','Carroceria','Neumaticos','Herramientas/Taller') DEFAULT NULL,
  `cantidad` int(10) DEFAULT NULL,
  `precio_compra` int(10) DEFAULT NULL,
  `descripcion` varchar(220) DEFAULT NULL,
  `id_proveedor` char(10) DEFAULT NULL,
  `estado_repuesto` enum('DISPONIBLE','NO DISPONIBLE','PEDIDO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `repuestos`
--

INSERT INTO `repuestos` (`id_repuesto`, `codigo`, `nombre_repuesto`, `tipo_repuesto`, `cantidad`, `precio_compra`, `descripcion`, `id_proveedor`, `estado_repuesto`) VALUES
('GNCrhnh7cB', '231321', 'Motor 6cyl', 'Motor', 0, 7200000, 'motor para tractor', 'COEMTskqPT', 'NO DISPONIBLE'),
('mXbneHwOlU', '55555', 'Podadora', 'Carroceria', 4, 1000000, 'Podadora turbo ultramax sayayin 4', 'qsn56DZv8D', 'DISPONIBLE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` char(10) NOT NULL,
  `documento` varchar(10) DEFAULT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `apellido` varchar(25) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `rol` enum('SUPERADMIN','ADMIN','AGRICULTORES','JARDINEROS','OPERADOR MAQUINARIA','GANADEROS','ASEADOR','PERSONAL MANTENIMIENTO','MECANICO') DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO') DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `passw` varchar(80) DEFAULT NULL,
  `imguser` varchar(255) DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `documento`, `nombre`, `apellido`, `telefono`, `direccion`, `rol`, `estado`, `email`, `passw`, `imguser`) VALUES
('bFeLsc37vz', '1088004611', 'Juan pancho', 'el mecanico', '359238', 'Calle 20', 'MECANICO', 'ACTIVO', 'EndlessNight@tuner.com', 'c4ca4238a0b923820dcc509a6f75849b', 'default.png'),
('ihKyu6nazC', '7463276429', 'Sebastian', 'Garcia Murillo', '3001238132', 'Parque Industrial', 'ADMIN', 'ACTIVO', 'garcia@mail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'default.png'),
('KING027JSX', '1111661815', 'Juan Sebastian', 'Pechene Colorado', '3212272155', 'Ulloa - Valle', 'SUPERADMIN', 'ACTIVO', 'sebas@mail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'UserImg@KING027JSX-ProfilePIC.png'),
('pgSZRc9VnA', '1070467254', 'Andrey Johan', 'Franco Bernal', '320123102', 'Pereira Risaralda', 'SUPERADMIN', 'ACTIVO', 'andrey@mail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'default.png'),
('Vack4fnjmt', '2312312', 'Juan David', 'Monsalve', '3113437503', 'Cartago', 'SUPERADMIN', 'ACTIVO', 'monso@mail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'default.png'),
('XqS3OKfJV3', '1088004610', 'Oscar Andres', 'Loaiza Pabon', '321321', 'Pereira Risaralda', 'JARDINEROS', 'ACTIVO', 'oscar@mail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'default.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id_actividad`);

--
-- Indices de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD PRIMARY KEY (`id_asignacion`),
  ADD KEY `id_actividad` (`id_actividad`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_maquinaria` (`id_maquinaria`);

--
-- Indices de la tabla `mante_repuest`
--
ALTER TABLE `mante_repuest`
  ADD PRIMARY KEY (`id_mante_repuest`),
  ADD KEY `id_asignacion` (`id_asignacion`),
  ADD KEY `id_repuesto` (`id_repuesto`);

--
-- Indices de la tabla `maquinaria`
--
ALTER TABLE `maquinaria`
  ADD PRIMARY KEY (`id_maquinaria`),
  ADD UNIQUE KEY `num_serie` (`num_serie`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `repuestos`
--
ALTER TABLE `repuestos`
  ADD PRIMARY KEY (`id_repuesto`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `documento` (`documento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mante_repuest`
--
ALTER TABLE `mante_repuest`
  MODIFY `id_mante_repuest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD CONSTRAINT `asignaciones_ibfk_1` FOREIGN KEY (`id_actividad`) REFERENCES `actividades` (`id_actividad`) ON DELETE SET NULL,
  ADD CONSTRAINT `asignaciones_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL,
  ADD CONSTRAINT `asignaciones_ibfk_3` FOREIGN KEY (`id_maquinaria`) REFERENCES `maquinaria` (`id_maquinaria`) ON DELETE SET NULL;

--
-- Filtros para la tabla `mante_repuest`
--
ALTER TABLE `mante_repuest`
  ADD CONSTRAINT `mante_repuest_ibfk_1` FOREIGN KEY (`id_asignacion`) REFERENCES `asignaciones` (`id_asignacion`) ON DELETE SET NULL,
  ADD CONSTRAINT `mante_repuest_ibfk_2` FOREIGN KEY (`id_repuesto`) REFERENCES `repuestos` (`id_repuesto`) ON DELETE SET NULL;

--
-- Filtros para la tabla `repuestos`
--
ALTER TABLE `repuestos`
  ADD CONSTRAINT `repuestos_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
