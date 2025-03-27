-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2025 at 01:03 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(250) NOT NULL,
  `name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `department` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `type` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `department`, `password`, `type`) VALUES
(1, 'test admin', 'admin@gmail.com', '', '21232f297a57a5a743894a0e4a801fc3', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(250) NOT NULL,
  `name` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `year_level` varchar(500) NOT NULL,
  `section` varchar(500) NOT NULL,
  `date_time` varchar(500) NOT NULL,
  `status` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `year_level`, `section`, `date_time`, `status`) VALUES
(78, 'BSIT', 'BSIT', '1', 'A', '2025-03-12 06:47:05', ''),
(79, 'BSIT', 'BSIT', '1', 'B', '2025-03-12 06:47:05', ''),
(80, 'BSIT', 'BSIT', '1', 'C', '2025-03-12 06:47:05', ''),
(81, 'BSIT', 'BSIT', '2', 'A', '2025-03-12 06:47:23', ''),
(82, 'BSIT', 'BSIT', '2', 'B', '2025-03-12 06:47:23', ''),
(83, 'BSIT', 'BSIT', '2', 'C', '2025-03-12 06:47:23', ''),
(84, 'BSIT', 'BSIT', '2', 'D', '2025-03-12 06:47:23', '');

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `id` int(250) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `firstname` varchar(500) NOT NULL,
  `lastname` varchar(500) NOT NULL,
  `name` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `date_time` varchar(500) NOT NULL,
  `status` varchar(500) NOT NULL,
  `type` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`id`, `email`, `password`, `firstname`, `lastname`, `name`, `description`, `date_time`, `status`, `type`) VALUES
(1, 'registrar@gmail.com', '4052e09931ceddc2963e2524ee2a2bc7', '', '', 'Registrar', 'Registrar Office', '2025-03-12 06:57:57', '', 'offices'),
(10, 'accounting@gmail.com', '4052e09931ceddc2963e2524ee2a2bc7', '', '', 'Accounting', 'Accounting', '2025-03-12 07:24:57', '', 'offices');

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE `school_year` (
  `id` int(250) NOT NULL,
  `name` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `date_time` varchar(500) NOT NULL,
  `status` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `signatory`
--

CREATE TABLE `signatory` (
  `id` int(250) NOT NULL,
  `signatory_list_id` varchar(500) NOT NULL,
  `student_id` varchar(500) NOT NULL,
  `status` varchar(500) NOT NULL,
  `date_created` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `signatory_list`
--

CREATE TABLE `signatory_list` (
  `id` int(250) NOT NULL,
  `offices_id` varchar(500) NOT NULL,
  `courses_id` varchar(500) NOT NULL,
  `date_time` varchar(500) NOT NULL,
  `status` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signatory_list`
--

INSERT INTO `signatory_list` (`id`, `offices_id`, `courses_id`, `date_time`, `status`) VALUES
(23, '1', '78', '2025-03-12 07:16:21', ''),
(24, '1', '79', '2025-03-12 07:16:21', ''),
(25, '10', '78', '2025-03-12 07:25:36', '');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(250) NOT NULL,
  `student_id` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `firstname` varchar(500) NOT NULL,
  `lastname` varchar(500) NOT NULL,
  `middlename` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `contact` varchar(500) NOT NULL,
  `gender` varchar(500) NOT NULL,
  `year_level` varchar(500) NOT NULL,
  `courses` varchar(500) NOT NULL,
  `section` varchar(500) NOT NULL,
  `address` varchar(500) NOT NULL,
  `barangay` varchar(500) NOT NULL,
  `city` varchar(500) NOT NULL,
  `province` varchar(500) NOT NULL,
  `zipcode` varchar(500) NOT NULL,
  `birthday` varchar(500) NOT NULL,
  `img` varchar(500) NOT NULL,
  `type` varchar(500) NOT NULL,
  `status` varchar(500) NOT NULL,
  `verification` varchar(500) NOT NULL,
  `date_created` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `student_id`, `email`, `firstname`, `lastname`, `middlename`, `password`, `contact`, `gender`, `year_level`, `courses`, `section`, `address`, `barangay`, `city`, `province`, `zipcode`, `birthday`, `img`, `type`, `status`, `verification`, `date_created`) VALUES
(36, '123456', 'johndoe@gmail.com', 'john', 'doe', '', '4052e09931ceddc2963e2524ee2a2bc7', '', '', '1', 'BSIT', 'A', '', '', '', '', '', '', '', 'student', 'verified', '849561', '2025-03-12 06:48:00'),
(37, '123457', 'janedoe@gmail.com', 'jane', 'doe', '', '4052e09931ceddc2963e2524ee2a2bc7', '', '', '1', 'BSIT', 'B', '', '', '', '', '', '', '', 'student', '', '', '2025-03-12 06:48:40'),
(38, '123458', 'jackdoe@gmail.com', 'jack', 'doe', '', '4052e09931ceddc2963e2524ee2a2bc7', '', '', '2', 'BSIT', 'A', '', '', '', '', '', '', '', 'student', '', '', '2025-03-12 06:49:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_year`
--
ALTER TABLE `school_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signatory`
--
ALTER TABLE `signatory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signatory_list`
--
ALTER TABLE `signatory_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `signatory`
--
ALTER TABLE `signatory`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `signatory_list`
--
ALTER TABLE `signatory_list`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
