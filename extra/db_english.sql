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


-- Dumping database structure for bepet_blog
CREATE DATABASE IF NOT EXISTS `bepet_blog` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `bepet_blog`;

-- Dumping structure for table bepet_blog.articles
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `creation_date` timestamp NOT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`users_id`),
  KEY `fk_articles_users1` (`users_id`),
  CONSTRAINT `fk_articles_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table bepet_blog.articles: ~0 rows (approximately)
DELETE FROM `articles`;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;

-- Dumping structure for table bepet_blog.articles_has_categories
CREATE TABLE IF NOT EXISTS `articles_has_categories` (
  `articles_id` int(11) NOT NULL,
  `articles_users_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  PRIMARY KEY (`articles_id`,`articles_users_id`,`categories_id`),
  KEY `fk_articles_has_categories_categories1` (`categories_id`),
  CONSTRAINT `fk_articles_has_categories_articles1` FOREIGN KEY (`articles_id`, `articles_users_id`) REFERENCES `articles` (`id`, `users_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_articles_has_categories_categories1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table bepet_blog.articles_has_categories: ~0 rows (approximately)
DELETE FROM `articles_has_categories`;
/*!40000 ALTER TABLE `articles_has_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `articles_has_categories` ENABLE KEYS */;

-- Dumping structure for table bepet_blog.articles_has_media
CREATE TABLE IF NOT EXISTS `articles_has_media` (
  `articles_id` int(11) NOT NULL,
  `articles_users_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `media_users_id` int(11) NOT NULL,
  PRIMARY KEY (`articles_id`,`articles_users_id`,`media_id`,`media_users_id`),
  KEY `fk_articles_has_media_media1` (`media_id`,`media_users_id`),
  CONSTRAINT `fk_articles_has_media_articles1` FOREIGN KEY (`articles_id`, `articles_users_id`) REFERENCES `articles` (`id`, `users_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_articles_has_media_media1` FOREIGN KEY (`media_id`, `media_users_id`) REFERENCES `media` (`id`, `users_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table bepet_blog.articles_has_media: ~0 rows (approximately)
DELETE FROM `articles_has_media`;
/*!40000 ALTER TABLE `articles_has_media` DISABLE KEYS */;
/*!40000 ALTER TABLE `articles_has_media` ENABLE KEYS */;

-- Dumping structure for table bepet_blog.avatars
CREATE TABLE IF NOT EXISTS `avatars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- Dumping data for table bepet_blog.avatars: ~7 rows (approximately)
DELETE FROM `avatars`;
/*!40000 ALTER TABLE `avatars` DISABLE KEYS */;
INSERT INTO `avatars` (`id`, `link`) VALUES
	(36, '/Blog/Img/avatar/61760cc31fede.gif'),
	(37, '/Blog/Img/avatar/61760ccbaacc3.gif'),
	(38, '/Blog/Img/avatar/617612a477289.gif'),
	(39, '/Blog/Img/avatar/617612ad8baea.png'),
	(40, '/Blog/Img/avatar/617612b58c0af.gif'),
	(41, '/Blog/Img/avatar/617612bd658d0.gif'),
	(43, '/Blog/Img/avatar/617a9c9d40a22.gif');
/*!40000 ALTER TABLE `avatars` ENABLE KEYS */;

-- Dumping structure for table bepet_blog.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table bepet_blog.categories: ~0 rows (approximately)
DELETE FROM `categories`;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table bepet_blog.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(100) NOT NULL,
  `creation_date` datetime NOT NULL,
  `users_id` int(11) NOT NULL,
  `articles_id` int(11) NOT NULL,
  `articles_users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`users_id`),
  KEY `fk_comments_users1` (`users_id`),
  KEY `fk_comments_articles1` (`articles_id`,`articles_users_id`),
  CONSTRAINT `fk_comments_articles1` FOREIGN KEY (`articles_id`, `articles_users_id`) REFERENCES `articles` (`id`, `users_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table bepet_blog.comments: ~0 rows (approximately)
DELETE FROM `comments`;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Dumping structure for table bepet_blog.media
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `extension` varchar(10) NOT NULL,
  `link` varchar(45) NOT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`users_id`),
  KEY `fk_media_users1` (`users_id`),
  CONSTRAINT `fk_media_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table bepet_blog.media: ~0 rows (approximately)
DELETE FROM `media`;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media` ENABLE KEYS */;

-- Dumping structure for table bepet_blog.social_media
CREATE TABLE IF NOT EXISTS `social_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `link` varchar(45) NOT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`users_id`),
  KEY `fk_social_media_users1` (`users_id`),
  CONSTRAINT `fk_social_media_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table bepet_blog.social_media: ~0 rows (approximately)
DELETE FROM `social_media`;
/*!40000 ALTER TABLE `social_media` DISABLE KEYS */;
/*!40000 ALTER TABLE `social_media` ENABLE KEYS */;

-- Dumping structure for table bepet_blog.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `nickname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `avatars_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nickname` (`nickname`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_users_avatars` (`avatars_id`),
  CONSTRAINT `fk_users_avatars` FOREIGN KEY (`avatars_id`) REFERENCES `avatars` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Dumping data for table bepet_blog.users: ~12 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `last_name`, `nickname`, `email`, `password`, `avatars_id`) VALUES
	(1, 'Andres', 'Borda', 'Anjart', 'anjart24@gmail.com', '$2y$10$pu8DpwA81CPsjQL1hYdvy.LiDP8UA3fJIkre333E8FhUF01Phr26u', 36),
	(4, 'Juan', 'Perdomo', 'Assassin15', 'perdomo334@hotmail.com', '$2y$10$tR3xbc5mhti/spsoVelV0.maLxoDHmdwYe7bJTMYYKwRYgoCEblWm', 37),
	(5, 'Vanessa ', 'Pineda', 'Vane', 'Vanessa24@gmail.com', '$2y$10$NxMD7oKSMbKH5EpL0b1qRe1KxdRB4Hb0QD/60jfmh2gVwIyr60IB.', 38),
	(6, 'Valentina', 'Garcia', 'ValenSnowflake', 'Snowflake76@gmail.com', '$2y$10$BO4z0ihy3GB63ObT/rQEGuiFoSJtA72R3dUqxQOLhkhn8tRtN0xtO', 37),
	(7, 'Alejandro', 'Rios', 'Samurai009', 'ralej45ndro@gmail.com', '$2y$10$gLwcJ6jwcct03Ujwr1o5GO1hyyAaef7sIcHpNbkGts4/o5toSuFd.', 36),
	(8, 'Luisa', 'Ceballos', 'Sweetthang', '98Luisa32@gmail.com', '$2y$10$V.Uf2R..LPgL.c8tsIpk5uzx/ajF0RMn5.mZ/BM4yO147Fn29W3xy', 36),
	(9, 'Mario', '', 'ItsMeMario', 'm4ri0123@gmail.com', '$2y$10$eIqwXVdhXTm8UzLGx4SOdOnl.JsfC7RrbIhZ9favNZ2qdtY/jsPna', 39),
	(10, 'Valentina', 'Varon', 'ValenVa23', 'ValenVa23@gmail.com', '$2y$10$.9laQhq0.Aa446LYRZU/0.UUZ9fu..h.SqWj7YSmtrPypHoXUnbRu', 39),
	(13, 'Jose', 'Villa', 'JoJo-se', 'Jose010@gmail.com', '$2y$10$zOGteFW1JTn8AAj6/szuIuR9JQ0T7XMMN6kSct/6zuRdhK1xq4W0O', 36),
	(15, 'ElDon', 'Juan', 'DonJu4n', 'Ju44n123@gmail.com', '$2y$10$DMs8tfYOclcDUAbZ/jQBWuH3hluj.dLUAX4FASVbkMjp.dDhpoTlK', 43),
	(16, 'Testor', 'FernanTest', 'Test009', 'emailTest_1@gmail.com', '$2y$10$A6qOQS8BRg50h3w2QScpt.1ZtetE6n4D7brPSrRi8iG31xXYrRVaq', 36),
	(18, 'Test_ura', NULL, 'HernanTest', 'emailTest_3@gmail.com', '$2y$10$t3oU7Zg9KlT0kLwxS6AUwOLdQ2T4Kwp/kbiiGVqDu0B.k25xsx0Ie', 41);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
