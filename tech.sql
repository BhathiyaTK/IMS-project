-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 28, 2019 at 11:27 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tech`
--

-- --------------------------------------------------------

--
-- Table structure for table `added_inventory`
--

DROP TABLE IF EXISTS `added_inventory`;
CREATE TABLE IF NOT EXISTS `added_inventory` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `main_location` varchar(100) NOT NULL,
  `sub_location` varchar(100) NOT NULL,
  `main_inventory_type` varchar(100) NOT NULL,
  `sub_inventory_type` varchar(100) NOT NULL,
  `main_inventory_code` varchar(225) NOT NULL,
  `inventory_code` varchar(225) NOT NULL,
  `serial_number` varchar(225) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `price` varchar(225) NOT NULL,
  `purchased_date` varchar(225) NOT NULL,
  `year` varchar(100) NOT NULL,
  `status` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `main_locations`
--

DROP TABLE IF EXISTS `main_locations`;
CREATE TABLE IF NOT EXISTS `main_locations` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `location_code` varchar(100) NOT NULL,
  `location_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_locations`
--

INSERT INTO `main_locations` (`id`, `location_code`, `location_name`) VALUES
(6, 'BT', 'Department of Bio Systems Technology'),
(5, 'DO', 'Dean\'s Office'),
(7, 'ET', 'Department of Engineering Technology'),
(8, 'PIU', 'STHRD Project(PIU)'),
(10, 'CIS', 'Department of Computing & Information Systems');

-- --------------------------------------------------------

--
-- Table structure for table `recovered_inventory`
--

DROP TABLE IF EXISTS `recovered_inventory`;
CREATE TABLE IF NOT EXISTS `recovered_inventory` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `main_location` varchar(225) NOT NULL,
  `sub_location` varchar(225) NOT NULL,
  `main_inventory_type` varchar(200) NOT NULL,
  `sub_inventory_type` varchar(200) NOT NULL,
  `inventory_code` varchar(225) NOT NULL,
  `serial_number` varchar(225) NOT NULL,
  `quantity` varchar(200) NOT NULL,
  `price` varchar(225) NOT NULL,
  `purchased_date` varchar(100) NOT NULL,
  `status` varchar(225) NOT NULL,
  `reason` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sub_locations`
--

DROP TABLE IF EXISTS `sub_locations`;
CREATE TABLE IF NOT EXISTS `sub_locations` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `main_location_code` varchar(100) NOT NULL,
  `location_code` varchar(150) NOT NULL,
  `location_name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_locations`
--

INSERT INTO `sub_locations` (`id`, `main_location_code`, `location_code`, `location_name`) VALUES
(1, 'BT', 'NB01', 'Dr. Sarath Bandara'),
(2, 'BT', 'NB02', 'Department of Bio Systems'),
(3, 'DO', 'NB03', 'Dean\'s Office'),
(4, 'BT', 'NB04', 'Dr. Sandun Perera'),
(5, 'DO', 'NB05', 'Mr. D.S.R.C.Sawanawadu (Asst.Registrar)'),
(6, 'DO', 'NB09', 'Dr. A.D.Ampitiyawatta (Office of the Dean)'),
(7, 'ET', 'NB10', 'Physics Laboratory'),
(8, 'ET', 'OB01', 'Department of Engineering Technology'),
(9, 'ET', 'OB02', 'Dr. N.P.Liyanawaduge'),
(10, 'ET', 'OB03', 'Dr. K.R.Koswattage'),
(11, 'BT', 'OB04', 'Mr. Dasith Wijesekara'),
(12, 'BT', 'OB05', 'Ms. P.M.Attanayake'),
(13, 'ET', 'OB06', 'Ms. W.T.L.S.Peries'),
(14, 'BT', 'OB08', 'Ms. Y.P.Manawadu'),
(15, 'DO', 'OB09', 'IT Laboratory'),
(16, 'PIU', 'OB10', 'Project Implementation Unit'),
(17, 'DO', 'OB11', 'Dinning Room'),
(18, 'CIS', 'CIS01', 'Cyber Security Labortarory');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `second_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `re_password` varchar(255) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `user_image` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `title`, `first_name`, `second_name`, `email`, `username`, `password`, `re_password`, `user_type`, `user_image`) VALUES
(1, 'Mrs', 'Manager', 'Tech', 'usertwo@gmail.com', 'manager', '$2y$10$g7JRoH3A5PWcEYdr1Y.jDeskb9tSGS/dPCvuqtD7fXtAQkHtcf2TO', '$2y$10$g7JRoH3A5PWcEYdr1Y.jDeskb9tSGS/dPCvuqtD7fXtAQkHtcf2TO', 'manager', 'user_profile.png'),
(2, 'Miss', 'User', 'Tech', 'userthree@gmail.com', 'user', '$2y$10$pVZnfxZmD9QXCMcbnk.VVuCacKuKXRKmQKBXm0Z/iLAu5ECLIlxVa', '$2y$10$pVZnfxZmD9QXCMcbnk.VVuCacKuKXRKmQKBXm0Z/iLAu5ECLIlxVa', 'user', 'user_profile.png'),
(3, 'Mr', 'Admin', 'Tech', 'userone@gmail.com', 'admin', '$2y$10$N594PiwuijeqYKMTAeKSDemL60uI3dYG1aA82PITCa2gNqEIyS3TG', '$2y$10$N594PiwuijeqYKMTAeKSDemL60uI3dYG1aA82PITCa2gNqEIyS3TG', 'admin', 'user_profile.png'),
(4, 'Mr', 'SuperAdmin', 'Admin', 'super.admin@gmail.com', 'cis@appsc', '$2y$10$3vcQ7dphU6095FRB9MRNdu0RfrV.bhRs/.5eIUVt2dYmJhVle4hBu', '$2y$10$3vcQ7dphU6095FRB9MRNdu0RfrV.bhRs/.5eIUVt2dYmJhVle4hBu', 'super_admin', 'user_profile.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
