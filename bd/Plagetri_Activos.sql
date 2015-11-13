-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.6.17


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema plagetri21
--

CREATE DATABASE IF NOT EXISTS plagetri21;
USE plagetri21;

--
-- Table structure for table `plagetri21`.`activos`
--

DROP TABLE IF EXISTS `activos`;
CREATE TABLE `activos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `num_activo` varchar(45) NOT NULL DEFAULT '',
  `nombre` varchar(45) NOT NULL,
  `descripcion` text NOT NULL,
  `id_tipo` int(10) unsigned NOT NULL,
  `marca` varchar(45) NOT NULL,
  `id_nivel` int(10) unsigned NOT NULL,
  `id_ubicacion` int(10) unsigned NOT NULL,
  `fecha_compra` varchar(45) NOT NULL,
  `num_factura` varchar(45) NOT NULL,
  `costo` double NOT NULL,
  `id_proveedor` int(10) unsigned NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `updated_at` varchar(45) NOT NULL,
  `id_tipo_fuente` int(10) unsigned NOT NULL DEFAULT '0',
  `id_estado` int(10) unsigned NOT NULL DEFAULT '0',
  `modelo` varchar(45) NOT NULL DEFAULT '',
  `serie` varchar(45) NOT NULL DEFAULT '',
  `voltaje` varchar(45) NOT NULL DEFAULT '',
  `consumo` varchar(45) NOT NULL DEFAULT '',
  `alimentacion` varchar(45) NOT NULL DEFAULT '',
  `protocolo` varchar(45) NOT NULL DEFAULT '',
  `id_fecha_mantenimiento` varchar(45) NOT NULL DEFAULT '',
  `fecha_garantia` varchar(45) NOT NULL DEFAULT '',
  `fecha_de_baja` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plagetri21`.`activos`
--


--
-- Table structure for table `plagetri21`.`fechas_mantenimientos`
--

DROP TABLE IF EXISTS `fechas_mantenimientos`;
CREATE TABLE `fechas_mantenimientos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha_mantenimiento` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plagetri21`.`fechas_mantenimientos`
--

INSERT INTO `fechas_mantenimientos` (`id`,`fecha_mantenimiento`) VALUES 
 (1,'NO DEFINIDO'),
 (2,'7 DÍAS'),
 (3,'15 DÁS'),
 (4,'MENSUALES'),
 (5,'TRIMESTRALES'),
 (6,'SEMESTRALES'),
 (7,'ANUALES');


--
-- Table structure for table `plagetri21`.`mantenimientos`
--

DROP TABLE IF EXISTS `mantenimientos`;
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
  `costo_mantenimiento` varchar(45) DEFAULT NULL,
  `id_tipo_mantenimiento` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plagetri21`.`mantenimientos`
--


--
-- Table structure for table `plagetri21`.`modulos`
--

DROP TABLE IF EXISTS `modulos`;
CREATE TABLE `modulos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modulo` varchar(45) NOT NULL,
  `ruta` varchar(45) NOT NULL,
  `imagen` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plagetri21`.`modulos`
--

INSERT INTO `modulos` (`id`,`modulo`,`ruta`,`imagen`) VALUES 
 (1,'Citas de Tamizaje','datos.citas.index','citas.png'),
 (2,'Pacientes','datos.pacientes.index','woman.png'),
 (3,'Médicos','datos.medicos.index','medico.png'),
 (4,'Mediana de Marcadores','datos.mediana.index','marcadores.png'),
 (5,'Activos','datos.activos.index','activo.png'),
 (6,'Mantenimiento','datos.mantenimientos.index','mantenimiento.png'),
 (7,'Agenda Telefónica','datos.agenda.index','agenda.png'),
 (8,'Localizar','datos.pacientesmapas.index','mapa.png'),
 (9,'Enfermedades','datos.condiciones.index','enfermedades.png'),
 (10,'Reportes','reportes.index','reportes.png');


--
-- Table structure for table `plagetri21`.`tipos_activos`
--

DROP TABLE IF EXISTS `tipos_activos`;
CREATE TABLE `tipos_activos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plagetri21`.`tipos_activos`
--

INSERT INTO `tipos_activos` (`id`,`tipo`,`descripcion`) VALUES 
 (1,'NO DEFINIDO','NO DEFINIDO');


--
-- Table structure for table `plagetri21`.`tipos_estados`
--

DROP TABLE IF EXISTS `tipos_estados`;
CREATE TABLE `tipos_estados` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_estado` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plagetri21`.`tipos_estados`
--

INSERT INTO `tipos_estados` (`id`,`tipo_estado`) VALUES 
 (1,'NUEVO'),
 (2,'REEMPLAZADO'),
 (3,'DESCARTADO');


--
-- Table structure for table `plagetri21`.`tipos_fuentes`
--

DROP TABLE IF EXISTS `tipos_fuentes`;
CREATE TABLE `tipos_fuentes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_fuente` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plagetri21`.`tipos_fuentes`
--

INSERT INTO `tipos_fuentes` (`id`,`tipo_fuente`) VALUES 
 (1,'NO DEFINIDO'),
 (2,'HIDRÁULICO'),
 (3,'VAPOR'),
 (4,'NEUMÁTICO'),
 (5,'ELÉCTRICO'),
 (6,'MECÁNICO');

--
-- Table structure for table `plagetri21`.`tipos_mantenimientos`
--

