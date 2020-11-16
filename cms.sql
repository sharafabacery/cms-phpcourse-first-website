-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2020 at 01:24 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`, `user_id`) VALUES
(1, 'bootstrap', 1),
(2, 'javascript', 1),
(3, 'php', 0),
(4, 'java', 0),
(6, 'C++', 0),
(7, 'C', 0),
(8, '11112', 0),
(11, 'python3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(6, 39, 'sharaf', 'aaa@gmail.com', 'kmklmkmlkmkkmlkmlkmlkmlkmlkmlkmlkmklmlkmlkmlkkmlkmlkmlkmklmlkkmlmlkmk', 'unapproved', '2020-11-16');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL,
  `post_user` varchar(255) NOT NULL,
  `likes` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`, `post_user`, `likes`, `user_id`) VALUES
(39, 1, 'sharaf cms course', 'sharaf', '2020-11-08', 'download.jpg', 'ksdflkdjfksdjfksdjflksdfjlskdfjlskdfjskldfjskldfjlksdfjklsdfjlksdfjklsdfjlksjfdlksdjflksdjflksdjflksdjflskdjflksdjflskjflkdfjlfj', 'edwin, javascript, php', 1, 'published', 0, '', 1, 1),
(40, 1, 'lorem cms', 'sharaf', '2020-11-08', '', 'kffffffffffffffffffffffffffffffffffffffffffmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv', 'php, java', 0, 'published', 0, '', 0, 1),
(41, 2, '123135151551', 'sharaf', '2020-11-08', '', '<p>kjfergjkfgjlkdfgjkldfgjlkdfjglkdfjgkldfgjkldfgjkldfjgkldfgjkldfgjkldfgjlkdfgjkldfgjdklfgjldkfgjkldfgjkldfgjkldfgjkldfgjkldfgjkldfgjlkdfgjkldfgjkldfgjkdfgjldkfgjldkfgjkldfgjkldfgjkldfgjlkdfgjkldfgjkldfjglkdgjlkdfjgldfkgjdfjgkdfjglkdfjglkdfjglkdfgjlkdfgjlkdfgjkl</p>', 'php, java', 0, 'published', 0, '', 0, 1),
(42, 1, 'sharaf cms course', 'sharaf', '2020-11-08', 'download.jpg', 'ksdflkdjfksdjfksdjflksdfjlskdfjlskdfjskldfjskldfjlksdfjklsdfjlksdfjklsdfjlksjfdlksdjflksdjflksdjflksdjflskdjflksdjflskjflkdfjlfj', 'edwin, javascript, php', 0, 'published', 0, '', 0, 0),
(43, 1, 'lorem cms', 'sharaf', '2020-11-08', '', 'kffffffffffffffffffffffffffffffffffffffffffmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv', 'php, java', 0, 'published', 0, '', 0, 0),
(44, 2, '123135151551', 'sharaf', '2020-11-08', '', '<p>kjfergjkfgjlkdfgjkldfgjlkdfjglkdfjgkldfgjkldfgjkldfjgkldfgjkldfgjkldfgjlkdfgjkldfgjdklfgjldkfgjkldfgjkldfgjkldfgjkldfgjkldfgjkldfgjlkdfgjkldfgjkldfgjkdfgjldkfgjldkfgjkldfgjkldfgjkldfgjlkdfgjkldfgjkldfjglkdgjlkdfjgldfkgjdfjgkdfjglkdfjglkdfjglkdfgjlkdfgjlkdfgjkl</p>', 'php, java', 0, 'published', 0, '', 0, 0),
(45, 1, 'sharaf cms course', 'sharaf', '2020-11-08', 'download.jpg', 'ksdflkdjfksdjfksdjflksdfjlskdfjlskdfjskldfjskldfjlksdfjklsdfjlksdfjklsdfjlksjfdlksdjflksdjflksdjflksdjflskdjflksdjflskjflkdfjlfj', 'edwin, javascript, php', 0, 'published', 0, '', 0, 0),
(46, 1, 'lorem cms', 'sharaf', '2020-11-08', '', 'kffffffffffffffffffffffffffffffffffffffffffmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv', 'php, java', 0, 'published', 0, '', 0, 0),
(47, 2, '123135151551', 'sharaf', '2020-11-08', '', '<p>kjfergjkfgjlkdfgjkldfgjlkdfjglkdfjgkldfgjkldfgjkldfjgkldfgjkldfgjkldfgjlkdfgjkldfgjdklfgjldkfgjkldfgjkldfgjkldfgjkldfgjkldfgjkldfgjlkdfgjkldfgjkldfgjkdfgjldkfgjldkfgjkldfgjkldfgjkldfgjlkdfgjkldfgjkldfjglkdgjlkdfjgldfkgjdfjgkdfjglkdfjglkdfjglkdfgjlkdfgjlkdfgjkl</p>', 'php, java', 0, 'published', 0, '', 0, 0),
(48, 1, 'sharaf cms course', 'sharaf', '2020-11-08', 'download.jpg', 'ksdflkdjfksdjfksdjflksdfjlskdfjlskdfjskldfjskldfjlksdfjklsdfjlksdfjklsdfjlksjfdlksdjflksdjflksdjflksdjflskdjflksdjflskjflkdfjlfj', 'edwin, javascript, php', 0, 'published', 0, '', 0, 0),
(49, 1, 'lorem cms', 'sharaf', '2020-11-08', '', 'kffffffffffffffffffffffffffffffffffffffffffmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv', 'php, java', 0, 'published', 0, '', 0, 0),
(50, 2, '123135151551', 'sharaf', '2020-11-08', '', '<p>kjfergjkfgjlkdfgjkldfgjlkdfjglkdfjgkldfgjkldfgjkldfjgkldfgjkldfgjkldfgjlkdfgjkldfgjdklfgjldkfgjkldfgjkldfgjkldfgjkldfgjkldfgjkldfgjlkdfgjkldfgjkldfgjkdfgjldkfgjldkfgjkldfgjkldfgjkldfgjlkdfgjkldfgjkldfjglkdgjlkdfjgldfkgjdfjgkdfjglkdfjglkdfjglkdfgjlkdfgjlkdfgjkl</p>', 'php, java', 0, 'published', 0, '', 0, 0),
(51, 2, '123135151551', 'sharaf', '2020-11-08', '', '<p>kjfergjkfgjlkdfgjkldfgjlkdfjglkdfjgkldfgjkldfgjkldfjgkldfgjkldfgjkldfgjlkdfgjkldfgjdklfgjldkfgjkldfgjkldfgjkldfgjkldfgjkldfgjkldfgjlkdfgjkldfgjkldfgjkdfgjldkfgjldkfgjkldfgjkldfgjkldfgjlkdfgjkldfgjkldfjglkdgjlkdfjgldfkgjdfjgkdfjglkdfjglkdfjglkdfgjlkdfgjlkdfgjkl</p>', 'php, java', 0, 'published', 0, '', 0, 0),
(52, 2, '123135151551', 'sharaf', '2020-11-08', '', '<p>kjfergjkfgjlkdfgjkldfgjlkdfjglkdfjgkldfgjkldfgjkldfjgkldfgjkldfgjkldfgjlkdfgjkldfgjdklfgjldkfgjkldfgjkldfgjkldfgjkldfgjkldfgjkldfgjlkdfgjkldfgjkldfgjkdfgjldkfgjldkfgjkldfgjkldfgjkldfgjlkdfgjkldfgjkldfjglkdgjlkdfjgldfkgjdfjgkdfjglkdfjglkdfjglkdfgjlkdfgjlkdfgjkl</p>', 'php, java', 0, 'published', 0, '', 0, 0),
(53, 2, '123135151551', 'sharaf', '2020-11-08', '', '<p>kjfergjkfgjlkdfgjkldfgjlkdfjglkdfjgkldfgjkldfgjkldfjgkldfgjkldfgjkldfgjlkdfgjkldfgjdklfgjldkfgjkldfgjkldfgjkldfgjkldfgjkldfgjkldfgjlkdfgjkldfgjkldfgjkdfgjldkfgjldkfgjkldfgjkldfgjkldfgjlkdfgjkldfgjkldfjglkdgjlkdfjgldfkgjdfjgkdfjglkdfjglkdfjglkdfgjlkdfgjlkdfgjkl</p>', 'php, java', 0, 'published', 0, '', 0, 0),
(54, 2, '123135151551', 'sharaf', '2020-11-08', '', '<p>kjfergjkfgjlkdfgjkldfgjlkdfjglkdfjgkldfgjkldfgjkldfjgkldfgjkldfgjkldfgjlkdfgjkldfgjdklfgjldkfgjkldfgjkldfgjkldfgjkldfgjkldfgjkldfgjlkdfgjkldfgjkldfgjkdfgjldkfgjldkfgjkldfgjkldfgjkldfgjlkdfgjkldfgjkldfjglkdgjlkdfjgldfkgjdfjgkdfjglkdfjglkdfjglkdfgjlkdfgjlkdfgjkl</p>', 'php, java', 0, 'published', 0, '', 0, 0),
(55, 2, '123135151551', 'sharaf', '2020-11-08', '', '<p>kjfergjkfgjlkdfgjkldfgjlkdfjglkdfjgkldfgjkldfgjkldfjgkldfgjkldfgjkldfgjlkdfgjkldfgjdklfgjldkfgjkldfgjkldfgjkldfgjkldfgjkldfgjkldfgjlkdfgjkldfgjkldfgjkdfgjldkfgjldkfgjkldfgjkldfgjkldfgjlkdfgjkldfgjkldfjglkdgjlkdfjgldfkgjdfjgkdfjglkdfjglkdfjglkdfgjlkdfgjlkdfgjkl</p>', 'php, java', 0, 'published', 0, '', 0, 0),
(59, 2, '123135151551', 'sharaf', '2020-11-14', '', '<p>kjfergjkfgjlkdfgjkldfgjlkdfjglkdfjgkldfgjkldfgjkldfjgkldfgjkldfgjkldfgjlkdfgjkldfgjdklfgjldkfgjkldfgjkldfgjkldfgjkldfgjkldfgjkldfgjlkdfgjkldfgjkldfgjkdfgjldkfgjldkfgjkldfgjkldfgjkldfgjlkdfgjkldfgjkldfjglkdgjlkdfjgldfkgjdfjgkdfjglkdfjglkdfjglkdfgjlkdfgjlkdfgjkl</p>', 'php, java', 0, 'published', 0, '', 0, 0),
(60, 2, '123135151551', 'sharaf', '2020-11-14', '', '<p>kjfergjkfgjlkdfgjkldfgjlkdfjglkdfjgkldfgjkldfgjkldfjgkldfgjkldfgjkldfgjlkdfgjkldfgjdklfgjldkfgjkldfgjkldfgjkldfgjkldfgjkldfgjkldfgjlkdfgjkldfgjkldfgjkdfgjldkfgjldkfgjkldfgjkldfgjkldfgjlkdfgjkldfgjkldfjglkdgjlkdfjgldfkgjdfjgkdfjglkdfjglkdfjglkdfgjlkdfgjlkdfgjkl</p>', 'php, java', 0, 'published', 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$1234567891234567891234',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `post_user` varchar(255) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_role`, `user_email`, `user_image`, `randSalt`, `date`, `post_user`, `token`) VALUES
(1, 'reco', '$1$9SMMmpNO$Ko6lsiHcg1tKJIRgF35Yt.', 'ricoo', 'hazard', 'admin', 'ricohazard@gmail.com', '', '$2y$10$1234567891234567891234', '2020-11-07 18:54:50', '', ''),
(3, 'sharafabacery1', '$2y$12$yjTVhJjmXfGnrIQTji91juhWG/wYvNspMohLlRHv80lqS.w1iJXJe', 'sharaf', 'alabacery', 'admin', 'abacerysharaf@gmail.com', '', '$2y$10$1234567891234567891234', '2020-11-14 19:55:00', '', ''),
(5, 'sharaf122', '$1$9SMMmpNO$Ko6lsiHcg1tKJIRgF35Yt.', 'sharaf', 'alabacery', 'admin', 'abacerysharaf1@gmail.com', '', '$2y$10$1234567891234567891234', '2020-11-07 18:54:42', '', ''),
(6, 'sharaf2000', '$1$9SMMmpNO$Ko6lsiHcg1tKJIRgF35Yt.', 'ricoo', 'alabacery', 'subscriber', 'abacerysha1raf@gmail.com', '', '$2y$10$1234567891234567891234', '2020-11-07 18:54:38', '', ''),
(7, 'sharaf', '$1$9SMMmpNO$Ko6lsiHcg1tKJIRgF35Yt.', '', '', 'subscriber', 'abacery@gmail.com', '', '$2y$10$1234567891234567891234', '2020-11-07 18:54:34', '', ''),
(8, 'sharaf123', '$1$9SMMmpNO$Ko6lsiHcg1tKJIRgF35Yt.', '', '', 'admin', 'example@gmail.com', '', '$2y$10$1234567891234567891234', '2020-11-07 18:38:30', '', ''),
(9, 'sharaf1234', '123456789', 'sharaf', 'alabacery', 'subscriber', 'someone@gmail.com', '', '$2y$10$1234567891234567891234', '2020-11-08 19:09:00', '', ''),
(13, 'sharaf1525', '$2y$12$/nrb8AYaylMkP8Dl54zhxOtmHlaYCrcF8CR1HpeJIy.bGKVbviKZi', '', '', 'subscriber', 'ricohazard1@gmail.com', '', '$2y$10$1234567891234567891234', '2020-11-11 17:55:10', '', ''),
(14, 'sharaf1258', '$2y$12$6wEs7lcUaKh.qUbevY/suua9MfGliv5qWJCC7/zzbmzH/BJWgjN7m', '', '', 'subscriber', 'jennifer_petroff@8155.45.sharelane.com', '', '$2y$10$1234567891234567891234', '2020-11-11 17:56:02', '', ''),
(15, 'sharaf1235', '$2y$12$h.MMR.fIfntpuzaehY3bYepV/MiXdSm7GLrrLL2SaBAQsXtRQWyTe', '', '', 'subscriber', 'jennifer_petroff1@855.45.sharelane.com', '', '$2y$10$1234567891234567891234', '2020-11-11 18:00:27', '', ''),
(16, 'sharaf12354', '$2y$12$M1ReEjsj.QDCqhb6dbkVQOTdkafUGU2EgfB2Ut2X7AqKTQS9p.pXW', '', '', 'subscriber', 'jennifer_petroff11@855.45.sharelane.com', '', '$2y$10$1234567891234567891234', '2020-11-11 18:01:26', '', ''),
(19, 'reco123456', '$2y$12$FOlT14zuREml53ANbVh7suveAkoQActTbaR72q0rpIZ8vXKS4ru0e', '', '', 'subscriber', 'sharafabacery123456@gmail.com', '', '$2y$10$1234567891234567891234', '2020-11-14 21:56:30', '', ''),
(20, 'recoioio', '$2y$12$ltgWCBKux5bYNz/6SG59dOst.VJ6NtB9gGX/Y2HvRvwkt9jV8TNnu', '', '', 'subscriber', 'sim.sharaf.ehab1415@alexu.edu.eg', '', '$2y$10$1234567891234567891234', '2020-11-14 22:21:51', '', ''),
(21, 'riconnnn', '$2y$12$XXhUMI.KZLnMaTcratqLce3MKCLSPo82dsiTTP/rlv9mAsBQbhjly', '', '', 'subscriber', 'sharafabacery12345126@gmail.com', '', '$2y$10$1234567891234567891234', '2020-11-14 22:26:56', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(1, '1qioijcpfj605god9ohqtegirn', 1604859827),
(2, '0nvo06uurhs1c3karibdarlgta', 1604858384),
(3, '4sk8ac38qeu35g2dppgppiab7o', 1604859820),
(4, '3q1630snken12a5jfobceot5v0', 1604862713),
(5, '95aldeg0q4rl077e012vvhdbah', 1604860010),
(6, 'gustfv1m5jcto649sdte2gs4dv', 1604969128),
(7, 'befifmfnod4u5vjnvmc2airi2p', 1605051028),
(8, 'l0veqvoh6klveir2jsd9b8mv6k', 1605129166),
(9, '4v7igps6ukhcn5fg714ql2cton', 1605234001),
(10, 'h22c8p44skh9mhp58fcs2qhis0', 1605321469),
(11, 'o44i3ldje66qrd5vunmhahbc9r', 1605392914),
(12, 'dc3ptrp0nc17mkphpvb4h30hid', 1605392909),
(13, 'mqmnqbhf7le59m5q83h5feeel7', 1605486281);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
