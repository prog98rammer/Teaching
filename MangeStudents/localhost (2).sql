-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 30, 2018 at 06:01 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Teaching`
--
CREATE DATABASE IF NOT EXISTS `Teaching` DEFAULT CHARACTER SET utf32 COLLATE utf32_unicode_ci;
USE `Teaching`;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(8) NOT NULL,
  `student_name` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `stage` varchar(20) COLLATE utf32_unicode_ci NOT NULL,
  `lesson` varchar(9) COLLATE utf32_unicode_ci NOT NULL,
  `teacher_name` varchar(255) COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `student_name`, `stage`, `lesson`, `teacher_name`) VALUES
(1, 'عباس حسنين محمد', 'رابع', 'رياضيات', 'علي '),
(3, 'احمد علي', 'خامس احيائي', 'فيزياء', 'حمزة'),
(4, 'محمد علي', 'خامس احيائي', 'فيزياء', 'حمزة'),
(5, 'عباس حسنين محمد', 'رابع', 'فيزياء', 'حنين');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
