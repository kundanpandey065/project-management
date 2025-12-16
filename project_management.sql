-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 16, 2025 at 04:48 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(255) NOT NULL COMMENT 'planned, ongoing, completed, on_hold',
  `visibility` varchar(255) NOT NULL COMMENT 'public, team',
  `created_by` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `title`, `description`, `start_date`, `end_date`, `status`, `visibility`, `created_by`, `created_at`, `updated_at`) VALUES
(10, 'Student Registration', '<p data-start=\"248\" data-end=\"609\" class=\"\">The Student Registration System is a web-based application designed to streamline the admission and enrollment process for educational institutions. This system enables students to register for courses, manage personal information, and view academic details with ease. Administrators can manage student records, assign courses, and generate reports efficiently.</p><h3 data-start=\"611\" data-end=\"632\" class=\"\"><strong data-start=\"615\" data-end=\"632\">Key Features:</strong></h3><p>\r\n\r\n</p><ul data-start=\"634\" data-end=\"1382\">\r\n<li data-start=\"634\" data-end=\"761\" class=\"\">\r\n<p data-start=\"636\" data-end=\"761\" class=\"\"><strong data-start=\"636\" data-end=\"661\">Student Registration:</strong> New students can fill out an online registration form with personal, academic, and contact details.</p>\r\n</li>\r\n<li data-start=\"762\" data-end=\"846\" class=\"\">\r\n<p data-start=\"764\" data-end=\"846\" class=\"\"><strong data-start=\"764\" data-end=\"781\">Login System:</strong> Secure login for both students and admin with role-based access.</p>\r\n</li>\r\n<li data-start=\"847\" data-end=\"960\" class=\"\">\r\n<p data-start=\"849\" data-end=\"960\" class=\"\"><strong data-start=\"849\" data-end=\"871\">Student Dashboard:</strong> Students can view/update their profile, track application status, and enroll in courses.</p>\r\n</li>\r\n<li data-start=\"961\" data-end=\"1075\" class=\"\">\r\n<p data-start=\"963\" data-end=\"1075\" class=\"\"><strong data-start=\"963\" data-end=\"979\">Admin Panel:</strong> Admins can manage student data, approve registrations, assign roll numbers, and manage courses.</p>\r\n</li>\r\n<li data-start=\"1076\" data-end=\"1175\" class=\"\">\r\n<p data-start=\"1078\" data-end=\"1175\" class=\"\"><strong data-start=\"1078\" data-end=\"1103\">Database Integration:</strong> Stores all information securely in a structured database (e.g., MySQL).</p>\r\n</li>\r\n<li data-start=\"1176\" data-end=\"1278\" class=\"\">\r\n<p data-start=\"1178\" data-end=\"1278\" class=\"\"><strong data-start=\"1178\" data-end=\"1210\">Validation &amp; Error Handling:</strong> Real-time form validation to ensure data accuracy and completeness.</p>\r\n</li>\r\n<li data-start=\"1279\" data-end=\"1382\" class=\"\">\r\n<p data-start=\"1281\" data-end=\"1382\" class=\"\"><strong data-start=\"1281\" data-end=\"1303\">Responsive Design:</strong> User-friendly interface compatible with desktops, tablets, and mobile devices.</p></li></ul>', '2025-04-01', '2025-04-30', 'ongoing', 'Team', 1, '2025-04-20 19:11:09', '2025-04-20 19:11:09'),
(11, 'Chairperson Dashboard for Student Registration', '<p>The Student Registration System is a web-based application designed to streamline the admission and enrollment process for educational institutions. This system enables students to register for courses, manage personal information, and view academic details with ease. Administrators can manage student records, assign courses, and generate reports efficiently.</p>', '2025-04-21', '2025-04-30', 'completed', 'Team', 1, '2025-04-20 20:23:32', '2025-04-20 20:23:32'),
(12, 'Chairperson Dashboard', '<h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px;\"><font color=\"#000000\" style=\"background-color: rgb(255, 255, 0);\">What is Lorem Ipsum?</font></h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\"><strong style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into<b><u> electronic typesetting,</u></b> remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2025-04-17', '2025-04-30', 'ongoing', 'Team', 1, '2025-04-22 15:52:42', '2025-04-22 15:52:42'),
(13, 'ERP', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</span></p>', '2025-04-23', '2025-11-23', 'planned', 'Public', 1, '2025-04-23 14:48:19', '2025-04-23 14:48:19');

-- --------------------------------------------------------

--
-- Table structure for table `project_attachments`
--

CREATE TABLE `project_attachments` (
  `id` int NOT NULL,
  `project_id` int NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `project_attachments`
--

INSERT INTO `project_attachments` (`id`, `project_id`, `file_name`, `created_at`) VALUES
(11, 10, '250420071109SRS-1.pdf', '2025-04-20 19:11:09'),
(12, 10, '250420071109SRS-2.pdf', '2025-04-20 19:11:09'),
(13, 10, '250420071109SRS-3.pdf', '2025-04-20 19:11:09'),
(14, 11, '250420082332SRS-1.pdf', '2025-04-20 20:23:32'),
(15, 11, '250420082332SRS-2.pdf', '2025-04-20 20:23:32'),
(16, 11, '250420082332SRS-3.pdf', '2025-04-20 20:23:32'),
(17, 12, '250422035242SRS-1.pdf', '2025-04-22 15:52:42'),
(18, 12, '250422035243SRS-2.pdf', '2025-04-22 15:52:42'),
(19, 12, '250422035243SRS-3.pdf', '2025-04-22 15:52:42'),
(20, 13, '250423024819SRS-1.pdf', '2025-04-23 14:48:19');

-- --------------------------------------------------------

--
-- Table structure for table `project_members`
--

CREATE TABLE `project_members` (
  `id` int NOT NULL,
  `project_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `project_members`
--

INSERT INTO `project_members` (`id`, `project_id`, `user_id`) VALUES
(25, 10, 4),
(26, 10, 3),
(27, 11, 4),
(28, 11, 3),
(29, 12, 6),
(30, 12, 5),
(31, 12, 4),
(32, 12, 3),
(33, 12, 2),
(34, 13, 5),
(35, 13, 4),
(36, 13, 3),
(37, 13, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int NOT NULL,
  `project_id` int NOT NULL,
  `title` varchar(855) NOT NULL,
  `description` text NOT NULL,
  `assigned_by` int NOT NULL,
  `priority` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'low, medium, high',
  `task_status_id` int NOT NULL,
  `start_date` date NOT NULL,
  `due_date` date NOT NULL,
  `weightage` int NOT NULL,
  `complete_percentage` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `project_id`, `title`, `description`, `assigned_by`, `priority`, `task_status_id`, `start_date`, `due_date`, `weightage`, `complete_percentage`, `created_at`, `updated_at`) VALUES
(10, 10, 'Basic Detail Form', 'The Student Registration System is a web-based application designed to streamline the admission and enrollment process for educational institutions. This system enables students to register for courses, manage personal information, and view academic details with ease. Administrators can manage student records, assign courses, and generate reports efficiently.', 1, 'medium', 1, '2025-04-04', '2025-04-07', 8, 100, '2025-04-20 19:12:43', '2025-04-20 19:12:43'),
(11, 10, 'Personal Detail', 'The Student Registration System is a web-based application designed to streamline the admission and enrollment process for educational institutions. This system enables students to register for courses, manage personal information, and view academic details with ease. Administrators can manage student records, assign courses, and generate reports efficiently.', 1, 'low', 2, '2025-04-17', '2025-04-20', 4, 80, '2025-04-20 19:14:11', '2025-04-20 19:14:11'),
(12, 10, 'Educational Detail', 'The Student Registration System is a web-based application designed to streamline the admission and enrollment process for educational institutions. This system enables students to register for courses, manage personal information, and view academic details with ease. Administrators can manage student records, assign courses, and generate reports efficiently.', 1, 'high', 3, '2025-04-15', '2025-04-30', 5, 60, '2025-04-20 20:08:58', '2025-04-20 20:08:58'),
(13, 10, 'Preview Detail', 'The Student Registration System is a web-based application designed to streamline the admission and enrollment process for educational institutions. This system enables students to register for courses, manage personal information, and view academic details with ease. Administrators can manage student records, assign courses, and generate reports efficiently.', 1, 'medium', 4, '2025-04-15', '2025-04-22', 2, 100, '2025-04-20 20:10:14', '2025-04-20 20:10:14'),
(14, 11, 'Show Student List in chairperson', 'The Student Registration System is a web-based application designed to streamline the admission and enrollment process for educational institutions. This system enables students to register for courses, manage personal information, and view academic details with ease. Administrators can manage student records, assign courses, and generate reports efficiently.', 1, 'medium', 1, '2025-04-02', '2025-04-17', 6, 40, '2025-04-20 20:26:12', '2025-04-20 20:26:12'),
(15, 12, 'Merit List', 'What is Lorem Ipsum?\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 'medium', 2, '2025-04-23', '2025-04-25', 8, 40, '2025-04-22 15:56:13', '2025-04-22 15:56:13'),
(16, 13, 'Task 1', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 1, 'medium', 1, '2025-04-23', '2025-04-25', 8, 0, '2025-04-23 14:52:55', '2025-04-23 14:52:55');

-- --------------------------------------------------------

--
-- Table structure for table `task_attachments`
--

CREATE TABLE `task_attachments` (
  `id` int NOT NULL,
  `task_id` int NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `task_attachments`
--

INSERT INTO `task_attachments` (`id`, `task_id`, `file_name`, `created_at`) VALUES
(13, 10, '250420071243SRS-1.pdf', '2025-04-20 19:12:43'),
(14, 10, '250420071243SRS-2.pdf', '2025-04-20 19:12:43'),
(15, 11, '250420071411SRS-1.pdf', '2025-04-20 19:14:11'),
(16, 12, '250420080858SRS-1.pdf', '2025-04-20 20:08:58'),
(17, 12, '250420080858SRS-2.pdf', '2025-04-20 20:08:58'),
(18, 13, '250420081014SRS-1.pdf', '2025-04-20 20:10:14'),
(19, 14, '250420082612SRS-1.pdf', '2025-04-20 20:26:12'),
(20, 14, '250420082612SRS-2.pdf', '2025-04-20 20:26:12'),
(21, 15, '250422035613SRS-3.pdf', '2025-04-22 15:56:13'),
(22, 16, '250423025255SRS-1.pdf', '2025-04-23 14:52:55');

-- --------------------------------------------------------

--
-- Table structure for table `task_comments`
--

CREATE TABLE `task_comments` (
  `id` int NOT NULL,
  `task_id` int NOT NULL,
  `user_id` int NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_members`
--

CREATE TABLE `task_members` (
  `id` int NOT NULL,
  `task_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `task_members`
--

INSERT INTO `task_members` (`id`, `task_id`, `user_id`) VALUES
(27, 10, 4),
(28, 11, 4),
(29, 12, 4),
(30, 13, 4),
(31, 14, 4),
(32, 15, 3),
(33, 16, 5);

-- --------------------------------------------------------

--
-- Table structure for table `task_status`
--

CREATE TABLE `task_status` (
  `id` int NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `task_status`
--

INSERT INTO `task_status` (`id`, `status_name`) VALUES
(1, 'To Do'),
(2, 'In Progress'),
(3, 'Done'),
(4, 'Blocked');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `img` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` int NOT NULL,
  `role_id` int NOT NULL,
  `designation_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `img`, `name`, `email`, `username`, `password`, `is_active`, `role_id`, `designation_id`, `created_at`, `updated_at`) VALUES
(1, 'usha-mam.png', 'Prof. Usha Batra', 'ushabatra@svsu.ac.in', 'ushabatra', 'MTIzNDU2', 1, 1, 1, '2025-04-16 04:03:07', '2025-04-16 04:03:07'),
(2, '250416102802sunil-sir.png', 'Sunil Fotedar', 'sunilfotedar@svsu.ac.in', 'sunilfotedar', 'MTIzNDU2', 1, 2, 2, '2025-04-16 10:28:02', '2025-04-16 10:28:02'),
(3, '250417043729krishna.png', 'Krishna Pratap Singh', 'sr_tech@svsu.sc.in', 'sr_tech', 'MTIzNDU2', 1, 2, 3, '2025-04-17 04:37:29', '2025-04-17 04:37:29'),
(4, '250417043810awkash.png', 'Awkash Shrivastava', 'jr_tech@svsu.ac.in', 'jr_tech', 'MTIzNDU2', 1, 2, 4, '2025-04-17 04:38:10', '2025-04-17 04:38:10'),
(5, '250417043908avinash.png', 'Avinash Karad', 'ba.erp@svsu.sc.in', 'ba.erp', 'MTIzNDU2', 1, 2, 6, '2025-04-17 04:39:08', '2025-04-17 04:39:08'),
(6, '250417043948kundan.png', 'Kundan', 'designer.erp@svsu.ac.in', 'designer.erp', 'MTIzNDU2', 1, 2, 5, '2025-04-17 04:39:48', '2025-04-17 04:39:48');

-- --------------------------------------------------------

--
-- Table structure for table `user_designation`
--

CREATE TABLE `user_designation` (
  `id` int NOT NULL,
  `designation_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_designation`
--

INSERT INTO `user_designation` (`id`, `designation_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2025-04-15 09:53:29', '2025-04-15 09:53:29'),
(2, 'PM', '2025-04-15 09:53:29', '2025-04-15 09:53:29'),
(3, 'Sr. Developer', '2025-04-15 09:55:07', '2025-04-15 09:55:07'),
(4, 'Jr. Developer', '2025-04-19 12:43:25', '2025-04-19 12:43:25'),
(5, 'UI Developer', '2025-04-19 12:43:25', '2025-04-19 12:43:25'),
(6, 'BA', '2025-04-19 12:43:25', '2025-04-19 12:43:25'),
(7, 'Web Designer', '2025-04-19 12:43:25', '2025-04-19 12:43:25');

-- --------------------------------------------------------

--
-- Table structure for table `user_permissions`
--

CREATE TABLE `user_permissions` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `data_add` int NOT NULL,
  `data_edit` int NOT NULL,
  `data_delete` int NOT NULL,
  `data_view` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int NOT NULL,
  `role_type` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role_type`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2025-04-15 09:53:29', '2025-04-15 09:53:29'),
(2, 'Employee', '2025-04-15 09:53:29', '2025-04-15 09:53:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_attachments`
--
ALTER TABLE `project_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_members`
--
ALTER TABLE `project_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_attachments`
--
ALTER TABLE `task_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_comments`
--
ALTER TABLE `task_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_members`
--
ALTER TABLE `task_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_status`
--
ALTER TABLE `task_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_designation`
--
ALTER TABLE `user_designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `project_attachments`
--
ALTER TABLE `project_attachments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `project_members`
--
ALTER TABLE `project_members`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `task_attachments`
--
ALTER TABLE `task_attachments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `task_comments`
--
ALTER TABLE `task_comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_members`
--
ALTER TABLE `task_members`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `task_status`
--
ALTER TABLE `task_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_designation`
--
ALTER TABLE `user_designation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
