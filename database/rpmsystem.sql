-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2023 at 02:20 PM
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
  `payment_type_id` int(11) NOT NULL,
  `payment_amount` double(11,2) NOT NULL,
  `payment_remaining` double(11,2) NOT NULL,
  `payment_reference` varchar(255) NOT NULL,
  `payment_date` datetime NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `user_id`, `utilities_type_id`, `payment_type_id`, `payment_amount`, `payment_remaining`, `payment_reference`, `payment_date`, `payment_status`, `status`) VALUES
(6, 5, 1, 1, 4000.00, 1000.00, '', '2023-12-05 11:55:14', 'Partial', 'Active'),
(7, 5, 2, 1, 250.00, 250.00, '', '2023-12-05 11:55:46', 'Partial', 'Active'),
(8, 6, 1, 1, 1500.00, 3500.00, '', '2023-12-05 06:08:44', 'Partial', 'Archive');

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
(2, 'GCash', 'Active'),
(3, 'Maya', 'Active');

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
  `property_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`property_id`, `user_id`, `rented_by`, `property_unit_code`, `property_location`, `property_type_id`, `property_amount`, `date_rented`, `property_status`) VALUES
(1, 3, 5, 'Door 1 Green', 'Butuay', 1, 5000.00, '2023-12-02', 'Rented'),
(2, 3, 6, 'Door 2 Yellow', 'Butuay', 1, 5000.00, '2023-12-01', 'Rented'),
(3, 3, 0, 'Door 3 Red', 'Butuay', 1, 5000.00, '0000-00-00', 'Available'),
(4, 3, 0, 'Door 4 Orange', 'Butuay', 1, 5000.00, '0000-00-00', 'Renovating'),
(5, 4, 0, 'Door 1 Black', 'Corrales', 2, 2500.00, '0000-00-00', 'Available'),
(6, 4, 0, 'Door 2 Pink', 'Corrales', 2, 2500.00, '0000-00-00', 'Available'),
(7, 4, 7, 'Door 3 Green', 'Corrales', 2, 2500.00, '2023-12-04', 'Rented'),
(8, 4, 0, 'Door 4 Silver', 'Corrales', 2, 2500.00, '0000-00-00', 'Renovating');

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
  `status` varchar(7) NOT NULL,
  `type` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fname`, `mname`, `lname`, `suffix`, `gender`, `email`, `phone`, `password`, `status`, `type`) VALUES
(1, 'user', '', 'admin', '', '', 'admin@gmail.com', '', '21232f297a57a5a743894a0e4a801fc3', 'Active', 'Admin'),
(2, 'Riza', '', 'Mae', '', 'Female', 'riza@gmail.com', '09123456789', '21232f297a57a5a743894a0e4a801fc3', 'Active', 'Admin'),
(3, 'Jay Lord', '', 'Galindo', '', 'Male', 'jaylord@gmail.com', '09123456781', '21232f297a57a5a743894a0e4a801fc3', 'Active', 'Staff'),
(4, 'Nica', '', 'Ogapay', '', 'Female', 'nica@gmail.com', '09123456782', '21232f297a57a5a743894a0e4a801fc3', 'Active', 'Staff'),
(5, 'Joshua', '', 'Ebarat', '', 'Male', 'joshua@gmail.com', '09435576491', '21232f297a57a5a743894a0e4a801fc3', 'Active', 'Renter'),
(6, 'Princess', '', 'Galindo', '', 'Female', 'princess@gmail.com', '09664582138', '21232f297a57a5a743894a0e4a801fc3', 'Active', 'Renter'),
(7, 'Jerome', 'Ambe', 'Maghuyop', '', 'Male', 'jerome@gmail.com', '09431256884', '21232f297a57a5a743894a0e4a801fc3', 'Active', 'Renter');

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
  `utilities_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilities`
--

INSERT INTO `utilities` (`utilities_id`, `user_id`, `utilities_type_id`, `utilities_amount`, `utilities_date`, `utilities_status`) VALUES
(1, 5, 2, '500.00', '2023-12-05 11:38:53', 'Active'),
(2, 5, 3, '100.00', '2023-12-05 12:49:32', 'Active');

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
(3, 'Water', 'Active');

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
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `payment_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `property_type`
--
ALTER TABLE `property_type`
  MODIFY `property_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `utilities`
--
ALTER TABLE `utilities`
  MODIFY `utilities_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `utilities_type`
--
ALTER TABLE `utilities_type`
  MODIFY `utilities_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
