CREATE DATABASE  IF NOT EXISTS `studio_booking` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `studio_booking`;
-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: localhost    Database: studio_booking
-- ------------------------------------------------------
-- Server version	5.7.39

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `studio_id` bigint(20) NOT NULL,
  `booked_by` varchar(50) NOT NULL,
  `emal_id` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `is_cancelled` tinyint(4) NOT NULL DEFAULT '1',
  `cancelled_remarks` varchar(255) DEFAULT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`booking_id`),
  UNIQUE KEY `booking_id_UNIQUE` (`booking_id`),
  KEY `studio_idx` (`studio_id`),
  CONSTRAINT `studio` FOREIGN KEY (`studio_id`) REFERENCES `studio` (`studio_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studio`
--

DROP TABLE IF EXISTS `studio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `studio` (
  `studio_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `studio_name` varchar(50) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`studio_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studio`
--

LOCK TABLES `studio` WRITE;
/*!40000 ALTER TABLE `studio` DISABLE KEYS */;
INSERT INTO `studio` VALUES (1,'S1',1,'admin','2023-06-17 12:07:10'),(2,'S2',1,'admin','2023-06-17 12:07:10'),(3,'S3',1,'admin','2023-06-17 12:07:10'),(4,'S4',1,'admin','2023-06-17 12:07:10'),(5,'S5',1,'admin','2023-06-17 12:07:10'),(6,'S6',1,'admin','2023-06-17 12:07:10'),(7,'S7',1,'admin','2023-06-17 12:07:10'),(8,'S8',1,'admin','2023-06-17 12:07:10'),(9,'S9',1,'admin','2023-06-17 12:07:10'),(10,'S10',1,'admin','2023-06-17 12:07:10'),(11,'S11',1,'admin','2023-06-17 12:07:10'),(12,'S12',1,'admin','2023-06-17 12:07:10'),(13,'S13',1,'admin','2023-06-17 12:07:10'),(14,'S14',1,'admin','2023-06-17 12:07:10'),(15,'S15',1,'admin','2023-06-17 12:07:10'),(16,'S16',1,'admin','2023-06-17 12:07:10'),(17,'S17',1,'admin','2023-06-17 12:07:10'),(18,'S18',1,'admin','2023-06-17 12:07:10'),(19,'S19',1,'admin','2023-06-17 12:07:10'),(20,'S20',1,'admin','2023-06-17 12:07:10'),(21,'S21',1,'admin','2023-06-17 12:07:10'),(22,'S22',1,'admin','2023-06-17 12:07:10'),(23,'S23',1,'admin','2023-06-17 12:07:10'),(24,'S24',0,'admin','2023-06-17 12:07:10'),(25,'S25',1,'admin','2023-06-17 12:07:10');
/*!40000 ALTER TABLE `studio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userhistory`
--

DROP TABLE IF EXISTS `userhistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userhistory` (
  `userhistoryid` bigint(20) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `loggedintime` timestamp NOT NULL,
  `loggedouttime` timestamp NULL DEFAULT NULL,
  `sessionid` varchar(255) NOT NULL,
  PRIMARY KEY (`userhistoryid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userhistory`
--

LOCK TABLES `userhistory` WRITE;
/*!40000 ALTER TABLE `userhistory` DISABLE KEYS */;
INSERT INTO `userhistory` VALUES (1,1,'2023-06-17 10:35:37','2023-06-17 10:38:49','hh6jgnpib06i5jjoc73hmrlji3'),(2,1,'2023-06-17 10:38:49','2023-06-17 10:45:54','hh6jgnpib06i5jjoc73hmrlji3'),(3,1,'2023-06-17 10:45:54','2023-06-17 10:48:17','hh6jgnpib06i5jjoc73hmrlji3'),(4,1,'2023-06-17 10:48:17','2023-06-17 10:51:43','hh6jgnpib06i5jjoc73hmrlji3'),(5,1,'2023-06-17 10:51:43','2023-06-17 11:02:25','hh6jgnpib06i5jjoc73hmrlji3'),(6,1,'2023-06-17 11:02:25','2023-06-17 11:03:47','hh6jgnpib06i5jjoc73hmrlji3'),(7,1,'2023-06-17 11:03:47','2023-06-17 11:08:43','hh6jgnpib06i5jjoc73hmrlji3'),(8,1,'2023-06-17 11:08:43','2023-06-17 11:11:34','hh6jgnpib06i5jjoc73hmrlji3'),(9,1,'2023-06-17 11:11:34','2023-06-17 11:16:50','hh6jgnpib06i5jjoc73hmrlji3'),(10,1,'2023-06-17 11:16:50','2023-06-17 11:55:04','hh6jgnpib06i5jjoc73hmrlji3'),(11,1,'2023-06-17 11:55:04','2023-06-17 12:03:40','kifd3u1j4fl2b1pt5iu4a8dnu2'),(12,1,'2023-06-17 12:03:40','2023-06-17 12:28:57','kifd3u1j4fl2b1pt5iu4a8dnu2'),(13,1,'2023-06-17 12:28:57',NULL,'kifd3u1j4fl2b1pt5iu4a8dnu2');
/*!40000 ALTER TABLE `userhistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@admin.com','5f4dcc3b5aa765d61d8327deb882cf99',1,'admin','2023-06-17 10:10:16');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'studio_booking'
--

--
-- Dumping routines for database 'studio_booking'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-17 18:15:05
