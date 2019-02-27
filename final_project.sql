-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2019 at 12:46 PM
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
  `category_ID` int(10) UNSIGNED NOT NULL,
  `cat_name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_ID`, `cat_name`, `description`) VALUES
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
  `feedback_ID` int(10) UNSIGNED NOT NULL,
  `tour_ID` int(10) UNSIGNED NOT NULL,
  `user_ID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guide`
--

CREATE TABLE `guide` (
  `Guide_ID` int(10) NOT NULL,
  `Experience` int(2) NOT NULL,
  `Category_Expertise` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `guide`
--

INSERT INTO `guide` (`Guide_ID`, `Experience`, `Category_Expertise`) VALUES
(2, 10, 'History');

-- --------------------------------------------------------

--
-- Table structure for table `guided_tour`
--

CREATE TABLE `guided_tour` (
  `guided_tour_ID` int(10) UNSIGNED NOT NULL,
  `guide_ID` int(10) UNSIGNED NOT NULL,
  `group_size` int(3) UNSIGNED NOT NULL,
  `currently_participants` int(3) UNSIGNED NOT NULL,
  `registration_deadline` datetime NOT NULL,
  `tour_cost` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `guided_tour`
--

INSERT INTO `guided_tour` (`guided_tour_ID`, `guide_ID`, `group_size`, `currently_participants`, `registration_deadline`, `tour_cost`) VALUES
(1, 2, 20, 10, '2019-03-26 00:00:00', 80),
(2, 2, 15, 4, '2019-03-24 00:00:00', 15);

-- --------------------------------------------------------

--
-- Table structure for table `guided_tour_registration`
--

CREATE TABLE `guided_tour_registration` (
  `guided_tour_ID` int(10) UNSIGNED NOT NULL,
  `registered_tourist_ID` int(10) UNSIGNED NOT NULL,
  `registration_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `independent_tour`
--

CREATE TABLE `independent_tour` (
  `independent_tour_ID` int(10) UNSIGNED NOT NULL,
  `independent_tourist_ID` int(10) UNSIGNED NOT NULL,
  `remaining_time` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `point_feedback`
--

CREATE TABLE `point_feedback` (
  `feedback_ID` int(10) UNSIGNED NOT NULL,
  `point_ID` int(10) UNSIGNED NOT NULL,
  `point_ranking` float UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `point_of_interest`
--

CREATE TABLE `point_of_interest` (
  `point_ID` int(10) UNSIGNED NOT NULL,
  `category_ID` int(10) UNSIGNED NOT NULL,
  `name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `average_time_minutes` float UNSIGNED NOT NULL DEFAULT '0',
  `average_ranking` float UNSIGNED NOT NULL DEFAULT '0',
  `is_accessible` tinyint(1) DEFAULT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `point_of_interest`
--

INSERT INTO `point_of_interest` (`point_ID`, `category_ID`, `name`, `latitude`, `longitude`, `average_time_minutes`, `average_ranking`, `is_accessible`, `description`) VALUES
(1, 4, 'Memorial to the Victims of the Holocaust', 34.8191, 31.9082, 0, 0, NULL, NULL),
(2, 4, 'The Inner Light', 34.8102, 31.906, 0, 0, NULL, NULL),
(3, 2, 'Mount Tabor Oak', 34.8141, 31.9078, 0, 0, NULL, NULL),
(4, 1, 'Kimmel Center for Archaeological Science', 34.8099, 31.9077, 0, 0, NULL, NULL),
(5, 2, 'Indian Banyan', 34.8103, 31.906, 0, 0, NULL, NULL),
(6, 4, 'King and Queen', 34.8068, 31.9072, 0, 0, NULL, NULL),
(7, 5, 'Maurice and Gabriela Goldschleger Life Sciences Library', 34.8089, 31.9069, 0, 0, NULL, NULL),
(8, 8, 'ATM Hermann and Dan Mayer Campus Guesthouse - Maison de France', 34.8106, 31.9066, 0, 0, NULL, NULL),
(9, 2, 'Olive', 34.8095, 31.9043, 0, 0, NULL, NULL),
(10, 4, 'Semaphore', 34.8178, 31.9081, 0, 0, NULL, NULL),
(11, 4, 'In Suspense', 34.8085, 31.905, 0, 0, NULL, NULL),
(12, 4, 'Ritual', 34.814, 31.9081, 0, 0, NULL, NULL),
(13, 2, 'Indian Banyan', 34.8094, 31.9038, 0, 0, NULL, NULL),
(14, 7, 'Hermann and Dan Mayer Campus Guesthouse - Maison de France', 34.8106, 31.9065, 0, 0, NULL, NULL),
(15, 2, 'Smooth-Shell Macadamia Nut, Queensland Nut', 34.8085, 31.9063, 0, 0, NULL, NULL),
(16, 4, 'Three Fledglings', 34.8104, 31.9056, 0, 0, NULL, NULL),
(17, 2, 'Royal Poinciana, Flamboyant', 34.8097, 31.9057, 0, 0, NULL, NULL),
(18, 2, 'Mexican Rose', 34.8108, 31.9066, 0, 0, NULL, NULL),
(19, 2, 'Canary Island Pine', 34.8097, 31.9055, 0, 0, NULL, NULL),
(20, 4, 'Continum', 34.8114, 31.9071, 0, 0, NULL, NULL),
(21, 7, 'Cafe Bkikar', 34.8114, 31.9086, 0, 0, NULL, NULL),
(22, 1, 'Jacob Ziskind Building', 34.8097, 31.9074, 0, 0, NULL, NULL),
(23, 5, 'Bloch Boulevard', 34.8077, 31.906, 0, 0, NULL, NULL),
(24, 2, 'White Stinkwood', 34.8071, 31.9072, 0, 0, NULL, NULL),
(25, 2, 'Cabbage Palm, Cabbage Palmetto', 34.808, 31.9063, 0, 0, NULL, NULL),
(26, 2, 'Cockspur Coral Tree', 34.8112, 31.9091, 0, 0, NULL, NULL),
(27, 2, 'Oriental Plane Tree', 34.8128, 31.9088, 0, 0, NULL, NULL),
(28, 2, 'Sausage Tree', 34.8122, 31.9074, 0, 0, NULL, NULL),
(29, 2, 'Florida Fiddlewood, Jamaica Fiddlewood', 34.8108, 31.9066, 0, 0, NULL, NULL),
(30, 2, 'Pride of Bolivia, Rosewood', 34.8103, 31.9091, 0, 0, NULL, NULL),
(31, 7, 'Pi Squared', 34.8085, 31.9088, 0, 0, NULL, NULL),
(32, 3, 'Main Gate', 34.8081, 31.9038, 0, 0, NULL, NULL),
(33, 1, 'Michael and Anna Wix Auditorium', 34.8095, 31.905, 0, 0, NULL, NULL),
(34, 1, 'Sussman Building for Environmental Sciences', 34.8107, 31.9071, 0, 0, NULL, NULL),
(35, 2, 'Surinam Cherry', 34.8091, 31.9073, 0, 0, NULL, NULL),
(36, 4, 'Menorah/Tree of Knowledge', 34.8093, 31.9068, 0, 0, NULL, NULL),
(37, 7, 'Charlies Place', 34.8061, 31.9074, 0, 0, NULL, NULL),
(38, 2, 'Jacaranda', 34.8123, 31.908, 0, 0, NULL, NULL),
(39, 2, 'Golden Shower Tree, Indian Laburnum, Pudding Pipe Tree', 34.8072, 31.9077, 0, 0, NULL, NULL),
(40, 1, 'Daniel Wolf Building', 34.8098, 31.9077, 0, 0, NULL, NULL),
(41, 2, 'Mediterranean Fan Palm', 34.8113, 31.9087, 0, 0, NULL, NULL),
(42, 2, 'Queensland Umbrella Tree, Octopus Tree ', 34.8096, 31.9067, 0, 0, NULL, NULL),
(43, 3, 'Davidson Gate', 34.8201, 31.9067, 0, 0, NULL, NULL),
(44, 2, 'Rusty Fig, Port Jackson Fig', 34.8093, 31.9038, 0, 0, NULL, NULL),
(45, 1, 'The David Lopatie Conference Centre', 34.8095, 31.9047, 0, 0, NULL, NULL),
(46, 2, 'River Red Gum', 34.8069, 31.9079, 0, 0, NULL, NULL),
(47, 7, 'Cafe Mada', 34.8097, 31.9043, 0, 0, NULL, NULL),
(48, 1, 'Koffler Accelerator of the Canada Centre of Nuclear Physics', 34.8126, 31.908, 0, 0, NULL, NULL),
(49, 4, 'Tree of life', 34.809, 31.9072, 0, 0, NULL, NULL),
(50, 2, 'Rosewood', 34.8142, 31.9078, 0, 0, NULL, NULL),
(51, 8, 'ATM Bank Leumi', 34.8114, 31.9086, 0, 0, NULL, NULL),
(52, 1, 'Sidney Musher Building for Science Teaching', 34.8112, 31.9078, 0, 0, NULL, NULL),
(53, 2, 'Yellow Poinciana, Yellow Flame', 34.8093, 31.9051, 0, 0, NULL, NULL),
(54, 2, 'Nyasaland Mahogany', 34.8063, 31.9072, 0, 0, NULL, NULL),
(55, 5, 'Helen and Milton A. Kimmelman Building', 34.8099, 31.9063, 0, 0, NULL, NULL),
(56, 2, 'Royal Poinciana, Flamboyant', 34.8086, 31.9041, 0, 0, NULL, NULL),
(57, 2, 'Indian Laurel Fig, Chinese banyan', 34.8071, 31.9061, 0, 0, NULL, NULL),
(58, 2, 'Smooth-Shell Macadamia Nut, Queensland Nut', 34.8072, 31.9056, 0, 0, NULL, NULL),
(59, 1, 'Weisgal Square', 34.8091, 31.9075, 0, 0, NULL, NULL),
(60, 4, 'Ensemble', 34.8107, 31.9068, 0, 0, NULL, NULL),
(61, 1, 'Memorial Plaza', 34.819, 31.9078, 0, 0, NULL, NULL),
(62, 2, 'Pinus pinea', 34.8131, 31.9077, 0, 0, NULL, NULL),
(63, 2, 'Southern Magnolia, Bull Bayv', 34.8114, 31.9088, 0, 0, NULL, NULL),
(64, 2, 'Red Silk cotton Tree, Kapok', 34.8109, 31.9084, 0, 0, NULL, NULL),
(65, 2, 'Common Screwpine', 34.8097, 31.9043, 0, 0, NULL, NULL),
(66, 6, 'The Levinson Visitors Center', 34.8098, 31.9048, 0, 0, NULL, NULL),
(67, 2, 'White Floss Silk Tree', 34.8093, 31.905, 0, 0, NULL, NULL),
(68, 2, 'Mango', 34.8089, 31.9074, 0, 0, NULL, NULL),
(69, 3, 'South Gate', 34.8178, 31.9066, 0, 0, NULL, NULL),
(70, 6, 'Clore Garden of Science', 34.8125, 31.9098, 0, 0, NULL, NULL),
(71, 1, 'Daniel Sieff Research Institute', 34.8095, 31.9068, 0, 0, NULL, NULL),
(72, 2, 'Indian Laurel Fig, Chinese banyan', 34.8104, 31.9086, 0, 0, NULL, NULL),
(73, 3, 'Bloch Gate', 34.8063, 31.9062, 0, 0, NULL, NULL),
(74, 6, 'Weizmann House', 34.8186, 31.9065, 0, 0, NULL, NULL),
(75, 2, 'White Mulberry, Silkworm Mulberry', 34.8139, 31.9081, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tour`
--

CREATE TABLE `tour` (
  `tour_ID` int(10) UNSIGNED NOT NULL,
  `planned_date_and_time_tour` datetime NOT NULL,
  `tour_duration` int(3) UNSIGNED NOT NULL,
  `is_acccessible_only` tinyint(1) NOT NULL,
  `is_cafeteria` tinyint(1) NOT NULL,
  `cafeteria_time` int(3) UNSIGNED NOT NULL,
  `tour_type` int(1) UNSIGNED NOT NULL,
  `short_desc` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tour`
--

INSERT INTO `tour` (`tour_ID`, `planned_date_and_time_tour`, `tour_duration`, `is_acccessible_only`, `is_cafeteria`, `cafeteria_time`, `tour_type`, `short_desc`, `description`) VALUES
(1, '2019-03-27 12:00:00', 120, 1, 1, 20, 2, NULL, NULL),
(2, '2019-03-25 09:00:00', 150, 1, 1, 20, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tourist`
--

CREATE TABLE `tourist` (
  `Tourist_ID` int(10) NOT NULL,
  `Subscribers` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tour_categories`
--

CREATE TABLE `tour_categories` (
  `tour_ID` int(10) UNSIGNED NOT NULL,
  `category_ID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tour_points_of_interest`
--

CREATE TABLE `tour_points_of_interest` (
  `point_ID` int(10) UNSIGNED NOT NULL,
  `tour_ID` int(10) UNSIGNED NOT NULL,
  `point_position` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_ID` int(10) UNSIGNED NOT NULL,
  `First_Name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Last_Name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Gender` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `Date_Of_Birth` date NOT NULL,
  `Email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Phone` int(10) NOT NULL,
  `Street_Name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `House_Number` int(3) NOT NULL,
  `City` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `User_Type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_ID`, `First_Name`, `Last_Name`, `Gender`, `Date_Of_Birth`, `Email`, `Password`, `Phone`, `Street_Name`, `House_Number`, `City`, `User_Type`) VALUES
(1, 'Guy', 'Cohen', 'Male', '1992-05-20', 'guycohen@gmail.com', '12345678', 522555462, 'Dizingof', 20, 'Tel Aviv', 1),
(2, 'Nadav', 'Golan', 'Male', '1980-02-01', 'nadavgolan27@gmail.com', '123456', 503213211, 'Neve Yehosua', 19, 'Ramat Gan', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_ID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_ID`),
  ADD KEY `tour_ID` (`tour_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `guide`
--
ALTER TABLE `guide`
  ADD PRIMARY KEY (`Guide_ID`);

--
-- Indexes for table `guided_tour`
--
ALTER TABLE `guided_tour`
  ADD PRIMARY KEY (`guided_tour_ID`),
  ADD KEY `guide_ID` (`guide_ID`),
  ADD KEY `group_size` (`group_size`),
  ADD KEY `currently_participants` (`currently_participants`),
  ADD KEY `tour_cost` (`tour_cost`);

--
-- Indexes for table `guided_tour_registration`
--
ALTER TABLE `guided_tour_registration`
  ADD KEY `guided_tour_ID` (`guided_tour_ID`),
  ADD KEY `registered_tourist_ID` (`registered_tourist_ID`);

--
-- Indexes for table `independent_tour`
--
ALTER TABLE `independent_tour`
  ADD PRIMARY KEY (`independent_tour_ID`),
  ADD KEY `independent_tourist_ID` (`independent_tourist_ID`),
  ADD KEY `remaining_time` (`remaining_time`);

--
-- Indexes for table `point_feedback`
--
ALTER TABLE `point_feedback`
  ADD KEY `feedback_ID` (`feedback_ID`),
  ADD KEY `point_ID` (`point_ID`),
  ADD KEY `point_ranking` (`point_ranking`);

--
-- Indexes for table `point_of_interest`
--
ALTER TABLE `point_of_interest`
  ADD PRIMARY KEY (`point_ID`),
  ADD KEY `category_ID` (`category_ID`),
  ADD KEY `average_time_minutes` (`average_time_minutes`),
  ADD KEY `average_ranking` (`average_ranking`);

--
-- Indexes for table `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`tour_ID`),
  ADD KEY `tour_duration` (`tour_duration`),
  ADD KEY `cafeteria_time` (`cafeteria_time`);

--
-- Indexes for table `tourist`
--
ALTER TABLE `tourist`
  ADD PRIMARY KEY (`Tourist_ID`),
  ADD KEY `Subscribers` (`Subscribers`);

--
-- Indexes for table `tour_categories`
--
ALTER TABLE `tour_categories`
  ADD KEY `tour_ID` (`tour_ID`),
  ADD KEY `category_ID` (`category_ID`);

--
-- Indexes for table `tour_points_of_interest`
--
ALTER TABLE `tour_points_of_interest`
  ADD KEY `point_ID` (`point_ID`),
  ADD KEY `tour_ID` (`tour_ID`),
  ADD KEY `point_position` (`point_position`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `guided_tour`
--
ALTER TABLE `guided_tour`
  MODIFY `guided_tour_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `independent_tour`
--
ALTER TABLE `independent_tour`
  MODIFY `independent_tour_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `point_of_interest`
--
ALTER TABLE `point_of_interest`
  MODIFY `point_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `tour`
--
ALTER TABLE `tour`
  MODIFY `tour_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`User_ID`);

--
-- Constraints for table `point_of_interest`
--
ALTER TABLE `point_of_interest`
  ADD CONSTRAINT `point_of_interest_ibfk_1` FOREIGN KEY (`category_ID`) REFERENCES `category` (`category_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
