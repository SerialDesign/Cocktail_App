-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 29, 2021 at 09:50 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `cocktail_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(5) UNSIGNED NOT NULL COMMENT 'User ID',
  `username` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL COMMENT 'User email address',
  `password` varchar(200) NOT NULL COMMENT 'User password',
  `reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'The time and date the user registered'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Users table';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `reg_time`) VALUES
(8, 'Cyrill', 'cyrill@sae.ch', '$2y$10$TPuDTYhsXwQWpSbGWn9/UuOvs31tqQm5aixhfPlUCUAJyBfg40Mj.', '2021-04-28 21:31:04'),
(11, 'HeavyDrinker', 'heavy@drinker.com', '$2y$10$1xC3oVZWr3C9cOIXZIvUreq.WvETSXUHttorysIclAcbUgOWa6smy', '2021-04-29 21:05:36'),
(12, 'Inglina', 'inglina@uni.ch', '$2y$10$VqdOS7Gl0/FU4r.1JDHRLe3uSZfQOSDqfGMeAQOXySruBRblHp4Ve', '2021-04-29 21:09:26');

-- --------------------------------------------------------

--
-- Table structure for table `user_list_of_drinks`
--

CREATE TABLE `user_list_of_drinks` (
  `drink_id` int(11) NOT NULL COMMENT 'drink_id of cocktailDB API',
  `user_fk` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='list of drinks related to a user (who created his list)';

--
-- Dumping data for table `user_list_of_drinks`
--

INSERT INTO `user_list_of_drinks` (`drink_id`, `user_fk`) VALUES
(11417, 5),
(11416, 5),
(11403, 8),
(178342, 1),
(178332, 8),
(178334, 11),
(178325, 12),
(11416, 12),
(15403, 12),
(12790, 8),
(12718, 8),
(17211, 8),
(11000, 8),
(15841, 8),
(16967, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'User ID', AUTO_INCREMENT=13;
