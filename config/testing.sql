/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.24-MariaDB : Database - testing
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`testing` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `testing`;

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id_cust` int(11) NOT NULL AUTO_INCREMENT,
  `nama_cust` varchar(255) DEFAULT NULL,
  `no_telp` int(15) DEFAULT NULL,
  `alamat_cust` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date_input` datetime DEFAULT NULL,
  PRIMARY KEY (`id_cust`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `customers` */

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id_orders` int(11) NOT NULL,
  `no_invoice` varchar(250) DEFAULT NULL,
  `id_cust` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `satuan` varchar(100) DEFAULT NULL,
  `status_orders` int(11) DEFAULT NULL,
  `date_input` datetime DEFAULT NULL,
  PRIMARY KEY (`id_orders`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `orders` */

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id_products` int(11) NOT NULL AUTO_INCREMENT,
  `nama_products` varchar(250) DEFAULT NULL,
  `satuan` varchar(100) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `status_products` int(11) DEFAULT NULL,
  `date_input` datetime DEFAULT NULL,
  PRIMARY KEY (`id_products`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `products` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL AUTO_INCREMENT,
  `nama_users` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date_input` datetime DEFAULT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
