-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2026 at 09:17 PM
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
-- Database: `marketix_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `activity_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `activity_type` varchar(50) DEFAULT NULL,
  `activity_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`activity_id`, `user_id`, `activity_type`, `activity_description`, `created_at`) VALUES
(33, 17, 'ADMIN_PROMOTE_TO_SELLER', 'Admin changed user #19 role from user to seller', '2026-01-06 21:13:12'),
(34, 17, 'ADMIN_PROMOTE_TO_SELLER', 'Admin changed user #16 role from user to seller', '2026-01-06 21:13:16'),
(35, 17, 'ADMIN_ACTIVATE_USER', 'Admin changed user #16 status from blocked to active', '2026-01-06 21:13:16'),
(36, 17, 'ADMIN_PROMOTE_TO_SELLER', 'Admin changed user #14 role from user to seller', '2026-01-06 21:13:18'),
(37, 17, 'ADMIN_PROMOTE_TO_SELLER', 'Admin changed user #20 role from user to seller', '2026-01-06 21:20:00'),
(38, 17, 'ADMIN_PROMOTE_TO_SELLER', 'Admin changed user #21 role from user to seller', '2026-01-06 21:23:56'),
(39, 17, 'ADMIN_PROMOTE_TO_SELLER', 'Admin changed user #22 role from user to seller', '2026-01-06 21:27:26'),
(40, 17, 'ADMIN_PROMOTE_TO_SELLER', 'Admin changed user #23 role from user to seller', '2026-01-06 21:30:52'),
(41, 17, 'ADMIN_PROMOTE_TO_SELLER', 'Admin changed user #24 role from user to seller', '2026-01-06 21:37:04'),
(42, 17, 'ADMIN_PROMOTE_TO_SELLER', 'Admin changed user #25 role from user to seller', '2026-01-06 21:47:30'),
(43, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-10 14:11:51'),
(44, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: active)', '2026-01-10 14:11:57'),
(45, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: inactive)', '2026-01-10 14:12:01'),
(46, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-10 14:12:05'),
(47, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-16 14:26:50'),
(48, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-16 14:26:54'),
(49, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-16 14:26:57'),
(50, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-16 14:27:01'),
(51, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-16 14:27:03'),
(52, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-16 14:27:06'),
(53, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-16 14:27:13'),
(54, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-16 14:27:14'),
(55, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-16 14:27:15'),
(56, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-16 14:27:15'),
(57, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-16 14:27:15'),
(58, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-16 14:44:03'),
(59, 17, 'ADMIN_DEACTIVATE_STORE', 'Admin changed store #31 status from active to inactive', '2026-01-16 14:44:08'),
(60, 17, 'ADMIN_BLOCK_STORE', 'Admin changed store #31 status from inactive to blocked', '2026-01-16 14:44:12'),
(61, 17, 'ADMIN_BLOCK_USER', 'Admin changed user #28 status from active to blocked', '2026-01-16 14:46:42'),
(62, 17, 'ADMIN_PROMOTE_TO_SELLER', 'Admin changed user #28 role from user to seller', '2026-01-16 14:46:45'),
(63, 17, 'ADMIN_ACTIVATE_USER', 'Admin changed user #28 status from blocked to active', '2026-01-16 14:46:46'),
(64, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-16 14:46:49'),
(65, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-16 14:46:52'),
(66, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-16 14:46:54'),
(67, 17, 'ADMIN_ACTIVATE_STORE', 'Admin changed store #31 status from blocked to active', '2026-01-16 14:47:00'),
(68, 17, 'ADMIN_BLOCK_STORE', 'Admin changed store #31 status from active to blocked', '2026-01-16 14:47:02'),
(69, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-16 14:52:30'),
(70, 17, 'ADMIN_ACTIVATE_STORE', 'Admin changed store #31 status from blocked to active', '2026-01-16 15:13:51'),
(71, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-16 15:17:08'),
(72, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-16 15:17:23'),
(73, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-16 15:17:25'),
(74, 17, 'ADMIN_BLOCK_STORE', 'Admin changed store #32 status from active to blocked', '2026-01-16 15:17:43'),
(75, 17, 'ADMIN_DEMOTE_TO_USER', 'Admin changed user #1 role from seller to user', '2026-01-16 19:56:54'),
(76, 17, 'ADMIN_BLOCK_USER', 'Admin changed user #1 status from active to blocked', '2026-01-16 19:56:57'),
(77, 17, 'ADMIN_BLOCK_USER', 'Admin changed user #2 status from active to blocked', '2026-01-16 19:57:01'),
(78, 17, 'ADMIN_BLOCK_USER', 'Admin changed user #16 status from active to blocked', '2026-01-16 19:57:14'),
(79, 17, 'ADMIN_BLOCK_USER', 'Admin changed user #15 status from active to blocked', '2026-01-16 19:57:22'),
(80, 17, 'ADMIN_BLOCK_USER', 'Admin changed user #14 status from active to blocked', '2026-01-16 19:57:31'),
(81, 17, 'ADMIN_DEMOTE_TO_USER', 'Admin changed user #16 role from seller to user', '2026-01-16 19:57:33'),
(82, 17, 'ADMIN_BLOCK_USER', 'Admin changed user #13 status from active to blocked', '2026-01-16 19:57:44'),
(83, 17, 'ADMIN_BLOCK_USER', 'Admin changed user #12 status from active to blocked', '2026-01-16 19:57:46'),
(84, 17, 'ADMIN_BLOCK_USER', 'Admin changed user #11 status from active to blocked', '2026-01-16 19:57:48'),
(85, 17, 'ADMIN_BLOCK_USER', 'Admin changed user #10 status from active to blocked', '2026-01-16 19:57:50'),
(86, 17, 'ADMIN_BLOCK_USER', 'Admin changed user #9 status from active to blocked', '2026-01-16 19:57:52'),
(87, 17, 'ADMIN_BLOCK_USER', 'Admin changed user #8 status from active to blocked', '2026-01-16 19:57:54'),
(88, 17, 'ADMIN_BLOCK_USER', 'Admin changed user #7 status from active to blocked', '2026-01-16 19:57:58'),
(89, 17, 'ADMIN_BLOCK_USER', 'Admin changed user #6 status from active to blocked', '2026-01-16 19:58:00'),
(90, 17, 'ADMIN_BLOCK_USER', 'Admin changed user #5 status from active to blocked', '2026-01-16 19:58:02'),
(91, 17, 'ADMIN_DEMOTE_TO_USER', 'Admin changed user #28 role from seller to user', '2026-01-16 19:58:14'),
(92, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-16 19:59:00'),
(93, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-16 19:59:12'),
(94, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-16 19:59:23'),
(95, 17, 'ADMIN_ACTIVATE_STORE', 'Admin changed store #32 status from blocked to active', '2026-01-16 19:59:50'),
(96, 17, 'ADMIN_BLOCK_STORE', 'Admin changed store #32 status from active to blocked', '2026-01-16 19:59:53'),
(97, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-16 20:09:41'),
(98, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: active)', '2026-01-16 20:09:45'),
(99, 17, 'ADMIN_BLOCK_USER', 'Admin changed user #29 status from active to blocked', '2026-01-16 20:12:34'),
(100, 17, 'ADMIN_PROMOTE_TO_SELLER', 'Admin changed user #29 role from user to seller', '2026-01-16 20:12:35'),
(101, 17, 'ADMIN_ACTIVATE_USER', 'Admin changed user #29 status from blocked to active', '2026-01-16 20:12:36'),
(102, 17, 'ADMIN_DEMOTE_TO_USER', 'Admin changed user #29 role from seller to user', '2026-01-16 20:12:37'),
(103, 17, 'ADMIN_BLOCK_STORE', 'Admin changed store #33 status from active to blocked', '2026-01-16 20:13:31'),
(104, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-16 20:39:39'),
(105, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-16 20:40:32'),
(106, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-16 20:40:48'),
(107, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-18 15:05:47'),
(108, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-18 15:05:54'),
(109, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-18 15:06:38'),
(110, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-18 15:09:25'),
(111, 17, 'ADMIN_DEMOTE_TO_USER', 'Admin changed user #23 role from seller to user', '2026-01-18 15:09:35'),
(112, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-18 15:29:13'),
(113, 17, 'ADMIN_BLOCK_STORE', 'Admin changed store #31 status from active to blocked', '2026-01-18 15:29:23'),
(114, 17, 'ADMIN_BLOCK_USER', 'Admin changed user #23 status from active to blocked', '2026-01-18 15:32:19'),
(115, 17, 'ADMIN_BLOCK_USER', 'Admin changed user #22 status from active to blocked', '2026-01-18 15:57:07'),
(116, 17, 'ADMIN_ACTIVATE_USER', 'Admin changed user #22 status from blocked to active', '2026-01-18 15:57:25'),
(117, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-18 15:57:27'),
(118, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-18 15:57:29'),
(119, 17, 'ADMIN_DEACTIVATE_STORE', 'Admin changed store #28 status from active to inactive', '2026-01-18 15:57:34'),
(120, 17, 'ADMIN_PROMOTE_TO_SELLER', 'Admin changed user #31 role from user to seller', '2026-01-18 17:26:26'),
(121, 17, 'ADMIN_DEMOTE_TO_USER', 'Admin changed user #31 role from seller to user', '2026-01-18 17:26:29'),
(122, 17, 'ADMIN_BLOCK_USER', 'Admin changed user #31 status from active to blocked', '2026-01-18 17:26:31'),
(123, 17, 'ADMIN_ACTIVATE_USER', 'Admin changed user #31 status from blocked to active', '2026-01-18 17:26:32'),
(124, 17, 'ADMIN_ACTIVATE_USER', 'Admin changed user #23 status from blocked to active', '2026-01-18 17:26:42'),
(125, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-18 17:26:46'),
(126, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-18 17:27:01'),
(127, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-18 17:27:05'),
(128, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-18 17:27:08'),
(129, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-18 17:27:15'),
(130, 17, 'ADMIN_BLOCK_STORE', 'Admin changed store #34 status from active to blocked', '2026-01-18 17:27:29'),
(131, 17, 'ADMIN_ACTIVATE_STORE', 'Admin changed store #31 status from blocked to active', '2026-01-18 17:27:36'),
(132, 17, 'ADMIN_ACTIVATE_STORE', 'Admin changed store #28 status from inactive to active', '2026-01-18 17:27:37'),
(133, 17, 'ADMIN_ACTIVATE_STORE', 'Admin changed store #32 status from blocked to active', '2026-01-18 17:27:46'),
(134, 17, 'ADMIN_DEACTIVATE_STORE', 'Admin changed store #32 status from active to inactive', '2026-01-18 17:27:47'),
(135, 17, 'ADMIN_BLOCK_STORE', 'Admin changed store #32 status from inactive to blocked', '2026-01-18 17:27:50'),
(136, 17, 'ADMIN_VIEW_SELLERS', 'Admin viewed sellers list (filter: all)', '2026-01-18 17:38:44'),
(137, 18, 'ADMIN_BLOCK_STORE', 'Admin changed store #31 status from active to blocked', '2026-01-18 17:41:35');

-- --------------------------------------------------------

--
-- Table structure for table `contact_requests`
--

CREATE TABLE `contact_requests` (
  `request_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `request_status` enum('new','in_progress','resolved') DEFAULT 'new',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_requests`
--

INSERT INTO `contact_requests` (`request_id`, `user_id`, `user_name`, `user_email`, `subject`, `message`, `request_status`, `created_at`) VALUES
(1, 22, 'TechZone', 'TechZone@gmail.com', 'الحساب محظور', 'ليش تم حظر حسابي', 'new', '2026-01-18 19:09:10'),
(2, 31, 'Karata Club', 'KarataClub@gmail.com', 'الحساب محظور', 'ليبلبليبل', 'new', '2026-01-18 20:22:01');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_total` decimal(10,2) NOT NULL CHECK (`order_total` >= 0),
  `order_status` enum('pending','paid','completed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_name` varchar(150) DEFAULT NULL,
  `order_email` varchar(150) DEFAULT NULL,
  `order_address` text DEFAULT NULL,
  `order_phone` varchar(20) DEFAULT NULL,
  `order_notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_total`, `order_status`, `created_at`, `order_name`, `order_email`, `order_address`, `order_phone`, `order_notes`) VALUES
