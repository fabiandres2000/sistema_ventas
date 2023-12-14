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

LOCK TABLES `abonos_fiados` WRITE;

UNLOCK TABLES;

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

LOCK TABLES `clientes` WRITE;

insert  into `clientes`(`id`,`nombre`,`telefono`,`created_at`,`updated_at`) values 
(1,'Publico General','3042036320',NULL,NULL),
(2,'Fabian Quintero','301212244','2023-11-30 12:47:51','2023-11-30 12:47:51'),
(3,'Duvan Lopez','355454757','2023-11-30 12:48:03','2023-11-30 12:48:03'),
(4,'Juan Jose Lopez','55649898978','2023-11-30 12:48:19','2023-11-30 12:48:19');

UNLOCK TABLES;

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

LOCK TABLES `fiados` WRITE;

UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `productos` */

LOCK TABLES `productos` WRITE;

insert  into `productos`(`id`,`codigo_barras`,`descripcion`,`categoria`,`precio_compra`,`precio_venta`,`existencia`,`unidad_medida`,`imagen`,`created_at`,`updated_at`) values 
(22,'e7707738871508','GTI Moto lubricante','Otros',5000.00,6000.00,35.00,'Unidades','1702509682.jpg','2023-12-13 17:21:22','2023-12-13 17:21:22'),
(23,'e7702006300087','gel ego','Otros',2000.00,5000.00,10.00,'Unidades','1702509730.jpg','2023-12-13 17:22:10','2023-12-13 17:22:10'),
(27,'e7702354954116','ricostilla','Alimentos',4000.00,4500.00,7.00,'Unidades','1702509944.jpg','2023-12-13 17:25:44','2023-12-13 17:39:39'),
(28,'e7704269673724','shampo dylia','Aseo',10000.00,12000.00,18.00,'Unidades','1702510023.jpg','2023-12-13 17:27:03','2023-12-14 07:38:23'),
(30,'e7702032253074','colcafe vainilla','Alimentos',10000.00,11200.00,19.00,'Unidades','1702510310.jpg','2023-12-13 17:31:50','2023-12-14 07:38:24'),
(31,'e7704269105478','crema de cuerpo','Aseo',8000.00,9500.00,8.00,'Unidades','1702510342.jpg','2023-12-13 17:32:22','2023-12-14 07:38:23'),
(32,'e9788571403390','libro escolar','Otros',5000.00,5500.00,4.00,'Unidades','1702510392.jpg','2023-12-13 17:33:12','2023-12-13 17:39:39'),
(33,'1','papa pastusa','Alimentos',1000.00,1200.00,48.33,'Libras','1702558088.jpg','2023-12-14 06:48:08','2023-12-14 07:35:26');

UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `productos_vendidos` */

LOCK TABLES `productos_vendidos` WRITE;

insert  into `productos_vendidos`(`id`,`id_venta`,`descripcion`,`codigo_barras`,`precio`,`cantidad`,`unidad`,`created_at`,`updated_at`) values 
(50,38,'papa pastusa','1',1200.00,1.667,'Lb','2023-12-14 07:35:26','2023-12-14 07:35:26'),
(51,39,'crema de cuerpo','e7704269105478',9500.00,2.000,'Und','2023-12-14 07:38:23','2023-12-14 07:38:23'),
(52,39,'shampo dylia','e7704269673724',12000.00,1.000,'Und','2023-12-14 07:38:23','2023-12-14 07:38:23'),
(53,39,'colcafe vainilla','e7702032253074',11200.00,1.000,'Und','2023-12-14 07:38:24','2023-12-14 07:38:24');

UNLOCK TABLES;

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

LOCK TABLES `users` WRITE;

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,'fabian','grovveip@gmail.com',NULL,'$2y$10$aWRDPNE5Fhg.sMtN4f6K7.5ZJ6DFhfmz4qHSAZcVItoW/FWwrUTCG',NULL,'2023-11-29 11:59:46','2023-11-29 11:59:46');

UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ventas` */

LOCK TABLES `ventas` WRITE;

insert  into `ventas`(`id`,`created_at`,`updated_at`,`id_cliente`,`total_pagar`,`total_dinero`,`total_fiado`,`total_vueltos`,`fecha_venta`) values 
(38,'2023-12-14 07:35:26','2023-12-14 07:35:26',1,2000,2000,0,0,'2023-12-14'),
(39,'2023-12-14 07:38:23','2023-12-14 07:38:23',1,42200,45000,0,2800,'2023-12-14');

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
