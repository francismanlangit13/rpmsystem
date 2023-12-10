-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2023 at 05:16 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `utilities_type_id` int(11) NOT NULL,
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
  `rented_by` int(11) NOT NULL,
  `property_unit_code` varchar(255) NOT NULL,
  `property_location` varchar(255) NOT NULL,
  `property_type_id` int(11) NOT NULL,
  `property_amount` double(11,2) NOT NULL,
  `date_rented` date NOT NULL,
  `property_cash_advance` double(11,2) NOT NULL,
  `property_cash_deposit` double(11,2) NOT NULL,
  `property_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`property_id`, `user_id`, `rented_by`, `property_unit_code`, `property_location`, `property_type_id`, `property_amount`, `date_rented`, `property_cash_advance`, `property_cash_deposit`, `property_status`) VALUES
(1, 2, 5, 'Door 1 Green', 'Corrales', 1, 5000.00, '2023-12-05', 5000.00, 2000.00, 'Rented'),
(2, 2, 0, 'Door 2 Black', 'Corrales', 1, 5000.00, '0000-00-00', 0.00, 0.00, 'Reserve'),
(3, 2, 0, 'Door 3 Green', 'Corrales', 1, 5000.00, '0000-00-00', 0.00, 0.00, 'Available'),
(4, 3, 4, 'Door 1 Grey', 'Butuay', 2, 2500.00, '2023-12-09', 2500.00, 1000.00, 'Rented'),
(5, 3, 0, 'Door 2 Silver', 'Butuay', 2, 2500.00, '0000-00-00', 0.00, 0.00, 'Renovating'),
(6, 3, 0, 'Door 3 Red', 'Corrales', 2, 2500.00, '0000-00-00', 0.00, 0.00, 'Available');

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
  `email` varchar(50) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_rented` int(11) NOT NULL,
  `status` varchar(250) NOT NULL,
  `type` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fname`, `mname`, `lname`, `suffix`, `gender`, `email`, `phone`, `password`, `is_rented`, `status`, `type`) VALUES
(1, 'user', '', 'admin', '', '', 'admin@gmail.com', '', 'admin', 0, 'Active', 'Admin'),
(2, 'Jaylord', '', 'Galindo', ' ', 'Male', 'jayjayjaylord16@gmail.com', '09063554173', 'jaylord', 0, 'Active', 'Staff'),
(3, 'Riza Mae', '', 'Trestiza', ' ', 'Female', 'trestizarizamae@gmail.com', '09061269981', 'riza', 0, 'Active', 'Staff'),
(4, 'John Mark', '', 'Ebarat', ' ', 'Male', 'john@gmail.com', '09524856482', 'john', 1, 'Active', 'Renter'),
(5, 'Marilou', '', 'Nobleza', 'I', 'Female', 'marilou@gmail.com', '09543854685', 'marilou', 1, 'Active', 'Renter'),
(6, 'Nica', '', 'Nica Ogapay', ' ', 'Female', 'nica@gmail.com', '09954844898', 'nica', 0, 'Active', 'Staff'),
(7, 'Abigail', '', 'Maghuyop', ' ', 'Female', 'abigail@gmail.com', '09554856548', 'abigail', 0, 'Active', 'Renter');

-- --------------------------------------------------------

--
-- Table structure for table `utilities`
--

CREATE TABLE `utilities` (
  `utilities_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `utilities_type_id` int(11) NOT NULL,
  `utilities_amount` decimal(11,2) NOT NULL,
  `utilities_date` datetime NOT NULL,
  `is_payment_made` int(11) NOT NULL,
  `utilities_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `utilities_type`
--

CREATE TABLE `utilities_type` (
  `utilities_type_id` int(11) NOT NULL,
  `utilities_type_name` varchar(255) NOT NULL,
  `utilities_type_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilities_type`
--

INSERT INTO `utilities_type` (`utilities_type_id`, `utilities_type_name`, `utilities_type_status`) VALUES
(1, 'Rent', 'Active'),
(2, 'Electricity', 'Active'),
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
  ADD KEY `utilities_type_id` (`utilities_type_id`) USING BTREE;

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
-- Indexes for table `utilities`
--
ALTER TABLE `utilities`
  ADD PRIMARY KEY (`utilities_id`),
  ADD KEY `property_id` (`user_id`),
  ADD KEY `utilities_type_id` (`utilities_type_id`);

--
-- Indexes for table `utilities_type`
--
ALTER TABLE `utilities_type`
  ADD PRIMARY KEY (`utilities_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `payment_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `property_type`
--
ALTER TABLE `property_type`
  MODIFY `property_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `utilities`
--
ALTER TABLE `utilities`
  MODIFY `utilities_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utilities_type`
--
ALTER TABLE `utilities_type`
  MODIFY `utilities_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  ADD CONSTRAINT `payment_ibfk_4` FOREIGN KEY (`utilities_type_id`) REFERENCES `utilities_type` (`utilities_type_id`);

--
-- Constraints for table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `property_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `property_ibfk_2` FOREIGN KEY (`property_type_id`) REFERENCES `property_type` (`property_type_id`);

--
-- Constraints for table `utilities`
--
ALTER TABLE `utilities`
  ADD CONSTRAINT `utilities_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `utilities_ibfk_2` FOREIGN KEY (`utilities_type_id`) REFERENCES `utilities_type` (`utilities_type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
