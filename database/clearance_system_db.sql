-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2025 at 09:28 AM
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
-- Table structure for table `clearance_status`
--

CREATE TABLE `clearance_status` (
  `id` int(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `student_id` int(255) NOT NULL,
  `courses_id` int(255) NOT NULL,
  `offices_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(102, 'ACT', 'Associate in Computer Technology', '2', 'C', '2025-04-02 02:32:24', ''),
(103, 'BSIS', 'Bachelor of Science Information System', '4', 'C', '2025-04-09 15:53:22', ''),
(104, 'HRS', 'new', '2', 'B', '2025-04-15 11:22:02', '');

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
(26, 'ptca@gmail.com', '4052e09931ceddc2963e2524ee2a2bc7', 'Sir Jarmart', 'Maala', 'ptca@gmail.com', 'adasd', '2025-04-15 11:22:34', '', 'offices');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `id` int(25) NOT NULL,
  `requirement_id` int(255) NOT NULL,
  `courses_id` int(255) NOT NULL,
  `offices_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `requirement_id`, `courses_id`, `offices_id`) VALUES
(80, 0, 86, 26),
(81, 0, 87, 26);

-- --------------------------------------------------------

--
-- Table structure for table `program_showing`
--

CREATE TABLE `program_showing` (
  `id` int(255) NOT NULL,
  `program_show_id` int(255) NOT NULL,
  `requirements_id` int(255) NOT NULL,
  `courses_id` int(255) NOT NULL,
  `offices_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(128, 26, 'Certificate'),
(129, 26, 'Receipt'),
(130, 26, 'adasdasdasd'),
(131, 26, 'adasdasdasd'),
(132, 26, 'adasdasdasd'),
(133, 26, 'adasdasdasd'),
(134, 26, 'adasdasdasd'),
(135, 26, 'adasdasdasd');

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
  `school_year_end` varchar(500) NOT NULL,
  `date_time` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_year`
--

INSERT INTO `school_year` (`id`, `school_year_end`, `date_time`) VALUES
(165, '2025 - 2026', '2025-04-15 18:37:22');

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
(135, '26', '84', 'Approved', '2025-04-15 11:50:43'),
(136, '26', '83', 'Approved', '2025-04-15 11:50:43'),
(137, '26', '82', 'Approved', '2025-04-15 11:50:43'),
(138, '26', '81', 'Approved', '2025-04-15 11:50:43'),
(139, '26', '80', 'Approved', '2025-04-15 11:50:43'),
(140, '26', '79', 'Approved', '2025-04-15 11:50:43'),
(141, '26', '78', 'Approved', '2025-04-15 11:50:43'),
(142, '26', '77', 'Approved', '2025-04-15 11:50:43'),
(143, '26', '85', 'Approved', '2025-04-15 12:27:47'),
(144, '26', '92', 'Approved', '2025-04-15 18:10:05'),
(145, '26', '86', 'Approved', '2025-04-16 15:14:30');

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
(302, '26', '86', '2025-04-15 11:37:14', ''),
(303, '26', '87', '2025-04-15 11:37:14', ''),
(304, '26', '88', '2025-04-15 11:37:14', ''),
(305, '26', '89', '2025-04-15 11:37:14', ''),
(306, '26', '90', '2025-04-15 11:37:14', ''),
(307, '26', '91', '2025-04-15 11:37:14', ''),
(308, '26', '92', '2025-04-15 11:37:14', ''),
(309, '26', '93', '2025-04-15 11:37:14', ''),
(310, '26', '94', '2025-04-15 11:37:14', ''),
(311, '26', '95', '2025-04-15 11:37:14', ''),
(312, '26', '96', '2025-04-15 11:37:14', ''),
(313, '26', '97', '2025-04-15 11:37:14', ''),
(314, '26', '98', '2025-04-15 11:37:14', ''),
(315, '26', '99', '2025-04-15 11:37:14', ''),
(316, '26', '100', '2025-04-15 11:37:14', ''),
(317, '26', '101', '2025-04-15 11:37:14', ''),
(318, '26', '102', '2025-04-15 11:37:14', ''),
(319, '26', '103', '2025-04-15 11:37:14', ''),
(320, '26', '104', '2025-04-15 11:37:14', '');

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
(86, '123456', 'jackdoe@gmail.com', 'jack', 'doe', '4052e09931ceddc2963e2524ee2a2bc7', '4', 'BSIS', 'B', '', 'student', '', '', ''),
(87, 'ma21010406', 'stevenacosta0203@gmail.com', 'steven', 'acosta', '4052e09931ceddc2963e2524ee2a2bc7', '4', 'BSIS', 'B', '', 'student', 'verified', '131900', ''),
(88, '930441', 'student@gmail.com', 'student', 'acosta', '4052e09931ceddc2963e2524ee2a2bc7', '4', 'BSIS', 'B', '', 'student', '', '', ''),
(89, '946', 'student2@gmail.com', 'student2', 'dela crux', '4052e09931ceddc2963e2524ee2a2bc7', '4', 'BSIS', 'B', '', 'student', '', '', ''),
(90, '1234324', 'student3@gmail.com', 'student3', 'acosta', '4052e09931ceddc2963e2524ee2a2bc7', '4', 'BSIS', 'B', '', 'student', '', '', ''),
(91, '989898', 'student4@gmail.com', 'student4', 'dela Cruz', '4052e09931ceddc2963e2524ee2a2bc7', '2', 'ACT', 'B', '', 'student', '', '', ''),
(92, '10010312', 'atsoca0946@gmail.com', 'student5', 'dela Cruz', '4052e09931ceddc2963e2524ee2a2bc7', '2', 'ACT', 'B', '', 'student', 'verified', '742004', ''),
(93, '7373248', 'student6@gmail.com', 'student6', 'dela Cruz', '4052e09931ceddc2963e2524ee2a2bc7', '2', 'ACT', 'B', '', 'student', '', '', ''),
(94, '2323231111', 'asdkaslk@gmail.com', 'ALDka;lds', 'as;ldkalsk', '4052e09931ceddc2963e2524ee2a2bc7', '4', 'BSIS', 'C', '', 'student', '', '', '2025-04-15 18:14:32');

-- --------------------------------------------------------

--
-- Table structure for table `student_clearance_record`
--

CREATE TABLE `student_clearance_record` (
  `id` int(255) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `year_level` varchar(255) NOT NULL,
  `courses` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `archieve_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_clearance_record`
--

INSERT INTO `student_clearance_record` (`id`, `student_id`, `firstname`, `lastname`, `year_level`, `courses`, `section`, `status`, `semester`, `school_year`, `archieve_at`) VALUES
(61, '123456', 'jack', 'doe', '4', 'BSIS', 'B', 'Cleared', 'Second Semester', '2025 - 2026', '2025-04-15 11:11:10.846661'),
(62, '123456', 'jack', 'doe', '4', 'BSIS', 'B', 'Cleared', 'Second Semester', '2025 - 2026', '2025-04-15 11:15:41.486890'),
(63, '123456', 'jack', 'doe', '4', 'BSIS', 'B', 'Cleared', 'Second Semester', '2025 - 2026', '2025-04-15 11:18:49.121198'),
(64, '1234324', 'student3', 'acosta', '4', 'BSIS', 'B', 'Not Cleared', 'First Semester', '2025 - 2026', '2025-04-15 11:19:02.978133'),
(65, '123456', 'jack', 'doe', '4', 'BSIS', 'B', 'Cleared', 'First Semester', '2025 - 2026', '2025-04-15 11:23:53.059253'),
(66, '10010312', 'student5', 'dela', '2', 'ACT', 'B', 'Cleared', 'Second Semester', '2025 - 2026', '2025-04-15 12:28:21.702479'),
(67, '930441', 'student', 'acosta', '4', 'BSIS', 'B', 'Cleared', 'Second Semester', '2025 - 2026', '2025-04-16 04:06:25.166567');

-- --------------------------------------------------------

--
-- Table structure for table `student_status`
--

CREATE TABLE `student_status` (
  `id` int(250) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `year_level` varchar(255) NOT NULL,
  `courses` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_status`
--

INSERT INTO `student_status` (`id`, `student_id`, `firstname`, `lastname`, `year_level`, `courses`, `section`, `status`) VALUES
(124, '1234324', 'student3', 'acosta', '4', 'BSIS', 'B', 'Not Cleared');

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
  `courses_id` varchar(255) NOT NULL,
  `student_upload` varchar(255) NOT NULL,
  `offices_id` int(255) NOT NULL
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
-- Indexes for table `clearance_status`
--
ALTER TABLE `clearance_status`
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
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_showing`
--
ALTER TABLE `program_showing`
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
-- Indexes for table `student_clearance_record`
--
ALTER TABLE `student_clearance_record`
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
-- AUTO_INCREMENT for table `clearance_status`
--
ALTER TABLE `clearance_status`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `program_showing`
--
ALTER TABLE `program_showing`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requirements`
--
ALTER TABLE `requirements`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `requirements_list`
--
ALTER TABLE `requirements_list`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `signatory`
--
ALTER TABLE `signatory`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `signatory_list`
--
ALTER TABLE `signatory_list`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `student_clearance_record`
--
ALTER TABLE `student_clearance_record`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `student_status`
--
ALTER TABLE `student_status`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

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
