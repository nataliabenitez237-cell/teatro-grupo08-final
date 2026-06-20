-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         12.2.2-MariaDB - MariaDB Server
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.14.0.7165
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para teatro_grupo08
CREATE DATABASE IF NOT EXISTS `teatro_grupo08` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `teatro_grupo08`;

-- Volcando estructura para tabla teatro_grupo08.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla teatro_grupo08.cache: ~0 rows (aproximadamente)

-- Volcando estructura para tabla teatro_grupo08.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla teatro_grupo08.cache_locks: ~0 rows (aproximadamente)

-- Volcando estructura para tabla teatro_grupo08.carrito
CREATE TABLE IF NOT EXISTS `carrito` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `taller_id` bigint(20) unsigned DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `evento_id` bigint(20) unsigned DEFAULT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carrito_user_id_foreign` (`user_id`),
  KEY `carrito_evento_id_foreign` (`evento_id`),
  KEY `carrito_taller_id_foreign` (`taller_id`),
  CONSTRAINT `carrito_evento_id_foreign` FOREIGN KEY (`evento_id`) REFERENCES `eventos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carrito_taller_id_foreign` FOREIGN KEY (`taller_id`) REFERENCES `talleres` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carrito_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla teatro_grupo08.carrito: ~1 rows (aproximadamente)
INSERT IGNORE INTO `carrito` (`id`, `user_id`, `taller_id`, `session_id`, `evento_id`, `cantidad`, `expires_at`, `created_at`, `updated_at`) VALUES
	(25, 40, NULL, NULL, 2, 1, '2026-06-19 02:18:14', '2026-06-19 02:03:14', '2026-06-19 02:03:14');

-- Volcando estructura para tabla teatro_grupo08.compras
CREATE TABLE IF NOT EXISTS `compras` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `metodo_pago_id` bigint(20) unsigned DEFAULT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `estado` enum('en_proceso','abonado','cancelado') NOT NULL DEFAULT 'en_proceso',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `compras_user_id_foreign` (`user_id`),
  KEY `compras_metodo_pago_id_foreign` (`metodo_pago_id`),
  CONSTRAINT `compras_metodo_pago_id_foreign` FOREIGN KEY (`metodo_pago_id`) REFERENCES `metodo_pagos` (`id`) ON DELETE SET NULL,
  CONSTRAINT `compras_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla teatro_grupo08.compras: ~18 rows (aproximadamente)
INSERT IGNORE INTO `compras` (`id`, `user_id`, `metodo_pago_id`, `total`, `estado`, `created_at`, `updated_at`) VALUES
	(3, 2, NULL, 15000.00, 'en_proceso', '2026-06-17 19:21:31', '2026-06-17 19:21:31'),
	(4, 2, NULL, 15500.00, 'en_proceso', '2026-06-17 19:22:00', '2026-06-17 19:22:00'),
	(5, 2, NULL, 15500.00, 'en_proceso', '2026-06-17 21:15:16', '2026-06-17 21:15:16'),
	(6, 2, NULL, 15500.00, 'en_proceso', '2026-06-17 21:20:13', '2026-06-17 21:20:13'),
	(7, 2, NULL, 15500.00, 'en_proceso', '2026-06-17 21:30:24', '2026-06-17 21:30:24'),
	(8, 2, NULL, 0.00, 'en_proceso', '2026-06-17 21:33:30', '2026-06-17 21:33:30'),
	(9, 2, NULL, 0.00, 'en_proceso', '2026-06-17 21:34:36', '2026-06-17 21:34:36'),
	(10, 2, NULL, 0.00, 'en_proceso', '2026-06-17 21:38:03', '2026-06-17 21:38:03'),
	(11, 2, NULL, 0.00, 'en_proceso', '2026-06-17 21:38:59', '2026-06-17 21:38:59'),
	(12, 2, NULL, 0.00, 'en_proceso', '2026-06-17 21:39:11', '2026-06-17 21:39:11'),
	(13, 2, NULL, 0.00, 'abonado', '2026-06-17 21:41:11', '2026-06-17 21:41:11'),
	(14, 2, NULL, 20500.00, 'abonado', '2026-06-17 22:35:52', '2026-06-17 22:35:52'),
	(15, 2, NULL, 6000.00, 'abonado', '2026-06-17 22:42:51', '2026-06-17 22:42:51'),
	(28, 38, NULL, 18500.00, 'en_proceso', '2026-06-18 14:59:42', '2026-06-18 14:59:42'),
	(31, 38, NULL, 15000.00, 'en_proceso', '2026-06-18 18:57:12', '2026-06-18 18:57:12'),
	(32, 40, 6, 12000.00, 'en_proceso', '2026-06-19 02:02:34', '2026-06-19 02:02:34'),
	(33, 38, 4, 7500.00, 'en_proceso', '2026-06-19 02:17:00', '2026-06-19 02:17:00'),
	(34, 38, 5, 25000.00, 'en_proceso', '2026-06-19 15:53:00', '2026-06-19 15:53:00');