DROP TABLE IF EXISTS `tipos_mantenimientos`;
CREATE TABLE `tipos_mantenimientos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_mantenimiento` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plagetri21`.`tipos_mantenimientos`
--

INSERT INTO `tipos_mantenimientos` (`id`,`tipo_mantenimiento`) VALUES 
 (1,'PREVENTIVO'),
 (2,'CORRECTIVO');


--
-- View structure for view `plagetri21`.`activos_correctivos`
--

DROP VIEW IF EXISTS `activos_correctivos`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `activos_correctivos` AS select `mantenimientos`.`id` AS `id`,`mantenimientos`.`fecha_realizacion` AS `fecha_realizacion`,`mantenimientos`.`realizado_por` AS `realizado_por`,`mantenimientos`.`aprobado_por` AS `aprobado_por`,`mantenimientos`.`id_activo` AS `id_activo`,`mantenimientos`.`proximo_mant` AS `proximo_mant`,`mantenimientos`.`observacion` AS `observacion`,`mantenimientos`.`created_at` AS `created_at`,`mantenimientos`.`updated_at` AS `updated_at`,`mantenimientos`.`costo_mantenimiento` AS `costo_mantenimiento`,`mantenimientos`.`id_tipo_mantenimiento` AS `id_tipo_mantenimiento`,count(`mantenimientos`.`id`) AS `cantidad` from `mantenimientos` where (`mantenimientos`.`id_tipo_mantenimiento` = 2) group by `mantenimientos`.`id_activo` order by `cantidad` desc;


--
-- View structure for view `plagetri21`.`activos_preventivos`
--

DROP VIEW IF EXISTS `activos_preventivos`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `activos_preventivos` AS select `mantenimientos`.`id` AS `id`,`mantenimientos`.`fecha_realizacion` AS `fecha_realizacion`,`mantenimientos`.`realizado_por` AS `realizado_por`,`mantenimientos`.`aprobado_por` AS `aprobado_por`,`mantenimientos`.`id_activo` AS `id_activo`,`mantenimientos`.`proximo_mant` AS `proximo_mant`,`mantenimientos`.`observacion` AS `observacion`,`mantenimientos`.`created_at` AS `created_at`,`mantenimientos`.`updated_at` AS `updated_at`,`mantenimientos`.`costo_mantenimiento` AS `costo_mantenimiento`,`mantenimientos`.`id_tipo_mantenimiento` AS `id_tipo_mantenimiento`,count(`mantenimientos`.`id`) AS `cantidad` from `mantenimientos` where (`mantenimientos`.`id_tipo_mantenimiento` = 1) group by `mantenimientos`.`id_activo` order by `cantidad` desc;


--
-- View structure for view `plagetri21`.`buscar_activos`
--

DROP VIEW IF EXISTS `buscar_activos`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `buscar_activos` AS select `a`.`id` AS `id`,`a`.`num_activo` AS `num_activo`,`a`.`nombre` AS `nombre`,`t`.`tipo` AS `tipo`,`n`.`nivel` AS `nivel`,`u`.`ubicacion` AS `ubicacion`,`a`.`costo` AS `costo` from (((`activos` `a` join `tipos_activos` `t`) join `ubicacion` `u`) join `niveles` `n`) where ((`t`.`id` = `a`.`id_tipo`) and (`u`.`id` = `a`.`id_ubicacion`) and (`n`.`id` = `a`.`id_nivel`));


--
-- View structure for view `plagetri21`.`mantenimiento_correctivo`
--

DROP VIEW IF EXISTS `mantenimiento_correctivo`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mantenimiento_correctivo` AS select `m`.`fecha_realizacion` AS `fecha_realizacion`,`a`.`num_activo` AS `num_activo`,`a`.`nombre` AS `nombre`,`a`.`marca` AS `marca`,`a`.`modelo` AS `modelo`,`a`.`serie` AS `serie`,`m`.`realizado_por` AS `realizado_por`,`m`.`aprobado_por` AS `aprobado_por`,`m`.`costo_mantenimiento` AS `costo_mantenimiento` from (`mantenimientos` `m` join `activos` `a`) where ((`m`.`id_tipo_mantenimiento` = 2) and (`a`.`id` = `m`.`id_activo`)) order by `m`.`costo_mantenimiento` desc;


--
-- View structure for view `plagetri21`.`mantenimiento_preventivo`
--

DROP VIEW IF EXISTS `mantenimiento_preventivo`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mantenimiento_preventivo` AS select `m`.`fecha_realizacion` AS `fecha_realizacion`,`a`.`num_activo` AS `num_activo`,`a`.`nombre` AS `nombre`,`a`.`marca` AS `marca`,`a`.`modelo` AS `modelo`,`a`.`serie` AS `serie`,`m`.`realizado_por` AS `realizado_por`,`m`.`aprobado_por` AS `aprobado_por`,`m`.`costo_mantenimiento` AS `costo_mantenimiento` from (`mantenimientos` `m` join `activos` `a`) where ((`m`.`id_tipo_mantenimiento` = 1) and (`a`.`id` = `m`.`id_activo`)) order by `m`.`costo_mantenimiento` desc;


--
-- View structure for view `plagetri21`.`obtener_activos`
--

DROP VIEW IF EXISTS `obtener_activos`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `obtener_activos` AS select `a`.`id` AS `id`,`a`.`num_activo` AS `num_activo`,`a`.`nombre` AS `nombre`,`t`.`tipo` AS `tipo`,`n`.`nivel` AS `nivel`,`u`.`ubicacion` AS `ubicacion`,`a`.`costo` AS `costo` from (((`activos` `a` join `tipos_activos` `t`) join `ubicacion` `u`) join `niveles` `n`) where ((`t`.`id` = `a`.`id_tipo`) and (`u`.`id` = `a`.`id_ubicacion`) and (`n`.`id` = `a`.`id_nivel`) and (`a`.`id` > 0));

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
