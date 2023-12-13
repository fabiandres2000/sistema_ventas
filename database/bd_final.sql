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
USE `punto_venta`;

/*Table structure for table `abonos_fiados` */

DROP TABLE IF EXISTS `abonos_fiados`;

CREATE TABLE `abonos_fiados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int DEFAULT NULL,
  `valor_abonado` double DEFAULT NULL,
  `fecha_abono` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `abonos_fiados` */

insert  into `abonos_fiados`(`id`,`id_cliente`,`valor_abonado`,`fecha_abono`) values 
(15,2,10040,'12-12-2023 16:18:35');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `fiados` */

insert  into `fiados`(`id`,`id_cliente`,`id_factura`,`total_fiado`) values 
(3,2,19,11040),
(4,3,20,10200);

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
  `unidad_medida` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `imagen` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `productos` */

insert  into `productos`(`id`,`codigo_barras`,`descripcion`,`categoria`,`precio_compra`,`precio_venta`,`existencia`,`unidad_medida`,`imagen`,`created_at`,`updated_at`) values 
(10,'papa_sin_lavar','papa sin lavar','Alimentos',1000.00,1200.00,33.43,'Libras','1701299580.jpg','2023-11-29 17:13:00','2023-12-13 12:31:54'),
(12,'435345345','mayonesa fruco','Alimentos',1000.00,1200.00,26.00,'Unidades','1701299800.jpg','2023-11-29 17:16:40','2023-12-13 12:26:55'),
(13,'7657567567','salsa de tomate fruco','Alimentos',1000.00,1200.00,26.00,'Unidades','1701299828.jpg','2023-11-29 17:17:08','2023-12-13 12:31:54'),
(14,'7657567568','limpido','Aseo',3000.00,3800.00,17.00,'Unidades','1701300016.jpg','2023-11-29 17:20:16','2023-12-12 17:09:10'),
(15,'7867865345','trapero','Aseo',2000.00,2900.00,8.00,'Unidades','1701300701.jpg','2023-11-29 17:31:41','2023-12-13 12:31:54'),
(16,'8678768678678','escoba de piso','Aseo',4000.00,5000.00,9.00,'Unidades','1701300744.jpg','2023-11-29 17:32:24','2023-12-13 12:26:55'),
(17,'979876896','postobon personal','Bebidas',1800.00,2500.00,10.00,'Unidades','1701300797.jpg','2023-11-29 17:33:17','2023-11-30 13:56:02'),
(18,'345345345','coca cola personal','Bebidas',1800.00,2600.00,15.00,'Unidades','1701300847.jpg','2023-11-29 17:34:07','2023-12-12 17:10:11'),
(19,'6567657567','soda','Bebidas',1200.00,1500.00,9.00,'Unidades','1701301537.jpg','2023-11-29 17:45:37','2023-12-12 17:37:48'),
(21,'222222222','guineo verde','Alimentos',1600.00,2000.00,6.85,'Libras','1701361632.jpg','2023-11-30 10:27:12','2023-12-13 12:35:26');

/*Table structure for table `productos_vendidos` */

DROP TABLE IF EXISTS `productos_vendidos`;

CREATE TABLE `productos_vendidos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_venta` bigint unsigned NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo_barras` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` decimal(9,2) NOT NULL,
  `cantidad` decimal(9,3) NOT NULL,
  `unidad` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productos_vendidos_id_venta_foreign` (`id_venta`),
  CONSTRAINT `productos_vendidos_id_venta_foreign` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(20,26,'papa sin lavar','papa_sin_lavar',1200.00,2.083,'Lb','2023-12-12 15:57:13','2023-12-12 15:57:13'),
