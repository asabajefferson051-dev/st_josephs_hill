-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2026 at 10:25 AM
-- Server version: 10.11.16-MariaDB
-- PHP Version: 8.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `st_josephs_hill_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_calendar`
--

CREATE TABLE `academic_calendar` (
  `id` int(11) NOT NULL,
  `term_name` varchar(50) NOT NULL,
  `opening_date` varchar(80) NOT NULL,
  `closing_date` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_calendar`
--

INSERT INTO `academic_calendar` (`id`, `term_name`, `opening_date`, `closing_date`) VALUES
(1, 'Term I', 'February 2, 2026', 'May 1, 2026'),
(2, 'Term II', 'May 25, 2026', 'August 21, 2026'),
(3, 'Term III', 'September 14, 2026', 'December 4, 2026');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `student_name` varchar(150) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `previous_school` varchar(150) NOT NULL,
  `aggregates` varchar(50) NOT NULL,
  `applying_for_class` enum('S.1','S.2','S.3','S.5') NOT NULL,
  `parent_phone` varchar(20) NOT NULL,
  `status` enum('Pending','Admitted','Rejected') DEFAULT 'Pending',
  `submitted_at` timestamp NULL DEFAULT current_timestamp(),
  `student_photo` varchar(255) DEFAULT NULL,
  `academic_doc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` int(11) NOT NULL,
  `sender_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `attempt_time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news_posts`
--

CREATE TABLE `news_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `category` enum('Announcement','Term Dates','Events','Academics') DEFAULT 'Announcement',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_posts`
--

INSERT INTO `news_posts` (`id`, `title`, `content`, `category`, `created_at`, `author_id`) VALUES
(1, 'Term I 2026 Reporting Dates', 'All continuing students and S.1/S.5 entrants are expected to report on February 2nd, 2026 by 4:00 PM with full school requirements.', 'Announcement', '2026-11-16 10:00:29', 1),
(2, 'UNEB UCE & UACE 2025 Results Released', 'St. Joseph\'s Hill Secondary School celebrates a 98% pass rate in the recent UNEB examinations. Congratulations to our candidates and staff!', 'Academics', '2026-11-16 10:00:29', 1),
(3, 'Why St. Joseph\'s Hill Secondary School Leads in UNEB Competence-Based Education in Fort Portal', 'Choosing the right secondary school in Fort Portal and the wider Tooro region is one of the most important decisions a parent or guardian can make. At St. Joseph\'s Hill Secondary School, guided by our enduring motto \"Education is Light\", we combine strong Christian moral values with modern UNEB competence-based teaching methods to prepare learners for both national examinations and real-world leadership.\n\nOur Lower Secondary O-Level curriculum (S.1 to S.4) is fully aligned with the National Curriculum Development Centre (NCDC) and Uganda National Examinations Board (UNEB) standards. Rather than relying purely on memorization, our teachers guide students in their crisp white and grey uniforms through hands-on laboratory experiments in Physics, Chemistry, and Biology, practical agriculture projects, computer studies, and collaborative group research. This practical foundation ensures that every learner develops critical thinking, communication, and problem-solving skills from Senior One.\n\nFor students advancing to Advanced Level (S.5 to S.6) in our signature white and navy blue uniform, St. Joseph\'s Hill Secondary School offers specialized Science combinations (PCM, PCB, BCM, PEM, MEG) and Arts & Humanities combinations (HEG, HEL, DEG, HLD, LEG). Our well-stocked library, modern science laboratories, and evening prep supervision empower candidates to consistently achieve top principal passes in UACE and secure government and private admissions to leading universities across Uganda and East Africa.\n\nBeyond classroom academics, holistic formation remains at the heart of student life on the hill. Our boarding facilities provide separate, secure, and well-supervised dormitories for boys and girls, supported by dedicated wardens, matrons, a school sickbay, and nutritious meals. Students actively nurture their talents through basketball, football, netball, athletics, Debate Club, Scripture Union, Patriotism Corps, and Music, Dance, and Drama.\n\nAdmissions for Senior One and Senior Five are currently open for both day and boarding scholars. Parents and prospective students are invited to visit our campus in Fort Portal, download our admission guidelines, or submit an online application directly through our Admissions portal.', 'Academics', '2026-11-23 09:24:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `page_content`
--

CREATE TABLE `page_content` (
  `id` int(11) NOT NULL,
  `page_slug` varchar(50) NOT NULL,
  `section_key` varchar(80) NOT NULL,
  `section_label` varchar(120) NOT NULL,
  `content_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page_content`
--

INSERT INTO `page_content` (`id`, `page_slug`, `section_key`, `section_label`, `content_value`) VALUES
(1, 'global', 'school_motto', 'School Motto', 'Education is Light'),
(2, 'global', 'school_phone', 'Official Phone Numbers', '+256 746089764 / +256 777605238'),
(3, 'global', 'school_email', 'Official Email Address', 'info@stjosephshill.ac.ug'),
(4, 'global', 'school_address', 'School Location & Address', 'P.O. Box 124, Fort Portal Road, Uganda'),
(5, 'home', 'stat_pass_rate', 'Stat 1: UNEB Pass Rate', '86%'),
(6, 'home', 'stat_students', 'Stat 2: Enrolled Students', '522+'),
(7, 'home', 'stat_teachers', 'Stat 3: Qualified Teachers', '18+'),
(8, 'home', 'stat_years', 'Stat 4: Years of Excellence', '25'),
(9, 'home', 'ht_welcome_p1', 'Head Teacher Welcome (Paragraph 1)', 'It is my distinct honour and privilege to welcome you to St. Joseph\'s Hill Secondary School. Guided by our foundational motto, \"Education is Light\", our institution is dedicated to cultivating intellectual curiosity, unyielding moral integrity, and disciplined leadership in every learner entrusted to our care.'),
(10, 'home', 'ht_welcome_p2', 'Head Teacher Welcome (Paragraph 2)', 'In full alignment with the Uganda National Examinations Board (UNEB) competence-based curriculum, our dedicated faculty mentors both O-Level and A-Level scholars to excel academically while nurturing their spiritual and co-curricular talents. I invite parents, guardians, and prospective students to partner with us as we illuminate the path to a purposeful future.'),
(11, 'about', 'about_history', 'School History', 'Established on solid Christian values to expand access to quality secondary education in Western Uganda, St. Joseph\'s Hill Secondary School has grown into a premier mixed day and boarding institution. Over the past two decades, our alumni have distinguished themselves in medicine, engineering, law, education, and public service across East Africa.'),
(12, 'about', 'about_vision', 'School Vision', 'To be a centre of academic distinction and holistic formation that nurtures God-fearing, innovative, and globally competitive leaders.'),
(13, 'about', 'about_mission', 'School Mission', 'To provide quality competence-based instruction, sound moral guidance, and practical life skills in a disciplined environment for lifelong service.'),
(14, 'admissions', 'adm_s1_req', 'S.1 Entry Requirements', 'Applicants must present an original PLE Pass Slip with Aggregate 4 to 24, a recommendation letter from their former primary school head teacher, a birth certificate copy, and a recent passport photograph.'),
(15, 'admissions', 'adm_s5_req', 'S.5 Entry Requirements', 'Applicants must present an original UCE Result Slip with strong grades in their intended A-Level Science or Arts subject combination, plus a former school recommendation.'),
(16, 'admissions', 'fees_olevel_day', 'O-Level Day Fees (Per Term)', 'UGX 450,000'),
(17, 'admissions', 'fees_olevel_boarding', 'O-Level Boarding Fees (Per Term)', 'UGX 850,000'),
(18, 'admissions', 'fees_alevel_day', 'A-Level Day Fees (Per Term)', 'UGX 500,000'),
(19, 'admissions', 'fees_alevel_boarding', 'A-Level Boarding Fees (Per Term)', 'UGX 920,000');

-- --------------------------------------------------------

--
-- Table structure for table `uneb_results`
--

CREATE TABLE `uneb_results` (
  `id` int(11) NOT NULL,
  `exam_year` varchar(10) NOT NULL,
  `uce_pass_rate` varchar(30) NOT NULL,
  `uace_pass_rate` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uneb_results`
--

INSERT INTO `uneb_results` (`id`, `exam_year`, `uce_pass_rate`, `uace_pass_rate`) VALUES
(1, '2025', '98.4%', '96.2%'),
(2, '2024', '97.8%', '95.0%');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` varchar(30) DEFAULT 'staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `role`) VALUES
(1, 'sjh_headteacher', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Headteacher');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_calendar`
--
ALTER TABLE `academic_calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_posts`
--
ALTER TABLE `news_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `page_content`
--
ALTER TABLE `page_content`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `section_key` (`section_key`);

--
-- Indexes for table `uneb_results`
--
ALTER TABLE `uneb_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_calendar`
--
ALTER TABLE `academic_calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_posts`
--
ALTER TABLE `news_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `page_content`
--
ALTER TABLE `page_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `uneb_results`
--
ALTER TABLE `uneb_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `news_posts`
--
ALTER TABLE `news_posts`
  ADD CONSTRAINT `news_posts_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
