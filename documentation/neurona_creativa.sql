-- phpMyAdmin SQL Dump
-- version 3.3.10.4
-- http://www.phpmyadmin.net
--
-- Servidor: mysql.levhita.net
-- Tiempo de generación: 04-03-2015 a las 19:31:00
-- Versión del servidor: 5.1.56
-- Versión de PHP: 5.4.37

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de datos: `gnsstudio_development`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asset`
--

CREATE TABLE IF NOT EXISTS `asset` (
  `id_asset` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('image','video') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'image',
  PRIMARY KEY (`id_asset`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `asset`
--

INSERT INTO `asset` (`id_asset`, `name`, `url`, `type`) VALUES
(1, 'home_cover_mp4', 'e6583-background.mp4', 'video'),
(2, 'home_cover_static', 'a6ae3-background.jpg', 'image'),
(3, 'home_cover_webm', '09750-background.webm', 'video');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_parent_category` int(10) unsigned DEFAULT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_category`),
  KEY `fk_category_category1_idx` (`id_parent_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Volcar la base de datos para la tabla `category`
--

INSERT INTO `category` (`id_category`, `id_parent_category`, `name`) VALUES
(1, NULL, 'Fotografía'),
(2, 1, 'Estudio'),
(3, 1, 'Locación'),
(4, 1, 'Product Shot'),
(5, NULL, 'Ilustraciones'),
(6, NULL, 'Campañas - BTL'),
(7, NULL, 'Audiovisuales'),
(8, NULL, 'Identidades'),
(9, NULL, 'Empaque - Display');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuration`
--

CREATE TABLE IF NOT EXISTS `configuration` (
  `id_ configuration` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_ configuration`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `configuration`
--

