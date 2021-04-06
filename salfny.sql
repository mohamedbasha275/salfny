-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 21 نوفمبر 2020 الساعة 11:03
-- إصدار الخادم: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salfny`
--

-- --------------------------------------------------------

--
-- بنية الجدول `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'كتب', '2019-12-17 01:14:15', NULL),
(2, 'ملابس', '2019-12-31 03:25:13', NULL),
(3, 'اكسسوارات', '2019-12-03 22:18:10', NULL),
(4, 'الكترونيات', '2019-12-31 03:02:13', NULL),
(9, 'أثاث', '2020-01-15 20:18:58', '2020-01-15 20:18:58'),
(11, 'أخري', '2020-01-17 08:01:24', '2020-01-17 08:01:24');

-- --------------------------------------------------------

--
-- بنية الجدول `chats`
--

CREATE TABLE `chats` (
  `id` int(10) UNSIGNED NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_archv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recv_archv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `chats`
--

INSERT INTO `chats` (`id`, `sender_id`, `receiver_id`, `content`, `send_archv`, `recv_archv`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 27, 'mosa', NULL, NULL, NULL, '2020-09-30 18:51:44', '2020-09-30 18:51:44'),
(2, 27, 1, 'حلو ياض🐥🐥', NULL, NULL, NULL, '2020-09-30 18:52:22', '2020-09-30 18:52:22'),
(3, 27, 1, 'مش عاوز اسمع صوتك🐛', NULL, NULL, NULL, '2020-09-30 18:52:42', '2020-09-30 18:52:42'),
(4, 27, 1, '[]', NULL, NULL, NULL, '2020-10-05 19:28:30', '2020-10-05 19:28:30'),
(5, 27, 1, '😈😈😈😈😈', NULL, NULL, NULL, '2020-10-05 19:29:00', '2020-10-05 19:29:00'),
(6, 27, 1, 'جيد جدا هذا 😅😅', NULL, NULL, NULL, '2020-10-05 19:29:20', '2020-10-05 19:29:20'),
(7, 1, 27, 'ايه هو 😂😂😂', NULL, NULL, NULL, '2020-10-05 19:30:15', '2020-10-05 19:30:15'),
(8, 1, 27, 'سمعني تاني', NULL, NULL, NULL, '2020-10-05 19:30:24', '2020-10-05 19:30:24'),
(9, 1, 2, '😹😹😹😹', NULL, NULL, NULL, '2020-10-15 20:55:24', '2020-10-15 20:55:24'),
(10, 1, 27, 'zhbshzzgzvv', NULL, NULL, NULL, '2020-10-23 20:56:53', '2020-10-23 20:56:53');

-- --------------------------------------------------------

--
-- بنية الجدول `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(3, 2, 26, 'شئ جديد وحميل 😂😂', '2020-10-23 19:54:28', '2020-10-23 19:54:28'),
(7, 1, 27, 'fdfvaweds', '2020-10-23 20:54:10', '2020-10-23 20:54:10'),
(8, 1, 26, '😂😂😂 براهيم', '2020-10-23 20:54:46', '2020-10-23 20:54:46');

-- --------------------------------------------------------

--
-- بنية الجدول `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `likes`
--

CREATE TABLE `likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-09-30 18:26:48', '2020-09-30 18:26:48'),
(2, 1, 27, '2020-09-30 18:33:23', '2020-09-30 18:33:23'),
(3, 2, 27, '2020-10-23 19:54:09', '2020-10-23 19:54:09'),
(4, 4, 27, '2020-10-31 19:44:52', '2020-10-31 19:44:52');

-- --------------------------------------------------------

--
-- بنية الجدول `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(15, '2018_08_19_105323_create_groups_table', 1),
(31, '2019_12_17_090441_create_contacts_table', 2),
(32, '2019_12_28_152315_create_admins_table', 3),
(33, '2019_12_29_013757_create_news_table', 4),
(35, '2019_12_29_230050_create_contacts_table', 6),
(231, '2018_04_22_193700_create_post', 7),
(232, '2018_04_23_151025_create_comment', 7),
(263, '2014_10_12_000000_create_users_table', 8),
(264, '2014_10_12_100000_create_password_resets_table', 8),
(265, '2018_04_29_210616_create_products_table', 8),
(266, '2018_04_29_210725_create_categories_table', 8),
(267, '2018_06_03_000610_create_notifications_table', 8),
(268, '2018_06_03_204522_create_userimages_table', 8),
(269, '2018_06_05_190339_create_likes_table', 8),
(271, '2018_06_09_205411_create_notificationchats_table', 8),
(272, '2018_06_11_213613_create_adminnotifs_table', 8),
(273, '2018_06_22_064958_create_reviews_table', 8),
(274, '2018_06_22_144924_create_locaions_table', 8),
(275, '2019_12_29_021423_create_news_table', 8),
(276, '2019_12_29_233258_create_contacts_table', 8),
(277, '2019_12_30_233418_create_posts_table', 8),
(278, '2019_12_31_001559_create_comments_table', 8),
(279, '2019_12_31_185017_create_posts_table', 9),
(280, '2019_12_31_224723_create_categories_table', 10),
(281, '2019_12_31_230746_create_likes_table', 11),
(282, '2020_01_01_010519_create_notifications_table', 12),
(283, '2020_01_01_031754_create_offers_table', 13),
(284, '2020_01_01_220428_create_reviews_table', 14),
(285, '2020_01_02_230822_create_chats_table', 15),
(286, '2020_01_03_012727_create_chats_table', 16),
(287, '2020_01_03_165925_create_chat_notifications_table', 17),
(288, '2020_01_03_181430_create_chat_notifications_table', 18),
(289, '2020_01_12_015808_create_questions_table', 19),
(290, '2020_01_16_110408_create_site_settings_table', 20),
(291, '2020_01_16_131131_create_site_settings_table', 21),
(292, '2020_02_16_135620_create_notification_table', 22),
(293, '2020_02_16_142456_create_notif_table', 23),
(294, '2019_08_19_000000_create_failed_jobs_table', 24),
(295, '2020_10_15_204513_create_notices_table', 24),
(296, '2020_10_15_221917_create_needs_table', 25);

-- --------------------------------------------------------

--
-- بنية الجدول `needs`
--

CREATE TABLE `needs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offer_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `needs`
--

INSERT INTO `needs` (`id`, `offer_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 31, 27, '2020-10-15 20:39:12', '2020-10-15 20:39:12'),
(2, 33, 27, '2020-10-15 20:40:54', '2020-10-15 20:40:54'),
(4, 34, 1, '2020-10-15 20:54:19', '2020-10-15 20:54:19'),
(6, 24, 27, '2020-11-01 10:19:40', '2020-11-01 10:19:40'),
(8, 39, 1, '2020-11-01 10:22:42', '2020-11-01 10:22:42');

