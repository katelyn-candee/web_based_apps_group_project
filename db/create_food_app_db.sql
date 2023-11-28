-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 28, 2023 at 09:25 PM
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
-- Table structure for table `food_item`
--

DROP TABLE IF EXISTS `food_item`;
CREATE TABLE IF NOT EXISTS `food_item` (
  `food_item_id` int NOT NULL AUTO_INCREMENT,
  `restaurant_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `type` varchar(50) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`food_item_id`),
  KEY `restaurant_id` (`restaurant_id`)
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `food_item`
--

INSERT INTO `food_item` (`food_item_id`, `restaurant_id`, `name`, `description`, `type`, `price`, `photo`) VALUES
(1, 1, 'Margherita Pizza', 'Classic tomato and mozzarella pizza', 'Pizza', '12.99', 'images/food_item/default.jpg'),
(2, 1, 'Spaghetti Bolognese', 'Spaghetti with rich meat sauce', 'Pasta', '15.99', 'images/food_item/default.jpg'),
(3, 1, 'Tiramisu', 'Italian coffee-flavored dessert', 'Dessert', '8.99', 'images/food_item/default.jpg'),
(4, 1, 'Caprese Salad', 'Fresh tomatoes, mozzarella, and basil', 'Salad', '10.99', 'images/food_item/default.jpg'),
(5, 2, 'Chicken Tikka Masala', 'Grilled chicken in a creamy tomato sauce', 'Curry', '14.99', 'images/food_item/default.jpg'),
(6, 2, 'Vegetable Biryani', 'Fragrant rice dish with mixed vegetables', 'Rice Dish', '12.99', 'images/food_item/default.jpg'),
(7, 2, 'Gulab Jamun', 'Sweet syrupy dessert balls', 'Dessert', '6.99', 'images/food_item/default.jpg'),
(8, 2, 'Saag Paneer', 'Spinach with Indian cottage cheese', 'Vegetarian', '11.99', 'images/food_item/default.jpg'),
(9, 3, 'Signature Dish', 'Description of the signature dish', 'Specialty', '17.99', 'images/food_item/default.jpg'),
(10, 3, 'Chef\'s Recommendation', 'Description of the chef-recommended dish', 'Chef\'s Recommendation', '19.99', 'images/food_item/default.jpg'),
(11, 4, 'Specialty Dish 1', 'Description of the specialty dish', 'Specialty', '16.99', 'images/food_item/default.jpg'),
(12, 4, 'Specialty Dish 2', 'Description of another specialty dish', 'Specialty', '18.99', 'images/food_item/default.jpg'),
(13, 4, 'Signature Dessert', 'Chef\'s signature dessert for a sweet ending', 'Dessert', '9.99', 'images/food_item/default.jpg'),
(14, 5, 'Grilled Sea Bass', 'Fresh sea bass grilled to perfection', 'Seafood', '22.99', 'images/food_item/default.jpg'),
(15, 5, 'Lobster Linguine', 'Linguine pasta with succulent lobster', 'Pasta', '24.99', 'images/food_item/default.jpg'),
(16, 5, 'Chocolate Decadence', 'Indulgent chocolate dessert for chocolate lovers', 'Dessert', '12.99', 'images/food_item/default.jpg'),
(17, 6, 'Sushi Platter', 'Assorted sushi for a delightful experience', 'Sushi', '20.99', 'images/food_item/default.jpg'),
(18, 6, 'Teriyaki Chicken Bowl', 'Grilled chicken with teriyaki sauce over rice', 'Bowl', '16.99', 'images/food_item/default.jpg'),
(19, 6, 'Green Tea Mochi', 'Japanese rice cake with green tea filling', 'Dessert', '8.99', 'images/food_item/default.jpg'),
(20, 7, 'Mediterranean Platter', 'A delightful platter with Mediterranean flavors', 'Platter', '18.99', 'images/food_item/default.jpg'),
(21, 7, 'Falafel Wrap', 'Wrap filled with crispy falafel and fresh veggies', 'Wrap', '14.99', 'images/food_item/default.jpg'),
(22, 7, 'Baklava', 'Traditional sweet pastry with layers of filo and nuts', 'Dessert', '10.99', 'images/food_item/default.jpg'),
(23, 8, 'Urban Burger', 'Juicy beef burger with urban flavors', 'Burger', '13.99', 'images/food_item/default.jpg'),
(24, 8, 'Truffle Fries', 'Crispy fries drizzled with truffle oil', 'Sides', '7.99', 'images/food_item/default.jpg'),
(25, 8, 'Red Velvet Shake', 'Decadent red velvet shake for a sweet treat', 'Beverage', '6.99', 'images/food_item/default.jpg'),
(76, 9, 'Gourmet Steak', 'Prime cut steak prepared with gourmet seasoning', 'Steak', '29.99', 'images/food_item/default.jpg'),
(77, 9, 'Truffle Mac \'n\' Cheese', 'Classic mac \'n\' cheese elevated with truffle flavor', 'Pasta', '16.99', 'images/food_item/default.jpg'),
(78, 9, 'Creme Brulee', 'Classic French dessert with a caramelized sugar crust', 'Dessert', '11.99', 'images/food_item/default.jpg'),
(79, 9, 'Citrus Glazed Salmon', 'Salmon fillet glazed with citrusy goodness', 'Seafood', '26.99', 'images/food_item/default.jpg'),
(80, 9, 'Mango Tango Salad', 'Refreshing salad with mango, avocado, and arugula', 'Salad', '14.99', 'images/food_item/default.jpg'),
(81, 10, 'Crispy Peking Duck', 'Crispy duck with hoisin sauce and pancakes', 'Duck', '32.99', 'images/food_item/default.jpg'),
(82, 10, 'Shrimp Fried Rice', 'Savory fried rice with succulent shrimp', 'Rice Dish', '18.99', 'images/food_item/default.jpg'),
(83, 10, 'Matcha Cheesecake', 'Rich cheesecake infused with matcha flavor', 'Dessert', '13.99', 'images/food_item/default.jpg'),
(84, 10, 'Kung Pao Chicken', 'Spicy and flavorful chicken stir-fry', 'Chicken', '20.99', 'images/food_item/default.jpg'),
(85, 10, 'Dim Sum Platter', 'Assortment of delightful dim sum varieties', 'Dim Sum', '24.99', 'images/food_item/default.jpg'),
(86, 11, 'Southwest BBQ Ribs', 'Tender ribs with smoky BBQ sauce', 'Ribs', '23.99', 'images/food_item/default.jpg'),
(87, 11, 'Pulled Pork Sandwich', 'Slow-cooked pulled pork in a flavorful sandwich', 'Sandwich', '15.99', 'images/food_item/default.jpg'),
(88, 11, 'Key Lime Pie', 'Refreshing key lime pie with a graham cracker crust', 'Dessert', '10.99', 'images/food_item/default.jpg'),
(89, 11, 'Chili Con Carne', 'Hearty chili with ground beef and beans', 'Chili', '17.99', 'images/food_item/default.jpg'),
(90, 11, 'Sweet Potato Fries', 'Crispy sweet potato fries served with dipping sauce', 'Sides', '8.99', 'images/food_item/default.jpg'),
(91, 12, 'Mushroom Risotto', 'Creamy risotto with a variety of mushrooms', 'Risotto', '19.99', 'images/food_item/default.jpg'),
(92, 12, 'Bacon-Wrapped Scallops', 'Scallops wrapped in smoky bacon strips', 'Seafood', '28.99', 'images/food_item/default.jpg'),
(93, 12, 'Lemon Sorbet', 'Refreshing lemon sorbet for a palate cleanser', 'Dessert', '9.99', 'images/food_item/default.jpg'),
(94, 12, 'Chicken Alfredo Pasta', 'Creamy Alfredo sauce with grilled chicken', 'Pasta', '22.99', 'images/food_item/default.jpg'),
(95, 12, 'Classic Caesar Salad', 'Crisp romaine lettuce with Caesar dressing and croutons', 'Salad', '14.99', 'images/food_item/default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `member_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`member_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `first_name`, `last_name`, `city`, `state`, `user_id`) VALUES
(1, 'John', 'Doe', 'New York City', 'NY', 1),
(2, 'Alice', 'Smith', 'Los Angeles', 'CA', 4),
(3, 'Bob', 'Johnson', 'Chicago', 'IL', 6),
(4, 'Emily', 'Davis', 'Houston', 'TX', 9),
(5, 'Charlie', 'Brown', 'Phoenix', 'AZ', 10),
(6, 'Grace', 'Wang', 'San Francisco', 'CA', 12),
(7, 'Daniel', 'Miller', 'Miami', 'FL', 16),
(8, 'Sophia', 'Lee', 'Seattle', 'WA', 18),
(9, 'Olivia', 'Jones', 'Atlanta', 'GA', 21),
(10, 'Liam', 'Wilson', 'Denver', 'CO', 22),
(11, 'Ella', 'Anderson', 'Boston', 'MA', 24),
(12, 'William', 'Taylor', 'Dallas', 'TX', 25),
(13, 'Ava', 'Johnson', 'Philadelphia', 'PA', 27),
(14, 'Noah', 'Smith', 'Portland', 'OR', 28),
(15, 'Mia', 'Lee', 'Minneapolis', 'MN', 30),
(16, 'James', 'Brown', 'Orlando', 'FL', 33),
(17, 'Emma', 'Wang', 'San Diego', 'CA', 34),
(18, 'Sophie', 'Miller', 'Detroit', 'MI', 35),
(19, 'Ethan', 'Wilson', 'Austin', 'TX', 36),
(20, 'Aiden', 'Anderson', 'Nashville', 'TN', 38),
(21, 'Lily', 'Taylor', 'Salt Lake City', 'UT', 39),
(22, 'Mason', 'Johnson', 'Raleigh', 'NC', 40),
(23, 'Grace', 'Davis', 'New Orleans', 'LA', 41),
(24, 'Lucas', 'Brown', 'Las Vegas', 'NV', 44),
(25, 'Zoe', 'Smith', 'Portland', 'ME', 45),
(26, 'Samantha', 'Williams', 'Houston', 'TX', 46),
(27, 'Ryan', 'Anderson', 'Chicago', 'IL', 47),
(28, 'Sophie', 'Martinez', 'Los Angeles', 'CA', 48),
(29, 'Oliver', 'Garcia', 'New York City', 'NY', 50);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

DROP TABLE IF EXISTS `restaurant`;
CREATE TABLE IF NOT EXISTS `restaurant` (
  `restaurant_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `description` text,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `owner_user_id` int DEFAULT NULL,
  `owner_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`restaurant_id`),
  KEY `owner_user_id` (`owner_user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`restaurant_id`, `name`, `type`, `description`, `address`, `phone`, `website`, `email`, `photo`, `owner_user_id`, `owner_name`) VALUES
