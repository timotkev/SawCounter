-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2016 at 06:03 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mapro_beta`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_milestones`
--

CREATE TABLE IF NOT EXISTS `tbl_milestones` (
  `id_milestones` int(11) NOT NULL,
  `id_projects` int(11) NOT NULL,
  `milestones` varchar(255) NOT NULL,
  `decription_milestones` text NOT NULL,
  `start_milestones` date NOT NULL,
  `end_milestones` date NOT NULL,
  `created_milestones` datetime NOT NULL,
  `update_milestones` datetime NOT NULL,
  `status_milestones` int(1) NOT NULL COMMENT '0 = No Finish, 1 = Finished'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_milestones`
--

INSERT INTO `tbl_milestones` (`id_milestones`, `id_projects`, `milestones`, `decription_milestones`, `start_milestones`, `end_milestones`, `created_milestones`, `update_milestones`, `status_milestones`) VALUES
(1, 2, 'Milestones Part I', 'Description Milestones Part I', '2016-09-03', '2016-09-05', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(2, 2, 'Milestones Part II', 'Description Milestones Part II', '2016-09-05', '2016-09-10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(3, 2, 'Milestones Part III', 'Description Milestones Part III', '2016-09-09', '2016-09-15', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(4, 2, 'Milestones Part IV', 'Description Milestones Part IV', '2016-09-15', '2016-09-25', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(5, 2, 'Milestones Part V', 'Description Milestones Part V', '2016-09-20', '2016-09-25', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(6, 2, 'Milestones Part VI', 'Description Milestones Part VI', '2016-09-26', '2016-09-30', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(8, 1, 'Milestones Pertama', 'Deskripsi Pertama', '2016-10-10', '2016-10-11', '2016-10-12 20:33:21', '0000-00-00 00:00:00', 0),
(9, 1, 'Milestones Kedua', 'Deskripsi Kedua', '2016-10-12', '2016-10-13', '2016-10-12 20:46:31', '0000-00-00 00:00:00', 0),
(10, 1, 'Milestones Ketiga', 'Deskripsi Ketiga', '2016-10-13', '2016-10-14', '2016-10-12 20:47:02', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permissions`
--

CREATE TABLE IF NOT EXISTS `tbl_permissions` (
  `id_permissions` int(11) NOT NULL,
  `permissions` varchar(100) NOT NULL,
  `parent_permissions` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_permissions`
--

INSERT INTO `tbl_permissions` (`id_permissions`, `permissions`, `parent_permissions`) VALUES
(1, 'Projects - Add', 31),
(2, 'Projects - Edit', 31),
(3, 'Projects - Delete', 31),
(4, 'Projects - Close', 31),
(5, 'Milestones - View', 32),
(6, 'Milestones - Add', 32),
(7, 'Milestones - Edit', 32),
(8, 'Milestones - Delete', 32),
(9, 'Milestones - Close', 32),
(10, 'Tasks - View', 33),
(11, 'Tasks - Add', 33),
(12, 'Tasks - Edit', 33),
(13, 'Tasks - Delete', 33),
(14, 'Tasks - Close', 33),
(15, 'Messages - View', 34),
(16, 'Messages - Add', 34),
(17, 'Messages - Edit', 34),
(18, 'Messages - Delete', 34),
(19, 'Messages - Answer', 34),
(20, 'Files - View', 35),
(21, 'Files - Add', 35),
(22, 'Files - Edit', 35),
(23, 'Files - Delete', 35),
(24, 'Timetracker - View', 36),
(25, 'Timetracker - Read', 36),
(26, 'Timetracker - Add', 36),
(27, 'Timetracker - Edit', 36),
(28, 'Timetracker - Delete', 36),
(29, 'Chat - Messaging', 37),
(30, 'Admin - System Administration', 38),
(31, 'Projects', 0),
(32, 'Milestones', 0),
(33, 'Tasks', 0),
(34, 'Messages', 0),
(35, 'Files', 0),
(36, 'Timetracker', 0),
(37, 'Chat', 0),
(38, 'Admin', 0),
(39, 'Customers', 1111111111),
(40, 'Customers - View', 39),
(41, 'Customers - Add', 39),
(42, 'Customers - Edit', 39),
(43, 'Customers - Delete', 39),
(44, 'Users', 0),
(45, 'Users - View', 44),
(46, 'Users - Add', 44),
(47, 'Users - Edit', 44),
(48, 'Users - Delete', 44),
(49, 'Roles', 0),
(50, 'Roles - View', 49),
(51, 'Roles - Add', 49),
(52, 'Roles - Edit', 49),
(53, 'Roles - Delete', 49);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_projects`
--

CREATE TABLE IF NOT EXISTS `tbl_projects` (
  `id_projects` int(11) NOT NULL,
  `projects` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start_projects` date NOT NULL,
  `end_projects` date NOT NULL,
  `budget` int(11) NOT NULL,
  `created_projects` datetime NOT NULL,
  `update_projects` datetime NOT NULL,
  `status` int(1) NOT NULL COMMENT '0 = No Finish, 1 = Finished'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_projects`
--

INSERT INTO `tbl_projects` (`id_projects`, `projects`, `description`, `start_projects`, `end_projects`, `budget`, `created_projects`, `update_projects`, `status`) VALUES
(1, 'Proyek Pertama', 'lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum ', '2016-10-01', '2016-10-31', 5000000, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_projects_assigned`
--

CREATE TABLE IF NOT EXISTS `tbl_projects_assigned` (
  `id_projects_assigned` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_projects` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_projects_assigned`
--

INSERT INTO `tbl_projects_assigned` (`id_projects_assigned`, `id_users`, `id_projects`) VALUES
(5, 1, 1),
(8, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE IF NOT EXISTS `tbl_roles` (
  `id_roles` int(3) NOT NULL,
  `roles` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`id_roles`, `roles`, `description`) VALUES
(1, 'Direktur', 'Direktur dapat memantau segala aktivitas yang terjadi dalam proyek, baik perkembangan proyek maupun aktivitas yang dilakukan user lain pada sebuah proyek. Tujuan utama seorang direktur adalah dapat melihat perkembangan proyek dan s-curve perkembangan proyek.'),
(2, 'Administrator', 'Admisitrator memiliki seluruh akses pada sistem. Tugas administrator adalah menjaga sistem agar berjalan dengan baik.'),
(3, 'Admin Input (Administrasi)', 'Admin Input adalah orang pertama yang memasukan data sebuah proyek berdasarkan data/berkas proyek. Tugas utama admin input adalah membuat project, milestones, task dan mengunggah file yang berkaitan pada proyek.'),
(4, 'Pimpinan Proyek', 'Pimpinan proyek adalah orang yang bertanggung jawab dalam sebuah proyek. Pimpinan proyek memiliki tugas utama yaitu untuk menutup milestones dan tasklist yang telah dikerjakan oleh tiap-tiap tenaga ahli. '),
(5, 'Tenaga Ahli', 'Tenaga ahli hanya dapat melihat, tugas mereka. Dan dapat melihat files yang bersangkutan mengenai proyek. Tenaga ahli merupakan orang yang mengerjakan sebuah proyek. Tenaga ahli lah yang mengerjakan apa yang ada pada tasklist.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles_assigned`
--

CREATE TABLE IF NOT EXISTS `tbl_roles_assigned` (
  `id_roles_assigned` int(11) NOT NULL,
  `id_roles` int(3) NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_roles_assigned`
--

INSERT INTO `tbl_roles_assigned` (`id_roles_assigned`, `id_roles`, `id_users`) VALUES
(1, 2, 1),
(2, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles_permissions`
--

CREATE TABLE IF NOT EXISTS `tbl_roles_permissions` (
  `id_roles_permissions` int(11) NOT NULL,
  `id_roles` int(11) NOT NULL,
  `id_permissions` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_roles_permissions`
--

INSERT INTO `tbl_roles_permissions` (`id_roles_permissions`, `id_roles`, `id_permissions`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(4, 2, 4),
(5, 2, 5),
(6, 2, 6),
(7, 2, 7),
(8, 2, 8),
(9, 2, 9),
(10, 2, 10),
(11, 2, 11),
(12, 2, 12),
(13, 2, 13),
(14, 2, 14),
(15, 2, 15),
(16, 2, 16),
(17, 2, 17),
(18, 2, 18),
(19, 2, 19),
(20, 2, 20),
(21, 2, 21),
(22, 2, 22),
(23, 2, 23),
(24, 2, 24),
(25, 2, 25),
(26, 2, 26),
(27, 2, 27),
(28, 2, 28),
(29, 2, 29),
(30, 2, 30),
(31, 2, 40),
(32, 2, 41),
(33, 2, 42),
(34, 2, 43),
(39, 2, 50),
(40, 2, 51),
(41, 2, 52),
(42, 2, 53),
(43, 2, 45),
(44, 2, 46),
(45, 2, 47),
(46, 2, 48);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE IF NOT EXISTS `tbl_settings` (
  `id_settings` int(11) NOT NULL,
  `setting_name` varchar(30) NOT NULL,
  `setting_value` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id_settings`, `setting_name`, `setting_value`) VALUES
(1, 'sys_name', 'PROJECT MANAGEMENT SYSTEMS'),
(2, 'sys_desc', 'Sistem Informasi Manajemen Proyek - PT Mitra Madani Consultant'),
(3, 'sys_keyword', 'sistem, informasi, manajemen, proyek, aplikasi, system, information, management, project, skripsi'),
(4, 'sys_email', 'administrator@gmail.com'),
(5, 'sys_pagination', '25'),
(6, 'sys_date', 'dd/mm/YYYY');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tasks`
--

CREATE TABLE IF NOT EXISTS `tbl_tasks` (
  `id_tasks` int(11) NOT NULL,
  `id_milestones` int(11) NOT NULL,
  `id_projects` int(11) NOT NULL,
  `tasks` varchar(255) NOT NULL,
  `decription_tasks` text NOT NULL,
  `due_tasks` date NOT NULL,
  `created_tasks` datetime NOT NULL,
  `update_tasks` datetime NOT NULL,
  `status_tasks` int(1) NOT NULL COMMENT '0 = No Finish, 1 = Finished'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tasks`
--

INSERT INTO `tbl_tasks` (`id_tasks`, `id_milestones`, `id_projects`, `tasks`, `decription_tasks`, `due_tasks`, `created_tasks`, `update_tasks`, `status_tasks`) VALUES
(1, 8, 1, 'Belajar 001', '0', '2016-10-11', '2016-10-12 22:38:33', '0000-00-00 00:00:00', 0),
(2, 8, 1, 'Belajar 002', '0', '2016-10-11', '2016-10-12 22:39:36', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tasks_assigned`
--

CREATE TABLE IF NOT EXISTS `tbl_tasks_assigned` (
  `id_tasks_assigned` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_tasks` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tasks_assigned`
--

INSERT INTO `tbl_tasks_assigned` (`id_tasks_assigned`, `id_users`, `id_tasks`) VALUES
(1, 1, 1),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id_users` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `active` tinyint(4) NOT NULL COMMENT '0 = Yes, 1 = No',
  `avatar` text NOT NULL,
  `last_login` datetime NOT NULL,
  `registered` datetime NOT NULL,
  `last_update` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id_users`, `username`, `password`, `email`, `fullname`, `active`, `avatar`, `last_login`, `registered`, `last_update`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@example.com', 'Administrator', 0, '6aca4b2fe70f11fe79a68f20b7546311.png', '2016-10-12 17:22:51', '2016-09-07 23:30:16', '2016-10-05 19:59:51'),
(2, 'admin.input', '91576d1b6e3026596be0871733c9d6a6', 'admin.input@example.com', 'Admin Input', 0, '', '2016-10-04 19:52:28', '2016-10-04 19:31:01', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_milestones`
--
ALTER TABLE `tbl_milestones`
  ADD PRIMARY KEY (`id_milestones`),
  ADD KEY `id_projects` (`id_projects`);

--
-- Indexes for table `tbl_permissions`
--
ALTER TABLE `tbl_permissions`
  ADD PRIMARY KEY (`id_permissions`);

--
-- Indexes for table `tbl_projects`
--
ALTER TABLE `tbl_projects`
  ADD PRIMARY KEY (`id_projects`);

--
-- Indexes for table `tbl_projects_assigned`
--
ALTER TABLE `tbl_projects_assigned`
  ADD PRIMARY KEY (`id_projects_assigned`),
  ADD KEY `id_projects` (`id_projects`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`id_roles`);

--
-- Indexes for table `tbl_roles_assigned`
--
ALTER TABLE `tbl_roles_assigned`
  ADD PRIMARY KEY (`id_roles_assigned`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `tbl_roles_permissions`
--
ALTER TABLE `tbl_roles_permissions`
  ADD PRIMARY KEY (`id_roles_permissions`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id_settings`);

--
-- Indexes for table `tbl_tasks`
--
ALTER TABLE `tbl_tasks`
  ADD PRIMARY KEY (`id_tasks`),
  ADD KEY `id_tasks` (`id_tasks`),
  ADD KEY `id_milestones` (`id_milestones`),
  ADD KEY `id_projects` (`id_projects`);

--
-- Indexes for table `tbl_tasks_assigned`
--
ALTER TABLE `tbl_tasks_assigned`
  ADD PRIMARY KEY (`id_tasks_assigned`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `id_tasks` (`id_tasks`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_milestones`
--
ALTER TABLE `tbl_milestones`
  MODIFY `id_milestones` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_permissions`
--
ALTER TABLE `tbl_permissions`
  MODIFY `id_permissions` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `tbl_projects`
--
ALTER TABLE `tbl_projects`
  MODIFY `id_projects` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_projects_assigned`
--
ALTER TABLE `tbl_projects_assigned`
  MODIFY `id_projects_assigned` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `id_roles` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_roles_assigned`
--
ALTER TABLE `tbl_roles_assigned`
  MODIFY `id_roles_assigned` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_roles_permissions`
--
ALTER TABLE `tbl_roles_permissions`
  MODIFY `id_roles_permissions` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id_settings` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_tasks`
--
ALTER TABLE `tbl_tasks`
  MODIFY `id_tasks` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_tasks_assigned`
--
ALTER TABLE `tbl_tasks_assigned`
  MODIFY `id_tasks_assigned` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_projects_assigned`
--
ALTER TABLE `tbl_projects_assigned`
  ADD CONSTRAINT `DELETE PROJECT` FOREIGN KEY (`id_projects`) REFERENCES `tbl_projects` (`id_projects`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_roles_assigned`
--
ALTER TABLE `tbl_roles_assigned`
  ADD CONSTRAINT `DELETE USERS` FOREIGN KEY (`id_users`) REFERENCES `tbl_users` (`id_users`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_tasks_assigned`
--
ALTER TABLE `tbl_tasks_assigned`
  ADD CONSTRAINT `DELETE TASKS` FOREIGN KEY (`id_tasks`) REFERENCES `tbl_tasks` (`id_tasks`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
