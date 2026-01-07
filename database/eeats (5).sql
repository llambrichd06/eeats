-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-01-2026 a las 21:44:33
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
-- Base de datos: `eeats`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cook_points`
--

CREATE TABLE `cook_points` (
  `id` int(11) NOT NULL,
  `cook_point` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `code` varchar(30) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `percent` int(11) NOT NULL,
  `uses` int(11) DEFAULT NULL,
  `ends_at` datetime NOT NULL,
  `begins_at` datetime NOT NULL DEFAULT sysdate(),
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `discounts`
--

INSERT INTO `discounts` (`id`, `code`, `type`, `percent`, `uses`, `ends_at`, `begins_at`, `deleted`) VALUES
(1, NULL, 1, 20, NULL, '2026-03-30 00:00:00', '2025-01-01 19:07:00', 0),
(2, NULL, 1, 20, NULL, '2026-12-31 00:00:00', '2025-11-26 20:17:42', 0),
(3, '123ABC', 1, 20, NULL, '2026-12-31 00:00:00', '2025-11-26 20:17:42', 0),
(4, 'PROMOYAYYYY', 0, 10, NULL, '2026-01-22 22:42:00', '2026-01-01 22:42:00', 0),
(5, 'WOWWVERYCODEAEAEAE', 1, 51, 50, '2026-01-15 00:20:00', '2026-01-01 00:20:00', 1),
(6, 'WOWWVERYCODEeee', 1, 50, 50, '2026-01-15 00:20:00', '2026-01-01 00:20:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `img` varchar(100) NOT NULL,
  `cook_point_id` int(11) DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `log_date` datetime NOT NULL DEFAULT sysdate(),
  `action` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `log_date`, `action`) VALUES
(1, 2, '2026-01-05 21:18:52', 'Deleted user with id 21'),
(2, 2, '2026-01-05 21:27:29', 'Edited order line with id 3and line num 3'),
(3, 2, '2026-01-05 23:40:52', 'Saved new user'),
(4, 2, '2026-01-05 23:43:41', 'Edited user with id 27'),
(5, 2, '2026-01-05 23:43:53', 'Deleted user with id 27'),
(6, 2, '2026-01-05 23:45:46', 'Edited order with id 24'),
(7, 2, '2026-01-05 23:47:56', 'Saved new order'),
(8, 2, '2026-01-05 23:48:09', 'Deleted order with id 26'),
(9, 2, '2026-01-05 23:55:05', 'Saved new order line with id 18 and line num 4'),
(10, 2, '2026-01-05 23:55:21', 'Edited order line with id 18and line num 4'),
(11, 2, '2026-01-06 00:03:39', 'Saved new order line with id  and line num 1'),
(12, 2, '2026-01-06 00:16:00', 'Saved new product'),
(13, 2, '2026-01-06 00:17:25', 'Edited product with id 13'),
(14, 2, '2026-01-06 00:17:34', 'Edited product with id 13'),
(15, 2, '2026-01-06 00:17:39', 'Deleted product with id 13'),
(16, 2, '2026-01-06 00:20:36', 'Saved new discount '),
(17, 2, '2026-01-06 00:20:50', 'Saved new discount '),
(18, 2, '2026-01-06 00:21:02', 'Deleted discount with id 6'),
(19, 2, '2026-01-06 00:21:21', 'Edited discount with id 5'),
(20, 2, '2026-01-06 00:21:30', 'Edited discount with id 5'),
(21, 2, '2026-01-06 00:21:37', 'Deleted discount with id 5'),
(22, 2, '2026-01-06 12:51:28', 'Edited product with id 3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT sysdate(),
  `address` varchar(100) DEFAULT NULL,
  `delivery_type` varchar(20) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `discount_applied` int(11) DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `created_at`, `address`, `delivery_type`, `total`, `subtotal`, `delivery_date`, `discount_id`, `discount_applied`, `deleted`) VALUES
(1, 1, '2025-11-20 17:11:54', 'molins', 'delivery', 20, 20, '2026-01-01 00:00:00', NULL, NULL, 0),
(2, 1, '2025-12-14 21:12:21', 'uhh', 'pickup', 456, 123, '2025-12-20 20:57:00', NULL, NULL, 0),
(3, 2, '2025-12-16 17:04:34', 'hmmm', 'pickup', 234, 543, '2025-12-24 21:15:00', NULL, NULL, 0),
(5, 2, '2025-12-16 17:05:27', 'neworderrrr', 'delivery', 234, 543, '2025-12-26 21:15:00', NULL, NULL, 0),
(6, 25, '2026-01-03 18:24:11', 'molins de rei', NULL, 61, 61, NULL, NULL, NULL, 1),
(7, 25, '2026-01-03 18:25:08', 'molins de rei', NULL, 61, 61, NULL, NULL, NULL, 1),
(8, 25, '2026-01-03 18:25:38', 'molins de rei', NULL, 61, 61, NULL, NULL, NULL, 1),
(9, 25, '2026-01-03 18:26:02', 'molins de rei', NULL, 61, 61, NULL, NULL, NULL, 1),
(18, 25, '2026-01-03 18:36:22', 'coolAdress123', NULL, 48, 61, NULL, 3, 20, 0),
(19, 25, '2026-01-03 18:44:54', 'myVeryOwnAdress', NULL, 52, 66, NULL, 3, 20, 0),
(20, 25, '2026-01-03 18:51:55', 'molinssss', 'pickup', 58, 73, '2026-01-05 22:59:00', NULL, NULL, 0),
(21, 25, '2026-01-03 23:00:30', 'Somewhere', 'pickup', 2, 1, '2026-01-05 22:59:00', NULL, NULL, 0),
(22, 2, '2026-01-04 14:27:36', 'steakLoverHouse', NULL, 9, 12, NULL, 3, 20, 0),
(23, 2, '2026-01-04 17:02:11', 'awesomeAdress', NULL, 20, 20, NULL, NULL, 0, 0),
(24, 25, '2026-01-04 18:58:32', 'aaaaeeee', 'delivery', 200, 200, '2026-01-07 23:45:00', 1, 20, 0),
(25, 2, '2026-01-05 17:48:54', 'testersHouse', NULL, 56, 63, NULL, 4, 10, 0),
(26, 25, '2026-01-05 23:47:56', 'molins', 'pickup', 16, 20, '2026-01-08 23:47:00', 1, 20, 1),
(27, 25, '2026-01-06 12:52:45', 'molins de rei', NULL, 5, 6, NULL, 4, 10, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_lines`
--

