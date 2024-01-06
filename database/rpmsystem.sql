-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2024 at 01:43 PM
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
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `user_id`, `utility_type_id`, `is_cash_advance`, `is_cash_deposit`, `payment_type_id`, `payment_amount`, `payment_remaining`, `payment_reference`, `payment_date`, `payment_status`, `payment_comment`, `status`) VALUES
(1, 5, 1, 0, 0, 1, 3000.00, 2000.00, '', '2023-12-11 01:59:05', 'Partial', '', 'Active'),
(2, 9, 1, 0, 0, 1, 5000.00, 0.00, '', '2023-12-11 10:05:34', 'Paid', '', 'Archive'),
(3, 9, 2, 0, 0, 1, 250.00, 750.00, '', '2023-12-11 02:26:28', 'Partial', '', 'Active'),
(4, 9, 3, 0, 0, 2, 200.00, 0.00, '12345678', '2023-12-11 02:29:19', 'Paid', '', 'Active'),
(5, 9, 1, 0, 0, 2, 5000.00, 0.00, '87654321', '2023-12-11 02:33:16', 'Paid', '', 'Active'),
(6, 11, 1, 0, 0, 1, 500.00, 4500.00, '', '2023-12-11 02:54:23', 'Partial', '', 'Active'),
(7, 12, 1, 0, 0, 2, 8000.00, 0.00, '018736', '2023-12-12 02:16:19', 'Partial', '', 'Archive'),
(8, 12, 1, 1, 0, 1, 5000.00, 0.00, '', '2023-12-12 02:38:37', '', '', 'Archive'),
(9, 12, 1, 1, 0, 1, 89500.00, -79000.00, '', '2023-12-12 02:40:10', 'Paid', '', 'Active');

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
(2, 'Gcash', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `property_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `property_unit_code` varchar(255) NOT NULL,
  `property_location` varchar(255) NOT NULL,
  `property_type_id` int(11) NOT NULL,
  `property_amount` double(11,2) NOT NULL,
  `property_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`property_id`, `user_id`, `property_unit_code`, `property_location`, `property_type_id`, `property_amount`, `property_status`) VALUES
