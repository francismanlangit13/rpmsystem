-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2024 at 01:24 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rpmsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `log_message` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `log_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `user_id`, `log_message`, `type`, `log_date`) VALUES
(1, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 08:33:24'),
(2, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 08:33:38'),
(3, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 08:33:59'),
(4, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 08:34:06'),
(5, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 08:34:46'),
(6, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 08:36:28'),
(7, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 08:42:03'),
(8, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 08:42:35'),
(9, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 08:49:47'),
(10, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 08:50:38'),
(11, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 09:12:58'),
(12, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 09:15:55'),
(13, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 09:17:29'),
(14, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 09:18:06'),
(15, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 09:18:23'),
(16, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 09:22:26'),
(17, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 09:23:30'),
(18, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 09:24:44'),
(19, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 09:31:37'),
(20, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 09:33:39'),
(21, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 09:34:17'),
(22, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 09:35:27'),
(23, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 09:36:35'),
(24, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 09:38:00'),
(25, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 09:38:18'),
(26, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 09:39:25'),
(27, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 09:39:36'),
(28, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 09:49:59'),
(29, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 09:50:22'),
(30, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 09:52:29'),
(31, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 09:55:01'),
(32, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 09:55:39'),
(33, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:06:00'),
(34, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:06:22'),
(35, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:06:39'),
(36, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:08:05'),
(37, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:08:31'),
(38, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:09:13'),
(39, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:11:30'),
(40, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:16:23'),
(41, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:16:35'),
(42, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:16:55'),
(43, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:18:26'),
(44, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:18:49'),
(45, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:19:05'),
(46, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:24:44'),
(47, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:25:23'),
(48, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:26:26'),
(49, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:26:57'),
(50, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:27:08'),
(51, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:27:32'),
(52, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:27:43'),
(53, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:28:40'),
(54, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:28:50'),
(55, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:29:27'),
(56, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:30:28'),
(57, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:37:24'),
(58, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:38:33'),
(59, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:39:12'),
(60, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:39:24'),
(61, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:40:17'),
(62, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:40:27'),
(63, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:41:42'),
(64, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:41:50'),
(65, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:42:13'),
(66, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:42:22'),
(67, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:43:59'),
(68, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:44:20'),
(69, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:44:39'),
(70, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:45:17'),
(71, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:45:22'),
(72, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:45:27'),
(73, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:46:42'),
(74, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:49:40'),
(75, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:50:05'),
(76, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 10:50:31'),
(77, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 11:27:19'),
(78, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 11:27:41'),
(79, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 11:27:53'),
(80, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 11:28:27'),
(81, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 11:28:33'),
(82, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 11:29:17'),
(83, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 11:29:22'),
(84, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 11:29:35'),
(85, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 11:30:30'),
(86, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 11:30:39'),
(87, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 11:30:55'),
(88, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-01-29 11:31:00'),
(89, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-02-03 12:07:08'),
(90, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-02-03 12:07:35'),
(91, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-02-03 12:08:09'),
(92, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-02-03 12:08:43'),
(93, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-02-03 12:09:26'),
(94, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-02-03 12:18:11'),
(95, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-02-03 12:18:26'),
(96, 1, 'Edit payment for Rent ID 26.', 'Payments', '2024-02-03 12:18:37'),
(97, 1, 'Add payment for Rent ID 27.', 'Payments', '2024-02-03 12:20:21'),
(98, 1, 'Add payment for Rent ID 28.', 'Payments', '2024-02-03 12:23:33'),
(99, 1, 'Add payment for Rent ID 29.', 'Payments', '2024-02-03 12:24:08'),
(100, 1, 'Add payment for Rent ID 30.', 'Payments', '2024-02-03 01:06:24'),
(101, 1, 'Add payment for Rent ID 31.', 'Payments', '2024-02-03 01:07:05'),
(102, 1, 'Add payment for Rent ID 32.', 'Payments', '2024-02-03 01:11:53'),
(103, 1, 'Add payment for Rent ID 33.', 'Payments', '2024-02-03 04:35:20'),
(104, 1, 'Add payment for Rent ID 34.', 'Payments', '2024-02-03 04:38:12'),
(105, 1, 'Edit payment for Rent ID 34.', 'Payments', '2024-02-04 07:25:32'),
(106, 1, 'Edit payment for Rent ID 34.', 'Payments', '2024-02-04 07:27:41'),
(107, 1, 'Edit payment for Rent ID 34.', 'Payments', '2024-02-04 07:29:38'),
(108, 1, 'Edit payment for Rent ID 34.', 'Payments', '2024-02-04 07:30:05'),
(109, 1, 'Edit payment for Rent ID 34.', 'Payments', '2024-02-04 07:35:24'),
(110, 1, 'Edit payment for Rent ID 34.', 'Payments', '2024-02-04 07:35:57'),
(111, 1, 'Edit payment for Rent ID 34.', 'Payments', '2024-02-04 07:36:16'),
(112, 1, 'Edit payment for Rent ID 34.', 'Payments', '2024-02-04 07:36:37'),
(113, 1, 'Add payment for Rent ID 35.', 'Payments', '2024-02-04 07:42:00'),
(114, 1, 'Add payment for Rent ID 36.', 'Payments', '2024-02-04 07:44:13'),
(115, 1, 'Edit payment for Rent ID 36.', 'Payments', '2024-02-04 07:44:40'),
(116, 1, 'Edit payment for Rent ID 36.', 'Payments', '2024-02-04 07:45:02'),
(117, 1, 'Edit payment for Rent ID 36.', 'Payments', '2024-02-04 07:48:00'),
(118, 1, 'Edit payment for Rent ID 36.', 'Payments', '2024-02-04 07:48:23'),
(119, 1, 'Add payment for Rent ID 37.', 'Payments', '2024-02-04 07:50:34'),
(120, 1, 'Add payment for Rent ID 38.', 'Payments', '2024-02-04 07:51:39'),
(121, 1, 'Edit payment for Rent ID 38.', 'Payments', '2024-02-04 07:51:52'),
(122, 1, 'Edit payment for Rent ID 38.', 'Payments', '2024-02-04 07:57:49'),
(123, 1, 'Edit payment for Rent ID 38.', 'Payments', '2024-02-04 07:59:54'),
(124, 1, 'Edit payment for Rent ID 38.', 'Payments', '2024-02-04 08:00:07'),
(125, 1, 'Edit payment for Rent ID 38.', 'Payments', '2024-02-04 08:00:21'),
(126, 1, 'Edit payment for Rent ID 38.', 'Payments', '2024-02-04 08:03:40'),
(127, 1, 'Add payment for Rent ID 39.', 'Payments', '2024-02-04 08:04:39'),
(128, 1, 'Edit payment for Rent ID 39.', 'Payments', '2024-02-04 08:05:01'),
(129, 1, 'Edit payment for Rent ID 39.', 'Payments', '2024-02-04 08:10:54'),
(130, 1, 'Edit payment for Rent ID 39.', 'Payments', '2024-02-04 08:12:54'),
(131, 1, 'Edit payment for Rent ID 39.', 'Payments', '2024-02-04 08:13:12'),
(132, 1, 'Edit payment for Rent ID 39.', 'Payments', '2024-02-04 08:13:35'),
(133, 1, 'Edit payment for Rent ID 39.', 'Payments', '2024-02-04 08:16:31'),
(134, 1, 'Edit payment for Rent ID 39.', 'Payments', '2024-02-04 08:16:42'),
(135, 1, 'Edit payment for Rent ID 39.', 'Payments', '2024-02-04 08:19:02'),
(136, 1, 'Edit payment for Rent ID 39.', 'Payments', '2024-02-04 08:19:37'),
(137, 1, 'Edit payment for Rent ID 39.', 'Payments', '2024-02-04 08:19:59'),
(138, 1, 'Edit payment for Rent ID 39.', 'Payments', '2024-02-04 08:20:29'),
(139, 1, 'Edit payment for Rent ID 39.', 'Payments', '2024-02-04 08:21:03'),
(140, 1, 'Edit payment for Rent ID 39.', 'Payments', '2024-02-04 08:23:01'),
(141, 1, 'Edit payment for Rent ID 39.', 'Payments', '2024-02-04 08:23:21'),
(142, 1, 'Edit payment for Rent ID 39.', 'Payments', '2024-02-04 08:23:34'),
(143, 1, 'Edit payment for Rent ID 39.', 'Payments', '2024-02-04 08:23:46'),
(144, 1, 'Edit payment for Rent ID 39.', 'Payments', '2024-02-04 08:23:51'),
(145, 1, 'Edit payment for Rent ID 39.', 'Payments', '2024-02-04 08:23:57');

-- --------------------------------------------------------

--
-- Table structure for table `database_mgmt`
--

CREATE TABLE `database_mgmt` (
  `database_id` int(11) NOT NULL,
  `database_name` varchar(255) NOT NULL,
  `database_date` datetime NOT NULL,
  `database_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_temp`
--

CREATE TABLE `password_reset_temp` (
  `user_id` int(11) NOT NULL,
  `email` text NOT NULL,
  `key` text NOT NULL,
  `expDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `password_reset_temp`
