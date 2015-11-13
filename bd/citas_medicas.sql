CREATE DATABASE  IF NOT EXISTS `plagetri21` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `plagetri21`;
-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (i686)
--
-- Host: 127.0.0.1    Database: plagetri21
-- ------------------------------------------------------
-- Server version	5.5.38-0ubuntu0.14.04.1

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
-- Table structure for table `citas_medicas`
--

DROP TABLE IF EXISTS `citas_medicas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `citas_medicas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_paciente` int(10) unsigned NOT NULL DEFAULT '0',
  `id_medico` int(10) unsigned NOT NULL DEFAULT '0',
  `peso` double NOT NULL DEFAULT '0',
  `fecha_ultrasonido` varchar(45) NOT NULL DEFAULT '',
  `fur` varchar(45) NOT NULL DEFAULT '',
  `fpp` varchar(45) NOT NULL DEFAULT '',
  `fecha_flebotomia` varchar(45) NOT NULL,
  `edad_gestacional` int(10) unsigned NOT NULL,
  `observaciones` text,
  `estatura` double NOT NULL DEFAULT '0',
  `id_institucion` int(10) unsigned NOT NULL DEFAULT '0',
  `hijos_embarazo` int(10) unsigned NOT NULL DEFAULT '1',
  `fecha_cita` varchar(45) NOT NULL,
  `riesgo` varchar(45) NOT NULL DEFAULT '0',
  `riesgo_fap` varchar(45) NOT NULL DEFAULT '0',
  `created_at` varchar(45) NOT NULL,
  `updated_at` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_citas_medicas_paciente` (`id_paciente`),
  KEY `FK_citas_medicas_medico` (`id_medico`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas_medicas`
--

LOCK TABLES `citas_medicas` WRITE;
/*!40000 ALTER TABLE `citas_medicas` DISABLE KEYS */;
INSERT INTO `citas_medicas` VALUES (1,1,3,45,'2014-06-04','2014-06-04','2014-06-04','2014-06-04',22,'Observaciones',1.65,406011303,2,'2014-07-04','1526.90','','2014-06-04 18:46:56','2014-07-18 19:33:31'),(2,1,3,147,'','2014-08-08','','2014-08-08',4147,'',0,0,0,'2014-08-08','966.52','','2014-08-08 18:49:09','2014-08-08 18:49:09'),(3,1,0,73.4,'2014-08-25','2014-01-23','2014-08-25','2014-08-25',23,'eee',1.76,406100401,2,'2014-05-07','993.55','','2014-08-25 14:19:47','2014-08-25 14:19:47'),(4,1,0,73.4,'2014-08-25','2014-01-23','2014-08-25','2014-08-25',23,'eee',1.76,406100401,2,'2014-05-07','993.55','','2014-08-25 14:20:35','2014-08-25 14:20:35'),(5,1,0,73.4,'2014-08-25','2014-01-23','2014-08-25','2014-08-25',23,'eee',1.76,406100401,2,'2014-05-07','993.55','','2014-08-25 14:22:20','2014-08-25 14:22:20'),(6,1,0,73.4,'2014-08-25','2014-01-23','2014-08-25','2014-08-25',23,'eee',1.76,406100401,2,'2014-05-07','993.55','','2014-08-25 14:23:08','2014-08-25 14:23:08');
/*!40000 ALTER TABLE `citas_medicas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-09-05 12:03:57
