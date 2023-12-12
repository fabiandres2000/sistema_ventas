/*
SQLyog Community v13.2.0 (64 bit)
MySQL - 8.0.30 : Database - punto_venta
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`punto_venta` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `punto_venta`;

/*Table structure for table `abonos_fiados` */

DROP TABLE IF EXISTS `abonos_fiados`;

CREATE TABLE `abonos_fiados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int DEFAULT NULL,
  `valor_abonado` double DEFAULT NULL,
  `fecha_abono` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `abonos_fiados` */

insert  into `abonos_fiados`(`id`,`id_cliente`,`valor_abonado`,`fecha_abono`) values 
(1,3,2000,'01-12-2023 09:40:54'),
(2,3,2000,'01-12-2023 09:41:14'),
(3,3,1000,'01-12-2023 09:53:36'),
(4,2,3000,'01-12-2023 09:53:47'),
(5,2,3000,'01-12-2023 09:55:49'),
(13,2,1500,'01-12-2023 09:59:56'),
(14,3,500,'01-12-2023 10:00:09');

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `clientes` */

insert  into `clientes`(`id`,`nombre`,`telefono`,`created_at`,`updated_at`) values 
(1,'Publico General','3042036320',NULL,NULL),
(2,'Fabian Quintero','301212244','2023-11-30 12:47:51','2023-11-30 12:47:51'),
(3,'Duvan Lopez','355454757','2023-11-30 12:48:03','2023-11-30 12:48:03'),
(4,'Juan Jose Lopez','55649898978','2023-11-30 12:48:19','2023-11-30 12:48:19');

/*Table structure for table `fiados` */

DROP TABLE IF EXISTS `fiados`;

CREATE TABLE `fiados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int DEFAULT NULL,
  `id_factura` int DEFAULT NULL,
  `total_fiado` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `fiados` */

insert  into `fiados`(`id`,`id_cliente`,`id_factura`,`total_fiado`) values 
(3,2,19,13540.5),
(4,3,20,10200),
(6,3,30,1500),
(7,4,31,1500);

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

/*Table structure for table `productos` */

DROP TABLE IF EXISTS `productos`;

CREATE TABLE `productos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `codigo_barras` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `precio_compra` decimal(9,2) NOT NULL,
  `precio_venta` decimal(9,2) NOT NULL,
  `existencia` decimal(9,2) NOT NULL,
  `unidad_medida` text COLLATE utf8mb4_unicode_ci,
  `imagen` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `productos` */

insert  into `productos`(`id`,`codigo_barras`,`descripcion`,`categoria`,`precio_compra`,`precio_venta`,`existencia`,`unidad_medida`,`imagen`,`created_at`,`updated_at`) values 
(10,'papa_sin_lavar','papa sin lavar','Alimentos',1000.00,1200.00,21.23,'Kilos','1701299580.jpg','2023-11-29 17:13:00','2023-11-30 14:14:59'),
(12,'435345345','mayonesa fruco','Alimentos',1000.00,1200.00,20.00,'Unidades','1701299800.jpg','2023-11-29 17:16:40','2023-11-30 10:34:36'),
(13,'7657567567','salsa de tomate fruco','Alimentos',1000.00,1200.00,11.00,'Unidades','1701299828.jpg','2023-11-29 17:17:08','2023-11-30 10:30:17'),
(14,'7657567568','limpido','Aseo',3000.00,3800.00,19.00,'Unidades','1701300016.jpg','2023-11-29 17:20:16','2023-11-30 13:32:57'),
(15,'7867865345','trapero','Aseo',2000.00,2900.00,7.00,'Unidades','1701300701.jpg','2023-11-29 17:31:41','2023-12-01 06:44:25'),
(16,'8678768678678','escoba de piso','Aseo',4000.00,5000.00,10.00,'Unidades','1701300744.jpg','2023-11-29 17:32:24','2023-12-01 06:44:25'),
(17,'979876896','postobon personal','Bebidas',1800.00,2500.00,8.00,'Unidades','1701300797.jpg','2023-11-29 17:33:17','2023-12-01 08:34:34'),
(18,'345345345','coca cola personal','Bebidas',1800.00,2600.00,16.00,'Unidades','1701300847.jpg','2023-11-29 17:34:07','2023-11-30 13:56:02'),
(19,'6567657567','soda','Bebidas',1200.00,1500.00,9.00,'Unidades','1701301537.jpg','2023-11-29 17:45:37','2023-12-01 10:01:15'),
(21,'222222222','guineo verde','Alimentos',1600.00,2000.00,13.73,'Kilos','1701361632.jpg','2023-11-30 10:27:12','2023-11-30 14:14:59');

/*Table structure for table `productos_vendidos` */

DROP TABLE IF EXISTS `productos_vendidos`;

CREATE TABLE `productos_vendidos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_venta` bigint unsigned NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo_barras` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` decimal(9,2) NOT NULL,
  `cantidad` decimal(9,3) NOT NULL,
  `unidad` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productos_vendidos_id_venta_foreign` (`id_venta`),
  CONSTRAINT `productos_vendidos_id_venta_foreign` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `productos_vendidos` */