--

INSERT INTO `password_reset_temp` (`user_id`, `email`, `key`, `expDate`) VALUES
(3, 'trestizarizamae@gmail.com', '768e78024aa8fdb9b8fe87be86f64745a794e9a7d8', '2023-12-13 16:30:48');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `utility_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `utility_type_id` int(11) NOT NULL,
  `is_cash_advance` int(11) NOT NULL,
  `is_cash_deposit` int(11) NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `payment_amount` double(11,2) NOT NULL,
  `payment_remaining` double(11,2) NOT NULL,
  `payment_reference` varchar(255) NOT NULL,
  `payment_date` datetime NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `payment_comment` varchar(250) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `last_update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `utility_id`, `user_id`, `utility_type_id`, `is_cash_advance`, `is_cash_deposit`, `payment_type_id`, `payment_amount`, `payment_remaining`, `payment_reference`, `payment_date`, `payment_status`, `payment_comment`, `status`, `remarks`, `updated_by`, `last_update_date`) VALUES
(39, 1, 9, 1, 1, 0, 1, 5000.00, 0.00, '', '2024-02-04 08:04:39', 'Paid', '', 'Active', 'Payment made by cash advance, but there were insufficient funds.', 1, '2024-02-04 08:23:57');

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `payment_type_id` int(11) NOT NULL,
  `payment_type_name` varchar(255) NOT NULL,
  `payment_type_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_type`
