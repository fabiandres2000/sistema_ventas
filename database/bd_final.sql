/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 8.0.35 : Database - punto_venta
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`punto_venta` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `punto_venta`;

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `clientes` */

insert  into `clientes`(`id`,`nombre`,`telefono`,`created_at`,`updated_at`) values 
(1,'Publico General','3042036320',NULL,NULL);

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2016_06_01_000001_create_oauth_auth_codes_table',1),
(4,'2016_06_01_000002_create_oauth_access_tokens_table',1),
(5,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),
(6,'2016_06_01_000004_create_oauth_clients_table',1),
(7,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),
(8,'2019_08_19_000000_create_failed_jobs_table',1),
(9,'2020_03_04_190205_create_productos_table',1),
(10,'2020_03_05_003009_create_ventas_table',1),
(11,'2020_03_05_003110_create_producto_vendidos_table',1),
(12,'2020_03_10_014423_create_clientes_table',1),
(13,'2020_03_10_023628_agregar_id_cliente_ventas',1);

/*Table structure for table `oauth_access_tokens` */

DROP TABLE IF EXISTS `oauth_access_tokens`;

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `client_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_access_tokens` */

/*Table structure for table `oauth_auth_codes` */

DROP TABLE IF EXISTS `oauth_auth_codes`;

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_auth_codes` */

/*Table structure for table `oauth_clients` */

DROP TABLE IF EXISTS `oauth_clients`;

CREATE TABLE `oauth_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_clients` */

/*Table structure for table `oauth_personal_access_clients` */

DROP TABLE IF EXISTS `oauth_personal_access_clients`;

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_personal_access_clients` */

/*Table structure for table `oauth_refresh_tokens` */

DROP TABLE IF EXISTS `oauth_refresh_tokens`;

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_refresh_tokens` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `productos` */

DROP TABLE IF EXISTS `productos`;

CREATE TABLE `productos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `codigo_barras` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria` text COLLATE utf8mb4_unicode_ci,
  `precio_compra` decimal(9,2) NOT NULL,
  `precio_venta` decimal(9,2) NOT NULL,
  `existencia` decimal(9,2) NOT NULL,
  `imagen` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `productos` */

insert  into `productos`(`id`,`codigo_barras`,`descripcion`,`categoria`,`precio_compra`,`precio_venta`,`existencia`,`imagen`,`created_at`,`updated_at`) values 
(10,'no','papa sin lavar','Alimentos',1000.00,1200.00,20.00,'1701299580.jpg','2023-11-29 17:13:00','2023-11-29 17:13:00'),
(12,'435345345','mayonesa fruco','Alimentos',1000.00,1200.00,5.00,'1701299800.jpg','2023-11-29 17:16:40','2023-11-29 17:16:40'),
(13,'7657567567','salsa de tomate fruco','Alimentos',1000.00,1200.00,15.00,'1701299828.jpg','2023-11-29 17:17:08','2023-11-29 17:17:08'),
(14,'7657567568','limpido','Aseo',3000.00,3800.00,20.00,'1701300016.jpg','2023-11-29 17:20:16','2023-11-29 17:26:40'),
(15,'7867865345','trapero','Aseo',2000.00,2900.00,10.00,'1701300701.jpg','2023-11-29 17:31:41','2023-11-29 17:31:41'),
(16,'8678768678678','escoba de piso','Aseo',4000.00,5000.00,15.00,'1701300744.jpg','2023-11-29 17:32:24','2023-11-29 17:32:24'),
(17,'979876896','postobon personal','Bebidas',1800.00,2500.00,15.00,'1701300797.jpg','2023-11-29 17:33:17','2023-11-29 17:33:17'),
(18,'345345345','coca cola personal','Bebidas',1800.00,2600.00,20.00,'1701300847.jpg','2023-11-29 17:34:07','2023-11-29 17:34:07'),
(19,'6567657567','soda','Bebidas',1200.00,1500.00,10.00,'1701301537.jpg','2023-11-29 17:45:37','2023-11-29 17:45:37');

/*Table structure for table `productos_vendidos` */

DROP TABLE IF EXISTS `productos_vendidos`;

CREATE TABLE `productos_vendidos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_venta` bigint unsigned NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo_barras` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` decimal(9,2) NOT NULL,
  `cantidad` decimal(9,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productos_vendidos_id_venta_foreign` (`id_venta`),
  CONSTRAINT `productos_vendidos_id_venta_foreign` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `productos_vendidos` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,'fabian','grovveip@gmail.com',NULL,'$2y$10$aWRDPNE5Fhg.sMtN4f6K7.5ZJ6DFhfmz4qHSAZcVItoW/FWwrUTCG',NULL,'2023-11-29 11:59:46','2023-11-29 11:59:46');

/*Table structure for table `ventas` */

DROP TABLE IF EXISTS `ventas`;

CREATE TABLE `ventas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_cliente` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ventas_id_cliente_foreign` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ventas` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
