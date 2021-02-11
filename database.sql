CREATE DATABASE IF NOT EXISTS `nf_register`;

USE `nf_register`;

CREATE TABLE `places` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`)
);

INSERT INTO `places` (`name`, `parameter`) VALUES 
('Cafétéria', 'cafeteria'),
('Co-working', 'coworking'),
('Fablab', 'fablab'),
('Accueil', 'reception'),
('Petite salle de réunion', 'meeting_small'),
('Moyenne salle de réunion', 'meeting_medium'),
('Grande salle de réunion', 'meeting_large'),
('Salle de réunion (bureau)', 'meeting_office');

CREATE TABLE `register` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`date` DATE NOT NULL,
	`time` TIME NOT NULL,
	`lastname` VARCHAR(100) NOT NULL,
	`firstname` VARCHAR(100) NOT NULL,
	`email` VARCHAR(255) NOT NULL,
	`phone` VARCHAR(50) NOT NULL,
	`place_id` INT NOT NULL,
	PRIMARY KEY (`id`),
	FOREIGN KEY (`place_id`) REFERENCES `places`(`id`) ON DELETE CASCADE
);