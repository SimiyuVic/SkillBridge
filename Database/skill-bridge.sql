-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2025 at 08:08 AM
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
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`admin_id`, `admin_name`, `email`, `password`, `created_at`) VALUES
(1, 'Admin', 'skillbridge@admin.com', '$2y$10$qodL.FDnOmMXRjg8qPudtO0zz0O.Fqfs30CJVl4z/YzpogyAWXdb6', '2024-01-30 11:18:34'),
(2, 'Admin01', 'admin@gmail.com', '$2y$10$qodL.FDnOmMXRjg8qPudtO0zz0O.Fqfs30CJVl4z/YzpogyAWXdb6', '2025-02-04 09:17:07');

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
(1, 'Victor', 'SES TECHNOLOGIES', 'info@ses.com', '01653436735', 'https://www.ses.com', 'Nairobi', 'Kilimani', '$2y$10$qodL.FDnOmMXRjg8qPudtO0zz0O.Fqfs30CJVl4z/YzpogyAWXdb6', 'We import and sell electronics in Kenya, we have more than 7 branches that are working well and we are the leading electronics store around the country.\r\nMore people continue to trust us with their electronics needs and that is what we pride in.', 'IMG-65b8b0da0fda15.52861220.png', 1, '2024-01-30 11:18:34');

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
(1, 1, 'IT INTERN', '<p>SES Technologies is seeking a motivated and enthusiastic individual to join our IT team as an Intern. This position offers an excellent opportunity to gain hands-on experience in a dynamic and innovative IT environment. As an IT Intern, you will have the chance to work closely with experienced professionals and contribute to meaningful projects that impact our company\'s operations.</p>\r\n<p>Responsibilities:<br>- Assist in troubleshooting hardware and software issues for employees<br>- Provide technical support to end-users via phone, email, or in-person<br>- Help maintain and update IT documentation and knowledge base<br>- Assist in the setup and configuration of computers, peripherals, and network devices<br>- Collaborate with team members on IT projects and initiatives<br>- Perform routine maintenance tasks such as system updates and backups</p>\r\n<p>Qualifications:<br>- Currently pursuing a degree in Computer Science, Information Technology, or related field<br>- Strong interest in IT and technology<br>- Basic understanding of computer hardware, operating systems, and networking concepts<br>- Excellent communication and interpersonal skills<br>- Ability to work independently and in a team environment<br>- Strong problem-solving skills and attention to detail<br>- Prior experience with IT support or customer service is a plus</p>\r\n<p>This is a paid internship position with flexible hours. SES Technologies is an equal opportunity employer committed to diversity and inclusion in the workplace. We encourage candidates of all backgrounds to apply.</p>\r\n<p>&nbsp;</p>', 'Internship', 'University Student/ Graduate', 'Nakuru', '25,000', '2024-02-23 19:00:11', 1, '2024-02-09 10:00:11'),
(2, 1, 'Human Resources Manager', '<h3 data-pm-slice=\"1 1 []\">About SES Technologies</h3>\r\n<p>SES Technologies is a leading [industry-specific] company dedicated to innovation, excellence, and employee growth. We are committed to fostering a dynamic and inclusive workplace where employees thrive and contribute to our continued success.</p>\r\n<h3>Job Overview</h3>\r\n<p>SES Technologies is seeking a highly motivated and experienced Human Resources Manager to lead and oversee all HR functions within the organization. The ideal candidate will be responsible for implementing HR strategies, policies, and initiatives to support business objectives while fostering a positive and productive workplace culture.</p>\r\n<h3>Key Responsibilities</h3>\r\n<ul data-spread=\"false\">\r\n<li>\r\n<p>Develop and implement HR strategies aligned with the company&rsquo;s goals and objectives.</p>\r\n</li>\r\n<li>\r\n<p>Oversee recruitment, onboarding, and talent acquisition processes to attract and retain top talent.</p>\r\n</li>\r\n<li>\r\n<p>Ensure compliance with labor laws, company policies, and industry regulations.</p>\r\n</li>\r\n<li>\r\n<p>Manage employee relations, conflict resolution, and performance management.</p>\r\n</li>\r\n<li>\r\n<p>Develop and implement training and development programs to enhance employee skills and career growth.</p>\r\n</li>\r\n<li>\r\n<p>Administer compensation, benefits, and performance evaluation programs.</p>\r\n</li>\r\n<li>\r\n<p>Foster a culture of diversity, equity, and inclusion within the organization.</p>\r\n</li>\r\n<li>\r\n<p>Maintain HR records, prepare reports, and support executive leadership with HR-related insights.</p>\r\n</li>\r\n</ul>\r\n<h3>Qualifications &amp; Skills</h3>\r\n<ul data-spread=\"false\">\r\n<li>\r\n<p>Bachelor&rsquo;s degree in Human Resources, Business Administration, or a related field.</p>\r\n</li>\r\n<li>\r\n<p>Proven experience (5+ years) in HR management or a similar role.</p>\r\n</li>\r\n<li>\r\n<p>Strong knowledge of labor laws, HR best practices, and industry regulations.</p>\r\n</li>\r\n<li>\r\n<p>Excellent interpersonal, communication, and leadership skills.</p>\r\n</li>\r\n<li>\r\n<p>Ability to handle sensitive and confidential matters with professionalism.</p>\r\n</li>\r\n<li>\r\n<p>Proficiency in HR software and Microsoft Office Suite.</p>\r\n</li>\r\n<li>\r\n<p>Strong problem-solving skills and the ability to work independently.</p>\r\n</li>\r\n</ul>\r\n<h3>Why Join SES Technologies?</h3>\r\n<ul data-spread=\"false\">\r\n<li>\r\n<p>Competitive salary and benefits package.</p>\r\n</li>\r\n<li>\r\n<p>Opportunities for professional growth and career advancement.</p>\r\n</li>\r\n<li>\r\n<p>A supportive and inclusive company culture.</p>\r\n</li>\r\n<li>\r\n<p>Dynamic work environment with innovative projects.</p>\r\n</li>\r\n</ul>\r\n<h3>How to Apply</h3>\r\n<p>Interested candidates are invited to submit their resume and a cover letter detailing their relevant experience to [email address]. Please include &ldquo;HR Manager Application &ndash; SES Technologies&rdquo; in the subject line.</p>\r\n<p>SES Technologies is an equal opportunity employer and values diversity in the workplace. We encourage qualified candidates of all backgrounds to apply.</p>', 'Full Time', 'Degree/ Diploma', 'Nairobu', '0', '2025-02-16 07:44:39', 2, '2025-02-04 09:44:39');

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
(1, 1, 1, 'company', 'Application Success', '<p>Hello your application was succesfull</p>', '2024-02-07 04:16:52'),
(2, 2, 1, 'company', 'Interview Invitation – HR Manager Position at SES Technologies', '<p>&nbsp;Dear James Does,</p>\r\n<p>Thank you for applying for the HR Manager position at SES Technologies. We were impressed with your qualifications and would like to invite you for an interview to discuss your application further.</p>\r\n<p>Please let us know your availability for an interview on [provide two or three date and time options]. The interview will be conducted [in-person/virtually] and is expected to last approximately [duration].</p>\r\n<p>Kindly confirm your preferred date and time, or let us know if you need an alternative arrangement. If the interview is virtual, we will send you the meeting link upon confirmation.</p>\r\n<p>We look forward to speaking with you.</p>\r\n<p>&nbsp;</p>', '2025-02-04 09:52:19');

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
(3, 1, 1, 1, 'user', 'Thank you', '2024-02-09 09:09:48'),
(4, 2, 2, 1, 'user', '<p>Thank you for considering my application for the HR Manager position at SES Technologies. I appreciate the opportunity to interview for this role.</p>\r\n<p>I am available on [preferred date and time] and look forward to discussing my qualifications and learning more about the position. Please let me know if you need any additional information before the interview.</p>\r\n<p>Looking forward to our conversation.</p>', '2025-02-04 09:54:33');

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
(1, 'Victor', 'Simiyu', 'vicofficial300@gmail.com', '0711381882', 'Student', '$2y$10$qodL.FDnOmMXRjg8qPudtO0zz0O.Fqfs30CJVl4z/YzpogyAWXdb6', 'BSc. Computer Science', 'I am hardworking', 'PHP, CSS and Javascript\r\n', 0, '2024-01-30 10:50:35'),
(2, 'James', 'Does', 'jamesdoe@gmail.com', '711381882', 'Student', '$2y$10$qodL.FDnOmMXRjg8qPudtO0zz0O.Fqfs30CJVl4z/YzpogyAWXdb6', 'Degree', 'I am a developer', 'I can code', 0, '2024-02-07 04:15:31'),
(3, 'James', 'Taylor', 'jamestaylor@outloo.com', '0798161654', 'Student', '$2y$10$qodL.FDnOmMXRjg8qPudtO0zz0O.Fqfs30CJVl4z/YzpogyAWXdb6', 'Degree', 'I am a student in final year', 'HTML\r\nCSS\r\nJS', 0, '2025-02-04 09:28:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
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
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `jobpost_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `porfolio_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reply_messages`
--
ALTER TABLE `reply_messages`
  MODIFY `reply_messages_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
