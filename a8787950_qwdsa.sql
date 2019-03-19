
-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 04, 2017 at 10:30 AM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a8787950_qwdsa`
--

-- --------------------------------------------------------

--
-- Table structure for table `cabs`
--

CREATE TABLE `cabs` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `Item_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `category` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `image_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `description` varchar(500) COLLATE latin1_general_ci NOT NULL,
  `cost` int(255) NOT NULL,
  `nooftrav` int(50) NOT NULL,
  `cabtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `cabs`
--

INSERT INTO `cabs` VALUES(7, '', 'sundeep', 'CA', 'ola.jpg', 'this is a sample', 7479, 5, 'ola', '2017-01-18');
INSERT INTO `cabs` VALUES(6, '', 'sun', 'CC', 'ola.jpg', 'going via somewhere', 100, 4, 'ola', '2017-01-25');
INSERT INTO `cabs` VALUES(5, '', 'sundeep', 'CC', 'fasttrack.png', 'sample', 10000, 4, 'fasttrack', '2017-01-26');

-- --------------------------------------------------------

--
-- Table structure for table `cab_details`
--

CREATE TABLE `cab_details` (
  `cabid` int(255) NOT NULL,
  `numofpass` int(255) NOT NULL,
  `name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `sex` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `phone` varchar(255) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `cab_details`
--

INSERT INTO `cab_details` VALUES(5, 4, '', '', '');
INSERT INTO `cab_details` VALUES(6, 4, '', '', '');
INSERT INTO `cab_details` VALUES(7, 5, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemId` int(255) NOT NULL AUTO_INCREMENT,
  `Item_name` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `category` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `image_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `description` varchar(500) COLLATE latin1_general_ci NOT NULL,
  `cost` int(255) NOT NULL,
  `userid` int(255) NOT NULL,
  PRIMARY KEY (`itemId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` VALUES(5, 'SUNDEEP', 'CSE', '217396_10151691728759903_85989531_n.jpg', 'TEST', 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `msg`
--

CREATE TABLE `msg` (
  `sendid` int(255) NOT NULL,
  `toid` int(255) NOT NULL,
  `msg` varchar(500) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `msg`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `tel` bigint(20) NOT NULL,
  `pass` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES(12, '', '', 0, '');
INSERT INTO `users` VALUES(11, 'Sundeep', 'pidugusundeep5@gmail.com', 8681924578, 'sundeep');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `itemid` int(100) NOT NULL,
  `userid` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` VALUES(5, 11);
