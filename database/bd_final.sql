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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `fiados` */

insert  into `fiados`(`id`,`id_cliente`,`id_factura`,`total_fiado`) values 
(5,3,40,15500),
(6,2,41,3000);

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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `productos` */

insert  into `productos`(`id`,`codigo_barras`,`descripcion`,`categoria`,`precio_compra`,`precio_venta`,`existencia`,`unidad_medida`,`imagen`,`created_at`,`updated_at`) values 
(22,'e7707738871508','GTI Moto lubricante','Otros',5000.00,6000.00,33.00,'Unidades','1702509682.jpg','2023-12-13 17:21:22','2023-12-14 18:51:45'),
(23,'e7702006300087','gel ego','Otros',2000.00,5000.00,3.00,'Unidades','1702509730.jpg','2023-12-13 17:22:10','2023-12-14 19:04:48'),
(27,'e7702354954116','ricostilla','Alimentos',4000.00,4500.00,0.00,'Unidades','1702509944.jpg','2023-12-13 17:25:44','2023-12-14 18:59:11'),
(28,'e7704269673724','shampo dylia','Aseo',10000.00,12000.00,14.00,'Unidades','1702510023.jpg','2023-12-13 17:27:03','2023-12-14 18:51:45'),
(30,'e7702032253074','colcafe vainilla','Alimentos',10000.00,11200.00,14.00,'Unidades','1702510310.jpg','2023-12-13 17:31:50','2023-12-14 18:59:11'),
(31,'e7704269105478','crema de cuerpo','Aseo',8000.00,9500.00,5.00,'Unidades','1702510342.jpg','2023-12-13 17:32:22','2023-12-14 18:51:45'),
(32,'e9788571403390','libro escolar','Otros',5000.00,5500.00,5.00,'Unidades','1702510392.jpg','2023-12-13 17:33:12','2023-12-14 19:06:07'),
(33,'1','papa pastusa','Alimentos',1000.00,1200.00,34.42,'Libras','1702558088.jpg','2023-12-14 06:48:08','2023-12-14 19:06:07'),
(34,'e7702020011228','arina de trigo','Alimentos',2400.00,2800.00,19.00,'Unidades',NULL,'2023-12-14 18:58:14','2023-12-14 18:59:11');

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
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `productos_vendidos` */

