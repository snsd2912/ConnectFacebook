-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 25, 2020 at 11:58 PM
-- Server version: 8.0.21-0ubuntu0.20.04.4
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vcs`
--

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int NOT NULL,
  `id_sender` int NOT NULL,
  `id_reciever` int NOT NULL,
  `content` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `id_sender`, `id_reciever`, `content`) VALUES
(1, 1, 2, 'hello'),
(2, 2, 1, 'hi'),
(3, 1, 2, 'What\'s your name?'),
(4, 2, 1, 'My name is Sang'),
(5, 1, 2, 'Oh so am i'),
(6, 1, 2, 'Where do you come from'),
(8, 2, 1, 'sang ne'),
(9, 2, 1, 'hi'),
(12, 1, 10, 'hello, im your teacher'),
(13, 1, 10, 'if there is any problem, you can call me'),
(14, 1, 11, 'hello, im your teacher'),
(15, 1, 11, 'if you have any problem, text me'),
(18, 11, 1, 'thank you'),
(19, 11, 1, 'u r the best teacher in the wrld');

-- --------------------------------------------------------

--
-- Table structure for table `tblassignment`
--

CREATE TABLE `tblassignment` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `idteacher` int NOT NULL,
  `filename` varchar(255) NOT NULL,
  `updateon` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblassignment`
--

INSERT INTO `tblassignment` (`id`, `title`, `idteacher`, `filename`, `updateon`) VALUES
(3, 'Bài 1', 1, 'LÊ VĂN SANG.docx', '2020-09-25 09:28:58'),
(4, 'bai 2', 1, 'SANGLV.docx', '2020-09-25 22:13:53');

-- --------------------------------------------------------

--
-- Table structure for table `tblchallenge`
--

CREATE TABLE `tblchallenge` (
  `id` int NOT NULL,
  `id_teacher` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hint` varchar(20000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `updateon` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblchallenge`
--

INSERT INTO `tblchallenge` (`id`, `id_teacher`, `title`, `hint`, `updateon`) VALUES
(6, 1, 'Challenge1', 'This is the best Kpop girl group of all time.\r\nThey debuted in 2007 and had 9 member before a girl left on Sep 30th, 2014.\r\n', '2020-09-25 22:15:28'),
(7, 1, 'Challenge2', 'But strong girl, you know you were born to fly\r\nMy life is a beauty', '2020-09-25 22:25:14'),
(8, 1, 'Challenge3', 'This is where you work for', '2020-09-25 22:51:42');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubmit`
--

CREATE TABLE `tblsubmit` (
  `id` int NOT NULL,
  `id_assign` int NOT NULL,
  `id_stu` int NOT NULL,
  `filename` varchar(255) NOT NULL,
  `updateon` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblsubmit`
--

INSERT INTO `tblsubmit` (`id`, `id_assign`, `id_stu`, `filename`, `updateon`) VALUES
(1, 3, 2, 'LÊ VĂN SANG (1).docx', '2020-09-25 10:29:19'),
(2, 4, 11, 'girlsgeneration.txt', '2020-09-25 22:40:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pos` int NOT NULL,
  `name` varchar(128) NOT NULL,
  `pnumber` varchar(16) NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `username`, `password`, `pos`, `name`, `pnumber`, `email`) VALUES
(1, 'sanglv11', 'cee08b709f22b780d9245481968d48a1 ', 1, 'le van sang', '0377824869', 'lesang407407@gmail.com'),
(11, 'lamvt', '06c7e367ad30b0fede2fb7e24cea34d6', 2, 'vũ thanh lam', '0872739136', 'lamvt@gmail.com'),
(12, 'anhnttt', '06c7e367ad30b0fede2fb7e24cea34d6', 2, 'nguyễn thị ngọc ánh', '0872739137', 'anhnttt@gmail.com'),
(13, 'haianhlala', '06c7e367ad30b0fede2fb7e24cea34d6', 2, 'nguyễn hải anh', '0872739138', 'haianhlala@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblassignment`
--
ALTER TABLE `tblassignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblchallenge`
--
ALTER TABLE `tblchallenge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsubmit`
--
ALTER TABLE `tblsubmit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tblassignment`
--
ALTER TABLE `tblassignment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblchallenge`
--
ALTER TABLE `tblchallenge`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblsubmit`
--
ALTER TABLE `tblsubmit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
