-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2023 at 12:32 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skill_bridge`
--

-- --------------------------------------------------------

--
-- Table structure for table `apply_job_post`
--

CREATE TABLE `apply_job_post` (
  `apply_id` int(11) NOT NULL,
  `jobpost_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apply_job_post`
--

INSERT INTO `apply_job_post` (`apply_id`, `jobpost_id`, `company_id`, `user_id`, `status`, `created_at`) VALUES
(4, 3, 5, 1, 0, '2023-11-12 13:24:02'),
(5, 2, 5, 1, 1, '2023-11-12 13:29:59'),
(6, 1, 5, 1, 2, '2023-11-12 14:11:08'),
(7, 3, 5, 2, 0, '2023-11-12 17:23:58');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `user_id` int(255) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `about_me` varchar(200) NOT NULL,
  `skills` varchar(100) NOT NULL,
  `resume` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`user_id`, `firstname`, `lastname`, `email`, `phone_number`, `password`, `qualification`, `occupation`, `about_me`, `skills`, `resume`, `created_at`) VALUES
(1, 'Victor', 'Charles', 'vicofficial300@gmail.com', '0711223344', '123456', 'Degree', 'Student', 'I am a hardworking, self driven , self motivated tech enthusiast', 'PHP,\r\nTailwinnd,\r\njavascript\r\n', '', '2023-10-25 12:00:09'),
(2, 'Moureen', 'Kiteme', 'moureen@gmail.com', '0711243454', '12345', 'Degree', 'Student', 'Hardworking,\r\nSelf Motivated\r\nSelf Driven', 'A good actuary', '', '2023-11-09 06:21:51');

-- --------------------------------------------------------

--
-- Table structure for table `employers`
--

CREATE TABLE `employers` (
  `company_id` int(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `about_company` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `county` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employers`
--

