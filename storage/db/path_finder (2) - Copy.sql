-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2025 at 04:52 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `path_finder`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `mobile_number`, `picture`, `status`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 'Abid Hasan', 'jibon0141@gmail.com', '018322656492', '1733863572.jpg', 'approved', '$2y$12$trRTcoxR5fnasA60.blpUuEDmfcy0PjKUpcCQAkII4tX2NqLd6u9W', 'LSBKsJglLqjSBv7WHVRhjtcNEj5qtPxfQ30L8i7enSwi4PuDGEqp5eaWIdqg', NULL, '2024-12-10 14:46:12'),
(19, 'MD SAKANDER ALI', 'hasan@gmail.com', '01868449964', '1733834143.jpg', 'approved', '$2y$12$cJx5DJfei9UxNJi2JuRyNOJKOl4TJLJA.lHv1U8FKbFXi/6BoWVwm', NULL, NULL, NULL),
(20, 'MD SAKANDER ALI', 'hasan1@gmail.com', '01868449964', '1733834238.jpg', 'pending', '$2y$12$zTN4dGIXSm.P0MFSCbYr/OjGXyOqAJ8jQ266JJUwPCceBkNx8J7yy', NULL, NULL, NULL),
(22, 'MD SAKANDER ALI', 'ratonmsa@gmail.com', '01718627128', '1733834752.jpg', 'pending', '$2y$12$C/fHPexUXpBbPYRpNQHZb.T8.VaQQmytePjTiLD2d2aUl/jZ7CCiO', NULL, NULL, NULL),
(26, 'MD SAKANDER ALI', 'hasani@gmail.com', '01720810731', '1733834852.jpg', 'pending', '$2y$12$XIBx0EXgbl4WmFi1QV.FTuhJ5fin3pAzKLqWjdoaxre5WqmCOt6Xu', NULL, NULL, NULL),
(27, 'MD SAKANDER ALI', 'hasan98@gmail.com', '01720810731', '1733834881.jpg', 'pending', '$2y$12$JKcdydOmM.dP2OXodfrqJO9zHYCTC.VdvZshvidxUgXra.x.V42BS', NULL, NULL, NULL),
(68, 'MD SAKANDER ALI', 'hasan2@gmail.com', '01868449964', '1733838230.jpg', 'pending', '$2y$12$neYcovPBVBzyBLXCfy5NU.2twob70upnWrD3L4HamhaWLaBGQya1S', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `category_image` varchar(255) DEFAULT NULL,
  `category_details` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_image`, `category_details`, `created_at`, `updated_at`) VALUES
(55, 'Online', '1763131917.jpg', 'Online services make work faster and more convenient.\r\nThey connect people and businesses anytime, anywhere.\r\nA reliable online service improves efficiency and user satisfaction', '2025-11-14 14:46:05', '2025-11-14 18:35:50'),
(56, 'Offline', '1763131602.png', 'Offline services provide personal, face-to-face support.\r\nThey build trust through direct interaction.\r\nReliable offline service ensures a smooth and human-centered experience.', '2025-11-14 14:46:42', '2025-11-14 18:38:00'),
(57, 'Hybrid', '1763144377.jpg', 'Hybrid services combine the convenience of online access with the personal touch of offline support.\r\nThey offer flexibility, letting users choose how they interact.\r\nA hybrid approach maximizes efficiency while maintaining human connection.', '2025-11-14 18:19:37', '2025-11-14 18:40:10'),
(58, 'Group', '1763144442.png', 'Group services bring people together to learn, share, or collaborate.\r\nThey foster teamwork, communication, and collective problem-solving.\r\nEffective group services create a supportive and engaging environment for all participants.', '2025-11-14 18:20:42', '2025-11-14 18:47:46'),
(59, 'Workshop', '1763145232.jpg', 'Workshops provide hands-on learning and practical experience.\r\nThey engage participants in interactive sessions for skill development.\r\nA well-designed workshop empowers individuals with knowledge and confidence.', '2025-11-14 18:33:52', '2025-11-14 18:47:02');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `student_id`, `phone`, `address`, `city`, `country`, `created_at`, `updated_at`) VALUES
(1, 1, '+8801712345671', 'House 12, Road 5', 'Dhaka', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(2, 2, '+8801712345672', 'House 22, Road 8', 'Chittagong', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(3, 3, '+8801712345673', 'House 35, Road 12', 'Khulna', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(4, 4, '+8801712345674', 'House 42, Road 2', 'Rajshahi', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(5, 5, '+8801712345675', 'House 55, Road 7', 'Sylhet', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(6, 6, '+8801712345676', 'House 18, Road 9', 'Barishal', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(7, 7, '+8801712345677', 'House 29, Road 3', 'Dhaka', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(8, 8, '+8801712345678', 'House 31, Road 15', 'Chittagong', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(9, 9, '+8801712345679', 'House 40, Road 6', 'Khulna', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(10, 10, '+8801712345680', 'House 25, Road 10', 'Rajshahi', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(11, 11, '+8801712345681', 'House 16, Road 5', 'Sylhet', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(12, 12, '+8801712345682', 'House 14, Road 2', 'Barishal', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(13, 13, '+8801712345683', 'House 17, Road 8', 'Dhaka', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(14, 14, '+8801712345684', 'House 19, Road 4', 'Chittagong', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(15, 15, '+8801712345685', 'House 23, Road 12', 'Khulna', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(16, 16, '+8801712345686', 'House 21, Road 7', 'Rajshahi', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(17, 17, '+8801712345687', 'House 20, Road 9', 'Sylhet', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(18, 18, '+8801712345688', 'House 27, Road 6', 'Barishal', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(19, 19, '+8801712345689', 'House 30, Road 11', 'Dhaka', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(20, 20, '+8801712345690', 'House 33, Road 5', 'Chittagong', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(21, 21, '+8801712345691', 'House 36, Road 3', 'Khulna', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(22, 22, '+8801712345692', 'House 38, Road 12', 'Rajshahi', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(23, 23, '+8801712345693', 'House 41, Road 7', 'Sylhet', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(24, 24, '+8801712345694', 'House 43, Road 10', 'Barishal', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(25, 25, '+8801712345695', 'House 45, Road 8', 'Dhaka', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(26, 26, '+8801712345696', 'House 47, Road 4', 'Chittagong', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(27, 27, '+8801712345697', 'House 50, Road 2', 'Khulna', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(28, 28, '+8801712345698', 'House 52, Road 6', 'Rajshahi', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(29, 29, '+8801712345699', 'House 54, Road 9', 'Sylhet', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(30, 30, '+8801712345700', 'House 56, Road 11', 'Barishal', 'Bangladesh', '2025-11-26 19:34:09', '2025-11-26 19:34:09'),
(33, 31, '01700000099', 'Orphan Address 1', 'Dhaka', 'Bangladesh', '2025-11-28 18:54:49', '2025-11-28 18:56:35'),
(34, 32, '01800000100', 'Orphan Address 2', 'Chittagong', 'Bangladesh', '2025-11-28 18:54:49', '2025-11-28 18:54:49');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `marks_obtained` decimal(5,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`id`, `student_id`, `subject_id`, `term_id`, `marks_obtained`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '82.00', '2025-11-28 05:50:25', '2025-11-28 05:50:25'),
(2, 1, 2, 1, '76.00', '2025-11-28 05:50:25', '2025-11-28 05:50:25'),
(3, 1, 3, 1, '88.00', '2025-11-28 05:50:25', '2025-11-28 05:50:25'),
(4, 2, 1, 1, '91.00', '2025-11-28 05:50:25', '2025-11-28 05:50:25'),
(5, 2, 2, 1, '84.00', '2025-11-28 05:50:25', '2025-11-28 05:50:25'),
(6, 2, 3, 1, '79.00', '2025-11-28 05:50:25', '2025-11-28 05:50:25'),
(7, 3, 1, 1, '67.00', '2025-11-28 05:50:25', '2025-11-28 05:50:25'),
(8, 3, 2, 1, '73.00', '2025-11-28 05:50:25', '2025-11-28 05:50:25'),
(9, 3, 3, 1, '70.00', '2025-11-28 05:50:25', '2025-11-28 05:50:25'),
(10, 4, 1, 1, '88.00', '2025-11-28 05:50:25', '2025-11-28 05:50:25'),
(11, 4, 2, 1, '90.00', '2025-11-28 05:50:25', '2025-11-28 05:50:25'),
(12, 4, 3, 1, '86.00', '2025-11-28 05:50:25', '2025-11-28 05:50:25'),
(13, 5, 1, 1, '75.00', '2025-11-28 05:50:25', '2025-11-28 05:50:25'),
(14, 5, 2, 1, '69.00', '2025-11-28 05:50:25', '2025-11-28 05:50:25'),
(15, 5, 3, 1, '80.00', '2025-11-28 05:50:25', '2025-11-28 05:50:25'),
(16, 6, 4, 1, '72.00', '2025-11-28 05:50:36', '2025-11-28 05:50:36'),
(17, 6, 5, 1, '78.00', '2025-11-28 05:50:36', '2025-11-28 05:50:36'),
(18, 6, 6, 1, '83.00', '2025-11-28 05:50:36', '2025-11-28 05:50:36'),
(19, 7, 4, 1, '88.00', '2025-11-28 05:50:36', '2025-11-28 05:50:36'),
(20, 7, 5, 1, '74.00', '2025-11-28 05:50:36', '2025-11-28 05:50:36'),
(21, 7, 6, 1, '81.00', '2025-11-28 05:50:36', '2025-11-28 05:50:36'),
(22, 8, 4, 1, '65.00', '2025-11-28 05:50:36', '2025-11-28 05:50:36'),
(23, 8, 5, 1, '70.00', '2025-11-28 05:50:36', '2025-11-28 05:50:36'),
(24, 8, 6, 1, '76.00', '2025-11-28 05:50:36', '2025-11-28 05:50:36'),
(25, 9, 4, 1, '79.00', '2025-11-28 05:50:36', '2025-11-28 05:50:36'),
(26, 9, 5, 1, '84.00', '2025-11-28 05:50:36', '2025-11-28 05:50:36'),
(27, 9, 6, 1, '88.00', '2025-11-28 05:50:36', '2025-11-28 05:50:36'),
(28, 10, 4, 1, '90.00', '2025-11-28 05:50:36', '2025-11-28 05:50:36'),
(29, 10, 5, 1, '92.00', '2025-11-28 05:50:36', '2025-11-28 05:50:36'),
(30, 10, 6, 1, '87.00', '2025-11-28 05:50:36', '2025-11-28 05:50:36'),
(31, 11, 7, 1, '77.00', '2025-11-28 05:50:49', '2025-11-28 05:50:49'),
(32, 11, 8, 1, '73.00', '2025-11-28 05:50:49', '2025-11-28 05:50:49'),
(33, 11, 9, 1, '85.00', '2025-11-28 05:50:49', '2025-11-28 05:50:49'),
(34, 12, 7, 1, '89.00', '2025-11-28 05:50:49', '2025-11-28 05:50:49'),
(35, 12, 8, 1, '88.00', '2025-11-28 05:50:49', '2025-11-28 05:50:49'),
(36, 12, 9, 1, '90.00', '2025-11-28 05:50:49', '2025-11-28 05:50:49'),
(37, 13, 7, 1, '64.00', '2025-11-28 05:50:49', '2025-11-28 05:50:49'),
(38, 13, 8, 1, '69.00', '2025-11-28 05:50:49', '2025-11-28 05:50:49'),
(39, 13, 9, 1, '72.00', '2025-11-28 05:50:49', '2025-11-28 05:50:49'),
(40, 14, 7, 1, '81.00', '2025-11-28 05:50:49', '2025-11-28 05:50:49'),
(41, 14, 8, 1, '83.00', '2025-11-28 05:50:49', '2025-11-28 05:50:49'),
(42, 14, 9, 1, '79.00', '2025-11-28 05:50:49', '2025-11-28 05:50:49'),
(43, 15, 7, 1, '92.00', '2025-11-28 05:50:49', '2025-11-28 05:50:49'),
(44, 15, 8, 1, '94.00', '2025-11-28 05:50:49', '2025-11-28 05:50:49'),
(45, 15, 9, 1, '90.00', '2025-11-28 05:50:49', '2025-11-28 05:50:49'),
(54, 1, 1, 2, '85.00', '2025-11-28 05:57:38', '2025-11-28 05:57:38'),
(55, 1, 2, 2, '78.00', '2025-11-28 05:57:38', '2025-11-28 05:57:38'),
(56, 1, 3, 2, '90.00', '2025-11-28 05:57:38', '2025-11-28 05:57:38'),
(57, 2, 1, 2, '93.00', '2025-11-28 05:57:38', '2025-11-28 05:57:38'),
(58, 2, 2, 2, '87.00', '2025-11-28 05:57:38', '2025-11-28 05:57:38'),
(59, 2, 3, 2, '82.00', '2025-11-28 05:57:38', '2025-11-28 05:57:38'),
(60, 3, 1, 2, '72.00', '2025-11-28 05:57:38', '2025-11-28 05:57:38'),
(61, 3, 2, 2, '75.00', '2025-11-28 05:57:38', '2025-11-28 05:57:38'),
(62, 3, 3, 2, '74.00', '2025-11-28 05:57:38', '2025-11-28 05:57:38'),
(63, 4, 1, 2, '90.00', '2025-11-28 05:57:38', '2025-11-28 05:57:38'),
(64, 4, 2, 2, '92.00', '2025-11-28 05:57:38', '2025-11-28 05:57:38'),
(65, 4, 3, 2, '88.00', '2025-11-28 05:57:38', '2025-11-28 05:57:38'),
(66, 5, 1, 2, '78.00', '2025-11-28 05:57:38', '2025-11-28 05:57:38'),
(67, 5, 2, 2, '73.00', '2025-11-28 05:57:38', '2025-11-28 05:57:38'),
(68, 5, 3, 2, '83.00', '2025-11-28 05:57:38', '2025-11-28 05:57:38'),
(69, 6, 4, 2, '77.00', '2025-11-28 05:58:14', '2025-11-28 05:58:14'),
(70, 6, 5, 2, '72.00', '2025-11-28 05:58:14', '2025-11-28 05:58:14'),
(71, 6, 6, 2, '80.00', '2025-11-28 05:58:14', '2025-11-28 05:58:14'),
(72, 7, 4, 2, '83.00', '2025-11-28 05:58:14', '2025-11-28 05:58:14'),
(73, 7, 5, 2, '79.00', '2025-11-28 05:58:14', '2025-11-28 05:58:14'),
(74, 7, 6, 2, '85.00', '2025-11-28 05:58:14', '2025-11-28 05:58:14'),
(75, 8, 4, 2, '71.00', '2025-11-28 05:58:14', '2025-11-28 05:58:14'),
(76, 8, 5, 2, '73.00', '2025-11-28 05:58:14', '2025-11-28 05:58:14'),
(77, 8, 6, 2, '78.00', '2025-11-28 05:58:14', '2025-11-28 05:58:14'),
(78, 9, 4, 2, '88.00', '2025-11-28 05:58:14', '2025-11-28 05:58:14'),
(79, 9, 5, 2, '82.00', '2025-11-28 05:58:14', '2025-11-28 05:58:14'),
(80, 9, 6, 2, '90.00', '2025-11-28 05:58:14', '2025-11-28 05:58:14'),
(81, 10, 4, 2, '74.00', '2025-11-28 05:58:14', '2025-11-28 05:58:14'),
(82, 10, 5, 2, '70.00', '2025-11-28 05:58:14', '2025-11-28 05:58:14'),
(83, 10, 6, 2, '76.00', '2025-11-28 05:58:14', '2025-11-28 05:58:14'),
(84, 11, 7, 2, '81.00', '2025-11-28 05:58:48', '2025-11-28 05:58:48'),
(85, 11, 8, 2, '76.00', '2025-11-28 05:58:48', '2025-11-28 05:58:48'),
(86, 11, 9, 2, '84.00', '2025-11-28 05:58:48', '2025-11-28 05:58:48'),
(87, 12, 7, 2, '88.00', '2025-11-28 05:58:48', '2025-11-28 05:58:48'),
(88, 12, 8, 2, '79.00', '2025-11-28 05:58:48', '2025-11-28 05:58:48'),
(89, 12, 9, 2, '86.00', '2025-11-28 05:58:48', '2025-11-28 05:58:48'),
(90, 13, 7, 2, '73.00', '2025-11-28 05:58:48', '2025-11-28 05:58:48'),
(91, 13, 8, 2, '70.00', '2025-11-28 05:58:48', '2025-11-28 05:58:48'),
(92, 13, 9, 2, '75.00', '2025-11-28 05:58:48', '2025-11-28 05:58:48'),
(93, 14, 7, 2, '90.00', '2025-11-28 05:58:48', '2025-11-28 05:58:48'),
(94, 14, 8, 2, '87.00', '2025-11-28 05:58:48', '2025-11-28 05:58:48'),
(95, 14, 9, 2, '92.00', '2025-11-28 05:58:48', '2025-11-28 05:58:48'),
(96, 15, 7, 2, '78.00', '2025-11-28 05:58:48', '2025-11-28 05:58:48'),
(97, 15, 8, 2, '74.00', '2025-11-28 05:58:48', '2025-11-28 05:58:48'),
(98, 15, 9, 2, '80.00', '2025-11-28 05:58:48', '2025-11-28 05:58:48');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_12_04_140112_create_admins_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `appreciation` text DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `image`, `appreciation`, `created_at`, `updated_at`) VALUES
(3, 'Rakibul Hasan', '1763217725.png', 'I am incredibly thankful to Path Finder for their expert guidance in helping me navigate my career options. Their insight led me to the path that aligns perfectly with my strengths and passion.', '2025-11-15', NULL),
(4, 'Ayesha Sultana', '1763217861.png', 'Path Finder’s advice was instrumental in helping me clarify my career goals. They helped me understand my true potential and guided me to the career that best fits my aspirations.', '2025-11-15', NULL),
(5, 'Shamim Reza', '1763217928.png', 'Thank you, Path Finder, for your insightful consultation. You made my career decisions so much clearer and helped me discover the perfect path for my skills and interests.', '2025-11-15', NULL),
(6, 'Nusrat Jahan', '1763217984.png', 'Path Finder’s support was invaluable in my career journey. They guided me in choosing a path that not only fits my abilities but also excites me for the future. Their expertise truly made a difference.', '2025-11-15', NULL),
(7, 'Mohammad Arif', '1763218044.png', 'Thanks to Path Finder, I now have a clear vision of my career. Their tailored advice helped me identify my strengths and match them with the ideal career path. I am forever grateful for their help.', '2025-11-15', NULL),
(8, 'Sadia Rumi', '1763218121.png', 'I couldn’t have asked for a better guide than Path Finder. Their strategic advice helped me take a step in the right direction toward a career that truly excites me. Thank you for helping me find my way.', '2025-11-15', NULL),
(9, 'Evan Kaisar', '1763218168.png', 'Path Finder played a key role in shaping my career. Their in-depth analysis of my skills and goals led me to the right path, and I feel more confident than ever in my future.', '2025-11-15', NULL),
(10, 'Shahina Khandakar', '1763218215.png', 'I am so thankful for Path Finder’s personalized guidance. They helped me identify the career that truly resonates with my values and aspirations. It’s a decision I’ll never regret.', '2025-11-15', NULL),
(11, 'Abdul Hannan', '1763218275.png', 'Path Finder’s consultation gave me the clarity I needed to choose the right career. Their professional advice and support have set me on a path that matches my passion and strengths.', '2025-11-15', NULL),
(12, 'Meherun Samanta', '1763218315.png', 'I’m so grateful to Path Finder for their expert guidance. They helped me realize my potential and guided me toward a career that I’m truly excited about. Their support made all the difference.', '2025-11-15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(255) DEFAULT NULL,
  `service_image` varchar(255) DEFAULT NULL,
  `category_id` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `pricing` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `counselor` varchar(255) DEFAULT NULL,
  `specialty` varchar(255) DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `reviews` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `capacity` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features`)),
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name`, `service_image`, `category_id`, `description`, `pricing`, `duration`, `counselor`, `specialty`, `rating`, `reviews`, `location`, `capacity`, `features`, `created_at`, `updated_at`) VALUES
(9, 'Career Counseling Sessions', '1763147973.png', '55', 'One-on-one session to help plan your career path and achieve your professional goals.', '$100 per session', '05-12-2024 5:00 PM - 6:00 PM', 'Dr. Alex Johnson', 'Career Coach', 4.7, 78, 'N/A', '1', '[\"Personalized career advice\\r\",\"Actionable next steps\"]', '2025-11-14 19:15:24', '2025-11-14 19:31:03'),
(10, 'Resume Review', '1763149115.jpg', '55', 'Professional review of your resume with actionable feedback to improve your chances of landing a job.', '$50 per review', 'N/A (Submit anytime)', 'Lisa Brown', 'HR Specialist', 4.9, 150, 'N/A', 'N/A', '[\"Expert feedback\\r\",\"Quick turnaround\"]', '2025-11-14 19:38:35', '2025-11-14 19:38:49'),
(11, 'Skill Gap Analysis', '1763149352.jpg', '56', 'Identify and bridge skill gaps to match current job market demands', '$120 per session', '10-12-2024 10:00 AM - 12:00 PM', 'Dr. Emily White', 'Career Strategist', 4.9, 76, 'Career Counseling Center, Downtown NY', '5 people', '[\"Custom skill report\\r\\nTraining resources\"]', '2025-11-14 19:42:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `student_email` varchar(100) DEFAULT NULL,
  `student_group_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_name`, `age`, `student_email`, `student_group_id`, `created_at`, `updated_at`) VALUES
(1, 'Rafiq Ahmed', 20, 'rafiq.ahmed1@gmail.com', 1, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(2, 'Tania Rahman', 21, 'tania.rahman2@gmail.com', 1, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(3, 'Rashed Khan', 22, 'rashed.khan3@gmail.com', 1, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(4, 'Nabila Sultana', 19, 'nabila.sultana4@gmail.com', 1, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(5, 'Sabbir Hossain', 23, 'sabbir.hossain5@gmail.com', 1, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(6, 'Farhana Akter', 20, 'farhana.akter6@gmail.com', 1, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(7, 'Jahidul Islam', 21, 'jahidul.islam7@gmail.com', 1, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(8, 'Moushumi Karim', 22, 'moushumi.karim8@gmail.com', 1, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(9, 'Tanvir Chowdhury', 23, 'tanvir.chowdhury9@gmail.com', 1, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(10, 'Shamima Akhter', 20, 'shamima.akhter10@gmail.com', 1, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(11, 'Arifur Rahman', 21, 'arifur.rahman11@gmail.com', 2, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(12, 'Sabina Yasmin', 22, 'sabina.yasmin12@gmail.com', 2, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(13, 'Rakib Hasan', 20, 'rakib.hasan13@gmail.com', 2, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(14, 'Shamim Alam', 21, 'shamim.alam14@gmail.com', 2, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(15, 'Laila Chowdhury', 23, 'laila.chowdhury15@gmail.com', 2, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(16, 'Shahriar Karim', 19, 'shahriar.karim16@gmail.com', 2, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(17, 'Nusrat Jahan', 22, 'nusrat.jahan17@gmail.com', 2, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(18, 'Raihan Siddique', 20, 'raihan.siddique18@gmail.com', 2, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(19, 'Fatema Akter', 21, 'fatema.akter19@gmail.com', 2, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(20, 'Mominul Haque', 22, 'mominul.haque20@gmail.com', 2, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(21, 'Taslima Khan', 20, 'taslima.khan21@gmail.com', 3, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(22, 'Fahim Reza', 23, 'fahim.reza22@gmail.com', 3, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(23, 'Mahfuzur Rahman', 21, 'mahfuzur.rahman23@gmail.com', 3, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(24, 'Rumana Akhter', 22, 'rumana.akhter24@gmail.com', 3, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(25, 'Samiul Islam', 20, 'samiul.islam25@gmail.com', 3, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(26, 'Jannatul Ferdous', 21, 'jannatul.ferdous26@gmail.com', 3, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(27, 'Hasan Mahmud', 23, 'hasan.mahmud27@gmail.com', 3, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(28, 'Sabuj Mia', 22, 'sabuj.mia28@gmail.com', 3, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(29, 'Nazia Parvin', 21, 'nazia.parvin29@gmail.com', 3, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(30, 'Irfan Hossain', 20, 'irfan.hossain30@gmail.com', 3, '2025-11-26 19:33:51', '2025-11-28 14:05:32'),
(31, 'Orphan Student 1', 20, 'orphan1@student.com', NULL, '2025-11-28 18:53:59', '2025-11-28 18:53:59'),
(32, 'Orphan Student 2', 21, 'orphan2@student.com', NULL, '2025-11-28 18:53:59', '2025-11-28 18:53:59');

-- --------------------------------------------------------

--
-- Table structure for table `student_groups`
--

CREATE TABLE `student_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_groups`
--

INSERT INTO `student_groups` (`id`, `group_name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Science', 'Science group with Physics, Chemistry, Biology', 1, '2025-11-27 08:11:18', '2025-11-27 08:11:18'),
(2, 'Arts', 'Arts group with History, Geography, Civics', 1, '2025-11-27 08:11:18', '2025-11-27 08:11:18'),
(3, 'Commerce', 'Commerce group with Accounting, Business Studies, Economics', 1, '2025-11-27 08:11:18', '2025-11-27 08:11:18');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`, `group_id`) VALUES
(1, 'Physics', 1),
(2, 'Chemistry', 1),
(3, 'Biology', 1),
(4, 'Math', 1),
(5, 'History', 2),
(6, 'Geography', 2),
(7, 'Civics', 2),
(8, 'Bangla', 2),
(9, 'Accounting', 3),
(10, 'Business Studies', 3),
(11, 'Economics', 3),
(12, 'Math', 3);

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` int(11) NOT NULL,
  `term_name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `term_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Term 1', 'First Term Examination', '2025-11-27 08:17:01', '2025-11-27 08:17:01'),
(2, 'Term 2', 'Second Term Examination', '2025-11-27 08:17:01', '2025-11-27 08:17:01'),
(3, 'Term 3', 'Final Term Examination', '2025-11-27 08:17:01', '2025-11-27 08:17:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_name` (`category_name`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `term_id` (`term_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_email` (`student_email`);

--
-- Indexes for table `student_groups`
--
ALTER TABLE `student_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_name` (`group_name`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `term_name` (`term_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `student_groups`
--
ALTER TABLE `student_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `marks_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `marks_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `marks_ibfk_3` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`);

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `student_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
