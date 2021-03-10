-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2021 at 11:43 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abafes`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admins_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `admins_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => stopped, 1 => active',
  `admins_type` enum('admin','storekeeper','delegate') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'admin',
  `admins_position` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admins_id`, `name`, `email`, `password`, `admins_status`, `admins_type`, `admins_position`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'GeneralAdmin', 'admin@gmail.com', '$2y$10$tB4LuUMrJ/nVW33.43S3Ye4Sm57vFnnCDoXSSx5Vig.PXvDP4SJCq', 1, 'admin', 1, NULL, '2019-03-31 22:00:00', '2021-03-10 20:29:51'),
(4, 'Admin', 'Admin@example.com', '$2y$10$/7Nk0.Ha37zWzFbBvcdaVe5gzDugEnbsjdCR9h2v7sK0L2LceuLKe', 1, 'admin', 1, NULL, '2019-05-01 08:30:07', '2021-03-10 20:30:08');

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `advertisements_id` int(10) UNSIGNED NOT NULL,
  `advertisements_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'اسم الاعلان يظهر للادمن فقط',
  `advertisements_img` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `advertisements_mobile_img` varchar(200) CHARACTER SET utf8 NOT NULL,
  `advertisements_color` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'لون خلفية الاعلان في حالة الاعلان بانر فقط',
  `advertisements_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `advertisements_status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '''0 => Stopped, 1 => Active''',
  `advertisements_created_at` timestamp NULL DEFAULT NULL,
  `advertisements_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advertisement_translations`
--

