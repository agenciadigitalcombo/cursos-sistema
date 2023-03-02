-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 02-Mar-2023 às 18:21
-- Versão do servidor: 8.0.27
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `curso`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `addons`
--

DROP TABLE IF EXISTS `addons`;
CREATE TABLE IF NOT EXISTS `addons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `unique_identifier` varchar(255) NOT NULL,
  `version` varchar(255) DEFAULT NULL,
  `status` int NOT NULL,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  `about` longtext,
  `purchase_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `addons`
--

INSERT INTO `addons` (`id`, `name`, `unique_identifier`, `version`, `status`, `created_at`, `updated_at`, `about`, `purchase_code`) VALUES
(2, 'Course Bundle', 'course_bundle', '1.2', 1, 1016841600, NULL, 'Course Bundle allows you to sell multiple courses at once. You can sell the bundle on the subscription system.', '15fee8a4-4a7d-4446-a17c-805a9ab44ed3'),
(3, 'Certificate', 'certificate', '1.0', 1, 1016841600, NULL, 'This addon helps student to get certified. Academy provides a course completion certificate for each student after completing any course', '15fee8a4-4a7d-4446-a17c-805a9ab44ed3'),
(4, 'Course Analytics', 'course_analytics', '1.0', 1, 1016841600, NULL, 'You will be able to see the course progress for all enrolled students here. Which will help you understand the needs of your students. On the left side of the chart, you will see the range of the top number of students, and on the bottom of the chart, you will see the range of percentage. Also, you will able to see the table of the chart on the right side.', '15fee8a4-4a7d-4446-a17c-805a9ab44ed3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `applications`
--

DROP TABLE IF EXISTS `applications`;
CREATE TABLE IF NOT EXISTS `applications` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `address` longtext,
  `phone` varchar(255) DEFAULT NULL,
  `message` longtext,
  `document` varchar(255) DEFAULT NULL,
  `status` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE IF NOT EXISTS `blogs` (
  `blog_id` int NOT NULL AUTO_INCREMENT,
  `blog_category_id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keywords` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thumbnail` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `banner` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_popular` int NOT NULL,
  `likes` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `added_date` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`blog_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `blog_category`
--

DROP TABLE IF EXISTS `blog_category`;
CREATE TABLE IF NOT EXISTS `blog_category` (
  `blog_category_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `added_date` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`blog_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `blog_comments`
--

DROP TABLE IF EXISTS `blog_comments`;
CREATE TABLE IF NOT EXISTS `blog_comments` (
  `blog_comment_id` int NOT NULL AUTO_INCREMENT,
  `blog_id` int NOT NULL,
  `user_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `comment` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `likes` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `added_date` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`blog_comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bundle_payment`
--

DROP TABLE IF EXISTS `bundle_payment`;
CREATE TABLE IF NOT EXISTS `bundle_payment` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `bundle_creator_id` int DEFAULT NULL,
  `bundle_id` int DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `amount` int DEFAULT '0',
  `date_added` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bundle_rating`
--

DROP TABLE IF EXISTS `bundle_rating`;
CREATE TABLE IF NOT EXISTS `bundle_rating` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `bundle_id` int DEFAULT NULL,
  `comment` longtext,
  `rating` varchar(15) DEFAULT NULL,
  `date_added` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent` int DEFAULT '0',
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_added` int DEFAULT NULL,
  `last_modified` int DEFAULT NULL,
  `font_awesome_class` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `category`
--

INSERT INTO `category` (`id`, `code`, `name`, `parent`, `slug`, `date_added`, `last_modified`, `font_awesome_class`, `thumbnail`) VALUES
(1, 'b060bef66a', 'programação', 0, 'programação', 1677628800, NULL, 'fas fa-chess', 'category-thumbnail.png'),
(2, '592027f62e', 'php sub', 1, 'php-sub', 1677628800, NULL, 'fas fa-chess', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `certificates`
--

DROP TABLE IF EXISTS `certificates`;
CREATE TABLE IF NOT EXISTS `certificates` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` int DEFAULT NULL,
  `course_id` int DEFAULT NULL,
  `shareable_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('drj2oh8fhvep1nukmrgk2jttgrtj6hg6', '127.0.0.1', 1676177817, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637363137373830333b636f756e7443616c6c7c693a313b5f5f63695f766172737c613a313a7b733a393a22636f756e7443616c6c223b733a333a226e6577223b7d636172745f6974656d737c613a303a7b7d6c616e67756167657c733a373a22656e676c697368223b),
('cap5n9d65u1p43g5tragdsevku7it08a', '127.0.0.1', 1676177817, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637363137373830333b636f756e7443616c6c7c693a313b5f5f63695f766172737c613a313a7b733a393a22636f756e7443616c6c223b733a333a226f6c64223b7d636172745f6974656d737c613a303a7b7d6c616e67756167657c733a373a22656e676c697368223b),
('8p6jupm80ml7ei7r0b2hsfb37khjnjmc', '127.0.0.1', 1676177817, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637363137373830333b636f756e7443616c6c7c693a313b5f5f63695f766172737c613a313a7b733a393a22636f756e7443616c6c223b733a333a226e6577223b7d636172745f6974656d737c613a303a7b7d6c616e67756167657c733a373a22656e676c697368223b),
('pif2r39qnnqqe7g5mkur3s0tmt2hqnvd', '127.0.0.1', 1676177817, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637363137373830333b636f756e7443616c6c7c693a313b5f5f63695f766172737c613a313a7b733a393a22636f756e7443616c6c223b733a333a226e6577223b7d636172745f6974656d737c613a303a7b7d6c616e67756167657c733a373a22656e676c697368223b),
('1q3433jke6i00v97nctqohf57dke9pf7', '127.0.0.1', 1676177817, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637363137373830333b636f756e7443616c6c7c693a313b5f5f63695f766172737c613a313a7b733a393a22636f756e7443616c6c223b733a333a226e6577223b7d636172745f6974656d737c613a303a7b7d6c616e67756167657c733a373a22656e676c697368223b),
('jiagas1hb6dl7477a9eh00702vtp91su', '127.0.0.1', 1676177817, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637363137373830333b636f756e7443616c6c7c693a313b5f5f63695f766172737c613a313a7b733a393a22636f756e7443616c6c223b733a333a226e6577223b7d636172745f6974656d737c613a303a7b7d6c616e67756167657c733a373a22656e676c697368223b),
('21mnkrgla583s23fv7k6dbf6m28joane', '127.0.0.1', 1676177817, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637363137373830333b636f756e7443616c6c7c693a313b5f5f63695f766172737c613a313a7b733a393a22636f756e7443616c6c223b733a333a226e6577223b7d636172745f6974656d737c613a303a7b7d6c616e67756167657c733a373a22656e676c697368223b),
('dqvgia0avpak3edk7uqeum6hs0qa079r', '127.0.0.1', 1677692594, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637363137373831373b636172745f6974656d737c613a303a7b7d6c616e67756167657c733a373a22656e676c697368223b637573746f6d5f73657373696f6e5f6c696d69747c693a313637373133323430323b757365725f69647c733a313a2231223b726f6c655f69647c733a313a2231223b726f6c657c733a353a2241646d696e223b6e616d657c733a31333a224a6f686e20486f66666d616e6e223b69735f696e7374727563746f727c733a313a2231223b61646d696e5f6c6f67696e7c733a313a2231223b636f756e7443616c6c7c693a313b5f5f63695f766172737c613a313a7b733a393a22636f756e7443616c6c223b733a333a226f6c64223b7d),
('ndkkv4utq9r1855mbn2ij3ahrid7trq7', '::1', 1677781289, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637373639333432303b636172745f6974656d737c613a313a7b693a303b733a313a2231223b7d6c616e67756167657c733a373a22656e676c697368223b637573746f6d5f73657373696f6e5f6c696d69747c693a313637383634353132343b757365725f69647c733a313a2231223b726f6c655f69647c733a313a2231223b726f6c657c733a353a2241646d696e223b6e616d657c733a31333a224a6f686e20486f66666d616e6e223b69735f696e7374727563746f727c733a313a2231223b61646d696e5f6c6f67696e7c733a313a2231223b6c61796f75747c733a343a226c697374223b746f74616c5f70726963655f6f665f636865636b696e675f6f75747c643a3535303b75726c5f686973746f72797c733a33363a22687474703a2f2f637572736f2e746573742f686f6d652f73686f7070696e675f63617274223b636f756e7443616c6c7c693a313b5f5f63695f766172737c613a313a7b733a393a22636f756e7443616c6c223b733a333a226e6577223b7d),
('slk7hr6chdnlgnr2qvqiafeqhd5sje55', '::1', 1677697459, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637373639363238303b636172745f6974656d737c613a313a7b693a303b733a313a2231223b7d6c616e67756167657c733a373a22656e676c697368223b6c61796f75747c733a343a226c697374223b746f74616c5f70726963655f6f665f636865636b696e675f6f75747c643a3535303b75726c5f686973746f72797c733a33363a22687474703a2f2f637572736f2e746573742f686f6d652f73686f7070696e675f63617274223b637573746f6d5f73657373696f6e5f6c696d69747c693a313637383330313134313b757365725f69647c733a313a2232223b726f6c655f69647c733a313a2232223b726f6c657c733a343a2255736572223b6e616d657c733a31323a226272756e6f20766965697261223b69735f696e7374727563746f727c733a313a2230223b757365725f6c6f67696e7c733a313a2231223b7061796d656e745f64657461696c737c613a373a7b733a32303a22746f74616c5f70617961626c655f616d6f756e74223b643a3535303b733a353a226974656d73223b613a313a7b693a303b613a393a7b733a323a226964223b733a313a2231223b733a353a227469746c65223b733a333a22706870223b733a393a227468756d626e61696c223b733a39353a22687474703a2f2f637572736f2e746573742f75706c6f6164732f7468756d626e61696c732f636f757273655f7468756d626e61696c732f6f7074696d697a65642f636f757273655f7468756d626e61696c5f64656661756c745f312e6a7067223b733a31303a2263726561746f725f6964223b733a313a2231223b733a31333a22646973636f756e745f666c6167223b4e3b733a31363a22646973636f756e7465645f7072696365223b733a323a223130223b733a353a227072696365223b733a333a22353030223b733a31323a2261637475616c5f7072696365223b733a333a22353030223b733a393a227375625f6974656d73223b613a303a7b7d7d7d733a32383a2269735f696e7374727563746f725f7061796f75745f757365725f6964223b623a303b733a31333a227061796d656e745f7469746c65223b733a32353a2250617920666f722070757263686173696e6720636f75727365223b733a31313a22737563636573735f75726c223b733a34383a22687474703a2f2f637572736f2e746573742f7061796d656e742f737563636573735f636f757273655f7061796d656e74223b733a31303a2263616e63656c5f75726c223b733a32353a22687474703a2f2f637572736f2e746573742f7061796d656e74223b733a383a226261636b5f75726c223b733a33363a22687474703a2f2f637572736f2e746573742f686f6d652f73686f7070696e675f63617274223b7d70617961626c655f616d6f756e747c643a3535303b72617a6f727061795f6f726465725f69647c733a32303a226f726465725f4c4d4d676e483069424247767461223b636f756e7443616c6c7c693a313b5f5f63695f766172737c613a313a7b733a393a22636f756e7443616c6c223b733a333a226e6577223b7d),
('npnb2qram5ga6uqvta6jn4q2naq23fet', '::1', 1677699700, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637373639393639393b636f756e7443616c6c7c693a313b5f5f63695f766172737c613a313a7b733a393a22636f756e7443616c6c223b733a333a226e6577223b7d636172745f6974656d737c613a303a7b7d6c616e67756167657c733a373a22656e676c697368223b),
('mdh6s1pca4rj3lkkpckh6qhuabdsmh93', '::1', 1677699987, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637373639393639393b636172745f6974656d737c613a313a7b693a303b733a313a2231223b7d6c616e67756167657c733a373a22656e676c697368223b637573746f6d5f73657373696f6e5f6c696d69747c693a313637383330343538303b757365725f69647c733a313a2232223b726f6c655f69647c733a313a2232223b726f6c657c733a343a2255736572223b6e616d657c733a31323a226272756e6f20766965697261223b69735f696e7374727563746f727c733a313a2230223b757365725f6c6f67696e7c733a313a2231223b6c61796f75747c733a343a226c697374223b746f74616c5f70726963655f6f665f636865636b696e675f6f75747c643a3535303b7061796d656e745f64657461696c737c613a373a7b733a32303a22746f74616c5f70617961626c655f616d6f756e74223b643a3535303b733a353a226974656d73223b613a313a7b693a303b613a393a7b733a323a226964223b733a313a2231223b733a353a227469746c65223b733a333a22706870223b733a393a227468756d626e61696c223b733a39353a22687474703a2f2f637572736f2e746573742f75706c6f6164732f7468756d626e61696c732f636f757273655f7468756d626e61696c732f6f7074696d697a65642f636f757273655f7468756d626e61696c5f64656661756c745f312e6a7067223b733a31303a2263726561746f725f6964223b733a313a2231223b733a31333a22646973636f756e745f666c6167223b4e3b733a31363a22646973636f756e7465645f7072696365223b733a323a223130223b733a353a227072696365223b733a333a22353030223b733a31323a2261637475616c5f7072696365223b733a333a22353030223b733a393a227375625f6974656d73223b613a303a7b7d7d7d733a32383a2269735f696e7374727563746f725f7061796f75745f757365725f6964223b623a303b733a31333a227061796d656e745f7469746c65223b733a32353a2250617920666f722070757263686173696e6720636f75727365223b733a31313a22737563636573735f75726c223b733a34383a22687474703a2f2f637572736f2e746573742f7061796d656e742f737563636573735f636f757273655f7061796d656e74223b733a31303a2263616e63656c5f75726c223b733a32353a22687474703a2f2f637572736f2e746573742f7061796d656e74223b733a383a226261636b5f75726c223b733a33363a22687474703a2f2f637572736f2e746573742f686f6d652f73686f7070696e675f63617274223b7d70617961626c655f616d6f756e747c643a3535303b72617a6f727061795f6f726465725f69647c733a32303a226f726465725f4c4d4e653963337874736c754331223b636f756e7443616c6c7c693a313b5f5f63695f766172737c613a313a7b733a393a22636f756e7443616c6c223b733a333a226e6577223b7d);

-- --------------------------------------------------------

--
-- Estrutura da tabela `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `body` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `user_id` int DEFAULT NULL,
  `commentable_id` int DEFAULT NULL,
  `commentable_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_added` int DEFAULT NULL,
  `last_modified` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount_percentage` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int DEFAULT NULL,
  `expiry_date` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `outcomes` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `faqs` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `sub_category_id` int DEFAULT NULL,
  `section` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `requirements` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `price` double DEFAULT NULL,
  `discount_flag` int DEFAULT '0',
  `discounted_price` double DEFAULT NULL,
  `level` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `video_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_added` int DEFAULT NULL,
  `last_modified` int DEFAULT NULL,
  `course_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_top_course` int DEFAULT '0',
  `is_admin` int DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `course_overview_provider` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keywords` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `meta_description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `is_free_course` int DEFAULT NULL,
  `multi_instructor` int NOT NULL DEFAULT '0',
  `enable_drip_content` int NOT NULL,
  `creator` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `course`
--

INSERT INTO `course` (`id`, `title`, `short_description`, `description`, `outcomes`, `faqs`, `language`, `category_id`, `sub_category_id`, `section`, `requirements`, `price`, `discount_flag`, `discounted_price`, `level`, `user_id`, `thumbnail`, `video_url`, `date_added`, `last_modified`, `course_type`, `is_top_course`, `is_admin`, `status`, `course_overview_provider`, `meta_keywords`, `meta_description`, `is_free_course`, `multi_instructor`, `enable_drip_content`, `creator`) VALUES
(1, 'php', 'php', '<p>php</p>', '[]', '[]', 'english', 1, 2, '[]', '[]', 500, NULL, 10, 'beginner', '1', NULL, 'https://www.youtube.com/watch?v=O5DGE3oBLTs', 1677628800, NULL, 'general', NULL, 1, 'active', 'youtube', '', '', NULL, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `course_bundle`
--

DROP TABLE IF EXISTS `course_bundle`;
CREATE TABLE IF NOT EXISTS `course_bundle` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `course_ids` longtext,
  `subscription_limit` int DEFAULT NULL,
  `price` int DEFAULT '0',
  `bundle_details` longtext,
  `status` int DEFAULT '0',
  `date_added` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `currency`
--

DROP TABLE IF EXISTS `currency`;
CREATE TABLE IF NOT EXISTS `currency` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `symbol` varchar(255) DEFAULT NULL,
  `paypal_supported` int DEFAULT NULL,
  `stripe_supported` int DEFAULT NULL,
  `ccavenue_supported` int DEFAULT '0',
  `iyzico_supported` int DEFAULT '0',
  `paystack_supported` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `currency`
--

INSERT INTO `currency` (`id`, `name`, `code`, `symbol`, `paypal_supported`, `stripe_supported`, `ccavenue_supported`, `iyzico_supported`, `paystack_supported`) VALUES
(1, 'US Dollar', 'USD', '$', 1, 1, 0, 0, 0),
(2, 'Albanian Lek', 'ALL', 'Lek', 0, 1, 0, 0, 0),
(3, 'Algerian Dinar', 'DZD', 'دج', 1, 1, 0, 0, 0),
(4, 'Angolan Kwanza', 'AOA', 'Kz', 1, 1, 0, 0, 0),
(5, 'Argentine Peso', 'ARS', '$', 1, 1, 0, 0, 0),
(6, 'Armenian Dram', 'AMD', '֏', 1, 1, 0, 0, 0),
(7, 'Aruban Florin', 'AWG', 'ƒ', 1, 1, 0, 0, 0),
(8, 'Australian Dollar', 'AUD', '$', 1, 1, 0, 0, 0),
(9, 'Azerbaijani Manat', 'AZN', 'm', 1, 1, 0, 0, 0),
(10, 'Bahamian Dollar', 'BSD', 'B$', 1, 1, 0, 0, 0),
(11, 'Bahraini Dinar', 'BHD', '.د.ب', 1, 1, 0, 0, 0),
(12, 'Bangladeshi Taka', 'BDT', '৳', 1, 1, 0, 0, 0),
(13, 'Barbadian Dollar', 'BBD', 'Bds$', 1, 1, 0, 0, 0),
(14, 'Belarusian Ruble', 'BYR', 'Br', 0, 0, 0, 0, 0),
(15, 'Belgian Franc', 'BEF', 'fr', 1, 1, 0, 0, 0),
(16, 'Belize Dollar', 'BZD', '$', 1, 1, 0, 0, 0),
(17, 'Bermudan Dollar', 'BMD', '$', 1, 1, 0, 0, 0),
(18, 'Bhutanese Ngultrum', 'BTN', 'Nu.', 1, 1, 0, 0, 0),
(19, 'Bitcoin', 'BTC', '฿', 1, 1, 0, 0, 0),
(20, 'Bolivian Boliviano', 'BOB', 'Bs.', 1, 1, 0, 0, 0),
(21, 'Bosnia', 'BAM', 'KM', 1, 1, 0, 0, 0),
(22, 'Botswanan Pula', 'BWP', 'P', 1, 1, 0, 0, 0),
(23, 'Brazilian Real', 'BRL', 'R$', 1, 1, 0, 0, 0),
(24, 'British Pound Sterling', 'GBP', '£', 1, 1, 0, 0, 0),
(25, 'Brunei Dollar', 'BND', 'B$', 1, 1, 0, 0, 0),
(26, 'Bulgarian Lev', 'BGN', 'Лв.', 1, 1, 0, 0, 0),
(27, 'Burundian Franc', 'BIF', 'FBu', 1, 1, 0, 0, 0),
(28, 'Cambodian Riel', 'KHR', 'KHR', 1, 1, 0, 0, 0),
(29, 'Canadian Dollar', 'CAD', '$', 1, 1, 0, 0, 0),
(30, 'Cape Verdean Escudo', 'CVE', '$', 1, 1, 0, 0, 0),
(31, 'Cayman Islands Dollar', 'KYD', '$', 1, 1, 0, 0, 0),
(32, 'CFA Franc BCEAO', 'XOF', 'CFA', 1, 1, 0, 0, 0),
(33, 'CFA Franc BEAC', 'XAF', 'FCFA', 1, 1, 0, 0, 0),
(34, 'CFP Franc', 'XPF', '₣', 1, 1, 0, 0, 0),
(35, 'Chilean Peso', 'CLP', '$', 1, 1, 0, 0, 0),
(36, 'Chinese Yuan', 'CNY', '¥', 1, 1, 0, 0, 0),
(37, 'Colombian Peso', 'COP', '$', 1, 1, 0, 0, 0),
(38, 'Comorian Franc', 'KMF', 'CF', 1, 1, 0, 0, 0),
(39, 'Congolese Franc', 'CDF', 'FC', 1, 1, 0, 0, 0),
(40, 'Costa Rican ColÃ³n', 'CRC', '₡', 1, 1, 0, 0, 0),
(41, 'Croatian Kuna', 'HRK', 'kn', 1, 1, 0, 0, 0),
(42, 'Cuban Convertible Peso', 'CUC', '$, CUC', 1, 1, 0, 0, 0),
(43, 'Czech Republic Koruna', 'CZK', 'Kč', 1, 1, 0, 0, 0),
(44, 'Danish Krone', 'DKK', 'Kr.', 1, 1, 0, 0, 0),
(45, 'Djiboutian Franc', 'DJF', 'Fdj', 1, 1, 0, 0, 0),
(46, 'Dominican Peso', 'DOP', '$', 1, 1, 0, 0, 0),
(47, 'East Caribbean Dollar', 'XCD', '$', 1, 1, 0, 0, 0),
(48, 'Egyptian Pound', 'EGP', 'ج.م', 1, 1, 0, 0, 0),
(49, 'Eritrean Nakfa', 'ERN', 'Nfk', 1, 1, 0, 0, 0),
(50, 'Estonian Kroon', 'EEK', 'kr', 1, 1, 0, 0, 0),
(51, 'Ethiopian Birr', 'ETB', 'Nkf', 1, 1, 0, 0, 0),
(52, 'Euro', 'EUR', '€', 1, 1, 0, 0, 0),
(53, 'Falkland Islands Pound', 'FKP', '£', 1, 1, 0, 0, 0),
(54, 'Fijian Dollar', 'FJD', 'FJ$', 1, 1, 0, 0, 0),
(55, 'Gambian Dalasi', 'GMD', 'D', 1, 1, 0, 0, 0),
(56, 'Georgian Lari', 'GEL', 'ლ', 1, 1, 0, 0, 0),
(57, 'German Mark', 'DEM', 'DM', 1, 1, 0, 0, 0),
(58, 'Ghanaian Cedi', 'GHS', 'GH₵', 1, 1, 0, 0, 0),
(59, 'Gibraltar Pound', 'GIP', '£', 1, 1, 0, 0, 0),
(60, 'Greek Drachma', 'GRD', '₯, Δρχ, Δρ', 1, 1, 0, 0, 0),
(61, 'Guatemalan Quetzal', 'GTQ', 'Q', 1, 1, 0, 0, 0),
(62, 'Guinean Franc', 'GNF', 'FG', 1, 1, 0, 0, 0),
(63, 'Guyanaese Dollar', 'GYD', '$', 1, 1, 0, 0, 0),
(64, 'Haitian Gourde', 'HTG', 'G', 1, 1, 0, 0, 0),
(65, 'Honduran Lempira', 'HNL', 'L', 1, 1, 0, 0, 0),
(66, 'Hong Kong Dollar', 'HKD', '$', 1, 1, 0, 0, 0),
(67, 'Hungarian Forint', 'HUF', 'Ft', 1, 1, 0, 0, 0),
(68, 'Icelandic KrÃ³na', 'ISK', 'kr', 1, 1, 0, 0, 0),
(69, 'Indian Rupee', 'INR', '₹', 1, 1, 1, 0, 0),
(70, 'Indonesian Rupiah', 'IDR', 'Rp', 1, 1, 0, 0, 0),
(71, 'Iranian Rial', 'IRR', '﷼', 1, 1, 0, 0, 0),
(72, 'Iraqi Dinar', 'IQD', 'د.ع', 1, 1, 0, 0, 0),
(73, 'Israeli New Sheqel', 'ILS', '₪', 1, 1, 0, 0, 0),
(74, 'Italian Lira', 'ITL', 'L,£', 1, 1, 0, 0, 0),
(75, 'Jamaican Dollar', 'JMD', 'J$', 1, 1, 0, 0, 0),
(76, 'Japanese Yen', 'JPY', '¥', 1, 1, 0, 0, 0),
(77, 'Jordanian Dinar', 'JOD', 'ا.د', 1, 1, 0, 0, 0),
(78, 'Kazakhstani Tenge', 'KZT', 'лв', 1, 1, 0, 0, 0),
(79, 'Kenyan Shilling', 'KES', 'KSh', 1, 1, 0, 0, 0),
(80, 'Kuwaiti Dinar', 'KWD', 'ك.د', 1, 1, 0, 0, 0),
(81, 'Kyrgystani Som', 'KGS', 'лв', 1, 1, 0, 0, 0),
(82, 'Laotian Kip', 'LAK', '₭', 1, 1, 0, 0, 0),
(83, 'Latvian Lats', 'LVL', 'Ls', 0, 0, 0, 0, 0),
(84, 'Lebanese Pound', 'LBP', '£', 1, 1, 0, 0, 0),
(85, 'Lesotho Loti', 'LSL', 'L', 1, 1, 0, 0, 0),
(86, 'Liberian Dollar', 'LRD', '$', 1, 1, 0, 0, 0),
(87, 'Libyan Dinar', 'LYD', 'د.ل', 1, 1, 0, 0, 0),
(88, 'Lithuanian Litas', 'LTL', 'Lt', 0, 0, 0, 0, 0),
(89, 'Macanese Pataca', 'MOP', '$', 1, 1, 0, 0, 0),
(90, 'Macedonian Denar', 'MKD', 'ден', 1, 1, 0, 0, 0),
(91, 'Malagasy Ariary', 'MGA', 'Ar', 1, 1, 0, 0, 0),
(92, 'Malawian Kwacha', 'MWK', 'MK', 1, 1, 0, 0, 0),
(93, 'Malaysian Ringgit', 'MYR', 'RM', 1, 1, 0, 0, 0),
(94, 'Maldivian Rufiyaa', 'MVR', 'Rf', 1, 1, 0, 0, 0),
(95, 'Mauritanian Ouguiya', 'MRO', 'MRU', 1, 1, 0, 0, 0),
(96, 'Mauritian Rupee', 'MUR', '₨', 1, 1, 0, 0, 0),
(97, 'Mexican Peso', 'MXN', '$', 1, 1, 0, 0, 0),
(98, 'Moldovan Leu', 'MDL', 'L', 1, 1, 0, 0, 0),
(99, 'Mongolian Tugrik', 'MNT', '₮', 1, 1, 0, 0, 0),
(100, 'Moroccan Dirham', 'MAD', 'MAD', 1, 1, 0, 0, 0),
(101, 'Mozambican Metical', 'MZM', 'MT', 1, 1, 0, 0, 0),
(102, 'Myanmar Kyat', 'MMK', 'K', 1, 1, 0, 0, 0),
(103, 'Namibian Dollar', 'NAD', '$', 1, 1, 0, 0, 0),
(104, 'Nepalese Rupee', 'NPR', '₨', 1, 1, 0, 0, 0),
(105, 'Netherlands Antillean Guilder', 'ANG', 'ƒ', 1, 1, 0, 0, 0),
(106, 'New Taiwan Dollar', 'TWD', '$', 1, 1, 0, 0, 0),
(107, 'New Zealand Dollar', 'NZD', '$', 1, 1, 0, 0, 0),
(108, 'Nicaraguan CÃ³rdoba', 'NIO', 'C$', 1, 1, 0, 0, 0),
(109, 'Nigerian Naira', 'NGN', '₦', 1, 1, 0, 0, 1),
(110, 'North Korean Won', 'KPW', '₩', 0, 0, 0, 0, 0),
(111, 'Norwegian Krone', 'NOK', 'kr', 1, 1, 0, 0, 0),
(112, 'Omani Rial', 'OMR', '.ع.ر', 0, 0, 0, 0, 0),
(113, 'Pakistani Rupee', 'PKR', '₨', 1, 1, 0, 0, 0),
(114, 'Panamanian Balboa', 'PAB', 'B/.', 1, 1, 0, 0, 0),
(115, 'Papua New Guinean Kina', 'PGK', 'K', 1, 1, 0, 0, 0),
(116, 'Paraguayan Guarani', 'PYG', '₲', 1, 1, 0, 0, 0),
(117, 'Peruvian Nuevo Sol', 'PEN', 'S/.', 1, 1, 0, 0, 0),
(118, 'Philippine Peso', 'PHP', '₱', 1, 1, 0, 0, 0),
(119, 'Polish Zloty', 'PLN', 'zł', 1, 1, 0, 0, 0),
(120, 'Qatari Rial', 'QAR', 'ق.ر', 1, 1, 0, 0, 0),
(121, 'Romanian Leu', 'RON', 'lei', 1, 1, 0, 0, 0),
(122, 'Russian Ruble', 'RUB', '₽', 1, 1, 0, 0, 0),
(123, 'Rwandan Franc', 'RWF', 'FRw', 1, 1, 0, 0, 0),
(124, 'Salvadoran ColÃ³n', 'SVC', '₡', 0, 0, 0, 0, 0),
(125, 'Samoan Tala', 'WST', 'SAT', 1, 1, 0, 0, 0),
(126, 'Saudi Riyal', 'SAR', '﷼', 1, 1, 0, 0, 0),
(127, 'Serbian Dinar', 'RSD', 'din', 1, 1, 0, 0, 0),
(128, 'Seychellois Rupee', 'SCR', 'SRe', 1, 1, 0, 0, 0),
(129, 'Sierra Leonean Leone', 'SLL', 'Le', 1, 1, 0, 0, 0),
(130, 'Singapore Dollar', 'SGD', '$', 1, 1, 0, 0, 0),
(131, 'Slovak Koruna', 'SKK', 'Sk', 1, 1, 0, 0, 0),
(132, 'Solomon Islands Dollar', 'SBD', 'Si$', 1, 1, 0, 0, 0),
(133, 'Somali Shilling', 'SOS', 'Sh.so.', 1, 1, 0, 0, 0),
(134, 'South African Rand', 'ZAR', 'R', 1, 1, 0, 0, 0),
(135, 'South Korean Won', 'KRW', '₩', 1, 1, 0, 0, 0),
(136, 'Special Drawing Rights', 'XDR', 'SDR', 1, 1, 0, 0, 0),
(137, 'Sri Lankan Rupee', 'LKR', 'Rs', 1, 1, 0, 0, 0),
(138, 'St. Helena Pound', 'SHP', '£', 1, 1, 0, 0, 0),
(139, 'Sudanese Pound', 'SDG', '.س.ج', 1, 1, 0, 0, 0),
(140, 'Surinamese Dollar', 'SRD', '$', 1, 1, 0, 0, 0),
(141, 'Swazi Lilangeni', 'SZL', 'E', 1, 1, 0, 0, 0),
(142, 'Swedish Krona', 'SEK', 'kr', 1, 1, 0, 0, 0),
(143, 'Swiss Franc', 'CHF', 'CHf', 1, 1, 0, 0, 0),
(144, 'Syrian Pound', 'SYP', 'LS', 0, 0, 0, 0, 0),
(145, 'São Tomé and Príncipe Dobra', 'STD', 'Db', 1, 1, 0, 0, 0),
(146, 'Tajikistani Somoni', 'TJS', 'SM', 1, 1, 0, 0, 0),
(147, 'Tanzanian Shilling', 'TZS', 'TSh', 1, 1, 0, 0, 0),
(148, 'Thai Baht', 'THB', '฿', 1, 1, 0, 0, 0),
(149, 'Tongan pa\'anga', 'TOP', '$', 1, 1, 0, 0, 0),
(150, 'Trinidad & Tobago Dollar', 'TTD', '$', 1, 1, 0, 0, 0),
(151, 'Tunisian Dinar', 'TND', 'ت.د', 1, 1, 0, 0, 0),
(152, 'Turkish Lira', 'TRY', '₺', 1, 1, 0, 1, 0),
(153, 'Turkmenistani Manat', 'TMT', 'T', 1, 1, 0, 0, 0),
(154, 'Ugandan Shilling', 'UGX', 'USh', 1, 1, 0, 0, 0),
(155, 'Ukrainian Hryvnia', 'UAH', '₴', 1, 1, 0, 0, 0),
(156, 'United Arab Emirates Dirham', 'AED', 'إ.د', 1, 1, 0, 0, 0),
(157, 'Uruguayan Peso', 'UYU', '$', 1, 1, 0, 0, 0),
(158, 'Afghan Afghani', 'AFA', '؋', 1, 1, 0, 0, 0),
(159, 'Uzbekistan Som', 'UZS', 'лв', 1, 1, 0, 0, 0),
(160, 'Vanuatu Vatu', 'VUV', 'VT', 1, 1, 0, 0, 0),
(161, 'Venezuelan BolÃvar', 'VEF', 'Bs', 0, 0, 0, 0, 0),
(162, 'Vietnamese Dong', 'VND', '₫', 1, 1, 0, 0, 0),
(163, 'Yemeni Rial', 'YER', '﷼', 1, 1, 0, 0, 0),
(164, 'Zambian Kwacha', 'ZMK', 'ZK', 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `custom_page`
--

DROP TABLE IF EXISTS `custom_page`;
CREATE TABLE IF NOT EXISTS `custom_page` (
  `custom_page_id` int NOT NULL AUTO_INCREMENT,
  `page_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `page_content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `page_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `button_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `button_position` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`custom_page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `enrol`
--

DROP TABLE IF EXISTS `enrol`;
CREATE TABLE IF NOT EXISTS `enrol` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `course_id` int DEFAULT NULL,
  `date_added` int DEFAULT NULL,
  `last_modified` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `frontend_settings`
--

DROP TABLE IF EXISTS `frontend_settings`;
CREATE TABLE IF NOT EXISTS `frontend_settings` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `frontend_settings`
--

INSERT INTO `frontend_settings` (`id`, `key`, `value`) VALUES
(1, 'banner_title', 'Start learning from best Platform'),
(2, 'banner_sub_title', 'Study any topic, anytime. Explore thousands of courses for the lowest price ever!'),
(4, 'about_us', '<p></p><h2><span xss=removed>This is about us</span></h2><p><span xss=\"removed\">Welcome to Academy. It will help you to learn in a new ways</span></p>'),
(10, 'terms_and_condition', '<h2>Terms and Condition</h2>This is the Terms and condition page for your companys'),
(11, 'privacy_policy', '<p></p><p></p><h2><span xss=\"removed\">Privacy Policy</span><br></h2>This is the Privacy Policy page for your companys<p></p><p><b>This is another</b> <u><a href=\"https://youtube.com/watch?v=PHgc8Q6qTjc\" target=\"_blank\">thing you will</a></u> <span xss=\"removed\">not understand</span>.</p>'),
(13, 'theme', 'default'),
(14, 'cookie_note', 'This website uses cookies to personalize content and analyse traffic in order to offer you a better experience.'),
(15, 'cookie_status', 'active'),
(16, 'cookie_policy', '<h1>Cookie policy</h1><ol><li>Cookies are small text files that can be used by websites to make a user\'s experience more efficient.</li><li>The law states that we can store cookies on your device if they are strictly necessary for the operation of this site. For all other types of cookies we need your permission.</li><li>This site uses different types of cookies. Some cookies are placed by third party services that appear on our pages.</li></ol>'),
(17, 'banner_image', 'home-banner.jpg'),
(18, 'light_logo', 'logo-light.png'),
(19, 'dark_logo', 'logo-dark.png'),
(20, 'small_logo', 'logo-light-sm.png'),
(21, 'favicon', 'favicon.png'),
(22, 'recaptcha_status', '0'),
(23, 'recaptcha_secretkey', 'Valid-secret-key'),
(24, 'recaptcha_sitekey', 'Valid-site-key'),
(25, 'refund_policy', '<h2><span xss=\"removed\">Refund Policy</span></h2>'),
(26, 'facebook', 'https://facebook.com'),
(27, 'twitter', 'https://twitter.com'),
(28, 'linkedin', ''),
(31, 'blog_page_title', 'Where possibilities begin'),
(32, 'blog_page_subtitle', 'We’re a leading marketplace platform for learning and teaching online. Explore some of our most popular content and learn something new.'),
(33, 'blog_page_banner', 'blog-page.png'),
(34, 'instructors_blog_permission', '0'),
(35, 'blog_visibility_on_the_home_page', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `phrase_id` int NOT NULL AUTO_INCREMENT,
  `phrase` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `english` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`phrase_id`)
) ENGINE=MyISAM AUTO_INCREMENT=744 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `language`
--

INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES
(1, 'english', 'English'),
(2, '404_page_not_found', '404 page not found'),
(3, '404_page_not_found', '404 page not found'),
(4, '404_page_not_found', '404 page not found'),
(5, '404_page_not_found', '404 page not found'),
(6, '404_page_not_found', '404 page not found'),
(7, '404_page_not_found', '404 page not found'),
(8, 'categories', 'Categories'),
(9, 'categories', 'Categories'),
(10, 'categories', 'Categories'),
(11, 'categories', 'Categories'),
(12, 'categories', 'Categories'),
(13, 'categories', 'Categories'),
(14, 'categories', 'Categories'),
(15, 'menu', 'Menu'),
(16, 'menu', 'Menu'),
(17, 'menu', 'Menu'),
(18, 'menu', 'Menu'),
(19, 'menu', 'Menu'),
(20, 'menu', 'Menu'),
(21, 'menu', 'Menu'),
(22, 'all_courses', 'All courses'),
(23, 'all_courses', 'All courses'),
(24, 'all_courses', 'All courses'),
(25, 'all_courses', 'All courses'),
(26, 'all_courses', 'All courses'),
(27, 'all_courses', 'All courses'),
(28, 'all_courses', 'All courses'),
(29, 'search_for_courses', 'Search for courses'),
(30, 'search_for_courses', 'Search for courses'),
(31, 'search_for_courses', 'Search for courses'),
(32, 'search_for_courses', 'Search for courses'),
(33, 'search_for_courses', 'Search for courses'),
(34, 'search_for_courses', 'Search for courses'),
(35, 'search_for_courses', 'Search for courses'),
(36, 'total', 'Total'),
(37, 'total', 'Total'),
(38, 'total', 'Total'),
(39, 'total', 'Total'),
(40, 'total', 'Total'),
(41, 'total', 'Total'),
(42, 'total', 'Total'),
(43, 'go_to_cart', 'Go to cart'),
(44, 'go_to_cart', 'Go to cart'),
(45, 'go_to_cart', 'Go to cart'),
(46, 'go_to_cart', 'Go to cart'),
(47, 'go_to_cart', 'Go to cart'),
(48, 'go_to_cart', 'Go to cart'),
(49, 'go_to_cart', 'Go to cart'),
(50, 'your_cart_is_empty', 'Your cart is empty'),
(51, 'your_cart_is_empty', 'Your cart is empty'),
(52, 'your_cart_is_empty', 'Your cart is empty'),
(53, 'your_cart_is_empty', 'Your cart is empty'),
(54, 'your_cart_is_empty', 'Your cart is empty'),
(55, 'your_cart_is_empty', 'Your cart is empty'),
(56, 'your_cart_is_empty', 'Your cart is empty'),
(57, 'log_in', 'Log in'),
(58, 'log_in', 'Log in'),
(59, 'log_in', 'Log in'),
(60, 'log_in', 'Log in'),
(61, 'log_in', 'Log in'),
(62, 'log_in', 'Log in'),
(63, 'log_in', 'Log in'),
(64, 'sign_up', 'Sign up'),
(65, 'sign_up', 'Sign up'),
(66, 'sign_up', 'Sign up'),
(67, 'sign_up', 'Sign up'),
(68, 'sign_up', 'Sign up'),
(69, 'sign_up', 'Sign up'),
(70, 'sign_up', 'Sign up'),
(71, 'cookie_policy', 'Cookie policy'),
(72, 'cookie_policy', 'Cookie policy'),
(73, 'cookie_policy', 'Cookie policy'),
(74, 'cookie_policy', 'Cookie policy'),
(75, 'cookie_policy', 'Cookie policy'),
(76, 'cookie_policy', 'Cookie policy'),
(77, 'cookie_policy', 'Cookie policy'),
(78, 'accept', 'Accept'),
(79, 'accept', 'Accept'),
(80, 'accept', 'Accept'),
(81, 'accept', 'Accept'),
(82, 'accept', 'Accept'),
(83, 'accept', 'Accept'),
(84, 'accept', 'Accept'),
(85, 'oh_snap', 'Oh snap'),
(86, 'oh_snap', 'Oh snap'),
(87, 'oh_snap', 'Oh snap'),
(88, 'oh_snap', 'Oh snap'),
(89, 'oh_snap', 'Oh snap'),
(90, 'oh_snap', 'Oh snap'),
(91, 'oh_snap', 'Oh snap'),
(92, 'this_is_not_the_web_page_you_are_looking_for', 'This is not the web page you are looking for'),
(93, 'this_is_not_the_web_page_you_are_looking_for', 'This is not the web page you are looking for'),
(94, 'this_is_not_the_web_page_you_are_looking_for', 'This is not the web page you are looking for'),
(95, 'this_is_not_the_web_page_you_are_looking_for', 'This is not the web page you are looking for'),
(96, 'this_is_not_the_web_page_you_are_looking_for', 'This is not the web page you are looking for'),
(97, 'this_is_not_the_web_page_you_are_looking_for', 'This is not the web page you are looking for'),
(98, 'this_is_not_the_web_page_you_are_looking_for', 'This is not the web page you are looking for'),
(99, 'back_to_home', 'Back to home'),
(100, 'back_to_home', 'Back to home'),
(101, 'back_to_home', 'Back to home'),
(102, 'back_to_home', 'Back to home'),
(103, 'back_to_home', 'Back to home'),
(104, 'back_to_home', 'Back to home'),
(105, 'back_to_home', 'Back to home'),
(106, 'top_categories', 'Top categories'),
(107, 'top_categories', 'Top categories'),
(108, 'top_categories', 'Top categories'),
(109, 'top_categories', 'Top categories'),
(110, 'top_categories', 'Top categories'),
(111, 'top_categories', 'Top categories'),
(112, 'top_categories', 'Top categories'),
(113, 'useful_links', 'Useful links'),
(114, 'useful_links', 'Useful links'),
(115, 'useful_links', 'Useful links'),
(116, 'useful_links', 'Useful links'),
(117, 'useful_links', 'Useful links'),
(118, 'useful_links', 'Useful links'),
(119, 'useful_links', 'Useful links'),
(120, 'blog', 'Blog'),
(121, 'blog', 'Blog'),
(122, 'blog', 'Blog'),
(123, 'blog', 'Blog'),
(124, 'blog', 'Blog'),
(125, 'blog', 'Blog'),
(126, 'blog', 'Blog'),
(127, 'help', 'Help'),
(128, 'help', 'Help'),
(129, 'help', 'Help'),
(130, 'help', 'Help'),
(131, 'help', 'Help'),
(132, 'help', 'Help'),
(133, 'help', 'Help'),
(134, 'about_us', 'About us'),
(135, 'about_us', 'About us'),
(136, 'about_us', 'About us'),
(137, 'about_us', 'About us'),
(138, 'about_us', 'About us'),
(139, 'about_us', 'About us'),
(140, 'about_us', 'About us'),
(141, 'privacy_policy', 'Privacy policy'),
(142, 'privacy_policy', 'Privacy policy'),
(143, 'privacy_policy', 'Privacy policy'),
(144, 'privacy_policy', 'Privacy policy'),
(145, 'privacy_policy', 'Privacy policy'),
(146, 'privacy_policy', 'Privacy policy'),
(147, 'privacy_policy', 'Privacy policy'),
(148, 'terms_and_condition', 'Terms and condition'),
(149, 'terms_and_condition', 'Terms and condition'),
(150, 'terms_and_condition', 'Terms and condition'),
(151, 'terms_and_condition', 'Terms and condition'),
(152, 'terms_and_condition', 'Terms and condition'),
(153, 'terms_and_condition', 'Terms and condition'),
(154, 'terms_and_condition', 'Terms and condition'),
(155, 'refund_policy', 'Refund policy'),
(156, 'refund_policy', 'Refund policy'),
(157, 'refund_policy', 'Refund policy'),
(158, 'refund_policy', 'Refund policy'),
(159, 'refund_policy', 'Refund policy'),
(160, 'refund_policy', 'Refund policy'),
(161, 'refund_policy', 'Refund policy'),
(162, 'all_rights_reserved', 'All rights reserved'),
(163, 'all_rights_reserved', 'All rights reserved'),
(164, 'all_rights_reserved', 'All rights reserved'),
(165, 'all_rights_reserved', 'All rights reserved'),
(166, 'all_rights_reserved', 'All rights reserved'),
(167, 'all_rights_reserved', 'All rights reserved'),
(168, 'all_rights_reserved', 'All rights reserved'),
(169, 'step', 'Step'),
(170, 'step', 'Step'),
(171, 'step', 'Step'),
(172, 'step', 'Step'),
(173, 'step', 'Step'),
(174, 'step', 'Step'),
(175, 'step', 'Step'),
(176, 'how_would_you_rate_this_course_overall', 'How would you rate this course overall'),
(177, 'how_would_you_rate_this_course_overall', 'How would you rate this course overall'),
(178, 'how_would_you_rate_this_course_overall', 'How would you rate this course overall'),
(179, 'how_would_you_rate_this_course_overall', 'How would you rate this course overall'),
(180, 'how_would_you_rate_this_course_overall', 'How would you rate this course overall'),
(181, 'how_would_you_rate_this_course_overall', 'How would you rate this course overall'),
(182, 'how_would_you_rate_this_course_overall', 'How would you rate this course overall'),
(183, 'write_a_public_review', 'Write a public review'),
(184, 'write_a_public_review', 'Write a public review'),
(185, 'write_a_public_review', 'Write a public review'),
(186, 'write_a_public_review', 'Write a public review'),
(187, 'write_a_public_review', 'Write a public review'),
(188, 'write_a_public_review', 'Write a public review'),
(189, 'write_a_public_review', 'Write a public review'),
(190, 'describe_your_experience_what_you_got_out_of_the_course_and_other_helpful_highlights', 'Describe your experience what you got out of the course and other helpful highlights'),
(191, 'describe_your_experience_what_you_got_out_of_the_course_and_other_helpful_highlights', 'Describe your experience what you got out of the course and other helpful highlights'),
(192, 'describe_your_experience_what_you_got_out_of_the_course_and_other_helpful_highlights', 'Describe your experience what you got out of the course and other helpful highlights'),
(193, 'describe_your_experience_what_you_got_out_of_the_course_and_other_helpful_highlights', 'Describe your experience what you got out of the course and other helpful highlights'),
(194, 'describe_your_experience_what_you_got_out_of_the_course_and_other_helpful_highlights', 'Describe your experience what you got out of the course and other helpful highlights'),
(195, 'describe_your_experience_what_you_got_out_of_the_course_and_other_helpful_highlights', 'Describe your experience what you got out of the course and other helpful highlights'),
(196, 'describe_your_experience_what_you_got_out_of_the_course_and_other_helpful_highlights', 'Describe your experience what you got out of the course and other helpful highlights'),
(197, 'what_did_the_instructor_do_well_and_what_could_use_some_improvement', 'What did the instructor do well and what could use some improvement'),
(198, 'what_did_the_instructor_do_well_and_what_could_use_some_improvement', 'What did the instructor do well and what could use some improvement'),
(199, 'what_did_the_instructor_do_well_and_what_could_use_some_improvement', 'What did the instructor do well and what could use some improvement'),
(200, 'what_did_the_instructor_do_well_and_what_could_use_some_improvement', 'What did the instructor do well and what could use some improvement'),
(201, 'what_did_the_instructor_do_well_and_what_could_use_some_improvement', 'What did the instructor do well and what could use some improvement'),
(202, 'what_did_the_instructor_do_well_and_what_could_use_some_improvement', 'What did the instructor do well and what could use some improvement'),
(203, 'what_did_the_instructor_do_well_and_what_could_use_some_improvement', 'What did the instructor do well and what could use some improvement'),
(204, 'next', 'Next'),
(205, 'next', 'Next'),
(206, 'next', 'Next'),
(207, 'next', 'Next'),
(208, 'next', 'Next'),
(209, 'next', 'Next'),
(210, 'next', 'Next'),
(211, 'previous', 'Previous'),
(212, 'previous', 'Previous'),
(213, 'previous', 'Previous'),
(214, 'previous', 'Previous'),
(215, 'previous', 'Previous'),
(216, 'previous', 'Previous'),
(217, 'previous', 'Previous'),
(218, 'publish', 'Publish'),
(219, 'publish', 'Publish'),
(220, 'publish', 'Publish'),
(221, 'publish', 'Publish'),
(222, 'publish', 'Publish'),
(223, 'publish', 'Publish'),
(224, 'publish', 'Publish'),
(225, 'are_you_sure', 'Are you sure'),
(226, 'are_you_sure', 'Are you sure'),
(227, 'are_you_sure', 'Are you sure'),
(228, 'are_you_sure', 'Are you sure'),
(229, 'are_you_sure', 'Are you sure'),
(230, 'are_you_sure', 'Are you sure'),
(231, 'are_you_sure', 'Are you sure'),
(232, 'yes', 'Yes'),
(233, 'yes', 'Yes'),
(234, 'yes', 'Yes'),
(235, 'yes', 'Yes'),
(236, 'yes', 'Yes'),
(237, 'yes', 'Yes'),
(238, 'yes', 'Yes'),
(239, 'no', 'No'),
(240, 'no', 'No'),
(241, 'no', 'No'),
(242, 'no', 'No'),
(243, 'no', 'No'),
(244, 'no', 'No'),
(245, 'no', 'No'),
(246, 'view_less', 'View less'),
(247, 'view_less', 'View less'),
(248, 'view_less', 'View less'),
(249, 'view_less', 'View less'),
(250, 'view_less', 'View less'),
(251, 'view_less', 'View less'),
(252, 'view_less', 'View less'),
(253, 'view_more', 'View more'),
(254, 'view_more', 'View more'),
(255, 'view_more', 'View more'),
(256, 'view_more', 'View more'),
(257, 'view_more', 'View more'),
(258, 'view_more', 'View more'),
(259, 'view_more', 'View more'),
(260, 'login', 'Login'),
(261, 'provide_your_valid_login_credentials', 'Provide your valid login credentials'),
(262, 'email', 'Email'),
(263, 'password', 'Password'),
(264, 'forgot_password', 'Forgot password'),
(265, 'do_not_have_an_account', 'Do not have an account'),
(266, 'welcome', 'Welcome'),
(267, 'administrator', 'Administrator'),
(268, 'dashboard', 'Dashboard'),
(269, 'quick_actions', 'Quick actions'),
(270, 'create_course', 'Create course'),
(271, 'add_course', 'Add course'),
(272, 'add_new_lesson', 'Add new lesson'),
(273, 'add_lesson', 'Add lesson'),
(274, 'add_student', 'Add student'),
(275, 'enrol_a_student', 'Enrol a student'),
(276, 'enrol_student', 'Enrol student'),
(277, 'help_center', 'Help center'),
(278, 'read_documentation', 'Read documentation'),
(279, 'watch_video_tutorial', 'Watch video tutorial'),
(280, 'get_customer_support', 'Get customer support'),
(281, 'order_customization', 'Order customization'),
(282, 'request_a_new_feature', 'Request a new feature'),
(283, 'browse_addons', 'Browse addons'),
(284, 'admin', 'Admin'),
(285, 'my_account', 'My account'),
(286, 'settings', 'Settings'),
(287, 'logout', 'Logout'),
(288, 'visit_website', 'Visit website'),
(289, 'navigation', 'Navigation'),
(290, 'courses', 'Courses'),
(291, 'manage_courses', 'Manage courses'),
(292, 'add_new_course', 'Add new course'),
(293, 'course_category', 'Course category'),
(294, 'coupons', 'Coupons'),
(295, 'enrolment', 'Enrolment'),
(296, 'course_enrollment', 'Course enrollment'),
(297, 'enrol_history', 'Enrol history'),
(298, 'report', 'Report'),
(299, 'admin_revenue', 'Admin revenue'),
(300, 'instructor_revenue', 'Instructor revenue'),
(301, 'purchase_history', 'Purchase history'),
(302, 'users', 'Users'),
(303, 'admins', 'Admins'),
(304, 'manage_admins', 'Manage admins'),
(305, 'add_new_admin', 'Add new admin'),
(306, 'instructors', 'Instructors'),
(307, 'manage_instructors', 'Manage instructors'),
(308, 'add_new_instructor', 'Add new instructor'),
(309, 'instructor_payout', 'Instructor payout'),
(310, 'instructor_settings', 'Instructor settings'),
(311, 'applications', 'Applications'),
(312, 'students', 'Students'),
(313, 'manage_students', 'Manage students'),
(314, 'add_new_student', 'Add new student'),
(315, 'message', 'Message'),
(316, 'all_blogs', 'All blogs'),
(317, 'pending_blog', 'Pending blog'),
(318, 'blog_category', 'Blog category'),
(319, 'blog_settings', 'Blog settings'),
(320, 'addons', 'Addons'),
(321, 'themes', 'Themes'),
(322, 'system_settings', 'System settings'),
(323, 'website_settings', 'Website settings'),
(324, 'academy_cloud', 'Academy cloud'),
(325, 'drip_content_settings', 'Drip content settings'),
(326, 'payment_settings', 'Payment settings'),
(327, 'language_settings', 'Language settings'),
(328, 'smtp_settings', 'Smtp settings'),
(329, 'social_login', 'Social login'),
(330, 'custom_page', 'Custom page'),
(331, 'data_center', 'Data center'),
(332, 'about', 'About'),
(333, 'manage_profile', 'Manage profile'),
(334, 'admin_revenue_this_year', 'Admin revenue this year'),
(335, 'number_courses', 'Number courses'),
(336, 'number_of_lessons', 'Number of lessons'),
(337, 'number_of_enrolment', 'Number of enrolment'),
(338, 'number_of_student', 'Number of student'),
(339, 'course_overview', 'Course overview'),
(340, 'active_courses', 'Active courses'),
(341, 'pending_courses', 'Pending courses'),
(342, 'requested_withdrawal', 'Requested withdrawal'),
(343, 'january', 'January'),
(344, 'february', 'February'),
(345, 'march', 'March'),
(346, 'april', 'April'),
(347, 'may', 'May'),
(348, 'june', 'June'),
(349, 'july', 'July'),
(350, 'august', 'August'),
(351, 'september', 'September'),
(352, 'october', 'October'),
(353, 'november', 'November'),
(354, 'december', 'December'),
(355, 'this_year', 'This year'),
(356, 'active_course', 'Active course'),
(357, 'pending_course', 'Pending course'),
(358, 'heads_up', 'Heads up'),
(359, 'congratulations', 'Congratulations'),
(360, 'please_fill_all_the_required_fields', 'Please fill all the required fields'),
(361, 'close', 'Close'),
(362, 'cancel', 'Cancel'),
(363, 'continue', 'Continue'),
(364, 'ok', 'Ok'),
(365, 'success', 'Success'),
(366, 'successfully', 'Successfully'),
(367, 'div_added_to_bottom_', 'Div added to bottom '),
(368, 'div_has_been_deleted_', 'Div has been deleted '),
(369, 'website_name', 'Website name'),
(370, 'website_title', 'Website title'),
(371, 'website_keywords', 'Website keywords'),
(372, 'website_description', 'Website description'),
(373, 'author', 'Author'),
(374, 'slogan', 'Slogan'),
(375, 'system_email', 'System email'),
(376, 'address', 'Address'),
(377, 'phone', 'Phone'),
(378, 'youtube_api_key', 'Youtube api key'),
(379, 'get_youtube_api_key', 'Get youtube api key'),
(380, 'vimeo_api_key', 'Vimeo api key'),
(381, 'get_vimeo_api_key', 'Get vimeo api key'),
(382, 'purchase_code', 'Purchase code'),
(383, 'system_language', 'System language'),
(384, 'student_email_verification', 'Student email verification'),
(385, 'enable', 'Enable'),
(386, 'disable', 'Disable'),
(387, 'course_accessibility', 'Course accessibility'),
(388, 'publicly', 'Publicly'),
(389, 'only_logged_in_users', 'Only logged in users'),
(390, 'number_of_authorized_devices', 'Number of authorized devices'),
(391, 'how_many_devices_do_you_want_to_allow_for_logging_in_using_a_single_account', 'How many devices do you want to allow for logging in using a single account'),
(392, 'course_selling_tax', 'Course selling tax'),
(393, 'enter_0_if_you_want_to_disable_the_tax_option', 'Enter 0 if you want to disable the tax option'),
(394, 'google_analytics_id', 'Google analytics id'),
(395, 'keep_it_blank_if_you_want_to_disable_it', 'Keep it blank if you want to disable it'),
(396, 'meta_pixel_id', 'Meta pixel id'),
(397, 'footer_text', 'Footer text'),
(398, 'footer_link', 'Footer link'),
(399, 'save', 'Save'),
(400, 'update_product', 'Update product'),
(401, 'file', 'File'),
(402, 'update', 'Update'),
(403, 'not_found', 'Not found'),
(404, 'about_this_application', 'About this application'),
(405, 'software_version', 'Software version'),
(406, 'check_update', 'Check update'),
(407, 'php_version', 'Php version'),
(408, 'curl_enable', 'Curl enable'),
(409, 'enabled', 'Enabled'),
(410, 'product_license', 'Product license'),
(411, 'invalid', 'Invalid'),
(412, 'enter_valid_purchase_code', 'Enter valid purchase code'),
(413, 'customer_support_status', 'Customer support status'),
(414, 'support_expiry_date', 'Support expiry date'),
(415, 'customer_name', 'Customer name'),
(416, 'customer_support', 'Customer support'),
(417, 'theme_settings', 'Theme settings'),
(418, 'buy_new_theme', 'Buy new theme'),
(419, 'installed_themes', 'Installed themes'),
(420, 'add_new_themes', 'Add new themes'),
(421, 'active_theme', 'Active theme'),
(422, 'theme_successfully_activated', 'Theme successfully activated'),
(423, 'you_do_not_have_right_to_access_this_theme', 'You do not have right to access this theme'),
(424, 'private_messaging', 'Private messaging'),
(425, 'private_message', 'Private message'),
(426, 'new_message', 'New message'),
(427, 'choose_an_option_from_the_left_side', 'Choose an option from the left side'),
(428, 'addon_manager', 'Addon manager'),
(429, 'buy_new_addon', 'Buy new addon'),
(430, 'install_addon', 'Install addon'),
(431, 'installed_addons', 'Installed addons'),
(432, 'available_addons', 'Available addons'),
(433, 'name', 'Name'),
(434, 'version', 'Version'),
(435, 'status', 'Status'),
(436, 'actions', 'Actions'),
(437, 'multi_language_settings', 'Multi language settings'),
(438, 'manage_language', 'Manage language'),
(439, 'language_list', 'Language list'),
(440, 'add_language', 'Add language'),
(441, 'language', 'Language'),
(442, 'option', 'Option'),
(443, 'edit_phrase', 'Edit phrase'),
(444, 'delete_language', 'Delete language'),
(445, 'add_new_phrase', 'Add new phrase'),
(446, 'add_new_language', 'Add new language'),
(447, 'no_special_character_or_space_is_allowed', 'No special character or space is allowed'),
(448, 'valid_examples', 'Valid examples'),
(449, 'phrase_updated', 'Phrase updated'),
(450, 'language_added_successfully', 'Language added successfully'),
(451, 'protocol', 'Protocol'),
(452, 'smtp_crypto', 'Smtp crypto'),
(453, 'smtp_host', 'Smtp host'),
(454, 'smtp_port', 'Smtp port'),
(455, 'smtp_username', 'Smtp username'),
(456, 'smtp_password', 'Smtp password'),
(457, 'smtp_settings_updated_successfully', 'Smtp settings updated successfully'),
(458, 'valid', 'Valid'),
(459, 'basic_info', 'Basic info'),
(460, 'first_name', 'First name'),
(461, 'last_name', 'Last name'),
(462, 'facebook_link', 'Facebook link'),
(463, 'twitter_link', 'Twitter link'),
(464, 'linkedin_link', 'Linkedin link'),
(465, 'a_short_title_about_yourself', 'A short title about yourself'),
(466, 'skills', 'Skills'),
(467, 'write_your_skill_and_click_the_enter_button', 'Write your skill and click the enter button'),
(468, 'biography', 'Biography'),
(469, 'photo', 'Photo'),
(470, 'the_image_size_should_be_any_square_image', 'The image size should be any square image'),
(471, 'choose_file', 'Choose file'),
(472, 'update_profile', 'Update profile'),
(473, 'current_password', 'Current password'),
(474, 'new_password', 'New password'),
(475, 'confirm_new_password', 'Confirm new password'),
(476, 'update_password', 'Update password'),
(477, 'provide_your_valid_email_address', 'Provide your valid email address'),
(478, 'your_email', 'Your email'),
(479, 'send_request', 'Send request'),
(480, 'want_to_go_back', 'Want to go back'),
(481, 'check_your_inbox_for_the_request', 'Check your inbox for the request'),
(482, 'home', 'Home'),
(483, 'start_learning_from_best_platform', 'Start learning from best platform'),
(484, 'study_any_topic,_anytime._explore_thousands_of_courses_for_the_lowest_price_ever!', 'Study any topic, anytime. explore thousands of courses for the lowest price ever!'),
(485, 'what_do_you_want_to_learn', 'What do you want to learn'),
(486, 'search', 'Search'),
(487, 'online_courses', 'Online courses'),
(488, 'explore_a_variety_of_fresh_topics', 'Explore a variety of fresh topics'),
(489, 'expert_instruction', 'Expert instruction'),
(490, 'find_the_right_course_for_you', 'Find the right course for you'),
(491, 'lifetime_access', 'Lifetime access'),
(492, 'learn_on_your_schedule', 'Learn on your schedule'),
(493, 'top_courses', 'Top courses'),
(494, 'top', 'Top'),
(495, 'latest_courses', 'Latest courses'),
(496, 'join_now_to_start_learning', 'Join now to start learning'),
(497, 'get_started', 'Get started'),
(498, 'become_a_new_instructor', 'Become a new instructor'),
(499, 'join_now', 'Join now'),
(500, 'add_to_cart', 'Add to cart'),
(501, 'added_to_cart', 'Added to cart'),
(502, 'add_addon', 'Add addon'),
(503, 'install_an_addon', 'Install an addon'),
(504, 'back_to_addon_list', 'Back to addon list'),
(505, 'upload_addon_file', 'Upload addon file'),
(506, 'zip_file', 'Zip file'),
(507, 'enter_your_valid_purchase_code', 'Enter your valid purchase code'),
(508, 'back', 'Back'),
(509, 'purchase_code_is_wrong', 'Purchase code is wrong'),
(510, 'please_enter_your_valid_purchase_code', 'Please enter your valid purchase code'),
(511, 'addon_installed_successfully', 'Addon installed successfully'),
(512, 'active', 'Active'),
(513, 'addon_update', 'Addon update'),
(514, 'deactive', 'Deactive'),
(515, 'delete', 'Delete'),
(516, 'about_this_addon', 'About this addon'),
(517, 'setup_payment_informations', 'Setup payment informations'),
(518, 'system_currency_settings', 'System currency settings'),
(519, 'system_currency', 'System currency'),
(520, 'select_system_currency', 'Select system currency'),
(521, 'currency_position', 'Currency position'),
(522, 'left', 'Left'),
(523, 'right', 'Right'),
(524, 'left_with_a_space', 'Left with a space'),
(525, 'right_with_a_space', 'Right with a space'),
(526, 'update_system_currency', 'Update system currency'),
(527, 'want_to_keep_test_mode_enabled', 'Want to keep test mode enabled'),
(528, 'select_currency', 'Select currency'),
(529, 'sandbox_client_id', 'Sandbox client id'),
(530, 'sandbox_secret_key', 'Sandbox secret key'),
(531, 'production_client_id', 'Production client id'),
(532, 'production_secret_key', 'Production secret key'),
(533, 'public_key', 'Public key'),
(534, 'secret_key', 'Secret key'),
(535, 'public_live_key', 'Public live key'),
(536, 'secret_live_key', 'Secret live key'),
(537, 'key_id', 'Key id'),
(538, 'theme_color', 'Theme color'),
(539, 'ensure_that_the_system_currency_and_all_active_payment_gateway_currencies_are_same', 'Ensure that the system currency and all active payment gateway currencies are same'),
(540, 'import_your_data', 'Import your data'),
(541, 'choose_your_demo_file', 'Choose your demo file'),
(542, 'import', 'Import'),
(543, 'import_your_language_file', 'Import your language file'),
(544, 'choose_your_json_file', 'Choose your json file'),
(545, 'backup_data', 'Backup data'),
(546, 'backup_your_current_data', 'Backup your current data'),
(547, 'keep_a_backup', 'Keep a backup'),
(548, 'no_backup', 'No backup'),
(549, 'for_more_details_check_out_our', 'For more details check out our'),
(550, 'website', 'Website'),
(551, 'addon_is_deleted_successfully', 'Addon is deleted successfully'),
(552, 'payment_settings_updated_successfully', 'Payment settings updated successfully'),
(553, 'course_adding_form', 'Course adding form'),
(554, 'back_to_course_list', 'Back to course list'),
(555, 'basic', 'Basic'),
(556, 'info', 'Info'),
(557, 'pricing', 'Pricing'),
(558, 'media', 'Media'),
(559, 'seo', 'Seo'),
(560, 'finish', 'Finish'),
(561, 'course_title', 'Course title'),
(562, 'enter_course_title', 'Enter course title'),
(563, 'short_description', 'Short description'),
(564, 'description', 'Description'),
(565, 'category', 'Category'),
(566, 'select_a_category', 'Select a category'),
(567, 'select_sub_category', 'Select sub category'),
(568, 'level', 'Level'),
(569, 'beginner', 'Beginner'),
(570, 'advanced', 'Advanced'),
(571, 'intermediate', 'Intermediate'),
(572, 'language_made_in', 'Language made in'),
(573, 'enable_drip_content', 'Enable drip content'),
(574, 'keep_it_as_a_private_course', 'Keep it as a private course'),
(575, 'check_if_this_course_is_top_course', 'Check if this course is top course'),
(576, 'course_faq', 'Course faq'),
(577, 'faq_question', 'Faq question'),
(578, 'answer', 'Answer'),
(579, 'requirements', 'Requirements'),
(580, 'provide_requirements', 'Provide requirements'),
(581, 'outcomes', 'Outcomes'),
(582, 'provide_outcomes', 'Provide outcomes'),
(583, 'check_if_this_is_a_free_course', 'Check if this is a free course'),
(584, 'course_price', 'Course price'),
(585, 'enter_course_course_price', 'Enter course course price'),
(586, 'check_if_this_course_has_discount', 'Check if this course has discount'),
(587, 'discounted_price', 'Discounted price'),
(588, 'this_course_has', 'This course has'),
(589, 'discount', 'Discount'),
(590, 'course_overview_provider', 'Course overview provider'),
(591, 'youtube', 'Youtube'),
(592, 'vimeo', 'Vimeo'),
(593, 'html5', 'Html5'),
(594, 'course_overview_url', 'Course overview url'),
(595, 'course_thumbnail', 'Course thumbnail'),
(596, 'meta_keywords', 'Meta keywords'),
(597, 'write_a_keyword_and_then_press_enter_button', 'Write a keyword and then press enter button'),
(598, 'meta_description', 'Meta description'),
(599, 'thank_you', 'Thank you'),
(600, 'you_are_just_one_click_away', 'You are just one click away'),
(601, 'submit', 'Submit'),
(602, 'add_new_category', 'Add new category'),
(603, 'add_category', 'Add category'),
(604, 'category_add_form', 'Category add form'),
(605, 'category_code', 'Category code'),
(606, 'category_title', 'Category title'),
(607, 'parent', 'Parent'),
(608, 'none', 'None'),
(609, 'select_none_to_create_a_parent_category', 'Select none to create a parent category'),
(610, 'icon_picker', 'Icon picker'),
(611, 'category_thumbnail', 'Category thumbnail'),
(612, 'the_image_size_should_be', 'The image size should be'),
(613, 'choose_thumbnail', 'Choose thumbnail'),
(614, 'data_added_successfully', 'Data added successfully'),
(615, 'sub_categories', 'Sub categories'),
(616, 'edit', 'Edit'),
(617, 'edit_category', 'Edit category'),
(618, 'update_category', 'Update category'),
(619, 'update_category_form', 'Update category form'),
(620, 'course_has_been_added_successfully', 'Course has been added successfully'),
(621, 'edit_course', 'Edit course'),
(622, 'course_manager', 'Course manager'),
(623, 'view_on_frontend', 'View on frontend'),
(624, 'curriculum', 'Curriculum'),
(625, 'add_new_section', 'Add new section'),
(626, 'add_section', 'Add section'),
(627, 'instructor_of_this_course', 'Instructor of this course'),
(628, 'hours', 'Hours'),
(629, 'reviews', 'Reviews'),
(630, 'compare', 'Compare'),
(631, 'lectures', 'Lectures'),
(632, 'last_updated', 'Last updated'),
(633, 'lessons', 'Lessons'),
(634, 'all_category', 'All category'),
(635, 'price', 'Price'),
(636, 'all', 'All'),
(637, 'free', 'Free'),
(638, 'paid', 'Paid'),
(639, 'ratings', 'Ratings'),
(640, 'showing', 'Showing'),
(641, 'of', 'Of'),
(642, 'results', 'Results'),
(643, 'sort_by', 'Sort by'),
(644, 'newest', 'Newest'),
(645, 'highest_rating', 'Highest rating'),
(646, 'discounted', 'Discounted'),
(647, 'lowest_price', 'Lowest price'),
(648, 'highest_price', 'Highest price'),
(649, 'show_more', 'Show more'),
(650, 'show_less', 'Show less'),
(651, 'course', 'Course'),
(652, 'students_enrolled', 'Students enrolled'),
(653, 'created_by', 'Created by'),
(654, 'curriculum_for_this_course', 'Curriculum for this course'),
(655, 'other_related_courses', 'Other related courses'),
(656, 'about_instructor', 'About instructor'),
(657, 'student_feedback', 'Student feedback'),
(658, 'preview_this_course', 'Preview this course'),
(659, 'add_to_wishlist', 'Add to wishlist'),
(660, 'buy_now', 'Buy now'),
(661, 'includes', 'Includes'),
(662, 'on_demand_videos', 'On demand videos'),
(663, 'access_on_mobile_and_tv', 'Access on mobile and tv'),
(664, 'full_lifetime_access', 'Full lifetime access'),
(665, 'compare_this_course_with_other', 'Compare this course with other'),
(666, 'course_preview', 'Course preview'),
(667, 'please_wait', 'Please wait'),
(668, 'added_to_wishlist', 'Added to wishlist'),
(669, 'go_to_wishlist', 'Go to wishlist'),
(670, 'your_wishlist_is_empty', 'Your wishlist is empty'),
(671, 'explore_courses', 'Explore courses'),
(672, 'shopping_cart', 'Shopping cart'),
(673, 'courses_in_cart', 'Courses in cart'),
(674, 'remove', 'Remove'),
(675, 'tax_included', 'Tax included'),
(676, 'apply_coupon_code', 'Apply coupon code'),
(677, 'apply', 'Apply'),
(678, 'checkout', 'Checkout'),
(679, 'there_are_no_courses_on_your_cart', 'There are no courses on your cart'),
(680, 'sign_up_and_start_learning', 'Sign up and start learning'),
(681, 'already_have_an_account', 'Already have an account'),
(682, 'your_registration_has_been_successfully_done', 'Your registration has been successfully done'),
(683, 'instructor', 'Instructor'),
(684, 'my_courses', 'My courses'),
(685, 'hi', 'Hi'),
(686, 'welcome_back', 'Welcome back'),
(687, 'my_wishlist', 'My wishlist'),
(688, 'my_messages', 'My messages'),
(689, 'user_profile', 'User profile'),
(690, 'log_out', 'Log out'),
(691, 'pay_for_purchasing_course', 'Pay for purchasing course'),
(692, 'payment', 'Payment'),
(693, 'make_payment', 'Make payment'),
(694, 'select_payment_gateway', 'Select payment gateway'),
(695, 'by', 'By'),
(696, 'pay_with_stripe', 'Pay with stripe'),
(697, 'pay_by_razorpay', 'Pay by razorpay'),
(698, 'wishlists', 'Wishlists'),
(699, 'messages', 'Messages'),
(700, 'profile', 'Profile'),
(701, 'reset', 'Reset'),
(702, 'search_my_courses', 'Search my courses'),
(703, 'account', 'Account'),
(704, 'edit_profile', 'Edit profile'),
(705, 'add_information_about_yourself_to_share_on_your_profile', 'Add information about yourself to share on your profile'),
(706, 'add_your_twitter_link', 'Add your twitter link'),
(707, 'add_your_facebook_link', 'Add your facebook link'),
(708, 'add_your_linkedin_link', 'Add your linkedin link'),
(709, 'credentials', 'Credentials'),
(710, 'account_information', 'Account information'),
(711, 'edit_your_account_settings', 'Edit your account settings'),
(712, 'enter_current_password', 'Enter current password'),
(713, 'enter_new_password', 'Enter new password'),
(714, 'confirm_password', 'Confirm password'),
(715, 're-type_your_password', 'Re-type your password'),
(716, 'save_changes', 'Save changes'),
(717, 'course_bundles', 'Course bundles'),
(718, 'course_bundle', 'Course bundle'),
(719, 'add_new_bundle', 'Add new bundle'),
(720, 'manage_bundle', 'Manage bundle'),
(721, 'subscription_report', 'Subscription report'),
(722, 'manage_course_bundle', 'Manage course bundle'),
(723, 'bundle', 'Bundle'),
(724, 'subscription_limit', 'Subscription limit'),
(725, 'action', 'Action'),
(726, 'add_course_bundle', 'Add course bundle'),
(727, 'bundle_add_form', 'Bundle add form'),
(728, 'title', 'Title'),
(729, 'course_bundle_title', 'Course bundle title'),
(730, 'select_courses', 'Select courses'),
(731, 'current_price_of_the_courses_is', 'Current price of the courses is'),
(732, 'bundle_price', 'Bundle price'),
(733, 'subscription_renew_days', 'Subscription renew days'),
(734, 'count_day', 'Count day'),
(735, 'banner', 'Banner'),
(736, 'bundle_details', 'Bundle details'),
(737, 'create_bundle', 'Create bundle'),
(738, 'certificate_settings', 'Certificate settings'),
(739, 'certificate_template_text', 'Certificate template text'),
(740, 'and', 'And'),
(741, 'represents_student_name_and_course_title_on_the_certificate', 'Represents student name and course title on the certificate'),
(742, 'certificate_template', 'Certificate template'),
(743, 'make_sure_that_template_size_is_less_than', 'Make sure that template size is less than');

-- --------------------------------------------------------

--
-- Estrutura da tabela `lesson`
--

DROP TABLE IF EXISTS `lesson`;
CREATE TABLE IF NOT EXISTS `lesson` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `duration` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `course_id` int DEFAULT NULL,
  `section_id` int DEFAULT NULL,
  `video_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cloud_video_id` int DEFAULT NULL,
  `video_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_added` int DEFAULT NULL,
  `last_modified` int DEFAULT NULL,
  `lesson_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `attachment` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `attachment_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `caption` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `summary` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `is_free` int NOT NULL DEFAULT '0',
  `order` int NOT NULL DEFAULT '0',
  `video_type_for_mobile_application` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `video_url_for_mobile_application` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `duration_for_mobile_application` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `id` int NOT NULL,
  `from` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `message_id` int NOT NULL AUTO_INCREMENT,
  `message_thread_code` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `message` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `sender` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `timestamp` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `read_status` int DEFAULT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `message_thread`
--

DROP TABLE IF EXISTS `message_thread`;
CREATE TABLE IF NOT EXISTS `message_thread` (
  `message_thread_id` int NOT NULL AUTO_INCREMENT,
  `message_thread_code` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `sender` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `receiver` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `last_message_timestamp` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`message_thread_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `payment_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `course_id` int DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `date_added` int DEFAULT NULL,
  `last_modified` int DEFAULT NULL,
  `admin_revenue` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `instructor_revenue` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `instructor_payment_status` int DEFAULT '0',
  `transaction_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `session_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `coupon` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `payment_gateways`
--

DROP TABLE IF EXISTS `payment_gateways`;
CREATE TABLE IF NOT EXISTS `payment_gateways` (
  `id` int NOT NULL AUTO_INCREMENT,
  `identifier` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keys` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `model_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled_test_mode` int NOT NULL,
  `status` int NOT NULL,
  `is_addon` int NOT NULL,
  `created_at` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `identifier`, `currency`, `title`, `description`, `keys`, `model_name`, `enabled_test_mode`, `status`, `is_addon`, `created_at`, `updated_at`) VALUES
(1, 'paypal', 'USD', 'Paypal', '', '{\"sandbox_client_id\":\"AfGaziKslex-scLAyYdDYXNFaz2aL5qGau-SbDgE_D2E80D3AFauLagP8e0kCq9au7W4IasmFbirUUYc\",\"sandbox_secret_key\":\"EMa5pCTuOpmHkhHaCGibGhVUcKg0yt5-C3CzJw-OWJCzaXXzTlyD17SICob_BkfM_0Nlk7TWnN42cbGz\",\"production_client_id\":\"1234\",\"production_secret_key\":\"12345\"}', 'Payment_model', 1, 1, 0, '', '1677695661'),
(2, 'stripe', 'USD', 'Stripe', '', '{\"public_key\":\"pk_test_CAC3cB1mhgkJqXtypYBTGb4f\",\"secret_key\":\"sk_test_iatnshcHhQVRXdygXw3L2Pp2\",\"public_live_key\":\"pk_live_xxxxxxxxxxxxxxxxxxxxxxxx\",\"secret_live_key\":\"sk_live_xxxxxxxxxxxxxxxxxxxxxxxx\"}', 'Payment_model', 1, 1, 0, '', '1673263724'),
(3, 'razorpay', 'USD', 'Razorpay', '', '{\"key_id\":\"rzp_test_J60bqBOi1z1aF5\",\"secret_key\":\"uk935K7p4j96UCJgHK8kAU4q\",\"theme_color\":\"#23d792\"}', 'Payment_model', 1, 1, 0, '', '1673264610');

-- --------------------------------------------------------

--
-- Estrutura da tabela `payout`
--

DROP TABLE IF EXISTS `payout`;
CREATE TABLE IF NOT EXISTS `payout` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `date_added` int DEFAULT NULL,
  `last_modified` int DEFAULT NULL,
  `status` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` int DEFAULT NULL,
  `permissions` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `quiz_id` int DEFAULT NULL,
  `title` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `number_of_options` int DEFAULT NULL,
  `options` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `correct_answers` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `order` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `quiz_results`
--

DROP TABLE IF EXISTS `quiz_results`;
CREATE TABLE IF NOT EXISTS `quiz_results` (
  `quiz_result_id` int NOT NULL AUTO_INCREMENT,
  `quiz_id` int NOT NULL,
  `user_id` int NOT NULL,
  `user_answers` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `correct_answers` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'question_id',
  `total_obtained_marks` double NOT NULL,
  `date_added` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date_updated` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_submitted` int NOT NULL,
  PRIMARY KEY (`quiz_result_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rating`
--

DROP TABLE IF EXISTS `rating`;
CREATE TABLE IF NOT EXISTS `rating` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `rating` double DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `ratable_id` int DEFAULT NULL,
  `ratable_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_added` int DEFAULT NULL,
  `last_modified` int DEFAULT NULL,
  `review` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_added` int DEFAULT NULL,
  `last_modified` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `role`
--

INSERT INTO `role` (`id`, `name`, `date_added`, `last_modified`) VALUES
(1, 'Admin', 1234567890, 1234567890),
(2, 'User', 1234567890, 1234567890);

-- --------------------------------------------------------

--
-- Estrutura da tabela `section`
--

DROP TABLE IF EXISTS `section`;
CREATE TABLE IF NOT EXISTS `section` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `course_id` int DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'language', 'english'),
(2, 'system_name', 'Sistema Curso'),
(3, 'system_title', 'Academy Learning Club'),
(4, 'system_email', 'academy@example.com'),
(5, 'address', 'Sydney, Australia'),
(6, 'phone', '+143-52-9933631'),
(7, 'purchase_code', '15fee8a4-4a7d-4446-a17c-805a9ab44ed3'),
(8, 'paypal', '[{\"active\":\"1\",\"mode\":\"sandbox\",\"sandbox_client_id\":\"AfGaziKslex-scLAyYdDYXNFaz2aL5qGau-SbDgE_D2E80D3AFauLagP8e0kCq9au7W4IasmFbirUUYc\",\"sandbox_secret_key\":\"EMa5pCTuOpmHkhHaCGibGhVUcKg0yt5-C3CzJw-OWJCzaXXzTlyD17SICob_BkfM_0Nlk7TWnN42cbGz\",\"production_client_id\":\"1234\",\"production_secret_key\":\"12345\"}]'),
(9, 'stripe_keys', '[{\"active\":\"1\",\"testmode\":\"on\",\"public_key\":\"pk_test_CAC3cB1mhgkJqXtypYBTGb4f\",\"secret_key\":\"sk_test_iatnshcHhQVRXdygXw3L2Pp2\",\"public_live_key\":\"pk_live_xxxxxxxxxxxxxxxxxxxxxxxx\",\"secret_live_key\":\"sk_live_xxxxxxxxxxxxxxxxxxxxxxxx\"}]'),
(10, 'youtube_api_key', 'youtube-api-key'),
(11, 'vimeo_api_key', '39258384b69994dba483c10286825b5c'),
(12, 'slogan', 'A course based video CMS'),
(13, 'text_align', NULL),
(14, 'allow_instructor', '1'),
(15, 'instructor_revenue', '70'),
(16, 'system_currency', 'BRL'),
(17, 'paypal_currency', 'USD'),
(18, 'stripe_currency', 'USD'),
(19, 'author', 'Creativeitem'),
(20, 'currency_position', 'left'),
(21, 'website_description', 'Study any topic, anytime. explore thousands of courses for the lowest price ever!'),
(22, 'website_keywords', 'LMS,Learning Management System,Creativeitem,Academy LMS'),
(23, 'footer_text', ''),
(24, 'footer_link', 'http://creativeitem.com/'),
(25, 'protocol', 'smtp'),
(26, 'smtp_host', 'smtp.hostinger.com'),
(27, 'smtp_port', '465'),
(28, 'smtp_user', 'john@digitalcombo.com.br'),
(29, 'smtp_pass', 'Seraph@121'),
(30, 'version', '5.12'),
(31, 'student_email_verification', 'disable'),
(32, 'instructor_application_note', 'Fill all the fields carefully and share if you want to share any document with us it will help us to evaluate you as an instructor.'),
(33, 'razorpay_keys', '[{\"active\":\"1\",\"key\":\"rzp_test_J60bqBOi1z1aF5\",\"secret_key\":\"uk935K7p4j96UCJgHK8kAU4q\",\"theme_color\":\"#c7a600\"}]'),
(34, 'razorpay_currency', 'USD'),
(35, 'fb_app_id', 'facebook-app-id'),
(36, 'fb_app_secret', 'facebook-app-secret-key'),
(37, 'fb_social_login', '0'),
(38, 'drip_content_settings', '{\"lesson_completion_role\":\"percentage\",\"minimum_duration\":10,\"minimum_percentage\":\"50\",\"locked_lesson_message\":\"&lt;h3 xss=&quot;removed&quot; style=&quot;text-align: center; &quot;&gt;&lt;span xss=&quot;removed&quot;&gt;&lt;strong&gt;Permission denied!&lt;\\/strong&gt;&lt;\\/span&gt;&lt;\\/h3&gt;&lt;p xss=&quot;removed&quot; style=&quot;text-align: center; &quot;&gt;&lt;span xss=&quot;removed&quot;&gt;This course supports drip content, so you must complete the previous lessons.&lt;\\/span&gt;&lt;\\/p&gt;\"}'),
(41, 'course_accessibility', 'publicly'),
(42, 'smtp_crypto', 'ssl'),
(43, 'allowed_device_number_of_loging', '10'),
(47, 'academy_cloud_access_token', 'jdfghasdfasdfasdfasdfasdf'),
(48, 'course_selling_tax', '10'),
(49, 'ccavenue_keys', '[{\"active\":\"1\",\"ccavenue_merchant_id\":\"cmi_xxxxxx\",\"ccavenue_working_key\":\"cwk_xxxxxxxxxxxx\",\"ccavenue_access_code\":\"ccc_xxxxxxxxxxxxx\"}]'),
(50, 'ccavenue_currency', 'INR'),
(51, 'iyzico_keys', '[{\"active\":\"1\",\"testmode\":\"on\",\"iyzico_currency\":\"TRY\",\"api_test_key\":\"atk_xxxxxxxx\",\"secret_test_key\":\"stk_xxxxxxxx\",\"api_live_key\":\"alk_xxxxxxxx\",\"secret_live_key\":\"slk_xxxxxxxx\"}]'),
(52, 'iyzico_currency', 'TRY'),
(53, 'paystack_keys', '[{\"active\":\"1\",\"testmode\":\"on\",\"secret_test_key\":\"sk_test_c746060e693dd50c6f397dffc6c3b2f655217c94\",\"public_test_key\":\"pk_test_0816abbed3c339b8473ff22f970c7da1c78cbe1b\",\"secret_live_key\":\"sk_live_xxxxxxxxxxxxxxxxxxxxx\",\"public_live_key\":\"pk_live_xxxxxxxxxxxxxxxxxxxxx\"}]'),
(54, 'paystack_currency', 'NGN'),
(55, 'paytm_keys', '[{\"PAYTM_MERCHANT_KEY\":\"PAYTM_MERCHANT_KEY\",\"PAYTM_MERCHANT_MID\":\"PAYTM_MERCHANT_MID\",\"PAYTM_MERCHANT_WEBSITE\":\"DEFAULT\",\"INDUSTRY_TYPE_ID\":\"Retail\",\"CHANNEL_ID\":\"WEB\"}]'),
(57, 'google_analytics_id', ''),
(58, 'meta_pixel_id', ''),
(59, 'randCallRange', '20'),
(60, 'randCallRange', '20'),
(61, 'randCallRange', '20'),
(62, 'certificate_template', 'This is to certify that Mr. / Ms. {student} successfully completed the course with on certificate for {course}.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tagable_id` int DEFAULT NULL,
  `tagable_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_added` int DEFAULT NULL,
  `last_modified` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `skills` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `social_links` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `biography` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `role_id` int DEFAULT NULL,
  `date_added` int DEFAULT NULL,
  `last_modified` int DEFAULT NULL,
  `wishlist` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `title` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `payment_keys` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `verification_code` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `status` int DEFAULT NULL,
  `is_instructor` int DEFAULT '0',
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sessions` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `skills`, `social_links`, `biography`, `role_id`, `date_added`, `last_modified`, `wishlist`, `title`, `payment_keys`, `verification_code`, `status`, `is_instructor`, `image`, `sessions`) VALUES
(1, 'John', 'Hoffmann', 'john@digitalcombo.com.br', '0661204def875789171507c5a27942e0b5923419', '', '{\"facebook\":\"\",\"twitter\":\"\",\"linkedin\":\"\"}', NULL, 1, NULL, 1676178487, NULL, NULL, '', 'am9obkBkaWdpdGFsY29tYm8uY29tLmJyX1VoNiNAIzZoVV8zNzIwNDI0', 1, 1, NULL, ''),
(2, 'bruno', 'vieira', 'br.rafael@outlook.com', '3f2f9562e4d1e50dcd02102aa302b392d7411fe8', '', '{\"facebook\":\"\",\"twitter\":\"\",\"linkedin\":\"\"}', NULL, 2, 1677696328, NULL, '[]', NULL, '[]', '141365', 1, 0, NULL, '[\"slk7hr6chdnlgnr2qvqiafeqhd5sje55\",\"mdh6s1pca4rj3lkkpckh6qhuabdsmh93\"]');

-- --------------------------------------------------------

--
-- Estrutura da tabela `watched_duration`
--

DROP TABLE IF EXISTS `watched_duration`;
CREATE TABLE IF NOT EXISTS `watched_duration` (
  `watched_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `watched_student_id` int DEFAULT NULL,
  `watched_course_id` int DEFAULT NULL,
  `watched_lesson_id` int DEFAULT NULL,
  `current_duration` int DEFAULT NULL,
  `watched_counter` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`watched_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `watch_histories`
--

DROP TABLE IF EXISTS `watch_histories`;
CREATE TABLE IF NOT EXISTS `watch_histories` (
  `watch_history_id` int NOT NULL AUTO_INCREMENT,
  `course_id` int NOT NULL,
  `student_id` int NOT NULL,
  `completed_lesson` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `course_progress` int NOT NULL,
  `watching_lesson_id` int NOT NULL,
  `quiz_result` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date_added` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_updated` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`watch_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
