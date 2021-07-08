-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-06-2021 a las 23:33:33
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_masterbikes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `codigo` int(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipoProducto` varchar(100) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `cantidad` int(2) NOT NULL,
  `precio` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`codigo`, `nombre`, `tipoProducto`, `marca`, `descripcion`, `cantidad`, `precio`) VALUES
(12, 'Bianchi Advantaje', 'Bicicleta', 'bianchi', 'Descripción... ', 3, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuarios` int(11) NOT NULL,
  `rut` varchar(15) NOT NULL,
  `NombreC` varchar(70) NOT NULL,
  `Correo` varchar(30) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `direccion` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `Token` text NOT NULL,
  `Estado` int(11) NOT NULL,
  `rol` varchar(1) DEFAULT 'u'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuarios`, `rut`, `NombreC`, `Correo`, `usuario`, `phone`, `direccion`, `password`, `Token`, `Estado`, `rol`) VALUES
(33, '18810299-9', 'marcela alarcon valenzuela', 'acklesjensen10@gmail.com', 'marcelits', '123456789', 'cohrane96', '8cb2237d0679ca88db6464eac60da96345513964', '3eac69f45044ab34a31ceb69ec9db9dda561ee5d', 1, 'c'),
(34, '19289226-0', 'Cristobal Mosso Leon', 'cristobalmosso@gmail.com', 'criscits', '934276599', 'cohrane96', '8cb2237d0679ca88db6464eac60da96345513964', 'e2154fea5da2dd0d1732ff30931723c2973003a0', 1, 'u');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuarios`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `codigo` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
