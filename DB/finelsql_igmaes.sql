-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.37 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.7.0.6850
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for igames
CREATE DATABASE IF NOT EXISTS `igames` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `igames`;

-- Dumping structure for table igames.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `email` varchar(100) NOT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table igames.agelimit
CREATE TABLE IF NOT EXISTS `agelimit` (
  `age_id` int NOT NULL AUTO_INCREMENT,
  `limit` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`age_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table igames.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `users_email` varchar(100) NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `fk_cart_product1_idx` (`product_id`),
  KEY `fk_cart_users1_idx` (`users_email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table igames.category
CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table igames.feedback
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` int DEFAULT NULL,
  `feedback` text,
  `date` datetime DEFAULT NULL,
  `product_id` int NOT NULL,
  `users_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_feedback_product1_idx` (`product_id`),
  KEY `fk_feedback_users1_idx` (`users_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table igames.gender
CREATE TABLE IF NOT EXISTS `gender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gender_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table igames.invoice
CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `total` double DEFAULT NULL,
  `status` int DEFAULT NULL,
  `product_id` int NOT NULL,
  `users_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invoice_product1_idx` (`product_id`),
  KEY `fk_invoice_users1_idx` (`users_email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table igames.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `price` double DEFAULT NULL,
  `description` text,
  `title` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `datetime_added` datetime DEFAULT NULL,
  `category_cat_id` int NOT NULL,
  `status_status_id` int NOT NULL,
  `agelimit_age_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_category1_idx` (`category_cat_id`),
  KEY `fk_product_status1_idx` (`status_status_id`),
  KEY `fk_product_agelimit1_idx` (`agelimit_age_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table igames.product_img
CREATE TABLE IF NOT EXISTS `product_img` (
  `img_path` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`img_path`),
  KEY `fk_product_img_product1_idx` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table igames.product_path
CREATE TABLE IF NOT EXISTS `product_path` (
  `product_id` int NOT NULL,
  `path_product` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`path_product`) USING BTREE,
  KEY `fk_product_path_product1_idx` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table igames.profile_img
CREATE TABLE IF NOT EXISTS `profile_img` (
  `path` varchar(100) NOT NULL,
  `users_email` varchar(100) NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_profile_img_User1_idx` (`users_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table igames.status
CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int NOT NULL,
  `status_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table igames.users
CREATE TABLE IF NOT EXISTS `users` (
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `joined_date` datetime DEFAULT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `gender_id` int DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_User_gender_idx` (`gender_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table igames.watchlist
CREATE TABLE IF NOT EXISTS `watchlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `users_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_watchlist_product1_idx` (`product_id`),
  KEY `fk_watchlist_users1_idx` (`users_email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
