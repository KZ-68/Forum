-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forum
CREATE DATABASE IF NOT EXISTS `forum` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forum`;

-- Listage de la structure de table forum. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table forum.category : ~0 rows (environ)
INSERT INTO `category` (`id_category`, `categoryName`) VALUES
	(1, 'Plateformer'),
	(2, 'Strategy');

-- Listage de la structure de table forum. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `topic_id` int DEFAULT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `creationDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id_post`),
  KEY `id_user` (`user_id`) USING BTREE,
  KEY `id_topic` (`topic_id`) USING BTREE,
  CONSTRAINT `FK_post_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `FK_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table forum.post : ~0 rows (environ)
INSERT INTO `post` (`id_post`, `user_id`, `topic_id`, `text`, `creationDate`) VALUES
	(1, 1, 1, 'Thanks for the offer Marie, I didn\'t start to play this game for now.\r\nBut if I need your help now I know where to ask !', '2023-06-11 15:20:00');

-- Listage de la structure de table forum. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `category_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `textTopic` text COLLATE utf8mb4_general_ci,
  `creationDate` datetime DEFAULT NULL,
  `closed` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_topic`),
  KEY `id_category` (`category_id`) USING BTREE,
  KEY `id_user` (`user_id`) USING BTREE,
  CONSTRAINT `FK_topic_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
  CONSTRAINT `FK_topic_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table forum.topic : ~0 rows (environ)
INSERT INTO `topic` (`id_topic`, `category_id`, `user_id`, `title`, `textTopic`, `creationDate`, `closed`) VALUES
	(1, 1, 2, 'Mario Odyssey Tricks and Tips', 'Anyone want help ? I finished Mario Odyssey so I can offer tips... ', '2023-06-11 13:00:00', 0),
	(2, 2, 1, 'Starcraft 2 Discussion Board', 'This is the main topic for Starcraft 2, help request and spoil can be post here', '2023-06-02 15:25:00', 0);

-- Listage de la structure de table forum. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` json DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `registrationDate` datetime DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table forum.user : ~0 rows (environ)
INSERT INTO `user` (`id_user`, `email`, `username`, `role`, `password`, `registrationDate`, `avatar`) VALUES
	(1, 'john.doe@gmail.com', 'John885', NULL, 'j0nH@BtZ.54', '2023-05-18 11:00:00', NULL),
	(2, 'marie.tempe@outlook.com', 'MarieT42', NULL, 'Vfld.785@Rg5', '2023-06-01 15:00:00', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