CREATE TABLE `advertisement_translations` (
  `advertisements_trans_id` int(11) NOT NULL,
  `advertisements_id` int(11) UNSIGNED NOT NULL,
  `locale` varchar(2) NOT NULL,
  `advertisements_img` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advertisements_mobile_img` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advertisements_text` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contacts_id` int(10) UNSIGNED NOT NULL,
  `contacts_mobiles` text CHARACTER SET utf8,
  `contacts_facebook` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `contacts_twitter` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `contacts_instagram` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `contacts_snapchat` varchar(255) DEFAULT NULL,
  `contacts_whatsapp` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `contacts_created_at` timestamp NULL DEFAULT NULL,
  `contacts_updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contacts_id`, `contacts_mobiles`, `contacts_facebook`, `contacts_twitter`, `contacts_instagram`, `contacts_snapchat`, `contacts_whatsapp`, `contacts_created_at`, `contacts_updated_at`) VALUES
(1, '966525364875', 'https://www.facebook.com/', 'https://www.twitter.com/', 'https://www.nstagram.com/', 'https://www.snapchat.com/', '321654987', '2020-01-13 22:00:00', '2020-11-24 08:01:48');

-- --------------------------------------------------------

--
-- Table structure for table `contact_translations`
--

CREATE TABLE `contact_translations` (
  `contacts_trans_id` int(11) NOT NULL,
  `contacts_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contacts_address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `contacts_text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_translations`
--

INSERT INTO `contact_translations` (`contacts_trans_id`, `contacts_id`, `locale`, `contacts_address`, `contacts_text`) VALUES
(1, 1, 'ar', NULL, ''),
(2, 1, 'en', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `contact_us_id` int(10) UNSIGNED NOT NULL,
  `contact_us_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contact_us_phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `contact_us_email` varchar(191) CHARACTER SET utf8 DEFAULT NULL,
  `contact_us_type` enum('0','1','2') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '''0 => Complaint, 1 => Sugestion''',
  `contact_us_status` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0' COMMENT '0 => "new" , 1=>"done"',
  `contact_us_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_us_message` text COLLATE utf8_unicode_ci NOT NULL,
  `contact_us_created_at` datetime DEFAULT NULL,
  `contact_us_updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`contact_us_id`, `contact_us_name`, `contact_us_phone`, `contact_us_email`, `contact_us_type`, `contact_us_status`, `contact_us_title`, `contact_us_message`, `contact_us_created_at`, `contact_us_updated_at`) VALUES
(1, 'Ahmed Muhammad', '0123443544543', NULL, '0', '1', NULL, 'نص الشكوى', '2019-04-12 08:17:00', '2020-04-26 12:48:34'),
(2, 'Mohamed Ali', '9660985433544', NULL, '1', '1', NULL, 'نص الاقتراح', '2019-04-11 11:25:00', '2020-04-26 12:48:38');

-- --------------------------------------------------------

--
-- Table structure for table `infos`
--

CREATE TABLE `infos` (
  `infos_id` int(11) UNSIGNED NOT NULL,
  `infos_key` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `infos_status` tinyint(4) NOT NULL DEFAULT '1',
  `infos_position` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `infos`
--

INSERT INTO `infos` (`infos_id`, `infos_key`, `infos_status`, `infos_position`) VALUES
(1, 'about', 1, 4),
(2, 'policy', 1, 1),
(3, 'terms', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `info_translations`
--

CREATE TABLE `info_translations` (
  `infos_trans_id` int(11) NOT NULL,
  `infos_id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `infos_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `infos_desc` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `info_translations`
--

INSERT INTO `info_translations` (`infos_trans_id`, `infos_id`, `locale`, `infos_title`, `infos_desc`) VALUES
(1, 1, 'ar', 'عن واين', '<p dir=\"rtl\"><strong>نص عن ابافيس</strong></p>\r\n\r\n<p dir=\"rtl\">&nbsp;</p>'),
(2, 1, 'en', 'about Wayn', '<div class=\"tw-nfl tw-ta-container\" id=\"tw-target-text-container\">\r\n<pre style=\"text-align:left\">\r\nText about abafes</pre>\r\n\r\n<p><img alt=\"\" src=\"                            \" /></p>\r\n</div>'),
(3, 2, 'ar', 'سياسة الاستخدام', '<p dir=\"rtl\">نص سياسة الاستخدام</p>\r\n\r\n<p dir=\"rtl\">&nbsp;</p>'),
(4, 2, 'en', 'Policy', '<p>text</p>'),
(5, 3, 'ar', 'الشروط', '<p dir=\"rtl\">نص الشروط الاحكام</p>'),
(6, 3, 'en', 'Terms', '<p>Text</p>');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `languages_id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `dir` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ltr' COMMENT '''ltr'' => left to right, ''rtl'' => right to left',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => stopped, 1 => active	',
  `position` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`languages_id`, `name`, `locale`, `dir`, `status`, `position`) VALUES
(1, 'English', 'en', 'ltr', 1, 2),
(2, 'Arabic', 'ar', 'rtl', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `metatags`
--

CREATE TABLE `metatags` (
  `metatags_id` mediumint(8) UNSIGNED NOT NULL,
  `metatags_page` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `metatags_position` int(10) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `metatags`
--

INSERT INTO `metatags` (`metatags_id`, `metatags_page`, `metatags_position`) VALUES
(22, 'home', 1),
(23, 'about', 1),
(24, 'privacy_policy', 1),
(25, 'terms_of_use', 1);

-- --------------------------------------------------------

--
-- Table structure for table `metatag_translations`
--

CREATE TABLE `metatag_translations` (
  `metatags_trans_id` mediumint(8) UNSIGNED NOT NULL,
  `metatags_id` mediumint(8) UNSIGNED NOT NULL,
  `locale` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `metatags_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `metatags_desc` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `metatag_translations`
--

INSERT INTO `metatag_translations` (`metatags_trans_id`, `metatags_id`, `locale`, `metatags_title`, `metatags_desc`) VALUES
(39, 22, 'ar', 'الصفحة الرئيسية', 'وصف الصفحة الرئيسية'),
(40, 22, 'en', 'Home Page', 'Home page Description'),
(41, 23, 'en', 'About Page title', '<p>About Page description</p>'),
(42, 23, 'ar', 'عنوان صفحة عن الموقع', '<p>وصف صفحة عن الموقع</p>'),
(43, 24, 'en', 'Privacy policy page title', 'Privacy policy page description'),
(44, 24, 'ar', 'عنوان صفحة سياسة الخصوصية', 'وصف صفحة سياسة الخصوصية'),
(49, 25, 'en', 'Terms of use page title', 'Terms of use page description'),
(50, 25, 'ar', 'عنوان صفحة شروط الاستخدام', 'وصف صفحة شروط الاستخدام');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_03_28_072431_create_permission_tables', 1),
(4, '2020_03_03_105118_create_notifications_table', 2),
(5, '2016_06_01_000001_create_oauth_auth_codes_table', 3),
(6, '2016_06_01_000002_create_oauth_access_tokens_table', 3),
(7, '2016_06_01_000003_create_oauth_refresh_tokens_table', 3),
(8, '2016_06_01_000004_create_oauth_clients_table', 3),
(9, '2016_06_01_000005_create_oauth_personal_access_clients_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'Modules\\Admin\\Models\\Admin', 1),
(2, 'App\\Models\\Admin', 4),
(2, 'Modules\\Admin\\Models\\Admin', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('040b8a0a-56a9-40bb-bd85-07deaaf2edaa', 'App\\Notifications\\Notifications', 'Modules\\Admin\\Models\\Client', 1, '{\"data\":{\"ar\":\"\\u0641\\u0631\\u064a\\u0634 \\u0633\\u0628\\u0627 \\u0643\\u0627\\u0645\\u0634\\u0627\\u062a\\u0643\\u0627 \\u0633\\u064a\\u0631\\u0648\\u0645 \\u0644\\u0644\\u062c\\u0633\\u0645 \\u0645\\u0636\\u0627\\u062f \\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u062a\\u0645\\u062f\\u062f \\u0627\\u0644\\u062c\\u0644\\u062f \\u0645\\u062a\\u0627\\u062d \\u0627\\u0644\\u0627\\u0646 \\u0641\\u064a \\u0645\\u062f\\u064a\\u062a\\u0643 \\u062a\\u0633\\u0637\\u064a\\u0639 \\u0637\\u0644\\u0628\\u0647 \\u0645\\u0646 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639 \",\"en\":\"\\u0641\\u0631\\u064a\\u0634 \\u0633\\u0628\\u0627 \\u0643\\u0627\\u0645\\u0634\\u0627\\u062a\\u0643\\u0627 \\u0633\\u064a\\u0631\\u0648\\u0645 \\u0644\\u0644\\u062c\\u0633\\u0645 \\u0645\\u0636\\u0627\\u062f \\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u062a\\u0645\\u062f\\u062f \\u0627\\u0644\\u062c\\u0644\\u062f  is now available in your city. You can order it from the website \",\"created_at\":\"01:29:03 2020-03-11\"},\"type\":\"products\",\"sender\":null}', '2020-03-11 11:29:37', '2020-03-11 11:29:03', '2020-03-11 11:29:37'),
('059e0c2e-b8d1-40d6-9f1f-7ab489b63217', 'App\\Notifications\\Notifications', 'Modules\\Consulting\\Models\\Pharmacist', 2, '{\"data\":{\"consultings_id\":\"24\",\"recipient_id\":\"2\",\"sender_id\":\"1\",\"messages_type\":\"0\",\"messages_text\":\"ertertert\",\"messages_updated_at\":\"2020-07-22 18:47:29\",\"messages_created_at\":\"2020-07-22 18:47:29\",\"messages_id\":322,\"ar\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f \\u0627\\u0631\\u0633\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"en\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f Send a new message .\",\"created_at\":\"06:47:30 2020-07-22\"},\"type\":\"message\",\"sender\":null}', NULL, '2020-07-22 16:47:30', '2020-07-22 16:47:30'),
('10ff3d26-ec3e-411e-890b-4924be55ea30', 'App\\Notifications\\Notifications', 'Modules\\Consulting\\Models\\Pharmacist', 2, '{\"data\":{\"consultings_id\":\"24\",\"recipient_id\":\"2\",\"sender_id\":\"1\",\"messages_type\":\"0\",\"messages_text\":\"\\u0633\\u0628\\u064a\\u0633\\u0644\\u0633\\u064a\\u0644\",\"messages_img\":\"1897329781595436238_download (1).png\",\"messages_updated_at\":\"2020-07-22 18:43:58\",\"messages_created_at\":\"2020-07-22 18:43:58\",\"messages_id\":318,\"ar\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f \\u0627\\u0631\\u0633\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"en\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f Send a new message .\",\"created_at\":\"06:44:00 2020-07-22\"},\"type\":\"message\",\"sender\":null}', NULL, '2020-07-22 16:44:00', '2020-07-22 16:44:00'),
('1355750b-d2d3-49ce-b6ca-edc804afb3aa', 'App\\Notifications\\Notifications', 'Modules\\Consulting\\Models\\Pharmacist', 2, '{\"data\":{\"consultings_id\":\"24\",\"recipient_id\":\"2\",\"sender_id\":\"1\",\"messages_type\":\"0\",\"messages_text\":\"reryueryuey\",\"messages_img\":\"8628992131595436435_WhatsApp Image 2020-07-06 at 12.48.50 AM.jpeg\",\"messages_updated_at\":\"2020-07-22 18:47:15\",\"messages_created_at\":\"2020-07-22 18:47:15\",\"messages_id\":320,\"ar\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f \\u0627\\u0631\\u0633\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"en\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f Send a new message .\",\"created_at\":\"06:47:16 2020-07-22\"},\"type\":\"message\",\"sender\":null}', NULL, '2020-07-22 16:47:16', '2020-07-22 16:47:16'),
('2cc8646c-554b-4d65-b04f-e93accc81b20', 'App\\Notifications\\Notifications', 'Modules\\Admin\\Models\\Client', 1, '{\"data\":{\"consultings_id\":\"23\",\"recipient_id\":\"1\",\"sender_id\":\"1\",\"messages_type\":\"1\",\"messages_text\":\"l\",\"messages_updated_at\":\"2020-03-23 14:49:25\",\"messages_created_at\":\"2020-03-23 14:49:25\",\"messages_id\":298,\"ar\":\"\\u062f\\u0643\\u062a\\u0648\\u0631 \\u0645\\u062d\\u0645\\u062f \\u0627\\u0644\\u0639\\u0646\\u0627\\u0646\\u064a \\u0627\\u0631\\u0633\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"en\":\"\\u062f\\u0643\\u062a\\u0648\\u0631 \\u0645\\u062d\\u0645\\u062f \\u0627\\u0644\\u0639\\u0646\\u0627\\u0646\\u064a Send a new message .\",\"created_at\":\"02:49:26 2020-03-23\"},\"type\":\"message\",\"sender\":null}', '2020-03-23 13:34:37', '2020-03-23 12:49:26', '2020-03-23 13:34:37'),
('2ced7790-f020-48a5-880e-9728c9c0a456', 'App\\Notifications\\Notifications', 'Modules\\Consulting\\Models\\Pharmacist', 2, '{\"data\":{\"consultings_id\":\"24\",\"recipient_id\":\"2\",\"sender_id\":\"1\",\"messages_type\":\"0\",\"messages_text\":\"\\u0627\\u0644\\u0633\\u0644\\u0627\\u0645 \\u0639\\u0644\\u064a\\u0643\\u0645\",\"messages_updated_at\":\"2020-03-23 13:30:58\",\"messages_created_at\":\"2020-03-23 13:30:58\",\"messages_id\":296,\"ar\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f \\u0627\\u0631\\u0633\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"en\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f Send a new message .\",\"created_at\":\"01:30:59 2020-03-23\"},\"type\":\"message\",\"sender\":null}', NULL, '2020-03-23 11:30:59', '2020-03-23 11:30:59'),
('32cc0205-b9a7-473b-8e30-948c630dce67', 'App\\Notifications\\Notifications', 'Modules\\Admin\\Models\\Client', 1, '{\"data\":{\"ar\":\" \\u0644\\u0642\\u062f \\u0646\\u0641\\u0630\\u062a \\u0627\\u0644\\u0643\\u0645\\u064a\\u0629 \\u0627\\u0644\\u0645\\u062a\\u0627\\u062d\\u0629 \\u0645\\u0646 \\u062c\\u0648\\u0628\\u0644 \\u0628\\u0627\\u0631\\u064a\\u0633 \\u0645\\u062c\\u0645\\u0648\\u0639\\u0629 \\u0627\\u0644\\u0639\\u0646\\u0627\\u064a\\u0629 \\u0628\\u0627\\u0644\\u0628\\u0634\\u0631\\u0629 ,300 \\u0645\\u0644 \\u0644\\u062f\\u064a\\u0643 \\u064a\\u0645\\u0643\\u0646\\u0643 \\u0637\\u0644\\u0628\\u0647 \\u0627\\u0644\\u0627\\u0646 \\u0645\\u0646 \\u062e\\u0644\\u0627\\u0644 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639  \",\"en\":\" You have run out of available \\u062c\\u0648\\u0628\\u0644 \\u0628\\u0627\\u0631\\u064a\\u0633 \\u0645\\u062c\\u0645\\u0648\\u0639\\u0629 \\u0627\\u0644\\u0639\\u0646\\u0627\\u064a\\u0629 \\u0628\\u0627\\u0644\\u0628\\u0634\\u0631\\u0629 ,300 \\u0645\\u0644 , you can order it now through the website \",\"created_at\":\"12:52:37 2020-03-11\"},\"type\":\"reminder_dose\",\"sender\":null}', '2020-03-11 10:52:40', '2020-03-11 10:52:37', '2020-03-11 10:52:40'),
('3381db01-fb55-4f5c-8d4b-414b515e7f40', 'App\\Notifications\\Notifications', 'Modules\\Consulting\\Models\\Pharmacist', 5, '{\"data\":{\"consultings_id\":\"25\",\"recipient_id\":\"5\",\"sender_id\":\"1\",\"messages_type\":\"0\",\"messages_text\":\"\\u0627\\u0644\\u0633\\u0644\\u0627\\u0645 \\u0639\\u0644\\u064a\\u0643\\u0645 \\u064a\\u0627 \\u062f\\u0643\\u062a\\u0648\\u0631\",\"messages_updated_at\":\"2020-03-23 15:28:56\",\"messages_created_at\":\"2020-03-23 15:28:56\",\"messages_id\":300,\"ar\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f \\u0627\\u0631\\u0633\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"en\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f Send a new message .\",\"created_at\":\"03:28:57 2020-03-23\"},\"type\":\"message\",\"sender\":null}', NULL, '2020-03-23 13:28:57', '2020-03-23 13:28:57'),
('3adbb911-fa38-4840-90d4-1959d9a61718', 'App\\Notifications\\Notifications', 'Modules\\Consulting\\Models\\Pharmacist', 2, '{\"data\":{\"consultings_id\":\"24\",\"recipient_id\":\"2\",\"sender_id\":\"1\",\"messages_type\":\"0\",\"messages_text\":null,\"messages_updated_at\":\"2020-07-22 18:51:32\",\"messages_created_at\":\"2020-07-22 18:51:32\",\"messages_id\":324,\"ar\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f \\u0627\\u0631\\u0633\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"en\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f Send a new message .\",\"created_at\":\"06:51:34 2020-07-22\"},\"type\":\"message\",\"sender\":null}', NULL, '2020-07-22 16:51:34', '2020-07-22 16:51:34'),
('4575dfb2-16e4-47a5-a853-68280302cbe8', 'App\\Notifications\\Notifications', 'Modules\\Consulting\\Models\\Pharmacist', 2, '{\"data\":{\"consultings_id\":\"24\",\"recipient_id\":\"2\",\"sender_id\":\"1\",\"messages_type\":\"0\",\"messages_text\":\"\\u064a\\u0628\\u0644\\u0628\\u064a\\u0644\\u064a\\u0628\",\"messages_img\":\"7190533741595433468_download (1).png\",\"messages_updated_at\":\"2020-07-22 17:57:49\",\"messages_created_at\":\"2020-07-22 17:57:49\",\"messages_id\":312,\"ar\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f \\u0627\\u0631\\u0633\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"en\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f Send a new message .\",\"created_at\":\"05:57:50 2020-07-22\"},\"type\":\"message\",\"sender\":null}', NULL, '2020-07-22 15:57:50', '2020-07-22 15:57:50'),
('4fb58ffd-f531-4009-8dc3-48e33f7af90e', 'App\\Notifications\\Notifications', 'Modules\\Consulting\\Models\\Pharmacist', 2, '{\"data\":{\"consultings_id\":\"24\",\"recipient_id\":\"2\",\"sender_id\":\"1\",\"messages_type\":\"0\",\"messages_text\":null,\"messages_img\":\"3103959451595435734_WhatsApp Image 2020-07-06 at 12.48.50 AM.jpeg\",\"messages_updated_at\":\"2020-07-22 18:35:34\",\"messages_created_at\":\"2020-07-22 18:35:34\",\"messages_id\":316,\"ar\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f \\u0627\\u0631\\u0633\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"en\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f Send a new message .\",\"created_at\":\"06:35:36 2020-07-22\"},\"type\":\"message\",\"sender\":null}', NULL, '2020-07-22 16:35:36', '2020-07-22 16:35:36'),
('645d703d-e10c-490f-a927-aa028462a32d', 'App\\Notifications\\Notifications', 'Modules\\Consulting\\Models\\Pharmacist', 2, '{\"data\":{\"consultings_id\":\"24\",\"recipient_id\":\"2\",\"sender_id\":\"1\",\"messages_type\":\"0\",\"messages_text\":\"\\u0627\\u0644\\u0633\\u0644\\u0627\\u0645 \\u0639\\u0644\\u064a\\u0643\\u0645\",\"messages_updated_at\":\"2020-03-23 13:30:54\",\"messages_created_at\":\"2020-03-23 13:30:54\",\"messages_id\":295,\"ar\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f \\u0627\\u0631\\u0633\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"en\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f Send a new message .\",\"created_at\":\"01:30:56 2020-03-23\"},\"type\":\"message\",\"sender\":null}', NULL, '2020-03-23 11:30:57', '2020-03-23 11:30:57'),
('6aaff4f8-81a5-4783-985a-bc711763b376', 'App\\Notifications\\Notifications', 'Modules\\Admin\\Models\\Client', 1, '{\"data\":{\"ar\":\"\\u062d\\u0627\\u0646 \\u0645\\u0648\\u0639\\u062f \\u062c\\u0631\\u0639\\u0629 \\u0627\\u0644\\u062e\\u0627\\u0635\\u0629 \\u0628 \\u062c\\u0648\\u0628\\u0644 \\u0628\\u0627\\u0631\\u064a\\u0633 \\u0645\\u062c\\u0645\\u0648\\u0639\\u0629 \\u0627\\u0644\\u0639\\u0646\\u0627\\u064a\\u0629 \\u0628\\u0627\\u0644\\u0628\\u0634\\u0631\\u0629 ,300 \\u0645\\u0644 \\u064a\\u062c\\u0628 \\u0627\\u062e\\u0630 \\u0627\\u0644\\u062c\\u0631\\u0639\\u0629 \\u0627\\u0644\\u0627\\u0646 \",\"en\":\"It\'s time for a dose for \\u062c\\u0648\\u0628\\u0644 \\u0628\\u0627\\u0631\\u064a\\u0633 \\u0645\\u062c\\u0645\\u0648\\u0639\\u0629 \\u0627\\u0644\\u0639\\u0646\\u0627\\u064a\\u0629 \\u0628\\u0627\\u0644\\u0628\\u0634\\u0631\\u0629 ,300 \\u0645\\u0644. The dose should be taken now \",\"created_at\":\"12:47:05 2020-03-11\"},\"type\":\"reminder_dose\",\"sender\":null}', '2020-03-11 10:47:10', '2020-03-11 10:47:05', '2020-03-11 10:47:10'),
('735288c9-c59c-4065-83a8-3833e6f29993', 'App\\Notifications\\Notifications', 'Modules\\Consulting\\Models\\Pharmacist', 5, '{\"data\":{\"ar\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f \\u0628\\u062f\\u0623 \\u0634\\u0627\\u062a \\u062c\\u062f\\u064a\\u062f\",\"en\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f start a new consulting \",\"created_at\":\"03:28:35 2020-03-23\"},\"type\":\"startChat\",\"sender\":null}', NULL, '2020-03-23 13:28:35', '2020-03-23 13:28:35'),
('76253622-1c01-4595-a839-f7fd468b1066', 'App\\Notifications\\Notifications', 'Modules\\Admin\\Models\\Client', 1, '{\"data\":{\"ar\":\"\\u0641\\u0631\\u064a\\u0634 \\u0633\\u0628\\u0627 \\u0643\\u0627\\u0645\\u0634\\u0627\\u062a\\u0643\\u0627 \\u0633\\u064a\\u0631\\u0648\\u0645 \\u0644\\u0644\\u062c\\u0633\\u0645 \\u0645\\u0636\\u0627\\u062f \\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u062a\\u0645\\u062f\\u062f \\u0627\\u0644\\u062c\\u0644\\u062f \\u0645\\u062a\\u0627\\u062d \\u0627\\u0644\\u0627\\u0646 \\u0641\\u064a \\u0645\\u062f\\u064a\\u062a\\u0643 \\u062a\\u0633\\u0637\\u064a\\u0639 \\u0637\\u0644\\u0628\\u0647 \\u0645\\u0646 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639 \",\"en\":\"\\u0641\\u0631\\u064a\\u0634 \\u0633\\u0628\\u0627 \\u0643\\u0627\\u0645\\u0634\\u0627\\u062a\\u0643\\u0627 \\u0633\\u064a\\u0631\\u0648\\u0645 \\u0644\\u0644\\u062c\\u0633\\u0645 \\u0645\\u0636\\u0627\\u062f \\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u062a\\u0645\\u062f\\u062f \\u0627\\u0644\\u062c\\u0644\\u062f  is now available in your city. You can order it from the website \",\"created_at\":\"01:47:41 2020-03-11\"},\"type\":\"products\",\"sender\":null}', '2020-03-11 11:47:57', '2020-03-11 11:47:41', '2020-03-11 11:47:57'),
('7c59a0e1-5878-4304-aca0-5abc84df0ace', 'App\\Notifications\\Notifications', 'Modules\\Consulting\\Models\\Pharmacist', 2, '{\"data\":{\"consultings_id\":\"24\",\"recipient_id\":\"2\",\"sender_id\":\"1\",\"messages_type\":\"0\",\"messages_text\":\"\\u062f\\u064a \\u0627\\u0644\\u0635\\u0648\\u0631\\u0629 \\u064a\\u0627 \\u062f\\u0643\\u062a\\u0648\\u0631\",\"messages_img\":\"2975903351595435957_download (1).png\",\"messages_updated_at\":\"2020-07-22 18:39:17\",\"messages_created_at\":\"2020-07-22 18:39:17\",\"messages_id\":317,\"ar\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f \\u0627\\u0631\\u0633\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"en\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f Send a new message .\",\"created_at\":\"06:39:18 2020-07-22\"},\"type\":\"message\",\"sender\":null}', NULL, '2020-07-22 16:39:18', '2020-07-22 16:39:18'),
('7da42b9b-c28e-401d-977e-b6f04954fbea', 'App\\Notifications\\Notifications', 'Modules\\Admin\\Models\\Client', 1, '{\"data\":{\"ar\":\"\\u0641\\u0631\\u064a\\u0634 \\u0633\\u0628\\u0627 \\u0643\\u0627\\u0645\\u0634\\u0627\\u062a\\u0643\\u0627 \\u0633\\u064a\\u0631\\u0648\\u0645 \\u0644\\u0644\\u062c\\u0633\\u0645 \\u0645\\u0636\\u0627\\u062f \\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u062a\\u0645\\u062f\\u062f \\u0627\\u0644\\u062c\\u0644\\u062f \\u0645\\u062a\\u0627\\u062d \\u0627\\u0644\\u0627\\u0646 \\u0641\\u064a \\u0645\\u062f\\u064a\\u062a\\u0643 \\u062a\\u0633\\u0637\\u064a\\u0639 \\u0637\\u0644\\u0628\\u0647 \\u0645\\u0646 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639 \",\"en\":\"\\u0641\\u0631\\u064a\\u0634 \\u0633\\u0628\\u0627 \\u0643\\u0627\\u0645\\u0634\\u0627\\u062a\\u0643\\u0627 \\u0633\\u064a\\u0631\\u0648\\u0645 \\u0644\\u0644\\u062c\\u0633\\u0645 \\u0645\\u0636\\u0627\\u062f \\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u062a\\u0645\\u062f\\u062f \\u0627\\u0644\\u062c\\u0644\\u062f  is now available in your city. You can order it from the website \",\"created_at\":\"01:29:45 2020-03-11\"},\"type\":\"products\",\"sender\":null}', '2020-03-11 11:29:50', '2020-03-11 11:29:45', '2020-03-11 11:29:50'),
('7f6e0f5d-73db-46e3-8503-e462ce33de62', 'App\\Notifications\\Notifications', 'Modules\\Consulting\\Models\\Pharmacist', 2, '{\"data\":{\"consultings_id\":\"24\",\"recipient_id\":\"2\",\"sender_id\":\"1\",\"messages_type\":\"0\",\"messages_text\":null,\"messages_img\":\"8983220111595436613_Design4.png\",\"messages_updated_at\":\"2020-07-22 18:50:13\",\"messages_created_at\":\"2020-07-22 18:50:13\",\"messages_id\":323,\"ar\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f \\u0627\\u0631\\u0633\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"en\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f Send a new message .\",\"created_at\":\"06:50:14 2020-07-22\"},\"type\":\"message\",\"sender\":null}', NULL, '2020-07-22 16:50:14', '2020-07-22 16:50:14'),
('86196678-4a40-4067-9a71-f17e5a238f75', 'App\\Notifications\\Notifications', 'Modules\\Consulting\\Models\\Pharmacist', 2, '{\"data\":{\"consultings_id\":\"24\",\"recipient_id\":\"2\",\"sender_id\":\"1\",\"messages_type\":\"0\",\"messages_text\":\"sdf\",\"messages_img\":\"7371656381595435317_3523525523-XL.jpg\",\"messages_updated_at\":\"2020-07-22 18:28:37\",\"messages_created_at\":\"2020-07-22 18:28:37\",\"messages_id\":314,\"ar\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f \\u0627\\u0631\\u0633\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"en\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f Send a new message .\",\"created_at\":\"06:28:38 2020-07-22\"},\"type\":\"message\",\"sender\":null}', NULL, '2020-07-22 16:28:38', '2020-07-22 16:28:38'),
('923b9145-042a-4360-ae30-14965c235c66', 'App\\Notifications\\Notifications', 'Modules\\Consulting\\Models\\Pharmacist', 2, '{\"data\":{\"consultings_id\":\"24\",\"recipient_id\":\"2\",\"sender_id\":\"1\",\"messages_type\":\"0\",\"messages_text\":\"\\u064a\\u0628\\u0644\\u0628\\u064a\\u0644\\u064a\\u0628\",\"messages_img\":\"5783908481595433468_download (1).png\",\"messages_updated_at\":\"2020-07-22 17:57:49\",\"messages_created_at\":\"2020-07-22 17:57:49\",\"messages_id\":313,\"ar\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f \\u0627\\u0631\\u0633\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"en\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f Send a new message .\",\"created_at\":\"05:57:50 2020-07-22\"},\"type\":\"message\",\"sender\":null}', NULL, '2020-07-22 15:57:50', '2020-07-22 15:57:50'),
('a180e21d-c6b8-4236-b2a6-58c2e7e7804e', 'App\\Notifications\\Notifications', 'Modules\\Admin\\Models\\Client', 1, '{\"data\":{\"ar\":\"\\u062d\\u0627\\u0646 \\u0645\\u0648\\u0639\\u062f \\u062c\\u0631\\u0639\\u0629 \\u0627\\u0644\\u062e\\u0627\\u0635\\u0629 \\u0628 \\u062c\\u0648\\u0628\\u0644 \\u0628\\u0627\\u0631\\u064a\\u0633 \\u0645\\u062c\\u0645\\u0648\\u0639\\u0629 \\u0627\\u0644\\u0639\\u0646\\u0627\\u064a\\u0629 \\u0628\\u0627\\u0644\\u0628\\u0634\\u0631\\u0629 ,300 \\u0645\\u0644 \\u064a\\u062c\\u0628 \\u0627\\u062e\\u0630 \\u0627\\u0644\\u062c\\u0631\\u0639\\u0629 \\u0627\\u0644\\u0627\\u0646 \",\"en\":\"It\'s time for a dose for \\u062c\\u0648\\u0628\\u0644 \\u0628\\u0627\\u0631\\u064a\\u0633 \\u0645\\u062c\\u0645\\u0648\\u0639\\u0629 \\u0627\\u0644\\u0639\\u0646\\u0627\\u064a\\u0629 \\u0628\\u0627\\u0644\\u0628\\u0634\\u0631\\u0629 ,300 \\u0645\\u0644. The dose should be taken now \",\"created_at\":\"12:51:45 2020-03-11\"},\"type\":\"reminder_dose\",\"sender\":null}', '2020-03-11 10:51:48', '2020-03-11 10:51:45', '2020-03-11 10:51:48'),
('aea38f67-2608-4053-b0b0-9f5b2d26819c', 'App\\Notifications\\Notifications', 'Modules\\Consulting\\Models\\Pharmacist', 2, '{\"data\":{\"consultings_id\":\"24\",\"recipient_id\":\"2\",\"sender_id\":\"1\",\"messages_type\":\"0\",\"messages_text\":null,\"messages_updated_at\":\"2020-07-22 18:47:22\",\"messages_created_at\":\"2020-07-22 18:47:22\",\"messages_id\":321,\"ar\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f \\u0627\\u0631\\u0633\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"en\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f Send a new message .\",\"created_at\":\"06:47:23 2020-07-22\"},\"type\":\"message\",\"sender\":null}', NULL, '2020-07-22 16:47:23', '2020-07-22 16:47:23'),
('bafb5762-f827-4455-9e8e-3c62303d0416', 'App\\Notifications\\Notifications', 'Modules\\Admin\\Models\\Client', 1, '{\"data\":{\"ar\":\"\\u0641\\u0631\\u064a\\u0634 \\u0633\\u0628\\u0627 \\u0643\\u0627\\u0645\\u0634\\u0627\\u062a\\u0643\\u0627 \\u0633\\u064a\\u0631\\u0648\\u0645 \\u0644\\u0644\\u062c\\u0633\\u0645 \\u0645\\u0636\\u0627\\u062f \\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u062a\\u0645\\u062f\\u062f \\u0627\\u0644\\u062c\\u0644\\u062f \\u0645\\u062a\\u0627\\u062d \\u0627\\u0644\\u0627\\u0646 \\u0641\\u064a \\u0645\\u062f\\u064a\\u062a\\u0643 \\u062a\\u0633\\u0637\\u064a\\u0639 \\u0637\\u0644\\u0628\\u0647 \\u0645\\u0646 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639 \",\"en\":\"\\u0641\\u0631\\u064a\\u0634 \\u0633\\u0628\\u0627 \\u0643\\u0627\\u0645\\u0634\\u0627\\u062a\\u0643\\u0627 \\u0633\\u064a\\u0631\\u0648\\u0645 \\u0644\\u0644\\u062c\\u0633\\u0645 \\u0645\\u0636\\u0627\\u062f \\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u062a\\u0645\\u062f\\u062f \\u0627\\u0644\\u062c\\u0644\\u062f  is now available in your city. You can order it from the website \",\"created_at\":\"01:23:35 2020-03-11\"},\"type\":\"products\",\"sender\":null}', '2020-03-11 11:23:49', '2020-03-11 11:23:35', '2020-03-11 11:23:49'),
('bf43658c-f2c7-4a29-9cea-529c8a1d4416', 'App\\Notifications\\Notifications', 'Modules\\Admin\\Models\\Client', 1, '{\"data\":{\"ar\":\"\\u0641\\u0631\\u064a\\u0634 \\u0633\\u0628\\u0627 \\u0643\\u0627\\u0645\\u0634\\u0627\\u062a\\u0643\\u0627 \\u0633\\u064a\\u0631\\u0648\\u0645 \\u0644\\u0644\\u062c\\u0633\\u0645 \\u0645\\u0636\\u0627\\u062f \\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u062a\\u0645\\u062f\\u062f \\u0627\\u0644\\u062c\\u0644\\u062f \\u0645\\u062a\\u0627\\u062d \\u0627\\u0644\\u0627\\u0646 \\u0641\\u064a \\u0645\\u062f\\u064a\\u062a\\u0643 \\u062a\\u0633\\u0637\\u064a\\u0639 \\u0637\\u0644\\u0628\\u0647 \\u0645\\u0646 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639 \",\"en\":\"\\u0641\\u0631\\u064a\\u0634 \\u0633\\u0628\\u0627 \\u0643\\u0627\\u0645\\u0634\\u0627\\u062a\\u0643\\u0627 \\u0633\\u064a\\u0631\\u0648\\u0645 \\u0644\\u0644\\u062c\\u0633\\u0645 \\u0645\\u0636\\u0627\\u062f \\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u062a\\u0645\\u062f\\u062f \\u0627\\u0644\\u062c\\u0644\\u062f  is now available in your city. You can order it from the website \",\"created_at\":\"01:27:00 2020-03-11\"},\"type\":\"products\",\"sender\":null}', '2020-03-11 11:27:03', '2020-03-11 11:27:00', '2020-03-11 11:27:03'),
('c05b4937-f824-4b96-856a-ab6b1f4a3968', 'App\\Notifications\\Notifications', 'Modules\\Admin\\Models\\Client', 1, '{\"data\":{\"ar\":\"\\u0641\\u0631\\u064a\\u0634 \\u0633\\u0628\\u0627 \\u0643\\u0627\\u0645\\u0634\\u0627\\u062a\\u0643\\u0627 \\u0633\\u064a\\u0631\\u0648\\u0645 \\u0644\\u0644\\u062c\\u0633\\u0645 \\u0645\\u0636\\u0627\\u062f \\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u062a\\u0645\\u062f\\u062f \\u0627\\u0644\\u062c\\u0644\\u062f \\u0645\\u062a\\u0627\\u062d \\u0627\\u0644\\u0627\\u0646 \\u0641\\u064a \\u0645\\u062f\\u064a\\u062a\\u0643 \\u062a\\u0633\\u0637\\u064a\\u0639 \\u0637\\u0644\\u0628\\u0647 \\u0645\\u0646 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639 \",\"en\":\"\\u0641\\u0631\\u064a\\u0634 \\u0633\\u0628\\u0627 \\u0643\\u0627\\u0645\\u0634\\u0627\\u062a\\u0643\\u0627 \\u0633\\u064a\\u0631\\u0648\\u0645 \\u0644\\u0644\\u062c\\u0633\\u0645 \\u0645\\u0636\\u0627\\u062f \\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u062a\\u0645\\u062f\\u062f \\u0627\\u0644\\u062c\\u0644\\u062f  is now available in your city. You can order it from the website \",\"created_at\":\"01:28:28 2020-03-11\"},\"type\":\"products\",\"sender\":null}', '2020-03-11 11:29:37', '2020-03-11 11:28:28', '2020-03-11 11:29:37'),
('c0bc2851-b900-4026-b1b3-8a005633a972', 'App\\Notifications\\Notifications', 'Modules\\Consulting\\Models\\Pharmacist', 2, '{\"data\":{\"ar\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f \\u0628\\u062f\\u0623 \\u0634\\u0627\\u062a \\u062c\\u062f\\u064a\\u062f\",\"en\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f start a new consulting \",\"created_at\":\"06:27:13 2020-03-22\"},\"type\":\"startChat\",\"sender\":null}', NULL, '2020-03-22 16:27:14', '2020-03-22 16:27:14'),
('d19255da-75a6-4359-a03b-bcc04f826964', 'App\\Notifications\\Notifications', 'Modules\\Admin\\Models\\Client', 1, '{\"data\":{\"consultings_id\":\"23\",\"recipient_id\":\"1\",\"sender_id\":\"1\",\"messages_type\":\"1\",\"messages_text\":\"\\u0627\\u0647\\u0644\\u0627 \\u0648\\u0633\\u0647\\u0644\\u0627 \\u0627\\u0647\\u0644\\u0627 \\u0648\\u0633\\u0647\\u0644\\u0627 \\u0627\\u0647\\u0644\\u0627 \\u0648\\u0633\\u0647\\u0644\\u0627 \\u0627\\u0647\\u0644\\u0627 \\u0648\\u0633\\u0647\\u0644\\u0627 \\u0627\\u0647\\u0644\\u0627 \\u0648\\u0633\\u0647\\u0644\\u0627 \\u0627\\u0647\\u0644\\u0627 \\u0648\\u0633\\u0647\\u0644\\u0627 \\u0627\\u0647\\u0644\\u0627 \\u0648\\u0633\\u0647\\u0644\\u0627 \\u0627\\u0647\\u0644\\u0627 \\u0648\\u0633\\u0647\\u0644\\u0627 \\u0627\\u0647\\u0644\\u0627 \\u0648\\u0633\\u0647\\u0644\\u0627 \\u0627\\u0647\\u0644\\u0627 \\u0648\\u0633\\u0647\\u0644\\u0627 \\u0627\\u0647\\u0644\\u0627 \\u0648\\u0633\\u0647\\u0644\\u0627\",\"messages_updated_at\":\"2020-03-23 14:51:59\",\"messages_created_at\":\"2020-03-23 14:51:59\",\"messages_id\":299,\"ar\":\"\\u062f\\u0643\\u062a\\u0648\\u0631 \\u0645\\u062d\\u0645\\u062f \\u0627\\u0644\\u0639\\u0646\\u0627\\u0646\\u064a \\u0627\\u0631\\u0633\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"en\":\"\\u062f\\u0643\\u062a\\u0648\\u0631 \\u0645\\u062d\\u0645\\u062f \\u0627\\u0644\\u0639\\u0646\\u0627\\u0646\\u064a Send a new message .\",\"created_at\":\"02:52:00 2020-03-23\"},\"type\":\"message\",\"sender\":null}', '2020-03-23 13:34:37', '2020-03-23 12:52:00', '2020-03-23 13:34:37'),
('d3619e4e-daac-45e0-93e4-e282cee438e5', 'App\\Notifications\\Notifications', 'Modules\\Consulting\\Models\\Pharmacist', 2, '{\"data\":{\"consultings_id\":\"24\",\"recipient_id\":\"2\",\"sender_id\":\"1\",\"messages_type\":\"0\",\"messages_text\":\"\\u0644\\u064a\\u0628\\u0644\\u064a\\u0644\",\"messages_img\":\"6901762341595436247_download (1).png\",\"messages_updated_at\":\"2020-07-22 18:44:07\",\"messages_created_at\":\"2020-07-22 18:44:07\",\"messages_id\":319,\"ar\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f \\u0627\\u0631\\u0633\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"en\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f Send a new message .\",\"created_at\":\"06:44:08 2020-07-22\"},\"type\":\"message\",\"sender\":null}', NULL, '2020-07-22 16:44:08', '2020-07-22 16:44:08'),
('e3e322cc-30a6-4901-94d0-dd11941ba0b2', 'App\\Notifications\\Notifications', 'Modules\\Consulting\\Models\\Pharmacist', 2, '{\"data\":{\"consultings_id\":\"24\",\"recipient_id\":\"2\",\"sender_id\":\"1\",\"messages_type\":\"0\",\"messages_text\":\"\\u0644\\u0633\\u064a\\u0644\\u0633\\u064a\\u0644\",\"messages_img\":\"218130541595432255_download (1).png\",\"messages_updated_at\":\"2020-07-22 17:37:38\",\"messages_created_at\":\"2020-07-22 17:37:38\",\"messages_id\":311,\"ar\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f \\u0627\\u0631\\u0633\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"en\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f Send a new message .\",\"created_at\":\"05:37:41 2020-07-22\"},\"type\":\"message\",\"sender\":null}', NULL, '2020-07-22 15:37:43', '2020-07-22 15:37:43'),
('e4b7ddf9-42ac-4471-82c6-9c11d637260f', 'App\\Notifications\\Notifications', 'Modules\\Consulting\\Models\\Pharmacist', 5, '{\"data\":{\"consultings_id\":\"25\",\"recipient_id\":\"5\",\"sender_id\":\"1\",\"messages_type\":\"0\",\"messages_text\":\"\\u0627\\u062e\\u0628\\u0627\\u0631 \\u062d\\u0636\\u0631\\u062a\\u0643 \\u064a\\u0627 \\u062f\\u0643\\u062a\\u0648\\u0631\",\"messages_updated_at\":\"2020-03-23 15:34:18\",\"messages_created_at\":\"2020-03-23 15:34:18\",\"messages_id\":301,\"ar\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f \\u0627\\u0631\\u0633\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"en\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f Send a new message .\",\"created_at\":\"03:34:19 2020-03-23\"},\"type\":\"message\",\"sender\":null}', NULL, '2020-03-23 13:34:19', '2020-03-23 13:34:19'),
('efb935f3-e369-4314-96fa-5a8b93b5a38d', 'App\\Notifications\\Notifications', 'Modules\\Consulting\\Models\\Pharmacist', 2, '{\"data\":{\"consultings_id\":\"24\",\"recipient_id\":\"2\",\"sender_id\":\"1\",\"messages_type\":\"0\",\"messages_text\":\"fstwtwet\",\"messages_updated_at\":\"2020-03-23 14:19:07\",\"messages_created_at\":\"2020-03-23 14:19:07\",\"messages_id\":297,\"ar\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f \\u0627\\u0631\\u0633\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"en\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f Send a new message .\",\"created_at\":\"02:19:08 2020-03-23\"},\"type\":\"message\",\"sender\":null}', NULL, '2020-03-23 12:19:08', '2020-03-23 12:19:08'),
('facbde8c-1051-4956-ab0c-e5cf20717d6b', 'App\\Notifications\\Notifications', 'Modules\\Consulting\\Models\\Pharmacist', 2, '{\"data\":{\"consultings_id\":\"24\",\"recipient_id\":\"2\",\"sender_id\":\"1\",\"messages_type\":\"0\",\"messages_text\":null,\"messages_img\":\"5039052451595435625_WhatsApp Image 2020-07-06 at 12.30.45 AM.jpeg\",\"messages_updated_at\":\"2020-07-22 18:33:46\",\"messages_created_at\":\"2020-07-22 18:33:46\",\"messages_id\":315,\"ar\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f \\u0627\\u0631\\u0633\\u0644 \\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \",\"en\":\"\\u062d\\u0633\\u0646 \\u0645\\u062d\\u0645\\u062f Send a new message .\",\"created_at\":\"06:33:48 2020-07-22\"},\"type\":\"message\",\"sender\":null}', NULL, '2020-07-22 16:33:48', '2020-07-22 16:33:48');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('0d9b562e57b8c5593d670142b2b97433c9e0918db7747d2cdb4b2213e4c5fd303e386fa4f5791a6f', 8, 3, 'Wayn', '[]', 0, '2020-11-18 08:54:02', '2020-11-18 08:54:02', '2021-11-18 10:54:02'),
('0f397dee4d6b104be0d001d30f7adcc9a47f97d79c07d93a2dabc6962958bd07b3eaa9c740c20c74', 8, 3, 'Wayn', '[]', 0, '2020-11-18 08:53:56', '2020-11-18 08:53:56', '2021-11-18 10:53:56'),
('177573abbe4d5a5ac614db35d69bb48f0cd9ff3b7b711278fdeb6917ab4b11bfdca0177f663d44c1', 8, 3, 'Wayn', '[]', 0, '2020-11-17 14:50:26', '2020-11-17 14:50:26', '2021-11-17 16:50:26'),
('1f9cbd0e24e307cf62eeeadbe0406c3a60aeace862717e5fc53921bc738fb9b3585620f688f0849f', 2, 3, 'Wayn', '[]', 0, '2020-11-03 12:46:42', '2020-11-03 12:46:42', '2021-11-03 14:46:42'),
('3047d27d675778881ecfea4220b0d047b419c9db4e42a9a3bcf8b95dd3aaa198232c5b16343e627d', 2, 3, 'Wayn', '[]', 0, '2020-11-03 19:20:34', '2020-11-03 19:20:34', '2021-11-03 21:20:34'),
('3a652abd50f61ddd8d7896a4abdf4ee8265400df4616e74ae63c8127fcf1639eca684642ad39963f', 2, 3, 'Wayn', '[]', 1, '2020-11-03 11:43:09', '2020-11-03 11:43:09', '2021-11-03 13:43:09'),
('426273e4141494a763c7a23e69659c35707dbe98ce2429eac44cf291b528637aecad880103ffa202', 2, 3, 'Wayn', '[]', 0, '2020-11-17 13:49:49', '2020-11-17 13:49:49', '2021-11-17 15:49:49'),
('7607de3efc189309ed42f5e0787cb753b1392888dbd62c99fb761c271c8f4db936fdef49cd05b712', 1, 3, 'Personal Access Token', '[]', 0, '2020-11-02 10:58:56', '2020-11-02 10:58:56', '2020-11-09 12:58:56'),
('983eab1b21eff54fb8579410c27ccd8923e0808433e07d46926cc4295382da0fcd49ef92fb500e81', 2, 3, 'Wayn', '[]', 1, '2020-11-03 11:47:42', '2020-11-03 11:47:42', '2021-11-03 13:47:42'),
('d55dc2758714430f28a876e7edd1d4def63fc1fd7e96f26276aa54c94561d0e1099b5a858f8cfcaa', 8, 3, 'Wayn', '[]', 0, '2020-11-18 08:53:44', '2020-11-18 08:53:44', '2021-11-18 10:53:44');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(3, NULL, 'Laravel Personal Access Client', 'Lt1gkHHsurIIutK32uBuxd3zvqerDSWvcF7P4WmL', NULL, 'http://localhost', 1, 0, 0, '2020-11-02 10:56:32', '2020-11-02 10:56:32'),
(4, NULL, 'Laravel Password Grant Client', 'rRJC2IVMNDqutvSj3tuye00A5cHf4f1uGj1NR0K0', NULL, 'http://localhost', 0, 1, 0, '2020-11-02 10:56:33', '2020-11-02 10:56:33');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(2, 3, '2020-11-02 10:56:32', '2020-11-02 10:56:32');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `page`, `action`, `position`, `created_at`, `updated_at`) VALUES
(1, 'view infos', 'admin', 'infos', 'view', 101, '2019-06-19 00:25:51', '2019-06-19 00:25:51'),
(2, 'update infos', 'admin', 'infos', 'update', 102, '2019-06-19 00:25:52', '2019-06-19 00:25:52'),
(12, 'create admins', 'admin', 'admins', 'create', 402, '2019-06-19 00:25:52', '2019-06-19 00:25:52'),
(13, 'update admins', 'admin', 'admins', 'update', 403, '2019-06-19 00:25:52', '2019-06-19 00:25:52'),
(14, 'delete admins', 'admin', 'admins', 'delete', 404, '2019-06-19 00:25:52', '2019-06-19 00:25:52'),
(15, 'view roles', 'admin', 'roles', 'view', 501, '2019-06-19 00:25:52', '2019-06-19 00:25:52'),
(16, 'create roles', 'admin', 'roles', 'create', 502, '2019-06-19 00:25:52', '2019-06-19 00:25:52'),
(17, 'update roles', 'admin', 'roles', 'update', 503, '2019-06-19 00:25:52', '2019-06-19 00:25:52'),
(18, 'delete roles', 'admin', 'roles', 'delete', 504, '2019-06-19 00:25:52', '2019-06-19 00:25:52'),
(19, 'view metatags', 'admin', 'metatags', 'view', 601, '2019-06-19 00:25:52', '2019-06-19 00:25:52'),
(20, 'update metatags', 'admin', 'metatags', 'update', 602, '2019-06-19 00:25:53', '2019-06-19 00:25:53'),
(21, 'view settings', 'admin', 'settings', 'view', 701, '2019-06-19 00:25:53', '2019-06-19 00:25:53'),
(22, 'update settings', 'admin', 'settings', 'update', 702, '2019-06-19 00:25:53', '2019-06-19 00:25:53'),
(240, 'view contactus', 'admin', 'contactus', 'view', 601, '2020-10-04 14:21:06', '2020-10-04 14:21:06'),
(241, 'create contactus', 'admin', 'contactus', 'create', 602, '2020-10-04 14:21:06', '2020-10-04 14:21:06'),
(242, 'update contactus', 'admin', 'contactus', 'update', 603, '2020-10-04 14:21:06', '2020-10-04 14:21:06'),
(243, 'delete contactus', 'admin', 'contactus', 'delete', 604, '2020-10-04 14:21:06', '2020-10-04 14:21:06'),
(244, 'create contacts', 'admin', 'contacts', 'create', 701, '2020-10-04 14:21:06', '2020-10-04 14:21:06'),
(245, 'delete contacts', 'admin', 'contacts', 'delete', 702, '2020-10-04 14:21:06', '2020-10-04 14:21:06'),
(304, 'view advertisements', 'admin', 'advertisements', 'view', 201, '2021-03-10 20:30:24', '2021-03-10 20:30:24'),
(305, 'create advertisements', 'admin', 'advertisements', 'create', 202, '2021-03-10 20:30:24', '2021-03-10 20:30:24'),
(306, 'update advertisements', 'admin', 'advertisements', 'update', 203, '2021-03-10 20:30:24', '2021-03-10 20:30:24'),
(307, 'delete advertisements', 'admin', 'advertisements', 'delete', 204, '2021-03-10 20:30:24', '2021-03-10 20:30:24'),
(308, 'view admins', 'admin', 'admins', 'view', 501, '2021-03-10 20:36:29', '2021-03-10 20:36:29');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'admin', '2019-04-01 12:36:20', '2019-04-01 12:36:20'),
(2, 'Admin', 'admin', '2019-04-01 12:41:08', '2019-05-01 08:27:25');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(12, 1),
(12, 2),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(21, 1),
(21, 2),
(22, 1),
(22, 2),
(240, 1),
(240, 2),
(241, 1),
(241, 2),
(242, 1),
(242, 2),
(243, 1),
(243, 2),
(244, 1),
(244, 2),
(245, 1),
(245, 2),
(304, 1),
(304, 2),
(305, 1),
(305, 2),
(306, 1),
(306, 2),
(307, 1),
(307, 2),
(308, 1),
(308, 2);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `settings_id` int(11) UNSIGNED NOT NULL,
  `settings_key` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `settings_value` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settings_id`, `settings_key`, `settings_value`) VALUES
(1, 'website_status', '1'),
(2, 'website_lang', 'ar');

-- --------------------------------------------------------

--
-- Table structure for table `slugs`
--

CREATE TABLE `slugs` (
  `slugs_id` int(11) NOT NULL,
  `slugs_key` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slugs`
--

INSERT INTO `slugs` (`slugs_id`, `slugs_key`) VALUES
(1, 'home'),
(2, 'about'),
(19, 'aboutUs'),
(20, 'terms'),
(21, 'policy'),
(26, 'contactus'),
(28, 'questions');

-- --------------------------------------------------------

--
-- Table structure for table `slug_translations`
--

CREATE TABLE `slug_translations` (
  `slugs_trans_id` int(11) NOT NULL,
  `slugs_id` int(10) UNSIGNED NOT NULL,
  `languages_code` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `slugs_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slug_translations`
--

INSERT INTO `slug_translations` (`slugs_trans_id`, `slugs_id`, `languages_code`, `slugs_title`) VALUES
(1, 1, 'en', 'home'),
(2, 1, 'ar', 'الرئيسيه'),
(3, 2, 'en', 'about'),
(4, 2, 'ar', 'عن-نماء'),
(37, 19, 'ar', 'عن-الموقع'),
(38, 19, 'en', 'aboutUs'),
(39, 20, 'en', 'terms&conditions'),
(40, 20, 'ar', 'الشروط-والأحكام'),
(41, 21, 'ar', 'سياسة-الخصوصية'),
(42, 21, 'en', 'PrivacyPolicy'),
(43, 22, 'ar', 'اتصل-بنا'),
(44, 22, 'en', 'ContactUs'),
(51, 26, 'ar', 'تواصل معنا'),
(52, 26, 'en', 'contactus');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admins_id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`advertisements_id`);

--
-- Indexes for table `advertisement_translations`
--
ALTER TABLE `advertisement_translations`
  ADD PRIMARY KEY (`advertisements_trans_id`),
  ADD KEY `advertisement_translations_ibfk_1` (`advertisements_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contacts_id`);

--
-- Indexes for table `contact_translations`
--
ALTER TABLE `contact_translations`
  ADD PRIMARY KEY (`contacts_trans_id`),
  ADD KEY `contact_translations_ipk1` (`contacts_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`contact_us_id`);

--
-- Indexes for table `infos`
--
ALTER TABLE `infos`
  ADD PRIMARY KEY (`infos_id`);

--
-- Indexes for table `info_translations`
--
ALTER TABLE `info_translations`
  ADD PRIMARY KEY (`infos_trans_id`),
  ADD KEY `articles_id` (`infos_id`),
  ADD KEY `locale` (`locale`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`languages_id`),
  ADD UNIQUE KEY `languages_languages_name_unique` (`name`),
  ADD UNIQUE KEY `languages_languages_code_unique` (`locale`);

--
-- Indexes for table `metatags`
--
ALTER TABLE `metatags`
  ADD PRIMARY KEY (`metatags_id`),
  ADD UNIQUE KEY `meta_tags_page` (`metatags_page`);

--
-- Indexes for table `metatag_translations`
--
ALTER TABLE `metatag_translations`
  ADD PRIMARY KEY (`metatags_trans_id`),
  ADD UNIQUE KEY `meta_tag_translations_meta_tags_id_languages_code_unique` (`metatags_id`,`locale`),
  ADD KEY `meta_tag_translations_languages_code_foreign` (`locale`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`(191),`notifiable_id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `slugs`
--
ALTER TABLE `slugs`
  ADD PRIMARY KEY (`slugs_id`);

--
-- Indexes for table `slug_translations`
--
ALTER TABLE `slug_translations`
  ADD PRIMARY KEY (`slugs_trans_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admins_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `advertisements_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `advertisement_translations`
--
ALTER TABLE `advertisement_translations`
  MODIFY `advertisements_trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contacts_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_translations`
--
ALTER TABLE `contact_translations`
  MODIFY `contacts_trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `contact_us_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `infos`
--
ALTER TABLE `infos`
  MODIFY `infos_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `info_translations`
--
ALTER TABLE `info_translations`
  MODIFY `infos_trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `languages_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `metatags`
--
ALTER TABLE `metatags`
  MODIFY `metatags_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `metatag_translations`
--
ALTER TABLE `metatag_translations`
  MODIFY `metatags_trans_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=309;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `settings_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `slugs`
--
ALTER TABLE `slugs`
  MODIFY `slugs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `slug_translations`
--
ALTER TABLE `slug_translations`
  MODIFY `slugs_trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advertisement_translations`
--
ALTER TABLE `advertisement_translations`
  ADD CONSTRAINT `advertisement_translations_ibfk_1` FOREIGN KEY (`advertisements_id`) REFERENCES `advertisements` (`advertisements_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contact_translations`
--
ALTER TABLE `contact_translations`
  ADD CONSTRAINT `contact_translations_ipk1` FOREIGN KEY (`contacts_id`) REFERENCES `contacts` (`contacts_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `info_translations`
--
ALTER TABLE `info_translations`
  ADD CONSTRAINT `info_translations_ibfk_2` FOREIGN KEY (`infos_id`) REFERENCES `infos` (`infos_id`) ON DELETE CASCADE;

--
-- Constraints for table `metatag_translations`
--
ALTER TABLE `metatag_translations`
  ADD CONSTRAINT `metatag_translations_ibfk_1` FOREIGN KEY (`metatags_id`) REFERENCES `metatags` (`metatags_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
