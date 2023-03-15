-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2017 at 09:12 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci-lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `badges`
--

CREATE TABLE `badges` (
  `badge_id` int(11) NOT NULL,
  `badge_title` varchar(200) NOT NULL,
  `badge_image` varchar(255) NOT NULL,
  `badge_created_at` datetime NOT NULL,
  `badge_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `badges`
--

INSERT INTO `badges` (`badge_id`, `badge_title`, `badge_image`, `badge_created_at`, `badge_status`) VALUES
(6, 'abc122', 'Tulips1.jpg', '2017-11-10 09:09:17', 1),
(8, 'awesome', 'Penguins1.jpg', '2017-11-10 09:05:09', 1),
(10, 'testing', 'Tulips.jpg', '2017-11-10 09:08:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` bigint(20) NOT NULL,
  `category_title` varchar(255) DEFAULT NULL,
  `category_status` tinyint(1) DEFAULT '1',
  `category_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `category_user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`, `category_status`, `category_created_at`, `category_user_id`) VALUES
(1, 'Starter Lavel', 1, '2017-10-05 00:00:00', 1),
(5, 'Expert Lavel', 1, '2017-10-06 16:33:38', 1),
(6, 'Extended Lavel', 1, '2017-10-07 18:19:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories_has_courses`
--

CREATE TABLE `categories_has_courses` (
  `categories_category_id` bigint(20) NOT NULL,
  `courses_course_id` bigint(20) NOT NULL,
  `courses_course_user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories_has_courses`
--

INSERT INTO `categories_has_courses` (`categories_category_id`, `courses_course_id`, `courses_course_user_id`) VALUES
(1, 4, 1),
(1, 7, 1),
(5, 0, 1),
(5, 3, 1),
(5, 4, 1),
(5, 5, 1),
(5, 7, 1),
(6, 0, 1),
(6, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `chapter_id` int(11) NOT NULL,
  `chapter_title` varchar(255) NOT NULL,
  `chapter_sort_order` int(11) NOT NULL,
  `chapter_created_at` datetime NOT NULL,
  `chapter_status` tinyint(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`chapter_id`, `chapter_title`, `chapter_sort_order`, `chapter_created_at`, `chapter_status`) VALUES
(1, 'THE WORLD OF DEVELOPER', 1, '2017-10-31 10:52:34', 0),
(3, 'Test Chapter', 3, '2017-10-31 09:20:38', 0);

-- --------------------------------------------------------

--
-- Table structure for table `chapter_tools`
--

CREATE TABLE `chapter_tools` (
  `chapter_tool_id` bigint(20) NOT NULL,
  `chapter_tool_object` varchar(40) NOT NULL,
  `chapter_tool_object_id` int(11) NOT NULL,
  `chapter_tool_order` int(5) NOT NULL DEFAULT '1',
  `chapter_tool_course_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chapter_tools`
--

INSERT INTO `chapter_tools` (`chapter_tool_id`, `chapter_tool_object`, `chapter_tool_object_id`, `chapter_tool_order`, `chapter_tool_course_id`) VALUES
(33, 'lesson', 1, 1, 2),
(34, 'quiz', 1, 1, 2),
(35, 'quiz', 1, 1, 2),
(38, 'lesson', 1, 1, 3),
(39, 'lesson', 1, 1, 3),
(40, 'lesson', 1, 1, 3),
(41, 'lesson', 1, 1, 1),
(42, 'quiz', 2, 1, 1),
(43, 'lesson', 1, 1, 1),
(44, 'quiz', 1, 1, 1),
(45, 'lesson', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `class_name`) VALUES
(1, 'class-1'),
(2, 'class-2'),
(3, 'class-3'),
(4, 'class-4'),
(5, 'class-5'),
(6, 'class-6'),
(7, 'class-7'),
(8, 'class-8'),
(9, 'class-9'),
(10, 'class-10'),
(11, 'class-11'),
(12, 'class-12');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` bigint(20) NOT NULL,
  `course_title` varchar(255) DEFAULT NULL,
  `course_image` varchar(255) NOT NULL,
  `course_description` text,
  `course_start_date` datetime DEFAULT NULL,
  `course_end_date` datetime DEFAULT NULL,
  `course_all_time` tinyint(1) DEFAULT NULL,
  `course_price` decimal(10,2) DEFAULT NULL,
  `course_visibility` tinyint(1) DEFAULT '0' COMMENT '0:public,1:registered user,2:privileged user',
  `course_lessons` varchar(45) DEFAULT '0',
  `course_quizes` tinyint(1) DEFAULT '0',
  `course_files` tinyint(1) DEFAULT '0',
  `course_polls` tinyint(1) DEFAULT '0',
  `course_forums` tinyint(1) DEFAULT '0',
  `course_assignments` tinyint(1) DEFAULT '0',
  `course_status` tinyint(1) DEFAULT '1',
  `course_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `course_user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_title`, `course_image`, `course_description`, `course_start_date`, `course_end_date`, `course_all_time`, `course_price`, `course_visibility`, `course_lessons`, `course_quizes`, `course_files`, `course_polls`, `course_forums`, `course_assignments`, `course_status`, `course_created_at`, `course_user_id`) VALUES
(1, 'Core PHP 01', '14---111.png', 'The PHP development team announces the immediate availability of <b>PHP 7.1.10</b>. This is a bugfix release, with several bug fixes included. All <b>PHP 7.1</b> users are encouraged to upgrade to this version.  The PHP development team announces the immediate availability of <b>PHP 7.1.10</b>. This is a bugfix release, with several bug fixes included. All <b>PHP 7.1</b> users are encouraged to upgrade to this version. <br><br><br><br>', '2017-10-05 00:00:00', '2017-10-10 00:00:00', 1, '600.00', 2, '0', 0, 0, 0, 0, 0, 1, '2017-10-05 17:34:01', 2),
(2, 'Rest API', 'no-image-icon-111.PNG', '<p><b>Representational state transfer</b> (<b>REST</b>) or <b>RESTful</b> <a target=\"_blank\" rel=\"nofollow\" href=\"https://en.wikipedia.org/wiki/Web_service\">web services</a> is a way of providing interoperability between computer systems on the <a target=\"_blank\" rel=\"nofollow\" href=\"https://en.wikipedia.org/wiki/Internet\">Internet</a>. REST-compliant Web services allow requesting systems to access and manipulate textual representations of <a target=\"_blank\" rel=\"nofollow\" href=\"https://en.wikipedia.org/wiki/Web_resource\">Web resources</a> using a uniform and predefined set of <a target=\"_blank\" rel=\"nofollow\" href=\"https://en.wikipedia.org/wiki/Stateless_protocol\">stateless</a> operations. Other forms of Web services exist, which expose their own arbitrary sets of operations such as <a target=\"_blank\" rel=\"nofollow\" href=\"https://en.wikipedia.org/wiki/Web_Services_Description_Language\">WSDL</a><br></p>', '2017-10-20 00:00:00', '2017-10-25 00:00:00', 1, '1500.00', 0, '0', 0, 0, 0, 0, 0, 1, '2017-10-05 20:29:51', 1),
(3, 'Advanced PHP 01', 'wordpress-logo-simplified-rgb2.png', '<p>This section will be focusing on some <b>advanced PHP</b>\r\n topics, which will empower the reader to create dynamic web pages. \r\nSuperglobals. In the previous chapters the concept of global variable \r\nwas explained. A global variable is a variable declared at the top of \r\nthe script outside the function.</p><p>variable is a variable declared at the top of \r\nthe script outside the function.<br></p>', '2017-10-14 00:00:00', '2017-10-20 00:00:00', 1, '2000.00', 2, '0', 0, 0, 0, 0, 0, 1, '2017-10-09 18:06:00', 1),
(4, 'test course', 'emoji.jpg', '<p>No description<br></p>', '2017-10-20 00:00:00', '2017-10-30 00:00:00', 1, '1500.00', 0, '0', 0, 0, 0, 0, 0, 1, '2017-10-17 17:07:16', 1),
(5, 'kjsbjkdfbjksd', '3009-1498817271.jpg', '<p>adfsdaf</p>', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '500.00', 0, '0', 0, 0, 0, 0, 0, 1, '2017-10-28 16:23:31', 1),
(6, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '0.00', 0, '0', 0, 0, 0, 0, 0, 1, '2017-10-30 13:00:45', 1),
(7, 'asaas', '', '<p>&lt;option value=\"&lt;?php echo $value[\'category_id\'] ?&gt;\" Selected&gt;&lt;?php echo $value[\'category_title\'] ?&gt;&lt;/option&gt;<br></p>', '2017-11-21 00:00:00', '2017-11-22 00:00:00', 1, '200.00', 0, '0', 0, 0, 0, 0, 0, 1, '2017-11-06 14:11:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `course_tools`
--

CREATE TABLE `course_tools` (
  `course_tool_id` bigint(20) NOT NULL,
  `course_tool_object` varchar(45) DEFAULT NULL,
  `course_tool_object_id` int(11) DEFAULT NULL,
  `course_tool_order` int(5) DEFAULT '1',
  `course_tool_course_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_tools`
--

INSERT INTO `course_tools` (`course_tool_id`, `course_tool_object`, `course_tool_object_id`, `course_tool_order`, `course_tool_course_id`) VALUES
(1, 'quiz', 1, 1, 4),
(2, 'quiz', 2, 1, 4),
(3, 'chapter', 2, 1, 5),
(4, 'quiz', 4, 1, 5),
(5, 'lesson', 4, 1, 0),
(6, 'quiz', 1, 1, 0),
(7, 'lesson', 4, 1, 0),
(8, 'quiz', 1, 1, 0),
(9, 'quiz', 3, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `lesson_id` int(11) NOT NULL,
  `fk_chapter_id` int(11) NOT NULL,
  `lesson_title` varchar(255) NOT NULL,
  `lesson_description` longtext NOT NULL,
  `lesson_created_at` datetime NOT NULL,
  `lesson_sort_order` int(11) NOT NULL,
  `lesson_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`lesson_id`, `fk_chapter_id`, `lesson_title`, `lesson_description`, `lesson_created_at`, `lesson_sort_order`, `lesson_status`) VALUES
(1, 1, 'PHP DEVELOPER', '<p>\r\n\r\n<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n<br></p>', '2017-10-30 08:55:36', 1, 0),
(2, 1, 'ANDROID DEVELOPER', '<p>\r\n\r\n<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n<br></p>', '2017-10-30 08:55:46', 2, 0),
(23, 1, 'awes', '<p>\r\n\r\n\r\n</p><div>\r\n<div><div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\r\n typesetting industry. Lorem Ipsum has been the industry\'s standard \r\ndummy text ever since the 1500s, when an unknown printer took a galley \r\nof type and scrambled it to make a type specimen book. It has survived \r\nnot only five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.</p>\r\n</div><div>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the\r\n readable content of a page when looking at its layout. The point of \r\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \r\nletters, as opposed to using \'Content here, content here\', making it \r\nlook like readable English. Many desktop publishing packages and web \r\npage editors now use Lorem Ipsum as their default model text, and a \r\nsearch for \'lorem ipsum\' will uncover many web sites still in their \r\ninfancy. Various versions have evolved over the years, sometimes by \r\naccident, sometimes on purpose (injected humour and the like).</p>\r\n</div></div></div>\r\n\r\n<br><p></p>', '2017-11-06 07:22:35', 6, 0),
(24, 3, 'testine', '<p>\r\n</p><div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\r\n typesetting industry. Lorem Ipsum has been the industry\'s standard \r\ndummy text ever since the 1500s, when an unknown printer took a galley \r\nof type and scrambled it to make a type specimen book. It has survived \r\nnot only five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.</p>\r\n</div>\r\n\r\n<br><p></p>', '2017-11-10 08:23:04', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lesson_and_quiz`
--

CREATE TABLE `lesson_and_quiz` (
  `lesson_and_quiz_id` bigint(20) NOT NULL,
  `lesson_and_quiz_user_id` bigint(20) NOT NULL,
  `lesson_and_quiz_quiz_id` int(11) NOT NULL,
  `lesson_and_quiz_lesson_id` bigint(20) NOT NULL,
  `lesson_and_quiz_status` tinyint(1) DEFAULT '1',
  `lesson_and_quiz_created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lesson_and_quiz`
--

INSERT INTO `lesson_and_quiz` (`lesson_and_quiz_id`, `lesson_and_quiz_user_id`, `lesson_and_quiz_quiz_id`, `lesson_and_quiz_lesson_id`, `lesson_and_quiz_status`, `lesson_and_quiz_created_at`) VALUES
(11, 1, 29, 23, 1, '2017-11-06 07:22:16'),
(12, 1, 30, 24, 1, '2017-11-10 08:22:32');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `package_id` int(11) NOT NULL,
  `package_title` varchar(200) NOT NULL,
  `package_duration` int(11) NOT NULL,
  `package_price` varchar(255) NOT NULL,
  `package_created_at` datetime NOT NULL,
  `package_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`package_id`, `package_title`, `package_duration`, `package_price`, `package_created_at`, `package_status`) VALUES
(2, 'The Test Package', 3, '120', '2017-11-06 11:45:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `package_tools`
--

CREATE TABLE `package_tools` (
  `package_tool_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `package_category` varchar(200) DEFAULT NULL,
  `package_courses` varchar(200) DEFAULT NULL,
  `package_classes` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package_tools`
--

INSERT INTO `package_tools` (`package_tool_id`, `package_id`, `package_category`, `package_courses`, `package_classes`) VALUES
(101, 2, '1', NULL, NULL),
(102, 2, '5', NULL, NULL),
(103, 2, NULL, '2', NULL),
(104, 2, NULL, '3', NULL),
(105, 2, NULL, '5', NULL),
(106, 2, NULL, NULL, '2'),
(107, 2, NULL, NULL, '4'),
(108, 2, NULL, NULL, '6');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `quiz_id` int(11) NOT NULL,
  `quiz_title` varchar(255) DEFAULT NULL,
  `quiz_description` text,
  `quiz_duration` int(4) DEFAULT NULL,
  `quiz_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `quiz_status` tinyint(1) DEFAULT '1',
  `quiz_user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`quiz_id`, `quiz_title`, `quiz_description`, `quiz_duration`, `quiz_created_at`, `quiz_status`, `quiz_user_id`) VALUES
(1, 'Core PHP', 'f you are a beginner, core coding in PHP is a great place to start! This is mainly because, even frameworks require the basic knowledge of core PHP functions, classes and methods. However, websites and web applications built with frameworks can provide you with a very systematic method of coding.', 1, '2017-10-13 13:26:16', 0, 1),
(2, 'Advanced PHP', '<p>This section will be focusing on some <b>advanced PHP</b>\r\n topics, which will empower the reader to create dynamic web pages. \r\nSuperglobals. In the previous chapters the concept of global variable \r\nwas explained. A global variable is a variable declared at the top of \r\nthe script outside the function.<br></p>', NULL, '2017-10-14 13:23:44', 1, 1),
(3, 'Android', '<p>this is android&nbsp;?</p>', NULL, '2017-10-26 13:48:57', 1, 1),
(4, 'wordpress', '<p>ssss</p>', NULL, '2017-10-26 14:21:27', 1, 1),
(19, 'JAVA', '<p>\r\n\r\n<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n<br></p>', NULL, '2017-11-01 15:28:53', 1, 1),
(22, 'Testing Quiz', '<p>\r\n</p><div><p><strong>Lorem Ipsum</strong> is simply dummy text of the \r\nprinting and typesetting industry. Lorem Ipsum has been the industry\'s \r\nstandard dummy text ever since the 1500s, when an unknown printer took a\r\n galley of type and scrambled it to make a type specimen book. It has \r\nsurvived not only five centuries, but also the leap into electronic \r\ntypesetting, remaining essentially unchanged. It was popularised in the \r\n1960s with the release of Letraset sheets containing Lorem Ipsum \r\npassages, and more recently with desktop publishing software like Aldus \r\nPageMaker including versions of Lorem Ipsum.</p>\r\n</div><div>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the\r\n readable content of a page when looking at its layout. The point of \r\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \r\nletters, as opposed to using \'Content here, content here\', making it \r\nlook like readable English. Many desktop publishing packages and web \r\npage editors now use Lorem Ipsum as their default model text, and a \r\nsearch for \'lorem ipsum\' will uncover many web sites still in their \r\ninfancy. Various versions have evolved over the years, sometimes by \r\naccident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n\r\n<br><p></p>', NULL, '2017-11-06 11:20:28', 1, 1),
(29, 'asasw', '<p>\r\n\r\n\r\n</p><div>\r\n<div><div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\r\n typesetting industry. Lorem Ipsum has been the industry\'s standard \r\ndummy text ever since the 1500s, when an unknown printer took a galley \r\nof type and scrambled it to make a type specimen book. It has survived \r\nnot only five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.</p>\r\n</div><div>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the\r\n readable content of a page when looking at its layout. The point of \r\nusing Lorem Ipsum is that it has a more-or-less normal distribution of \r\nletters, as opposed to using \'Content here, content here\', making it \r\nlook like readable English. Many desktop publishing packages and web \r\npage editors now use Lorem Ipsum as their default model text, and a \r\nsearch for \'lorem ipsum\' will uncover many web sites still in their \r\ninfancy. Various versions have evolved over the years, sometimes by \r\naccident, sometimes on purpose (injected humour and the like).</p>\r\n</div></div></div>\r\n\r\n<br><p></p>', NULL, '2017-11-06 11:52:15', 1, 1),
(30, 'Testing Quiz', '<p>\r\n</p><div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\r\n typesetting industry. Lorem Ipsum has been the industry\'s standard \r\ndummy text ever since the 1500s, when an unknown printer took a galley \r\nof type and scrambled it to make a type specimen book. It has survived \r\nnot only five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.</p>\r\n</div>\r\n\r\n<br><p></p>', NULL, '2017-11-10 12:52:32', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `quiz_question_id` bigint(20) NOT NULL,
  `quiz_question_title` text,
  `quiz_question_type` varchar(45) DEFAULT NULL,
  `quiz_question_marks` int(4) DEFAULT NULL,
  `quiz_question_multiple_answers` tinyint(1) DEFAULT '0',
  `quiz_question_status` tinyint(1) DEFAULT '1',
  `quiz_question_quiz_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`quiz_question_id`, `quiz_question_title`, `quiz_question_type`, `quiz_question_marks`, `quiz_question_multiple_answers`, `quiz_question_status`, `quiz_question_quiz_id`) VALUES
(2, 'PHP', NULL, 2, 0, 1, 29),
(3, 'PHP', NULL, 2, 0, 1, 30),
(4, '', NULL, 0, 0, 1, 30);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_question_answers`
--

CREATE TABLE `quiz_question_answers` (
  `quiz_question_answer_id` bigint(20) NOT NULL,
  `quiz_question_answer_text` text NOT NULL,
  `quiz_question_answer_is_correct` tinyint(1) DEFAULT '0',
  `quiz_question_answer_status` tinyint(1) DEFAULT '1',
  `quiz_question_answer_question_id` bigint(20) NOT NULL,
  `quiz_question_answer_quiz_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_question_answers`
--

INSERT INTO `quiz_question_answers` (`quiz_question_answer_id`, `quiz_question_answer_text`, `quiz_question_answer_is_correct`, `quiz_question_answer_status`, `quiz_question_answer_question_id`, `quiz_question_answer_quiz_id`) VALUES
(5, 'as', 0, 1, 2, 29),
(6, 'assa', 1, 1, 2, 29),
(7, 'asa', 0, 1, 2, 29),
(8, 'asa', 0, 1, 2, 29),
(9, '1', 0, 1, 3, 30),
(10, '2', 1, 1, 3, 30),
(11, '3', 0, 1, 3, 30),
(12, '3', 0, 1, 3, 30),
(13, '', 1, 1, 4, 30),
(14, '', 0, 1, 4, 30),
(15, '', 0, 1, 4, 30),
(16, '', 0, 1, 4, 30);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(5) UNSIGNED NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_pword` varchar(255) NOT NULL,
  `user_first_name` varchar(150) NOT NULL,
  `user_last_name` varchar(150) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_auth_token` varchar(255) NOT NULL,
  `user_authorized` tinyint(1) NOT NULL DEFAULT '0',
  `user_status` tinyint(1) NOT NULL DEFAULT '1',
  `user_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_type` enum('admin','teacher','parent','student') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_pword`, `user_first_name`, `user_last_name`, `user_image`, `user_auth_token`, `user_authorized`, `user_status`, `user_created_at`, `user_type`) VALUES
(1, 'quartrback.dev@gmail.com', 'secret', 'Quartr', 'Back', 'wordpress-logo-simplified-rgb.png', '', 1, 1, '2017-10-04 18:12:48', ''),
(3, 'quartrback.vikas@gmail.com', 'secret', 'Vikas', 'Vishwakarma', '', '', 0, 0, '2017-10-07 15:44:03', 'parent'),
(4, 'quartrback.manish@gmail.com', 'secret', 'Manish', 'Tigga', 'pikachu2.jpg', '', 0, 1, '2017-10-07 15:47:08', 'parent');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`badge_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `categories_has_courses`
--
ALTER TABLE `categories_has_courses`
  ADD PRIMARY KEY (`categories_category_id`,`courses_course_id`,`courses_course_user_id`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`chapter_id`);

--
-- Indexes for table `chapter_tools`
--
ALTER TABLE `chapter_tools`
  ADD PRIMARY KEY (`chapter_tool_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `course_tools`
--
ALTER TABLE `course_tools`
  ADD PRIMARY KEY (`course_tool_id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`lesson_id`);

--
-- Indexes for table `lesson_and_quiz`
--
ALTER TABLE `lesson_and_quiz`
  ADD PRIMARY KEY (`lesson_and_quiz_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `package_tools`
--
ALTER TABLE `package_tools`
  ADD PRIMARY KEY (`package_tool_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`quiz_question_id`);

--
-- Indexes for table `quiz_question_answers`
--
ALTER TABLE `quiz_question_answers`
  ADD PRIMARY KEY (`quiz_question_answer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `badges`
--
ALTER TABLE `badges`
  MODIFY `badge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `chapter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `chapter_tools`
--
ALTER TABLE `chapter_tools`
  MODIFY `chapter_tool_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `course_tools`
--
ALTER TABLE `course_tools`
  MODIFY `course_tool_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `lesson_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `lesson_and_quiz`
--
ALTER TABLE `lesson_and_quiz`
  MODIFY `lesson_and_quiz_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `package_tools`
--
ALTER TABLE `package_tools`
  MODIFY `package_tool_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `quiz_question_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `quiz_question_answers`
--
ALTER TABLE `quiz_question_answers`
  MODIFY `quiz_question_answer_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
