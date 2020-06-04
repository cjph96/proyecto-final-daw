-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-06-2020 a las 01:26:29
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `incfood`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `capacidad` int(2) NOT NULL,
  `id_restauranteFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `nombre`, `capacidad`, `id_restauranteFK`) VALUES
(1, 'A', 4, 3),
(3, 'nuevaediit', 50, 3),
(4, 'A1', 2, 2),
(5, 'B2', 8, 2),
(6, '34234', 5, 3),
(7, 'prueba', 6, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_05_03_000001_create_customer_columns', 2),
(5, '2019_05_03_000002_create_subscriptions_table', 2),
(6, '2019_05_03_000003_create_subscription_items_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('INVERSIONESNUEVACANARIAS@GMAIL.COM', '$2y$10$xAVWA9c5e4yFBqA1Ot5fo.1Zh3OSqbeJARZpilZFHIi4Ni5eT2ySy', '2020-05-21 02:21:40'),
('cristian.perez.hernandez.96@gmail.com', '$2y$10$ZKh131wTSn4dXqP8q4jgquj.y1ix5CCgQlAdmK7Lwy8nlIgAoVE8S', '2020-05-21 05:15:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `telefono` int(10) NOT NULL,
  `cantidad` int(2) NOT NULL,
  `fecha` datetime NOT NULL,
  `codigo` varchar(6) COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(1) NOT NULL,
  `id_mesaFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `telefono`, `cantidad`, `fecha`, `codigo`, `estado`, `id_mesaFK`) VALUES
