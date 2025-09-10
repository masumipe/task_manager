-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2025 at 04:08 PM
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
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `icon` varchar(50) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `url`, `parent_id`, `icon`, `sort_order`) VALUES
(1, 'Dashboard', '/dashboard', 0, 'fa-solid fa-gauge', 1),
(2, 'Residents', NULL, 0, 'fa-solid fa-users', 2),
(3, 'Finance', NULL, 0, 'fa-solid fa-money-bill', 3),
(4, 'Reports', NULL, 0, 'fa-solid fa-chart-bar', 4),
(5, 'Owners', '/owners', 2, 'fa-solid fa-user-tie', 1),
(6, 'Tenants', '/tenants', 2, 'fa-solid fa-user', 2),
(7, 'Collections', '/collections', 3, 'fa-solid fa-coins', 1),
(8, 'Expenses', '/expenses', 3, 'fa-solid fa-receipt', 2),
(9, 'Service Charges', '/servicecharges', 3, 'fa-solid fa-file-invoice-dollar', 3),
(10, 'Batch Service Charges', '/servicecharges/batchcreate', 3, 'fa-solid fa-layer-group', 4),
(11, 'Overdue summary', '/reports/overdue', 4, 'fa-solid fa-exclamation-circle', 1),
(12, 'Overdue details', '/reports/overduedetails', 4, 'fa-solid fa-exclamation-circle', 1),
(13, 'Cash Summary', '/reports/cashsummary', 4, 'fa-solid fa-cash-register', 2),
(14, 'Batch Expense Create', 'expenses/batchcreate', 3, 'fa-solid fa-exclamation-circle', 5),
(15, 'Monthly Cash In/Outflow', '/reports/monthlycf', 4, 'fa-solid fa-cash-register', 2);

-- --------------------------------------------------------

--
-- Table structure for table `menu_permission`
--

DROP TABLE IF EXISTS `menu_permission`;
CREATE TABLE `menu_permission` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `menu_id` int(10) NOT NULL,
  `permission` int(10) NOT NULL,
  `createdby` int(10) NOT NULL,
  `updatedate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `menu_permission`
--

INSERT INTO `menu_permission` (`id`, `user_id`, `menu_id`, `permission`, `createdby`, `updatedate`) VALUES
(0, 4, 1, 1, 1, '2025-06-14 14:55:39'),
(0, 4, 2, 1, 1, '2025-06-14 14:55:39'),
(0, 4, 3, 1, 1, '2025-06-14 14:55:39'),
(0, 4, 4, 1, 1, '2025-06-14 14:55:39'),
(0, 4, 5, 1, 1, '2025-06-14 14:55:39'),
(0, 4, 6, 1, 1, '2025-06-14 14:55:39'),
(0, 4, 7, 1, 1, '2025-06-14 14:55:39'),
(0, 4, 8, 1, 1, '2025-06-14 14:55:39'),
(0, 4, 9, 1, 1, '2025-06-14 14:55:39'),
(0, 4, 10, 1, 1, '2025-06-14 14:55:39'),
(0, 4, 11, 1, 1, '2025-06-14 14:55:39'),
(0, 4, 12, 1, 1, '2025-06-14 14:55:39'),
(0, 4, 13, 1, 1, '2025-06-14 14:55:39'),
(0, 4, 14, 1, 1, '2025-08-16 13:47:46'),
(0, 4, 15, 1, 0, '2025-08-29 17:08:56');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `can_view` tinyint(1) DEFAULT 0,
  `can_edit` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `phone_number` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `phone_number`, `password_hash`, `full_name`, `created_at`) VALUES
(4, '01911491237', '$2y$10$rMymeAQA2BVm6tshhMdJ7.V0/MFRiLaK2nBhm6jaMnpbf9dLORAf.', 'Admin', '2025-02-08 04:14:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
