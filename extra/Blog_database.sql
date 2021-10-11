-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table blog.articulos
CREATE TABLE IF NOT EXISTS `articulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`usuarios_id`),
  KEY `fk_articulos_usuarios1` (`usuarios_id`),
  CONSTRAINT `fk_articulos_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table blog.articulos_has_categorias
CREATE TABLE IF NOT EXISTS `articulos_has_categorias` (
  `articulos_id` int(11) NOT NULL,
  `articulos_usuarios_id` int(11) NOT NULL,
  `categorias_id` int(11) NOT NULL,
  PRIMARY KEY (`articulos_id`,`articulos_usuarios_id`,`categorias_id`),
  KEY `fk_articulos_has_categorias_categorias1` (`categorias_id`),
  CONSTRAINT `fk_articulos_has_categorias_articulos1` FOREIGN KEY (`articulos_id`, `articulos_usuarios_id`) REFERENCES `articulos` (`id`, `usuarios_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_articulos_has_categorias_categorias1` FOREIGN KEY (`categorias_id`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table blog.articulos_has_multimedia
CREATE TABLE IF NOT EXISTS `articulos_has_multimedia` (
  `articulos_id` int(11) NOT NULL,
  `articulos_usuarios_id` int(11) NOT NULL,
  `multimedia_id` int(11) NOT NULL,
  `multimedia_usuarios_id` int(11) NOT NULL,
  PRIMARY KEY (`articulos_id`,`articulos_usuarios_id`,`multimedia_id`,`multimedia_usuarios_id`),
  KEY `fk_articulos_has_multimedia_multimedia1` (`multimedia_id`,`multimedia_usuarios_id`),
  CONSTRAINT `fk_articulos_has_multimedia_articulos1` FOREIGN KEY (`articulos_id`, `articulos_usuarios_id`) REFERENCES `articulos` (`id`, `usuarios_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_articulos_has_multimedia_multimedia1` FOREIGN KEY (`multimedia_id`, `multimedia_usuarios_id`) REFERENCES `multimedia` (`id`, `usuarios_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table blog.avatares
CREATE TABLE IF NOT EXISTS `avatares` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enlace` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table blog.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table blog.comentarios
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenido` varchar(100) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `articulos_id` int(11) NOT NULL,
  `articulos_usuarios_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`usuarios_id`),
  KEY `fk_comentarios_usuarios1` (`usuarios_id`),
  KEY `fk_comentarios_articulos1` (`articulos_id`,`articulos_usuarios_id`),
  CONSTRAINT `fk_comentarios_articulos1` FOREIGN KEY (`articulos_id`, `articulos_usuarios_id`) REFERENCES `articulos` (`id`, `usuarios_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comentarios_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table blog.multimedia
CREATE TABLE IF NOT EXISTS `multimedia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `extension` varchar(10) NOT NULL,
  `enlace` varchar(45) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`usuarios_id`),
  KEY `fk_multimedia_usuarios1` (`usuarios_id`),
  CONSTRAINT `fk_multimedia_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table blog.redes_sociales
CREATE TABLE IF NOT EXISTS `redes_sociales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `enlace` varchar(45) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`usuarios_id`),
  KEY `fk_redes_sociales_usuarios1` (`usuarios_id`),
  CONSTRAINT `fk_redes_sociales_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table blog.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) DEFAULT NULL,
  `nickname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `avatares_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuarios_avatares` (`avatares_id`),
  CONSTRAINT `fk_usuarios_avatares` FOREIGN KEY (`avatares_id`) REFERENCES `avatares` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
