-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 28, 2022 at 04:05 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravelvueorders`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `creation_datetime` datetime NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_image`, `status`, `creation_datetime`) VALUES
(1, 'Beverages', 'uploads/categories/202207/20220726-053220-48629.jpg', 1, '2022-07-26 05:32:20'),
(2, 'Vegetables', 'uploads/categories/202207/20220726-053234-229644.jpg', 1, '2022-07-26 05:32:35'),
(3, 'Fruits and non-starchy', 'uploads/categories/202207/20220726-053243-858398.jpg', 1, '2022-07-26 05:32:43'),
(4, 'Dairy and non-dairy', 'uploads/categories/202207/20220726-053252-879459.jpg', 1, '2022-07-26 05:32:52'),
(5, 'Heart-healthy oils', 'uploads/categories/202207/20220726-053300-748438.jpg', 1, '2022-07-26 05:33:00'),
(6, 'Whole grains', 'uploads/categories/202207/20220726-053309-211708.jpg', 1, '2022-07-26 05:33:09'),
(7, 'Fruit Syrup', 'uploads/categories/202207/20220726-060034-500827.jpg', 1, '2022-07-26 06:00:34'),
(8, 'Dry Fruits', 'uploads/categories/202207/20220726-060053-998429.jpg', 1, '2022-07-26 06:00:53'),
(9, 'Jam', 'uploads/categories/202207/20220726-060124-422529.jpg', 1, '2022-07-26 06:01:24'),
(10, 'Spices', 'uploads/categories/202207/20220726-060233-698550.jpg', 1, '2022-07-26 06:02:33');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(12, '2014_10_12_000000_create_users_table', 1),
(13, '2014_10_12_100000_create_password_resets_table', 1),
(14, '2019_08_19_000000_create_failed_jobs_table', 1),
(15, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(16, '2021_10_07_063424_create_admins_table', 1),
(17, '2022_07_15_083319_create_category_table', 1),
(18, '2022_07_15_085001_create_subcategory_table', 1),
(19, '2022_07_15_085941_create_product_table', 1),
(20, '2022_07_15_090821_create_order_table', 1),
(21, '2022_07_15_090841_create_order_item_table', 1),
(22, '2022_07_16_051250_create_setting_table', 1),
(23, '2022_07_15_084708_update_old_file_name_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `order_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_phone_number` bigint(20) NOT NULL,
  `shipping_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_zip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shippping_country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_total` bigint(20) NOT NULL,
  `payment_method_type` int(11) NOT NULL,
  `order_note` text COLLATE utf8_unicode_ci NOT NULL,
  `creation_datetime` datetime NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `customer_name`, `customer_email`, `customer_phone_number`, `shipping_city`, `shipping_address`, `shipping_state`, `shipping_zip`, `shippping_country`, `order_total`, `payment_method_type`, `order_note`, `creation_datetime`) VALUES
(1, 'bhumikg bhumikg', 'bhumi@gmail.com', 1234567890, 'bhumikg', 'bhumikg', 'Arunachal Pradesh', '1234567892', 'India', 20, 3, 'dfdgdfg', '2022-07-26 08:22:53'),
(2, 'mansi patel', 'bhumi@gmail.com', 1234567890, 'bhumikg', 'bhumikg', 'Arunachal Pradesh', '1234567892', 'India', 130, 3, 'test', '2022-07-26 09:48:52'),
(3, 'bhumi', 'bhumi@gmail.com', 123456895, 'surat', 'surat', 'gujrat', '123456', 'India', 130, 3, 'dfdf', '2022-07-26 09:53:42'),
(4, 'bhumikg bhumikg', 'bhumi@gmail.com', 1234567890, 'bhumikg', 'bhumikg', 'Arunachal Pradesh', '1234567892', 'India', 130, 3, 'sdsd', '2022-07-26 09:54:33'),
(5, 'bhumikgs bhumikgs', 'bhumi@gmail.com', 1234567890, 'bhumikgs', 'bhumikgs', 'Assam', '1234567892', 'India', 60, 3, 'dfddsfd', '2022-07-26 09:56:19'),
(6, 'bhumi', 'bhumi@gmail.com', 123456895, 'surat', 'surat', 'gujrat', '123456', 'India', 40, 1, 'dgdgdg', '2022-07-26 10:01:48'),
(7, 'bhumikg bhumikg', 'bhumi@gmail.com', 1234567890, 'bhumikg', 'bhumikg', 'Arunachal Pradesh', '1234567892', 'India', 94, 1, 'sdfsdfsf', '2022-07-28 03:53:52');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

DROP TABLE IF EXISTS `order_item`;
CREATE TABLE IF NOT EXISTS `order_item` (
  `order_item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_quantity` bigint(20) NOT NULL,
  PRIMARY KEY (`order_item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `order_id`, `product_id`, `product_quantity`) VALUES
(1, 1, 3, 1),
(2, 2, 1, 2),
(3, 3, 1, 2),
(4, 4, 1, 2),
(5, 5, 1, 1),
(6, 5, 2, 1),
(7, 5, 3, 1),
(8, 6, 1, 1),
(9, 6, 3, 1),
(10, 7, 1, 1),
(11, 7, 2, 1),
(12, 7, 3, 1),
(13, 7, 12, 2),
(14, 7, 18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'admin@gmail.com', '096d5ea330317ff94dfb2f4f36629c213078f9e3a72b48954b53cf3fdb86e4be', '[\"*\"]', NULL, '2022-07-26 00:42:04', '2022-07-26 00:42:04'),
(2, 'App\\Models\\User', 1, 'admin@gmail.com', 'd3cf0c48dc27d120cbd799c3de5f7ecefb4a665b3015fde6f06dc13f313f4c22', '[\"*\"]', NULL, '2022-07-26 03:04:43', '2022-07-26 03:04:43');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_sku` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `product_image` text COLLATE utf8_unicode_ci,
  `amount` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `creation_datetime` datetime NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `subcategory_id`, `product_name`, `product_sku`, `description`, `product_image`, `amount`, `status`, `creation_datetime`) VALUES
(1, 1, 1, 'Coca Cola', 'CocaCola', 'The drink Coca-Cola was originated in 1886 by an Atlanta pharmacist, John S. Pemberton (1831–88), at his Pemberton Chemical Company. His bookkeeper, Frank Robinson, chose the name for the drink and penned it in the flowing script that became the Coca-Cola trademark', 'uploads/products/202207/20220726-053914-290164.jpg', 20, 1, '2022-07-26 05:39:14'),
(2, 1, 1, 'Maaza', 'Maaza', 'Maaza is India\'s no. 1 mango drink made up of real mango pulp with no added preservatives. with every sip of maaza it energises and refreshes you with amazing real mango taste.', 'uploads/products/202207/20220726-053941-988756.jpg', 20, 1, '2022-07-26 05:39:41'),
(3, 1, 1, 'Thumps Up', 'ThumpsUp', 'The Thums Up can is a beautiful vestibule, a svelte cylinder made of tin; inside is a smoky and dark cola, something like a spicier Pepsi. Its carbonation is an accent rather than a disruptor.', 'uploads/products/202207/20220726-054007-354583.jpg', 20, 1, '2022-07-26 05:40:07'),
(4, 1, 2, 'Pineapple Juice', 'PineappleJuice', 'Pineapple juice has a naturally sweet but tart flavor. It is most healthful to choose pineapple juice that does not contain added sugar.', 'uploads/products/202207/20220726-054045-439421.jpg', 25, 1, '2022-07-26 05:40:45'),
(5, 1, 2, 'Orange Juice', 'OrangeJuice', 'Orange juice is a liquid extract of the orange tree fruit, produced by squeezing or reaming oranges. It comes in several different varieties, including blood orange, navel oranges, valencia orange, clementine, and tangerine', 'uploads/products/202207/20220726-054113-862207.jpg', 25, 1, '2022-07-26 05:41:13'),
(6, 1, 2, 'Mango Juice', 'MangoJuice', 'About Mango Juice. This homemade mango juice is slightly sweet, slightly tangy, and so perfect for helping you quench the thirst on hot summer days.The ripe flesh of the mango is soft and juicy, pale orange in colour, and has a texture ranging from fibrous to almost the consistency of butter. The flesh tastes fresh and sweet and emits a sweet fragrance.', 'uploads/products/202207/20220726-054141-924517.jpg', 25, 1, '2022-07-26 05:41:41'),
(7, 2, 3, 'Spinch', 'Spinch', 'Spinach is a herbaceous plant whose leaves, green and arranged in rosette, are eaten raw or cooked. The leaves have an oval shape and are wrinkled; they can be whole or sawed. It is a very nutritious, tasteful and easy-to-digest plant. The Arabs regarded it as the queen of vegetables', 'uploads/products/202207/20220726-054235-305945.jpg', 5, 1, '2022-07-26 05:42:35'),
(8, 2, 4, 'Brussels sprouts', 'Brusselssprouts', 'Brussels sprouts are sweet, nutty, and smokey. They\'re similar in taste to cabbage, albeit milder. They\'re crunchy on the outside and soft and creamy on the inside. Enjoy your Brussels sprouts!', 'uploads/products/202207/20220726-054323-720109.jpg', 50, 1, '2022-07-26 05:43:23'),
(9, 2, 4, 'Broccoli', 'Broccoli', 'Broccoli, Brassica oleracea, is an herbaceous annual or biennial grown for its edible flower heads which are used as a vegetable. The broccoli plant has a thick green stalk, or stem, which gives rise to thick, leathery, oblong leaves which are gray-blue to green in color.', 'uploads/products/202207/20220726-054355-153453.jpg', 100, 1, '2022-07-26 05:43:55'),
(10, 2, 5, 'Beet Root', 'BeetRoot', 'Beetroot is the large and fleshy root growing in the plant of the same name, eaten as a vegetable. Its superficial, thin and smooth skin has a wide range of colours, from purple-pink and reddish-orange to a brownish tone. The pulp has a sweet taste and it is usually of a dark crimson red colour with purple tinges', 'uploads/products/202207/20220726-054515-699499.jpg', 5, 1, '2022-07-26 05:45:15'),
(11, 2, 6, 'Garlic', 'Garlic', 'Garlic is the small, white, round bulb of a plant that is related to the onion plant. Garlic has a very strong smell and taste and is used in cooking. COLLOCATIONS: clove of ~ We use garlic to add a very strong flavor to the food. If you don\'t want a strong taste of garlic, add one clove instead of two.', 'uploads/products/202207/20220726-054545-147152.jpg', 24, 1, '2022-07-26 05:45:45'),
(12, 2, 6, 'Ginger', 'Ginger', 'The ginger plant has a thick, branched rhizome (underground stem) with a brown outer layer and yellow centre that has a spicy, citrusy aroma. Every year, it grows pseudostems (false stems made of tightly wrapped leaf bases) from the rhizome which bear narrow leaves.', 'uploads/products/202207/20220726-054653-118035.jpg', 2, 1, '2022-07-26 05:46:53'),
(13, 3, 7, 'Raspberries', 'Raspberries', 'A small, deep colored berry which has a tender texture, a sweet delicate taste and a pleasant aroma. Peak season for raspberries is during the middle of summer, but they are available year-round in some markets as both fresh and frozen.', 'uploads/products/202207/20220726-054729-939147.jpg', 150, 1, '2022-07-26 05:47:29'),
(14, 3, 7, 'Blue Berries', 'BlueBerries', 'The blueberry is a fruit that grows wild in fresh areas of the N hemisphere. It is a bluish-black, rounded berry measuring 6mm of diameter. It is mainly consumed in jams, cakes or as garnish for various dishes. It is rich in vitamins and it supplies very few calories.', 'uploads/products/202207/20220726-054755-190920.jpg', 130, 1, '2022-07-26 05:47:55'),
(15, 3, 7, 'Strawberry', 'Strawberry', 'Fresh strawberries contain a combination of fruity, caramel, spice and green notes. A green note is a characteristic note used to describe that leafy sometimes woody or smoky sensation you taste with fruits and vegetables', 'uploads/products/202207/20220726-054817-488804.jpg', 50, 1, '2022-07-26 05:48:17'),
(16, 3, 8, 'Peach', 'Peach', 'A peach is a very sweet, juicy fruit with an edible peel and a hard pit in the middle. Peaches vary in color from almost white to yellow and pinkish-red. Peaches grow on trees in temperate climates — they need warm weather, but they also require a hard freeze in the winter to produce fruit.', 'uploads/products/202207/20220726-054856-458928.jpg', 20, 1, '2022-07-26 05:48:56'),
(17, 3, 8, 'Cherries', 'Cherries', 'The fruit is a fleshy drupe (stone fruit) that is generally heart-shaped to nearly globular, about 2 cm (1 inch) in diameter, and varies in colour from yellow through red to nearly black. The acid content of the sweet cherry is low. The higher acid content of the sour cherry produces its characteristic tart flavour.', 'uploads/products/202207/20220726-054918-243476.jpg', 150, 1, '2022-07-26 05:49:18'),
(18, 3, 9, 'Orange', 'Orange', 'The definition of an orange is a round, sweet, juicy citrus fruit, yellow-reddish in color. An example of an orange is a satsuma. Orange is a color made by mixing red and yellow. An example of orange is the color of the California poppy', 'uploads/products/202207/20220726-054952-328545.jpg', 30, 1, '2022-07-26 05:49:52'),
(19, 3, 10, 'Dragon Fruit', 'DragonFruit', 'Central Americans call it \"pitaya.\" In Asia, it\'s a \"strawberry pear.\" Today, you can buy dragon fruit throughout the U.S. Dragon fruit is juicy with a slightly sweet taste that some describe as a cross between a kiwi, a pear, and a watermelon. The seeds have a nutty flavor.', 'uploads/products/202207/20220726-055031-838601.jpg', 80, 1, '2022-07-26 05:50:31'),
(20, 4, 11, 'Venila', 'Venila', 'What Is Vanilla Ice Cream? Vanilla ice cream is a sweet frozen dessert made from milk, cream, sugar, and vanilla flavoring from vanilla seeds, pure vanilla extract, vanilla seed paste, or a combination.', 'uploads/products/202207/20220726-055111-97777.jpg', 5, 1, '2022-07-26 05:51:11'),
(21, 4, 12, 'Salted Butter', 'SaltedButter', 'Salted butter is simply butter that contains added salt. In addition to giving a saltier taste, the salt actually acts as a preservative and prolongs the shelf life of the butter. Salted butter is perfect for spreading over crusty bread or melting over homemade pancakes or waffles.', 'uploads/products/202207/20220726-055152-263871.jpg', 48, 1, '2022-07-26 05:51:52'),
(22, 5, 13, 'Soyabeen Oils', 'SoyabeenOils', 'Soybean oil is oil produced from the seeds of the soybean plant. Chemicals from soybean oil, called plant sterols, are used for high cholesterol. Soybean oil is also used as a mosquito repellant and as a nutritional supplement in intravenous feedings.', 'uploads/products/202207/20220726-055233-355061.jpg', 70, 1, '2022-07-26 05:52:33'),
(23, 6, 14, 'Grains', 'Grains', 'Grain is the harvested seed of grasses such as wheat, oats, rice, and corn. Other important grains include sorghum, millet, rye, and barley. Around the globe, grains, also called cereals, are the most important staple food. Humans get an average of 48 percent of their calories, or food energy, from grains', 'uploads/products/202207/20220726-055308-781567.jpg', 20, 1, '2022-07-26 05:53:08');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
  `setting_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `website_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_details` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `phone` bigint(20) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `logo` text COLLATE utf8_unicode_ci,
  `favicon` text COLLATE utf8_unicode_ci,
  `creation_datetime` datetime NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`setting_id`, `website_name`, `contact_details`, `email`, `address`, `phone`, `description`, `logo`, `favicon`, `creation_datetime`) VALUES
(1, 'kgkrunch.com', '12454', 'support@kgkrunch.com', '60-49, Road 11378 ,New York, United States', 221515455885, 'sadh gahsdahsd sbdghasgfdvh nbdshfgsdf g asehdgashjdvajhdg sgajhsdbasdasd', 'uploads/logo/202207/20220726-053001-295745.png', 'uploads/favicon/202207/20220726-053001-658134.ico', '2022-07-26 05:30:22');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

DROP TABLE IF EXISTS `subcategory`;
CREATE TABLE IF NOT EXISTS `subcategory` (
  `subcategory_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `subcategory_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subcategory_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `creation_datetime` datetime NOT NULL,
  PRIMARY KEY (`subcategory_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`subcategory_id`, `category_id`, `subcategory_name`, `subcategory_image`, `status`, `creation_datetime`) VALUES
(1, 1, 'Carbonated Soft Drinks', 'uploads/subcategories/202207/20220726-053454-431666.jpg', 1, '2022-07-26 05:34:54'),
(2, 1, 'Juice', 'uploads/subcategories/202207/20220726-053507-144432.jpg', 1, '2022-07-26 05:35:07'),
(3, 2, 'Leafy green', 'uploads/subcategories/202207/20220726-053540-373478.jpg', 1, '2022-07-26 05:35:40'),
(4, 2, 'Cruciferous', 'uploads/subcategories/202207/20220726-053555-826398.jpg', 1, '2022-07-26 05:35:55'),
(5, 2, 'Root', 'uploads/subcategories/202207/20220726-053606-88200.jpg', 1, '2022-07-26 05:36:06'),
(6, 2, 'Allium', 'uploads/subcategories/202207/20220726-053628-801310.jpg', 1, '2022-07-26 05:36:28'),
(7, 3, 'Berries', 'uploads/subcategories/202207/20220726-053642-815470.jpg', 1, '2022-07-26 05:36:42'),
(8, 3, 'Pits', 'uploads/subcategories/202207/20220726-053650-793591.jpg', 1, '2022-07-26 05:36:50'),
(9, 3, 'Citrus', 'uploads/subcategories/202207/20220726-053659-474843.jpg', 1, '2022-07-26 05:36:59'),
(10, 3, 'tropical fruits', 'uploads/subcategories/202207/20220726-053708-980088.jpg', 1, '2022-07-26 05:37:08'),
(11, 4, 'ice-cream', 'uploads/subcategories/202207/20220726-053722-915074.jpg', 1, '2022-07-26 05:37:22'),
(12, 4, 'Butter and Cheese', 'uploads/subcategories/202207/20220726-053735-252262.jpg', 1, '2022-07-26 05:37:35'),
(13, 5, 'Beens oils', 'uploads/subcategories/202207/20220726-053750-458105.jpg', 1, '2022-07-26 05:37:50'),
(14, 6, 'Whole Grains', 'uploads/subcategories/202207/20220726-053802-583233.jpg', 1, '2022-07-26 05:38:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `creation_datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `telephone`, `status`, `creation_datetime`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1234567896', '1', '2022-07-26 05:30:58');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
