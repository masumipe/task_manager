-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2025 at 10:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `task_monitor`
--
CREATE DATABASE IF NOT EXISTS `task_monitor` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `task_monitor`;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `page_type` varchar(50) DEFAULT 'page', -- page, report, dashboard, etc.
  `is_active` tinyint(1) DEFAULT 1, -- 1=active, 0=inactive
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `icon` varchar(50) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `type` varchar(20) DEFAULT 'link', -- link, dropdown, separator
  `visible` tinyint(1) DEFAULT 1, -- 1=visible, 0=hidden
  `permission_type` varchar(20) DEFAULT 'view' -- view, create, update, delete
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `url`, `parent_id`, `icon`, `sort_order`) VALUES
(1, 'Dashboard', '/dashboard', 0, 'fa-solid fa-gauge', 1),
(2, 'Users', NULL, 0, 'fa-solid fa-users', 2),
(3, 'Tasks', NULL, 0, 'fa-solid fa-money-bill', 3),
(4, 'Reports', NULL, 0, 'fa-solid fa-chart-bar', 4);

-- --------------------------------------------------------

--
-- Table structure for table `menu_permission`
--

DROP TABLE IF EXISTS `menu_permission`;
CREATE TABLE `menu_permission` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `menu_id` int(10) NOT NULL,
  `can_view` tinyint(1) DEFAULT 1,
  `can_view_page` tinyint(1) DEFAULT 1,
  `can_create` tinyint(1) DEFAULT 0,
  `can_update` tinyint(1) DEFAULT 0,
  `can_delete` tinyint(1) DEFAULT 0,
  `createdby` int(10) NOT NULL,
  `updatedate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `menu_permission`
--

INSERT INTO `menu_permission` (`id`, `user_id`, `menu_id`, `can_view`, `can_create`, `can_update`, `can_delete`, `createdby`, `updatedate`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, '2025-06-14 14:55:39'),
(2, 1, 2, 1, 0, 0, 0, 1, '2025-06-14 14:55:39'),
(3, 1, 3, 1, 1, 1, 0, 1, '2025-06-14 14:55:39'),
(4, 1, 4, 1, 0, 0, 0, 1, '2025-06-14 14:55:39');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_name`) VALUES
(1, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

DROP TABLE IF EXISTS `role_permission`;
CREATE TABLE `role_permission` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `table_name` varchar(100) NOT NULL,
  `create_permission` int(11) NOT NULL,
  `read_permission` int(11) NOT NULL,
  `update_permissionm` int(11) NOT NULL,
  `delete_permission` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`id`, `role_id`, `table_name`, `create_permission`, `read_permission`, `update_permissionm`, `delete_permission`, `created_at`, `created_by`) VALUES
(1, 1, 'menus', 1, 1, 1, 1, '2025-09-10 20:01:46', 1),
(2, 1, 'users', 1, 1, 1, 1, '2025-09-10 20:03:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `assigned_to` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `priority` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  `remarks` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `functional_designation` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `telephone_number` varchar(255) DEFAULT NULL,
  `telephone_extension` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password_hash`, `full_name`, `designation`, `functional_designation`, `role_id`, `phone_number`, `telephone_number`, `telephone_extension`, `email`, `created_at`, `created_by`) VALUES
(1, 'rashed', '$2y$10$rMymeAQA2BVm6tshhMdJ7.V0/MFRiLaK2nBhm6jaMnpbf9dLORAf.', 'Mohammad Rashedul Islam', 'Managing Director (CC)', 'Managing Director', 1, '01911491237', NULL, NULL, 'rashed@blilbd.com', '2025-09-10 19:58:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `user_id`, `user_role`) VALUES
(1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_permission`
--
ALTER TABLE `menu_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu_permission`
--
ALTER TABLE `menu_permission`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;


