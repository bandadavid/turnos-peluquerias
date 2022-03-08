-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-03-2022 a las 13:28:16
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `peluqueria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disponibilidad`
--

CREATE TABLE `disponibilidad` (
  `codigo_dis` bigint(11) NOT NULL,
  `fecha_dis` date DEFAULT NULL,
  `hora_inicio_dis` time DEFAULT NULL,
  `hora_fin_dis` time DEFAULT NULL,
  `creacion_dis` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `disponibilidad`
--

INSERT INTO `disponibilidad` (`codigo_dis`, `fecha_dis`, `hora_inicio_dis`, `hora_fin_dis`, `creacion_dis`) VALUES
(12, '2021-03-18', '15:00:00', '17:00:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `codigo_res` bigint(11) NOT NULL,
  `fecha_hora_inicio_res` datetime DEFAULT NULL,
  `apellido_res` varchar(500) DEFAULT NULL,
  `nombre_res` varchar(500) DEFAULT NULL,
  `celular_res` varchar(15) DEFAULT NULL,
  `estado_res` varchar(50) DEFAULT 'ACTIVO',
  `fk_codigo_ser` bigint(11) DEFAULT NULL,
  `creacion_res` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`codigo_res`, `fecha_hora_inicio_res`, `apellido_res`, `nombre_res`, `celular_res`, `estado_res`, `fk_codigo_ser`, `creacion_res`) VALUES
(9, '2022-03-06 16:30:00', 'Toapanta', 'Erika', '0987654321', 'ACTIVO', 2, '2022-03-04 21:34:28'),
(10, '2022-03-06 17:30:00', 'Ruiz', 'David', '0987654321', 'ACTIVO', 1, '2022-03-05 11:56:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `codigo_ser` bigint(11) NOT NULL,
  `nombre_ser` varchar(500) DEFAULT NULL,
  `descripcion_ser` varchar(3000) DEFAULT NULL,
  `precio_ser` varchar(500) DEFAULT NULL,
  `foto_ser` varchar(500) DEFAULT NULL,
  `creacion_ser` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`codigo_ser`, `nombre_ser`, `descripcion_ser`, `precio_ser`, `foto_ser`, `creacion_ser`) VALUES
(1, 'CORTE DE CABELLO HOMBRE', 'Cortada de cabellocon tijeras', '3', 'f2076-f3.jpg', '2022-02-21 00:00:00'),
(2, 'PERMANENTE RIZADO', 'Rizado permanente', '15', '72c60-f4.jpg', '2022-02-21 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `codigo_usu` bigint(11) NOT NULL,
  `usuario_usu` varchar(100) DEFAULT NULL,
  `password_usu` varchar(500) DEFAULT NULL,
  `estado_usu` varchar(50) DEFAULT 'ACTIVO',
  `perfil_usu` varchar(500) DEFAULT NULL,
  `apellido_usu` varchar(500) DEFAULT NULL,
  `nombre_usu` varchar(500) DEFAULT NULL,
  `creacion_usu` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`codigo_usu`, `usuario_usu`, `password_usu`, `estado_usu`, `perfil_usu`, `apellido_usu`, `nombre_usu`, `creacion_usu`) VALUES
(17, 'david', 'e10adc3949ba59abbe56e057f20f883e', 'ACTIVO', 'ADMINISTRADOR', 'Banda', 'David', '2022-03-07 16:53:57'),
(19, 'rafita', 'e10adc3949ba59abbe56e057f20f883e', 'ACTIVO', 'ADMINISTRADOR', 'David', 'Banda', '2022-03-07 22:36:37');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `disponibilidad`
--
ALTER TABLE `disponibilidad`
  ADD PRIMARY KEY (`codigo_dis`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`codigo_res`),
  ADD KEY `fk_codigo_ser` (`fk_codigo_ser`) USING BTREE;

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`codigo_ser`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codigo_usu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `disponibilidad`
--
ALTER TABLE `disponibilidad`
  MODIFY `codigo_dis` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `codigo_res` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `codigo_ser` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `codigo_usu` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`fk_codigo_ser`) REFERENCES `servicios` (`codigo_ser`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