insert  into `productos_vendidos`(`id`,`id_venta`,`descripcion`,`codigo_barras`,`precio`,`cantidad`,`unidad`,`created_at`,`updated_at`) values 
(10,19,'guineo verde','222222222',2000.00,4.260,'Kg','2023-11-30 13:55:06','2023-11-30 13:55:06'),
(11,19,'papa sin lavar','papa_sin_lavar',1200.00,7.100,'Kg','2023-11-30 13:55:06','2023-11-30 13:55:06'),
(12,20,'coca cola personal','345345345',2600.00,2.000,'Und','2023-11-30 13:56:02','2023-11-30 13:56:02'),
(13,20,'postobon personal','979876896',2500.00,1.000,'Und','2023-11-30 13:56:02','2023-11-30 13:56:02'),
(14,20,'escoba de piso','8678768678678',5000.00,1.000,'Und','2023-11-30 13:56:02','2023-11-30 13:56:02'),
(17,24,'guineo verde','222222222',2000.00,0.475,'Kg','2023-11-30 14:04:15','2023-11-30 14:04:15'),
(18,25,'papa sin lavar','papa_sin_lavar',1200.00,1.667,'Kg','2023-11-30 14:14:59','2023-11-30 14:14:59'),
(19,25,'guineo verde','222222222',2000.00,0.600,'Kg','2023-11-30 14:14:59','2023-11-30 14:14:59'),
(20,26,'trapero','7867865345',2900.00,1.000,'Und','2023-12-01 06:42:34','2023-12-01 06:42:34'),
(21,27,'trapero','7867865345',2900.00,1.000,'Und','2023-12-01 06:43:35','2023-12-01 06:43:35'),
(22,28,'trapero','7867865345',2900.00,1.000,'Und','2023-12-01 06:44:25','2023-12-01 06:44:25'),
(23,28,'escoba de piso','8678768678678',5000.00,2.000,'Und','2023-12-01 06:44:25','2023-12-01 06:44:25'),
(24,29,'postobon personal','979876896',2500.00,1.000,'Und','2023-12-01 08:27:34','2023-12-01 08:27:34'),
(25,30,'postobon personal','979876896',2500.00,1.000,'Und','2023-12-01 08:34:34','2023-12-01 08:34:34'),
(26,31,'soda','6567657567',1500.00,1.000,'Und','2023-12-01 10:01:15','2023-12-01 10:01:15');

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
  `total_pagar` double DEFAULT NULL,
  `total_dinero` double DEFAULT NULL,
  `total_fiado` double DEFAULT NULL,
  `total_vueltos` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ventas_id_cliente_foreign` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ventas` */

insert  into `ventas`(`id`,`created_at`,`updated_at`,`id_cliente`,`total_pagar`,`total_dinero`,`total_fiado`,`total_vueltos`) values 
(19,'2023-11-30 13:55:06','2023-11-30 13:55:06',2,17040.5,6000,11040.5,-11040.5),
(20,'2023-11-30 13:56:02','2023-11-30 13:56:02',3,12700,2500,10200,-10200),
(24,'2023-11-30 14:04:15','2023-11-30 14:04:15',1,950,950,0,0),
(25,'2023-11-30 14:14:59','2023-11-30 14:14:59',3,3200,4000,0,800),
(26,'2023-12-01 06:42:34','2023-12-01 06:42:34',1,2900,3000,0,100),
(27,'2023-12-01 06:43:35','2023-12-01 06:43:35',2,2900,4000,0,1100),
(28,'2023-12-01 06:44:25','2023-12-01 06:44:25',1,12900,15000,0,2100),
(29,'2023-12-01 08:27:34','2023-12-01 08:27:34',2,2500,0,2500,-2500),
(30,'2023-12-01 08:34:34','2023-12-01 08:34:34',3,2500,1000,1500,-1500),
(31,'2023-12-01 10:01:15','2023-12-01 10:01:15',4,1500,0,1500,-1500);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