CREATE TABLE `order_lines` (
  `id` int(11) NOT NULL,
  `line_num` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discount_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `order_lines`
--

INSERT INTO `order_lines` (`id`, `line_num`, `order_id`, `product_id`, `price`, `quantity`, `discount_id`) VALUES
(1, 1, 1, 1, 12, 1, NULL),
(2, 2, 1, 1, 12, 1, NULL),
(3, 3, 1, 2, 200, 1, NULL),
(4, 1, 9, 1, 12, 3, NULL),
(5, 2, 9, 3, 5, 5, NULL),
(6, 1, 18, 1, 12, 3, NULL),
(7, 2, 18, 3, 5, 5, NULL),
(8, 1, 19, 3, 5, 6, NULL),
(9, 2, 19, 1, 12, 3, NULL),
(10, 1, 20, 1, 12, 4, NULL),
(11, 2, 20, 3, 5, 5, NULL),
(12, 1, 22, 1, 12, 1, NULL),
(13, 1, 23, 3, 5, 4, NULL),
(14, 1, 24, 3, 5, 1, NULL),
(15, 2, 24, 2, 11, 1, NULL),
(16, 4, 1, 2, 1000, 2, NULL),
(18, 1, 25, 1, 12, 3, NULL),
(18, 2, 25, 2, 11, 2, NULL),
(18, 3, 25, 3, 2000, 1, NULL),
(18, 4, 25, 2, 300, 2, NULL),
(20, 1, 1, 1, 1200, 1, NULL),
(21, 1, 21, 1, 20, 1, NULL),
(22, 1, 27, 4, 6, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_line_ingredients`
--

CREATE TABLE `order_line_ingredients` (
  `ingredient_id` int(11) NOT NULL,
  `order_line_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `cook_point_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT sysdate(),
  `stock` int(11) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `premium` int(1) NOT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `created_at`, `stock`, `img`, `premium`, `discount_id`, `deleted`) VALUES
(1, 'Steak', 'A good steak right out of the grill!asdff aSFAWDGAS', 12, '2025-11-20 16:52:45', 5, 'steak.webp', 1, 1, 0),
(2, 'Spaghetti', 'Spaghetti with an amazing array of sauces!', 11, '2025-11-20 16:53:58', 3, 'spaghetti.webp', 0, 2, 0),
(3, 'Hamburger', 'A hamburger. Thats it.', 5, '2025-11-20 17:22:28', 6, 'burger.webp', 0, 1, 0),
(4, 'Salad', 'A refreshing salad that is quite healthy!', 6, '2025-11-26 20:04:00', 7, 'salad.webp', 0, NULL, 0),
(11, 'NewProduct', 'dfdg', 1, '2025-12-14 18:13:08', 2, 'newprod.png', 1, NULL, 0),
(13, 'CoolProductaaa', 'Just an amazing product', 50, '2026-01-06 00:16:00', 100, 'CoolProduct.webpppp', 0, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_categories`
--

CREATE TABLE `product_categories` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_ingredients`
--

CREATE TABLE `product_ingredients` (
  `product_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `is_default` int(1) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `profile_picture` varchar(150) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `premium` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `profile_picture`, `password`, `role`, `premium`) VALUES
(1, 'newnameeee', 'didac@bernat.com', 'thisthing', '1234', 'user', 1),
(2, 'didac', 'didac@mail.com', 'didac.png', '1234', 'admin', 1),
(20, 'didac', 'didac@beeeernat.com', 'a', ' 123123', 'user', 0),
(25, 'imANewUser', 'imANewUser@imANewUser.com', 'Unset', 'imANewUser', 'user', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cook_points`
--
ALTER TABLE `cook_points`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ibfk_2` (`cook_point_id`);

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ibfk_1` (`user_id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ibfk_3` (`user_id`),
  ADD KEY `ibfk_4` (`discount_id`);

--
-- Indices de la tabla `order_lines`
--
ALTER TABLE `order_lines`
  ADD PRIMARY KEY (`id`,`line_num`) USING BTREE,
  ADD KEY `ibfk_5` (`discount_id`),
  ADD KEY `ibfk_6` (`order_id`),
  ADD KEY `ibfk_7` (`product_id`);

--
-- Indices de la tabla `order_line_ingredients`
--
ALTER TABLE `order_line_ingredients`
  ADD PRIMARY KEY (`ingredient_id`,`order_line_id`),
  ADD KEY `ibfk_9` (`cook_point_id`),
  ADD KEY `ibfk_10` (`order_line_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ibfk_11` (`discount_id`);

--
-- Indices de la tabla `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`product_id`,`category_id`),
  ADD KEY `ibfk_13` (`category_id`);

--
-- Indices de la tabla `product_ingredients`
--
ALTER TABLE `product_ingredients`
  ADD PRIMARY KEY (`product_id`,`ingredient_id`),
  ADD KEY `ibfk_14` (`ingredient_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cook_points`
--
ALTER TABLE `cook_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `order_lines`
--
ALTER TABLE `order_lines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `ibfk_2` FOREIGN KEY (`cook_point_id`) REFERENCES `cook_points` (`id`);

--
-- Filtros para la tabla `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ibfk_4` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`id`);

--
-- Filtros para la tabla `order_lines`
--
ALTER TABLE `order_lines`
  ADD CONSTRAINT `ibfk_5` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`id`),
  ADD CONSTRAINT `ibfk_6` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `ibfk_7` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Filtros para la tabla `order_line_ingredients`
--
ALTER TABLE `order_line_ingredients`
  ADD CONSTRAINT `ibfk_10` FOREIGN KEY (`order_line_id`) REFERENCES `order_lines` (`id`),
  ADD CONSTRAINT `ibfk_8` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`),
  ADD CONSTRAINT `ibfk_9` FOREIGN KEY (`cook_point_id`) REFERENCES `cook_points` (`id`),
  ADD CONSTRAINT `order_line_ingredients_ibfk_1` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`),
  ADD CONSTRAINT `order_line_ingredients_ibfk_2` FOREIGN KEY (`order_line_id`) REFERENCES `order_lines` (`id`);

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `ibfk_11` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`id`);

--
-- Filtros para la tabla `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `ibfk_12` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `ibfk_13` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Filtros para la tabla `product_ingredients`
--
ALTER TABLE `product_ingredients`
  ADD CONSTRAINT `ibfk_14` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`),
  ADD CONSTRAINT `ibfk_15` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
