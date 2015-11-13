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
-- Table structure for table `modulos_usuarios`
--

DROP TABLE IF EXISTS `modulos_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulos_usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_modulo` int(10) unsigned NOT NULL,
  `id_grupo_usuario` int(10) unsigned NOT NULL,
  `created_at` varchar(45) NOT NULL DEFAULT 'aaaa-mm-dd',
  `updated_at` varchar(45) NOT NULL DEFAULT 'aaaa-mm-dd',
  `inactivo` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulos_usuarios`
--

LOCK TABLES `modulos_usuarios` WRITE;
/*!40000 ALTER TABLE `modulos_usuarios` DISABLE KEYS */;
INSERT INTO `modulos_usuarios` VALUES (1,1,1,'aaaa-mm-dd','aaaa-mm-dd',0),(19,2,1,'2014-07-29 21:22:22','2014-07-30 18:56:50',0),(20,3,1,'2014-07-29 21:22:29','2014-07-29 21:23:36',0),(21,4,1,'2014-07-29 21:24:40','2014-07-29 21:28:48',0),(22,5,1,'2014-07-29 21:25:44','2014-07-30 18:56:50',0),(23,6,1,'2014-07-29 21:28:48','2014-07-29 21:28:48',0),(24,7,1,'2014-07-29 21:28:48','2014-07-30 19:14:01',0),(25,8,1,'2014-07-29 21:28:48','2014-07-30 18:56:50',0),(26,1,4,'2014-09-06 17:04:04','2014-09-06 17:04:04',0),(27,2,4,'2014-09-06 17:04:04','2014-09-06 17:04:04',0),(28,3,4,'2014-09-06 17:04:04','2014-09-06 17:04:04',0),(29,4,4,'2014-09-06 17:04:04','2014-09-06 17:04:04',0),(30,3,5,'2014-09-06 17:08:19','2014-09-06 17:08:19',0),(31,7,5,'2014-09-06 17:10:33','2014-09-06 17:10:33',0),(32,9,1,'2014-10-22 16:09:25','2014-10-22 16:09:25',0);
/*!40000 ALTER TABLE `modulos_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `condiciones_enfermedades`
--

DROP TABLE IF EXISTS `condiciones_enfermedades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `condiciones_enfermedades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_enfermedad` int(11) DEFAULT NULL,
  `id_marcador` int(11) DEFAULT NULL,
  `valor_condicion` tinyint(4) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `condiciones_enfermedades`
--

LOCK TABLES `condiciones_enfermedades` WRITE;
/*!40000 ALTER TABLE `condiciones_enfermedades` DISABLE KEYS */;
INSERT INTO `condiciones_enfermedades` VALUES (1,1,1,-1,'2014-10-23 15:22:00','2014-10-23 15:22:00'),(2,1,2,-1,'2014-10-23 15:22:00','2014-10-23 15:22:00'),(3,1,3,1,'2014-10-23 15:22:00','2014-10-23 15:22:00'),(4,2,1,-1,'2014-10-23 15:23:06','2014-10-23 15:23:06'),(5,2,2,-1,'2014-10-23 15:23:06','2014-10-23 15:23:06'),(6,3,2,-1,'2014-10-23 15:23:44','2014-10-23 15:23:44'),(7,3,3,1,'2014-10-23 15:23:44','2014-10-23 15:23:44'),(8,4,1,1,'2014-10-23 15:24:13','2014-10-23 15:24:13'),(9,5,1,1,'2014-10-23 15:24:32','2014-10-23 15:24:32');
/*!40000 ALTER TABLE `condiciones_enfermedades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enfermedades`
--

DROP TABLE IF EXISTS `enfermedades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enfermedades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  `mensaje_positivo` text,
  `mensaje_negativo` text,
  `status` tinyint(4) DEFAULT '1',
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enfermedades`
--

LOCK TABLES `enfermedades` WRITE;
/*!40000 ALTER TABLE `enfermedades` DISABLE KEYS */;
INSERT INTO `enfermedades` VALUES (1,'Síndrome de Down','El riesgo de síndrome de Down es elevado.','El riesgo del síndrome de Down es MENOR que el del corte de sondeo. El exámen de suero ha indicado un riesgo sustancialmente REDUCIDO en comparación al de aquel basado en la edad materna solamente.',1,NULL,'2014-10-23 15:25:40'),(2,'Trisomia 18','Estos niveles de marcadores séricos son consistentes con el patrón visto en embarazos con Trisomía 18.','Estos niveles de marcadores séricos no son consistentes con el patrón visto en embarazos con Trisomía 18. El tamizaje maternal será detectado en aproximadamente 60% de los embarazos con Trisomia 18.',1,'2014-10-22 15:25:39','2014-10-23 15:26:22'),(3,'Trisomia 13','Si tienes Trisomía 13.','No tienes Trisomía 13.',0,'2014-10-23 13:36:18','2014-10-23 16:08:40'),(4,'Espina Bifida Abierta','El resultado del suero materno AFP es ALTO para un embarazo de esta edad gestacional, indicando un riesgo incrementado sustancialmente del defecto de tubo neural abierto. Si la edad gestacional es confirmada, debería considerarse un ultrasonido de NIVEL II combinando con anmiocentesis, seguidos por los exámenes definitivos de la concentración de fluido amniótico AFP y del complejo acetilcolinaesteres [AChE].','El resultado del suero materno AFP No es elevado para un embarazo de esta edad gestacional. El riesgo del defecto de tubo neural es menor que el del corte de sondeo.',1,'2014-10-23 13:54:07','2014-10-23 13:54:07'),(5,'Malformación Fetal','Posee un alto riesgo de Malformación Fetal.','Posee un bajo riesgo de Malformación Fetal.',0,'2014-10-23 15:24:32','2014-10-23 15:27:05');
/*!40000 ALTER TABLE `enfermedades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulos`
--

DROP TABLE IF EXISTS `modulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modulo` varchar(45) NOT NULL,
  `ruta` varchar(45) NOT NULL,
  `imagen` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulos`
--

LOCK TABLES `modulos` WRITE;
/*!40000 ALTER TABLE `modulos` DISABLE KEYS */;
INSERT INTO `modulos` VALUES (1,'Citas de Tamizaje','datos.citas.index','citas.png'),(2,'Pacientes','datos.pacientes.index','woman.png'),(3,'Médicos','datos.medicos.index','medico.png'),(4,'Mediana de Marcadores','datos.mediana.index','marcadores.png'),(5,'Activos','datos.activos.index','activo.png'),(6,'Mantenimiento','datos.mantenimientos.index','mantenimiento.png'),(7,'Agenda Telefónica','datos.agenda.index','agenda.png'),(8,'Localizar','datos.pacientesmapas.index','mapa.png'),(9,'Enfermedades','datos.condiciones.index','enfermedad.png');
/*!40000 ALTER TABLE `modulos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-24 10:49:50