INSERT INTO `employers` (`company_id`, `fullname`, `company`, `website`, `email`, `about_company`, `password`, `phone_number`, `county`, `city`, `logo`, `created_at`) VALUES
(5, 'Victor Sales', 'Vision Company', 'www.visionkenya.com', 'visio@sales.com', 'We sell electronics', '123456', '0711223345', 'Mombasa', 'Mombasa', 'IMG-653a605ccae121.26749606.png', '2023-10-26 12:49:32'),
(6, 'SES TECHNOLOGIES', 'SES TECHNOLOGIES', 'www.sescommunications.co.ke', 'info@sestech.com', 'We sell electronics', '123456', '0711225478', 'Nakuru', 'Nakuru', 'IMG-6550e14a6835d7.33248895.jpg', '2023-11-12 14:29:30');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE `portfolio` (
  `portfolio_id` mediumint(9) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_title` varchar(100) NOT NULL,
  `project_info` varchar(100) NOT NULL,
  `project_description` varchar(255) NOT NULL,
  `project_link` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`portfolio_id`, `user_id`, `project_title`, `project_info`, `project_description`, `project_link`, `profile`) VALUES
(4, 1, 'Instant Shopper', 'Ecommerce  ', 'Online sales shop ', 'www.shopify.com', 'IMG-6549fa50b8c4b7.78646530.jpg'),
(6, 2, 'Vision Company', 'Created a website fullstack', 'This is a test', 'www.dataentry.go.ke', 'IMG-654f27ecb14990.67839049.png'),
(9, 1, 'Vision', 'Vision Company data entry', 'data entry', 'kenya.dataentry.co.ke', 'IMG-6550a7cb97eb95.04127320.png');

-- --------------------------------------------------------

--
-- Table structure for table `vacancies`
--

CREATE TABLE `vacancies` (
  `jobpost_id` int(11) NOT NULL,
  `company_id` varchar(100) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `job_description` text NOT NULL,
  `salary` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vacancies`
--

INSERT INTO `vacancies` (`jobpost_id`, `company_id`, `job_title`, `job_description`, `salary`, `designation`, `qualification`, `created_at`) VALUES
(1, '5', 'IT INTERN', '<p>About Us:</p>\\r\\n<p>Vision Solutions is a leading technology company specializing in [mention your company\\\'s specific focus or mission]. We are committed to innovation, excellence, and fostering a collaborative and inclusive work culture.</p>\\r\\n<p>&nbsp;</p>\\r\\n<p>Job Description:</p>\\r\\n<p>&nbsp;</p>\\r\\n<p>Are you a tech-savvy individual eager to gain real-world experience in the IT field? Do you have a passion for problem-solving, troubleshooting, and working with cutting-edge technology? If so, we invite you to join our team as an IT Intern at Vision Solutions.</p>\\r\\n<p>&nbsp;</p>\\r\\n<p>Key Responsibilities:</p>\\r\\n<p>&nbsp;</p>\\r\\n<p>Assist with the installation, configuration, and maintenance of hardware and software.</p>\\r\\n<p>Provide technical support to employees, resolving IT issues and inquiries.</p>\\r\\n<p>Help manage and maintain the company\\\'s network infrastructure.</p>\\r\\n<p>Collaborate with the IT team to implement and upgrade software and systems.</p>\\r\\n<p>Contribute to IT projects, including data management and cybersecurity initiatives.</p>\\r\\n<p>Perform routine IT administrative tasks and documentation.</p>\\r\\n<p>Requirements:</p>\\r\\n<p>&nbsp;</p>\\r\\n<p>Currently pursuing a degree in Computer Science, Information Technology, or a related field.</p>\\r\\n<p>Strong passion for technology and a desire to learn and grow in the IT field.</p>\\r\\n<p>Basic knowledge of operating systems (Windows, macOS, Linux) and office software.</p>\\r\\n<p>Excellent problem-solving and communication skills.</p>\\r\\n<p>Ability to work independently and as part of a team.</p>\\r\\n<p>Eagerness to take on new challenges and adapt to a fast-paced environment.</p>\\r\\n<p>What We Offer:</p>\\r\\n<p>&nbsp;</p>\\r\\n<p>Valuable hands-on experience in a dynamic and supportive IT environment.</p>\\r\\n<p>Mentoring from experienced IT professionals.</p>\\r\\n<p>Exposure to a wide range of IT systems, tools, and technologies.</p>\\r\\n<p>A collaborative and inclusive work culture.</p>\\r\\n<p>Opportunity to contribute to meaningful projects.</p>', '25000', 'Internship', 'Degree/Diploma', '2023-10-26'),
(2, '5', 'Receptionist', '<p style=\\\"margin: 5pt 0pt; text-align: left; font-family: \\\'Times New Roman\\\'; font-size: 12pt;\\\"><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\">Are you an organized, friendly, and efficient individual looking to join a dynamic team? Vision Company is currently seeking a Receptionist to be the first point of contact for our company. If you have excellent communication skills and a welcoming personality, we want to hear from you!</span></p>\\r\\n<p style=\\\"margin: 5pt 0pt; text-align: left; font-family: \\\'Times New Roman\\\'; font-size: 12pt;\\\"><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\">Responsibilities:</span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\"><br></span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\">- Greet and assist visitors in a professional and friendly manner.</span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\"><br></span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\">- Answer and direct phone calls to the appropriate personnel.</span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\"><br></span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\">- Manage appointments and scheduling.</span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\"><br></span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\">- Maintain a neat and organized reception area.</span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\"><br></span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\">- Handle incoming and outgoing mail and packages.</span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\"><br></span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\">- Provide general administrative support as needed.</span></p>\\r\\n<p style=\\\"margin: 5pt 0pt; text-align: left; font-family: \\\'Times New Roman\\\'; font-size: 12pt;\\\"><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\">Qualifications:</span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\"><br></span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\">- Excellent communication and interpersonal skills.</span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\"><br></span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\">- Strong organizational abilities.</span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\"><br></span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\">- Proficient in using office software and equipment.</span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\"><br></span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\">- A welcoming and positive demeanor.</span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\"><br></span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\">- Previous receptionist or administrative experience is a plus.</span></p>\\r\\n<p style=\\\"margin: 5pt 0pt; text-align: left; font-family: \\\'Times New Roman\\\'; font-size: 12pt;\\\"><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\">Benefits:</span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\"><br></span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\">- Competitive salary.</span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\"><br></span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\">- Friendly and inclusive work environment.</span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\"><br></span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\">- Opportunities for professional growth.</span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\"><br></span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\">- Health and wellness benefits.</span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\"><br></span><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\">- Flexible working hours.</span></p>\\r\\n<p style=\\\"margin: 5pt 0pt; text-align: left; font-family: \\\'Times New Roman\\\'; font-size: 12pt;\\\"><span style=\\\"font-family: \\\'Times New Roman\\\'; font-size: 12.0000pt;\\\">Join Vision Company, where your skills and welcoming personality will make a difference every day!</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">&nbsp;</span></p>', '20000', 'Attachment', 'Degree/Diploma', '2023-10-26'),
(3, '5', 'WEB DEVELOPER', '<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">About Vision Company:</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">&nbsp;</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">Vision Company is a leading </span><span style=\\\"font-family: Calibri;\\\">Tech Company</span><span style=\\\"font-family: Calibri;\\\">&nbsp;</span><span style=\\\"font-family: Calibri;\\\">.</span><span style=\\\"font-family: Calibri;\\\">We take pride in our commitment to innovation, excellence, and providing exceptional solutions to our clients. As we continue to grow and expand our online presence, we are looking for a talented and motivated Web Developer to join our team.</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">&nbsp;</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">Job Description:</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">&nbsp;</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">We are seeking a Web Developer to help us create and maintain the online face of Vision Company. The successful candidate will work on a wide range of projects, from building and maintaining our website to developing custom web applications and optimizing user experiences. If you\\\'re passionate about web development, have a strong foundation in coding and design, and are excited to work in a dynamic and collaborative environment, we want to hear from you.</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">&nbsp;</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">Key Responsibilities:</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">&nbsp;</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">Collaborate with the design and marketing teams to develop and maintain the company website.</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">Create and optimize web content for better performance, SEO, and user experience.</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">Develop and maintain custom web applications as needed.</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">Troubleshoot and resolve website issues and bugs.</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">Stay updated on industry trends and emerging technologies to recommend improvements.</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">Ensure the security and integrity of the website and web applications.</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">Qualifications:</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">&nbsp;</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">Bachelor\\\'s degree in Computer Science, Web Development, or a related field (or equivalent work experience).</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">Proficiency in HTML, CSS, JavaScript, and other relevant web development technologies.</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">Experience with content management systems (e.g., WordPress) and web development frameworks.</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">Strong understanding of web design principles and user experience best practices.</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">Excellent problem-solving skills and attention to detail.</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">Knowledge of SEO best practices.</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">Ability to work collaboratively in a team environment.</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">Strong communication skills.</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">Preferred Qualifications:</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">&nbsp;</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">Experience with e-commerce platforms.</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">Familiarity with responsive web design.</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">Knowledge of web security best practices.</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">Experience with version control systems (e.g., Git).</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">How to Apply:</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">&nbsp;</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">If you are a dedicated web developer with a passion for creating outstanding online experiences, we invite you to apply for this position. Please submit your resume, a cover letter detailing your relevant experience, and a portfolio showcasing your web development projects to [email address].</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">&nbsp;</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">Vision Company is an equal opportunity employer. We welcome and encourage diversity in the workplace.</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">&nbsp;</span></p>\\r\\n<p style=\\\"margin: 0pt 0pt 0.0001pt; font-family: Calibri;\\\"><span style=\\\"font-family: Calibri;\\\">Join us in shaping the future of Vision Company\\\'s online presence and making a significant impact in the industry!</span></p>', '30000', 'Entry Level', 'Degree', '2023-11-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apply_job_post`
--
ALTER TABLE `apply_job_post`
  ADD PRIMARY KEY (`apply_id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `employers`
--
ALTER TABLE `employers`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`portfolio_id`);

--
-- Indexes for table `vacancies`
--
ALTER TABLE `vacancies`
  ADD PRIMARY KEY (`jobpost_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apply_job_post`
--
ALTER TABLE `apply_job_post`
  MODIFY `apply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employers`
--
ALTER TABLE `employers`
  MODIFY `company_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `portfolio_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vacancies`
--
ALTER TABLE `vacancies`
  MODIFY `jobpost_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
