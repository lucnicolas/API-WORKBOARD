-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 21, 2020 at 09:41 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `workboard_remote`
--

-- --------------------------------------------------------

--
-- Table structure for table `boards`
--

CREATE TABLE `boards` (
  `id` int(11) NOT NULL,
  `sync_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `path` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `localisation` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `is_sync` varchar(255) DEFAULT NULL,
  `last_update_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `boards`
--

INSERT INTO `boards` (`id`, `sync_at`, `path`, `name`, `localisation`, `address`, `status`, `is_sync`, `last_update_date`) VALUES
(1, '2020-07-06 10:03:02', 'uploads/5f02dab6a40d0.jpg', 'Board projectjk', 'dfYssingeauxjjjjkklds', '(37.422,-12jk2.084,5.0)', 'true', 'false', '2020-07-06_10:00:45:382'),
(2, '2020-07-06 10:23:07', 'uploads/5f02df6b8c89f.jpg', 'Chantier n*2', '(37.422,-122.084,0.0)', 'Nimes, 30000', 'true', 'false', '2020-07-06_10:21:13:925'),
(3, '2020-07-06 14:43:03', 'uploads/5f031c57d4761.jpg', 'Chantier 1', '(37.422,-122.084,5.0)', 'Nimes', 'true', 'false', '2020-07-06_14:40:53:625');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `sync_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `faxNumber` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `is_sync` varchar(255) DEFAULT NULL,
  `last_update_date` varchar(255) DEFAULT NULL,
  `lot` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `sync_at`, `name`, `address`, `phoneNumber`, `faxNumber`, `email`, `is_sync`, `last_update_date`, `lot`) VALUES
(1, '2020-07-06 10:23:07', 'Entreprise X', 'Adresse', '', '', '', 'false', '2020-07-06_10:20:13:908', NULL),
(2, '2020-07-06 10:23:07', 'Entreprise Y', '', '', '', '', 'false', '2020-07-06_10:21:13:875', NULL),
(3, '2020-07-06 10:23:07', 'Entreprise M', '', '', '', '', 'false', '2020-07-06_10:21:13:880', NULL),
(4, '2020-07-06 10:23:07', 'Entreprise M', '', '', '', '', 'false', '2020-07-06_10:21:13:880', NULL),
(5, '2020-07-06 14:43:03', 'Entreprise Z', '', '0683838383', '', '', 'false', '2020-07-06_14:42:05:323', NULL),
(6, '2020-07-06 14:43:03', 'Démo', 'Addr', '+33605050505', '', 'adresse@mail.com', 'false', '2020-07-06_14:40:53:578', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boards`
--
ALTER TABLE `boards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
