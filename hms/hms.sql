-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 20, 2025 at 01:54 AM
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
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'admin', 'admin@example.com', '$2y$10$xLVHDzq2X4c49Vnr2bFg.OSutkraM98HUzoRqXJyzL6uuTGiTACkq', '2025-07-09 01:21:58');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `consultancy_fee` decimal(10,2) NOT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_id`, `doctor_id`, `appointment_date`, `appointment_time`, `consultancy_fee`, `status`, `created_at`) VALUES
(2, 1, 9, '2025-07-14', '15:00:00', 125.00, 'Canceled by you', '2025-07-13 20:09:48'),
(3, 1, 8, '2025-07-21', '15:30:00', 100.00, 'Canceled by you', '2025-07-13 21:23:52'),
(4, 1, 9, '2025-07-13', '18:56:00', 125.00, 'Canceled by you', '2025-07-14 00:56:39'),
(5, 1, 9, '2025-07-19', '15:00:00', 125.00, 'Pending', '2025-07-19 17:23:51'),
(6, 1, 9, '2025-07-19', '18:00:00', 125.00, 'Pending', '2025-07-19 21:17:58'),
(7, 1, 13, '2025-07-19', '18:00:00', 500.00, 'Pending', '2025-07-19 21:21:27'),
(8, 1, 8, '2025-07-20', '17:00:00', 500.00, 'Pending', '2025-07-19 21:22:44'),
(9, 1, 10, '2025-07-23', '18:00:00', 500.00, 'Pending', '2025-07-19 21:36:42'),
(10, 1, 13, '2025-07-23', '18:00:00', 500.00, 'Pending', '2025-07-19 21:38:06'),
(11, 1, 7, '2025-07-25', '19:00:00', 500.00, 'Pending', '2025-07-19 21:39:16');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `mobile_no` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `Query_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email_address`, `mobile_no`, `message`, `Query_date`, `admin_remark`) VALUES
(1, 'Manvir Singh', 'manvirsinghghatorey104@gmail.com', '9915803830', 'This is for testing', '2025-07-11 02:14:10', 'Contact the patient'),
(2, 'prince', 'prince123@gmail.com', '1234567890', 'testing', '2025-07-11 02:15:39', 'Contact the patient'),
(3, 'sham', 'sham@gmail.com', '1234567890', 'contact', '2025-07-18 22:08:28', 'Contact the doctor'),
(4, 'paras', 'paras@test.com', '1234567890', 'test', '2025-07-18 22:10:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `specialization_id` int(11) NOT NULL,
  `doctor_name` text NOT NULL,
  `doctor_clinic_address` varchar(255) NOT NULL,
  `doctor_consultancy_fee` decimal(65,0) NOT NULL,
  `doctor_contact_number` text NOT NULL,
  `doctor_email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `specialization_id`, `doctor_name`, `doctor_clinic_address`, `doctor_consultancy_fee`, `doctor_contact_number`, `doctor_email`, `password`, `created_at`) VALUES