(21,27,'guineo verde','222222222',2000.00,1.250,'Kg','2023-12-12 16:05:40','2023-12-12 16:05:40'),
(22,27,'limpido','7657567568',3800.00,1.000,'Und','2023-12-12 16:05:40','2023-12-12 16:05:40'),
(23,28,'limpido','7657567568',3800.00,1.000,'Und','2023-12-12 17:09:10','2023-12-12 17:09:10'),
(24,29,'coca cola personal','345345345',2600.00,1.000,'Und','2023-12-12 17:10:11','2023-12-12 17:10:11'),
(25,29,'salsa de tomate fruco','7657567567',1200.00,1.000,'Und','2023-12-12 17:10:11','2023-12-12 17:10:11'),
(26,30,'salsa de tomate fruco','7657567567',1200.00,1.000,'Und','2023-12-12 17:37:48','2023-12-12 17:37:48'),
(27,30,'guineo verde','222222222',2000.00,1.250,'Lb','2023-12-12 17:37:48','2023-12-12 17:37:48'),
(28,30,'soda','6567657567',1500.00,1.000,'Und','2023-12-12 17:37:48','2023-12-12 17:37:48'),
(29,30,'trapero','7867865345',2900.00,1.000,'Und','2023-12-12 17:37:48','2023-12-12 17:37:48'),
(30,30,'escoba de piso','8678768678678',5000.00,2.000,'Und','2023-12-12 17:37:48','2023-12-12 17:37:48'),
(31,31,'guineo verde','222222222',2000.00,10.000,'Lb','2023-12-12 17:38:30','2023-12-12 17:38:30'),
(35,33,'guineo verde','222222222',2000.00,2.657,'Lb','2023-12-13 12:25:38','2023-12-13 12:25:38'),
(36,33,'mayonesa fruco','435345345',1200.00,2.000,'Und','2023-12-13 12:25:38','2023-12-13 12:25:38'),
(37,34,'papa sin lavar','papa_sin_lavar',1200.00,2.657,'Lb','2023-12-13 12:26:55','2023-12-13 12:26:55'),
(38,34,'guineo verde','222222222',2000.00,4.167,'Lb','2023-12-13 12:26:55','2023-12-13 12:26:55'),
(39,34,'mayonesa fruco','435345345',1200.00,1.000,'Und','2023-12-13 12:26:55','2023-12-13 12:26:55'),
(40,34,'escoba de piso','8678768678678',5000.00,1.000,'Und','2023-12-13 12:26:55','2023-12-13 12:26:55'),
(41,34,'salsa de tomate fruco','7657567567',1200.00,1.000,'Und','2023-12-13 12:26:55','2023-12-13 12:26:55'),
(42,35,'guineo verde','222222222',2000.00,2.657,'Lb','2023-12-13 12:31:54','2023-12-13 12:31:54'),
(43,35,'papa sin lavar','papa_sin_lavar',1200.00,2.657,'Lb','2023-12-13 12:31:54','2023-12-13 12:31:54'),
(44,35,'trapero','7867865345',2900.00,1.000,'Und','2023-12-13 12:31:54','2023-12-13 12:31:54'),
(45,35,'salsa de tomate fruco','7657567567',1200.00,1.000,'Und','2023-12-13 12:31:54','2023-12-13 12:31:54'),
(46,36,'guineo verde','222222222',2000.00,2.220,'Lb','2023-12-13 12:35:26','2023-12-13 12:35:26');

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
  `fecha_venta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `ventas_id_cliente_foreign` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ventas` */

insert  into `ventas`(`id`,`created_at`,`updated_at`,`id_cliente`,`total_pagar`,`total_dinero`,`total_fiado`,`total_vueltos`,`fecha_venta`) values 
(19,'2023-11-30 13:55:06','2023-11-30 13:55:06',2,17040,6000,11040,-11040.5,'2023-11-30'),
(20,'2023-11-30 13:56:02','2023-11-30 13:56:02',3,12700,2500,10200,-10200,'2023-11-30'),
(24,'2023-11-30 14:04:15','2023-11-30 14:04:15',1,950,950,0,0,'2023-11-30'),
(25,'2023-11-30 14:14:59','2023-11-30 14:14:59',3,3200,4000,0,800,'2023-11-30'),
(26,'2023-12-12 15:57:13','2023-12-12 15:57:13',1,2500,2500,0,0,'2023-12-12'),
(27,'2023-12-12 16:05:40','2023-12-12 16:05:40',2,6300,7000,0,700,'2023-12-12'),
(28,'2023-12-12 17:09:10','2023-12-12 17:09:10',1,3800,3800,0,0,'2023-12-12'),
(29,'2023-12-12 17:10:11','2023-12-12 17:10:11',1,3800,3800,0,0,'2023-12-12'),
(30,'2023-12-12 17:37:48','2023-12-12 17:37:48',2,18100,18100,0,0,'2023-12-12'),
(31,'2023-12-12 17:38:30','2023-12-12 17:38:30',1,20000,20000,0,0,'2023-12-12'),
(33,'2023-12-13 12:25:38','2023-12-13 12:25:38',1,7700,7700,0,0,'2023-12-13'),
(34,'2023-12-13 12:26:55','2023-12-13 12:26:55',1,18900,18900,0,0,'2023-12-13'),
(35,'2023-12-13 12:31:54','2023-12-13 12:31:54',2,12600,12600,0,0,'2023-12-13'),
(36,'2023-12-13 12:35:26','2023-12-13 12:35:26',1,4400,4400,0,0,'2023-12-13');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
