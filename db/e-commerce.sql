-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2022 at 03:40 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('ADMIN', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('ADMIN', 1, 'Quản trị viên cao cấp', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `badge`
--

CREATE TABLE `badge` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `color` varchar(20) NOT NULL,
  `class` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'ACTIVE',
  `availability` varchar(20) NOT NULL DEFAULT 'ACTIVE',
  `owner_id` bigint(20) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` bigint(20) DEFAULT NULL,
  `updated_at` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `badge`
--

INSERT INTO `badge` (`id`, `name`, `color`, `class`, `status`, `availability`, `owner_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Hot', '#f74b81', 'hot', 'ACTIVE', 'ACTIVE', NULL, NULL, NULL, NULL, NULL),
(2, 'New', '#3BB77E', 'new', 'ACTIVE', 'ACTIVE', NULL, NULL, NULL, NULL, NULL),
(3, 'Sale', '#67bcee', 'sale', 'ACTIVE', 'ACTIVE', NULL, NULL, NULL, NULL, NULL),
(4, 'Save', '#3BB77E', 'new', 'ACTIVE', 'ACTIVE', NULL, NULL, NULL, NULL, NULL),
(5, 'Best Sale', '#f59758', 'best', 'ACTIVE', 'ACTIVE', NULL, NULL, NULL, NULL, NULL),
(6, 'Best', '#f59758', 'best', 'ACTIVE', 'ACTIVE', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` bigint(20) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `code` varchar(100) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `is_featured` tinyint(4) NOT NULL DEFAULT 0,
  `status` varchar(20) NOT NULL DEFAULT 'ACTIVE',
  `availability` varchar(20) NOT NULL DEFAULT 'ACTIVE',
  `owner_id` bigint(20) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `parent_id`, `code`, `name`, `is_featured`, `status`, `availability`, `owner_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 3, 'milks-dairies', 'Milks & Dairies', 1, 'ACTIVE', 'ACTIVE', 0, 0, 1, 0, 1656146246318),
(2, 0, 'coffes-teas', 'Coffes & Teas', 0, 'ACTIVE', 'ACTIVE', 0, 0, 0, 0, 0),
(3, 0, 'pet-foods', 'Pet Foods', 0, 'ACTIVE', 'ACTIVE', 0, 0, 0, 0, 0),
(4, 2, 'meats', 'Meats', 0, 'ACTIVE', 'ACTIVE', 0, 0, 1, 0, 1656146514634),
(5, 0, 'vegetables', 'Vegetables', 0, 'ACTIVE', 'ACTIVE', 0, 0, 0, 0, 0),
(6, 0, 'fruits', 'Fruits', 0, 'ACTIVE', 'ACTIVE', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1656049067),
('m130524_201442_init', 1656049070),
('m140506_102106_rbac_init', 1656049146),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1656049146),
('m180523_151638_rbac_updates_indexes_without_prefix', 1656049146),
('m190124_110200_add_verification_token_column_to_user_table', 1656049071),
('m200409_110543_rbac_update_mssql_trigger', 1656049146);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `sku` varchar(100) DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `briefly` text NOT NULL,
  `description` text NOT NULL,
  `origin_price` bigint(20) NOT NULL,
  `sale_price` bigint(20) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 1,
  `is_featured` tinyint(4) NOT NULL DEFAULT 0,
  `is_badge` int(11) DEFAULT NULL,
  `front_image_url` varchar(255) NOT NULL,
  `back_image_url` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'ACTIVE',
  `availability` varchar(20) NOT NULL DEFAULT 'ACTIVE',
  `owner_id` bigint(20) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_ar` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `sku`, `code`, `name`, `briefly`, `description`, `origin_price`, `sale_price`, `amount`, `is_featured`, `is_badge`, `front_image_url`, `back_image_url`, `status`, `availability`, `owner_id`, `created_by`, `updated_by`, `created_at`, `updated_ar`) VALUES
(1, 1, NULL, '', 'Seeds of Change Organic Quinoa, Brown, & Red Rice', '', '', 10, 5, 1, 0, 1, '/imgs/shop/product-1-1.jpg', '/imgs/shop/product-1-2.jpg', 'ACTIVE', 'ACTIVE', 1, 1, 0, 0, 0),
(2, 1, NULL, '', 'All Natural Italian-Style Chicken Meatballs', '', '', 11, 8, 1, 0, 2, '/imgs/shop/product-2-1.jpg', '/imgs/shop/product-2-2.jpg', 'ACTIVE', 'ACTIVE', 1, 1, 0, 0, 0),
(4, 1, NULL, '', 'Angie’s Boomchickapop Sweet & Salty Kettle Corn', '', '', 12, 7, 1, 0, 3, '/imgs/shop/product-3-1.jpg', '/imgs/shop/product-3-2.jpg', 'ACTIVE', 'ACTIVE', 1, 1, 0, 0, 0),
(5, 1, NULL, '', 'Foster Farms Takeout Crispy Classic Buffalo Wings', '', '', 13, 6, 1, 0, 4, '/imgs/shop/product-4-1.jpg', '/imgs/shop/product-4-2.jpg', 'ACTIVE', 'ACTIVE', 1, 1, 0, 0, 0),
(6, 1, NULL, '', 'Blue Diamond Almonds Lightly Salted Vegetables', '', '', 14, 5, 1, 0, 5, '/imgs/shop/product-5-1.jpg', '/imgs/shop/product-5-2.jpg', 'ACTIVE', 'ACTIVE', 1, 1, 0, 0, 0),
(7, 1, NULL, '', 'Chobani Complete Vanilla Greek Yogurt', '', '', 15, 9, 1, 0, 6, '/imgs/shop/product-6-1.jpg', '/imgs/shop/product-6-2.jpg', 'ACTIVE', 'ACTIVE', 1, 1, 0, 0, 0),
(8, 1, NULL, '', 'Canada Dry Ginger Ale – 2 L Bottle - 200ml - 400g', '', '', 16, 8, 1, 0, 1, '/imgs/shop/product-7-1.jpg', '/imgs/shop/product-7-2.jpg', 'ACTIVE', 'ACTIVE', 1, 1, 0, 0, 0),
(9, 1, NULL, '', 'Encore Seafoods Stuffed Alaskan Salmon', '', '', 17, 7, 1, 0, 2, '/imgs/shop/product-8-1.jpg', '/imgs/shop/product-8-2.jpg', 'ACTIVE', 'ACTIVE', 1, 1, 0, 0, 0),
(11, 1, NULL, '', 'Gorton’s Beer Battered Fish Fillets with soft paper', '', '', 18, 6, 1, 0, 3, '/imgs/shop/product-9-1.jpg', '/imgs/shop/product-9-2.jpg', 'ACTIVE', 'ACTIVE', 1, 1, 0, 0, 0),
(12, 1, NULL, '', 'Haagen-Dazs Caramel Cone Ice Cream Ketchup', '', '', 19, 5, 1, 0, 4, '/imgs/shop/product-10-1.jpg', '/imgs/shop/product-10-2.jpg', 'ACTIVE', 'ACTIVE', 1, 1, 0, 0, 0),
(13, 2, NULL, '', 'Seeds of Change Organic Quinoa, Brown, & Red Rice', '', '', 10, 9, 1, 0, 5, '/imgs/shop/product-11-1.jpg', '/imgs/shop/product-11-2.jpg', 'ACTIVE', 'ACTIVE', 1, 1, 0, 0, 0),
(14, 2, NULL, '', 'All Natural Italian-Style Chicken Meatballs', '', '', 11, 8, 1, 0, 6, '/imgs/shop/product-12-1.jpg', '/imgs/shop/product-12-2.jpg', 'ACTIVE', 'ACTIVE', 1, 1, 0, 0, 0),
(15, 2, NULL, '', 'Angie’s Boomchickapop Sweet & Salty Kettle Corn', '', '', 12, 7, 1, 0, 1, '/imgs/shop/product-13-1.jpg', '/imgs/shop/product-13-2.jpg', 'ACTIVE', 'ACTIVE', 1, 1, 0, 0, 0),
(16, 2, NULL, '', 'Foster Farms Takeout Crispy Classic Buffalo Wings', '', '', 13, 6, 1, 0, 2, '/imgs/shop/product-14-1.jpg', '/imgs/shop/product-14-2.jpg', 'ACTIVE', 'ACTIVE', 1, 1, 0, 0, 0),
(17, 2, NULL, '', 'Blue Diamond Almonds Lightly Salted Vegetables', '', '', 14, 5, 1, 0, 3, '/imgs/shop/product-15-1.jpg', '/imgs/shop/product-15-2.jpg', 'ACTIVE', 'ACTIVE', 1, 1, 0, 0, 0),
(18, 2, NULL, '', 'Chobani Complete Vanilla Greek Yogurt', '', '', 15, 9, 1, 0, 4, '/imgs/shop/product-16-1.jpg', '/imgs/shop/product-16-2.jpg', 'ACTIVE', 'ACTIVE', 1, 1, 0, 0, 0),
(19, 2, NULL, '', 'Canada Dry Ginger Ale – 2 L Bottle - 200ml - 400g', '', '', 16, 8, 1, 0, 5, '/imgs/shop/product-1-1.jpg', '/imgs/shop/product-1-2.jpg', 'ACTIVE', 'ACTIVE', 1, 1, 0, 0, 0),
(20, 2, NULL, '', 'Encore Seafoods Stuffed Alaskan Salmon', '', '', 17, 7, 1, 0, 6, '/imgs/shop/product-2-1.jpg', '/imgs/shop/product-2-2.jpg', 'ACTIVE', 'ACTIVE', 1, 1, 0, 0, 0),
(21, 2, NULL, '', 'Gorton’s Beer Battered Fish Fillets with soft paper', '', '', 18, 6, 1, 0, 1, '/imgs/shop/product-3-1.jpg', '/imgs/shop/product-3-2.jpg', 'ACTIVE', 'ACTIVE', 1, 1, 0, 0, 0),
(22, 2, NULL, '', 'Haagen-Dazs Caramel Cone Ice Cream Ketchup', '', '', 19, 5, 1, 0, 2, '/imgs/shop/product-4-1.jpg', '/imgs/shop/product-4-2.jpg', 'ACTIVE', 'ACTIVE', 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `full_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `full_name`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'admin', 'Wn9oWgRc0Ah64fD92lxq7dAZAgFpsm4J', '$2y$13$9DQwTwyO4whmEe.PLxDQMOaY8n3bVw.Nj51CsYvRtS..0PSJ0WQaa', NULL, 'Bùi Thế', '', 10, 0, 1656049353, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `badge`
--
ALTER TABLE `badge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `badge`
--
ALTER TABLE `badge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
