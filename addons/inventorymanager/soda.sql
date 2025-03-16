-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2018 a las 06:16:41
-- Versión del servidor: 10.1.33-MariaDB
-- Versión de PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `soda`
--
CREATE DATABASE IF NOT EXISTS `soda` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `soda`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `_id` int(11) NOT NULL,
  `_tablename` varchar(128) NOT NULL,
  `_username` varchar(128) NOT NULL,
  `_date` datetime NOT NULL,
  `_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`_id`, `_tablename`, `_username`, `_date`, `_type`) VALUES
(1, 'mesa 8', ' jcastro', '2018-11-19 23:11:02', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_details`
--

CREATE TABLE `order_details` (
  `_order` int(11) NOT NULL,
  `_food` int(11) NOT NULL,
  `_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `order_details`
--

INSERT INTO `order_details` (`_order`, `_food`, `_price`) VALUES
(1, 4, 0),
(1, 3, 0);

--
-- Disparadores `order_details`
--
DELIMITER $$
CREATE TRIGGER `insertprice` BEFORE INSERT ON `order_details` FOR EACH ROW begin
	select f._cost into @price from _food f where f._id = new._order;
	set new._price = @price;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `_id` int(11) NOT NULL,
  `_username` varchar(128) NOT NULL,
  `_password` varchar(128) NOT NULL,
  `_type` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`_id`, `_username`, `_password`, `_type`) VALUES
(1, 'jcastro', '25', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_food`
--

CREATE TABLE `_food` (
  `_id` int(11) NOT NULL,
  `_desc` varchar(128) NOT NULL,
  `_cost` int(11) NOT NULL,
  `_type` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `_food`
--

INSERT INTO `_food` (`_id`, `_desc`, `_cost`, `_type`) VALUES
(3, 'Gallo pinto de la casa', 2500, 'desayuno'),
(4, 'Gallo pinto con 2 ingredientes', 2000, 'desayuno'),
(5, 'Tortilla de queso', 1300, 'desayuno'),
(6, 'Lapiz de carne', 2400, 'desayuno'),
(7, 'lapiz de pollo', 2400, 'desayuno'),
(8, 'Empanadas', 1000, 'desayuno'),
(9, 'Empanadas arregladas', 1300, 'desayuno'),
(10, 'Gallo de salchichon', 800, 'desayuno'),
(11, 'Gallo de chorizo', 800, 'desayuno'),
(12, 'Gallo de salchichon arreglado', 1300, 'desayuno'),
(13, 'Gallo de chorizo arreglado', 1300, 'desayuno'),
(14, 'cafe negro', 600, 'bebida caliente'),
(15, 'cafe negro con leche', 600, 'bebida caliente'),
(16, 'chocolate', 800, 'bebida caliente'),
(17, 'Aguadulce', 800, 'bebida caliente'),
(18, 'Aguadulce con leche', 800, 'bebida caliente'),
(19, 'te de manzanila', 500, 'bebida caliente'),
(20, 'Te negro ', 500, 'bebida caliente'),
(21, 'Te negro manzanilla en leche', 600, 'bebida caliente'),
(22, 'Te negro en leche', 600, 'bebida caliente'),
(23, 'Palitos de queso mozarella', 2500, 'entradas'),
(24, 'Alitas de pollo BBQ', 2500, 'entradas'),
(25, 'Alitas de pollo BUFALO', 2500, 'entradas'),
(26, 'Ceviche', 1700, 'entradas'),
(27, 'Aros de cebolla', 2000, 'entradas'),
(28, 'Ddos de queso', 1500, 'entradas'),
(29, 'Ptacones', 1500, 'entradas'),
(30, 'Arroz de la casa', 3800, 'tipos de arroz'),
(31, 'Arroz con camarones', 3800, 'tipos de arroz'),
(32, 'Arroz a la marinera', 3900, 'tipos de arroz'),
(33, 'Arroz con carne', 3300, 'tipos de arroz'),
(34, 'Arroz con pollo', 3300, 'tipos de arroz'),
(35, 'Arroz cantones', 3300, 'tipos de arroz'),
(36, 'Casado con carne', 3200, 'casados'),
(37, 'Casado con pollo asado', 3200, 'casados'),
(38, 'Casado con bistec', 3200, 'casados'),
(39, 'Casado con pollo frito', 3200, 'casados'),
(40, 'Casado con pescado', 3200, 'casados'),
(41, 'Camaron', 3800, 'ensaladas'),
(42, 'Pollo a la leña', 3500, 'ensaladas'),
(43, 'Palmito', 2500, 'ensaladas'),
(44, 'Negra', 2500, 'sopas'),
(45, 'Pollo', 2500, 'sopas'),
(46, 'Mariscos', 3800, 'sopas'),
(47, 'Azteca', 3800, 'sopas'),
(48, 'Entero', 4900, 'tradicional asado'),
(49, 'Medio', 2500, 'tradicional asado'),
(50, 'Muslo', 1700, 'tradicional asado'),
(51, 'Pechuga', 1800, 'tradicional asado'),
(52, '8 Piezas', 6500, 'pollo frito piezas solas'),
(53, '4 Piezas', 3400, 'pollo frito piezas solas'),
(54, '2 Piezas', 1800, 'pollo frito piezas solas'),
(55, 'Pechuga', 1000, 'pollo frito piezas solas'),
(56, 'Muslo/Cuarto', 900, 'pollo frito piezas solas'),
(57, 'Alas', 700, 'pollo frito piezas solas'),
(58, 'Chuleta al gusto', 3900, 'carnes rojas y blancas'),
(59, 'Fajitas mixtas', 3800, 'carnes rojas y blancas'),
(60, 'Filete de pescado a la ranchera', 3900, 'carnes rojas y blancas'),
(61, 'Filete de pescado en salsa tartara', 3900, 'carnes rojas y blancas'),
(62, 'Mariscada', 4500, 'carnes rojas y blancas'),
(63, 'Pechuga de pollo a la plancha', 3500, 'carnes rojas y blancas'),
(64, 'Fetuccini con camarones', 4800, 'pastas'),
(65, 'Fetuccini con mariscos', 4800, 'pastas'),
(66, 'Spaghetti', 3200, 'pastas'),
(67, 'Hamburguesa de pollo a la leña', 2500, 'comidas rapidas'),
(68, 'Hamburguesa de la casa', 2000, 'comidas rapidas'),
(69, 'Hamburguesa de jamon y queso', 1500, 'comidas rapidas'),
(70, 'Papas de la casa', 2300, 'comidas rapidas'),
(71, 'Salchipapas', 2500, 'comidas rapidas'),
(72, 'Papas fritas', 1200, 'comidas rapidas'),
(73, 'lapiz carne', 2400, 'comidas rapidas'),
(74, 'lapiz pollo', 2400, 'comidas rapidas'),
(75, 'lapiz de jamon y queso', 1750, 'comidas rapidas'),
(76, 'Quesadilla', 2500, 'comidas rapidas'),
(77, 'Hotdog', 1000, 'comidas rapidas'),
(78, 'Nachos', 2500, 'comidas rapidas'),
(79, 'Burritos', 2500, 'comidas rapidas'),
(80, 'Chalupas', 2000, 'comidas rapidas'),
(81, 'Taco sencillo', 900, 'comidas rapidas'),
(82, 'Taco doble', 1800, 'comidas rapidas'),
(83, 'Taco especial', 1750, 'comidas rapidas'),
(84, ' Combo#1(hamburguesa de la casa)', 3250, 'combos'),
(85, ' Combo#2(2piezas pollo)', 3250, 'combos'),
(86, 'Batido de fresa en agua', 900, 'bebidas frias'),
(87, 'Batido de papaya en agua', 900, 'bebidas frias'),
(88, 'Batido de mora en agua', 900, 'bebidas frias'),
(89, 'Batido de hierba buena en agua', 900, 'bebidas frias'),
(90, 'Batido de  en agua', 900, 'bebidas frias'),
(91, 'Batido de fresa en leche', 1200, 'bebidas frias'),
(92, 'Batido de papaya en leche', 1200, 'bebidas frias'),
(93, 'Batido de mora en leche', 1200, 'bebidas frias'),
(94, 'Batido de crema en leche', 1200, 'bebidas frias'),
(95, 'Ensalada de frutas con helado', 1500, 'postres'),
(96, 'Gelatina con helado', 1000, 'postres');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`_id`);

--
-- Indices de la tabla `_food`
--
ALTER TABLE `_food`
  ADD PRIMARY KEY (`_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `_food`
--
ALTER TABLE `_food`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
