CREATE DATABASE  IF NOT EXISTS `coolshop` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `coolshop`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: coolshop
-- ------------------------------------------------------
-- Server version	5.1.73-community

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `CustNum` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerImg` varchar(50) DEFAULT NULL,
  `FirstName` varchar(25) DEFAULT NULL,
  `LastName` varchar(25) DEFAULT NULL,
  `UserId` varchar(25) DEFAULT NULL,
  `Email` varchar(25) DEFAULT NULL,
  `Address` varchar(25) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `PhoneNumber` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`CustNum`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'cainton.png','John','Jack','johnj2014','eatjack@hotmail.com','111 Manchester Street','Christchurch','0277267785'),(2,'cainton.png','Job','Jerry','jobj2014','eatjack@hotmail.com','408 Harewood road','Christchurch','0277267785'),(3,'cainton.png','Cainton','Milroy','caintonm2014','eatjack@hotmail.com','500 Papanui Street','Christchurch','0277267785'),(4,'cainton.png','Hayden','McClaren','haydenm2014','eatjack@hotmail.com','40 Cashel Street','Christchurch','0277267785'),(5,'cainton.png','Glen','McNeur','glenm2014','eatjack@hotmail.com','34 Baberdoes Street','Christchurch','0277267785'),(6,'cainton.png','David','Mullan','davidm2014','eatjack@hotmail.com','78 Marivale Street','Christchurch','0277267785'),(7,'cainton.png','Jack','Eaton','jacke2014','eatjack@hotmail.com','43 Bealey Street','Christchurch','0277267785'),(8,'cainton.png','Trevor','Trief','trevort2014','eatjack@hotmail.com','79 Montreal Street','Christchurch','0277267785'),(9,'cainton.png','Mary','Braid','jmaryb2014','eatjack@hotmail.com','100 Cranford Street','Christchurch','0277267785'),(10,'cainton.png','Isabel','Jones','isabelj2014','eatjack@hotmail.com','432 Shirley Street','Christchurch','0277267785'),(11,'cainton.png','Lisa','Mona','lisam2014','eatjack@hotmail.com','21 Avonhead Street','Christchurch','0277267785'),(12,'cainton.png','Jess','Perry','jessp2014','eatjack@hotmail.com','2 Riccarton Street','Christchurch','0277267785'),(13,'cainton.png','Anthony','Freess','anthonyf2014','eatjack@hotmail.com','32 Rangiora Street','Christchurch','0277267785'),(14,'cainton.png','Bill','Bani','billb2014','eatjack@hotmail.com','98 Aranui Street','Christchurch','0277267785');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(10) DEFAULT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `product_description` varchar(300) DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `product_image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,NULL,'Acer Aspire 11.6 Inch Notebook V5-132','The perfect compact Entry-Level Notebook for checking emails, browsing the internet, updating your facebook profile.',22.00,'acer_01.jpg'),(2,NULL,'H&H Boys Spray Jacket','Fabric: Polyester',20.50,'H_H01.jpg'),(3,NULL,'100 years of the blues','Pack Size: 2CD',50.90,'bluespac_01.jpg'),(4,NULL,'Ane Si Dora Sterling Silver Bracelet 16cm','Start your Ane Si Dora journey with this 16cm sterling silver bracelet. Begin collecting gorgeous charms representing life\'s beautiful memories! Their great design means that you can easily add new charms as you like.',50.30,'Ane_Si_Dora_01.jpg'),(5,NULL,'Arctic Flannel Sheet Set Black Queen','Warm Polyester Fleece',45.00,'archtic_flannel.jpg'),(6,NULL,'Reside Espresso Coffee Table Rectangular','Warm Polyester FleeceDecorate your home in style with the \"Reside Espresso\" range exclusive to The Warehouse. Combining the latest in contemporary styling and cool chocolate / coffee colour \"Reside Espresso\" is the latest in modern home fashion. \nNo Shrinkage',60.00,'espresso_coffee_table_01.jpg');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(32) DEFAULT NULL,
  `lastname` varchar(32) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (28,'John','Dalisay','','john','john123','2012-01-14 18:26:14'),(39,'Jem','Panlilio','','jemboy09','jem123','2012-01-14 18:26:46'),(40,'Darwin','Dalisay','','dada08','dada123','2012-01-14 18:25:34'),(46,'Jaylord','Bitamug','','jayjay','jay123','2012-01-14 18:27:04'),(49,'Justine','Bongola','','jaja','jaja123','2012-01-14 18:27:21'),(50,'Jun','Sabayton','','jun','jun123','2012-02-04 21:15:14'),(51,'Lourd','De Veyra','','lourd','lourd123','2012-02-04 21:15:36'),(52,'Asi','Taulava','','asi','asi123','2012-02-04 21:15:58'),(53,'James','Yap','','james','jame123','2012-02-04 21:16:17'),(54,'Chris','Tiu','','chris','chris123','2012-02-04 21:16:29'),(55,'Cainton','Milroy',NULL,'cmilroy','cmilroy','2014-09-24 02:32:53'),(56,'Cainton','Milroy',NULL,'cmilroy','cmilroy','2014-09-24 02:33:31'),(57,'Cainton','Milroy',NULL,'cmilroy','cmilroy','2014-09-24 02:33:43');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-09-25 14:51:59