(1, 6, 'Door 1 Green', 'Corrales', 1, 5000.00, 'Archive'),
(2, 2, 'Door 2 Black', 'Corrales', 1, 5000.00, 'Reserve'),
(3, 2, 'Door 3 Green', 'Corrales', 1, 5000.00, 'Available'),
(4, 3, 'Door 1 Grey', 'Butuay', 2, 2500.00, 'Rented'),
(5, 3, 'Door 2 Silver', 'Butuay', 2, 2500.00, 'Renovating'),
(6, 3, 'Door 3 Red', 'Corrales', 2, 10500.00, 'Rented'),
(7, 6, 'Door Blue', 'Rizal', 1, 5000.00, 'Rented'),
(8, 2, 'Door 3 Green', 'Corrales', 1, 5000.00, 'Archive'),
(9, 2, 'Door 1', 'Corrales', 1, 5000.00, 'Rented');

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
(1, 'Apartment', 'Inactive'),
(2, 'Boarding House', 'Active'),
(3, 'Residential Space', 'Active');

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
  `balance` double(11,2) NOT NULL,
  `status` varchar(250) NOT NULL,
  `type` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fname`, `mname`, `lname`, `suffix`, `gender`, `address`, `civil_status`, `birthday`, `occupation`, `company`, `valid_id`, `profile`, `email`, `phone`, `password`, `is_rented`, `balance`, `status`, `type`) VALUES
(1, 'user', '', 'admin', '', '', '', '', '0000-00-00', '', '', '', '', 'admin@gmail.com', '', 'admin', 0, 0.00, 'Active', 'Admin'),
(2, 'Jaylord', '', 'Galindo', ' ', 'Male', '', '', '0000-00-00', '', '', '', '', 'jayjayjaylord16@gmail.com', '0906355', 'jaylord', 0, 0.00, 'Active', 'Staff'),
(3, 'Riza Mae', '', 'Trestiza', ' ', 'Female', 'sadasdasd', '', '0000-00-00', '', '', '', '', 'trestizarizamae@gmail.com', '09061269981', 'riza', 0, 0.00, 'Active', 'Staff'),
(4, 'John Mark', '', 'Ebarat', ' ', 'Male', 'sadsadsa', 'Single', '0000-00-00', '', '', 'ID_20231231_144829.png', '', 'john@gmail.com', '09524856482', 'john', 1, 0.00, 'Active', 'Renter'),
(5, 'Marilou', '', 'Nobleza', 'I', 'Female', '', '', '2024-01-08', '', '', '', '', 'marilou@gmail.com', '09543854685', 'marilou', 0, 0.00, 'Active', 'Renter'),
(6, 'Nica', '', 'Nica Ogapay', ' ', 'Female', '', '', '0000-00-00', '', '', '', '', 'nica@gmail.com', '09954844898', 'nica', 0, 0.00, 'Active', 'Staff'),
(7, 'Abigail', '', 'Maghuyop', ' ', 'Female', '', '', '0000-00-00', '', '', '', '', 'abigail@gmail.com', '09554856548', 'abigail', 0, 0.00, 'Active', 'Renter'),
(8, 'Judielyn', 'Trestiza', 'Cualbar', ' ', 'Female', '', '', '0000-00-00', '', '', '', '', 'judielyn.cualbar@ustp.edu.ph', '09171234794', 'jud@123', 0, 0.00, 'Active', 'Admin'),
(9, 'Judielyn', 'Cualbar', 'Trestiza', ' ', 'Male', '', '', '0000-00-00', '', '', '', '', 'judielyn.cualbar2@gmail.com', '09171234794', 'judielyn@123', 1, 0.00, 'Active', 'Renter'),
(10, 'Glyza', 'Mae T.', 'Lomo', ' ', 'Female', '', '', '0000-00-00', '', '', '', '', 'glyzamae2@gmail.com', '09171475542', 'glyza@123', 0, 0.00, 'Archive', 'Renter'),
(11, 'Glyza Mae', 'Trestiza', 'Lomo', ' ', 'Female', '', '', '0000-00-00', '', '', '', '', 'glyzamae2@gmail.com', '09171475542', 'glyza@123', 1, 0.00, 'Active', 'Renter'),
(12, 'Lady Key', 'Basan ', 'Bancale', ' ', 'Female', '', 'Single', '0000-00-00', '', '', '', '', 'ladykeyb@gmail.com', '0963 925 87', 'ladykey', 1, 0.00, 'Active', 'Renter'),
(13, 'sadasdasd', '', 'asdsadas', ' ', 'Male', 'asdasdasdasd', '', '0000-00-00', 'asdasdasd', 'asdasd', 'ID_20231224_154707.jpg', '', 'admin1@gmail.com', '09457664949', 'admin123', 0, 0.00, 'Active', 'Renter'),
(14, 'sadsad', '', 'sadsadsa', 'Sr', 'Male', '', '', '0000-00-00', '', '', 'ID_20231231_080926.png', '', 'brock@growecommerce.com', '09342343253', 'admin123', 0, 0.00, 'Active', 'Admin'),
(15, 'asdsad', '', 'asdasd', ' ', 'Male', '', '', '0000-00-00', '', '', 'ID_20231231_084110.png', '', 'brock@growecommerce.com', '09457664949', 'admin123', 0, 0.00, 'Active', 'Admin');

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
  `is_payment_made` int(11) NOT NULL,
  `utility_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utility`
--

INSERT INTO `utility` (`utility_id`, `user_id`, `utility_type_id`, `utility_amount`, `utility_date`, `is_payment_made`, `utility_status`) VALUES
(1, 9, 2, '1000.00', '2023-12-11 10:06:10', 2, 'Active'),
(2, 9, 3, '250.00', '2023-12-11 02:28:27', 1, 'Active'),
(3, 5, 2, '300.00', '2023-12-13 02:58:56', 0, 'Active');

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
(2, 'Electricity', 'Inactive'),
(3, 'Water', 'Active'),
(4, 'Penalty', 'Active');

--
-- Indexes for dumped tables
--

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
  ADD KEY `utility_type_id` (`utility_type_id`) USING BTREE;

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
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `payment_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `property_type`
--
ALTER TABLE `property_type`
  MODIFY `property_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `utility`
--
ALTER TABLE `utility`
  MODIFY `utility_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `utility_type`
--
ALTER TABLE `utility_type`
  MODIFY `utility_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

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
  ADD CONSTRAINT `payment_ibfk_4` FOREIGN KEY (`utility_type_id`) REFERENCES `utility_type` (`utility_type_id`);

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
