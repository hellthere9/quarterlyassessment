/*
SQLyog Community v13.2.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - assessment
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`assessment` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `assessment`;

/*Table structure for table `school` */

DROP TABLE IF EXISTS `school`;

CREATE TABLE `school` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schoolid` int(10) DEFAULT NULL,
  `division` varchar(19) DEFAULT NULL,
  `name` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `subjects` */

DROP TABLE IF EXISTS `subjects`;

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gradelevel` int(2) DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `file` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `tb_answers` */

DROP TABLE IF EXISTS `tb_answers`;

CREATE TABLE `tb_answers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `schoolid` int(6) DEFAULT NULL,
  `LRN` int(12) DEFAULT NULL,
  `studname` varchar(50) DEFAULT NULL,
  `gradelevel` int(2) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `a1` varchar(1) DEFAULT NULL,
  `a2` varchar(1) DEFAULT NULL,
  `a3` varchar(1) DEFAULT NULL,
  `a4` varchar(1) DEFAULT NULL,
  `a5` varchar(1) DEFAULT NULL,
  `a6` varchar(1) DEFAULT NULL,
  `a7` varchar(1) DEFAULT NULL,
  `a8` varchar(1) DEFAULT NULL,
  `a9` varchar(1) DEFAULT NULL,
  `a10` varchar(1) DEFAULT NULL,
  `a11` varchar(1) DEFAULT NULL,
  `a12` varchar(1) DEFAULT NULL,
  `a13` varchar(1) DEFAULT NULL,
  `a14` varchar(1) DEFAULT NULL,
  `a15` varchar(1) DEFAULT NULL,
  `a16` varchar(1) DEFAULT NULL,
  `a17` varchar(1) DEFAULT NULL,
  `a18` varchar(1) DEFAULT NULL,
  `a19` varchar(1) DEFAULT NULL,
  `a20` varchar(1) DEFAULT NULL,
  `a21` varchar(1) DEFAULT NULL,
  `a22` varchar(1) DEFAULT NULL,
  `a23` varchar(1) DEFAULT NULL,
  `a24` varchar(1) DEFAULT NULL,
  `a25` varchar(1) DEFAULT NULL,
  `a26` varchar(1) DEFAULT NULL,
  `a27` varchar(1) DEFAULT NULL,
  `a28` varchar(1) DEFAULT NULL,
  `a29` varchar(1) DEFAULT NULL,
  `a30` varchar(1) DEFAULT NULL,
  `a31` varchar(1) DEFAULT NULL,
  `a32` varchar(1) DEFAULT NULL,
  `a33` varchar(1) DEFAULT NULL,
  `a34` varchar(1) DEFAULT NULL,
  `a35` varchar(1) DEFAULT NULL,
  `a36` varchar(1) DEFAULT NULL,
  `a37` varchar(1) DEFAULT NULL,
  `a38` varchar(1) DEFAULT NULL,
  `a39` varchar(1) DEFAULT NULL,
  `a40` varchar(1) DEFAULT NULL,
  `a41` varchar(1) DEFAULT NULL,
  `a42` varchar(1) DEFAULT NULL,
  `a43` varchar(1) DEFAULT NULL,
  `a44` varchar(1) DEFAULT NULL,
  `a45` varchar(1) DEFAULT NULL,
  `a46` varchar(1) DEFAULT NULL,
  `a47` varchar(1) DEFAULT NULL,
  `a48` varchar(1) DEFAULT NULL,
  `a49` varchar(1) DEFAULT NULL,
  `a50` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `tb_correct` */

DROP TABLE IF EXISTS `tb_correct`;

CREATE TABLE `tb_correct` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `schoolid` int(6) DEFAULT NULL,
  `LRN` int(12) DEFAULT NULL,
  `studname` varchar(50) DEFAULT NULL,
  `gradelevel` int(2) DEFAULT NULL,
  `subject` varchar(20) DEFAULT NULL,
  `a1` varchar(1) DEFAULT NULL,
  `a2` varchar(1) DEFAULT NULL,
  `a3` varchar(1) DEFAULT NULL,
  `a4` varchar(1) DEFAULT NULL,
  `a5` varchar(1) DEFAULT NULL,
  `a6` varchar(1) DEFAULT NULL,
  `a7` varchar(1) DEFAULT NULL,
  `a8` varchar(1) DEFAULT NULL,
  `a9` varchar(1) DEFAULT NULL,
  `a10` varchar(1) DEFAULT NULL,
  `a11` varchar(1) DEFAULT NULL,
  `a12` varchar(1) DEFAULT NULL,
  `a13` varchar(1) DEFAULT NULL,
  `a14` varchar(1) DEFAULT NULL,
  `a15` varchar(1) DEFAULT NULL,
  `a16` varchar(1) DEFAULT NULL,
  `a17` varchar(1) DEFAULT NULL,
  `a18` varchar(1) DEFAULT NULL,
  `a19` varchar(1) DEFAULT NULL,
  `a20` varchar(1) DEFAULT NULL,
  `a21` varchar(1) DEFAULT NULL,
  `a22` varchar(1) DEFAULT NULL,
  `a23` varchar(1) DEFAULT NULL,
  `a24` varchar(1) DEFAULT NULL,
  `a25` varchar(1) DEFAULT NULL,
  `a26` varchar(1) DEFAULT NULL,
  `a27` varchar(1) DEFAULT NULL,
  `a28` varchar(1) DEFAULT NULL,
  `a29` varchar(1) DEFAULT NULL,
  `a30` varchar(1) DEFAULT NULL,
  `a31` varchar(1) DEFAULT NULL,
  `a32` varchar(1) DEFAULT NULL,
  `a33` varchar(1) DEFAULT NULL,
  `a34` varchar(1) DEFAULT NULL,
  `a35` varchar(1) DEFAULT NULL,
  `a36` varchar(1) DEFAULT NULL,
  `a37` varchar(1) DEFAULT NULL,
  `a38` varchar(1) DEFAULT NULL,
  `a39` varchar(1) DEFAULT NULL,
  `a40` varchar(1) DEFAULT NULL,
  `a41` varchar(1) DEFAULT NULL,
  `a42` varchar(1) DEFAULT NULL,
  `a43` varchar(1) DEFAULT NULL,
  `a44` varchar(1) DEFAULT NULL,
  `a45` varchar(1) DEFAULT NULL,
  `a46` varchar(1) DEFAULT NULL,
  `a47` varchar(1) DEFAULT NULL,
  `a48` varchar(1) DEFAULT NULL,
  `a49` varchar(1) DEFAULT NULL,
  `a50` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
