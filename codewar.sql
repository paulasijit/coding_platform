-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2020 at 08:37 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codewar`
--

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE `awards` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `awardname` varchar(255) NOT NULL DEFAULT 'NO AWARDS',
  `contestid` int(11) NOT NULL,
  `contestname` varchar(255) NOT NULL,
  `cash` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `posttitle` varchar(2555) NOT NULL,
  `content` mediumtext NOT NULL,
  `upv` int(11) DEFAULT 0,
  `dv` int(11) DEFAULT 0,
  `postdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `blogid` int(11) NOT NULL,
  `cmnt` varchar(2000) NOT NULL,
  `userid` int(11) NOT NULL,
  `username` varchar(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contest`
--

CREATE TABLE `contest` (
  `contestid` int(11) NOT NULL,
  `contest` varchar(255) NOT NULL,
  `start` date NOT NULL,
  `starttime` time NOT NULL,
  `noofq` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `mins` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contest`
--

INSERT INTO `contest` (`contestid`, `contest`, `start`, `starttime`, `noofq`, `total`, `username`, `mins`) VALUES
(4, 'Test future', '2020-10-30', '09:59:00', 5, 150, 'asijit', 0),
(6, 'present', '2020-10-07', '11:00:00', 4, 4, 'dfqe', 0),
(7, 'ADASD', '2020-09-28', '11:02:00', 4545, 4545, '454', 0),
(8, 'nope', '2020-10-09', '12:05:13', 5, 15, 'asijit', 120);

-- --------------------------------------------------------

--
-- Table structure for table `cups`
--

CREATE TABLE `cups` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `cup` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `date` date DEFAULT current_timestamp(),
  `contest` varchar(225) NOT NULL,
  `contestid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cups`
--

INSERT INTO `cups` (`id`, `username`, `cup`, `userid`, `date`, `contest`, `contestid`) VALUES
(28, 'asijit', -4650, 1, '2020-10-08', '', 3),
(29, 'asijit', 0, 1, '2020-10-08', 'present', 9),
(30, 'asijit', 0, 1, '2020-10-08', 'present', 9),
(31, 'debayandam', 1, 11, '2020-10-07', 'present', 9),
(32, 'asijit', 0, 1, '2020-10-08', 'present', 9),
(33, 'debayandam', 1, 11, '2020-10-07', 'present', 9),
(34, 'admin', 0, 1, '2020-10-08', 'nope', 9);

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `user_id_a` int(11) NOT NULL,
  `user_id_b` int(11) NOT NULL,
  `status` varchar(11) DEFAULT 'ADD',
  `flag` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_id_a`, `user_id_b`, `status`, `flag`) VALUES
(1, 1, 6, 'Friends', 1),
(9, 1, 11, 'Friends', 1);

-- --------------------------------------------------------

--
-- Table structure for table `prefs`
--

CREATE TABLE `prefs` (
  `name` varchar(30) NOT NULL,
  `accept` int(11) NOT NULL,
  `c` int(11) NOT NULL,
  `cpp` int(11) NOT NULL,
  `java` int(11) NOT NULL,
  `python` int(11) NOT NULL,
  `python3` int(11) NOT NULL,
  `ruby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prefs`
--

INSERT INTO `prefs` (`name`, `accept`, `c`, `cpp`, `java`, `python`, `python3`, `ruby`) VALUES
('CodeWar', 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE `problems` (
  `sl` int(11) NOT NULL,
  `cname` varchar(225) NOT NULL,
  `name` varchar(200) NOT NULL,
  `text` text NOT NULL,
  `input` text NOT NULL,
  `output` text NOT NULL,
  `time` int(11) NOT NULL DEFAULT 3000,
  `points` int(11) NOT NULL DEFAULT 0,
  `penalty` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `problems`
--

INSERT INTO `problems` (`sl`, `cname`, `name`, `text`, `input`, `output`, `time`, `points`, `penalty`) VALUES
(3, 'Test', 'Addition of two numbers', '<p>Take two inputs a and b. Print their sum.</p>\r\n<p>Example:</p>\r\n<p>1 2</p>\r\n<p>3</p>\r\n<p>2 3</p>\r\n<p>5</p>\r\n<p>1 5</p>\r\n<p>6</p>\r\n<p>111 9</p>\r\n<p>120</p>', '1 2\r\n2 3\r\n1 5\r\n111 9', '3\r\n5\r\n6\r\n120', 1000, 50, 100),
(9, 'nope', 'Add 2 numbers', 'Take 2 inputs a and b and print their sum\r\n<p>EXAMPLE:</p>\r\n<p>1</p>\r\n<p>2</p>\r\n<p>3</p>', '1\r\n2', '3', 1000, 0, 0),
(10, 'present', 'add 2 numbers and divide', 'asasdasdasd', '', '', 1000, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(255) NOT NULL,
  `userid` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `upvote` int(255) DEFAULT NULL,
  `downvote` int(255) DEFAULT NULL,
  `rating` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `userid`, `username`, `upvote`, `downvote`, `rating`) VALUES
(1, 1, 'asijit', 0, 0, 0),
(3, 5, 'test', 0, 0, 0),
(4, 6, 'sri', 0, 0, 0),
(5, 8, 'srijita', 0, 0, 0),
(6, 1, 'a', 0, 0, 0),
(7, 1, 'uuu', 0, 0, 0),
(8, 1, 'a', 0, 0, 0),
(9, 11, 'debayandam', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `contestname` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `start` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `solve`
--

CREATE TABLE `solve` (
  `sl` int(11) NOT NULL,
  `cname` varchar(110) NOT NULL,
  `problem_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `attempts` int(11) NOT NULL DEFAULT 1,
  `soln` text NOT NULL,
  `filename` varchar(25) NOT NULL,
  `lang` varchar(20) NOT NULL,
  `score` int(110) NOT NULL DEFAULT 0,
  `penalty` int(110) NOT NULL DEFAULT 0,
  `points` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `solve`
--

INSERT INTO `solve` (`sl`, `cname`, `problem_id`, `username`, `status`, `attempts`, `soln`, `filename`, `lang`, `score`, `penalty`, `points`) VALUES
(18, 'present', 3, 'asijit', 2, 48, 'n=4\r\nwhile(n>0):\r\n	a=list(map(int, input().split()))\r\n	c=0\r\n	c=a[0]+a[1]\r\n	print(c)\r\n	n-=1', 'a.py', 'python3', -4650, 4800, 50),
(22, 'present', 9, 'asijit', 2, 4, 'a=gets.chomp.to_i\r\nb=gets.chomp.to_i\r\ns=a+b\r\nputs s\r\n', 'a.rb', 'ruby', 0, 0, 0),
(23, 'present', 9, 'debayandam', 2, 2, '#include<stdio.h>\r\nint main()\r\n{\r\nint a,b;\r\nscanf(\"%d\",&a);\r\nscanf(\"%d\",&b);\r\nint sum=a+b;\r\nprintf(\"%d\",sum);\r\nreturn 0;\r\n}', 'test.c', 'c', 1, 2, 1),
(24, 'nope', 9, 'admin', 2, 1, 'a=int(input())\r\nb=int(input())\r\nprint(a+b)\r\n', 'a.py', 'python3', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `full_name` text NOT NULL,
  `gender` text NOT NULL,
  `age` int(11) NOT NULL,
  `rating` decimal(11,0) NOT NULL DEFAULT 0,
  `cup` int(11) NOT NULL DEFAULT 0,
  `country` varchar(20) NOT NULL,
  `workplace` varchar(255) NOT NULL,
  `dp` blob DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `facebook` varchar(2555) DEFAULT NULL,
  `twitter` varchar(2555) DEFAULT NULL,
  `others` varchar(2555) DEFAULT NULL,
  `postcount` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `active` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `full_name`, `gender`, `age`, `rating`, `cup`, `country`, `workplace`, `dp`, `title`, `facebook`, `twitter`, `others`, `postcount`, `status`, `active`) VALUES
(1, 'asijit', 'asijit@1999', 'Asijit Paul', 'Male', 21, '0', -4650, 'India', 'UEMK', 0x6173696a69745f7069632e504e47, 'Newbie', 'https://www.facebook.com/asijit.paul/', 'https://twitter.com/asijit_paul', 'https://codeforces.com/profile/mrblood', 0, 1, 1),
(2, 'USER NOT FOUND', '', 'USER NOT FOUND', '', 0, '0', 0, 'USER NOT FOUND', 'USER NOT FOUND', 0x7175657374696f6e2e706e67, 'Not Available', NULL, NULL, NULL, 0, 1, 0),
(7, 'admin', 'asijit@1999', 'Asijit Paul', 'Male', 21, '0', 0, 'India', '', NULL, 'DEVS', NULL, NULL, NULL, 0, 1, 0),
(11, 'debayandam', '123456', 'Debayan Dam', 'MALE', 22, '0', 2, 'India', 'UEMK', 0x53454c462050484f544f2e6a7067, 'Newbie', NULL, NULL, NULL, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `username` varchar(80) NOT NULL,
  `token` varchar(80) NOT NULL,
  `timemodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contest`
--
ALTER TABLE `contest`
  ADD PRIMARY KEY (`contestid`);

--
-- Indexes for table `cups`
--
ALTER TABLE `cups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `solve`
--
ALTER TABLE `solve`
  ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`) USING HASH;

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contest`
--
ALTER TABLE `contest`
  MODIFY `contestid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cups`
--
ALTER TABLE `cups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
  MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `solve`
--
ALTER TABLE `solve`
  MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
