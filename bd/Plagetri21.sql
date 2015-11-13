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
-- Table structure for table `coeficientes_exponenciales`
--

DROP TABLE IF EXISTS `coeficientes_exponenciales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coeficientes_exponenciales` (
  `id` int(11) NOT NULL,
  `id_marcador` int(11) DEFAULT NULL,
  `a` double DEFAULT NULL,
  `b` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coeficientes_exponenciales`
--

LOCK TABLES `coeficientes_exponenciales` WRITE;
/*!40000 ALTER TABLE `coeficientes_exponenciales` DISABLE KEYS */;
INSERT INTO `coeficientes_exponenciales` VALUES (1,1,0.3007,-0.0045),(2,2,0.1339,-0.002),(3,4,0.1889,-0.0029);
/*!40000 ALTER TABLE `coeficientes_exponenciales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `valores_marcadores`
--

DROP TABLE IF EXISTS `valores_marcadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `valores_marcadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_marcador` int(45) DEFAULT NULL,
  `semana` int(45) DEFAULT NULL,
  `id_metodologia` int(45) DEFAULT NULL,
  `id_unidad` int(45) DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `positivo` int(4) DEFAULT '0',
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `valores_marcadores`
--

LOCK TABLES `valores_marcadores` WRITE;
/*!40000 ALTER TABLE `valores_marcadores` DISABLE KEYS */;
/*!40000 ALTER TABLE `valores_marcadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coeficientes_lineales`
--

DROP TABLE IF EXISTS `coeficientes_lineales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coeficientes_lineales` (
  `id` int(11) NOT NULL,
  `id_marcador` int(10) DEFAULT NULL,
  `a` double DEFAULT NULL,
  `b` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coeficientes_lineales`
--

LOCK TABLES `coeficientes_lineales` WRITE;
/*!40000 ALTER TABLE `coeficientes_lineales` DISABLE KEYS */;
INSERT INTO `coeficientes_lineales` VALUES (1,1,0.2452,54.0555),(2,2,0.7474,19.8874),(3,4,0.6189,32.5776);
/*!40000 ALTER TABLE `coeficientes_lineales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuraciones`
--

DROP TABLE IF EXISTS `configuraciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuraciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) DEFAULT NULL,
  `automatico` tinyint(4) DEFAULT NULL,
  `cantidad_registros` int(10) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuraciones`
--

LOCK TABLES `configuraciones` WRITE;
/*!40000 ALTER TABLE `configuraciones` DISABLE KEYS */;
INSERT INTO `configuraciones` VALUES (1,4,1,5,'2014-08-28 14:03:41','2014-08-28 14:03:41'),(2,4,0,0,'2014-08-28 14:03:51','2014-08-28 14:03:51'),(3,4,1,3,'2014-09-02 13:50:59','2014-09-02 13:50:59'),(4,4,0,0,'2014-09-02 13:51:19','2014-09-02 13:51:19');
/*!40000 ALTER TABLE `configuraciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalles_configuraciones`
--

DROP TABLE IF EXISTS `detalles_configuraciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalles_configuraciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_configuracion` int(10) DEFAULT NULL,
  `id_marcador` int(10) DEFAULT NULL,
  `id_unidad` int(10) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalles_configuraciones`
--

LOCK TABLES `detalles_configuraciones` WRITE;
/*!40000 ALTER TABLE `detalles_configuraciones` DISABLE KEYS */;
INSERT INTO `detalles_configuraciones` VALUES (1,1,1,2,'2014-08-28 14:03:41','2014-08-28 14:03:41'),(2,1,2,2,'2014-08-28 14:03:41','2014-08-28 14:03:41'),(3,1,3,2,'2014-08-28 14:03:41','2014-08-28 14:03:41'),(4,1,4,2,'2014-08-28 14:03:41','2014-08-28 14:03:41'),(5,1,5,2,'2014-08-28 14:03:41','2014-08-28 14:03:41'),(6,1,6,2,'2014-08-28 14:03:41','2014-08-28 14:03:41'),(7,1,7,2,'2014-08-28 14:03:41','2014-08-28 14:03:41'),(8,3,1,2,'2014-09-02 13:50:59','2014-09-02 13:50:59'),(9,3,2,2,'2014-09-02 13:50:59','2014-09-02 13:50:59'),(10,3,3,2,'2014-09-02 13:50:59','2014-09-02 13:50:59'),(11,3,4,2,'2014-09-02 13:50:59','2014-09-02 13:50:59'),(12,3,5,2,'2014-09-02 13:50:59','2014-09-02 13:50:59'),(13,3,6,2,'2014-09-02 13:50:59','2014-09-02 13:50:59'),(14,3,7,2,'2014-09-02 13:50:59','2014-09-02 13:50:59');
/*!40000 ALTER TABLE `detalles_configuraciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mantenimientos`
--

DROP TABLE IF EXISTS `mantenimientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mantenimientos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha_realizacion` varchar(45) NOT NULL,
  `realizado_por` varchar(45) NOT NULL,
  `aprobado_por` varchar(45) NOT NULL,
  `id_activo` int(10) unsigned NOT NULL,
  `proximo_mant` varchar(45) NOT NULL,
  `observacion` text NOT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mantenimientos`
--

LOCK TABLES `mantenimientos` WRITE;
/*!40000 ALTER TABLE `mantenimientos` DISABLE KEYS */;
/*!40000 ALTER TABLE `mantenimientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `valores_normales`
--

DROP TABLE IF EXISTS `valores_normales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `valores_normales` (
  `id` int(11) NOT NULL,
  `id_marcador` int(10) DEFAULT NULL,
  `id_unidad` int(10) DEFAULT NULL,
  `semana` int(10) DEFAULT NULL,
  `lim_inferior` double DEFAULT NULL,
  `lim_superior` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `valores_normales`
--

LOCK TABLES `valores_normales` WRITE;
/*!40000 ALTER TABLE `valores_normales` DISABLE KEYS */;
INSERT INTO `valores_normales` VALUES (1,1,2,14,12.8,64),(2,1,2,15,15,74.8),(3,1,2,16,17.3,87),(4,1,2,17,20.3,101.5),(5,1,2,18,23.7,118.3),(6,1,2,19,27.6,137.8),(7,1,2,20,32.2,160.8),(8,1,2,21,37.5,187.3);
/*!40000 ALTER TABLE `valores_normales` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-09-03  8:44:01