-- --------------------------------------------------------

--
-- بنية الجدول `notices`
--

CREATE TABLE `notices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reporter_id` bigint(20) NOT NULL,
  `person_id` bigint(20) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `relation_id` bigint(20) NOT NULL,
  `reason` tinyint(4) NOT NULL,
  `seen` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `notices`
--

INSERT INTO `notices` (`id`, `reporter_id`, `person_id`, `type`, `relation_id`, `reason`, `seen`, `created_at`, `updated_at`) VALUES
(1, 27, 1, 3, 1, 2, 0, '2020-10-23 18:44:55', '2020-10-23 18:44:55'),
(2, 27, 1, 3, 1, 4, 0, '2020-10-31 19:56:15', '2020-10-31 19:56:15'),
(3, 27, 26, 4, 8, 7, 0, '2020-10-31 19:57:33', '2020-10-31 19:57:33'),
(4, 27, 4, 1, 4, 1, 0, '2020-10-31 20:44:16', '2020-10-31 20:44:16'),
(5, 27, 1, 2, 33, 7, 0, '2020-10-31 20:53:39', '2020-10-31 20:53:39');

-- --------------------------------------------------------

--
-- بنية الجدول `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `asread` int(11) NOT NULL,
  `person` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `person_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `offers`
--

CREATE TABLE `offers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` double NOT NULL,
  `lat` double NOT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `offers`