(1, 6232332, 4, '2020-06-05 10:00:00', '30000', 0, 1),
(2, 62323321, 3, '2020-06-05 22:00:00', '30001', 0, 1),
(3, 123456789, 3, '2020-06-05 09:30:00', '33030', 0, 1),
(5, 123456789, 3, '2020-06-05 09:30:00', '33547', 0, 3),
(6, 123456789, 3, '2020-06-05 12:30:00', '33973', 0, 1),
(8, 123456789, 3, '2020-06-05 12:30:00', '39093', 0, 3),
(9, 123456789, 3, '2020-06-05 14:30:00', '36302', 0, 1),
(11, 611111111, 15, '2020-06-13 18:33:00', '38066', 0, 3),
(12, 611111111, 45, '2020-06-20 18:33:00', '36765', 0, 3),
(13, 636831365, 41, '2020-02-12 15:00:00', '39413', 0, 3),
(14, 636831365, 41, '2020-02-12 15:00:00', '34126', 0, 3),
(15, 636831365, 41, '2020-02-12 15:00:00', '36249', 0, 3),
(16, 636831365, 41, '2020-02-12 15:00:00', '37357', 0, 3),
(17, 636831365, 41, '2020-06-12 15:00:00', '34302', 0, 3),
(18, 636831365, 4, '2020-06-04 21:22:00', '26151', 0, 5),
(19, 636831365, 3, '2020-06-04 20:50:00', '28381', 0, 5),
(22, 636831365, 2, '2020-06-05 22:00:00', '37092', 0, 3),
(23, 636831365, 2, '2020-06-05 22:00:00', '38812', 0, 6),
(24, 636831365, 2, '2020-06-05 22:00:00', '37743', 0, 7),
(25, 636831365, 2, '2020-06-05 23:00:00', '37084', 0, 1),
(26, 636831365, 2, '2020-06-05 23:00:00', '39643', 0, 6),
(27, 636831365, 2, '2020-06-05 23:00:00', '39501', 0, 7),
(28, 636831365, 2, '2020-06-05 23:00:00', '38671', 0, 3),
(29, 636831365, 2, '2020-06-06 23:00:00', '38877', 0, 1),
(30, 636831365, 2, '2020-06-06 23:00:00', '33375', 0, 6),
(31, 636831365, 4, '2020-06-04 23:28:00', '25335', 0, 5),
(32, 636836513, 3, '2020-06-13 23:55:00', '37406', 1, 1),
(33, 636831365, 4, '2020-06-06 22:00:00', '33332', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurantes`
--

CREATE TABLE `restaurantes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(63) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `id_userFK` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `restaurantes`
--

INSERT INTO `restaurantes` (`id`, `nombre`, `direccion`, `id_userFK`) VALUES
(2, 'El pincho', 'Santa Ursula', 5),
(3, 'Bar C1', 'La Victoria de Acentejo', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subscription_items`
--

CREATE TABLE `subscription_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_id` bigint(20) UNSIGNED NOT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol` int(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `rol`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `stripe_id`, `card_brand`, `card_last_four`, `trial_ends_at`) VALUES
(1, 'Javier A Glez Fuentes', 'INVERSIONESNUEVACANARIAS@GMAIL.COM', 0, NULL, '$2y$10$NaEgNzqZ3u9pzpL.k1t7V.0jh0D6XxkCeryjx7FiATiC0OOm0FKiy', 'gwUOvhWygwwR9J5g7gJ801tesQKB7dJw9m4kYWfLXcUHr9k2Bbv6Pgl6JB5g', '2020-05-21 02:01:58', '2020-05-21 02:01:58', NULL, NULL, NULL, NULL),
(5, 'cristian', 'cristian.perez.hernandez.96@gmail.com', 0, '2020-05-21 02:43:31', '$2y$10$sJq45dQzOP9nFSOyqQcUUOEzW2DY0djAmlSVlHy0XVAt1zaV4mQ86', 'Z3Rrvc18mM8O6zRn6Bo3RKYAeEhbow863SBTBtVdJLrY3NdClmLnidRNG5zw', '2020-05-21 02:41:38', '2020-05-21 02:43:31', NULL, NULL, NULL, NULL),
(6, 'Cristian Jesus Perez Hernandez', 'cristian.jesus.perez.hernandez@gmail.com', 0, '2020-06-02 19:33:10', '$2y$10$Et4dOvRomAwsuHgA20zwUOPR9IzLLMBTmITACxdjdPviPTmDrHKZu', 'A7LlHH5ZxUE3Xf6r2DY5rYg9IBdBj3Hn8XA4ZmP1wabudhRFCiXCUhi7sj01', '2020-06-02 19:30:40', '2020-06-03 19:14:54', NULL, NULL, NULL, NULL),
(7, 'dsd', 'sd@asas', 0, NULL, '$2y$10$b.LMhmgyDM4TOZBQQfdfDe6RtaAXuxX9iJohsMAW5rIUdIkNGcMVu', NULL, '2020-06-03 20:41:33', '2020-06-03 20:41:33', NULL, NULL, NULL, NULL),
(8, 'Javier', 'javierajcinformatica@gmail.com', 0, NULL, '$2y$10$RgGTCS7F9pczC8lcp0xGRudY12yl2xjfiAxuCOHtX1/x1SIVqHLpW', NULL, '2020-06-04 21:48:30', '2020-06-04 21:48:30', NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_restauranteFK` (`id_restauranteFK`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mesaFK` (`id_mesaFK`);

--
-- Indices de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurantes_ibfk_1` (`id_userFK`);

--
-- Indices de la tabla `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriptions_user_id_stripe_status_index` (`user_id`,`stripe_status`);

--
-- Indices de la tabla `subscription_items`
--
ALTER TABLE `subscription_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscription_items_subscription_id_stripe_plan_unique` (`subscription_id`,`stripe_plan`),
  ADD KEY `subscription_items_stripe_id_index` (`stripe_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_stripe_id_index` (`stripe_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subscription_items`
--
ALTER TABLE `subscription_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD CONSTRAINT `mesas_ibfk_1` FOREIGN KEY (`id_restauranteFK`) REFERENCES `restaurantes` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_mesaFK`) REFERENCES `mesas` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD CONSTRAINT `restaurantes_ibfk_1` FOREIGN KEY (`id_userFK`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