INSERT INTO `configuration` (`id_ configuration`, `name`, `value`) VALUES
(1, 'smtp_host', 'ssl://smtp.googlemail.com'),
(2, 'smtp_port', '465'),
(3, 'smtp_user', 'corre@gmail.com'),
(4, 'smtp_pass', 'password'),
(5, 'contact_email', 'hola@gnsstudio.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id_image` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_project` int(10) unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_image`),
  KEY `fk_image_project_idx` (`id_project`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Volcar la base de datos para la tabla `image`
--

INSERT INTO `image` (`id_image`, `id_project`, `url`, `order`) VALUES
(1, 1, '946bc-04_imagen-01.jpg', 1),
(2, 1, '6bc13-04_imagen-02.jpg', 2),
(3, 1, 'caeb3-04_imagen-03.jpg', 3),
(4, 1, 'b82d9-04_imagen-04.jpg', 4),
(5, 2, 'ab4d0-cya_concurso-01.jpg', 1),
(6, 2, 'e22e4-cya_concurso-02.jpg', 2),
(7, 3, '349af-el-muro-01.jpg', 1),
(8, 3, '1724f-el-muro-02.jpg', 2),
(9, 4, '406e6-el-ultimo-pitch-01.jpg', 1),
(10, 5, 'b04de-intima-cat-14-01.jpg', 1),
(11, 5, 'b624c-intima-cat-14-02.jpg', 2),
(12, 5, '4b4c4-intima-cat-14-03.jpg', 3),
(13, 6, '1d432-intima_sonar-no-cuesta-nada-01.jpg', 1),
(14, 6, '08b67-intima_sonar-no-cuesta-nada-02.jpg', 2),
(15, 6, '87816-intima_sonar-no-cuesta-nada-03.jpg', 3),
(16, 7, 'ce311-p-stone_catalogo-2014-01.jpg', 1),
(17, 7, 'd2960-p-stone_catalogo-2014-02.jpg', 2),
(18, 7, '6c7db-p-stone_catalogo-2014-03.jpg', 3),
(19, 8, 'f0e62-rolisco_empaque-01.jpg', 1),
(20, 8, 'aa961-rolisco_empaque-02.jpg', 2),
(21, 8, '18c63-rolisco_empaque-03.jpg', 3),
(22, 8, '9c2ff-rolisco_empaque-04.jpg', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id_project` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `short_url` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `credits` text COLLATE utf8_unicode_ci,
  `active` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id_project`),
  UNIQUE KEY `short_url_UNIQUE` (`short_url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Volcar la base de datos para la tabla `project`
--

INSERT INTO `project` (`id_project`, `name`, `short_url`, `date`, `description`, `credits`, `active`) VALUES
(1, 'Cero Cuatro', 'cero_cuatro', '2015-02-01', '<p>\n	Dise&ntilde;o de identidad y papeler&iacute;a para Cero Cuatro</p>\n', '<p>\n	<strong>Dise&ntilde;o</strong><br />\n	<em>El dise&ntilde;ador</em></p>\n', 'yes'),
(2, 'C&A Concurso', 'cya_concurso', '2015-02-02', '<p>\n	Dise&ntilde;o de concurso para C&amp;A</p>\n', '<p>\n	<strong>Dise&ntilde;o</strong><br />\n	<em>El dise&ntilde;ador</em></p>\n', 'yes'),
(3, 'El Muro', 'el_muro', '2015-02-03', '<p>\n	Fotograf&iacute;a y dise&ntilde;o para publicidad de El Muro</p>\n', '<p>\n	<strong>Fotograf&iacute;a</strong><br />\n	<em>El fotografo</em></p>\n<p>\n	<strong>Dise&ntilde;o</strong><br />\n	<em>El dise&ntilde;ador</em></p>\n', 'yes'),
(4, 'El Último Pitch', 'el_ultimo_pitch', '2015-02-04', '<p>\n	Fotograf&iacute;a y Dise&ntilde;o para Reconocida compa&ntilde;ia de marqueting</p>\n', '<p>\n	<strong>Fotograf&iacute;a</strong><br />\n	<em>El fotografo</em></p>\n', 'yes'),
(5, 'Íntima Catálogo', 'intima_catalogo', '2015-02-06', '<p>\n	Fotograf&iacute;a y dise&ntilde;o para el c&aacute;talogo para &iacute;ntima</p>\n', '<p>\n	<strong>Fotograf&iacute;a</strong><br />\n	<em>El fotografo</em><br />\n	<br />\n	<strong>Dise&ntilde;o</strong><br />\n	<em>El dise&ntilde;ador</em></p>\n', 'yes'),
(6, 'Soñar no cuesta nada', 'intima_campana', '2015-02-19', '<p>\n	Campa&ntilde;a So&ntilde;ar no cuesta nada de &iacute;ntima</p>\n', '<p>\n	<strong>Fotograf&iacute;a</strong><br />\n	<em>El fotografo</em></p>\n', 'yes'),
(7, 'Perdura Stone', 'perdura_stone', '2015-02-20', '<p>\n	C&aacute;talogo para Perdura Stone</p>\n', '<p>\n	<strong>Fotograf&iacute;a</strong><br />\n	<em>El Fotografo</em></p>\n', 'yes'),
(8, 'Rolisco', 'rolisco', '2015-02-24', '<p>\n	Rolisco</p>\n', NULL, 'yes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project_category`
--

CREATE TABLE IF NOT EXISTS `project_category` (
  `id_category` int(10) unsigned NOT NULL,
  `id_project` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_category`,`id_project`),
  KEY `fk_project_category_category1_idx` (`id_category`),
  KEY `fk_project_category_project1_idx` (`id_project`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `project_category`
--

INSERT INTO `project_category` (`id_category`, `id_project`) VALUES
(1, 4),
(1, 5),
(1, 6),
(2, 3),
(4, 7),
(4, 8),
(5, 2),
(5, 3),
(5, 5),
(6, 2),
(8, 1),
(9, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `id_video` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_project` int(10) unsigned NOT NULL,
  `video_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_video`),
  KEY `fk_image_project_idx` (`id_project`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `video`
--


--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `fk_category_category1` FOREIGN KEY (`id_parent_category`) REFERENCES `category` (`id_category`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_image_project` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `project_category`
--
ALTER TABLE `project_category`
  ADD CONSTRAINT `fk_project_category_category1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_category_project1` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `fk_image_project0` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON DELETE NO ACTION ON UPDATE NO ACTION;