--

INSERT INTO `offers` (`id`, `name`, `slug`, `user_id`, `category_id`, `description`, `image`, `lng`, `lat`, `place`, `created_at`, `updated_at`) VALUES
(2, 'تيشرت', 'تيشرت&2', 1, 3, 'in cotton good case', '2a.jpg', 23.422508274618377, 32.8896484375, 'Qena , Qeft', '2019-12-31 23:26:24', '2020-09-30 18:25:01'),
(7, 'phone', 'phone&7', 3, 1, 'in good case t', '5.jpg', 32.136167383052744, -5.5810546875, 'qena', '2020-01-01 16:23:39', '2020-09-30 18:24:35'),
(8, 'animals', 'animals&8', 3, 3, 'animals', '4.jpg', 25.67597119810721, 32.65087890625, 'Assiut,souq', '2020-01-01 19:29:39', '2020-09-30 18:24:35'),
(18, 'RTTGt', 'rttgt&18', 1, 2, 'vgrfvrtv', '23.jpg', 15.728373002506066, 31.131835937500007, 'D##D#d3c', '2020-01-13 14:37:35', '2020-09-30 18:24:35'),
(19, 'laptop', 'laptop&19', 1, 2, 'laptop with good qualiyt', '7.jpg', 9.73026297956822, 8.807617187500009, 'cerbucy niueacie', '2020-01-13 14:38:19', '2020-09-30 18:24:35'),
(21, 'RRRRRRR', 'rrrrrrr&21', 2, 3, 'mmm', '4.jpg', 27.239063, 31.228638, 'mmmm', '2020-01-14 04:15:13', '2020-09-30 18:24:35'),
(22, 'ggg', 'ggg&22', 2, 1, 'drftgy', '2.jpg', 27.239063, 31.228638, 'ggggggggggggggggggggg', '2020-01-14 04:22:28', '2020-09-30 18:24:35'),
(23, 'mmmb', 'mmmb&23', 2, 4, 'fgh', '10.jpg', 27.239063, 31.228638, 'mmmmmmmm', '2020-01-14 04:28:49', '2020-09-30 18:24:35'),
(24, 'TYa', 'tya&24', 1, 1, 'TYa', '6.jpg', 27.239063, 31.228638, 'qena,qeft', '2020-01-14 16:50:58', '2020-09-30 18:24:35'),
(26, 'FTM', 'ftm&26', 3, 3, 'good case can be suitable for youth', '02.jpg', 27.239063, 31.228638, 'Qena , Qeft', '2020-01-17 15:23:16', '2020-09-30 18:24:36'),
(31, 'vvvvv', 'vvvvv&31', 1, 2, 'ggggggggg ggggggggggg', '2.png', 27.239063, 31.228638, 'fff', '2020-01-18 09:48:23', '2020-09-30 18:24:36'),
(33, 'منتج الهوي', 'منتج-الهوي&32', 1, 3, 'جيد جدا ورائع مناسب', '16019314971058964116011552262957.jpg', 32.76353544992361, 26.044987188650335, 'Unnamed Road, الدير، قنا، مصر', '2020-10-05 18:58:56', '2020-10-05 18:58:56'),
(34, 'منتج الهوي', 'منتج-الهوي&34', 27, 4, 'قققققققققققق', 'pexels-photo-2467236.jpeg', 31.296961712439114, 29.843556344870258, 'السلمانية القبلي، حلوان البلد، قسم حلوان، محافظة القاهرة‬، مصر', '2020-10-15 20:13:44', '2020-10-18 20:30:06'),
(35, 'تجربة', 'تجربة&35', 27, 4, 'منتج تجربة منتج تجربة منتج تجربة منتج تجربة منتج تجربة منتج تجربة منتج تجربة منتج تجربة منتج تجربة', 'pexels-photo-210126.jpeg', 32.8490667, 25.9495324, 'كافيه علي وضاحي، الكلاحين، قفط، مصر', '2020-10-18 20:49:58', '2020-10-18 20:49:58'),
(36, 'Group قنا', 'group-قنا&36', 27, 2, 'محمد باشا محمد باشا محمد باشا محمد باشا محمد باشا محمد باشا محمد باشا محمد باشا محمد باشا محمد باشا', 'qXkVug.jpg', 32.85258919999999, 25.9497107, 'البشمهندس محمد باشا للبرمجيات، الكلاحين، قفط، مصر', '2020-10-18 21:11:53', '2020-10-18 21:11:53'),
(37, 'messo', 'messo&37', 27, 4, 'تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة تجربة', 'GIaw4Y.jpg', 42.7662325, 18.3093394, 'خميس مشيط السعودية', '2020-10-18 21:36:54', '2020-10-18 21:36:54'),
(38, 'Group قنا', 'group-قنا&38', 27, 3, 'ببببببببببببب بببببببببببب بببببببببببببببببب', 'pexels-photo-208147 - Copy.jpeg', 32.98883190000001, 26.2346033, 'قنا - قوص -الكلالسة ك24 طريق مصر اسوان الزراعي، قوص الكللالسة، قنا، مصر، الظهير الصحراوى لمحافظة قنا، قنا، مصر', '2020-10-20 21:42:31', '2020-10-20 21:42:31'),
(39, 'عادل محمد', 'عادل-محمد&39', 27, 9, 'الامارات المتحدة تجربة return back()->withFlashReview(\'تم إضافة عرضك بنجاح, هل يمكنك ترك رأيك ف الموقع الآن ؟!\');', 'pexels-photo-210126.jpeg', 55.9366855, 25.7722259, 'ريترو ٧ - إمارة رأس الخيمة - الإمارات العربية المتحدة', '2020-10-20 21:46:32', '2020-10-20 21:46:32'),
(40, 'messo', 'messo&40', 27, 11, 'السعودية return back()->withFlashReview(\'تم إضافة عرضك بنجاح, هل يمكنك ترك رأيك ف الموقع الآن ؟!\');', 'pexels-photo-210126.jpeg', 50.1678155, 26.3360692, 'الدوحة الشمالية، الظهران السعودية', '2020-10-20 21:47:30', '2020-10-20 21:47:30');

