-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Apr 20, 2020 at 04:41 PM
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
  `app_version` varchar(10) NOT NULL,
  `r_version` varchar(10) NOT NULL,
  `r_code_version` varchar(10) NOT NULL,
  `db_version` varchar(10) NOT NULL,
  `platform` varchar(50) DEFAULT NULL,
  `platform_release` varchar(50) DEFAULT NULL,
  `arch` varchar(50) DEFAULT NULL,
  `time_to_analyze` decimal(10,4) NOT NULL,
  `analysis_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
