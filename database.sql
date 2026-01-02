-- database.sql
-- Schéma minimal pour l'application de gestion de stock

CREATE DATABASE IF NOT EXISTS `projet_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `projet_db`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS `products` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT,
  `price` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `quantity` INT NOT NULL DEFAULT 0,
  `category_id` INT DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE SET NULL
);

-- Exemples de données
INSERT INTO `categories` (`name`) VALUES ('Électronique'), ('Papeterie');

INSERT INTO `products` (`name`,`description`,`price`,`quantity`,`category_id`) VALUES
( 'Clé USB 16GB', 'USB 3.0', 9.99, 50, 1 ),
( 'Cahier A4 80p', 'Cahier lignés', 1.99, 200, 2 );

-- Note: L'utilisateur admin est créé automatiquement par le script PHP lors de la première connexion
