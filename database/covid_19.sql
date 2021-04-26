-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2021 at 08:40 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `covid_19`
--

-- --------------------------------------------------------

--
-- Table structure for table `centre_officer`
--

CREATE TABLE `centre_officer` (
  `id_centre_officer` char(20) NOT NULL,
  `position` varchar(100) DEFAULT NULL,
  `id_test_centre` char(20) DEFAULT NULL,
  `flag_aktif` smallint(1) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `centre_officer`
--

INSERT INTO `centre_officer` (`id_centre_officer`, `position`, `id_test_centre`, `flag_aktif`, `created`, `modified`) VALUES
('CO20210330010007PTh', 'Test Center Officer', 'TC202103290127071cs', 1, '2021-03-30 01:00:07', '2021-03-30 01:00:07'),
('CO20210330010012x2a', 'Tester', 'TC202103290127071cs', 1, '2021-03-30 01:00:12', '2021-03-30 01:00:12');

-- --------------------------------------------------------

--
-- Table structure for table `covid_test`
--

CREATE TABLE `covid_test` (
  `id_covid_test` char(20) NOT NULL,
  `id_patient` char(20) DEFAULT NULL,
  `id_test_kit` char(20) DEFAULT NULL,
  `test_date` date DEFAULT NULL,
  `result` varchar(200) DEFAULT NULL,
  `result_date` date DEFAULT NULL,
  `status` enum('Pending','Complete') DEFAULT NULL,
  `flag_aktif` smallint(1) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `covid_test`
--

INSERT INTO `covid_test` (`id_covid_test`, `id_patient`, `id_test_kit`, `test_date`, `result`, `result_date`, `status`, `flag_aktif`, `created`, `modified`) VALUES
('CT20210330003106Gpb', 'P20210329222918kgv', 'TK20210329230449FMo', '2021-03-30', '', '0000-00-00', 'Pending', 1, '2021-03-30 00:31:06', '2021-03-30 01:13:35');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id_patient` char(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `symptoms` varchar(100) DEFAULT NULL,
  `flag_aktif` smallint(1) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id_patient`, `name`, `type`, `symptoms`, `flag_aktif`, `created`, `modified`) VALUES
('P20210329222918kgv', 'Andika', 'SWAB', '-', 1, '2021-03-29 22:29:18', '2021-03-29 22:29:18');

-- --------------------------------------------------------

--
-- Table structure for table `test_centre`
--

CREATE TABLE `test_centre` (
  `id_test_centre` char(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `flag_aktif` smallint(1) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_centre`
--

INSERT INTO `test_centre` (`id_test_centre`, `name`, `flag_aktif`, `created`, `modified`) VALUES
('TC202103290054436oD', 'Kimia Farma', 1, '2021-03-29 00:54:43', '2021-03-29 00:54:43'),
('TC202103290127071cs', 'International Test Centre', 1, '2021-03-29 01:27:07', '2021-03-29 01:27:07');

-- --------------------------------------------------------

--
-- Table structure for table `test_kit`
--

CREATE TABLE `test_kit` (
  `id_test_kit` char(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `available_stock` enum('Yes','No') DEFAULT NULL,
  `id_test_centre` char(20) DEFAULT NULL,
  `flag_aktif` smallint(1) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_kit`
--

INSERT INTO `test_kit` (`id_test_kit`, `name`, `available_stock`, `id_test_centre`, `flag_aktif`, `created`, `modified`) VALUES
('TK20210329230449FMo', 'SWAB Antigen', 'Yes', 'TC202103290127071cs', 1, '2021-03-29 23:04:49', '2021-03-29 23:04:49'),
('TK20210329230457J3F', 'Rapid Test', 'Yes', 'TC202103290127071cs', 1, '2021-03-29 23:04:57', '2021-03-29 23:04:57');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` char(20) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `id_user_level` smallint(3) DEFAULT NULL,
  `id_user_table` char(20) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `flag_aktif` smallint(1) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `id_user_level`, `id_user_table`, `fullname`, `flag_aktif`, `created`, `modified`) VALUES
('U20200413155850hor', 'admin', '$2y$12$adoM2geXUi2lv5KcuFn7rea04.mP8Bi70cjrqNwDyKNSf8VgX6kOy', 1, 'Administrator', 'Administrator', 1, '2020-04-13 15:58:50', '2020-05-16 15:04:10'),
('U20210329222738BYn', 'manager', '$2y$12$hklj9PFOF3pRb6S4WQpKVefDz2guZ112rUTW8GHv2/xRTJUa7Y4hC', 2, 'TC202103290127071cs', 'Test Centre Manager', 1, '2021-03-29 22:27:39', '2021-03-29 22:27:39'),
('U20210329222943ohT', 'andika', '$2y$12$H4R..LjuaDol.nuXotfYz.m4e41gVx/VA0LWepxpKYAR8WiWFhWUy', 5, 'P20210329222918kgv', 'Andika', 1, '2021-03-29 22:29:43', '2021-03-29 22:29:43'),
('U20210329223555e9H', 'tester', '$2y$12$yboEuVM2/zyCMoKAJ11rqeJj7odDJNyE8IVo0okYlIIVh98Mu1t6K', 4, 'CO20210330010012x2a', 'Tester', 1, '2021-03-29 22:35:55', '2021-03-29 22:35:55'),
('U20210330011113d3t', 'officer', '$2y$12$OYdLSzod2Pxpt0xmueowmuP0pHwFtK5lbScMShO4L0qgRUsTrPPrW', 3, 'CO20210330010007PTh', 'Officer', 1, '2021-03-30 01:11:13', '2021-03-30 01:11:13');

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `id` smallint(3) NOT NULL,
  `name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Test Centre Manager'),
(3, 'Test Centre Officer'),
(4, 'Tester'),
(5, 'Patient');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `centre_officer`
--
ALTER TABLE `centre_officer`
  ADD PRIMARY KEY (`id_centre_officer`);

--
-- Indexes for table `covid_test`
--
ALTER TABLE `covid_test`
  ADD PRIMARY KEY (`id_covid_test`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id_patient`);

--
-- Indexes for table `test_centre`
--
ALTER TABLE `test_centre`
  ADD PRIMARY KEY (`id_test_centre`);

--
-- Indexes for table `test_kit`
--
ALTER TABLE `test_kit`
  ADD PRIMARY KEY (`id_test_kit`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id` smallint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
