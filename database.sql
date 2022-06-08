-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.22-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para economapas
CREATE DATABASE IF NOT EXISTS `economapas` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `economapas`;

-- Copiando estrutura para tabela economapas.groups
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) DEFAULT NULL,
  `state_id` varchar(50) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela economapas.groups: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela economapas.states
CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(150) DEFAULT NULL,
  `uf` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela economapas.states: ~8 rows (aproximadamente)
INSERT INTO `states` (`id`, `city`, `uf`) VALUES
	(1, 'Angra dos Reis', 'RJ'),
	(2, 'Niteroí', 'RJ'),
	(3, 'Petrópolis', 'RJ'),
	(4, 'Nova Iguaçu', 'RJ'),
	(5, 'Macaé', 'RJ'),
	(6, 'Rio de Janeiro', 'RJ'),
	(7, 'Nova Friburgo', 'RJ'),
	(8, 'Volta Redonda', 'RJ'),
	(9, 'Tanguá', 'RJ'),
	(10, 'Magé', 'RJ');

-- Copiando estrutura para tabela economapas.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela economapas.users: ~2 rows (aproximadamente)
INSERT INTO `users` (`id`, `login`, `password`) VALUES
	(1, 'joao', '$2a$12$KTJ1LzwL0RMe3RzJnZm9BOxwXc73GMkFgOYobSf.K9AKLR2eHsaXe'),
	(2, 'maria', '$2a$12$w5d0pPMUpDCXfl1zjkOyRuobkO9cEoEHVLrVqGtjMPU163baIVjSC');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
