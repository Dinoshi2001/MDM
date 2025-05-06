-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2025 at 02:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mdm_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `master_brand`
--

CREATE TABLE `master_brand` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_brand`
--

INSERT INTO `master_brand` (`id`, `code`, `name`, `status`, `created_at`, `updated_at`) VALUES
(10, 'DEF-001', 'DEAL', 'Active', '2025-05-06 12:04:28', '2025-05-06 12:04:28'),
(11, 'DEF', 'LENOVO', 'Active', '2025-05-06 12:04:50', '2025-05-06 12:04:50'),
(12, 'DEF-003', 'ASUS', 'Active', '2025-05-06 12:05:07', '2025-05-06 12:05:07'),
(13, 'DEF-004', 'ACER', 'Inactive', '2025-05-06 12:05:34', '2025-05-06 12:05:34'),
(15, 'DEF-005', 'APPLE', 'Active', '2025-05-06 12:06:41', '2025-05-06 12:06:41');

-- --------------------------------------------------------

--
-- Table structure for table `master_category`
--

CREATE TABLE `master_category` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_category`
--

INSERT INTO `master_category` (`id`, `code`, `name`, `status`, `created_at`, `updated_at`) VALUES
(9, 'ABC-001', 'LAPTOPS', 'Active', '2025-05-06 17:32:36', '2025-05-06 17:32:36'),
(10, 'ABC-002', 'KEYBOARDS', 'Active', '2025-05-06 17:33:04', '2025-05-06 17:33:04'),
(11, 'ABC-003', 'MOUSE', 'Active', '2025-05-06 17:33:33', '2025-05-06 17:33:33'),
(12, 'ABC-004', 'CPU', 'Active', '2025-05-06 17:33:56', '2025-05-06 17:33:56');

-- --------------------------------------------------------

--
-- Table structure for table `master_item`
--

CREATE TABLE `master_item` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_item`
--

INSERT INTO `master_item` (`id`, `brand_id`, `category_id`, `code`, `name`, `attachment`, `status`, `created_at`, `updated_at`) VALUES
(28, 10, 9, 'XYZ-001', 'ITEM 01', 'uploads/2.jfif', 'Active', '2025-05-06 12:08:39', '2025-05-06 12:08:39'),
(29, 11, 10, 'XYZ-002', 'ITEM-02', 'uploads/6.jfif', 'Active', '2025-05-06 12:09:17', '2025-05-06 12:09:17'),
(30, 12, 9, 'XYZ-003', 'ITEM-03', 'uploads/1.png', 'Active', '2025-05-06 12:09:58', '2025-05-06 12:09:58'),
(31, 10, 12, 'ZYZ-004', 'ITEM-04', 'uploads/9.jfif', 'Active', '2025-05-06 12:10:38', '2025-05-06 12:10:38'),
(32, 11, 11, 'ZYZ-005', 'ITEM-05', 'uploads/8.jfif', 'Active', '2025-05-06 12:11:17', '2025-05-06 12:11:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'dinoshi sewwandi', 'dinosewwandi@gmail.com', '$2y$10$wqp.LCd2XETwSxtqBLe24.STitnyfXhw1P7go3nWaZfzH9386V9AO', '2025-05-03 19:28:39', '2025-05-03 19:28:39'),
(4, 'dinoshi sewwandi', 'dinosewwandi7@gmail.com', '$2y$10$.t4evKRUvVPGAx4qKVKXnu6WLVyYMkxPygYqzyljYI0gTt1UTx3cy', '2025-05-03 20:01:55', '2025-05-03 20:01:55'),
(5, 'hasini sewwandi', 'hasini@gmail.com', '$2y$10$Ut2i6EmQhKu5JQPTM0GJjuBGOjZgy1qTm42nQJ4QbekxqPE673IA2', '2025-05-03 20:35:48', '2025-05-03 20:35:48'),
(6, 'dinoshi sewwandi', 'sewwandi@gmail.com', '$2y$10$OfMVZFdwjvltQiSDHs4cx.UqOP6CosOjAQyBtsmSamOqpyQFHDz1y', '2025-05-05 18:33:54', '2025-05-05 18:33:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_brand`
--
ALTER TABLE `master_brand`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `master_category`
--
ALTER TABLE `master_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_item`
--
ALTER TABLE `master_item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_brand`
--
ALTER TABLE `master_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `master_category`
--
ALTER TABLE `master_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `master_item`
--
ALTER TABLE `master_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `master_item`
--
ALTER TABLE `master_item`
  ADD CONSTRAINT `master_item_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `master_brand` (`id`),
  ADD CONSTRAINT `master_item_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `master_category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