--

INSERT INTO `payment_type` (`payment_type_id`, `payment_type_name`, `payment_type_status`) VALUES
(1, 'Cash', 'Active'),
(2, 'GCash', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `property_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rentee_id` int(11) NOT NULL,
  `property_unit_code` varchar(255) NOT NULL,
  `property_permit` varchar(255) NOT NULL,
  `property_purok` varchar(255) NOT NULL,
  `property_barangay` varchar(255) NOT NULL,
  `property_city` varchar(255) NOT NULL,
  `property_zipcode` varchar(255) NOT NULL,
  `property_type_id` int(11) NOT NULL,
  `has_electrical_meter` varchar(255) NOT NULL,
  `has_water_meter` varchar(255) NOT NULL,
  `has_parking_space` varchar(255) NOT NULL,
  `has_conectivity` varchar(255) NOT NULL,
  `property_amount` double(11,2) NOT NULL,
  `property_status` varchar(255) NOT NULL,
  `p_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`property_id`, `user_id`, `rentee_id`, `property_unit_code`, `property_permit`, `property_purok`, `property_barangay`, `property_city`, `property_zipcode`, `property_type_id`, `has_electrical_meter`, `has_water_meter`, `has_parking_space`, `has_conectivity`, `property_amount`, `property_status`, `p_status`) VALUES
(1, 6, 7, 'Door 1 Green', 'AB24-AX2D', '1', 'Corrales', 'Jimenez', '7204', 1, 'Yes', 'No', 'Yes', 'No', 5000.00, 'Rented', 'Active'),
(2, 2, 0, 'Door 2 Black', 'SB29-SX45', '3', 'Nacional', 'Jimenez', '7204', 1, 'No', 'Yes', 'Yes', 'Yes', 5000.00, 'Available', 'Active'),
(3, 2, 0, 'Door 3 Green1', 'SB-28-SX44', '3', 'Nacional', 'Jimenez', '7204', 1, 'Yes', 'Yes', 'Yes', 'Yes', 5000.00, 'Available', 'Active'),
(4, 3, 0, 'Door 1 Grey', 'KJD2-NXX1', '2', 'Taraka', 'Jimenez', '7204', 2, 'No', 'Yes', 'Yes', 'No', 2500.00, 'Available', 'Active'),
(5, 3, 9, 'Door 2 Silver', 'KG2F-SSFG', '1', 'Taraka', 'Jimenez', '7204', 2, 'Yes', 'No', 'Yes', 'Yes', 2500.00, 'Rented', 'Active'),
(6, 3, 0, 'Door 3 Red', 'KSG2-26AB', '5', 'Taraka', 'Jimenez', '7204', 2, 'Yes', 'Yes', 'No', 'Yes', 10500.00, 'Available', 'Active'),
(7, 6, 0, 'Door Blue', 'FX2C-DDAB', '4', 'Corrales', 'Jimenez', '7204', 1, 'Yes', 'Yes', 'Yes', 'No', 5000.00, 'Available', 'Active'),
(8, 2, 0, 'Door 3 Green', 'JD8G-HJK1', '2', 'Nacional', 'Jimenez', '7204', 1, 'No', 'No', 'Yes', 'Yes', 5000.00, 'Available', 'Active'),
(9, 2, 5, 'Door 1', 'DJI2-2648', '4', 'Nacional', 'Jimenez', '7204', 1, 'Yes', 'No', 'No', 'Yes', 5000.00, 'Rented', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `property_type`
--

CREATE TABLE `property_type` (
  `property_type_id` int(11) NOT NULL,
  `property_type_name` varchar(255) NOT NULL,
  `property_type_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property_type`
--

INSERT INTO `property_type` (`property_type_id`, `property_type_name`, `property_type_status`) VALUES
(1, 'Apartment', 'Active'),
(2, 'Boarding House', 'Active'),
(3, 'Residential Space', 'Active'),
(4, 'Commercial Space', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `mname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `address` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `valid_id` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_rented` int(11) NOT NULL,
  `property_rented_id` int(11) NOT NULL,
  `startrent` date NOT NULL,
  `endrent` date NOT NULL,
  `cash_advance` double(11,2) NOT NULL,
  `cash_deposit` double(11,2) NOT NULL,
  `balance` double(11,2) NOT NULL,
  `status` varchar(250) NOT NULL,
  `type` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fname`, `mname`, `lname`, `suffix`, `gender`, `address`, `civil_status`, `birthday`, `occupation`, `company`, `valid_id`, `profile`, `email`, `phone`, `password`, `is_rented`, `property_rented_id`, `startrent`, `endrent`, `cash_advance`, `cash_deposit`, `balance`, `status`, `type`) VALUES