-- --------------------------------------------------------

--
-- بنية الجدول `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `content`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'اول بوست ليا 😌😌😌', NULL, '2020-09-30 18:26:35', '2020-09-30 18:26:35'),
(2, 27, 'شئ جديد ورائع صراحة ربنا يوفقكم ويعينكم 😍😍😍😍', NULL, '2020-10-18 20:37:17', '2020-10-18 20:37:17'),
(4, 27, '// Change class\r\n    // $$(\'.view.navbar-through\').removeClass(\'navbar-through\').addClass(\'navbar-fixed\');\r\n    // And move Navbar into Page\r\n    //$$(\'.view .navbar\').prependTo(\'.view .page\');// Change class\r\n    // $$(\'.view.navbar-through\').removeClass(\'navbar-through\').addClass(\'navbar-fixed\');\r\n    // And move Navbar into Page\r\n    //$$(\'.view .navbar\').prependTo(\'.view .page\');// Change class\r\n    // $$(\'.view.navbar-through\').removeClass(\'navbar-through\').addClass(\'navbar-fixed\');\r\n    // And move Navbar into Page\r\n    //$$(\'.view .navbar\').prependTo(\'.view .page\'); 😂😂😡😡😡😡😡😡😡😡😡', NULL, '2020-10-31 19:34:34', '2020-10-31 21:33:22');

-- --------------------------------------------------------

--
-- بنية الجدول `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `content`, `publish`, `created_at`, `updated_at`) VALUES
(2, 27, 'رائع', 0, '2020-10-20 21:46:43', '2020-10-20 21:46:43');

-- --------------------------------------------------------

