-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2020 at 06:24 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webiptsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'PUP', ''),
(2, 'BSIT', ''),
(3, 'BSEE', ''),
(4, 'DOMT', ''),
(5, 'BSP', ''),
(6, 'BSA', ''),
(7, 'BSENT', ''),
(8, 'BSECE', ''),
(9, 'PSTO', ''),
(10, 'BSIE', '');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `uid`, `image`, `role`, `comment`, `status`) VALUES
(7, 23, 'profile23.svg', 'Student', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam error debitis vel cumque nemo consequuntur illum consequatur, dolore quis deleniti?', 1),
(8, 1, 'profile1.jpg', 'Anonymous', 'new comment', 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `released` tinyint(4) NOT NULL,
  `raffleSystem` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `eventday` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `category_id`, `title`, `image`, `description`, `released`, `raffleSystem`, `created_at`, `eventday`) VALUES
(1, 1, 2, 'Spelling Bee', '1584174527_305294-Cortana-Windows_10-minimalism-Circles.jpg', '&lt;p&gt;Computer Society holds an event called Spelling Bee for the students from BSIT for each year level. It is being enacted in the Computer laboratory inside the University. the Spelling Bee has it&amp;#39;s category and they are easy, average and difficult.&lt;/p&gt;\r\n', 1, 0, '2020-03-12', '2020-03-14 00:00:00'),
(2, 2, 2, 'IT General Assembly', '1583989049_FB_IMG_1579771016899.jpg', '&lt;p&gt;Every year we celebrate the general assembly of our department&amp;nbsp;which is Information Technology. We have some events that have been organize by our officers such as ball games and different contests.&amp;nbsp;&lt;/p&gt;\r\n', 1, 0, '2020-03-12', '2020-03-12 00:00:00'),
(4, 2, 2, 'MR & MS COMPUTER SOCIETY 2018', '1583989303_FB_IMG_1579771087604.jpg', '&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; The Computer Society holds this event yearly to make each student from the society enjoy their stay in the said society. Two&amp;nbsp;students from each section is required to join the contest.&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; Each contestant requires to have different outfits such as; formal attire, student attire, casual attire and society shirt. Every attire of each will choose the best attire of each genre. The winners will represent the said society in Foundation Day to fight for the other society in the University.&lt;/p&gt;\r\n', 1, 0, '2020-03-12', '2019-12-09 00:00:00'),
(5, 14, 3, 'EE QUIZBEE', '1583989511_83219586_1037548586644846_4316224854379462656_n.jpg', '&lt;p&gt;Engineering course was known of their intelligence, so that Electrical Engineering holds an event for the student to compete each other, it is name EE QUIZBEE. The winner will compete to other courses in General Assembly. It is being enacted at the PUP gymnasium and strictly observed with the Student from their organization.&lt;/p&gt;\r\n', 0, 0, '2020-03-12', '2019-10-16 00:00:00'),
(6, 1, 1, 'SABAYANG PAGBIGKAS (2018)', '1583991122_FB_IMG_1579862192198.jpg', '&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;In Polytechnic University of the Philippines Santo Tomas Branch, we yearly celebrate Buwan ng Wika to give respect to our country. We have some events to organize namely the &amp;quot;Sabayang Pagbigkas&amp;quot;, through this event it is made up of different departments who will compete each other. Each courses requires their freshmen to have 30 representatives.&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; The competition was a unforgattable one because the Computer Society won that event and they are the one that holds the title in 2018.&lt;/p&gt;\r\n', 1, 1, '2020-03-12', '2019-09-02 00:00:00'),
(7, 1, 1, 'PUP DANCE IDOL', '1583991088_FB_IMG_1579862304010.jpg', '&lt;p&gt;Students from the PUP Santo Tomas were given the talent, one of it is dancing. PUP holds an event called PUP DANCE IDOL and every student are waiting for it yearly. Same as the other Events, it also requires each courses to have their representatives, it requires 10-15 student each course.&lt;/p&gt;\r\n', 1, 1, '2020-03-12', '2020-03-09 00:00:00'),
(8, 1, 1, 'PUP IDOL', '1583990701_FB_IMG_1579862438156.jpg', '&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;We celebrate singing contest here in PUP and it is known as PUP IDOL which is made up of different representative of each courses in the University. It only requires only one person to perform and compete in the stage.&lt;/p&gt;\r\n', 1, 1, '2020-03-12', '2020-03-02 00:00:00'),
(9, 19, 8, 'ECE Days', '1583991442_FB_IMG_1579822149951.jpg', '&lt;p&gt;Each courses in PUP have their own general assembly like this course ECE Days. Many events are planned by their department like Mr and Miss ECE, ballgames, seminars and some events. It happens every school year that many of their officers are participating in that event.&lt;/p&gt;\r\n', 1, 0, '2020-03-12', '2020-03-01 00:00:00'),
(10, 18, 7, 'Entrep Days', '1583991783_FB_IMG_1579821389438.jpg', '&lt;p&gt;We are competing for our department with full confident and cooperation with the help of our officers to participate and have their own obligations on how we&amp;nbsp;will start and create some events through that day.&lt;/p&gt;\r\n', 1, 0, '2020-03-12', '2020-03-02 00:00:00'),
(11, 17, 6, 'BSA General Assembly', '1583992358_FB_IMG_1579822926204.jpg', '&lt;p&gt;We collide as one to make this event organized for the&amp;nbsp;enjoyment of every student in our department.&amp;nbsp;&lt;/p&gt;\r\n', 1, 0, '2020-03-12', '2020-03-04 00:00:00'),
(13, 22, 10, 'ecvenjashd', '1583995027_FB_IMG_1579822859309.jpg', '&lt;hr /&gt;\r\n&lt;p&gt;aDNajsgaJGDahgdkASIas&lt;/p&gt;\r\n', 1, 1, '2020-03-12', '2020-03-04 00:00:00'),
(14, 1, 1, 'Sample', '1584252647_ef7fb1b37078b6a2aef8e40710446bfa.jpg', '&lt;p&gt;asdasdasdasdasdasdasd&lt;/p&gt;\r\n', 1, 1, '2020-03-14', '2020-03-15 13:00:00'),
(15, 1, 1, 'sa', '1584170021_FB_IMG_1579862438156.jpg', '&lt;p&gt;sadasdasd&lt;/p&gt;\r\n', 1, 0, '2020-03-14', '2020-03-11 00:00:00'),
(16, 1, 1, 'NE Event', '1584174423_63156418-firewatch-wallpapers.jpg', '&lt;p&gt;asdasdasd&lt;/p&gt;\r\n', 1, 0, '2020-03-14', '2020-03-10 00:00:00'),
(18, 1, 1, 'New Event', '1584596239_ef7fb1b37078b6a2aef8e40710446bfa.jpg', '&lt;hr /&gt;\r\n&lt;p&gt;&amp;nbsp; &amp;nbsp;The quick brown fox jumps over the lazy dog.&amp;nbsp;&amp;nbsp; &amp;nbsp;The quick brown fox jumps over the lazy dog.&amp;nbsp;&amp;nbsp; &amp;nbsp;The quick brown fox jumps over the lazy dog.&amp;nbsp;&amp;nbsp; &amp;nbsp;The quick brown fox jumps over the lazy dog.&amp;nbsp;&amp;nbsp; &amp;nbsp;The quick brown fox jumps over the lazy dog.&amp;nbsp; &amp;nbsp;The quick brown fox jumps over the lazy dog.&amp;nbsp;&amp;nbsp; &amp;nbsp;The quick brown fox jumps over the lazy dog.&amp;nbsp;The quick brown fox jumps over the lazy dog.The quick brown fox jumps over the lazy dog.The quick brown fox jumps over the lazy dog.The quick brown fox jumps over the lazy dog.The quick brown fox jumps over the lazy dog.The quick brown fox jumps over the lazy dog.The quick brown fox jumps over the lazy dog.&lt;/p&gt;\r\n\r\n&lt;p&gt;The quick brown fox jumps over the lazy dog.The quick brown fox jumps over the lazy dog.The quick brown fox jumps over the lazy dog.The quick brown fox jumps over the lazy dog.The quick brown fox jumps over the lazy dog.The quick brown fox jumps over the lazy dog.The quick brown fox jumps over the lazy dog.&lt;/p&gt;\r\n\r\n&lt;p&gt;The quick brown fox jumps over the lazy dog.The quick brown fox jumps over the lazy dog.The quick brown fox jumps over the lazy dog.The quick brown fox jumps over the lazy dog.The quick brown fox jumps over the lazy dog.The quick brown fox jumps over the lazy dog.The quick brown fox jumps over the lazy dog.&lt;/p&gt;\r\n\r\n&lt;p&gt;The quick brown fox jumps over the lazy dog.The quick brown fox jumps over the lazy dog.The quick brown fox jumps over the lazy dog.The quick brown fox jumps over the lazy dog.The quick brown fox jumps over the lazy dog.The quick brown fox jumps over the lazy dog.&lt;/p&gt;\r\n', 1, 1, '2020-03-14', '2020-03-21 01:00:00'),
(19, 1, 1, 'Upcoming', '1584257126_ef7fb1b37078b6a2aef8e40710446bfa.jpg', '&lt;p&gt;asdasdasdasdasdasdasd&lt;/p&gt;\r\n', 1, 1, '2020-03-15', '2020-03-16 01:00:00'),
(20, 2, 2, 'Y4IT', '1584259191_eyyyy.jpg', '&lt;hr /&gt;\r\n&lt;p&gt;This coming april we will be having the Y4it hahahaha. awit&lt;/p&gt;\r\n', 1, 1, '2020-03-15', '2020-04-14 01:00:00'),
(21, 1, 1, 'New Upcoming Events', '1585118244_design-wallpapers-30.png', '&lt;hr /&gt;\r\n&lt;p&gt;New Events this time.&amp;nbsp;&lt;/p&gt;\r\n', 1, 1, '2020-03-25', '2020-05-11 08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` int(11) NOT NULL,
  `ticket` varchar(255) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `course` varchar(255) NOT NULL,
  `stdnt_num` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `event_id` int(11) NOT NULL,
  `joined_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `ticket`, `cat_id`, `name`, `course`, `stdnt_num`, `address`, `event_id`, `joined_at`) VALUES
(1, '1234567', 1, 1, 'BSIE', '2018-00422-ST-0', 'Calamba', 8, '2020-03-12 14:58:32'),
(2, '23434', 1, 1, 'BSENT', '2018-00422-St-1', 'Calamba', 8, '2020-03-12 15:00:20'),
(3, '23456', 1, 2, 'DICT', '2018-00422-ST-3', 'Calamba', 8, '2020-03-12 15:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `profileimg`
--

CREATE TABLE `profileimg` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profileimg`
--

INSERT INTO `profileimg` (`id`, `status`) VALUES
(1, 0),
(2, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(23, 0),
(24, 0),
(28, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  `assignment` int(11) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `admin`, `assignment`, `username`, `email`, `password`, `created_at`) VALUES
(1, 1964, 1, 'PUP-E Admin', 'pupeventsadmin@gmail.com', '$2y$10$hx76xxrocnzNWVjGO48tCuHweIUbww2DLcNv97Wezd3fnxY2ul.YO', '2020-02-28 15:25:48'),
(2, 2000, 2, 'BSIT Admin', 'bsitadmin@gmail.com', '$2y$10$/zqK4nf9eWoQMS5u7qi0HOHJxvfl62ozccjlcEab3Ce2bYJb/ew8y', '2020-02-28 15:27:21'),
(14, 2000, 3, 'BSEE Admin', 'bseeadmin@gmail.com', '$2y$10$M63KDDhq1WToF2tBDR0LPe2nTqYcL2xvCEFuUE7jb6qAqYFyNbBoi', '2020-03-12 04:35:06'),
(15, 2000, 5, 'BSP Admin', 'bspadmin@gmail.com', '$2y$10$yG/C/YX3/3zUmIFT0RNxKu6QWbolhihTchM74rYqf7svN7TL9HoOe', '2020-03-12 04:35:59'),
(16, 2000, 4, 'DOMT Admin', 'domtadmin@gmail.com', '$2y$10$eNV1yWodJiMLpr9iZG03aukwDVrQer5mKgafkR4XodnzbJKaauNtq', '2020-03-12 04:36:58'),
(17, 2000, 6, 'BSA Admin', 'bsaadmin@gmail.com', '$2y$10$CJoXs0kvUp.kDaq0J82O0e/gcPv6zNFqd9a7Cl1RVVARECLIQPHTy', '2020-03-12 04:38:33'),
(18, 2000, 7, 'BSENT Admin', 'bsentadmin@gmail.com', '$2y$10$4eBv6QD7wEH0BXRYT6BXc.TFTgXhM1QnNGiOwHzQiIFifPD3tj5xu', '2020-03-12 05:12:49'),
(19, 2000, 8, 'BAECE Admin', 'bseceadmin@gmail.com', '$2y$10$tTW7P7uERNMMecKlUGCSAeiS3Z2did6miwH8luGnrV4lCNS6.ldiy', '2020-03-12 05:15:47'),
(20, 2000, 9, 'PSTO Admin', 'pstoadmin@gmail.com', '$2y$10$SqiZ3C8SvARUKfcGw5XWLO66Uu2knCpI.zV7BIbn1RYyde.XrWlY6', '2020-03-12 05:17:42'),
(23, 1100, NULL, 'Student', 'student@gmail.com', '$2y$10$oisy8axuBWZsWiZxGGYspeQ3nExAVr2r1VB32KpgdHr6UAmDVK8jy', '2020-03-12 07:03:30'),
(28, 1100, NULL, 'Mark Lester', 'marklester10.mlsm@gmail.com', '$2y$10$RrX.qOxhJIALecrP0OYeL.h6Yj6k.5Mt0UsAKOTiqF5Hmqlbpes5q', '2020-03-13 12:53:51');

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

CREATE TABLE `usertypes` (
  `code` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usertypes`
--

INSERT INTO `usertypes` (`code`, `type`) VALUES
(1100, 'student'),
(1964, 'admin'),
(2000, 'superuser');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `profileimg`
--
ALTER TABLE `profileimg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `admin` (`admin`);

--
-- Indexes for table `usertypes`
--
ALTER TABLE `usertypes`
  ADD PRIMARY KEY (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `people`
--
ALTER TABLE `people`
  ADD CONSTRAINT `people_ibfk_2` FOREIGN KEY (`name`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`admin`) REFERENCES `usertypes` (`code`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