(1, 'user', '', 'admin', ' ', 'Female', '', 'Single', '0000-00-00', '', '', '', 'user_20240113_152313.png', 'admin@gmail.com', '09457664942', 'admin', 0, 0, '0000-00-00', '0000-00-00', 0.00, 0.00, 0.00, 'Active', 'Admin'),
(2, 'Jaylord', '', 'Galindo', ' ', 'Male', 'Purok 4, Punta, Panaon 7205', 'Single', '2003-01-02', '', '', '', '', 'jayjayjaylord16@gmail.com', '09063556241', 'jaylord', 0, 0, '0000-00-00', '0000-00-00', 0.00, 0.00, 0.00, 'Active', 'Admin'),
(3, 'Riza Mae', '', 'Trestiza', ' ', 'Female', 'Purok 3, Matugas Alto, Jimenez 7204', 'Single', '2003-11-18', '', '', '', '', 'trestizarizamae@gmail.com', '09061269981', 'riza', 0, 0, '0000-00-00', '0000-00-00', 0.00, 0.00, 0.00, 'Active', 'Staff'),
(4, 'John Mark', '', 'Ebarat', ' ', 'Male', 'Purok 6, Casusan, Aloran 7206', 'Single', '2005-01-10', 'Self Employed', 'XnY Solutions Inc', 'ID_20240110_010444.png', '', 'john@gmail.com', '09524856482', 'john', 0, 3, '2024-01-13', '2024-01-13', 5000.00, 5000.00, 0.00, 'Inactive', 'Renter'),
(5, 'Marilou', '', 'Nobleza', 'I', 'Female', 'Purok 3, Taraka, Jimenez 7204', 'Single', '2004-01-08', 'House wife', '', '', '', 'marilou@gmail.com', '09543854685', 'marilou', 1, 9, '2024-01-23', '2024-06-23', 3500.00, 1750.00, 0.00, 'Active', 'Renter'),
(6, 'Nica', '', 'Nica Ogapay', ' ', 'Female', 'Purok 2, Delapaz, Clarin 7201', 'Single', '1998-05-07', '', '', '', '', 'nica@gmail.com', '09954844898', 'nica', 0, 0, '0000-00-00', '0000-00-00', 0.00, 0.00, 0.00, 'Active', 'Staff'),
(7, 'Abigail', '', 'Maghuyop', ' ', 'Female', 'Purok 1, Delapaz, Panaon 7205', 'Single', '1995-08-16', 'Employed', 'Jollibee Ozamiz', '', '', 'abigail@gmail.com', '09554856548', 'abigail', 1, 1, '2024-01-01', '2025-01-01', 6500.00, 4500.00, 0.00, 'Active', 'Renter'),
(8, 'Judielyn', 'Trestiza', 'Cualbar', ' ', 'Female', 'Purok 3, Butuay, Jimenez 7204', 'Single', '1994-12-21', 'Employed', 'USTP-Panaon', '', '', 'judielyn.cualbar@ustp.edu.ph', '09171234794', 'jud@123', 1, 1, '0000-00-00', '0000-00-00', 2000.00, 2000.00, 5000.00, 'Active', 'Admin'),
(9, 'Judielyn', 'Cualbar', 'Trestiza', ' ', 'Male', 'Purok 2, Santa Cruz, Jimenez 7204', 'Single', '1997-02-10', 'Self Employed', 'USTP-Panaon', '', '', 'judielyn.cualbar2@gmail.com', '09171234794', 'judielyn@123', 1, 5, '2024-01-10', '2025-01-10', 2500.00, 500.00, 0.00, 'Active', 'Renter');

