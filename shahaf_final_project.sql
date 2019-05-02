-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2019 at 03:54 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `cat_name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `cat_name`, `description`) VALUES
(1, 'history', 'some desc'),
(2, 'tree', 'some desc'),
(3, 'Gate', 'some desc'),
(4, 'Sculptures', 'some desc'),
(5, 'General', 'some desc'),
(6, 'attraction', 'some desc'),
(7, 'resturants', 'some desc'),
(8, 'Cash Machine', 'some desc');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(10) UNSIGNED NOT NULL,
  `tour_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guide`
--

CREATE TABLE `guide` (
  `guide_id` int(10) NOT NULL,
  `experience` int(2) NOT NULL,
  `category_expertise` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `guide`
--

INSERT INTO `guide` (`guide_id`, `experience`, `category_expertise`) VALUES
(2, 10, 'History');

-- --------------------------------------------------------

--
-- Table structure for table `guided_tour`
--

CREATE TABLE `guided_tour` (
  `guided_tour_id` int(10) UNSIGNED NOT NULL,
  `guide_id` int(10) UNSIGNED NOT NULL,
  `group_size` int(3) UNSIGNED NOT NULL,
  `currently_participants` int(3) UNSIGNED NOT NULL,
  `registration_deadline` datetime NOT NULL,
  `tour_cost` int(6) UNSIGNED NOT NULL,
  `short_desc` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `guided_tour`
--

INSERT INTO `guided_tour` (`guided_tour_id`, `guide_id`, `group_size`, `currently_participants`, `registration_deadline`, `tour_cost`, `short_desc`, `description`) VALUES
(1, 2, 20, 10, '2019-03-26 00:00:00', 80, 'short desc', 'long desc'),
(2, 2, 15, 4, '2019-04-30 00:00:00', 15, 'short desc', 'long desc'),
(4, 2, 15, 10, '2019-03-31 00:00:00', 80, 'short desc', 'description');

-- --------------------------------------------------------

--
-- Table structure for table `guided_tour_registration`
--

CREATE TABLE `guided_tour_registration` (
  `guided_tour_id` int(10) UNSIGNED NOT NULL,
  `registered_tourist_id` int(10) UNSIGNED NOT NULL,
  `subscribers` int(3) UNSIGNED NOT NULL DEFAULT '0',
  `registration_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `guided_tour_registration`
--

