-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: neurona_creativa
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.14.04.1

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
-- Table structure for table `asset`
--

DROP TABLE IF EXISTS `asset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asset` (
  `id_asset` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('image','video') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'image',
  PRIMARY KEY (`id_asset`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset`
--

LOCK TABLES `asset` WRITE;
/*!40000 ALTER TABLE `asset` DISABLE KEYS */;
INSERT INTO `asset` VALUES (1,'home_cover_mp4_1','e6583-background.mp4','video'),(2,'home_cover_static_1','a6ae3-background.jpg','image'),(3,'home_cover_webm_1','09750-background.webm','video'),(4,'header_services','07637-cover_services.png','image');
/*!40000 ALTER TABLE `asset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id_category` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_parent_category` int(10) unsigned DEFAULT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_category`),
  KEY `fk_category_category1_idx` (`id_parent_category`),
  CONSTRAINT `fk_category_category1` FOREIGN KEY (`id_parent_category`) REFERENCES `category` (`id_category`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,NULL,'Fotografía'),(2,1,'Estudio'),(3,1,'Locación'),(4,1,'Product Shot'),(5,NULL,'Ilustraciones'),(6,NULL,'Campañas - BTL'),(7,NULL,'Audiovisuales'),(8,NULL,'Identidades'),(9,NULL,'Empaque - Display');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuration`
--

DROP TABLE IF EXISTS `configuration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuration` (
  `id_configuration` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_configuration`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuration`
--

LOCK TABLES `configuration` WRITE;
/*!40000 ALTER TABLE `configuration` DISABLE KEYS */;
INSERT INTO `configuration` VALUES (1,'smtp_host','ssl://smtp.googlemail.com'),(2,'smtp_port','465'),(3,'smtp_user','corre@gmail.com'),(4,'smtp_pass','password'),(5,'contact_email','hola@gnsstudio.com'),(6,'footer_text_1','Queremos hacerte la vida más fácil.'),(7,'home_covers','1'),(8,'footer_texts','2'),(9,'footer_text_2','Segunda frase de ejemplo.');
/*!40000 ALTER TABLE `configuration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image`
--



--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project` (
  `id_project` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `short_url` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `credits` text COLLATE utf8_unicode_ci,
  `active` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id_project`),
  UNIQUE KEY `short_url_UNIQUE` (`short_url`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES (1,'Cero Cuatro','cero_cuatro','2015-02-01','<p>\n	Dise&ntilde;o de identidad y papeler&iacute;a para Cero Cuatro</p>\n','<p>\n	<strong>Dise&ntilde;o</strong><br />\n	<em>El dise&ntilde;ador</em></p>\n','yes'),(2,'C&A Concurso','cya_concurso','2015-02-02','<p>\n	Dise&ntilde;o de concurso para C&amp;A</p>\n','<p>\n	<strong>Dise&ntilde;o</strong><br />\n	<em>El dise&ntilde;ador</em></p>\n','yes'),(3,'El Muro','el_muro','2015-02-03','<p>\n	Fotograf&iacute;a y dise&ntilde;o para publicidad de El Muro</p>\n','<p>\n	<strong>Fotograf&iacute;a</strong><br />\n	<em>El fotografo</em></p>\n<p>\n	<strong>Dise&ntilde;o</strong><br />\n	<em>El dise&ntilde;ador</em></p>\n','yes'),(4,'El Último Pitch','el_ultimo_pitch','2015-02-04','<p>\n	Fotograf&iacute;a y Dise&ntilde;o para Reconocida compa&ntilde;ia de marqueting</p>\n','<p>\n	<strong>Fotograf&iacute;a</strong><br />\n	<em>El fotografo</em></p>\n','yes'),(5,'Íntima Catálogo','intima_catalogo','2015-02-06','<p>\n	Fotograf&iacute;a y dise&ntilde;o para el c&aacute;talogo para &iacute;ntima</p>\n','<p>\n	<strong>Fotograf&iacute;a</strong><br />\n	<em>El fotografo</em><br />\n	<br />\n	<strong>Dise&ntilde;o</strong><br />\n	<em>El dise&ntilde;ador</em></p>\n','yes'),(6,'Soñar no cuesta nada','intima_campana','2015-02-19','<p>\n	Campa&ntilde;a So&ntilde;ar no cuesta nada de &iacute;ntima</p>\n','<p>\n	<strong>Fotograf&iacute;a</strong><br />\n	<em>El fotografo</em></p>\n','yes'),(7,'Perdura Stone','perdura_stone','2015-02-20','<p>\n	C&aacute;talogo para Perdura Stone</p>\n','<p>\n	<strong>Fotograf&iacute;a</strong><br />\n	<em>El Fotografo</em></p>\n','yes'),(8,'Rolisco','rolisco','2015-02-24','<p>\n	Rolisco</p>\n',NULL,'yes');
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_category`
--





DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image` (
  `id_image` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_project` int(10) unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_image`),
  KEY `fk_image_project_idx` (`id_project`),
  CONSTRAINT `fk_image_project` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` VALUES (1,1,'946bc-04_imagen-01.jpg',1),(2,1,'6bc13-04_imagen-02.jpg',2),(3,1,'caeb3-04_imagen-03.jpg',3),(4,1,'b82d9-04_imagen-04.jpg',4),(5,2,'ab4d0-cya_concurso-01.jpg',1),(6,2,'e22e4-cya_concurso-02.jpg',2),(7,3,'349af-el-muro-01.jpg',1),(8,3,'1724f-el-muro-02.jpg',2),(9,4,'406e6-el-ultimo-pitch-01.jpg',1),(10,5,'b04de-intima-cat-14-01.jpg',1),(11,5,'b624c-intima-cat-14-02.jpg',2),(12,5,'4b4c4-intima-cat-14-03.jpg',3),(13,6,'1d432-intima_sonar-no-cuesta-nada-01.jpg',1),(14,6,'08b67-intima_sonar-no-cuesta-nada-02.jpg',2),(15,6,'87816-intima_sonar-no-cuesta-nada-03.jpg',3),(16,7,'ce311-p-stone_catalogo-2014-01.jpg',1),(17,7,'d2960-p-stone_catalogo-2014-02.jpg',2),(18,7,'6c7db-p-stone_catalogo-2014-03.jpg',3),(19,8,'f0e62-rolisco_empaque-01.jpg',1),(20,8,'aa961-rolisco_empaque-02.jpg',2),(21,8,'18c63-rolisco_empaque-03.jpg',3),(22,8,'9c2ff-rolisco_empaque-04.jpg',4);
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;













DROP TABLE IF EXISTS `project_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_category` (
  `id_category` int(10) unsigned NOT NULL,
  `id_project` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_category`,`id_project`),
  KEY `fk_project_category_category1_idx` (`id_category`),
  KEY `fk_project_category_project1_idx` (`id_project`),
  CONSTRAINT `fk_project_category_category1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_category_project1` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;













--
-- Dumping data for table `project_category`
--

LOCK TABLES `project_category` WRITE;
/*!40000 ALTER TABLE `project_category` DISABLE KEYS */;
INSERT INTO `project_category` VALUES (1,4),(1,5),(1,6),(2,3),(2,4),(4,4),(4,7),(4,8),(5,2),(5,3),(5,5),(6,2),(8,1),(9,8);
/*!40000 ALTER TABLE `project_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video` (
  `id_video` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_project` int(10) unsigned NOT NULL,
  `video_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_video`),
  KEY `fk_image_project_idx` (`id_project`),
  CONSTRAINT `fk_image_project0` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video`
--

LOCK TABLES `video` WRITE;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
INSERT INTO `video` VALUES (1,1,'p2H5YVfZVFw','9af71-screenshot-from-2015-03-05-19-47-21.png',1);
/*!40000 ALTER TABLE `video` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-18  6:57:32
