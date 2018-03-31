-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 31, 2018 at 03:44 PM
-- Server version: 10.1.23-MariaDB-9+deb9u1
-- PHP Version: 7.0.27-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `trailsendmonitor`
--
CREATE DATABASE IF NOT EXISTS `trailsendmonitor` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `trailsendmonitor`;

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

DROP TABLE IF EXISTS `data`;
CREATE TABLE IF NOT EXISTS `data` (
  `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `stream-id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `label` varchar(6) NOT NULL,
  `value` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `stream-id` (`stream-id`),
  KEY `timestamp` (`timestamp`),
  KEY `label` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `streams`
--

DROP TABLE IF EXISTS `streams`;
CREATE TABLE IF NOT EXISTS `streams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `device-serial` varchar(50) DEFAULT NULL,
  `shunt_resistance` float NOT NULL DEFAULT '0',
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `streams`
--

INSERT INTO `streams` (`id`, `name`, `description`, `device-serial`, `shunt_resistance`, `disabled`) VALUES
(7, 'Test', 'A fake device to test with', 't1000', 0.0001, 1),
(8, 'battery_sens', 'The sensor for the main DC Bus.', 'A5BAD', 0.1, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data`
--
ALTER TABLE `data`
  ADD CONSTRAINT `streams in data` FOREIGN KEY (`stream-id`) REFERENCES `streams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