INSERT INTO `guided_tour_registration` (`guided_tour_id`, `registered_tourist_id`, `subscribers`, `registration_date`) VALUES
(4, 1, 3, '2019-02-27 19:00:00'),
(2, 3, 5, '2019-03-24 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `independent_tour`
--

CREATE TABLE `independent_tour` (
  `independent_tour_id` int(10) UNSIGNED NOT NULL,
  `independent_tourist_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `independent_tour`
--

INSERT INTO `independent_tour` (`independent_tour_id`, `independent_tourist_id`) VALUES
(3, 1),
(6, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `point_feedback`
--

CREATE TABLE `point_feedback` (
  `feedback_id` int(10) UNSIGNED NOT NULL,
  `point_id` int(10) UNSIGNED NOT NULL,
  `point_ranking` float UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `point_of_interest`
--

CREATE TABLE `point_of_interest` (
  `point_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` float NOT NULL,
  `latitude` float NOT NULL,
  `average_time_minutes` float UNSIGNED NOT NULL DEFAULT '0',
  `average_ranking` float UNSIGNED NOT NULL DEFAULT '0',
  `is_accessible` tinyint(1) DEFAULT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `point_of_interest`
--

INSERT INTO `point_of_interest` (`point_id`, `category_id`, `name`, `longitude`, `latitude`, `average_time_minutes`, `average_ranking`, `is_accessible`, `description`) VALUES
(1, 4, 'Memorial to the Victims of the Holocaust', 34.8191, 31.9082, 27, 4.9, NULL, NULL),
(2, 4, 'The Inner Light', 34.8102, 31.906, 20, 3.9, NULL, NULL),
(3, 2, 'Mount Tabor Oak', 34.8141, 31.9078, 23, 3.8, NULL, NULL),
(4, 1, 'Kimmel Center for Archaeological Science', 34.8099, 31.9077, 41, 4.3, NULL, NULL),
(5, 2, 'Indian Banyan', 34.8103, 31.906, 19, 3.2, NULL, NULL),
(6, 4, 'King and Queen', 34.8068, 31.9072, 39, 4.2, NULL, NULL),
(7, 5, 'Maurice and Gabriela Goldschleger Life Sciences Library', 34.8089, 31.9069, 65, 4.3, NULL, NULL),
(9, 2, 'Olive', 34.8095, 31.9043, 24, 3.9, NULL, NULL),
(10, 4, 'Semaphore', 34.8178, 31.9081, 35, 3.5, NULL, NULL),
(11, 4, 'In Suspense', 34.8085, 31.905, 37, 4.7, NULL, NULL),
(12, 4, 'Ritual', 34.814, 31.9081, 22, 4, NULL, NULL),
(13, 2, 'Indian Banyan', 34.8094, 31.9038, 21, 5, NULL, NULL),
(14, 7, 'Hermann and Dan Mayer Campus Guesthouse - Maison de France', 34.8106, 31.9065, 57, 3.9, NULL, NULL),
(15, 2, 'Smooth-Shell Macadamia Nut, Queensland Nut', 34.8085, 31.9063, 18, 3.4, NULL, NULL),
(16, 4, 'Three Fledglings', 34.8104, 31.9056, 38, 4.6, NULL, NULL),
(17, 2, 'Royal Poinciana, Flamboyant', 34.8097, 31.9057, 26, 3.6, NULL, NULL),
(18, 2, 'Mexican Rose', 34.8108, 31.9066, 30, 3.4, NULL, NULL),
(19, 2, 'Canary Island Pine', 34.8097, 31.9055, 27, 4.9, NULL, NULL),
(20, 4, 'Continum', 34.8114, 31.9071, 23, 3.5, NULL, NULL),
(21, 7, 'Cafe Bkikar', 34.8114, 31.9086, 62, 3.8, NULL, NULL),
(22, 1, 'Jacob Ziskind Building', 34.8097, 31.9074, 50, 3.3, NULL, NULL),
(24, 2, 'White Stinkwood', 34.8071, 31.9072, 17, 4.1, NULL, NULL),
(25, 2, 'Cabbage Palm, Cabbage Palmetto', 34.808, 31.9063, 16, 3.6, NULL, NULL),
(26, 2, 'Cockspur Coral Tree', 34.8112, 31.9091, 17, 4.7, NULL, NULL),
(27, 2, 'Oriental Plane Tree', 34.8128, 31.9088, 21, 3.6, NULL, NULL),
(28, 2, 'Sausage Tree', 34.8122, 31.9074, 22, 4.9, NULL, NULL),
(29, 2, 'Florida Fiddlewood, Jamaica Fiddlewood', 34.8108, 31.9066, 20, 4.7, NULL, NULL),
(30, 2, 'Pride of Bolivia, Rosewood', 34.8103, 31.9091, 18, 3.8, NULL, NULL),
(31, 7, 'Pi Squared', 34.8085, 31.9088, 15, 3.8, NULL, NULL),
(32, 3, 'Main Gate', 34.8081, 31.9038, 72, 4.9, NULL, NULL),
(33, 1, 'Michael and Anna Wix Auditorium', 34.8095, 31.905, 45, 3.9, NULL, NULL),
(34, 1, 'Sussman Building for Environmental Sciences', 34.8107, 31.9071, 55, 3.9, NULL, NULL),
(35, 2, 'Surinam Cherry', 34.8091, 31.9073, 29, 4.6, NULL, NULL),
(36, 4, 'Menorah/Tree of Knowledge', 34.8093, 31.9068, 23, 4.3, NULL, NULL),
(37, 7, 'Charlies Place', 34.8061, 31.9074, 15, 5, NULL, NULL),
(38, 2, 'Jacaranda', 34.8123, 31.908, 16, 4.8, NULL, NULL),
(39, 2, 'Golden Shower Tree, Indian Laburnum, Pudding Pipe Tree', 34.8072, 31.9077, 23, 4.2, NULL, NULL),
(40, 1, 'Daniel Wolf Building', 34.8098, 31.9077, 41, 3.4, NULL, NULL),
(41, 2, 'Mediterranean Fan Palm', 34.8113, 31.9087, 24, 3.3, NULL, NULL),
(42, 2, 'Queensland Umbrella Tree, Octopus Tree ', 34.8096, 31.9067, 21, 3.4, NULL, NULL),
(43, 3, 'Davidson Gate', 34.8201, 31.9067, 42, 4.3, NULL, NULL),
(44, 2, 'Rusty Fig, Port Jackson Fig', 34.8093, 31.9038, 17, 4.3, NULL, NULL),
(45, 1, 'The David Lopatie Conference Centre', 34.8095, 31.9047, 41, 3.6, NULL, NULL),
(46, 2, 'River Red Gum', 34.8069, 31.9079, 22, 4.1, NULL, NULL),
(47, 7, 'Cafe Mada', 34.8097, 31.9043, 51, 4.6, NULL, NULL),
(48, 1, 'Koffler Accelerator of the Canada Centre of Nuclear Physics', 34.8126, 31.908, 60, 3.8, NULL, NULL),
(49, 4, 'Tree of life', 34.809, 31.9072, 26, 4, NULL, NULL),
(50, 2, 'Rosewood', 34.8142, 31.9078, 28, 3.9, NULL, NULL),
(51, 8, 'ATM Bank Leumi', 34.8114, 31.9086, 74, 4.2, NULL, NULL),
(52, 1, 'Sidney Musher Building for Science Teaching', 34.8112, 31.9078, 57, 4.3, NULL, NULL),
(53, 2, 'Yellow Poinciana, Yellow Flame', 34.8093, 31.9051, 30, 4.1, NULL, NULL),
(54, 2, 'Nyasaland Mahogany', 34.8063, 31.9072, 19, 4.3, NULL, NULL),
(55, 5, 'Helen and Milton A. Kimmelman Building', 34.8099, 31.9063, 16, 4.5, NULL, NULL),
(56, 2, 'Royal Poinciana, Flamboyant', 34.8086, 31.9041, 23, 4.4, NULL, NULL),
(57, 2, 'Indian Laurel Fig, Chinese banyan', 34.8071, 31.9061, 25, 3.4, NULL, NULL),
(58, 2, 'Smooth-Shell Macadamia Nut, Queensland Nut', 34.8072, 31.9056, 26, 3.1, NULL, NULL),
(59, 1, 'Weisgal Square', 34.8091, 31.9075, 46, 4, NULL, NULL),
(60, 4, 'Ensemble', 34.8107, 31.9068, 21, 3.9, NULL, NULL),
(61, 1, 'Memorial Plaza', 34.819, 31.9078, 60, 4.3, NULL, NULL),
(62, 2, 'Pinus pinea', 34.8131, 31.9077, 27, 3.1, NULL, NULL),
(63, 2, 'Southern Magnolia, Bull Bayv', 34.8114, 31.9088, 27, 3.3, NULL, NULL),
(64, 2, 'Red Silk cotton Tree, Kapok', 34.8109, 31.9084, 24, 4.5, NULL, NULL),
(65, 2, 'Common Screwpine', 34.8097, 31.9043, 22, 3.3, NULL, NULL),
(66, 6, 'The Levinson Visitors Center', 34.8098, 31.9048, 76, 3.9, NULL, NULL),
(67, 2, 'White Floss Silk Tree', 34.8093, 31.905, 23, 4.9, NULL, NULL),
(68, 2, 'Mango', 34.8089, 31.9074, 18, 3.6, NULL, NULL),
(69, 3, 'South Gate', 34.8178, 31.9066, 26, 4.2, NULL, NULL),
(70, 6, 'Clore Garden of Science', 34.8125, 31.9098, 105, 3.3, NULL, NULL),
(71, 1, 'Daniel Sieff Research Institute', 34.8095, 31.9068, 41, 5, NULL, NULL),
(72, 2, 'Indian Laurel Fig, Chinese banyan', 34.8104, 31.9086, 22, 3.8, NULL, NULL),
(73, 3, 'Bloch Gate', 34.8063, 31.9062, 65, 3.3, NULL, NULL),
(74, 6, 'Weizmann House', 34.8186, 31.9065, 107, 4.1, NULL, NULL),
(75, 2, 'White Mulberry, Silkworm Mulberry', 34.8139, 31.9081, 27, 3.7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tour`
--

CREATE TABLE `tour` (
  `tour_id` int(10) UNSIGNED NOT NULL,
  `planned_date_and_time_tour` datetime NOT NULL,
  `tour_duration` int(3) UNSIGNED NOT NULL,
  `is_acccessible_only` tinyint(1) NOT NULL,
  `is_cafeteria` tinyint(1) NOT NULL,
  `cafeteria_time` int(3) UNSIGNED NOT NULL,
  `tour_type` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tour`
--

INSERT INTO `tour` (`tour_id`, `planned_date_and_time_tour`, `tour_duration`, `is_acccessible_only`, `is_cafeteria`, `cafeteria_time`, `tour_type`) VALUES
(1, '2019-03-27 12:00:00', 120, 1, 1, 20, 2),
(2, '2019-05-01 12:00:00', 150, 1, 1, 20, 2),
(3, '2019-03-22 10:30:00', 110, 0, 1, 30, 1),
(4, '2019-04-01 14:00:00', 135, 0, 1, 20, 2),
(5, '2019-03-16 09:00:00', 60, 0, 1, 15, 1),
(6, '2019-02-06 17:00:00', 60, 0, 1, 20, 1),
(46, '2019-04-27 14:40:24', 100, 1, 1, 20, 1),
(47, '2019-04-27 17:29:20', 95, 1, 1, 25, 1),
(48, '2019-04-27 17:35:09', 95, 1, 1, 25, 1),
(49, '2019-04-27 20:11:23', 100, 1, 1, 20, 1),
(50, '2019-04-28 10:34:58', 100, 1, 1, 20, 1),
(51, '2019-04-28 12:25:45', 120, 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tour_categories`
--

CREATE TABLE `tour_categories` (
  `tour_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tour_categories`
--

INSERT INTO `tour_categories` (`tour_id`, `category_id`) VALUES
(46, 1),
(47, 2),
(48, 1),
(49, 1),
(50, 1),
(50, 2),
(51, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tour_points_of_interest`
--

CREATE TABLE `tour_points_of_interest` (
  `tour_id` int(10) UNSIGNED NOT NULL,
  `point_id` int(10) UNSIGNED NOT NULL,
  `point_position` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tour_points_of_interest`
--

INSERT INTO `tour_points_of_interest` (`tour_id`, `point_id`, `point_position`) VALUES
(46, 32, 0),
(46, 71, 1),
(46, 52, 2),
(46, 21, 3),
(47, 32, 0),
(47, 13, 1),
(47, 67, 2),
(47, 35, 3),
(47, 28, 4),
(47, 21, 5),
(48, 32, 0),
(48, 71, 1),
(48, 59, 2),
(48, 31, 3),
(49, 32, 0),
(49, 71, 1),
(49, 52, 2),
(49, 21, 3),
(50, 32, 0),
(50, 35, 1),
(50, 61, 2),
(50, 21, 3),
(51, 32, 0),
(51, 52, 1),
(51, 61, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(10) NOT NULL,
  `street_name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `house_number` int(3) NOT NULL,
  `city` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `gender`, `date_of_birth`, `email`, `password`, `phone`, `street_name`, `house_number`, `city`, `user_type`) VALUES
(1, 'Guy', 'Cohen', 'Male', '1992-05-20', 'guycohen@gmail.com', '12345678', 522555462, 'Dizingof', 20, 'Tel Aviv', 1),
(2, 'Nadav', 'Golan', 'Male', '1980-02-01', 'nadavgolan27@gmail.com', '123456', 503213211, 'Neve Yehosua', 19, 'Ramat Gan', 2),
(3, 'Beni', 'Levi', 'Male', '1992-02-11', 'benilevi@gmail.com', '11223344', 501234567, 'Arlozorov', 22, 'Tel Aviv', 1),
(4, 'Shahaf', 'Doron', 'Male', '1991-03-05', 'shahaf1doron@gmail.com', '12345', 500001112, 'hagefen', 9, 'Ramt Gan', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `tour_ID` (`tour_id`),
  ADD KEY `user_ID` (`user_id`);

--
-- Indexes for table `guide`
--
ALTER TABLE `guide`
  ADD PRIMARY KEY (`guide_id`);

--
-- Indexes for table `guided_tour`
--
ALTER TABLE `guided_tour`
  ADD PRIMARY KEY (`guided_tour_id`),
  ADD KEY `guide_ID` (`guide_id`),
  ADD KEY `group_size` (`group_size`),
  ADD KEY `currently_participants` (`currently_participants`),
  ADD KEY `tour_cost` (`tour_cost`);

--
-- Indexes for table `guided_tour_registration`
--
ALTER TABLE `guided_tour_registration`
  ADD KEY `guided_tour_ID` (`guided_tour_id`),
  ADD KEY `registered_tourist_ID` (`registered_tourist_id`);

--
-- Indexes for table `independent_tour`
--
ALTER TABLE `independent_tour`
  ADD PRIMARY KEY (`independent_tour_id`),
  ADD KEY `independent_tourist_ID` (`independent_tourist_id`);

--
-- Indexes for table `point_feedback`
--
ALTER TABLE `point_feedback`
  ADD KEY `feedback_ID` (`feedback_id`),
  ADD KEY `point_ID` (`point_id`),
  ADD KEY `point_ranking` (`point_ranking`);

--
-- Indexes for table `point_of_interest`
--
ALTER TABLE `point_of_interest`
  ADD PRIMARY KEY (`point_id`),
  ADD KEY `category_ID` (`category_id`),
  ADD KEY `average_time_minutes` (`average_time_minutes`),
  ADD KEY `average_ranking` (`average_ranking`);

--
-- Indexes for table `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`tour_id`),
  ADD KEY `tour_duration` (`tour_duration`),
  ADD KEY `cafeteria_time` (`cafeteria_time`);

--
-- Indexes for table `tour_categories`
--
ALTER TABLE `tour_categories`
  ADD KEY `tour_ID` (`tour_id`),
  ADD KEY `category_ID` (`category_id`),
  ADD KEY `tour_id_2` (`tour_id`),
  ADD KEY `category_id_2` (`category_id`);

--
-- Indexes for table `tour_points_of_interest`
--
ALTER TABLE `tour_points_of_interest`
  ADD KEY `point_ID` (`tour_id`),
  ADD KEY `tour_ID` (`point_id`),
  ADD KEY `point_position` (`point_position`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `guided_tour`
--
ALTER TABLE `guided_tour`
  MODIFY `guided_tour_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `independent_tour`
--
ALTER TABLE `independent_tour`
  MODIFY `independent_tour_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `point_of_interest`
--
ALTER TABLE `point_of_interest`
  MODIFY `point_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `tour`
--
ALTER TABLE `tour`
  MODIFY `tour_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `point_of_interest`
--
ALTER TABLE `point_of_interest`
  ADD CONSTRAINT `point_of_interest_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
