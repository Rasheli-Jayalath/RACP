-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 26, 2022 at 12:13 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `racp`
--

-- --------------------------------------------------------

--
-- Table structure for table `mis_tbl_users`
--

DROP TABLE IF EXISTS `mis_tbl_users`;
CREATE TABLE IF NOT EXISTS `mis_tbl_users` (
  `user_cd` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `passwd` varchar(32) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `last_login_date` datetime DEFAULT NULL,
  `member_cd` int(10) DEFAULT '0',
  `user_type` varchar(20) DEFAULT NULL,
  `is_active` int(11) DEFAULT '1',
  `lang_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_cd`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mis_tbl_users`
--

INSERT INTO `mis_tbl_users` (`user_cd`, `username`, `passwd`, `first_name`, `middle_name`, `last_name`, `email`, `phone`, `designation`, `last_login_date`, `member_cd`, `user_type`, `is_active`, `lang_id`) VALUES
(1, 'administrator', 'admin@2019', 'Super Administrator', NULL, '.', 'Abdul.Waqar@smec.com', '', '', NULL, 0, '1', 1, 0),
(2, 'abc', '1234', 'Mansha', NULL, NULL, 'Faisal.Watto@smec.com', '123', NULL, NULL, 0, '2', 1, NULL),
(3, 'abc', '1234', 'Mobina', NULL, NULL, 'Faisal.Watto@smec.com', '123', NULL, NULL, 0, '2', 1, NULL),
(4, 'abc1', '12341', 'Mansha', NULL, NULL, 'Toliha.Kud1ratova@smec.com', '123', NULL, NULL, 0, '2', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_administrator`
--

DROP TABLE IF EXISTS `tbl_administrator`;
CREATE TABLE IF NOT EXISTS `tbl_administrator` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_administrator`
--

INSERT INTO `tbl_administrator` (`a_id`, `name`, `email`, `password`, `userName`) VALUES
(1, 'MC200401728', 'mussawar@yahoo.com', '1234', 'MC200401728');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

DROP TABLE IF EXISTS `tbl_booking`;
CREATE TABLE IF NOT EXISTS `tbl_booking` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `detail` text NOT NULL,
  `bookingDate` date NOT NULL,
  `returnDate` date NOT NULL,
  `b_status` varchar(200) NOT NULL DEFAULT 'pending',
  `posting_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`b_id`),
  KEY `c_id` (`c_id`),
  KEY `car_id` (`car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_car`
--

DROP TABLE IF EXISTS `tbl_car`;
CREATE TABLE IF NOT EXISTS `tbl_car` (
  `car_id` int(11) NOT NULL AUTO_INCREMENT,
  `cc_id` int(11) DEFAULT NULL,
  `car_name` varchar(200) DEFAULT NULL,
  `car_model` varchar(100) DEFAULT NULL,
  `car_description` text,
  `car_plateno` varchar(100) DEFAULT NULL,
  `air_conditioned` varchar(10) DEFAULT 'No',
  `no_seats` varchar(255) DEFAULT NULL,
  `car_price_perday` double DEFAULT NULL,
  `car_price_without_driver` double DEFAULT NULL,
  `image1` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `pickup_location` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`car_id`),
  KEY `cc_id` (`cc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_car`
--

INSERT INTO `tbl_car` (`car_id`, `cc_id`, `car_name`, `car_model`, `car_description`, `car_plateno`, `air_conditioned`, `no_seats`, `car_price_perday`, `car_price_without_driver`, `image1`, `image2`, `pickup_location`) VALUES
(3, 2, 'civic', '1234', 'detail heredetail heredetail here  detail here detail here detail here detail here detail here detail here detail here', 'LRC123', 'No', '5', 2000, 1500, '39e80-3_d2.jpg', 'f0b5e-3_d2.jpg', '1500'),
(4, 1, 'Liana', '2000', 'test testt est test   test testt est test   test testt est test   test testt est test   test testt est test   test testt est test   test testt est test   test testt est test   test testt est test   test testt est test', 'LRC678', 'No', '5', 5000, 3000, '65555-4_d1.jpg', '40d8d-4_d1.jpg', '3000'),
(5, 2, 'Mehran', '1998', 'test testt est test   test testt est test   test testt est test   test testt est test   test testt est test   test testt est test   test testt est test   test testt est test   test testt est test   test testt est test', 'LRC648', 'No', '5', 5000, 3000, '6256b-5_d2.png', 'e8345-5_d2.jpg', '3000'),
(6, 1, 'Mehran', '1998', 'test testt est test   test testt est test   test testt est test   test testt est test   test testt est test   test testt est test   test testt est test   test testt est test   test testt est test   test testt est test', 'LRC648', 'No', '1', 5000, 3000, '8e574-6_d1.jpg', '9195c-6_d1.jpg', 'lahore'),
(7, 1, 'Mehran', '1998', 'test testt est test   test testt est test   test testt est test   test testt est test   test testt est test   test testt est test   test testt est test   test testt est test   test testt est test   test testt est test', 'LRC648', 'No', '1', 5000, 3000, '30d80-7_d1.jpg', '8d328-7_d1.jpg', 'lahore'),
(8, 1, 'Mehran', '1998', 'test testt est test test testt est test test testt est test test testt est test test testt est test test testt est test test testt est test test testt est test test testt est test test testt est test', 'LRC678', 'No', '1', 5000, 3000, '34f1c-8_d1.jpg', 'a25cd-8_d1.jpg', 'lahore'),
(9, 1, 'Mehran', '1998', 'test testt est test   test testt est test   test testt est test   test testt est test   test testt est test   test testt est test   test testt est test   test testt est test   test testt est test   test testt est test', 'LRC678', 'No', '1', 5000, 3000, '104b3-9_d1.jpg', '3f24e-9_d1.jpg', '3000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_carcompany`
--

DROP TABLE IF EXISTS `tbl_carcompany`;
CREATE TABLE IF NOT EXISTS `tbl_carcompany` (
  `cc_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) DEFAULT NULL,
  `owner_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `account_detail` varchar(255) DEFAULT NULL,
  `verifying_status` varchar(1) DEFAULT 'N',
  PRIMARY KEY (`cc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_carcompany`
--

INSERT INTO `tbl_carcompany` (`cc_id`, `company_name`, `owner_name`, `address`, `email`, `mobile_no`, `userName`, `password`, `account_detail`, `verifying_status`) VALUES
(1, 'Smec', 'Mobina', 'fggtr', 'Faisal.Watto@smec.com', '123', 'abc', '1234', '43546', 'Y'),
(2, 'Smec', 'Mansha', 'dsf', 'Toliha.Kud1ratova@smec.com', '123', 'abc1', '12341', '43546', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

DROP TABLE IF EXISTS `tbl_customer`;
CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `cName` varchar(255) NOT NULL,
  `cEmail` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile_no` varchar(30) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cnic` varchar(255) NOT NULL,
  `upload_cnic` varchar(255) NOT NULL,
  `upload_pic` varchar(255) NOT NULL,
  `activation_code` varchar(255) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`c_id`, `cName`, `cEmail`, `address`, `mobile_no`, `userName`, `password`, `cnic`, `upload_cnic`, `upload_pic`, `activation_code`) VALUES
(1, 'Waqar', 'amwaqar@gmail.com', '1231wdqwdqw', '1234567890', 'waqar', '1234', '1234567890123', 'abc.jpg', 'def.jpg', '1234'),
(2, 'aaaa aaaa', 'aaaa@aaaa.com', 'abcdef', '1234567890', 'aaaa', 'aaaa', '22', '1', 'cnic.jpg', '2355');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customerexperience`
--

DROP TABLE IF EXISTS `tbl_customerexperience`;
CREATE TABLE IF NOT EXISTS `tbl_customerexperience` (
  `ce_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `comments` text NOT NULL,
  `ratting` int(11) NOT NULL,
  PRIMARY KEY (`ce_id`),
  KEY `c_id` (`c_id`),
  KEY `b_id` (`b_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_documents_car`
--

DROP TABLE IF EXISTS `tbl_documents_car`;
CREATE TABLE IF NOT EXISTS `tbl_documents_car` (
  `dc_id` int(11) NOT NULL AUTO_INCREMENT,
  `car_id` int(11) DEFAULT NULL,
  `doc_title` varchar(255) DEFAULT NULL,
  `submitted_on` date DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `remarks` text,
  PRIMARY KEY (`dc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_documents_car`
--

INSERT INTO `tbl_documents_car` (`dc_id`, `car_id`, `doc_title`, `submitted_on`, `file_name`, `remarks`) VALUES
(1, 3, 'test', '2022-05-26', 'b988d-.jpg', 'dhfghfhsfd'),
(3, 3, 'fdfds121', '2022-05-26', 'd5929-3.pdf', 'asdsa12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_documents_dealer`
--

DROP TABLE IF EXISTS `tbl_documents_dealer`;
CREATE TABLE IF NOT EXISTS `tbl_documents_dealer` (
  `d_id` int(11) NOT NULL AUTO_INCREMENT,
  `cc_id` int(11) DEFAULT NULL,
  `doc_title` varchar(255) DEFAULT NULL,
  `submitted_on` date DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `remarks` text,
  PRIMARY KEY (`d_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_documents_dealer`
--

INSERT INTO `tbl_documents_dealer` (`d_id`, `cc_id`, `doc_title`, `submitted_on`, `file_name`, `remarks`) VALUES
(1, 1, 'test', '2022-05-26', 'd2f59-1.jpg', 'fsdfdssf eferge te'),
(2, 1, 'test1112', '2022-05-26', '0b0f2-1.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

DROP TABLE IF EXISTS `tbl_payment`;
CREATE TABLE IF NOT EXISTS `tbl_payment` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  PRIMARY KEY (`p_id`),
  KEY `b_id` (`b_id`),
  KEY `c_id` (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD CONSTRAINT `tbl_booking_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `tbl_customer` (`c_id`),
  ADD CONSTRAINT `tbl_booking_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `tbl_car` (`car_id`);

--
-- Constraints for table `tbl_customerexperience`
--
ALTER TABLE `tbl_customerexperience`
  ADD CONSTRAINT `tbl_customerexperience_ibfk_2` FOREIGN KEY (`b_id`) REFERENCES `tbl_booking` (`b_id`);

--
-- Constraints for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD CONSTRAINT `tbl_payment_ibfk_1` FOREIGN KEY (`b_id`) REFERENCES `tbl_booking` (`b_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
