-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2016 at 10:46 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mob`
--
CREATE DATABASE IF NOT EXISTS `mob` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mob`;

-- --------------------------------------------------------

--
-- Table structure for table `mob_categories`
--

DROP TABLE IF EXISTS `mob_categories`;
CREATE TABLE IF NOT EXISTS `mob_categories` (
  `category_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `category_title` varchar(128) NOT NULL,
  `category_desc` varchar(512) NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_title` (`category_title`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Truncate table before insert `mob_categories`
--

TRUNCATE TABLE `mob_categories`;
--
-- Dumping data for table `mob_categories`
--

INSERT INTO `mob_categories` (`category_id`, `category_title`, `category_desc`) VALUES
(1, 'venues', 'Venues');

-- --------------------------------------------------------

--
-- Table structure for table `mob_services`
--

DROP TABLE IF EXISTS `mob_services`;
CREATE TABLE IF NOT EXISTS `mob_services` (
  `service_id` bigint(10) NOT NULL,
  `service_category_id` bigint(10) NOT NULL,
  `service_title` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `mob_services`
--

TRUNCATE TABLE `mob_services`;
-- --------------------------------------------------------

--
-- Table structure for table `mob_vendor_location`
--

DROP TABLE IF EXISTS `mob_vendor_location`;
CREATE TABLE IF NOT EXISTS `mob_vendor_location` (
  `vendor_location_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `vendor_latitude` double NOT NULL,
  `vendor_longitude` double NOT NULL,
  `vendor_building_no` smallint(10) NOT NULL,
  `vendor_street` varchar(128) NOT NULL,
  `vendor_id` bigint(10) NOT NULL,
  `vendor_city` varchar(128) NOT NULL,
  `vendor_state` varchar(128) NOT NULL,
  `vendor_country` varchar(128) NOT NULL,
  `vendor_pincode` int(6) NOT NULL,
  PRIMARY KEY (`vendor_location_id`),
  KEY `fk_vendor_id` (`vendor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Truncate table before insert `mob_vendor_location`
--

TRUNCATE TABLE `mob_vendor_location`;
--
-- Dumping data for table `mob_vendor_location`
--

INSERT INTO `mob_vendor_location` (`vendor_location_id`, `vendor_latitude`, `vendor_longitude`, `vendor_building_no`, `vendor_street`, `vendor_id`, `vendor_city`, `vendor_state`, `vendor_country`, `vendor_pincode`) VALUES
(1, 12.2566, 32.3665, 47, 'resrskf strreet', 1, 'chennai', 'dkjfs;l', 'india', 638011);

-- --------------------------------------------------------

--
-- Table structure for table `mob_vendor_master`
--

DROP TABLE IF EXISTS `mob_vendor_master`;
CREATE TABLE IF NOT EXISTS `mob_vendor_master` (
  `vendor_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `vendor_title` varchar(256) NOT NULL,
  `vendor_description` varchar(512) NOT NULL,
  `vendor_categories` varchar(128) NOT NULL,
  `vendor_phone` varchar(20) NOT NULL,
  `vendor_email` varchar(128) NOT NULL,
  `vendor_url` varchar(256) NOT NULL,
  `vendor_fb` varchar(512) NOT NULL,
  `vendor_twitter` varchar(512) NOT NULL,
  `vendor_google` varchar(512) NOT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Truncate table before insert `mob_vendor_master`
--

TRUNCATE TABLE `mob_vendor_master`;
--
-- Dumping data for table `mob_vendor_master`
--

INSERT INTO `mob_vendor_master` (`vendor_id`, `vendor_title`, `vendor_description`, `vendor_categories`, `vendor_phone`, `vendor_email`, `vendor_url`, `vendor_fb`, `vendor_twitter`, `vendor_google`) VALUES
(1, 'New Hall', 'dfsdfadsfs', '1', '98763742742', 'newhall@gmail.om', 'http://www.newhall.og', 'http://www.facebook.com/1212121', 'http://www.twitter.com/newhall', 'http://www.google.com/user/abc'),
(2, 'New Hall', 'cvxcvxcv', '1', '98763742742', 'newhall@gmail.om', 'http://www.newhall.og', 'http://www.facebook.com/1212121', 'http://www.twitter.com/newhall', 'http://www.google.com/user/abc'),
(3, 'Wedding Hall', 'dfsdf', '1', '98763742742', 'newhall@gmail.om', 'http://www.newhall.og', 'http://www.facebook.com/1212121', 'http://www.twitter.com/newhall', 'http://www.google.com/user/abc'),
(4, 'New Hall', 'fgdsgds', '1', '2894739483', 'newhall@gmail.om', 'http://www.kdfjad.og', 'http://www.dfkajlsd.com', 'http://www.twitter.com/newhall', 'http://www.dfkajlsd.com'),
(5, 'Wedding Hall', 'dfsdf', '1', '98763742742', 'newhall@gmail.om', 'http://www.newhall.og', 'http://www.dfkajlsd.com', 'http://www.twitter.com/newhall', 'http://www.google.com/user/abc'),
(6, 'Marriage Hall', 'mjmbm', '1', '2894739483', 'newhall@gmail.om', 'http://www.newhall.og', 'http://www.facebook.com/1212121', 'http://www.dfkajlsd.com', 'http://www.dfkajlsd.com'),
(7, 'Wedding Hall', 'dfdfs', '1', '98763742742', 'newhall@gmail.om', 'http://www.newhall.og', 'http://www.facebook.com/1212121', 'http://www.twitter.com/newhall', 'http://www.google.com/user/abc'),
(8, 'Wedding Hall', 'sdsd', '1', '98763742742', 'newhall@gmail.om', 'http://www.newhall.og', 'http://www.facebook.com/1212121', 'http://www.twitter.com/newhall', 'http://www.google.com/user/abc'),
(9, 'Marriage Hall', 'jhjk', '1', '98763742742', 'newhall@gmail.om', 'http://www.newhall.og', 'http://www.dfkajlsd.com', 'http://www.twitter.com/newhall', 'http://www.google.com/user/abc'),
(10, 'Erode Hall 2', 'dfdsfds', '1', '98763742742', 'newhall@gmail.om', 'http://www.kdfjad.og', 'http://www.dfkajlsd.com', 'http://www.dfkajlsd.com', 'http://www.google.com/user/abc'),
(11, 'kdfkasdkfk', 'dklfjslkdjfdksl', '1', '232832', 'lkfjldskjK@dkfjdl.com', 'http://kfdjlskf.com', 'http://fb.sld.com', 'http://tw.sld.com', 'http://gl.sld.com');

-- --------------------------------------------------------

--
-- Table structure for table `mob_vendor_service`
--

DROP TABLE IF EXISTS `mob_vendor_service`;
CREATE TABLE IF NOT EXISTS `mob_vendor_service` (
  `vendor_service_id` bigint(10) NOT NULL,
  `vendor_id` bigint(10) NOT NULL,
  `vendor_category_services` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `mob_vendor_service`
--

TRUNCATE TABLE `mob_vendor_service`;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `mob_vendor_location`
--
ALTER TABLE `mob_vendor_location`
  ADD CONSTRAINT `fk_vendor_id` FOREIGN KEY (`vendor_id`) REFERENCES `mob_vendor_master` (`vendor_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
