-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2024 at 06:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skill-bridge`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`, `created_at`) VALUES
(1, 'Admin', 'skillbridge@admin.com', '$2y$10$2qNKCmDJwaUzjZhFMVarpuY2ACH0rhxMAq2ZreuTBXlMWgb5OSUXG', '2024-01-30 11:18:34');

-- --------------------------------------------------------

--
-- Table structure for table `applied_jobs`
--

CREATE TABLE `applied_jobs` (
  `appliedjobs_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `jobpost_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 2,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applied_jobs`
--

INSERT INTO `applied_jobs` (`appliedjobs_id`, `user_id`, `company_id`, `jobpost_id`, `status`, `created_at`) VALUES
(1, 1, 1, 1, 1, '2024-02-07 04:00:35'),
(2, 2, 1, 1, 1, '2024-02-07 04:15:48');

-- --------------------------------------------------------

--
-- Table structure for table `contact_form`
--

CREATE TABLE `contact_form` (
  `message_id` int(11) NOT NULL,
  `sender_name` varchar(100) NOT NULL,
  `sender_email` varchar(100) NOT NULL,
  `sender_query` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT 'Message Read or Unread',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_form`
--

INSERT INTO `contact_form` (`message_id`, `sender_name`, `sender_email`, `sender_query`, `status`, `created_at`) VALUES
(1, 'Victor Simiyu', 'vicofficial300@gmail.com', 'Hello, this is to test the contact form', 1, '2024-02-12 13:58:01'),
(2, 'Victor', 'vicofficial300@gmail.com', 'Test message again', 1, '2024-02-12 14:17:01');

-- --------------------------------------------------------

--
-- Table structure for table `employers`
--

CREATE TABLE `employers` (
  `company_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `county` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `company_logo` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employers`
--

INSERT INTO `employers` (`company_id`, `username`, `company_name`, `email`, `phone_number`, `website`, `county`, `city`, `password`, `description`, `company_logo`, `status`, `created_at`) VALUES
(1, 'Victor', 'SES TECHNOLOGIES', 'info@ses.com', '01653436735', 'https://www.ses.com', 'Nairobi', 'Kilimani', '$2y$10$vmNozwZ0TpupdTdn97z/oebGo/Pv8KqFOekjuCwKVFvXUan4M1n/m', 'We import and sell electronics in Kenya, we have more than 7 branches that are working well and we are the leading electronics store around the country.\r\nMore people continue to trust us with their electronics needs and that is what we pride in.', 'IMG-65b8b0da0fda15.52861220.png', 0, '2024-01-30 11:18:34');

-- --------------------------------------------------------

--
-- Table structure for table `job_post`
--

CREATE TABLE `job_post` (
  `jobpost_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `job_description` text NOT NULL,
  `designation` varchar(100) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `expected_salary` varchar(100) NOT NULL,
  `expiration_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 2,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_post`
--

INSERT INTO `job_post` (`jobpost_id`, `company_id`, `job_title`, `job_description`, `designation`, `qualification`, `location`, `expected_salary`, `expiration_date`, `status`, `created_at`) VALUES
(1, 1, 'IT INTERN', '<p>SES Technologies is seeking a motivated and enthusiastic individual to join our IT team as an Intern. This position offers an excellent opportunity to gain hands-on experience in a dynamic and innovative IT environment. As an IT Intern, you will have the chance to work closely with experienced professionals and contribute to meaningful projects that impact our company\'s operations.</p>\r\n<p>Responsibilities:<br>- Assist in troubleshooting hardware and software issues for employees<br>- Provide technical support to end-users via phone, email, or in-person<br>- Help maintain and update IT documentation and knowledge base<br>- Assist in the setup and configuration of computers, peripherals, and network devices<br>- Collaborate with team members on IT projects and initiatives<br>- Perform routine maintenance tasks such as system updates and backups</p>\r\n<p>Qualifications:<br>- Currently pursuing a degree in Computer Science, Information Technology, or related field<br>- Strong interest in IT and technology<br>- Basic understanding of computer hardware, operating systems, and networking concepts<br>- Excellent communication and interpersonal skills<br>- Ability to work independently and in a team environment<br>- Strong problem-solving skills and attention to detail<br>- Prior experience with IT support or customer service is a plus</p>\r\n<p>This is a paid internship position with flexible hours. SES Technologies is an equal opportunity employer committed to diversity and inclusion in the workplace. We encourage candidates of all backgrounds to apply.</p>\r\n<p>&nbsp;</p>', 'Internship', 'University Student/ Graduate', 'Nakuru', '25,000', '2024-02-23 19:00:11', 2, '2024-02-09 10:00:11');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `message_subject` varchar(100) NOT NULL,
  `message_content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `user_id`, `company_id`, `sender`, `message_subject`, `message_content`, `created_at`) VALUES
(1, 1, 1, 'company', 'Application Success', '<p>Hello your application was succesfull</p>', '2024-02-07 04:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE `portfolio` (
  `porfolio_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_title` varchar(100) NOT NULL,
  `project_link` varchar(100) NOT NULL,
  `project_info` varchar(100) NOT NULL,
  `project_description` text NOT NULL,
  `project_image` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reply_messages`
--

CREATE TABLE `reply_messages` (
  `reply_messages_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `reply_message_content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reply_messages`
--

INSERT INTO `reply_messages` (`reply_messages_id`, `message_id`, `user_id`, `company_id`, `sender`, `reply_message_content`, `created_at`) VALUES
(1, 1, 1, 1, 'company', '<p>Test Reply</p>', '2024-02-07 04:18:35'),
(2, 1, 1, 1, 'company', '<p>Test reply again</p>', '2024-02-07 07:22:43'),
(3, 1, 1, 1, 'user', 'Thank you', '2024-02-09 09:09:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `study` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `skills` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `phone_number`, `occupation`, `password`, `study`, `description`, `skills`, `status`, `created_at`) VALUES
(1, 'Victor', 'Simiyu', 'vicofficial300@gmail.com', '0711381882', 'Student', '$2y$10$2qNKCmDJwaUzjZhFMVarpuY2ACH0rhxMAq2ZreuTBXlMWgb5OSUXG', 'BSc. Computer Science', 'I am hardworking', 'PHP, CSS and Javascript\r\n', 0, '2024-01-30 10:50:35'),
(2, 'James', 'Does', 'jamesdoe@gmail.com', '711381882', 'Student', '$2y$10$Ok/hzSK6fM8GqLYKhWuCoOhJZqVU5YdWXlgV54pUnyyytxl3sPWha', 'Degree', 'I am a developer', 'I can code', 0, '2024-02-07 04:15:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `applied_jobs`
--
ALTER TABLE `applied_jobs`
  ADD PRIMARY KEY (`appliedjobs_id`);

--
-- Indexes for table `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `employers`
--
ALTER TABLE `employers`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `job_post`
--
ALTER TABLE `job_post`
  ADD PRIMARY KEY (`jobpost_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`porfolio_id`);

--
-- Indexes for table `reply_messages`
--
ALTER TABLE `reply_messages`
  ADD PRIMARY KEY (`reply_messages_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `applied_jobs`
--
ALTER TABLE `applied_jobs`
  MODIFY `appliedjobs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employers`
--
ALTER TABLE `employers`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `job_post`
--
ALTER TABLE `job_post`
  MODIFY `jobpost_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `porfolio_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reply_messages`
--
ALTER TABLE `reply_messages`
  MODIFY `reply_messages_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
