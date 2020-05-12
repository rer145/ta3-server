-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Apr 21, 2020 at 02:19 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta3`
--

-- --------------------------------------------------------

--
-- Table structure for table `analysislog`
--

DROP TABLE IF EXISTS `analysislog`;
CREATE TABLE IF NOT EXISTS `analysislog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(50) NOT NULL,
  `session` varchar(50) NULL,
  `app_version` varchar(10) NOT NULL,
  `r_version` varchar(10) NOT NULL,
  `r_code_version` varchar(10) NOT NULL,
  `db_version` varchar(10) NOT NULL,
  `ta3bum_version` varchar(10) NOT NULL,
  `ta3oum_version` varchar(10) NOT NULL,
  `platform` varchar(50) DEFAULT NULL,
  `platform_release` varchar(50) DEFAULT NULL,
  `arch` varchar(50) DEFAULT NULL,
  `node_version` varchar(25) DEFAULT NULL,
  `electron_version` varchar(25) DEFAULT NULL,
  `chrome_version` varchar(25) DEFAULT NULL,
  `locale` varchar(50) DEFAULT NULL,
  `locale_country_code` varchar(50) DEFAULT NULL,
  `arguments` varchar(50000) DEFAULT NULL,
  `entry_mode` varchar(10) DEFAULT NULL,
  `time_to_analyze` decimal(10,4) NOT NULL,
  `analysis_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `analysisresults`
--

DROP TABLE IF EXISTS `analysisresults`;
CREATE TABLE IF NOT EXISTS `analysisresults` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `analysis_id` int(11) NOT NULL,
  `sample_size` int(11) NOT NULL,
  `estimated_age` decimal(10,4) NOT NULL,
  `lower_95_bound` decimal(10,4) NOT NULL,
  `upper_95_bound` decimal(10,4) NOT NULL,
  `std_error` decimal(10,4) NOT NULL,
  `corr` decimal(10,4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `analysisselections`
--

DROP TABLE IF EXISTS `analysisselections`;
CREATE TABLE IF NOT EXISTS `analysisselections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `analysis_id` int(11) NOT NULL,
  `trait` varchar(50) NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `debuglog`
--

DROP TABLE IF EXISTS `debuglog`;
CREATE TABLE IF NOT EXISTS `debuglog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(50) NOT NULL,
  `session` varchar(50) NULL,
  `app_version` varchar(10) NOT NULL,
  `r_version` varchar(10) NOT NULL,
  `r_code_version` varchar(10) NOT NULL,
  `db_version` varchar(10) NOT NULL,
  `ta3bum_version` varchar(10) NOT NULL,
  `ta3oum_version` varchar(10) NOT NULL,
  `platform` varchar(50) DEFAULT NULL,
  `platform_release` varchar(50) DEFAULT NULL,
  `arch` varchar(50) DEFAULT NULL,
  `node_version` varchar(25) DEFAULT NULL,
  `electron_version` varchar(25) DEFAULT NULL,
  `chrome_version` varchar(25) DEFAULT NULL,
  `locale` varchar(50) DEFAULT NULL,
  `locale_country_code` varchar(50) DEFAULT NULL,
  `arguments` varchar(50000) DEFAULT NULL,
  `entry_mode` varchar(10) DEFAULT NULL,
  `event_date` datetime NOT NULL,
  `event_level` varchar(10) DEFAULT NULL,
  `event_category` varchar(50) DEFAULT NULL,
  `event_action` varchar(500) DEFAULT NULL,
  `event_label` varchar(50) DEFAULT NULL,
  `event_value` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