-- Volcando estructura para tabla teatro_grupo08.consultas
CREATE TABLE IF NOT EXISTS `consultas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `mensaje` text NOT NULL,
  `leido` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla teatro_grupo08.consultas: ~1 rows (aproximadamente)
INSERT IGNORE INTO `consultas` (`id`, `nombre`, `email`, `telefono`, `mensaje`, `leido`, `created_at`, `updated_at`) VALUES
	(3, 'Natalia', 'nataliabenitez237@gmail.com', '3794261496', 'Buenas tardes necesito información de los talleres', 0, '2026-06-19 15:39:27', '2026-06-19 15:39:27');

-- Volcando estructura para tabla teatro_grupo08.detalle_compras
CREATE TABLE IF NOT EXISTS `detalle_compras` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `compra_id` bigint(20) unsigned NOT NULL,
  `evento_id` bigint(20) unsigned DEFAULT NULL,
  `taller_id` bigint(20) unsigned DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detalle_compras_compra_id_foreign` (`compra_id`),
  KEY `detalle_compras_taller_id_foreign` (`taller_id`),
  KEY `evento_id` (`evento_id`),
  CONSTRAINT `1` FOREIGN KEY (`evento_id`) REFERENCES `eventos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `detalle_compras_compra_id_foreign` FOREIGN KEY (`compra_id`) REFERENCES `compras` (`id`) ON DELETE CASCADE,
  CONSTRAINT `detalle_compras_taller_id_foreign` FOREIGN KEY (`taller_id`) REFERENCES `talleres` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla teatro_grupo08.detalle_compras: ~23 rows (aproximadamente)
INSERT IGNORE INTO `detalle_compras` (`id`, `compra_id`, `evento_id`, `taller_id`, `cantidad`, `precio_unitario`, `subtotal`, `created_at`, `updated_at`) VALUES
	(1, 3, NULL, 5, 1, 7000.00, 7000.00, '2026-06-17 19:21:31', '2026-06-17 19:21:31'),
	(2, 3, NULL, 2, 1, 6000.00, 6000.00, '2026-06-17 19:21:31', '2026-06-17 19:21:31'),
	(3, 4, NULL, 3, 1, 6500.00, 6500.00, '2026-06-17 19:22:00', '2026-06-17 19:22:00'),
	(4, 4, NULL, 5, 1, 7000.00, 7000.00, '2026-06-17 19:22:00', '2026-06-17 19:22:00'),
	(5, 5, NULL, 3, 1, 6500.00, 6500.00, '2026-06-17 21:15:16', '2026-06-17 21:15:16'),
	(6, 5, NULL, 5, 1, 7000.00, 7000.00, '2026-06-17 21:15:16', '2026-06-17 21:15:16'),
	(7, 6, NULL, 3, 1, 6500.00, 6500.00, '2026-06-17 21:20:13', '2026-06-17 21:20:13'),
	(8, 6, NULL, 5, 1, 7000.00, 7000.00, '2026-06-17 21:20:13', '2026-06-17 21:20:13'),
	(9, 7, NULL, 3, 1, 6500.00, 6500.00, '2026-06-17 21:30:24', '2026-06-17 21:30:24'),
	(10, 7, NULL, 5, 1, 7000.00, 7000.00, '2026-06-17 21:30:24', '2026-06-17 21:30:24'),
	(11, 13, NULL, 5, 3, 7000.00, 21000.00, '2026-06-17 21:41:11', '2026-06-17 21:41:11'),
	(12, 13, NULL, 3, 1, 6500.00, 6500.00, '2026-06-17 21:41:11', '2026-06-17 21:41:11'),
	(13, 14, NULL, 5, 2, 7000.00, 14000.00, '2026-06-17 22:35:52', '2026-06-17 22:35:52'),
	(14, 14, NULL, 3, 1, 6500.00, 6500.00, '2026-06-17 22:35:52', '2026-06-17 22:35:52'),
	(15, 15, NULL, 7, 1, 6000.00, 6000.00, '2026-06-17 22:42:51', '2026-06-17 22:42:51'),
	(26, 28, NULL, NULL, 2, 0.00, 0.00, '2026-06-18 14:59:42', '2026-06-18 14:59:42'),
	(27, 28, NULL, NULL, 1, 0.00, 0.00, '2026-06-18 14:59:42', '2026-06-18 14:59:42'),
	(31, 31, 2, NULL, 1, 8000.00, 8000.00, '2026-06-18 18:57:12', '2026-06-18 18:57:12'),
	(32, 31, 1, NULL, 1, 5000.00, 5000.00, '2026-06-18 18:57:12', '2026-06-18 18:57:12'),
	(33, 32, 1, NULL, 2, 5000.00, 10000.00, '2026-06-19 02:02:34', '2026-06-19 02:02:34'),
	(34, 33, 12, NULL, 1, 5500.00, 5500.00, '2026-06-19 02:17:00', '2026-06-19 02:17:00'),
	(35, 34, 2, NULL, 1, 8000.00, 8000.00, '2026-06-19 15:53:00', '2026-06-19 15:53:00'),
	(36, 34, 1, NULL, 3, 5000.00, 15000.00, '2026-06-19 15:53:00', '2026-06-19 15:53:00');

-- Volcando estructura para tabla teatro_grupo08.entradas
CREATE TABLE IF NOT EXISTS `entradas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `compra_id` bigint(20) unsigned NOT NULL,
  `evento_id` bigint(20) unsigned NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entradas_compra_id_foreign` (`compra_id`),
  KEY `entradas_evento_id_foreign` (`evento_id`),
  CONSTRAINT `entradas_compra_id_foreign` FOREIGN KEY (`compra_id`) REFERENCES `compras` (`id`) ON DELETE CASCADE,
  CONSTRAINT `entradas_evento_id_foreign` FOREIGN KEY (`evento_id`) REFERENCES `eventos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla teatro_grupo08.entradas: ~0 rows (aproximadamente)

-- Volcando estructura para tabla teatro_grupo08.eventos
CREATE TABLE IF NOT EXISTS `eventos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock_total` int(11) NOT NULL,
  `stock_disponible` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla teatro_grupo08.eventos: ~24 rows (aproximadamente)
