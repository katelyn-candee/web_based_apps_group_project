-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 04, 2023 at 03:48 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_app`
--
CREATE DATABASE IF NOT EXISTS `food_app` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `food_app`;

-- --------------------------------------------------------

--
-- Table structure for table `food_items`
--

DROP TABLE IF EXISTS `food_items`;
CREATE TABLE IF NOT EXISTS `food_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `food_items`
--

INSERT INTO `food_items` (`id`, `name`) VALUES
(1, 'Spaghetti Carbonara'),
(2, 'Chicken Tikka Masala'),
(3, 'Margherita Pizza'),
(4, 'Sushi Platter'),
(5, 'Beef Burrito');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rating` int DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `user_id` int DEFAULT NULL,
  `food_item_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `food_item_id` (`food_item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `rating`, `title`, `description`, `user_id`, `food_item_id`) VALUES
(1, 5, 'Delicious Spaghetti Carbonara', 'The Spaghetti Carbonara was absolutely scrumptious!', 1, 1),
(2, 4, 'Savory Chicken Tikka Masala', 'The Chicken Tikka Masala was a delightful blend of flavors.', 2, 2),
(3, 3, 'Decent Margherita Pizza', 'The Margherita Pizza was okay but nothing to write home about.', 3, 3),
(4, 5, 'Outstanding Sushi Platter', 'The Sushi Platter exceeded my expectations. It was divine!', 4, 4),
(5, 2, 'Disappointing Beef Burrito', 'The Beef Burrito left me unimpressed. I expected more.', 5, 5),
(6, 4, 'Tasty Spaghetti Carbonara', 'This Spaghetti Carbonara was tasty, but not the best I\'ve had.', 6, 1),
(7, 3, 'Spicy Chicken Tikka', 'The Chicken Tikka was too spicy for my taste.', 7, 2),
(8, 4, 'Margherita Perfection', 'The Margherita Pizza was a perfection in taste and texture.', 8, 3),
(9, 5, 'Sushi Heaven', 'The Sushi was a taste of heaven in each bite.', 9, 4),
(10, 2, 'Burrito Blues', 'The Beef Burrito left much to be desired, quite disappointing.', 10, 5),
(11, 4, 'Spaghetti Satisfaction', 'The Spaghetti Carbonara was satisfying and full of flavor.', 11, 1),
(12, 3, 'Tikka Delight', 'The Chicken Tikka was a delightful delight!', 12, 2),
(13, 4, 'Cheesy Margherita', 'The Margherita Pizza was cheesy and delicious.', 13, 3),
(14, 5, 'Sashimi Bliss', 'The Sashimi was a blissful experience.', 14, 4),
(15, 2, 'Burrito Meltdown', 'The Beef Burrito was a meltdown of flavors.', 15, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `city`, `state`) VALUES
(1, 'cybernaut42', 'John', 'Doe', 'New York', 'NY'),
(2, 'artisticTraveler', 'Jane', 'Smith', 'Los Angeles', 'CA'),
(3, 'quirkyAdventurer', 'Alice', 'Johnson', 'Chicago', 'IL'),
(4, 'gourmetExplorer', 'Bob', 'Brown', 'San Francisco', 'CA'),
(5, 'beachBreeze', 'Ella', 'Wilson', 'Miami', 'FL'),
(6, 'urbanWanderer', 'David', 'Clark', 'Houston', 'TX'),
(7, 'cosmicVoyager', 'Sophia', 'Harris', 'Boston', 'MA'),
(8, 'dreamCatcher', 'James', 'Lee', 'Seattle', 'WA'),
(9, 'skySurfer', 'Olivia', 'Taylor', 'Denver', 'CO'),
(10, 'musicMystic', 'William', 'Anderson', 'Dallas', 'TX'),
(11, 'desertDreamer', 'Ava', 'Martinez', 'Phoenix', 'AZ'),
(12, 'cityNomad', 'Joseph', 'White', 'Atlanta', 'GA'),
(13, 'foodieWanderlust', 'Mia', 'Green', 'Philadelphia', 'PA'),
(14, 'tropicExplorer', 'Michael', 'Lopez', 'San Diego', 'CA'),
(15, 'nightSkyDreamer', 'Emily', 'Jackson', 'Las Vegas', 'NV');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