-- --------------------------------------------------------

--
-- Table structure for table `utility`
--

CREATE TABLE `utility` (
  `utility_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `utility_type_id` int(11) NOT NULL,
  `utility_amount` decimal(11,2) NOT NULL,
  `utility_date` datetime NOT NULL,
  `utility_attachment` varchar(255) NOT NULL,
  `is_payment_made` int(11) NOT NULL,
  `utility_status` varchar(10) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `last_update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utility`
--

INSERT INTO `utility` (`utility_id`, `user_id`, `utility_type_id`, `utility_amount`, `utility_date`, `utility_attachment`, `is_payment_made`, `utility_status`, `updated_by`, `last_update_date`) VALUES
(1, 9, 1, '5000.00', '2023-11-11 10:06:10', '', 0, 'Active', 2, '2023-12-11 10:10:12');

-- --------------------------------------------------------

--
-- Table structure for table `utility_type`
--

CREATE TABLE `utility_type` (
  `utility_type_id` int(11) NOT NULL,
  `utility_type_name` varchar(255) NOT NULL,
  `utility_type_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utility_type`
--

INSERT INTO `utility_type` (`utility_type_id`, `utility_type_name`, `utility_type_status`) VALUES
(1, 'Rent', 'Active'),
(2, 'Electricity', 'Active'),
(3, 'Water', 'Active'),
(4, 'Internet', 'Active'),
(5, 'CableTV', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `database_mgmt`
--
ALTER TABLE `database_mgmt`
  ADD PRIMARY KEY (`database_id`);

--
-- Indexes for table `password_reset_temp`
--
ALTER TABLE `password_reset_temp`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `payment_type_id` (`payment_type_id`),
  ADD KEY `utility_type_id` (`utility_type_id`) USING BTREE,
  ADD KEY `utility_id` (`utility_id`);

--
-- Indexes for table `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`payment_type_id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`property_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `property_type_id` (`property_type_id`);

--
-- Indexes for table `property_type`
--
ALTER TABLE `property_type`
  ADD PRIMARY KEY (`property_type_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `utility`
--
ALTER TABLE `utility`
  ADD PRIMARY KEY (`utility_id`),
  ADD KEY `property_id` (`user_id`),
  ADD KEY `utility_type_id` (`utility_type_id`) USING BTREE;

--
-- Indexes for table `utility_type`
--
ALTER TABLE `utility_type`
  ADD PRIMARY KEY (`utility_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `database_mgmt`
--
ALTER TABLE `database_mgmt`
  MODIFY `database_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `payment_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `property_type`
--
ALTER TABLE `property_type`
  MODIFY `property_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `utility`
--
ALTER TABLE `utility`
  MODIFY `utility_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `utility_type`
--
ALTER TABLE `utility_type`
  MODIFY `utility_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD CONSTRAINT `activity_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `password_reset_temp`
--
ALTER TABLE `password_reset_temp`
  ADD CONSTRAINT `password_reset_temp_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `payment_ibfk_3` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_type` (`payment_type_id`),
  ADD CONSTRAINT `payment_ibfk_4` FOREIGN KEY (`utility_type_id`) REFERENCES `utility_type` (`utility_type_id`),
  ADD CONSTRAINT `payment_ibfk_5` FOREIGN KEY (`utility_id`) REFERENCES `utility` (`utility_id`);

--
-- Constraints for table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `property_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `property_ibfk_2` FOREIGN KEY (`property_type_id`) REFERENCES `property_type` (`property_type_id`);

--
-- Constraints for table `utility`
--
ALTER TABLE `utility`
  ADD CONSTRAINT `utility_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `utility_ibfk_2` FOREIGN KEY (`utility_type_id`) REFERENCES `utility_type` (`utility_type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