(1, 'Tasty Delights', 'Italian', 'Authentic Italian cuisine with a modern twist', '123 Main St, Cityville', '(555) 123-1234', 'http://tastydelights.com', 'info@tastydelights.com', 'images/restaurant/tasty_delights.jpg', 2, 'Alice Johnson'),
(2, 'Spice Palace', 'Indian', 'Serving flavorful Indian dishes for spice lovers', '456 Spice Lane, Spicetown', '(555) 567-5678', 'http://spicepalace.com', 'info@spicepalace.com', 'images/restaurant/spice_palace.jpg', 5, 'Charlie Brown'),
(3, 'Epicurean Eats', 'International', 'A culinary journey around the world on your plate', '789 Global Blvd, Culinary City', '(555) 910-9101', 'http://epicureaneats.com', 'info@epicureaneats.com', 'images/restaurant/epicurean_eats.jpg', 8, 'Grace Wang'),
(4, 'Southern Comfort Kitchen', 'Southern', 'Comforting southern dishes in a cozy atmosphere', '101 Southern Street, Comfortville', '(555) 111-1112', 'http://southerncomfortkitchen.com', 'info@southerncomfortkitchen.com', 'images/restaurant/southern_comfort_kitchen.jpg', 11, 'Daniel Miller'),
(5, 'Ocean Breeze Seafood', 'Seafood', 'Fresh seafood dishes with a view of the ocean', '202 Ocean View, Seafood Bay', '(555) 131-1314', 'http://oceanbreezeseafood.com', 'info@oceanbreezeseafood.com', 'images/restaurant/ocean_breeze_seafood.jpg', 13, 'Sophia Lee'),
(6, 'Sunset Grill', 'American', 'Classic American favorites with a view of the sunset', '303 Sunset Avenue, Grill City', '(555) 151-1516', 'http://sunsetgrill.com', 'info@sunsetgrill.com', 'images/restaurant/sunset_grill.jpg', 15, 'Olivia Jones'),
(7, 'Zen Sushi Bar', 'Japanese', 'Serving fresh and delicious sushi in a zen atmosphere', '404 Zen Street, Sushi Town', '(555) 171-1718', 'http://zensushibar.com', 'info@zensushibar.com', 'images/restaurant/zen_sushi_bar.jpg', 17, 'Liam Wilson'),
(8, 'Mediterranean Delights', 'Mediterranean', 'Experience the flavors of the Mediterranean', '505 Olive Lane, Mediterra City', '(555) 192-1920', 'http://mediterraneandelights.com', 'info@mediterraneandelights.com', 'images/restaurant/mediterranean_delights.jpg', 20, 'Ella Anderson'),
(9, 'Urban Bistro', 'Contemporary', 'Modern and innovative dishes in an urban setting', '606 Urban Avenue, Bistroville', '(555) 212-2122', 'http://urbanbistro.com', 'info@urbanbistro.com', 'images/restaurant/urban_bistro.jpg', 26, 'Ava Johnson'),
(10, 'Green Garden Cafe', 'Vegetarian', 'Healthy and delicious vegetarian options in a green setting', '707 Garden Street, Green City', '(555) 232-2324', 'http://greengardencafe.com', 'info@greengardencafe.com', 'images/restaurant/green_garden_cafe.jpg', 29, 'William Taylor'),
(11, 'Flavors of Asia', 'Asian Fusion', 'A fusion of flavors from various Asian cuisines', '808 Asia Lane, Flavor City', '(555) 252-2526', 'http://flavorsofasia.com', 'info@flavorsofasia.com', 'images/restaurant/flavors_of_asia.jpg', 32, 'Ethan Wilson'),
(12, 'Sizzle Steakhouse', 'Steakhouse', 'Sizzling steaks cooked to perfection', '909 Sizzle Street, Steakville', '(555) 272-2728', 'http://sizzlesteakhouse.com', 'info@sizzlesteakhouse.com', 'images/restaurant/sizzle_steakhouse.jpg', 42, 'Lucas Brown');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `review_id` int NOT NULL AUTO_INCREMENT,
  `food_item_id` int NOT NULL,
  `member_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `rating` int NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`review_id`),
  KEY `food_item_id` (`food_item_id`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM AUTO_INCREMENT=722 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `food_item_id`, `member_id`, `title`, `description`, `rating`, `date`) VALUES
(1, 7, 1, 'Delicious Experience', 'The taste was amazing, and the presentation was top-notch. Highly recommended!', 5, '2023-11-12'),
(2, 7, 3, 'Mouthwatering Delight', 'Every bite was a mouthwatering delight. This dish is a must-try!', 4, '2023-11-13'),
(3, 7, 5, 'Perfectly Cooked', 'The dish was perfectly cooked, and the flavors were exceptional. Will definitely order again!', 5, '2023-11-14'),
(13, 25, 3, 'Taste Sensation', 'Every bite of this dish is a taste sensation. Absolutely loved it!', 5, '2023-11-12'),
(14, 25, 9, 'Deliciously Unique', 'A deliciously unique dish with flavors that stand out. Highly recommended!', 4, '2023-11-13'),
(15, 25, 12, 'Perfect Balance', 'The dish strikes the perfect balance of flavors. A culinary masterpiece!', 5, '2023-11-14'),
(23, 24, 6, 'Taste Sensation', 'The flavors in this dish create a taste sensation that lingers. Highly recommended!', 4, '2023-11-12'),
(24, 24, 11, 'Deliciously Unique', 'A deliciously unique dish that stood out. The combination of flavors was delightful!', 4, '2023-11-13'),
(25, 90, 9, 'Exquisite Culinary Journey', 'An exquisite culinary journey with each bite. This dish exceeded my expectations!', 5, '2023-11-12'),
(26, 90, 14, 'Satisfying and Rich', 'Satisfying and rich in flavor. This dish exceeded my expectations. Will order again!', 4, '2023-11-14'),
(27, 3, 1, 'Perfectly Spiced', 'The dish was perfectly spiced, and the flavors were well-balanced. A culinary delight!', 5, '2023-11-12'),
(28, 3, 5, 'Flavor Explosion', 'The combination of flavors in this dish is a true flavor explosion. Loved every bite!', 5, '2023-11-13'),
(39, 93, 3, 'Perfectly Seasoned', 'The dish was perfectly seasoned, and the presentation was impressive. 5 stars!', 5, '2023-11-14'),
(40, 93, 8, 'Savory Delight', 'A savory delight that satisfied my taste buds. Highly recommended!', 4, '2023-11-15'),
(46, 13, 5, 'Deliciously Unique', 'A deliciously unique dish that stood out. The combination of flavors was delightful!', 4, '2023-11-12'),
(47, 13, 9, 'Taste Sensation', 'The flavors in this dish create a taste sensation that lingers. Highly recommended!', 4, '2023-11-13'),
(48, 13, 12, 'Taste Explosion', 'The combination of flavors in this dish is a true taste explosion. Absolutely loved it!', 5, '2023-11-14'),
(49, 13, 3, 'Exquisite Culinary Journey', 'An exquisite culinary journey with each bite. This dish exceeded my expectations!', 5, '2023-11-15'),
(50, 13, 7, 'Satisfying and Rich', 'Satisfying and rich in flavor. This dish exceeded my expectations. Will order again!', 4, '2023-11-16'),
(51, 88, 1, 'Perfectly Spiced', 'The dish was perfectly spiced, and the flavors were well-balanced. A culinary delight!', 5, '2023-11-12'),
(52, 88, 4, 'A Culinary Masterpiece', 'I\'ve never had anything like this before. It\'s truly a culinary masterpiece!', 5, '2023-11-13'),
(53, 88, 8, 'Sensational Flavor Explosion', 'The flavor explosion in this dish is sensational. A true work of culinary art!', 5, '2023-11-14'),
(54, 88, 11, 'Flavorful Delight', 'A flavorful delight that left me wanting more. Highly recommended for food enthusiasts!', 4, '2023-11-15'),
(55, 88, 15, 'Taste Explosion', 'The combination of flavors in this dish is a true taste explosion. Absolutely loved it!', 5, '2023-11-16'),
(56, 22, 3, 'Satisfying and Flavorful', 'The dish was satisfying, and the flavors were well-balanced. Would order again!', 4, '2023-11-12'),
(57, 22, 6, 'Deliciously Savory', 'Deliciously savory and satisfying. This dish is a true comfort food!', 4, '2023-11-13'),
(58, 22, 10, 'Taste Sensation', 'Every bite of this dish is a taste sensation. Absolutely loved it!', 5, '2023-11-14'),
(59, 22, 13, 'Mouthwatering Experience', 'The dish provided a mouthwatering experience that I\'ll remember. Great flavors!', 5, '2023-11-15'),
(60, 22, 2, 'Deliciously Unique', 'A deliciously unique dish with flavors that stand out. Highly recommended!', 4, '2023-11-16'),
(76, 4, 1, 'Deliciously Unique', 'A deliciously unique dish with flavors that stand out. Highly recommended!', 4, '2023-11-12'),
(77, 4, 4, 'Taste Sensation', 'Every bite of this dish is a taste sensation. Absolutely loved it!', 5, '2023-11-13'),
(78, 4, 7, 'Mouthwatering Sensation', 'Every bite of this dish is a mouthwatering sensation. Truly delightful!', 5, '2023-11-14'),
(79, 4, 10, 'Satisfying and Rich', 'Satisfying and rich in flavor. This dish exceeded my expectations. Will order again!', 4, '2023-11-15'),
(80, 4, 13, 'Perfectly Seasoned', 'The dish was perfectly seasoned, and the presentation was impressive. 5 stars!', 5, '2023-11-16'),
(91, 8, 1, 'Taste Explosion', 'The combination of flavors in this dish is a true taste explosion. Absolutely loved it!', 5, '2023-11-14'),
(92, 8, 4, 'Exquisite Culinary Journey', 'An exquisite culinary journey with each bite. This dish exceeded my expectations!', 5, '2023-11-15'),
(93, 8, 7, 'Satisfying and Rich', 'Satisfying and rich in flavor. This dish exceeded my expectations. Will order again!', 4, '2023-11-16'),
(94, 8, 10, 'Flavorful Delight', 'A flavorful delight that left me wanting more. Highly recommended for food enthusiasts!', 4, '2023-11-17'),
(95, 8, 13, 'Taste Explosion', 'The combination of flavors in this dish is a true taste explosion. Absolutely loved it!', 5, '2023-11-18'),
(96, 78, 3, 'Deliciously Unique', 'A deliciously unique dish with flavors that stand out. Highly recommended!', 4, '2023-11-13'),
(97, 78, 6, 'Taste Sensation', 'Every bite of this dish is a taste sensation. Absolutely loved it!', 5, '2023-11-14'),
(98, 78, 9, 'Mouthwatering Sensation', 'Every bite of this dish is a mouthwatering sensation. Truly delightful!', 5, '2023-11-15'),
(105, 16, 2, 'Deliciously Unique', 'A deliciously unique dish that stood out. The combination of flavors was delightful!', 4, '2023-11-12'),
(106, 16, 7, 'Underwhelming Experience', 'The dish was underwhelming, and the flavors did not leave a lasting impression.', 3, '2023-11-13'),
(107, 16, 11, 'Taste Sensation', 'The flavors in this dish create a taste sensation that lingers. Highly recommended!', 5, '2023-11-14'),
(111, 6, 1, 'Deliciously Unique', 'A deliciously unique dish that stood out. The combination of flavors was delightful!', 4, '2023-11-12'),
(112, 6, 5, 'Disappointing Experience', 'Unfortunately, this dish did not meet my expectations. The flavors were not well-balanced.', 2, '2023-11-13'),
(113, 6, 9, 'Flavor Explosion', 'The combination of flavors in this dish is a true flavor explosion. Loved every bite!', 5, '2023-11-14'),
(117, 1, 3, 'Deliciously Unique', 'A deliciously unique dish that stood out. The combination of flavors was delightful!', 4, '2023-11-12'),
(118, 1, 8, 'Unpleasant Surprise', 'This dish was an unpleasant surprise. The flavors did not complement each other well.', 2, '2023-11-13'),
(119, 1, 12, 'Taste Sensation', 'The flavors in this dish create a taste sensation that lingers. Highly recommended!', 5, '2023-11-14'),
(131, 83, 1, 'Flavorful Delight', 'A flavorful delight that left me wanting more. Highly recommended for food enthusiasts!', 4, '2023-11-12'),
(132, 83, 5, 'Unpleasant Surprise', 'This dish was an unpleasant surprise. The flavors did not complement each other well.', 2, '2023-11-13'),
(135, 23, 6, 'Deliciously Unique', 'A deliciously unique dish that stood out. The combination of flavors was delightful!', 4, '2023-11-12'),
(136, 23, 11, 'Disappointing Experience', 'Unfortunately, this dish did not meet my expectations. The flavors were not well-balanced.', 2, '2023-11-13'),
(137, 21, 2, 'Flavor Explosion', 'The combination of flavors in this dish is a true flavor explosion. Loved every bite!', 5, '2023-11-12'),
(138, 21, 7, 'Underwhelming Experience', 'The dish was underwhelming, and the flavors did not leave a lasting impression.', 3, '2023-11-13'),
(143, 95, 3, 'Delightful Surprise', 'This dish was a delightful surprise. The combination of flavors was outstanding!', 4, '2023-11-12'),
(144, 95, 8, 'Mixed Feelings', 'I have mixed feelings about this dish. Some flavors were good, while others were not.', 3, '2023-11-13'),
(149, 80, 1, 'Flavorful Delight', 'A flavorful delight that left me wanting more. Highly recommended for food enthusiasts!', 4, '2023-11-12'),
(150, 80, 5, 'Unpleasant Surprise', 'This dish was an unpleasant surprise. The flavors did not complement each other well.', 2, '2023-11-13'),
(151, 80, 9, 'Perfectly Spiced', 'The dish was perfectly spiced, and the flavors were well-balanced. A culinary delight!', 5, '2023-11-14'),
(152, 80, 14, 'Mixed Feelings', 'I have mixed feelings about this dish. Some flavors were good, while others were not.', 3, '2023-11-15'),
(181, 19, 4, 'A Culinary Masterpiece', 'I\'ve never had anything like this before. It\'s truly a culinary masterpiece!', 5, '2023-11-12'),
(182, 19, 8, 'Sensational Flavor Explosion', 'The flavor explosion in this dish is sensational. A true work of culinary art!', 5, '2023-11-13'),
(307, 5, 3, 'Delightful Surprise', 'This dish was a delightful surprise. The combination of flavors was outstanding!', 4, '2023-11-12'),
(308, 5, 8, 'Flavor Explosion', 'The combination of flavors in this dish is a true flavor explosion. Loved every bite!', 5, '2023-11-13'),
(309, 5, 12, 'Mixed Feelings', 'I have mixed feelings about this dish. Some flavors were good, while others were not.', 3, '2023-11-14'),
(310, 5, 6, 'Satisfying and Rich', 'Satisfying and rich in flavor. This dish exceeded my expectations. Will order again!', 4, '2023-11-15'),
(315, 2, 1, 'Flavor Explosion', 'The combination of flavors in this dish is a true flavor explosion. Loved every bite!', 5, '2023-11-12'),
(316, 2, 5, 'Unpleasant Surprise', 'This dish was an unpleasant surprise. The flavors did not complement each other well.', 2, '2023-11-13'),
(317, 2, 9, 'Perfectly Spiced', 'The dish was perfectly spiced, and the flavors were well-balanced. A culinary delight!', 5, '2023-11-14'),
(318, 2, 14, 'Mixed Feelings', 'I have mixed feelings about this dish. Some flavors were good, while others were not.', 3, '2023-11-15'),
(319, 87, 3, 'Delightful Surprise', 'This dish was a delightful surprise. The combination of flavors was outstanding!', 4, '2023-11-12'),
(320, 87, 8, 'Flavor Explosion', 'The combination of flavors in this dish is a true flavor explosion. Loved every bite!', 5, '2023-11-13'),
(321, 87, 12, 'Mixed Feelings', 'I have mixed feelings about this dish. Some flavors were good, while others were not.', 3, '2023-11-14'),
(322, 87, 6, 'Satisfying and Rich', 'Satisfying and rich in flavor. This dish exceeded my expectations. Will order again!', 4, '2023-11-15'),
(335, 11, 3, 'Delightful Surprise', 'This dish was a delightful surprise. The combination of flavors was outstanding!', 4, '2023-11-12'),
(336, 11, 8, 'Flavor Explosion', 'The combination of flavors in this dish is a true flavor explosion. Loved every bite!', 5, '2023-11-13'),
(337, 11, 12, 'Mixed Feelings', 'I have mixed feelings about this dish. Some flavors were good, while others were not.', 3, '2023-11-14'),
(338, 11, 6, 'Satisfying and Rich', 'Satisfying and rich in flavor. This dish exceeded my expectations. Will order again!', 4, '2023-11-15'),
(339, 77, 2, 'Delightful Surprise', 'This dish was a delightful surprise. The combination of flavors was outstanding!', 4, '2023-11-12'),
(340, 77, 7, 'Flavor Explosion', 'The combination of flavors in this dish is a true flavor explosion. Loved every bite!', 5, '2023-11-13'),
(341, 77, 11, 'Mixed Feelings', 'I have mixed feelings about this dish. Some flavors were good, while others were not.', 3, '2023-11-14'),
(342, 77, 13, 'Satisfying and Rich', 'Satisfying and rich in flavor. This dish exceeded my expectations. Will order again!', 4, '2023-11-15'),
(343, 94, 1, 'Delightful Surprise', 'This dish was a delightful surprise. The combination of flavors was outstanding!', 4, '2023-11-12'),
(344, 94, 5, 'Flavor Explosion', 'The combination of flavors in this dish is a true flavor explosion. Loved every bite!', 5, '2023-11-13'),
(345, 94, 9, 'Mixed Feelings', 'I have mixed feelings about this dish. Some flavors were good, while others were not.', 3, '2023-11-14'),
(346, 94, 14, 'Satisfying and Rich', 'Satisfying and rich in flavor. This dish exceeded my expectations. Will order again!', 4, '2023-11-15'),
(347, 86, 3, 'Delightful Surprise', 'This dish was a delightful surprise. The combination of flavors was outstanding!', 4, '2023-11-12'),
(348, 86, 8, 'Flavor Explosion', 'The combination of flavors in this dish is a true flavor explosion. Loved every bite!', 5, '2023-11-13'),
(349, 86, 12, 'Mixed Feelings', 'I have mixed feelings about this dish. Some flavors were good, while others were not.', 3, '2023-11-14'),
(350, 86, 6, 'Satisfying and Rich', 'Satisfying and rich in flavor. This dish exceeded my expectations. Will order again!', 4, '2023-11-15'),
(355, 15, 3, 'Delightful Surprise', 'This dish was a delightful surprise. The combination of flavors was outstanding!', 4, '2023-11-12'),
(356, 15, 8, 'Flavor Explosion', 'The combination of flavors in this dish is a true flavor explosion. Loved every bite!', 5, '2023-11-13'),
(357, 15, 12, 'Mixed Feelings', 'I have mixed feelings about this dish. Some flavors were good, while others were not.', 3, '2023-11-14'),
(358, 15, 6, 'Satisfying and Rich', 'Satisfying and rich in flavor. This dish exceeded my expectations. Will order again!', 4, '2023-11-15'),
(363, 85, 3, 'Delightful Surprise', 'This dish was a delightful surprise. The combination of flavors was outstanding!', 4, '2023-11-12'),
(364, 85, 8, 'Flavor Explosion', 'The combination of flavors in this dish is a true flavor explosion. Loved every bite!', 5, '2023-11-13'),
(365, 85, 12, 'Mixed Feelings', 'I have mixed feelings about this dish. Some flavors were good, while others were not.', 3, '2023-11-14'),
(366, 85, 6, 'Satisfying and Rich', 'Satisfying and rich in flavor. This dish exceeded my expectations. Will order again!', 4, '2023-11-15'),
(367, 79, 2, 'Delightful Surprise', 'This dish was a delightful surprise. The combination of flavors was outstanding!', 4, '2023-11-12'),
(368, 79, 7, 'Flavor Explosion', 'The combination of flavors in this dish is a true flavor explosion. Loved every bite!', 5, '2023-11-13'),
(369, 79, 11, 'Mixed Feelings', 'I have mixed feelings about this dish. Some flavors were good, while others were not.', 3, '2023-11-14'),
(370, 79, 13, 'Satisfying and Rich', 'Satisfying and rich in flavor. This dish exceeded my expectations. Will order again!', 4, '2023-11-15'),
(718, 0, 4, 'Wow!', 'This burger was an absolute delight!', 5, '2023-11-15'),
(591, 92, 1, 'Delightful Surprise', 'This dish was a delightful surprise. The combination of flavors was outstanding!', 4, '2023-11-12'),
(592, 92, 5, 'Flavor Explosion', 'The combination of flavors in this dish is a true flavor explosion. Loved every bite!', 5, '2023-11-13'),
(593, 92, 9, 'Mixed Feelings', 'I have mixed feelings about this dish. Some flavors were good, while others were not.', 3, '2023-11-14'),
(594, 18, 2, 'Disappointing Experience', 'The dish was a major letdown. The flavors did not work well together, and the overall experience was disappointing.', 2, '2023-11-12'),
(595, 18, 7, 'Not Worth Trying', 'This dish is not worth trying. The taste was bland, and it lacked any exciting flavors.', 1, '2023-11-13'),
(604, 9, 7, 'Unpleasant Surprise', 'The dish was an unpleasant surprise. The flavors did not complement each other well, and it left a bad aftertaste.', 2, '2023-11-12'),
(605, 9, 12, 'Awful Experience', 'This dish provided an awful dining experience. The taste was off, and I would not recommend it to anyone.', 1, '2023-11-13'),
(606, 89, 1, 'Terrible Dish', 'The dish was terrible. The flavors were poorly executed, and I regret ordering it.', 1, '2023-11-12'),
(607, 89, 5, 'Worst Choice', 'Choosing this dish was the worst decision. The taste was unappealing, and I would not order it again.', 1, '2023-11-13'),
(614, 82, 5, 'Terrible Dish', 'The dish was terrible. The flavors were poorly executed, and I regret ordering it.', 1, '2023-11-12'),
(615, 82, 10, 'Worst Choice', 'Choosing this dish was the worst decision. The taste was unappealing, and I would not order it again.', 1, '2023-11-13'),
(616, 12, 6, 'Not Recommended', 'I do not recommend this dish. The flavors were off, and it did not meet my expectations.', 2, '2023-11-12'),
(617, 12, 11, 'Regretful Choice', 'I regret choosing this dish. The taste was subpar, and I would not order it again.', 1, '2023-11-13'),
(691, 20, 7, 'Disappointing Experience', 'The dish was a major letdown. The flavors did not work well together, and the overall experience was disappointing.', 2, '2023-11-12'),
(694, 10, 2, 'A Culinary Masterpiece', 'This dish is a culinary masterpiece! The combination of flavors is simply outstanding.', 5, '2023-11-12'),
(695, 10, 6, 'Mouthwatering Goodness', 'The mouthwatering goodness of this dish made it a delightful experience. Highly recommended!', 4, '2023-11-13'),
(700, 91, 5, 'A Culinary Masterpiece', 'This dish is a culinary masterpiece! The combination of flavors is simply outstanding.', 5, '2023-11-12'),
(701, 91, 9, 'Mouthwatering Goodness', 'The mouthwatering goodness of this dish made it a delightful experience. Highly recommended!', 4, '2023-11-13'),
(706, 17, 8, 'A Culinary Masterpiece', 'This dish is a culinary masterpiece! The combination of flavors is simply outstanding.', 5, '2023-11-12'),
(707, 17, 12, 'Mouthwatering Goodness', 'The mouthwatering goodness of this dish made it a delightful experience. Highly recommended!', 4, '2023-11-13'),
(708, 84, 9, 'Gastronomic Delight', 'A gastronomic delight! The flavors of this dish were exquisite, and I enjoyed every bite.', 5, '2023-11-12'),
(709, 84, 13, 'Flavor Explosion', 'The flavor explosion in this dish was incredible. It\'s a must-try for any food enthusiast!', 4, '2023-11-13'),
(714, 14, 12, 'Gastronomic Delight', 'A gastronomic delight! The flavors of this dish were exquisite, and I enjoyed every bite.', 5, '2023-11-12'),
(715, 14, 1, 'Flavor Explosion', 'The flavor explosion in this dish was incredible. It\'s a must-try for any food enthusiast!', 4, '2023-11-13');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `role`) VALUES
(1, 'artisticEater', 'Picasso123', 'member'),
(2, 'foodieExplorer', 'TasteBud456', 'restaurant'),
(3, 'spicyEnthusiast', 'HeatSeeker789', 'admin'),
(4, 'sugarRushDreamer', 'SweetTooth987', 'member'),
(5, 'culinaryNomad', 'GlobeTrotter123', 'restaurant'),
(6, 'flavorAlchemy', 'TasteWizard456', 'member'),
(7, 'gourmetVoyager', 'EpicureanExplorer789', 'admin'),
(8, 'savorSculptor', 'FlavorArtisan987', 'restaurant'),
(9, 'gastronomicTrailblazer', 'CulinaryTrail123', 'member'),
(10, 'palatePioneer', 'TasteAdventurer456', 'member'),
(11, 'epicureanJourneyman', 'CulinaryDiscoverer789', 'restaurant'),
(12, 'tasteMaestro', 'FlavorConductor987', 'member'),
(13, 'umamiAlchemist', 'SavorSorcerer123', 'restaurant'),
(14, 'savvyGastronome', 'FoodieCognoscente456', 'admin'),
(15, 'flavorVirtuoso', 'GastronomyMaestro789', 'restaurant'),
(16, 'culinaryExplorer', 'FoodDiscovery123', 'member'),
(17, 'tasteHarmony', 'FlavorSymphony456', 'restaurant'),
(18, 'artisanalPalate', 'EpicureanArtisan789', 'member'),
(19, 'deliciousOdyssey', 'CulinaryJourneyman987', 'admin'),
(20, 'gourmetGlobetrotter', 'FoodieJetsetter123', 'restaurant'),
(21, 'tastyExplorer', 'FlavorAdventurer123', 'member'),
(22, 'culinaryArtist', 'TasteCreator456', 'member'),
(23, 'sensoryGastronome', 'FlavorEnthusiast789', 'admin'),
(24, 'foodFusionist', 'TasteFusion123', 'member'),
(25, 'deliciousJourneyman', 'CulinaryVoyager456', 'member'),
(26, 'flavorCraftsman', 'TasteCraftsman123', 'restaurant'),
(27, 'culinaryInnovator', 'FoodInnovator456', 'member'),
(28, 'gourmetExplorer', 'EpicureanAdventurer789', 'member'),
(29, 'savoryTrailblazer', 'FlavorTrailblazer123', 'restaurant'),
(30, 'creativeCulinarist', 'TasteInnovator456', 'member'),
(31, 'gastronomyEnigma', 'FlavorMystic789', 'admin'),
(32, 'trendyFoodie', 'FoodieTrendsetter123', 'restaurant'),
(33, 'culinaryVirtuoso', 'TasteVirtuoso456', 'member'),
(34, 'gourmetArtisan', 'EpicureanCraftsman789', 'member'),
(35, 'flavorfulExplorer', 'TasteAdventurer123', 'member'),
(36, 'culinaryGuru', 'FoodGuru456', 'member'),
(37, 'globalTasteExplorer', 'FlavorAdventurer789', 'admin'),
(38, 'tasteVisionary', 'FoodVisionary123', 'member'),
(39, 'savorSorcerer', 'FlavorMagician456', 'member'),
(40, 'epicureanVoyager', 'CulinaryVoyager789', 'member'),
(41, 'sensationalFoodie', 'TasteSensation123', 'member'),
(42, 'flavorFusionist', 'CulinaryFusionist456', 'restaurant'),
(43, 'creativeGastronaut', 'TasteGastronaut789', 'admin'),
(44, 'culinaryTrailblazer', 'FoodieExplorer123', 'member'),
(45, 'gourmetNomad', 'EpicureanNomad456', 'member'),
(46, 'delightfulDiner', 'TasteDelighter789', 'member'),
(47, 'culinaryConnoisseur', 'FoodConnoisseur123', 'member'),
(48, 'savorySculptor', 'FlavorArtisan456', 'member'),
(49, 'foodieMaestro', 'TasteMaestro789', 'admin'),
(50, 'culinaryVirtuoso2', 'EpicureanVirtuoso123', 'member');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