(7, 12, 'Rajan gupta', 'basant avenue, ludhiana', 500, '9182831647', 'ranjan@example.com', '$2y$10$XrItSBUiPfBXnc2y6CKTmeA0wD53rWwBRmurhXg4HRfs8mEPEHCx6', '2025-07-17 15:03:48'),
(8, 11, 'BS Paul', 'Sarabha Nagar,Near Ferozpur Road,Ludhiana ,141003', 500, '1234567890', 'bspaul@example.com', '$2y$10$1Ld2CZtagQtQ9mpGvPKi/eS0g8nmspoQ66Z0Hjh1/oHbI7WOpNxpy', '2025-07-18 23:24:27'),
(9, 9, 'raj', 'ludhiana', 125, '9182831647', 'raj@gmail.com', '$2y$10$EiAogNL41OB/TBpDG7Hutum3gi6s16sUHw1UOUZyaADxL.PfsZrQG', '2025-07-13 00:05:34'),
(10, 13, 'Manvir singh', 'sahnewal road,ludhiana', 500, '1234567890', 'manvir@test.com', '$2y$10$QiWQpqgie.F9hyn9vzi03uirLCQz4WwRG8J4McZ0gWxs.02Yt.97e', '2025-07-18 21:21:06'),
(11, 10, 'Ranjan kumar', 'ludhiana', 200, '1234567890', 'ranjan@example.com', '$2y$10$jqmlkLQ78/FNH.yiCS4cMOQW0a8e7zaTSClCD7RbBXp3eq7RNh/JC', '2025-07-18 21:25:57'),
(13, 11, 'jaspreet', 'Gill chowk,ludhiana', 500, '12345678900', 'jaspreet@test.com', '$2y$10$DuiCmuUfI.IsIB1qjIXd9.5NwuITo90ltT/iR2eEQy5Cu4R/QiNIa', '2025-07-18 21:31:45');

-- --------------------------------------------------------

--
-- Table structure for table `doctorslog`
--

CREATE TABLE `doctorslog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `userip` varchar(50) DEFAULT NULL,
  `loginTime` datetime DEFAULT NULL,
  `logoutTime` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctorslog`
--

