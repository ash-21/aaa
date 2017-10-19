-- MySQL dump 10.13  Distrib 5.5.57, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: aaaDatabase
-- ------------------------------------------------------
-- Server version	5.5.57-0ubuntu0.14.04.1

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
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appointments` (
  `userID` int(11) NOT NULL,
  `clientID` int(11) NOT NULL,
  `appointmentTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` varchar(500) DEFAULT NULL,
  `appointmentID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`appointmentID`),
  KEY `userID` (`userID`),
  KEY `clientID` (`clientID`),
  CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`clientID`) REFERENCES `clients` (`clientID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointments`
--

LOCK TABLES `appointments` WRITE;
/*!40000 ALTER TABLE `appointments` DISABLE KEYS */;
/*!40000 ALTER TABLE `appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `name` varchar(70) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `clientID` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`clientID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `priority`
--

DROP TABLE IF EXISTS `priority`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `priority` (
  `priorityID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT NULL,
  `clientID` int(11) DEFAULT NULL,
  `priority` int(11) NOT NULL,
  PRIMARY KEY (`priorityID`),
  KEY `userID` (`userID`),
  KEY `clientID` (`clientID`),
  CONSTRAINT `priority_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  CONSTRAINT `priority_ibfk_2` FOREIGN KEY (`clientID`) REFERENCES `clients` (`clientID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `priority`
--

LOCK TABLES `priority` WRITE;
/*!40000 ALTER TABLE `priority` DISABLE KEYS */;
/*!40000 ALTER TABLE `priority` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userInfo`
--

DROP TABLE IF EXISTS `userInfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userInfo` (
  `name` varchar(70) DEFAULT NULL,
  `profession` varchar(70) DEFAULT NULL,
  `homeAddress` varchar(200) DEFAULT NULL,
  `workAddress` varchar(200) DEFAULT NULL,
  `email` varchar(200) NOT NULL DEFAULT '',
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `userID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userInfo`
--

LOCK TABLES `userInfo` WRITE;
/*!40000 ALTER TABLE `userInfo` DISABLE KEYS */;
INSERT INTO `userInfo` VALUES ('Sami','BCS Cadre','Khulna','Chankharpul,Dhaka','abidnazirisami@gmail.com','01680037926','$2y$10$ihhhrdcPBTIYg31rISH3yeP9D62af8eXxmt6EYqbT9EM7UkSSCa/u',1),('Ashraful Islam','Engineer','Armanitola, Dhaka','Dhaka','ashraful.nitol@gmail.com','01676415005','$2y$10$5uK.CF51Hpa1ZHB92xej6uk1d5upu.hUhT2fXgParN08xPVGpjXi.',2),('Nitol','Doctor','Khulna','Dhaka','crazyashraful@gmail.com','01676415005','$2y$10$v09yigfjvL6WTzLMqcB5beBc45P66Bqge29VIGKBGkCbr134kGRZW',3),('Muntasir','Teacher','Ctg','Dhaka','immuntasir@gmail.com','01521487023','$2y$10$uuOIOboRYCtu0nSC9ICivuc1VcMtA7hXpASqtdrCgSdzZ.svKuhLe',4),('Mahfuza Islam Mona','student','narayanganj','narayanganj','i_mahfuzamona@yahoo.com','01977505027','$2y$10$c71ifEJp2F5GLVEiVMS3s.2CvqdUIEupEU0os/Mnmt55uMqrxFo/2',5),('Mahfida Jerin','Student','123/A,Dhaka Cantt.,Dhaka','University of Dhaka','jerinmahfida@gmail.com','01199101895','$2y$10$T.t0TzdHe3qH.6KlG5Ddx.Uyl8qkEbsmFMFBHIsmD8qkusI//CuFS',6),('Mahrin Jerin','Doctor','123/d,Banani,Dhaka','City Hospital,Dhaka','mahrin.nitu@gmail.com','01521212121','$2y$10$SE74EOWcidYedUUQJrtpD.BVmvX7syccFc2CX0KmTlG3jDw9Rk2YG',7),('Md Omar Faruk','Doctor','Khulna','Dhaka','mdsakibanwar@yahoo.com','0154584454','$2y$10$HeWI4i18Qhexp4hLlbG26uvtLhhQvTt/SWLpX9PIFlJ9MSkcXArzm',8),('Mehreen Rahman','Designer','68/D,Dhanmondi,Dhaka','University of Dhaka','mehreen_r61@gmail.com','01674543901','$2y$10$PtLMi0Wap.Tcs3HjllE7R.iTw1k.wVfwGGrk4fWmHB/xLHLy9lPsS',9),('Md. Sakib Anwar','Student','102-104,Boro Mogbazar,Dhaka','DU','sakibanwar1149095@gmail.com','01680037926','$2y$10$YtMeOHLIv5yFhpW57C8.wuoqRso/JFRjFtjlbvGgc1UJ/Qrfp.wzy',10),('Mahmud','Student','Dhaka','Dhaka','mahmud_khan2010@yahoo.com','01969102284','$2y$10$hg5HndmKuGcvPQKKOh3qJ.aNXo6yBlpsXD6PdRJHBZ.03/L3vEUqa',11),('Mahmud','Student','Dhaka','Dhaka','mahmudulislam13079@gmail.com','01680037926','$2y$10$Hvc3.t22YEMTf41hZG0nvOk52xH.dosk.jAXK0VatUKr8sMpr1x4W',12);
/*!40000 ALTER TABLE `userInfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `name` varchar(70) DEFAULT NULL,
  `profession` varchar(70) DEFAULT NULL,
  `homeAddress` varchar(200) DEFAULT NULL,
  `workAddress` varchar(200) DEFAULT NULL,
  `email` varchar(200) NOT NULL DEFAULT '',
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2017-10-19 18:28:43
