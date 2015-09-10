-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2015 at 02:43 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `address_book`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(8) NOT NULL,
  `first_name` varchar(35) NOT NULL,
  `last_name` varchar(35) NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10000012 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `first_name`, `last_name`, `contact_number`, `address`, `email_address`, `picture`) VALUES
(10000000, 'Marco Polo', 'Bustillo', '09154861234', 'Quirino, Manila', 'oyoiyoi@yahoo.com', 'assets/images/marco.jpg'),
(10000002, 'Ross Benedict', 'Decena', '09061603190', 'Imus, Cavite', 'ross@yahoo.com', 'assets/images/ross.jpg'),
(10000003, 'Alexander', 'Pascual', '09066910690', 'Bacoor, Cavite', 'alex@yahoo.com', 'assets/images/alex.jpg'),
(10000004, 'Joshua Paolo', 'Badillo', '09069454564', 'Batangas City, Batangas', 'josh@yahoo.com', 'assets/images/joshua.jpg'),
(10000005, 'Jan Patrick', 'Claro', '09168500609', 'Novaliches, QC', 'pat@yahoo.com', 'assets/images/patrick.jpg'),
(10000006, 'Blaze', 'Cat', '09152222322', 'Pag-asa', 'blazethecat@yahoo.com', 'assets/images/11214216_1676087409278013_2550162454402705789_n.jpg'),
(10000008, 'Creamer', 'Dog', '09125551232', 'Pag-asa', 'creamerthedog@yahoo.com', 'assets/images/11194626_10206381686763453_2882157687646071140_o_2.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10000012;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
