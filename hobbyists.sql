-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 15, 2014 at 11:07 PM
-- Server version: 5.5.35-0ubuntu0.12.04.2
-- PHP Version: 5.3.10-1ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sjlawson`
--

-- --------------------------------------------------------

--
-- Table structure for table `hobbyists`
--

CREATE TABLE IF NOT EXISTS `hobbyists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` char(50) DEFAULT NULL,
  `lastname` char(50) DEFAULT NULL,
  `email` char(50) DEFAULT NULL,
  `sex` char(1) DEFAULT NULL,
  `city` char(50) DEFAULT NULL,
  `state` char(2) DEFAULT NULL,
  `comments` text,
  `hobby_cycling` int(11) DEFAULT NULL,
  `hobby_frisbee` int(11) DEFAULT NULL,
  `hobby_skiing` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `hobbyists`
--

INSERT INTO `hobbyists` (`id`, `firstname`, `lastname`, `email`, `sex`, `city`, `state`, `comments`, `hobby_cycling`, `hobby_frisbee`, `hobby_skiing`) VALUES
(1, 'Samuel', 'Lawson', 'sjlawson@sdf.org', 'M', 'Indianapolis', 'IN', 'Here he comes to save the day!', 1, 1, 0),
(2, 'Lawrence', 'Meade', 'bitterblackale@yahoo.com', 'M', 'Edinburgh', 'DE', 'wheeee', 0, 0, 1),
(3, 'Guy', 'Fawkes', 'wong@email.com', 'M', 'Pittsburgh', 'PA', 'Remember, remember the 5th of November...', 0, 1, 0),
(5, 'Anothergurl', 'Lady', 'lady@gurl.com', 'F', 'Boston', 'MA', 'Something or other&#39;s here', 1, 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