--
-- بنية الجدول `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `icon` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slide1` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slide2` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slide3` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slide4` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instgram` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `skype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aboutimg` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `largedescription` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `aboutteam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `articletime` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `teammember1picture` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `teammember1name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teammember1postion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teammember1article` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teammember1facebook` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teammember1twitter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teammember1google` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teammember2picture` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `teammember2name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teammember2postion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teammember2article` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teammember2facebook` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teammember2twitter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teammember2google` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teammember3picture` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `teammember3name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teammember3postion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teammember3article` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teammember3facebook` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teammember3twitter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teammember3google` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `site_settings`
--

INSERT INTO `site_settings` (`id`, `icon`, `slide1`, `slide2`, `slide3`, `slide4`, `facebook`, `twitter`, `google`, `youtube`, `instgram`, `skype`, `whatsapp`, `address`, `phone`, `fax`, `email`, `aboutimg`, `largedescription`, `aboutteam`, `articletime`, `teammember1picture`, `teammember1name`, `teammember1postion`, `teammember1article`, `teammember1facebook`, `teammember1twitter`, `teammember1google`, `teammember2picture`, `teammember2name`, `teammember2postion`, `teammember2article`, `teammember2facebook`, `teammember2twitter`, `teammember2google`, `teammember3picture`, `teammember3name`, `teammember3postion`, `teammember3article`, `teammember3facebook`, `teammember3twitter`, `teammember3google`, `created_at`, `updated_at`) VALUES
(1, '6.png', '8.jpg', '1.jpg', '5.jpg', '5.png', 'salfnyfb2020@facebook.com', 'salfnytw2020@twitter.com', 'salfnygo2020@google.com', 'salfnyyo2020@youtube.com', 'salfnyin2020@instgram.com', 'salfnysk2020@skype.com', '01063981560', '23 Orabi st,Qeft Qena Egy', '6943213', '562864', 'salfny2020@outook.com', 'lab.jpg', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit,sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat exerci tation ullamcorper eleifend option Ut wisi enim ad minim veniam,quis nostrud vero eros et accumsan et iusto odio dignissim qui liber tempor cum Ut wisi enim ad minim veniam,quis nostrud vero eros et accumsan et iusto odio dignissim qui liber tempor cum Ut wisi enim ad minim veniam,quis nostrud vero eros et accumsan et iusto odio dignissim qui liber tempor cum Ut wisi enim ad minim veniam,quis nostrud vero eros et accumsan et iusto odio dignissim qui liber tempor cum Ut wisi enim ad minim veniam,quis nostrud vero eros et accumsan et iusto odio dignissim qui liber tempor cum Ut wisi enim ad minim veniam,quis nostrud vero eros et accumsan et iusto odio dignissim qui liber tempor cum Ut wisi enim ad minim veniam,quis nostrud vero eros et accumsan et iusto odio dignissim qui liber tempor cum est usus legentis in iis qui facit eorum qui facit e', 'ur est at lobortis. Fusce dapibus, tellus ac cursus commodo.Cras mattis consectetur purus sit amet fermentum', ',18 2020', 'review1.jpg', 'Mohamedt', 'HR', 'good case to work here mohamed', 'mohamed@facebook.com', 'mohamed@twitter.com', 'mohamed@google.com', 'review4.jpg', 'Alyaa', 'Tech Support', 'work here good case to\r\n                  alyaa', 'alyaa@facebook.com', 'alyaa@twitter.com', 'alyaa@google.com', 'review3.jpg', 'Osama', 'SW Engineer', 'good case to bre refe\r\n               osama', 'osama@facebook.com', 'osama@twitter.com', 'osama@google.com', '2020-01-16 08:36:38', '2020-01-18 08:53:05');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `address`, `image`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'mohamed', 'mohamedbasha275@gmail.com', '01063981560', '$2y$10$Gi/wFloxupp9z9jX2kF2UORPjabAlcRNS.5d1fGYgmeknTiOHilp6', 'sohag', 'pexels-photo-1212984.jpeg', 'default', '7jT8uV5cRrSnYRjnIbmuuOk51ihIyjTIhH4NjoQVvz0tjufpVO0nLjscRl9l', '2019-12-30 20:31:01', '2020-11-11 23:16:11'),
(2, 'ali', 'ali@gmail.com', '012222', '$2y$10$/g3ps6mjuGZED0lCHBfEuufGtRcBIU4SmiHjIHXxNFnQTrHbhDdlm', 'assiut', '13.jpg', 'default', 'AfceG7bGfd1UYq9EzGcLBO9cfnK3MKfqaFsAb33hkbtJjgApia2NvZa2SjcG', '2019-12-31 12:00:12', '2020-09-30 18:22:03'),
(3, 'Ahmed', 'ahmed@gmail.com', '011184956', '$2y$10$a6xXefymMEpdQtKbfV3z7uQGbRrrpUo97gdt0JPvwbhkUaORQKLMe', 'Minya', 'a2.jpg', 'default', 'OeY3wLIfkrwDcqCFchdR2rt2mT6JSEktJVOjGoFRGKVWIKXSrAxKLe2VdgAI', '2020-01-02 18:08:56', '2020-09-30 18:22:03'),
(4, 'Admin', 'admin@gmail.com', '0106398156', '$2y$10$pyK3Gn82f.EW5GNkNmlN.eh2JBZivHLiEbc3fuujm0DITpR.EFAg.', 'ER', '2.png', 'default', 'dxXrQb4KsUqVwdwHKpT5iFamw61uJymbDaqhRmRdysc1pOB2HCAxhxXTUQIn', '2020-01-03 19:44:14', '2020-09-30 18:22:03'),
(6, 'aser', 'aser@gmail.com', '0111849', '$2y$10$qwk44T2G8JHRRUvSTnsYmOA0j3XqU24vbSS0wNsZXJql5FQ/R139i', 'Minya', '03.jpg', 'default', NULL, '2020-01-06 09:49:24', '2020-09-30 18:22:04'),
(9, 'asdddd', 'asddd@gmail.com', '1235566', '$2y$10$ADFM1jIeQixP9yI8YdmEbeLIwjznA.hyU2Q8Ld3VwDj/.P5OfwJ1W', 'Minya', '17 Feb 2020', 'default', NULL, '2020-10-18 20:33:47', '2020-10-18 20:33:47'),
(19, 'mohamed', 'rrrr@gmail.com', '1022516651', '$2y$10$o/gD2PL3.ePaLuXcxg7Mueu3LZdRJeKNt2a8bAoDSJVOAITZQpk22', 'qena', '17 Feb 2020', 'default', NULL, '2020-10-18 20:33:47', '2020-10-18 20:33:47'),
(20, 'Addd', 'ahmeder@gmail.com', '213546879', '$2y$10$sB4B6x3SR5fxncqPsHCN3.s3e0nSVI9e42sz993xgGuz4WE8BRyfC', 'Minya', '17 Feb 2020', 'default', NULL, '2020-10-18 20:33:47', '2020-10-18 20:33:47'),
(23, 'alaa', 'ahdddddmed@gmail.com', '123123215445', '$2y$10$HN/qk2UV2C93873Zi/VffO73GnfOlB37mBN5kwWz4HfvYGwqOfdk.', 'assiut', '17 Feb 2020', 'default', NULL, '2020-10-18 20:33:47', '2020-10-18 20:33:47'),
(24, 'ronaldo', 'ronaldo12@fmail.com', '01118494651', '$2y$10$O7lkmXnu5d412REBZ0oqL.33pAVRr8wthpCMlivxRND0jQlzsXTcO', 'assiut', '17 Feb 2020', 'default', NULL, '2020-10-18 20:33:47', '2020-10-18 20:33:47'),
(26, 'mohamed', 'mohamgged@gmail.com', '01063981560555', '$2y$10$XEC.Oc.MfpCeET/RTmACOuYH.Sy5c7EwHLnLft1OrBaB9uGmw1hom', 'qena', 'FB_IMG_15846603212809255.jpg', 'default', NULL, '2020-03-21 17:02:25', '2020-09-30 18:22:05'),
(27, 'Messi', 'messi@gmail.com', '010011012015', '$2y$10$7w42gKALzeQ1RNtJxOGnpeDPMFk/U2ZOYe5hxI0RmrHakosjOz0Ne', 'aswan', 'maxresdefault.jpg', 'default', NULL, '2020-09-30 18:33:14', '2020-11-20 18:41:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `needs`
--
ALTER TABLE `needs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=297;

--
-- AUTO_INCREMENT for table `needs`
--
ALTER TABLE `needs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
