-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 13, 2023 at 06:02 PM
-- Server version: 8.0.32-0ubuntu0.20.04.2
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `academic_record`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_session`
--

CREATE TABLE `academic_session` (
  `ID` int NOT NULL,
  `session_name` varchar(150) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academic_session`
--

INSERT INTO `academic_session` (`ID`, `session_name`, `start_date`, `end_date`, `status`) VALUES
(1, '2016/2017', '2016-09-17', '2017-05-25', 0),
(2, '2017/2018', '2018-04-23', '2019-02-22', 0),
(3, '2018/2019', '2019-06-17', '2020-02-22', 0),
(4, '2020/2021', '2020-09-08', '2021-06-16', 0),
(5, '2021/2022', '2022-10-17', '2023-07-31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `address` text,
  `dob` date DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `img_path` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `firstname`, `middlename`, `lastname`, `email`, `phone_number`, `address`, `dob`, `role_id`, `status`, `img_path`) VALUES
(1, 'Holynation', 'Dev', 'Oluwaseun', 'developer@gmail.com', '08109994486', 'University of Ibadan', '2018-04-17', 1, 1, 'uploads/admin/profile_pictures/admin1.png'),
(11, 'Demo', 'Demo', 'Demo', 'demo@gmail.com', '08109994485', '', NULL, 2, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `ID` int NOT NULL,
  `course_title` varchar(150) NOT NULL,
  `course_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`ID`, `course_title`, `course_code`) VALUES
(5, 'Data structures and algorithm', 'CSC 341'),
(6, 'Operating System', 'CSC 321'),
(4, 'System analysis and design', 'CSC 302');

-- --------------------------------------------------------

--
-- Table structure for table `course_score`
--

CREATE TABLE `course_score` (
  `ID` int NOT NULL,
  `student_course_registration_id` int NOT NULL,
  `score` float NOT NULL,
  `ca_score` double DEFAULT NULL,
  `exam_score` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_score`
--

INSERT INTO `course_score` (`ID`, `student_course_registration_id`, `score`, `ca_score`, `exam_score`) VALUES
(1, 1, 62, 22, 40),
(2, 2, 80, 35, 45);

-- --------------------------------------------------------

--
-- Table structure for table `entry_mode`
--

CREATE TABLE `entry_mode` (
  `ID` int NOT NULL,
  `mode_of_entry` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `level_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entry_mode`
--

INSERT INTO `entry_mode` (`ID`, `mode_of_entry`, `description`, `level_id`) VALUES
(1, 'UME', 'Unified Matriculation Examination', 1),
(2, 'UTME', 'Unified Tertiary Matriculation Examination', 1),
(3, 'DE', 'Direct Entry', 2),
(4, 'TRA', 'Transfer', 2);

-- --------------------------------------------------------

--
-- Table structure for table `grade_scale`
--

CREATE TABLE `grade_scale` (
  `ID` int NOT NULL,
  `min_score` float NOT NULL,
  `grade` varchar(10) NOT NULL,
  `point` float NOT NULL,
  `max_score` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_scale`
--

INSERT INTO `grade_scale` (`ID`, `min_score`, `grade`, `point`, `max_score`) VALUES
(10, 0, 'F', 0, 44),
(11, 45, 'D', 1, 49),
(12, 50, 'C', 2, 59),
(13, 60, 'B', 3, 69),
(14, 70, 'A', 4, 100);

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `ID` int NOT NULL,
  `title` enum('Miss','Mr.','Mrs.','Dr.','Prof.') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `surname` varchar(150) DEFAULT NULL,
  `firstname` varchar(150) DEFAULT NULL,
  `middlename` varchar(150) DEFAULT NULL,
  `email` text,
  `phone_number` text,
  `dob` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `address` varchar(100) DEFAULT NULL,
  `state_of_origin` varchar(100) DEFAULT NULL,
  `staff_no` varchar(100) DEFAULT NULL,
  `lga_of_origin` varchar(100) DEFAULT NULL,
  `nationality` varchar(150) DEFAULT NULL,
  `gender` enum('male','female') NOT NULL,
  `lecturer_path` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `marital_status` enum('single','married','divorced','widowed','others') DEFAULT NULL,
  `religion` enum('Christianity','Islam','Other') DEFAULT NULL,
  `role_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`ID`, `title`, `surname`, `firstname`, `middlename`, `email`, `phone_number`, `dob`, `status`, `address`, `state_of_origin`, `staff_no`, `lga_of_origin`, `nationality`, `gender`, `lecturer_path`, `marital_status`, `religion`, `role_id`) VALUES
(1, 'Dr.', 'Ladoja', 'Khadijah', 'Temitope', 'khaddy076@gmail.com', '09009994485', NULL, 1, NULL, 'Oyo', '7292', 'Ibadan North', 'Nigeria', 'male', NULL, 'single', 'Islam', 2);

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `ID` int NOT NULL,
  `level_name` varchar(150) NOT NULL,
  `description` text,
  `level_order` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`ID`, `level_name`, `description`, `level_order`) VALUES
(1, '100', 'First Year', 1),
(2, '200', NULL, 2),
(3, '300', NULL, 3),
(4, '400', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `next_of_kin`
--

CREATE TABLE `next_of_kin` (
  `ID` int NOT NULL,
  `surname` varchar(200) NOT NULL,
  `other_names` varchar(500) NOT NULL,
  `address` text,
  `phone_number` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `student_biodata_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `next_of_kin`
--

INSERT INTO `next_of_kin` (`ID`, `surname`, `other_names`, `address`, `phone_number`, `email`, `student_biodata_id`) VALUES
(2, 'Jinadu', 'Adebola', 'nigeria', '12345566', 'bamob@jkjdk.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `ID` int NOT NULL,
  `role_id` int NOT NULL,
  `path` varchar(100) DEFAULT NULL,
  `permission` enum('r','w') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`ID`, `role_id`, `path`, `permission`) VALUES
(1, 1, 'vc/create/course', 'w'),
(3, 1, 'vc/admin/view_model/session_semester_course', 'w'),
(4, 1, 'vc/create/student_biodata', 'w'),
(5, 1, 'vc/create/student_course_registration', 'w'),
(6, 1, 'vc/create/course_score', 'w'),
(7, 1, 'vc/create/admin', 'w'),
(8, 1, 'vc/create/lecturers', 'w'),
(9, 1, 'vc/create/role', 'w'),
(10, 1, 'vc/create/academic_session', 'w'),
(11, 1, 'vc/create/semester', 'w'),
(12, 1, 'vc/create/grade_scale', 'w'),
(68, 1, 'vc/admin/dashboard', 'w'),
(69, 1, 'vc/admin/permission', 'w'),
(1198, 1, 'vc/create/lecturer', 'w'),
(1753, 1, 'vc/student/profile', 'w'),
(1789, 1, 'vc/admin/profile', 'w'),
(2727, 1, 'vc/create/session_semester_course', 'w'),
(3738, 1, 'vc/admin/student_result', 'w');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `ID` int NOT NULL,
  `role_title` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`ID`, `role_title`, `status`) VALUES
(1, 'superadmin', 1),
(2, 'Senior Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `ID` int NOT NULL,
  `semester_name` varchar(100) NOT NULL,
  `is_last` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`ID`, `semester_name`, `is_last`) VALUES
(1, 'first', 0),
(2, 'second', 1);

-- --------------------------------------------------------

--
-- Table structure for table `session_semester_course`
--

CREATE TABLE `session_semester_course` (
  `ID` int NOT NULL,
  `course_status` varchar(5) NOT NULL,
  `course_id` int NOT NULL,
  `level_id` int NOT NULL,
  `course_unit` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session_semester_course`
--

INSERT INTO `session_semester_course` (`ID`, `course_status`, `course_id`, `level_id`, `course_unit`) VALUES
(1, 'C', 5, 3, 4),
(2, 'C', 4, 3, 3),
(3, 'C', 6, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `student_biodata`
--

CREATE TABLE `student_biodata` (
  `ID` int NOT NULL,
  `surname` varchar(150) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `middlename` varchar(150) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `email` text,
  `phone_number` text,
  `gender` varchar(10) DEFAULT NULL,
  `address` text,
  `state_of_origin` varchar(150) DEFAULT NULL,
  `lga_of_origin` varchar(150) DEFAULT NULL,
  `matric_number` varchar(150) NOT NULL,
  `registration_number` varchar(150) DEFAULT NULL,
  `academic_session_id` int NOT NULL,
  `entry_mode_id` int DEFAULT NULL,
  `student_biodata_path` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `nationality` varchar(150) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `marital_status` enum('single','married','divorced','widowed','others') DEFAULT NULL,
  `hall_of_residence` varchar(150) DEFAULT NULL,
  `religion` enum('Christianity','Islam','Other') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_biodata`
--

INSERT INTO `student_biodata` (`ID`, `surname`, `firstname`, `middlename`, `dob`, `email`, `phone_number`, `gender`, `address`, `state_of_origin`, `lga_of_origin`, `matric_number`, `registration_number`, `academic_session_id`, `entry_mode_id`, `student_biodata_path`, `nationality`, `status`, `marital_status`, `hall_of_residence`, `religion`) VALUES
(1, 'Alatise', 'Oluwaseun', NULL, '2015-03-11', 'holynationdevelopment@gmail.com', '07064625422', 'Male', NULL, 'Ogun', 'Ijebu Ode', '214860', '8465425FC', 3, 2, NULL, 'Nigeria', 1, 'single', NULL, 'Christianity');

-- --------------------------------------------------------

--
-- Table structure for table `student_course_registration`
--

CREATE TABLE `student_course_registration` (
  `ID` int NOT NULL,
  `student_biodata_id` int NOT NULL,
  `session_semester_course_id` int NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `academic_session_id` int NOT NULL,
  `semester_id` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_course_registration`
--

INSERT INTO `student_course_registration` (`ID`, `student_biodata_id`, `session_semester_course_id`, `date_registered`, `academic_session_id`, `semester_id`) VALUES
(1, 1, 2, '2023-02-14 09:23:20', 5, 1),
(2, 1, 1, '2023-02-14 21:02:47', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int NOT NULL,
  `username` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_type` enum('admin','lecturer','student_biodata') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'admin',
  `user_table_id` int NOT NULL,
  `has_change_password` tinyint(1) NOT NULL DEFAULT '0',
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_logout` timestamp NULL DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `username`, `password`, `user_type`, `user_table_id`, `has_change_password`, `last_logout`, `date_created`, `status`) VALUES
(1, 'admin@gmail.com', '$2y$10$BiOH3q7o8tJ49iBEjVtt0uCMmzVkLurvmZO3q5tFiHCactWOYWlu6', 'admin', 1, 1, NULL, '2023-02-13 23:10:54', 1),
(2, 'khaddy076@gmail.com', '$2y$10$ZwcfQKosLj7wp6Xa663ON.j89uzyVuJ4BmEyk/yTk5vh6BlCat6S2', 'lecturer', 0, 0, NULL, '2023-02-14 00:30:51', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_session`
--
ALTER TABLE `academic_session`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `session_name` (`session_name`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `course_title` (`course_title`,`course_code`);

--
-- Indexes for table `course_score`
--
ALTER TABLE `course_score`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `student_course_registration_id` (`student_course_registration_id`);

--
-- Indexes for table `entry_mode`
--
ALTER TABLE `entry_mode`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `mode_of_entry` (`mode_of_entry`);

--
-- Indexes for table `grade_scale`
--
ALTER TABLE `grade_scale`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `staff_no` (`staff_no`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `level_name` (`level_name`);

--
-- Indexes for table `next_of_kin`
--
ALTER TABLE `next_of_kin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `role_id` (`role_id`,`path`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `role_title` (`role_title`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `semester_name` (`semester_name`);

--
-- Indexes for table `session_semester_course`
--
ALTER TABLE `session_semester_course`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `course_id` (`course_id`,`course_unit`,`level_id`),
  ADD UNIQUE KEY `course_id_2` (`course_id`,`level_id`);

--
-- Indexes for table `student_biodata`
--
ALTER TABLE `student_biodata`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `matric_number` (`matric_number`);

--
-- Indexes for table `student_course_registration`
--
ALTER TABLE `student_course_registration`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `student_biodata_id` (`student_biodata_id`,`session_semester_course_id`,`academic_session_id`,`semester_id`),
  ADD UNIQUE KEY `student_biodata_id_2` (`student_biodata_id`,`session_semester_course_id`,`academic_session_id`,`semester_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_session`
--
ALTER TABLE `academic_session`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `course_score`
--
ALTER TABLE `course_score`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `entry_mode`
--
ALTER TABLE `entry_mode`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grade_scale`
--
ALTER TABLE `grade_scale`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lecturer`
--
ALTER TABLE `lecturer`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `next_of_kin`
--
ALTER TABLE `next_of_kin`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5438;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `session_semester_course`
--
ALTER TABLE `session_semester_course`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_biodata`
--
ALTER TABLE `student_biodata`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_course_registration`
--
ALTER TABLE `student_course_registration`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