insert  into `productos_vendidos`(`id`,`id_venta`,`descripcion`,`codigo_barras`,`precio`,`cantidad`,`unidad`,`created_at`,`updated_at`) values 
(50,38,'papa pastusa','1',1200.00,1.667,'Lb','2023-12-14 07:35:26','2023-12-14 07:35:26'),
(51,39,'crema de cuerpo','e7704269105478',9500.00,2.000,'Und','2023-12-14 07:38:23','2023-12-14 07:38:23'),
(52,39,'shampo dylia','e7704269673724',12000.00,1.000,'Und','2023-12-14 07:38:23','2023-12-14 07:38:23'),
(53,39,'colcafe vainilla','e7702032253074',11200.00,1.000,'Und','2023-12-14 07:38:24','2023-12-14 07:38:24'),
(54,40,'papa pastusa','1',1200.00,5.000,'Lb','2023-12-14 18:26:30','2023-12-14 18:26:30'),
(55,40,'GTI Moto lubricante','e7707738871508',6000.00,1.000,'Und','2023-12-14 18:26:30','2023-12-14 18:26:30'),
(56,40,'ricostilla','e7702354954116',4500.00,2.000,'Und','2023-12-14 18:26:30','2023-12-14 18:26:30'),
(57,40,'shampo dylia','e7704269673724',12000.00,2.000,'Und','2023-12-14 18:26:30','2023-12-14 18:26:30'),
(58,40,'libro escolar','e9788571403390',5500.00,2.000,'Und','2023-12-14 18:26:30','2023-12-14 18:26:30'),
(59,40,'crema de cuerpo','e7704269105478',9500.00,1.000,'Und','2023-12-14 18:26:30','2023-12-14 18:26:30'),
(60,41,'papa pastusa','1',1200.00,2.500,'Lb','2023-12-14 18:47:08','2023-12-14 18:47:08'),
(61,41,'gel ego','e7702006300087',5000.00,5.000,'Und','2023-12-14 18:47:08','2023-12-14 18:47:08'),
(62,42,'GTI Moto lubricante','e7707738871508',6000.00,1.000,'Und','2023-12-14 18:51:45','2023-12-14 18:51:45'),
(63,42,'gel ego','e7702006300087',5000.00,1.000,'Und','2023-12-14 18:51:45','2023-12-14 18:51:45'),
(64,42,'ricostilla','e7702354954116',4500.00,1.000,'Und','2023-12-14 18:51:45','2023-12-14 18:51:45'),
(65,42,'shampo dylia','e7704269673724',12000.00,2.000,'Und','2023-12-14 18:51:45','2023-12-14 18:51:45'),
(66,42,'colcafe vainilla','e7702032253074',11200.00,3.000,'Und','2023-12-14 18:51:45','2023-12-14 18:51:45'),
(67,42,'crema de cuerpo','e7704269105478',9500.00,2.000,'Und','2023-12-14 18:51:45','2023-12-14 18:51:45'),
(68,42,'libro escolar','e9788571403390',5500.00,2.000,'Und','2023-12-14 18:51:45','2023-12-14 18:51:45'),
(69,42,'papa pastusa','1',1200.00,4.333,'Lb','2023-12-14 18:51:45','2023-12-14 18:51:45'),
(70,43,'ricostilla','e7702354954116',4500.00,4.000,'Und','2023-12-14 18:59:11','2023-12-14 18:59:11'),
(71,43,'colcafe vainilla','e7702032253074',11200.00,2.000,'Und','2023-12-14 18:59:11','2023-12-14 18:59:11'),
(72,43,'arina de trigo','e7702020011228',2800.00,1.000,'Und','2023-12-14 18:59:11','2023-12-14 18:59:11'),
(73,43,'libro escolar','e9788571403390',5500.00,1.000,'Und','2023-12-14 18:59:11','2023-12-14 18:59:11'),
(74,44,'libro escolar','e9788571403390',5500.00,2.000,'Und','2023-12-14 19:04:48','2023-12-14 19:04:48'),
(75,44,'gel ego','e7702006300087',5000.00,1.000,'Und','2023-12-14 19:04:48','2023-12-14 19:04:48'),
(76,45,'libro escolar','e9788571403390',5500.00,2.000,'Und','2023-12-14 19:06:07','2023-12-14 19:06:07'),
(77,45,'papa pastusa','1',1200.00,2.083,'Lb','2023-12-14 19:06:07','2023-12-14 19:06:07');

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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ventas` */

insert  into `ventas`(`id`,`created_at`,`updated_at`,`id_cliente`,`total_pagar`,`total_dinero`,`total_fiado`,`total_vueltos`,`fecha_venta`) values 
(38,'2023-12-14 07:35:26','2023-12-14 07:35:26',1,2000,2000,0,0,'2023-12-14'),
(39,'2023-12-14 07:38:23','2023-12-14 07:38:23',1,42200,45000,0,2800,'2023-12-14'),
(40,'2023-12-14 18:26:30','2023-12-14 18:26:30',3,65500,50000,15500,-15500,'2023-12-14'),
(41,'2023-12-14 18:47:08','2023-12-14 18:47:08',2,28000,25000,3000,-3000,'2023-12-14'),
(42,'2023-12-14 18:51:45','2023-12-14 18:51:45',4,108300,108300,0,0,'2023-12-14'),
(43,'2023-12-14 18:59:11','2023-12-14 18:59:11',1,48700,49000,0,300,'2023-12-14'),
(44,'2023-12-14 19:04:48','2023-12-14 19:04:48',1,16000,16000,0,0,'2023-12-14'),
(45,'2023-12-14 19:06:07','2023-12-14 19:06:07',1,13500,13500,0,0,'2023-12-14');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
