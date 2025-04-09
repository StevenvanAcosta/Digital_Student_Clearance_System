-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2025 at 09:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clearance_system_db`
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
(86, 'BSIS', 'Bachelor of Science Information System', '4', 'B', '2025-03-31 03:22:44', ''),
(87, 'BSIS', 'Bachelor of Science Information System', '2', 'A', '2025-03-31 03:51:06', ''),
(88, 'BSIS', 'Bachelor of Science Information System', '2', 'B', '2025-03-31 03:51:06', ''),
(89, 'BSIS', 'Bachelor of Science Information System', '2', 'C', '2025-03-31 03:51:06', ''),
(90, 'BSIS', 'Bachelor of Science Information System', '2', 'D', '2025-03-31 03:51:06', ''),
(91, 'BSIS', 'Bachelor of Science Information System', '2', 'E', '2025-03-31 03:51:06', ''),
(92, 'BSIS', 'Bachelor of Science Information System', '2', 'F', '2025-03-31 03:51:06', ''),
(93, 'BSIS', 'Bachelor of Science Information System', '2', 'G', '2025-03-31 03:51:06', ''),
(94, 'BSIS', 'Bachelor of Science Information System', '2', 'H', '2025-03-31 03:51:06', ''),
(95, 'BSIS', 'Bachelor of Science Information System', '2', 'I', '2025-03-31 03:51:06', ''),
(96, 'BSIS', 'Bachelor of Science Information System', '2', 'J', '2025-03-31 03:51:06', ''),
(97, 'BSIS', 'Bachelor of Science Information System', '2', 'K', '2025-03-31 03:51:06', ''),
(98, 'BSIS', 'Bachelor of Science Information System', '2', 'L', '2025-03-31 03:51:06', ''),
(99, 'BSIS', 'Bachelor of Science Information System', '2', 'M', '2025-03-31 03:51:06', ''),
(100, 'BSAIS', 'Bachelor of Science Accounting Information System', '4', 'B', '2025-03-31 21:23:08', ''),
(101, 'ACT', 'Associate in Computer Technology', '2', 'B', '2025-04-02 02:32:24', ''),
(102, 'ACT', 'Associate in Computer Technology', '2', 'C', '2025-04-02 02:32:24', '');

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
(22, 'adviser@gmail.com', '4052e09931ceddc2963e2524ee2a2bc7', 'Adviser', 'Acosta', 'Adviser', 'asdbasdbasdb', '2025-04-06 14:31:09', '', 'offices'),
(23, 'ptca@gmail.com', '4052e09931ceddc2963e2524ee2a2bc7', 'new', 'ptca', 'PTCA', 'PTCA for second year', '2025-04-06 18:33:22', '', 'offices');

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

CREATE TABLE `requirements` (
  `id` int(255) NOT NULL,
  `offices_id` int(11) NOT NULL,
  `requirement_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requirements`
--

INSERT INTO `requirements` (`id`, `offices_id`, `requirement_name`) VALUES
(71, 22, 'certificate'),
(72, 22, 'certificate'),
(73, 23, 'haha'),
(74, 23, 'haha'),
(75, 23, 'asdasdad'),
(76, 23, 'heyege'),
(77, 23, 'heyege'),
(78, 23, 'heyege');

-- --------------------------------------------------------

--
-- Table structure for table `requirements_list`
--

CREATE TABLE `requirements_list` (
  `id` int(255) NOT NULL,
  `requirements_id` int(255) NOT NULL,
  `courses_id` int(255) NOT NULL,
  `offices_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE `school_year` (
  `id` int(250) NOT NULL,
  `school_year` varchar(500) NOT NULL,
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

--
-- Dumping data for table `signatory`
--

INSERT INTO `signatory` (`id`, `signatory_list_id`, `student_id`, `status`, `date_created`) VALUES
(83, '22', '48', 'Approved', '2025-04-06 19:39:14'),
(84, '22', '50', 'Approved', '2025-04-06 19:39:15'),
(85, '22', '49', 'Approved', '2025-04-06 19:39:15');

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
(136, '22', '86', '2025-04-06 18:14:31', ''),
(137, '22', '88', '2025-04-06 18:14:31', ''),
(138, '22', '90', '2025-04-06 18:19:05', ''),
(139, '23', '101', '2025-04-06 18:33:34', ''),
(140, '23', '102', '2025-04-06 18:33:34', '');

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
  `password` varchar(500) NOT NULL,
  `year_level` varchar(500) NOT NULL,
  `courses` varchar(500) NOT NULL,
  `section` varchar(500) NOT NULL,
  `img` varchar(500) NOT NULL,
  `type` varchar(500) NOT NULL,
  `status` varchar(500) NOT NULL,
  `verification` varchar(500) NOT NULL,
  `date_created` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `student_id`, `email`, `firstname`, `lastname`, `password`, `year_level`, `courses`, `section`, `img`, `type`, `status`, `verification`, `date_created`) VALUES
(48, 'MA213123', 'meow@gmail.com', 'meow', 'meow', '4052e09931ceddc2963e2524ee2a2bc7', '4', 'BSIS', 'B', '', 'student', '', '', '2025-03-31 03:50:35'),
(49, 'MA1230129', 'new@gmail.com', 'new', 'student', '4052e09931ceddc2963e2524ee2a2bc7', '2', 'BSIS', 'B', '', 'student', '', '', '2025-03-31 03:51:34'),
(50, 'MA21010406', 'stevenacosta0203@gmail.com', 'Steven', 'Acosta', '4052e09931ceddc2963e2524ee2a2bc7', '4', 'BSIS', 'B', '', 'student', 'verified', '743189', '2025-04-06 13:28:24'),
(51, '092322', 'studentptca@gmail.com', 'ptca', 'student', '4052e09931ceddc2963e2524ee2a2bc7', '2', 'ACT', 'C', '', 'student', '', '', '2025-04-06 18:35:19');

-- --------------------------------------------------------

--
-- Table structure for table `student_status`
--

CREATE TABLE `student_status` (
  `id` int(250) NOT NULL,
  `student_id` varchar(250) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `year_level` varchar(250) NOT NULL,
  `courses` varchar(250) NOT NULL,
  `section` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `id` int(255) NOT NULL,
  `student_id` int(255) NOT NULL,
  `student_upload` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `upload_list`
--

CREATE TABLE `upload_list` (
  `id` int(255) NOT NULL,
  `student_id` int(255) NOT NULL,
  `upload` varchar(255) NOT NULL,
  `courses_id` varchar(255) NOT NULL,
  `student_upload` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `requirements`
--
ALTER TABLE `requirements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requirements_list`
--
ALTER TABLE `requirements_list`
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
-- Indexes for table `student_status`
--
ALTER TABLE `student_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload_list`
--
ALTER TABLE `upload_list`
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
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `requirements`
--
ALTER TABLE `requirements`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `requirements_list`
--
ALTER TABLE `requirements_list`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `signatory`
--
ALTER TABLE `signatory`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `signatory_list`
--
ALTER TABLE `signatory_list`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `student_status`
--
ALTER TABLE `student_status`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `upload`
--
ALTER TABLE `upload`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `upload_list`
--
ALTER TABLE `upload_list`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