INSERT INTO `doctorslog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logoutTime`, `status`) VALUES
(1, 8, 'bspaul@example.com', '::1', '2025-07-18 11:24:54', '2025-07-18 11:26:48', 1),
(2, 8, 'bspaul@example.com', '::1', '2025-07-18 11:27:41', NULL, 1),
(3, 8, 'bspaul@example.com', '::1', '2025-07-18 12:01:13', NULL, 1),
(4, 8, 'bspaul@example.com', '::1', '2025-07-18 17:06:13', NULL, 1),
(5, 8, 'bspaul@example.com', '::1', '2025-07-18 17:10:50', NULL, 1),
(6, 8, 'bspaul@example.com', '::1', '2025-07-18 17:24:16', '2025-07-18 17:36:36', 1),
(7, NULL, 'prince123@gmail.com', '::1', '2025-07-18 17:36:43', NULL, 0),
(8, NULL, 'raj@gmail.com', '::1', '2025-07-18 18:06:07', NULL, 0),
(9, 9, 'raj@gmail.com', '::1', '2025-07-18 18:06:14', '2025-07-18 19:29:58', 1),
(10, NULL, 'raj@gmail.com', '::1', '2025-07-18 19:31:00', NULL, 0),
(11, 9, 'raj@gmail.com', '::1', '2025-07-18 19:31:13', NULL, 1),
(12, NULL, 'raj@gmail.com', '::1', '2025-07-18 19:33:23', NULL, 0),
(13, 9, 'raj@gmail.com', '::1', '2025-07-18 21:04:00', '2025-07-18 21:04:23', 1),
(14, 9, 'raj@gmail.com', '::1', '2025-07-19 08:43:51', '2025-07-19 08:55:00', 1),
(15, 9, 'raj@gmail.com', '::1', '2025-07-19 09:07:14', '2025-07-19 09:07:56', 1),
(16, 9, 'raj@gmail.com', '::1', '2025-07-19 09:08:04', '2025-07-19 09:12:01', 1),
(17, 9, 'raj@gmail.com', '::1', '2025-07-19 09:50:23', NULL, 1),
(18, 9, 'raj@gmail.com', '::1', '2025-07-19 14:57:36', '2025-07-19 15:02:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctors_specialization`
--

CREATE TABLE `doctors_specialization` (
  `id` int(11) NOT NULL,
  `specialization` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors_specialization`
--

INSERT INTO `doctors_specialization` (`id`, `specialization`, `created_at`, `updated_at`) VALUES
(9, 'Ortheologists', '2025-07-18 21:09:26', '2025-07-18 21:09:26'),
(10, 'Neurologists', '2025-07-18 21:09:33', '2025-07-18 21:09:33'),
(11, 'Medicine', '2025-07-12 18:35:29', NULL),
(12, 'Homeopathic', '2025-07-12 18:35:33', NULL),
(13, 'Surgeon', '2025-07-18 21:18:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblmedicalhistory`
--

CREATE TABLE `tblmedicalhistory` (
  `ID` int(11) NOT NULL,
  `PatientID` int(11) NOT NULL,
  `BloodPressure` varchar(50) NOT NULL,
  `BloodSugar` varchar(50) NOT NULL,
  `Weight` varchar(50) NOT NULL,
  `Temperature` varchar(50) NOT NULL,
  `MedicalPres` text NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblmedicalhistory`
--

INSERT INTO `tblmedicalhistory` (`ID`, `PatientID`, `BloodPressure`, `BloodSugar`, `Weight`, `Temperature`, `MedicalPres`, `CreationDate`) VALUES
(1, 11, '80/120', '120', '85', '98', 'NA', '2025-07-18 16:44:55');

-- --------------------------------------------------------

--
-- Table structure for table `tblpatient`
--

CREATE TABLE `tblpatient` (
  `id` int(11) NOT NULL,
  `Docid` int(11) NOT NULL,
  `PatientName` varchar(100) NOT NULL,
  `PatientContno` varchar(20) NOT NULL,
  `PatientEmail` varchar(100) NOT NULL,
  `PatientGender` enum('Male','Female') NOT NULL,
  `PatientAdd` varchar(255) NOT NULL,
  `PatientAge` int(11) NOT NULL,
  `PatientMedhis` text DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UpdationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpatient`
--

INSERT INTO `tblpatient` (`id`, `Docid`, `PatientName`, `PatientContno`, `PatientEmail`, `PatientGender`, `PatientAdd`, `PatientAge`, `PatientMedhis`, `CreationDate`, `UpdationDate`) VALUES
(1, 8, 'Harry', '1234567890', 'harry@gmail.com', 'Male', 'Ludhiana', 25, 'NA', '2025-07-19 17:18:42', '0000-00-00 00:00:00'),
(8, 8, 'raju', '1234567890', 'raju@test.com', 'Male', 'Moga', 30, 'Test', '2025-07-18 20:22:11', '2025-07-18 16:11:05'),
(11, 9, 'mohan', '0987654321', 'mohan123@gmail.com', 'Male', 'Jagraon', 35, 'N/A', '2025-07-18 20:37:48', '2025-07-15 16:39:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` text DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `address`, `city`, `gender`, `email`, `password`) VALUES
(1, 'prince', 'basant nagar ,near daba chowk ,new janta nagar', 'Barnala', 'Male', 'prince123@gmail.com', '$2y$10$eKd5lOYoEQFSURobx1mS/.6wVYpSIiVurdaiCowz9jUJB8/iJ9w.S');

-- --------------------------------------------------------

--
-- Table structure for table `userslog`
--

CREATE TABLE `userslog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` varchar(100) DEFAULT NULL,
  `loginTime` datetime DEFAULT NULL,
  `logout` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userslog`
--

INSERT INTO `userslog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(1, 1, 'prince123@gmail.com', '::1', '2025-07-18 11:39:02', '2025-07-18 11:39:17', 1),
(2, 1, 'prince123@gmail.com', '::1', '2025-07-18 16:23:05', NULL, 1),
(3, 1, 'prince123@gmail.com', '::1', '2025-07-18 17:05:33', '2025-07-18 17:09:29', 1),
(4, 1, 'prince123@gmail.com', '::1', '2025-07-18 17:10:05', '2025-07-18 17:23:35', 1),
(5, 1, 'prince123@gmail.com', '::1', '2025-07-18 17:23:40', NULL, 1),
(6, 1, 'prince123@gmail.com', '::1', '2025-07-18 17:37:24', NULL, 1),
(7, NULL, 'prince123@gmail.com', '::1', '2025-07-18 17:38:14', NULL, 0),
(8, NULL, 'prince123@gmail.com', '::1', '2025-07-18 17:38:18', NULL, 0),
(9, NULL, 'prince123@gmail.com', '::1', '2025-07-18 17:41:25', NULL, 0),
(10, NULL, 'prince123@gmail.com', '::1', '2025-07-18 17:41:29', NULL, 0),
(11, 1, 'prince123@gmail.com', '::1', '2025-07-18 17:41:44', '2025-07-18 17:42:08', 1),
(12, 1, 'prince123@gmail.com', '::1', '2025-07-18 17:42:13', NULL, 1),
(13, NULL, 'prince123@gmail.com', '::1', '2025-07-18 18:05:14', NULL, 0),
(14, 1, 'prince123@gmail.com', '::1', '2025-07-18 18:05:18', NULL, 1),
(15, NULL, 'prince123@gmail.com', '::1', '2025-07-18 20:35:52', NULL, 0),
(16, 1, 'prince123@gmail.com', '::1', '2025-07-18 20:35:58', NULL, 1),
(17, 1, 'prince123@gmail.com', '::1', '2025-07-18 20:40:01', NULL, 1),
(18, 1, 'prince123@gmail.com', '::1', '2025-07-18 20:46:53', NULL, 1),
(19, NULL, 'prince123@gmail.com', '::1', '2025-07-19 08:39:56', NULL, 0),
(20, NULL, 'prince123@gmail.com', '::1', '2025-07-19 08:40:13', NULL, 0),
(21, 1, 'prince123@gmail.com', '::1', '2025-07-19 08:40:19', NULL, 1),
(22, 1, 'prince123@gmail.com', '::1', '2025-07-19 09:06:43', NULL, 1),
(23, 1, 'prince123@gmail.com', '::1', '2025-07-19 09:12:15', NULL, 1),
(24, 1, 'prince123@gmail.com', '::1', '2025-07-19 11:23:28', NULL, 1),
(25, 1, 'prince123@gmail.com', '::1', '2025-07-19 12:38:43', NULL, 1),
(26, 1, 'prince123@gmail.com', '::1', '2025-07-19 12:46:07', NULL, 1),
(27, 1, 'prince123@gmail.com', '::1', '2025-07-19 14:46:22', '2025-07-19 14:46:34', 1),
(28, 1, 'prince123@gmail.com', '::1', '2025-07-19 14:47:50', '2025-07-19 14:57:15', 1),
(29, 1, 'prince123@gmail.com', '::1', '2025-07-19 15:01:33', NULL, 1),
(30, 1, 'prince123@gmail.com', '::1', '2025-07-19 15:11:12', '2025-07-19 17:10:31', 1),
(31, 1, 'prince123@gmail.com', '::1', '2025-07-19 17:18:35', '2025-07-19 17:19:38', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_specialization_id` (`specialization_id`);

--
-- Indexes for table `doctorslog`
--
ALTER TABLE `doctorslog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors_specialization`
--
ALTER TABLE `doctors_specialization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `PatientID` (`PatientID`);

--
-- Indexes for table `tblpatient`
--
ALTER TABLE `tblpatient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Docid` (`Docid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userslog`
--
ALTER TABLE `userslog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `doctorslog`
--
ALTER TABLE `doctorslog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `doctors_specialization`
--
ALTER TABLE `doctors_specialization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblpatient`
--
ALTER TABLE `tblpatient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userslog`
--
ALTER TABLE `userslog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `fk_doctor_specialization` FOREIGN KEY (`specialization_id`) REFERENCES `doctors_specialization` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  ADD CONSTRAINT `tblmedicalhistory_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `tblpatient` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tblpatient`
--
ALTER TABLE `tblpatient`
  ADD CONSTRAINT `tblpatient_ibfk_1` FOREIGN KEY (`Docid`) REFERENCES `doctors` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