(85, 24, 16.00, 'completed', '2026-01-09 15:08:15', 'Power Fit', 'PowerFit@gmail.com', 'ghgh', '999999999', ''),
(86, 24, 80.00, 'completed', '2026-01-09 15:40:05', 'Power Fit', 'PowerFit@gmail.com', 'gh', '999999999', ''),
(87, 19, 133.00, 'completed', '2026-01-10 14:07:11', 'User', 'user@gmail.com', 'ghgh', '999999999', ''),
(88, 26, 11.80, 'completed', '2026-01-14 18:50:17', 'bnbnb', 'nbnbnb@nbn', 'vn', '564654645', ''),
(89, 26, 480.00, 'cancelled', '2026-01-14 19:46:33', 'bnbnb', 'nbnbnb@nbn', 'vn', '233333333', ''),
(90, 26, 45.00, 'completed', '2026-01-14 19:52:38', 'bnbnb', 'nbnbnb@nbn', 'vn', '435354354', ''),
(91, 17, 70.80, 'completed', '2026-01-16 14:27:49', 'Admin', 'admin@gmail.com', 'ghgh', '999999999', ''),
(92, 23, 200.00, 'cancelled', '2026-01-16 14:29:42', 'ArtisanMarket', 'ArtisanMarket@gmail.com', 'ghgh', '999999999', ''),
(93, 23, 200.00, 'completed', '2026-01-16 14:30:14', 'ArtisanMarket', 'ArtisanMarket@gmail.com', 'ghgh', '999999999', ''),
(94, 17, 15.00, 'completed', '2026-01-16 15:25:28', 'Admin', 'admin@gmail.com', 'ghgh7لابلالابا', '999999999', ''),
(95, 17, 20.00, 'pending', '2026-01-16 15:37:03', 'Admin', 'admin@gmail.com', '5666666666657', '5777777777756', ''),
(96, 17, 15.00, 'completed', '2026-01-16 16:00:46', 'Admin', 'admin@gmail.com', 'ghgggggggggggggggggggggg', '999999999', ''),
(97, 17, 60.00, 'completed', '2026-01-16 16:04:17', 'Admin', 'admin@gmail.com', 'ghghثقثقثققثثثثثثثثث', '34343434', ''),
(98, 17, 16.00, 'pending', '2026-01-16 16:06:42', 'Admin', 'admin@gmail.com', 'مجمدمجمد', '783224488', ''),
(99, 29, 622.00, 'completed', '2026-01-16 19:28:41', 'Ahmed Alsharafi', 'ahmed@gmail.com', 'Yemen Sanaa Al-Shafiah', '771000000', ''),
(100, 29, 25.00, 'cancelled', '2026-01-16 19:29:48', 'Ahmed Alsharafi', 'ahmed@gmail.com', 'Yemen Sanaa Al-Shafiah', '771000000', ''),
(101, 29, 33.00, 'cancelled', '2026-01-16 19:30:27', 'Ahmed Alsharafi', 'ahmed@gmail.com', 'Yemen Sanaa Al-Shafiah', '771000000', ''),
(102, 29, 150.00, 'completed', '2026-01-16 19:31:03', 'Ahmed Alsharafi', 'ahmed@gmail.com', 'Yemen Sanaa Al-Shafiah', '771000000', ''),
(103, 29, 275.00, 'cancelled', '2026-01-16 19:31:41', 'Ahmed Alsharafi', 'ahmed@gmail.com', 'Yemen Sanaa Al-Shafiah', '771000000', ''),
(104, 29, 100.00, 'cancelled', '2026-01-16 19:32:22', 'Ahmed Alsharafi', 'ahmed@gmail.com', 'Yemen Sanaa Al-Shafiah', '771000000', ''),
(105, 31, 650.00, 'completed', '2026-01-18 17:20:39', 'Karata Club', 'KarataClub@gmail.com', 'Assafi\'yah District', '780000000', ''),
(106, 31, 4557.00, 'completed', '2026-01-18 17:24:52', 'Karata Club', 'KarataClub@gmail.com', 'Assafi\'yah District', '781000000', ''),
(107, 31, 135.00, 'completed', '2026-01-18 17:29:44', 'Karata Club', 'KarataClub@gmail.com', 'Assafi\'yah District', '781000000', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL CHECK (`quantity` > 0),
  `product_price` decimal(10,2) NOT NULL CHECK (`product_price` > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `product_price`) VALUES
(1, 85, 48, 1, 16.00),
(2, 86, 50, 1, 15.00),
(3, 86, 49, 1, 65.00),
(4, 87, 36, 5, 25.00),
(5, 87, 35, 1, 8.00),
(6, 88, 47, 1, 11.80),
(7, 89, 50, 10, 15.00),
(8, 89, 49, 2, 65.00),
(9, 89, 51, 20, 10.00),
(10, 90, 50, 3, 15.00),
(11, 91, 47, 6, 11.80),
(12, 92, 46, 10, 20.00),
(13, 93, 46, 10, 20.00),
(14, 94, 50, 1, 15.00),
(15, 95, 46, 1, 20.00),
(16, 96, 50, 1, 15.00),
(17, 97, 41, 1, 60.00),
(18, 98, 48, 1, 16.00),
(19, 99, 36, 20, 25.00),
(20, 99, 34, 6, 15.00),
(21, 99, 35, 4, 8.00),
(22, 100, 36, 1, 25.00),
(23, 101, 35, 1, 8.00),
(24, 101, 36, 1, 25.00),
(25, 102, 36, 6, 25.00),
(26, 103, 36, 11, 25.00),
(27, 104, 36, 4, 25.00),
(28, 105, 49, 10, 65.00),
(29, 106, 58, 1, 4557.00),
(30, 107, 34, 9, 15.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `product_description` text DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `product_price` decimal(10,2) NOT NULL CHECK (`product_price` > 0),
  `product_status` enum('active','hidden','out_of_stock') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `product_quantity` int(11) NOT NULL DEFAULT 0,
  `product_reserved` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `store_id`, `product_name`, `product_description`, `product_image`, `product_price`, `product_status`, `created_at`, `product_quantity`, `product_reserved`) VALUES
(34, 31, 'Chocolate Fudge Cake', 'Rich homemade chocolate cake with soft layers and creamy fudge topping.\r\nPerfect for birthdays and special occasions.', 'public/uploads/products/product_6961142780ff5.png', 15.00, 'active', '2026-01-09 14:42:41', 0, 0),
(35, 31, 'Homemade Butter Cookies', 'Freshly baked butter cookies with a crispy texture and rich homemade flavor.', 'public/uploads/products/product_696114e2cd16d.jpg', 8.00, 'active', '2026-01-09 14:46:58', 10, 0),
(36, 31, 'Chocolate Brownies Box', 'Soft and chewy chocolate brownies made with premium cocoa.\r\nPerfect as a sweet snack or gift.', 'public/uploads/products/product_6961154e0df35.jpg', 25.00, 'active', '2026-01-09 14:48:46', 19, 0),
(38, 26, 'Oversized Hoodie', 'Comfortable oversized hoodie suitable for casual and streetwear style.', 'public/uploads/products/product_696115d73c4a8.jpg', 305.00, 'active', '2026-01-09 14:51:03', 150, 0),
(39, 26, 'White Sneakers', 'Minimal white sneakers designed for comfort and daily use.', 'public/uploads/products/product_6961162a7c115.jpg', 55.00, 'active', '2026-01-09 14:52:26', 12, 0),
(40, 28, 'Wireless Headphones', 'High-quality wireless headphones with clear sound and long battery life.', 'public/uploads/products/product_6961167015e43.jpg', 75.00, 'active', '2026-01-09 14:53:36', 10, 0),
(41, 28, 'Mechanical Keyboard', 'Durable mechanical keyboard with responsive keys for work and gaming.', 'public/uploads/products/product_696116b20e51e.jpg', 60.00, 'active', '2026-01-09 14:54:42', 20, 0),
(42, 28, 'Smart Watch', 'Modern smartwatch with fitness tracking and notification support.', 'public/uploads/products/product_696117334ecb5.jpg', 90.00, 'active', '2026-01-09 14:56:51', 12, 0),
(43, 27, 'Premium Coffee Beans 1kg', 'Carefully selected coffee beans roasted for rich and balanced flavor.', 'public/uploads/products/product_69611773aa212.jpg', 14.00, 'active', '2026-01-09 14:57:55', 23, 0),
(44, 27, 'French Press Coffee Maker', 'Classic French press for smooth and rich coffee brewing.', 'public/uploads/products/product_696117a756aa1.jpg', 25.00, 'active', '2026-01-09 14:58:47', 10, 0),
(45, 27, 'Ceramic Coffee Mug', 'Stylish ceramic mug perfect for hot coffee and beverages.', 'public/uploads/products/product_69611802c32f8.jpg', 8.00, 'active', '2026-01-09 15:00:18', 33, 0),
(46, 29, 'Handmade Wooden Tray', 'Handcrafted wooden tray perfect for serving or home decoration.', 'public/uploads/products/product_6961184950d58.jpg', 20.00, 'active', '2026-01-09 15:01:29', 10, 1),
(47, 29, 'Scented Soy Candle', 'Natural handmade candle with a relaxing and warm scent.', 'public/uploads/products/product_696118ae41bf6.jpg', 11.80, 'active', '2026-01-09 15:02:26', 13, 0),
(48, 29, 'Knitted Table Runner', 'Handmade knitted table runner with a natural and elegant design.', 'public/uploads/products/product_696118cf1dd26.jpg', 16.00, 'active', '2026-01-09 15:03:43', 19, 1),
(49, 30, 'Adjustable Dumbbells Set', 'Adjustable dumbbells suitable for home workouts and strength training.', 'public/uploads/products/product_696119074d0da.jpg', 65.00, 'active', '2026-01-09 15:04:39', 8, 0),
(50, 30, 'Yoga Mat', 'Non-slip yoga mat ideal for yoga, stretching, and fitness exercises.', 'public/uploads/products/product_69611944880b3.jpg', 15.00, 'active', '2026-01-09 15:05:40', 14, 0),
(51, 30, 'Training Gloves', 'Comfortable training gloves designed to protect hands during workouts.', 'public/uploads/products/product_6961197e82f04.jpg', 10.00, 'active', '2026-01-09 15:06:38', 29, 0),
(58, 30, 'Chocolate Fudge Cake', '876878768', 'public/uploads/products/product_696d171a54455.jpg', 4557.00, 'active', '2026-01-18 17:22:33', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `image_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_main` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`image_id`, `product_id`, `image_path`, `is_main`, `created_at`) VALUES
(36, 34, 'public/uploads/products/product_696114277b8e2.png', 0, '2026-01-09 14:43:51'),
(37, 34, 'public/uploads/products/product_696114277d987.png', 0, '2026-01-09 14:43:51'),
(38, 34, 'public/uploads/products/product_696114277f058.png', 0, '2026-01-09 14:43:51'),
(39, 34, 'public/uploads/products/product_6961142780ff5.png', 1, '2026-01-09 14:43:51'),
(40, 35, 'public/uploads/products/product_696114e2cd16d.jpg', 1, '2026-01-09 14:46:58'),
(41, 35, 'public/uploads/products/product_696114e2cf643.jpg', 0, '2026-01-09 14:46:58'),
(42, 36, 'public/uploads/products/product_6961154e0df35.jpg', 1, '2026-01-09 14:48:46'),
(43, 36, 'public/uploads/products/product_6961154e10548.jpg', 0, '2026-01-09 14:48:46'),
(44, 36, 'public/uploads/products/product_6961154e1170d.jpg', 0, '2026-01-09 14:48:46'),
(47, 38, 'public/uploads/products/product_696115d73a1cf.jpg', 0, '2026-01-09 14:51:03'),
(48, 38, 'public/uploads/products/product_696115d73c4a8.jpg', 1, '2026-01-09 14:51:03'),
(49, 38, 'public/uploads/products/product_696115d73d81a.jpg', 0, '2026-01-09 14:51:03'),
(50, 39, 'public/uploads/products/product_6961162a7c115.jpg', 1, '2026-01-09 14:52:26'),
(51, 39, 'public/uploads/products/product_6961162a7fc26.jpg', 0, '2026-01-09 14:52:26'),
(52, 40, 'public/uploads/products/product_6961167015e43.jpg', 1, '2026-01-09 14:53:36'),
(53, 40, 'public/uploads/products/product_6961167017d8f.jpg', 0, '2026-01-09 14:53:36'),
(54, 41, 'public/uploads/products/product_696116b20e51e.jpg', 1, '2026-01-09 14:54:42'),
(55, 41, 'public/uploads/products/product_696116b2106fd.jpg', 0, '2026-01-09 14:54:42'),
(56, 42, 'public/uploads/products/product_696117334ecb5.jpg', 1, '2026-01-09 14:56:51'),
(57, 42, 'public/uploads/products/product_69611733519f6.jpg', 0, '2026-01-09 14:56:51'),
(58, 43, 'public/uploads/products/product_69611773aa212.jpg', 1, '2026-01-09 14:57:55'),
(59, 43, 'public/uploads/products/product_69611773ac679.jpg', 0, '2026-01-09 14:57:55'),
(60, 44, 'public/uploads/products/product_696117a756aa1.jpg', 1, '2026-01-09 14:58:47'),
(61, 44, 'public/uploads/products/product_696117a7597b2.jpg', 0, '2026-01-09 14:58:47'),
(62, 45, 'public/uploads/products/product_69611802c32f8.jpg', 1, '2026-01-09 15:00:18'),
(63, 46, 'public/uploads/products/product_6961184950d58.jpg', 1, '2026-01-09 15:01:29'),
(65, 47, 'public/uploads/products/product_696118ae41bf6.jpg', 1, '2026-01-09 15:03:10'),
(66, 48, 'public/uploads/products/product_696118cf1dd26.jpg', 1, '2026-01-09 15:03:43'),
(67, 49, 'public/uploads/products/product_696119074d0da.jpg', 1, '2026-01-09 15:04:39'),
(68, 49, 'public/uploads/products/product_696119074f13e.jpg', 0, '2026-01-09 15:04:39'),
(69, 50, 'public/uploads/products/product_69611944880b3.jpg', 1, '2026-01-09 15:05:40'),
(70, 50, 'public/uploads/products/product_696119448c173.jpg', 0, '2026-01-09 15:05:40'),
(71, 51, 'public/uploads/products/product_6961197e82f04.jpg', 1, '2026-01-09 15:06:38'),
(74, 58, 'public/uploads/products/product_696d171a54455.jpg', 1, '2026-01-18 17:23:38');

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `seller_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `seller_status` enum('active','inactive') NOT NULL DEFAULT 'inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`seller_id`, `user_id`, `created_at`, `seller_status`) VALUES
(1, 4, '2025-12-20 14:32:39', 'inactive'),
(2, 1, '2025-12-20 16:16:58', 'inactive'),
(3, 5, '2025-12-20 20:13:37', 'active'),
(4, 7, '2025-12-21 21:15:18', 'active'),
(5, 8, '2025-12-21 21:32:30', 'active'),
(6, 2, '2025-12-23 19:58:14', 'inactive'),
(7, 13, '2025-12-23 19:58:18', 'active'),
(8, 12, '2025-12-23 19:58:20', 'active'),
(9, 11, '2025-12-23 19:58:21', 'active'),
(10, 10, '2025-12-23 19:58:23', 'inactive'),
(11, 9, '2025-12-23 19:58:26', 'inactive'),
(12, 6, '2025-12-23 19:58:28', 'inactive'),
(13, 15, '2025-12-24 19:29:26', 'inactive'),
(14, 18, '2025-12-28 20:10:18', 'active'),
(15, 17, '2025-12-28 20:10:20', 'inactive'),
(16, 19, '2026-01-02 23:04:20', 'inactive'),
(17, 16, '2026-01-06 21:13:16', 'inactive'),
(18, 14, '2026-01-06 21:13:18', 'inactive'),
(19, 20, '2026-01-06 21:20:00', 'inactive'),
(20, 21, '2026-01-06 21:23:56', 'inactive'),
(21, 22, '2026-01-06 21:27:26', 'inactive'),
(22, 23, '2026-01-06 21:30:52', 'inactive'),
(23, 24, '2026-01-06 21:37:04', 'inactive'),
(24, 25, '2026-01-06 21:47:30', 'inactive'),
(25, 28, '2026-01-16 14:46:45', 'active'),
(26, 29, '2026-01-16 20:12:35', 'inactive'),
(27, 31, '2026-01-18 17:26:26', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `store_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `store_name` varchar(150) NOT NULL,
  `store_description` text DEFAULT NULL,
  `store_image` varchar(255) DEFAULT NULL,
  `store_views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `store_status` enum('active','inactive','blocked') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`store_id`, `seller_id`, `store_name`, `store_description`, `store_image`, `store_views`, `store_status`, `created_at`) VALUES
(26, 19, 'UrbanWear', 'UrbanWear is a modern fashion store offering stylish clothing for everyday wear.\r\nWe focus on minimal designs, high-quality fabrics, and comfortable fits suitable for all seasons.\r\nOur collection includes t-shirts, hoodies, jackets, and sneakers inspired by urban lifestyle.', 'store_695d81f9b253f.jpg', 2, 'active', '2026-01-06 21:43:21'),
(27, 20, 'BrewHouse', 'BrewHouse is a specialty coffee store dedicated to premium coffee beans and brewing tools.\r\nWe offer carefully selected beans, coffee accessories, and unique blends for coffee lovers.\r\nOur mission is to deliver a rich and authentic coffee experience.', 'store_695d8229341ff.jpg', 1, 'active', '2026-01-06 21:43:58'),
(28, 21, 'TechZone', 'TechZone is an electronics store providing modern gadgets and smart accessories.\r\nWe offer high-quality products such as headphones, keyboards, smartwatches, and tech tools.\r\nOur goal is to deliver reliable technology with a clean and simple shopping experience.', 'store_695d8248e850c.jpg', 1, 'active', '2026-01-06 21:44:40'),
(29, 22, 'Artisan Market', 'Artisan Market is a handmade products store showcasing unique and creative items.\r\nAll products are crafted with care, focusing on quality, authenticity, and natural materials.\r\nPerfect for gifts and home decoration lovers.', 'store_695d829352410.jpg', 6, 'active', '2026-01-06 21:45:55'),
(30, 23, 'Power Fit', 'PowerFit is a fitness store focused on workout and training equipment.\r\nWe provide tools that support strength training, home workouts, and active lifestyles.\r\nDesigned for athletes and fitness enthusiasts of all levels.', 'store_695d82b3e97df.jpg', 7, 'active', '2026-01-06 21:46:27'),
(31, 24, 'Touch Of Weet', 'Touch of Sweet a home-based sweets store specializing in freshly made desserts.\r\nWe offer a variety of homemade cakes, cookies, brownies, and traditional sweets,\r\nprepared with high-quality ingredients and a personal homemade touch.\r\nPerfect for gifts, special occasions, and everyday treats.', 'store_696a927d778fb.jpg', 6, 'blocked', '2026-01-06 21:47:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_role` enum('user','seller','admin') NOT NULL DEFAULT 'user',
  `user_status` enum('active','blocked') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_role`, `user_status`, `created_at`) VALUES
(1, 'Ghassan', 'ggg777@gmail.com', '$2y$10$KzpYAZCpr2K7dL3z5pyEc.WAC38t/245Sk5qxolckChLvXDSegRxi', 'user', 'blocked', '2025-12-19 19:14:40'),
(2, 'gh', 'ggg77@gmail.com', 'ghghgh', 'seller', 'blocked', '2025-12-19 22:03:31'),
(4, 'Ghassan', 'ggg7777@gmail.com', '$2y$10$rG50oQT2uRvGPymu0P7szu/KiwJSZvNLDFlbC.0mhuaRF0I9yFK4m', 'admin', 'active', '2025-12-19 22:38:10'),
(5, 'aaa', 'aaa@gmail.com', '$2y$10$LRk1YpjMFXZm9Pq6VMkwgOlnvKXvwJ6Awo04uAqSpQ2usT7fN5iLC', 'seller', 'blocked', '2025-12-20 18:35:57'),
(6, 'aaaaa', 'g7777@gmail.com', '$2y$10$jLPdLPTiW2isgxMETBsj0.0AFPoYvg0mTCJN5ST8IGEne5wQU72pu', 'seller', 'blocked', '2025-12-21 19:48:05'),
(7, 'Ghassan', 'g@gmail.com', '$2y$10$bdX.gt0FCinOogvlhj0qO.nTR3WZTCNTAnj9IkHxXrxkFIWGVekfe', 'seller', 'blocked', '2025-12-21 21:01:38'),
(8, 'han', 'g7@gmail.com', '$2y$10$pNB9Hftp5vpiRKJxjCH67uQpaavIZSKXnO3SjpvV.vD/aUwLxVBvO', 'seller', 'blocked', '2025-12-21 21:31:45'),
(9, 'Ghassan', 'aa@gmail.com', '$2y$10$mwkxOiy4rGaoJYl90kJ.ruIVle.4TjmNY3q2hlYq0ZdUR/X3YIZYu', 'seller', 'blocked', '2025-12-22 21:17:02'),
(10, 'fff', 'fff@gmail.com', '$2y$10$hJXOG7ZYn90mdpoB4zTx7epJ3fy..xmzkuU9QxERBoEBTe1pJde2q', 'seller', 'blocked', '2025-12-22 22:08:00'),
(11, 'Ghassan', 'gggg777@gmail.com', '$2y$10$zd4dImZv1.ZdbyAmJ13cG.q.RFtoWdw/68hbI2RdE4D1v/A2nh55G', 'seller', 'blocked', '2025-12-23 18:08:47'),
(12, 'aaa', 'ggggg777@gmail.com', '$2y$10$huygFyvfDOw/ysF.dMYiqOGNRtysUCh2jG/q1DZYxRET0U5ijIXBW', 'seller', 'blocked', '2025-12-23 18:10:47'),
(13, 'Ghassan', 'gggd777@gmail.com', '$2y$10$J5tSY3iOnEQm9RzdtOkm2O74x5YJ7g9LUvP8AgwUkHcoj4ipv5hbK', 'seller', 'blocked', '2025-12-23 19:11:35'),
(14, 'Ghassan', 'ahaa@gmail.com', '$2y$10$afgX0oNRIXVTm3r32E2b9.V2ZWiJAfJQmUq.E54JbuVk4PQJsRkd2', 'seller', 'blocked', '2025-12-23 21:32:18'),
(15, 'leen', 'leen@gmail.com', '$2y$10$XXFQMcNUpbKp5E6JTR7ydekXninrm5wBhkfOA7vgFVADTYJDEyXPC', 'seller', 'blocked', '2025-12-24 19:28:42'),
(16, 'Ghassan', 'f@gmail.com', '$2y$10$55IlxLGDCQvx2V5eNhj.p.LrnaC3YaV5t.dQ98BaKX52rc9ioFvWm', 'user', 'blocked', '2025-12-24 22:33:10'),
(17, 'Admin', 'admin@gmail.com', '$2y$10$f12Qd.rYYh9CWOqW9uX30uhU7h9SZWwJehoTP3vajxH7mMftt124y', 'admin', 'active', '2025-12-28 20:07:30'),
(18, 'Seller', 'seller@gmail.com', '$2y$10$GOn8qYtguh2SaeZl9Ij0beqXl.wZ.B1FY/RKR9wbEKYlHEhZajXnu', 'seller', 'active', '2025-12-28 20:08:27'),
(19, 'User', 'user@gmail.com', '$2y$10$OCi9/LD4c253FArGGonIQuUZ2g7FmHxKNfjyF5BGSFtpQGdgmdzvG', 'user', 'active', '2025-12-28 20:09:17'),
(20, 'UrbanWear Store', 'UrbanWear@gmail.com', '$2y$10$6dn4P3X3glGePKwEXfiKpe.3UYjdyRuFfv5xLEl42VwWPUVssZW2G', 'seller', 'active', '2026-01-06 21:18:17'),
(21, 'BrewHouse', 'BrewHouse@gmail.com', '$2y$10$751JoP8xAK7fmHHb0bRqxu44b8/KEiCmpi9t5/yWP3hV00AiJ7hCC', 'seller', 'active', '2026-01-06 21:23:32'),
(22, 'TechZone', 'TechZone@gmail.com', '$2y$10$eoXXfXyVx9qHZqCnw36moOsYFrtrpNxSTRYuoZTCzq6AM7AnYeNie', 'seller', 'active', '2026-01-06 21:27:00'),
(23, 'ArtisanMarket', 'ArtisanMarket@gmail.com', '$2y$10$oKrX4z8i.iNRnu7kT1rJNujtPQKj.xVcw2AVKiJJK1TZwS1Lo9u5O', 'user', 'active', '2026-01-06 21:30:33'),
(24, 'Power Fit', 'PowerFit@gmail.com', '$2y$10$SuDtlyVvGDze0IMUPu726uGNUBDs1IdWmxhGb0r2PoWGx0q3xFz6m', 'seller', 'active', '2026-01-06 21:36:51'),
(25, 'TouchOfWeet', 'TouchOfWeet@gmail.com', '$2y$10$4o.uUT7KrRNfOV/jqVuNZ.Nw0aNqhnIrhcHPO3TaWW/3NYYM/djP.', 'seller', 'active', '2026-01-06 21:47:12'),
(26, 'bnbnb', 'nbnbnb@nbn', '$2y$10$ZKu406qkFpjW7LffOV9LEu6YhHP9eTDU6FY6/764YqEwRAIwLQ8Re', 'user', 'active', '2026-01-14 18:48:50'),
(27, 'aaa ghghg', 'admisn@gmail.com', '$2y$10$itxnLzoyh24ZSzP3U1GaOejiTcQHBKko701qjlp6.StaRgvqIJAzK', 'user', 'active', '2026-01-14 23:57:29'),
(28, 'aaa ghghg', 'admin1@gmail.com', '$2y$10$aHgyhkBwhYt7Yjy/rTj3Vu1CsDz/j7hpApMxYsOR3wz/jjRgB5U3S', 'user', 'active', '2026-01-16 14:23:12'),
(29, 'Ahmed Alsharafi', 'ahmed@gmail.com', '$2y$10$5iBBt2qUMre3Tz4FrxZOAuNl/zalNjun4WOrvsz4/KBDWEZ3ZlJXa', 'user', 'active', '2026-01-16 19:24:28'),
(30, 'KarataClub Schema', 'KarataClubSchema@gmail.com', '$2y$10$3jozfPmdWASYOsY2SP8waenruA.1DTbXmi/r1./uxRzh2LmbD5sky', 'user', 'active', '2026-01-18 16:01:22'),
(31, 'Karata Club', 'KarataClub@gmail.com', '$2y$10$j8uZTDUW4EpIN6y/xu7YiO11C7ylx2VPD.dEIEUcgO2c2H070egCa', 'user', 'active', '2026-01-18 17:16:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_login_logs`
--

CREATE TABLE `user_login_logs` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_time` datetime DEFAULT current_timestamp(),
  `logout_time` datetime DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_login_logs`
--

INSERT INTO `user_login_logs` (`log_id`, `user_id`, `login_time`, `logout_time`, `ip_address`, `user_agent`) VALUES
(217, 17, '2026-01-07 00:12:47', '2026-01-07 00:13:50', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(218, 18, '2026-01-07 00:13:53', '2026-01-07 00:14:04', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(219, 17, '2026-01-07 00:14:11', '2026-01-07 00:17:41', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(220, 20, '2026-01-07 00:18:29', '2026-01-07 00:18:43', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(221, 17, '2026-01-07 00:19:50', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(222, 20, '2026-01-07 00:20:07', '2026-01-07 00:23:18', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(223, 21, '2026-01-07 00:23:42', '2026-01-07 00:24:18', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(224, 21, '2026-01-07 00:24:23', '2026-01-07 00:26:48', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(225, 22, '2026-01-07 00:27:08', '2026-01-07 00:27:36', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(226, 22, '2026-01-07 00:27:37', '2026-01-07 00:29:02', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(227, 23, '2026-01-07 00:30:45', '2026-01-07 00:31:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(228, 23, '2026-01-07 00:31:02', '2026-01-07 00:34:39', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(229, 5, '2026-01-07 00:34:43', '2026-01-07 00:34:47', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(230, 19, '2026-01-07 00:34:54', '2026-01-07 00:35:16', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(231, 19, '2026-01-07 00:35:17', '2026-01-07 00:36:34', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(232, 24, '2026-01-07 00:36:58', '2026-01-07 00:37:15', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(233, 24, '2026-01-07 00:37:16', '2026-01-07 00:39:51', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(234, 23, '2026-01-07 00:40:26', '2026-01-07 00:41:26', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(235, 19, '2026-01-07 00:41:31', '2026-01-07 00:42:37', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(236, 20, '2026-01-07 00:43:04', '2026-01-07 00:43:27', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(237, 21, '2026-01-07 00:43:38', '2026-01-07 00:44:16', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(238, 22, '2026-01-07 00:44:19', '2026-01-07 00:44:55', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(239, 23, '2026-01-07 00:45:04', '2026-01-07 00:46:01', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(240, 24, '2026-01-07 00:46:07', '2026-01-07 00:47:05', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(241, 25, '2026-01-07 00:47:22', '2026-01-07 00:47:33', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(242, 25, '2026-01-07 00:47:34', '2026-01-09 17:40:30', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(243, 25, '2026-01-09 17:40:33', '2026-01-09 17:48:57', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(244, 20, '2026-01-09 17:49:06', '2026-01-09 17:52:29', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(245, 22, '2026-01-09 17:52:33', '2026-01-09 17:56:54', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(246, 21, '2026-01-09 17:56:58', '2026-01-09 18:00:38', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(247, 23, '2026-01-09 18:00:43', '2026-01-09 18:03:45', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(248, 24, '2026-01-09 18:03:55', '2026-01-10 16:51:27', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(249, 5, '2026-01-10 17:05:54', '2026-01-10 17:05:57', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(250, 19, '2026-01-10 17:06:05', '2026-01-10 17:08:47', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(251, 25, '2026-01-10 17:09:12', '2026-01-10 17:10:51', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(252, 17, '2026-01-10 17:10:59', '2026-01-10 17:14:05', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(253, 26, '2026-01-14 21:49:00', '2026-01-14 21:49:48', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(254, 26, '2026-01-14 21:49:49', '2026-01-14 23:23:01', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(255, 17, '2026-01-14 23:22:41', '2026-01-14 23:22:45', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(256, 17, '2026-01-14 23:23:12', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(257, 17, '2026-01-15 02:58:54', '2026-01-16 17:18:29', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(258, 28, '2026-01-16 17:23:26', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(259, 17, '2026-01-16 17:26:48', '2026-01-16 17:28:07', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(260, 23, '2026-01-16 17:28:12', '2026-01-16 17:43:53', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(261, 17, '2026-01-16 17:43:58', '2026-01-16 17:44:15', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(262, 25, '2026-01-16 17:44:18', '2026-01-16 17:44:40', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(263, 17, '2026-01-16 17:44:50', '2026-01-16 18:14:08', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(264, 17, '2026-01-16 18:14:11', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(265, 17, '2026-01-16 18:15:23', '2026-01-16 22:26:28', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(266, 29, '2026-01-16 22:24:48', '2026-01-16 22:26:13', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(267, 29, '2026-01-16 22:26:16', '2026-01-16 22:56:22', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(268, 25, '2026-01-16 22:26:37', '2026-01-16 22:35:39', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(269, 20, '2026-01-16 22:35:43', '2026-01-16 22:56:08', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(270, 17, '2026-01-16 22:56:15', '2026-01-16 23:09:24', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(271, 29, '2026-01-16 23:00:10', '2026-01-16 23:12:55', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(272, 17, '2026-01-16 23:09:35', '2026-01-16 23:09:55', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(273, 17, '2026-01-16 23:10:29', '2026-01-16 23:14:42', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(274, 29, '2026-01-16 23:13:04', '2026-01-16 23:13:49', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(275, 25, '2026-01-16 23:14:46', '2026-01-16 23:39:24', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(276, 29, '2026-01-16 23:38:30', '2026-01-16 23:38:42', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(277, 17, '2026-01-16 23:39:29', '2026-01-16 23:40:42', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(278, 17, '2026-01-16 23:40:44', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(279, 17, '2026-01-18 17:26:04', '2026-01-18 18:04:05', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(280, 22, '2026-01-18 17:26:15', '2026-01-18 18:04:19', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(281, 22, '2026-01-18 18:04:37', '2026-01-18 18:04:42', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(282, 22, '2026-01-18 18:05:10', '2026-01-18 18:05:22', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(283, 22, '2026-01-18 18:05:35', '2026-01-18 18:06:03', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(284, 17, '2026-01-18 18:05:45', '2026-01-18 20:21:06', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(285, 22, '2026-01-18 18:06:04', '2026-01-18 18:06:47', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(286, 25, '2026-01-18 18:06:57', '2026-01-18 18:09:53', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(287, 25, '2026-01-18 18:22:19', '2026-01-18 18:25:17', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(288, 25, '2026-01-18 18:25:20', '2026-01-18 18:25:32', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(289, 22, '2026-01-18 18:25:36', '2026-01-18 18:28:59', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(290, 22, '2026-01-18 18:29:02', '2026-01-18 18:29:06', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(291, 25, '2026-01-18 18:29:32', '2026-01-18 18:31:45', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(292, 22, '2026-01-18 18:56:53', '2026-01-18 18:57:14', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(293, 22, '2026-01-18 18:57:39', '2026-01-18 19:00:56', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(294, 30, '2026-01-18 19:01:39', '2026-01-18 19:01:50', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(295, 22, '2026-01-18 19:01:56', '2026-01-18 20:16:14', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(296, 31, '2026-01-18 20:16:42', '2026-01-18 20:41:12', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(297, 24, '2026-01-18 20:21:13', '2026-01-18 20:25:50', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(298, 25, '2026-01-18 20:25:55', '2026-01-18 20:26:08', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(299, 17, '2026-01-18 20:26:15', '2026-01-18 20:30:10', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(300, 25, '2026-01-18 20:30:12', '2026-01-18 20:30:26', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(301, 17, '2026-01-18 20:30:30', '2026-01-18 20:41:22', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36'),
(302, 18, '2026-01-18 20:41:28', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`activity_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contact_requests`
--
ALTER TABLE `contact_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `idx_orders_user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `fk_items_product` (`product_id`),
  ADD KEY `idx_items_order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `idx_products_store_id` (`store_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `fk_product_images_product` (`product_id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`seller_id`),
  ADD UNIQUE KEY `uq_sellers_user` (`user_id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`store_id`),
  ADD KEY `fk_stores_seller` (`seller_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `uq_users_email` (`user_email`);

--
-- Indexes for table `user_login_logs`
--
ALTER TABLE `user_login_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `contact_requests`
--
ALTER TABLE `contact_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_login_logs`
--
ALTER TABLE `user_login_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=303;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `contact_requests`
--
ALTER TABLE `contact_requests`
  ADD CONSTRAINT `fk_contact_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_items_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_items_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_store` FOREIGN KEY (`store_id`) REFERENCES `stores` (`store_id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `fk_product_images_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `sellers`
--
ALTER TABLE `sellers`
  ADD CONSTRAINT `fk_sellers_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `stores`
--
ALTER TABLE `stores`
  ADD CONSTRAINT `fk_stores_seller` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`seller_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_login_logs`
--
ALTER TABLE `user_login_logs`
  ADD CONSTRAINT `user_login_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
