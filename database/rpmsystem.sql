-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2023 at 07:02 PM
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
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `ann_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ann_description` varchar(255) NOT NULL,
  `ann_date` datetime NOT NULL,
  `ann_stauts` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE `contract` (
  `contract_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `property_location` varchar(255) NOT NULL,
  `property_unit_code` varchar(255) NOT NULL,
  `occupant1` varchar(255) NOT NULL,
  `occupant2` varchar(255) NOT NULL,
  `occupant3` varchar(255) NOT NULL,
  `occupant4` varchar(255) NOT NULL,
  `permanent_address` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `contract_start` date NOT NULL,
  `contract_end` date NOT NULL,
  `monthly_rent` decimal(11,2) NOT NULL,
  `contract_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contract`
--

INSERT INTO `contract` (`contract_id`, `user_id`, `property_location`, `property_unit_code`, `occupant1`, `occupant2`, `occupant3`, `occupant4`, `permanent_address`, `phone`, `contract_start`, `contract_end`, `monthly_rent`, `contract_status`) VALUES
(1, 4, 'Carmen', '1012', '', '', '', '', 'Naga, Jimenez', '09123454755', '2023-11-29', '2024-11-29', '5000.00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `utilities_id` int(11) NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `payment_amount` double(11,2) NOT NULL,
  `payment_remaining` double(11,2) NOT NULL,
  `payment_reference` varchar(255) NOT NULL,
  `payment_date` datetime NOT NULL,
  `payment_status` varchar(255) NOT NULL,
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
(1, 'Cash', 'Active');

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
  `billing_date` date NOT NULL,
  `date_rented` date NOT NULL,
  `property_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`property_id`, `user_id`, `rented_by`, `property_unit_code`, `property_location`, `property_type_id`, `property_amount`, `billing_date`, `date_rented`, `property_status`) VALUES
(1, 3, 4, '123', 'Carmen', 1, 123.00, '0000-00-00', '0000-00-00', 'Active');

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
(1, 'Apartment', 'Active');

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
  `balance` double(11,2) NOT NULL,
  `status` varchar(7) NOT NULL,
  `type` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fname`, `mname`, `lname`, `suffix`, `gender`, `email`, `phone`, `password`, `balance`, `status`, `type`) VALUES
(1, 'user', '', 'admin', '', '', 'admin@gmail.com', '09124746385', '21232f297a57a5a743894a0e4a801fc3', 0.00, 'Active', 'Admin'),
(2, 'Riza Mae', '', '122', '', 'Male', 'riza@gmail.com', '', '21232f297a57a5a743894a0e4a801fc3', 0.00, 'Active', 'Admin'),
(3, 'Jaylord', '', 'Galindo', '', 'Male', 'jaylordgalindo@gmail.com', '', '21232f297a57a5a743894a0e4a801fc3', 0.00, 'Active', 'Staff'),
(4, 'Nica', '', 'Ogapay', '', 'Female', 'nica12@gmail.com', '', '21232f297a57a5a743894a0e4a801fc3', 0.00, 'Active', 'Renter'),
(10, '', '', '', '', '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', 0.00, 'Archive', 'Renter');

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
(2, 'Internet', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`ann_id`);

--
-- Indexes for table `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`contract_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `utilities_id` (`utilities_id`),
  ADD KEY `payment_type_id` (`payment_type_id`);

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
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `ann_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contract`
--
ALTER TABLE `contract`
  MODIFY `contract_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `payment_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `property_type`
--
ALTER TABLE `property_type`
  MODIFY `property_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `utilities`
--
ALTER TABLE `utilities`
  MODIFY `utilities_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utilities_type`
--
ALTER TABLE `utilities_type`
  MODIFY `utilities_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contract`
--
ALTER TABLE `contract`
  ADD CONSTRAINT `contract_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`utilities_id`) REFERENCES `utilities` (`utilities_id`),
  ADD CONSTRAINT `payment_ibfk_3` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_type` (`payment_type_id`);

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
