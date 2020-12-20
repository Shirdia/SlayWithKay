-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2020 at 12:09 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart_tagging_system`
--
CREATE DATABASE IF NOT EXISTS `smart_tagging_system` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `smart_tagging_system`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` varchar(24) NOT NULL,
  `admin_username` varchar(15) NOT NULL,
  `admin_email` varchar(30) NOT NULL,
  `admin_phone` int(10) NOT NULL,
  `admin_password` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_email`, `admin_phone`, `admin_password`) VALUES
('admin', 'admin', 'admin@admin.com', 2147483647, '$2y$10$wWXuNLHHnkVSqEPkXJAEwefyKZTADeregCq/5Ryz2nFUw.oAo6Jca'),
('jerryenuh', 'jerryenuh', 'jerryenuh@gmail.com', 5555555, '$2y$10$IH//DA5D7eK/Mz9ZxjJ4v.ONzu.Vj6zNXqGgZQLpHI.zhs.m98R1G');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `service_name` varchar(100) NOT NULL,
  `service_status` varchar(15) NOT NULL,
  `service_price` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`service_name`, `service_status`, `service_price`) VALUES
('Weddings(Bridesmaids)', 'Booked', 9000);

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE `record` (
  `record_id` int(11) NOT NULL,
  `record_start` varchar(10) DEFAULT NULL,
  `record_end` varchar(10) DEFAULT NULL,
  `record_price` int(11) DEFAULT NULL,
  `record_status` varchar(10) NOT NULL DEFAULT 'pending',
  `record_sub` varchar(10) NOT NULL DEFAULT 'expired',
  `record_approved_by` varchar(15) NOT NULL,
  `client_name` varchar(15) NOT NULL,
  `service_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`record_id`, `record_start`, `record_end`, `record_price`, `record_status`, `record_sub`, `record_approved_by`, `client_name`, `service_name`) VALUES
(27, '2020-12-21', '2020-12-23', 2, 'approved', 'active', 'admin', 'jerryenuh', 'Weddings(Brides');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(15) NOT NULL,
  `user_username` varchar(15) NOT NULL,
  `user_pwd` char(70) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_username`, `user_pwd`, `user_name`, `user_email`, `user_phone`) VALUES
('jerryenuh', 'jerryenuh', '$2y$10$Mho9Sl.hJ54SAcTXvvaz0eEyv4ttm/FSP2gclypI1r8Ocmx60bJ16', 'jerryenuh', 'jerryenuh@gmail.com', '8763984607`'),
('test', 'test', '$2y$10$S39Rq4Oa6acKgx4.YtSOg.wP4b8fGGRFhsnoXWmSrqgHWJ9X2u1Xa', 'test', 'test@test.com', '6363636377');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`service_name`);

--
-- Indexes for table `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `record`
--
ALTER TABLE `record`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