INSERT IGNORE INTO `eventos` (`id`, `nombre`, `descripcion`, `fecha`, `hora`, `precio`, `stock_total`, `stock_disponible`, `imagen`, `activo`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Romeo y Julieta', 'Clásico de Shakespeare en versión moderna', '2026-06-20', '20:30:00', 5000.00, 100, 91, '1781566715.jpg', 1, '2026-06-15 23:38:35', '2026-06-19 15:53:00', NULL),
	(2, 'El Fantasma de la Ópera', 'Musical internacional en vivo', '2026-06-27', '21:00:00', 8000.00, 80, 76, '1781566864.jpg', 1, '2026-06-15 23:41:04', '2026-06-19 15:53:00', NULL),
	(3, 'Ballet Clásico', 'Noche de danza con orquesta en vivo', '2026-07-05', '21:30:00', 6500.00, 100, 100, '1781567035.jpg', 1, '2026-06-15 23:43:55', '2026-06-15 23:43:55', NULL),
	(4, 'Lago de los Cisnes', 'Ballet clásico de Tchaikovsky, una historia de amor, magia y tragedia interpretada por una compañía de danza internacional.', '2026-07-15', '20:30:00', 9300.00, 50, 50, '1781567188.jpg', 1, '2026-06-15 23:46:28', '2026-06-15 23:46:28', NULL),
	(5, 'Romeo y Julieta', 'Clásico de Shakespeare en versión moderna', '2026-06-20', '20:00:00', 5000.00, 100, 100, '1781716793.jpg', 1, '2026-06-16 00:18:22', '2026-06-17 17:19:53', NULL),
	(6, 'Ballet Clásico', 'Noche de danza con orquesta en vivo', '2026-07-01', '19:30:00', 6000.00, 100, 100, '1781717027.jpg', 1, '2026-06-16 00:19:11', '2026-06-17 17:23:47', NULL),
	(7, 'Stand Up Comedy Night', 'Show de humor con comediantes locales', '2026-07-05', '21:00:00', 3000.00, 150, 150, '1781717106.jpg', 1, '2026-06-16 00:19:20', '2026-06-17 17:25:06', NULL),
	(8, 'Concierto Sinfónico', 'Orquesta sinfónica en vivo', '2026-07-10', '20:00:00', 8000.00, 200, 200, '1781717084.jpg', 1, '2026-06-16 00:19:28', '2026-06-17 17:24:44', NULL),
	(9, 'Tango Show', 'Espectáculo de tango argentino', '2026-07-15', '21:30:00', 4500.00, 120, 120, '1781717061.jpg', 1, '2026-06-16 00:19:37', '2026-06-17 17:24:21', NULL),
	(10, 'El Lago de los Cisnes', 'Ballet clásico de Tchaikovsky', '2026-08-01', '20:30:00', 7500.00, 100, 100, '1781717005.jpg', 1, '2026-06-16 00:19:44', '2026-06-17 17:23:25', NULL),
	(11, 'Noche de Ópera Italiana', 'Arias clásicas en vivo', '2026-08-05', '20:00:00', 8200.00, 90, 90, '1781716921.jpg', 1, '2026-06-16 00:19:55', '2026-06-17 17:22:01', NULL),
	(12, 'Danza Contemporánea', 'Show moderno de danza artística', '2026-08-10', '19:00:00', 5500.00, 110, 109, '1781716904.jpg', 1, '2026-06-16 00:20:21', '2026-06-19 02:16:47', NULL),
	(13, 'Magia en el Teatro', 'Ilusionismo en vivo', '2026-08-15', '20:00:00', 4000.00, 130, 130, '1781716852.jpg', 1, '2026-06-16 00:21:20', '2026-06-17 17:20:52', NULL),
	(14, 'Rock Sinfónico', 'Fusión de rock y orquesta en vivo', '2026-08-20', '21:00:00', 9000.00, 200, 200, '1781716810.jpg', 1, '2026-06-16 00:23:08', '2026-06-17 17:20:10', NULL),
	(15, 'Comedia Teatral', 'Obra humorística para toda la familia', '2026-08-25', '19:30:00', 3500.00, 1, 1, '1781716492.jpg', 1, '2026-06-16 00:23:15', '2026-06-17 23:21:25', NULL),
	(16, 'Noche de Flamenco', 'Danza y música española en vivo', '2026-09-01', '20:30:00', 4800.00, 120, 120, '1781716516.jpg', 1, '2026-06-16 00:23:23', '2026-06-17 17:15:16', NULL),
	(17, 'Teatro Experimental', 'Obra contemporánea de autor', '2026-09-05', '21:00:00', 4200.00, 100, 100, '1781716533.jpg', 1, '2026-06-16 00:23:31', '2026-06-17 17:15:33', NULL),
	(18, 'Gran Gala del Teatro', 'Cierre de temporada con múltiples artistas', '2026-09-10', '20:00:00', 10000.00, 250, 250, '1781716547.jpg', 1, '2026-06-16 00:23:39', '2026-06-17 17:15:48', NULL),
	(19, 'Festival de Artes Escénicas', 'Evento especial con teatro, danza y música en vivo', '2026-09-15', '19:00:00', 8500.00, 180, 180, '1781716465.jpg', 1, '2026-06-16 00:23:48', '2026-06-17 17:14:25', NULL),
	(20, 'Ópera de Verdi', 'Gran presentación de ópera clásica italiana', '2026-09-20', '20:00:00', 9200.00, 160, 160, '1781716441.jpg', 1, '2026-06-16 00:24:48', '2026-06-19 02:11:18', NULL),
	(21, 'Festival de Jazz Nocturno', 'Noche de jazz con artistas internacionales', '2026-09-25', '22:00:00', 7800.00, 140, 140, '1781651060.jpg', 1, '2026-06-16 00:24:55', '2026-06-16 23:04:20', NULL),
	(22, 'Teatro Infantil', 'Obra teatral para toda la familia y niños', '2026-10-01', '18:00:00', 2800.00, 200, 200, '1781651010.jpg', 1, '2026-06-16 00:25:02', '2026-06-16 23:03:30', NULL),
	(23, 'Ballet Moderno', 'Fusión de danza clásica y contemporánea', '2026-10-05', '20:30:00', 6700.00, 110, 110, '1781650983.jpg', 1, '2026-06-16 00:25:10', '2026-06-19 15:38:11', NULL),
	(24, 'Gala Final de Teatro', 'Gran cierre anual con múltiples obras en escena', '2026-10-10', '21:00:00', 11000.00, 300, 300, '1781650956.jpg', 0, '2026-06-16 00:25:22', '2026-06-19 02:12:15', NULL);

-- Volcando estructura para tabla teatro_grupo08.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla teatro_grupo08.failed_jobs: ~0 rows (aproximadamente)

-- Volcando estructura para tabla teatro_grupo08.inscripciones
CREATE TABLE IF NOT EXISTS `inscripciones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `taller_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `inscripciones_user_id_taller_id_unique` (`user_id`,`taller_id`),
  KEY `inscripciones_taller_id_foreign` (`taller_id`),
  CONSTRAINT `inscripciones_taller_id_foreign` FOREIGN KEY (`taller_id`) REFERENCES `talleres` (`id`) ON DELETE CASCADE,
  CONSTRAINT `inscripciones_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla teatro_grupo08.inscripciones: ~8 rows (aproximadamente)
INSERT IGNORE INTO `inscripciones` (`id`, `user_id`, `taller_id`, `created_at`, `updated_at`) VALUES
	(1, 2, 5, '2026-06-17 19:21:31', '2026-06-17 19:21:31'),
	(2, 2, 2, '2026-06-17 19:21:31', '2026-06-17 19:21:31'),
	(3, 2, 3, '2026-06-17 19:22:00', '2026-06-17 19:22:00'),
	(14, 38, 1, '2026-06-18 14:59:42', '2026-06-18 14:59:42'),
	(15, 38, 3, '2026-06-18 14:59:42', '2026-06-18 14:59:42'),
	(18, 38, 2, '2026-06-18 18:57:12', '2026-06-18 18:57:12'),
	(19, 40, 1, '2026-06-19 02:02:34', '2026-06-19 02:02:34'),
	(20, 38, 12, '2026-06-19 02:17:00', '2026-06-19 02:17:00');

-- Volcando estructura para tabla teatro_grupo08.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla teatro_grupo08.job_batches: ~0 rows (aproximadamente)

-- Volcando estructura para tabla teatro_grupo08.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla teatro_grupo08.jobs: ~0 rows (aproximadamente)

-- Volcando estructura para tabla teatro_grupo08.metodo_pagos
CREATE TABLE IF NOT EXISTS `metodo_pagos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla teatro_grupo08.metodo_pagos: ~4 rows (aproximadamente)
INSERT IGNORE INTO `metodo_pagos` (`id`, `nombre`, `activo`, `created_at`, `updated_at`) VALUES
	(4, 'Tarjeta de crédito', 1, '2026-06-19 00:06:08', '2026-06-19 00:06:08'),
	(5, 'Tarjeta de débito', 1, '2026-06-19 00:06:08', '2026-06-19 00:06:08'),
	(6, 'Mercado Pago', 1, '2026-06-19 00:06:08', '2026-06-19 00:06:08'),
	(7, 'QR Mercado Pago', 1, '2026-06-19 00:06:08', '2026-06-19 00:06:08');

-- Volcando estructura para tabla teatro_grupo08.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla teatro_grupo08.migrations: ~17 rows (aproximadamente)
INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000001_create_cache_table', 1),
	(2, '0001_01_01_000002_create_jobs_table', 1),
	(3, '2026_05_05_041436_create_roles_table', 1),
	(4, '2026_05_10_132359_create_users_table', 1),
	(5, '2026_05_15_185814_create_eventos_table', 1),
	(6, '2026_05_19_181927_create_sessions_table', 1),
	(7, '2026_05_20_create_metodo_pagos_table', 1),
	(8, '2026_05_23_031700_create_compras_table', 1),
	(9, '2026_05_23_031710_create_entradas_table', 1),
	(10, '2026_05_23_184912_create_consultas_table', 1),
	(11, '2026_06_14_215651_create_detalle_compras_table', 1),
	(12, '2026_06_20_000000_create_carrito_table', 1),
	(14, '2026_06_16_174255_create_talleres_table', 2),
	(15, '2026_06_16_191936_create_inscripciones_table', 3),
	(16, '2026_06_16_214127_add_taller_id_to_carrito_table', 4),
	(17, '2026_06_16_214949_fix_carrito_evento_nullable', 5),
	(18, '2026_06_17_160818_modificar_detalle_compras_para_talleres', 6);

-- Volcando estructura para tabla teatro_grupo08.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_nombre_unique` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla teatro_grupo08.roles: ~2 rows (aproximadamente)
INSERT IGNORE INTO `roles` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'admin', NULL, '2026-06-15 21:10:06', '2026-06-15 21:10:06', NULL),
	(2, 'cliente', NULL, '2026-06-15 21:10:06', '2026-06-15 21:10:06', NULL);

-- Volcando estructura para tabla teatro_grupo08.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla teatro_grupo08.sessions: ~1 rows (aproximadamente)
INSERT IGNORE INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('XRwCIaSCzlLGjmSOVhOp89X9Xl4SZ3NsctvXdJ3S', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJQelF2c0ptYkpzaERZWG9sWmd1YjZQU3hzbENhSGtPS08yNWlhekdUIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvZ3BvMDh0ZWF0cm8ubGFyYXZlbC50ZXN0XC9ldmVudG9zIiwicm91dGUiOiJldmVudG9zLnRvZG9zIn19', 1781884441);

-- Volcando estructura para tabla teatro_grupo08.talleres
CREATE TABLE IF NOT EXISTS `talleres` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `dias_horarios` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cupos_totales` int(11) NOT NULL,
  `cupos_disponibles` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla teatro_grupo08.talleres: ~50 rows (aproximadamente)
INSERT IGNORE INTO `talleres` (`id`, `nombre`, `descripcion`, `dias_horarios`, `precio`, `cupos_totales`, `cupos_disponibles`, `imagen`, `activo`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Taller de Teatro Inicial', 'Taller artístico de formación y práctica.', 'A definir', 5000.00, 10, 8, NULL, 1, '2026-06-16 23:55:51', '2026-06-18 04:36:59', NULL),
	(2, 'Danza Contemporánea', 'Taller artístico de formación y práctica.', 'A definir', 6000.00, 10, 9, '1781739411.jfif', 1, '2026-06-16 23:55:51', '2026-06-17 23:36:51', NULL),
	(3, 'Ballet Clásico', 'Taller artístico de formación y práctica.', 'A definir', 6500.00, 10, 3, '1781718459.jfif', 1, '2026-06-16 23:55:51', '2026-06-18 03:08:49', NULL),
	(4, 'Expresión Corporal', 'Taller artístico de formación y práctica.', 'A definir', 4500.00, 10, 10, '1781717212.jpg', 1, '2026-06-16 23:55:51', '2026-06-17 17:26:52', NULL),
	(5, 'Actuación Escénica', 'Taller artístico de formación y práctica.', 'A definir', 7000.00, 10, 0, '1781716250.jpg', 1, '2026-06-16 23:55:51', '2026-06-17 22:35:52', NULL),
	(6, 'Improvisación Teatral', 'Taller artístico de formación y práctica.', 'A definir', 5500.00, 10, 10, NULL, 1, '2026-06-16 23:55:51', '2026-06-16 23:55:51', NULL),
	(7, 'Canto y Técnica Vocal', 'Taller artístico de formación y práctica.', 'A definir', 6000.00, 10, 9, '1781739372.jfif', 1, '2026-06-16 23:55:51', '2026-06-17 23:36:12', NULL),
	(8, 'Producción Audiovisual', 'Taller artístico de formación y práctica.', 'A definir', 8000.00, 10, 10, NULL, 1, '2026-06-16 23:55:51', '2026-06-16 23:55:51', NULL),
	(9, 'Teatro Infantil', 'Taller artístico de formación y práctica.', 'A definir', 4000.00, 10, 10, NULL, 1, '2026-06-16 23:55:51', '2026-06-16 23:55:51', NULL),
	(10, 'Laboratorio Creativo', 'Taller artístico de formación y práctica.', 'A definir', 5000.00, 10, 10, NULL, 1, '2026-06-16 23:55:51', '2026-06-16 23:55:51', NULL),
	(11, 'Danza Urbana', 'Taller artístico de formación y práctica.', 'A definir', 5500.00, 10, 10, '1781739463.jfif', 1, '2026-06-16 23:55:51', '2026-06-17 23:37:43', NULL),
	(12, 'Yoga Expresivo', 'Taller artístico de formación y práctica.', 'A definir', 4500.00, 10, 10, NULL, 1, '2026-06-16 23:55:51', '2026-06-16 23:55:51', NULL),
	(13, 'Teatro Experimental', 'Taller artístico de formación y práctica.', 'A definir', 7000.00, 10, 10, NULL, 1, '2026-06-16 23:55:51', '2026-06-16 23:55:51', NULL),
	(14, 'Narración Oral', 'Taller artístico de formación y práctica.', 'A definir', 3500.00, 10, 10, NULL, 1, '2026-06-16 23:55:51', '2026-06-16 23:55:51', NULL),
	(15, 'Dirección Teatral', 'Taller artístico de formación y práctica.', 'A definir', 9000.00, 10, 10, '1781739447.jfif', 1, '2026-06-16 23:55:51', '2026-06-17 23:37:27', NULL),
	(16, 'Escenografía y Arte', 'Taller artístico de formación y práctica.', 'A definir', 7500.00, 10, 10, '1781739428.jpg', 1, '2026-06-16 23:55:51', '2026-06-17 23:37:08', NULL),
	(17, 'Guión y Dramaturgia', 'Taller artístico de formación y práctica.', 'A definir', 6500.00, 10, 10, NULL, 1, '2026-06-16 23:55:51', '2026-06-16 23:55:51', NULL),
	(18, 'Clown y Humor', 'Taller artístico de formación y práctica.', 'A definir', 5000.00, 10, 10, '1781739386.jfif', 1, '2026-06-16 23:55:51', '2026-06-17 23:36:26', NULL),
	(19, 'Entrenamiento Actoral', 'Taller artístico de formación y práctica.', 'A definir', 6800.00, 10, 10, '1781720269.jpg', 1, '2026-06-16 23:55:51', '2026-06-17 18:17:49', NULL),
	(20, 'Teatro Musical', 'Taller artístico de formación y práctica.', 'A definir', 8500.00, 10, 10, NULL, 1, '2026-06-16 23:55:51', '2026-06-16 23:55:51', NULL),
	(21, 'Taller 1', 'Descripción del Taller 1', 'Lunes y Miércoles 18:00', 2272.00, 20, 20, NULL, 1, '2026-06-17 23:41:13', '2026-06-17 23:41:13', NULL),
	(22, 'Taller 2', 'Descripción del Taller 2', 'Lunes y Miércoles 18:00', 3696.00, 20, 20, NULL, 1, '2026-06-17 23:41:13', '2026-06-17 23:41:13', NULL),
	(23, 'Taller 3', 'Descripción del Taller 3', 'Lunes y Miércoles 18:00', 3097.00, 20, 20, NULL, 1, '2026-06-17 23:41:13', '2026-06-17 23:41:13', NULL),
	(24, 'Taller 4', 'Descripción del Taller 4', 'Lunes y Miércoles 18:00', 1496.00, 20, 20, NULL, 1, '2026-06-17 23:41:13', '2026-06-17 23:41:13', NULL),
	(25, 'Taller 5', 'Descripción del Taller 5', 'Lunes y Miércoles 18:00', 4950.00, 20, 20, NULL, 1, '2026-06-17 23:41:13', '2026-06-17 23:41:13', NULL),
	(26, 'Taller 6', 'Descripción del Taller 6', 'Lunes y Miércoles 18:00', 3101.00, 20, 20, NULL, 1, '2026-06-17 23:41:13', '2026-06-17 23:41:13', NULL),
	(27, 'Taller 7', 'Descripción del Taller 7', 'Lunes y Miércoles 18:00', 3034.00, 20, 20, NULL, 1, '2026-06-17 23:41:13', '2026-06-17 23:41:13', NULL),
	(28, 'Taller 8', 'Descripción del Taller 8', 'Lunes y Miércoles 18:00', 4700.00, 20, 20, NULL, 1, '2026-06-17 23:41:13', '2026-06-17 23:41:13', NULL),
	(29, 'Taller 9', 'Descripción del Taller 9', 'Lunes y Miércoles 18:00', 3535.00, 20, 20, NULL, 1, '2026-06-17 23:41:13', '2026-06-17 23:41:13', NULL),
	(30, 'Taller 10', 'Descripción del Taller 10', 'Lunes y Miércoles 18:00', 1727.00, 20, 20, NULL, 1, '2026-06-17 23:41:13', '2026-06-17 23:41:13', NULL),
	(31, 'Taller 1', 'Descripción del Taller 1', 'Lunes y Miércoles 18:00', 3439.00, 20, 20, NULL, 1, '2026-06-17 23:43:18', '2026-06-17 23:43:18', NULL),
	(32, 'Taller 2', 'Descripción del Taller 2', 'Lunes y Miércoles 18:00', 4933.00, 20, 20, NULL, 1, '2026-06-17 23:43:18', '2026-06-17 23:43:18', NULL),
	(33, 'Taller 3', 'Descripción del Taller 3', 'Lunes y Miércoles 18:00', 4932.00, 20, 20, NULL, 1, '2026-06-17 23:43:18', '2026-06-17 23:43:18', NULL),
	(34, 'Taller 4', 'Descripción del Taller 4', 'Lunes y Miércoles 18:00', 2185.00, 20, 20, NULL, 1, '2026-06-17 23:43:18', '2026-06-17 23:43:18', NULL),
	(35, 'Taller 5', 'Descripción del Taller 5', 'Lunes y Miércoles 18:00', 3949.00, 20, 20, NULL, 1, '2026-06-17 23:43:18', '2026-06-17 23:43:18', NULL),
	(36, 'Taller 6', 'Descripción del Taller 6', 'Lunes y Miércoles 18:00', 2441.00, 20, 20, NULL, 1, '2026-06-17 23:43:18', '2026-06-17 23:43:18', NULL),
	(37, 'Taller 7', 'Descripción del Taller 7', 'Lunes y Miércoles 18:00', 1226.00, 20, 20, NULL, 1, '2026-06-17 23:43:18', '2026-06-17 23:43:18', NULL),
	(38, 'Taller 8', 'Descripción del Taller 8', 'Lunes y Miércoles 18:00', 4665.00, 20, 20, NULL, 1, '2026-06-17 23:43:18', '2026-06-17 23:43:18', NULL),
	(39, 'Taller 9', 'Descripción del Taller 9', 'Lunes y Miércoles 18:00', 4514.00, 20, 20, NULL, 1, '2026-06-17 23:43:18', '2026-06-17 23:43:18', NULL),
	(40, 'Taller 10', 'Descripción del Taller 10', 'Lunes y Miércoles 18:00', 3675.00, 20, 20, NULL, 1, '2026-06-17 23:43:18', '2026-06-17 23:43:18', NULL),
	(41, 'Taller 1', 'Descripción del Taller 1', 'Lunes y Miércoles 18:00', 4418.00, 20, 20, NULL, 1, '2026-06-17 23:45:16', '2026-06-17 23:45:16', NULL),
	(42, 'Taller 2', 'Descripción del Taller 2', 'Martes y Jueves 18:00', 4281.00, 20, 20, NULL, 1, '2026-06-17 23:45:27', '2026-06-17 23:45:27', NULL),
	(43, 'Taller 3', 'Descripción del Taller 3', 'Viernes 18:00', 2401.00, 20, 20, NULL, 1, '2026-06-17 23:45:35', '2026-06-17 23:45:35', NULL),
	(44, 'Taller 4', 'Descripción del Taller 4', 'Sábados 10:00', 4654.00, 20, 20, NULL, 1, '2026-06-17 23:45:44', '2026-06-17 23:45:44', NULL),
	(45, 'Taller 5', 'Descripción del Taller 5', 'Domingos 16:00', 2280.00, 20, 20, NULL, 1, '2026-06-17 23:45:52', '2026-06-17 23:45:52', NULL),
	(46, 'Taller 6', 'Descripción del Taller 6', 'Lunes 20:00', 2160.00, 20, 20, NULL, 1, '2026-06-17 23:46:43', '2026-06-17 23:46:43', NULL),
	(47, 'Taller 7', 'Descripción del Taller 7', 'Martes 20:00', 2777.00, 20, 20, NULL, 1, '2026-06-17 23:46:51', '2026-06-17 23:46:51', NULL),
	(48, 'Taller 8', 'Descripción del Taller 8', 'Miércoles 20:00', 3101.00, 20, 20, NULL, 1, '2026-06-17 23:47:01', '2026-06-17 23:47:01', NULL),
	(49, 'Taller 9', 'Descripción del Taller 9', 'Jueves 20:00', 1903.00, 20, 20, NULL, 1, '2026-06-17 23:47:09', '2026-06-17 23:47:09', NULL),
	(50, 'Taller 10', 'Descripción del Taller 10', 'Viernes 20:00', 3044.00, 20, 20, NULL, 1, '2026-06-17 23:47:17', '2026-06-17 23:47:17', NULL);

-- Volcando estructura para tabla teatro_grupo08.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol_id` bigint(20) unsigned NOT NULL DEFAULT 2,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_rol_id_foreign` (`rol_id`),
  CONSTRAINT `users_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla teatro_grupo08.users: ~40 rows (aproximadamente)
INSERT IGNORE INTO `users` (`id`, `name`, `apellido`, `email`, `password`, `rol_id`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Ivana', 'Gimenez', 'iva.gimenez91@gmail.com', '$2y$12$m/X8HeQZ/hVrVccaT9wYnenovEKroCs92uIBV7sZcBCu8L/HhuQia', 1, NULL, '2026-06-15 21:11:23', '2026-06-15 21:11:23', NULL),
	(2, 'Rodrigo Sebastián', 'Cantero', 'rodricantero@gmail.com', '$2y$12$l94dYrz5pa4VsUfiAmma/e2PMWHX5sIFnGLUkeBR4N3/ENPBnJ0wu', 2, NULL, '2026-06-15 21:12:32', '2026-06-17 10:48:48', NULL),
	(3, 'Juan', 'Pérez', 'juan.perez1@mail.com', '$2y$12$rwRkUsmsacw5SoL7aAb5ceOm.nScDzkcHIIYeB5Cu1PWPNICldXfm', 2, NULL, '2026-06-15 21:14:15', '2026-06-15 21:14:15', NULL),
	(4, 'María', 'Gómez', 'maria.gomez2@mail.com', '$2y$12$0Kx6X2yZXI7Yt0aAohTL..WR9A4iZ6xWc/QLF/8f9TKRbqVW6RCee', 2, NULL, '2026-06-15 21:14:17', '2026-06-15 21:14:17', NULL),
	(5, 'Carlos', 'Rodríguez', 'carlos.rodriguez3@mail.com', '$2y$12$VWRpatZsDzqSydHjuCe3I..HcVzpduJxludP87TWO1aWZEhDmxUYq', 2, NULL, '2026-06-15 21:14:18', '2026-06-15 21:14:18', NULL),
	(6, 'Lucía', 'Fernández', 'lucia.fernandez4@mail.com', '$2y$12$KCKrixeCGFZh1LV7tEuKW.mYQeQ4K1XqfOfVUUMMP53nz0InXXZja', 2, NULL, '2026-06-15 21:14:19', '2026-06-15 21:14:19', NULL),
	(7, 'Martín', 'López', 'martin.lopez5@mail.com', '$2y$12$wg2J9wJrKz1kDTuYHOcME.6Y3O.YhPx5rbia3pArv8Bgkzy22.UJi', 2, NULL, '2026-06-15 21:14:20', '2026-06-15 21:14:20', NULL),
	(8, 'Sofía', 'Martínez', 'sofia.martinez6@mail.com', '$2y$12$QvvhL5PGZeiLHI9xon9Cye8Pbnk58Wcy7sQikkrZAmsY7OtURTRQ6', 2, NULL, '2026-06-15 21:14:21', '2026-06-15 21:14:21', NULL),
	(9, 'Diego', 'Sánchez', 'diego.sanchez7@mail.com', '$2y$12$1xTRcSSi5RXFBSdZHB2ui.PHp3BqY8x4fjwU2i9J/LsCdkUWDr0yy', 2, NULL, '2026-06-15 21:14:22', '2026-06-15 21:14:22', NULL),
	(10, 'Valentina', 'Romero', 'valentina.romero8@mail.com', '$2y$12$.OiomC5lJbYXkotqTVBDCuAE1GhjWhLQR7GwUgnHrozYmboqLJipe', 2, NULL, '2026-06-15 21:14:23', '2026-06-15 21:14:23', NULL),
	(11, 'Javier', 'Torres', 'javier.torres9@mail.com', '$2y$12$L5qTGWaOh8CAR5DTV45Dte1gkPcNproQDb0jPtMx2TziWpEFqeIq.', 2, NULL, '2026-06-15 21:14:24', '2026-06-15 21:14:24', NULL),
	(12, 'Camila', 'Vargas', 'camila.vargas10@mail.com', '$2y$12$wXXZW2AjvNoRpr9iUW8IfOp3Ran32UDyIjfsF8JrKU4yRNjHSUq/a', 2, NULL, '2026-06-15 21:14:25', '2026-06-15 21:14:25', NULL),
	(13, 'Tomás', 'Herrera', 'tomas.herrera11@mail.com', '$2y$12$qwXbB6xSX3XENnh3jYhmNeo8g3aEk5SJIypHx9DR4KL.J3sK7l.cK', 2, NULL, '2026-06-15 21:14:26', '2026-06-15 21:14:26', NULL),
	(14, 'Florencia', 'Rojas', 'florencia.rojas12@mail.com', '$2y$12$tk3IgStiL4w7qC4mYZ8fHuw0H6m1at2uQ0ZbqIjIBW.kuJVEeaLmO', 2, NULL, '2026-06-15 21:14:27', '2026-06-15 21:14:27', NULL),
	(15, 'Nicolás', 'Castro', 'nicolas.castro13@mail.com', '$2y$12$KQ1a3gL3qrwm9w6g5nHDfei4PGMcYZESYsuSexfIoR3vPUz0wUmkO', 2, NULL, '2026-06-15 21:14:31', '2026-06-15 21:14:31', NULL),
	(16, 'Agustina', 'Silva', 'agustina.silva14@mail.com', '$2y$12$7cR58uFWBQGzF4HM9ptxqeEoC7rx0O54WPuZhi./jxx./0xhxdmmy', 2, NULL, '2026-06-15 21:14:33', '2026-06-15 21:14:33', NULL),
	(17, 'Mateo', 'Molina', 'mateo.molina15@mail.com', '$2y$12$spLz3W6SGfD/UMZv.UU2n.HP6YFrntoIZjPH6H.TODvhpqE3sOy4q', 2, NULL, '2026-06-15 21:14:34', '2026-06-15 21:14:34', NULL),
	(18, 'Julieta', 'Acosta', 'julieta.acosta16@mail.com', '$2y$12$bwnduxwyjmB1eufoCWmOZOa9qaMw/c3UMo2jYJVqZWxXPb3mzSAE.', 2, NULL, '2026-06-15 21:14:35', '2026-06-15 21:14:35', NULL),
	(19, 'Fernando', 'Méndez', 'fernando.mendez17@mail.com', '$2y$12$MoKUzUJgBt84kHSHBS49se8aC19stNTrIB6TyL0NT1I5EMgFfEN1W', 2, NULL, '2026-06-15 21:14:36', '2026-06-15 21:14:36', NULL),
	(20, 'Paula', 'Cabrera', 'paula.cabrera18@mail.com', '$2y$12$Vo7hBOi/XKzdn643YDhykO.wNjAJSFFmFv.pRAct9NPz1xyOqog1u', 2, NULL, '2026-06-15 21:14:39', '2026-06-15 21:14:39', NULL),
	(21, 'Emiliano', 'Suárez', 'emiliano.suarez19@mail.com', '$2y$12$Lj5twp/5QsaQ9huTseWR3ef05kR3cRcw5XCJ2MBNp5CIgC9FAmZo.', 2, NULL, '2026-06-15 21:14:40', '2026-06-15 21:14:40', NULL),
	(22, 'Romina', 'Ortega', 'romina.ortega20@mail.com', '$2y$12$FXCbTVFlR5dw4P9j.CeXR.gBijkr17QJyiKBC/WNcWiuPrUaDRSTa', 2, NULL, '2026-06-15 21:14:53', '2026-06-15 21:14:53', NULL),
	(23, 'Bruno', 'Alvarez', 'bruno.alvarez21@mail.com', '$2y$12$hcWTgRWb8DnfJ77sOIyDrOYVqVXsMrUsNPDY1KS5fKpphLziYC8wG', 2, NULL, '2026-06-15 21:15:48', '2026-06-15 21:15:48', NULL),
	(24, 'Daniela', 'Benítez', 'daniela.benitez22@mail.com', '$2y$12$dPsV/RflIoM1GruQu..7gOl28qzwiYO.Gb9riiGLL9s8OH3fzTF76', 2, NULL, '2026-06-15 21:15:48', '2026-06-15 21:15:48', NULL),
	(25, 'Ezequiel', 'Navarro', 'ezequiel.navarro23@mail.com', '$2y$12$bnuduELBy7/RrO5NES5x9OOxGjaP53gGV01E.oeHpInu4vTngCO7u', 2, NULL, '2026-06-15 21:15:49', '2026-06-15 21:15:49', NULL),
	(26, 'Melina', 'Vega', 'melina.vega24@mail.com', '$2y$12$Qv/8gx7iiDEsZwPIUlRZwefiEzwOsBYHuwP4v4QWS.uWphCYIdgP2', 2, NULL, '2026-06-15 21:15:50', '2026-06-15 21:15:50', NULL),
	(27, 'Gonzalo', 'Paz', 'gonzalo.paz25@mail.com', '$2y$12$jQPF789Nyz4xtejzcJNlw.2U9vJ7pvj8Q6eLgudKPaJOv4kmQdnni', 2, NULL, '2026-06-15 21:15:51', '2026-06-15 21:15:51', NULL),
	(28, 'Carolina', 'Ibarra', 'carolina.ibarra26@mail.com', '$2y$12$tuKYEdWtjkuS/ECZFCfAiOAs2QRrm6NDdTBjkcnnhMDk.BbNiu1KO', 2, NULL, '2026-06-15 21:15:51', '2026-06-15 21:15:51', NULL),
	(29, 'Leandro', 'Peralta', 'leandro.peralta27@mail.com', '$2y$12$xEx4qARn6BSVNSttpAkQEOuSFdv4DAESdxcqY5snapccjTj62jThi', 2, NULL, '2026-06-15 21:15:52', '2026-06-15 21:15:52', NULL),
	(30, 'Agustín', 'Luna', 'agustin.luna28@mail.com', '$2y$12$1sV0LQiF7uIWQ9hBsaGgO.H8IHTKW6Y.YmFCv9s173rRbrVUAlIIS', 2, NULL, '2026-06-15 21:15:53', '2026-06-15 21:15:53', NULL),
	(31, 'Micaela', 'Reyes', 'micaela.reyes29@mail.com', '$2y$12$EH.WynX3/l2W/1RYBVOJD.H65ajqjbOKda8RgEdmJdIHgeHNoLNcW', 2, NULL, '2026-06-15 21:15:54', '2026-06-15 21:15:54', NULL),
	(32, 'Santiago', 'Domínguez', 'santiago.dominguez30@mail.com', '$2y$12$Q.gJdDGXux0Jqe4mQYv.Hus8y/bOdXBtusPLzxOTd2yIfWJ77IwnS', 2, NULL, '2026-06-15 21:15:54', '2026-06-15 21:15:54', NULL),
	(33, 'Valeria', 'Flores', 'valeria.flores31@mail.com', '$2y$12$I4swVWIn0Kzv2/MDysOxWONiJYM1MD.aE3B6VyH6jEfvtl9S7GJgG', 2, NULL, '2026-06-15 21:15:55', '2026-06-15 21:15:55', NULL),
	(34, 'Lucas', 'Mendoza', 'lucas.mendoza32@mail.com', '$2y$12$Zj0iJXIznF/17jc4ojHYReK8OxxeKc5O7zwBRcDFUBQeB/fwaU7Wq', 2, NULL, '2026-06-15 21:15:56', '2026-06-15 21:15:56', NULL),
	(35, 'Antonella', 'Ríos', 'antonella.rios33@mail.com', '$2y$12$vQ8yRLIy88vO3Sdw9Cfc9O7NHMvwyiNaEGJIAC8ee/gv4yVgz.KFq', 2, NULL, '2026-06-15 21:15:57', '2026-06-15 21:15:57', NULL),
	(36, 'Facundo', 'Campos', 'facundo.campos34@mail.com', '$2y$12$bc6WPjt.wnaK7xzIZ5o/Kuza4Mdb3nkh6NcXaTusTPrut1O/34ACO', 2, NULL, '2026-06-15 21:15:57', '2026-06-15 21:15:57', NULL),
	(37, 'Bianca', 'Sosa', 'bianca.sosa35@mail.com', '$2y$12$vzDsvhJJX9/2ZMbRk4uKwe0Au4mgDlV9ajked8rkGLQK687JLnVqa', 2, NULL, '2026-06-15 21:16:00', '2026-06-15 21:16:00', NULL),
	(38, 'Natalia', 'Benitez', 'nataliabenitez237@gmail.com', '$2y$12$ZRCd2UQ8VpzGRgTHNAFYHeCaguOD5VnCcjqgEbdY80C2FA01nXe22', 2, NULL, '2026-06-18 03:08:26', '2026-06-18 03:08:26', NULL),
	(39, 'Admin', 'Principal', 'admin@teatro.com', '$2y$12$yefQyCNMbu1XhpLIXtlCj.gO6dcrOGUWndh2VuQUjoDVJxEYMXu7C', 1, NULL, '2026-06-18 19:51:32', '2026-06-18 19:51:32', NULL),
	(40, 'Esteban', 'Velazquez', 'leonel.esteban.kpo@gmail.com', '$2y$12$OGmMvnYoHLpUWqmrF8Gg..hvMlZrsO5U0h3FX3GkldCrxdCiWe5lG', 2, NULL, '2026-06-19 02:01:25', '2026-06-19 02:01:25', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
