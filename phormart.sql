-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 27, 2018 at 01:30 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phormart`
--

-- --------------------------------------------------------

--
-- Table structure for table `ad_spaces`
--

CREATE TABLE `ad_spaces` (
  `id` int(11) NOT NULL,
  `ad_space` text,
  `ad_code_728` text,
  `ad_code_468` text,
  `ad_code_300` text,
  `ad_code_234` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ad_spaces`
--

INSERT INTO `ad_spaces` (`id`, `ad_space`, `ad_code_728`, `ad_code_468`, `ad_code_300`, `ad_code_234`) VALUES
(1, 'index_top', NULL, NULL, NULL, NULL),
(2, 'index_bottom', NULL, NULL, NULL, NULL),
(3, 'post_top', NULL, NULL, NULL, NULL),
(4, 'post_bottom', NULL, NULL, NULL, NULL),
(5, 'category_top', NULL, NULL, NULL, NULL),
(6, 'category_bottom', NULL, NULL, NULL, NULL),
(7, 'tag_top', NULL, NULL, NULL, NULL),
(8, 'tag_bottom', NULL, NULL, NULL, NULL),
(9, 'search_top', NULL, NULL, NULL, NULL),
(10, 'search_bottom', NULL, NULL, NULL, NULL),
(11, 'profile_top', NULL, NULL, NULL, NULL),
(12, 'profile_bottom', NULL, NULL, NULL, NULL),
(13, 'reading_list_top', NULL, NULL, NULL, NULL),
(14, 'reading_list_bottom', NULL, NULL, NULL, NULL),
(15, 'sidebar_top', NULL, NULL, NULL, NULL),
(16, 'sidebar_bottom', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `lang_id` int(11) DEFAULT '1',
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `category_order` int(11) DEFAULT NULL,
  `show_on_menu` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `lang_id`, `name`, `slug`, `description`, `keywords`, `parent_id`, `category_order`, `show_on_menu`, `created_at`) VALUES
(1, 1, 'Works', 'Works', 'works', 'works', 0, 2, 1, '2018-11-26 22:27:31'),
(2, 1, 'P.O.P', 'P.O.P', 'P.O.P', 'P.O.P', 1, NULL, 1, '2018-11-26 22:35:23'),
(3, 1, 'Wallpaper', 'Wallpaper', 'Wallpaper', 'Wallpaper', 1, NULL, 1, '2018-11-26 22:35:51'),
(4, 1, 'Deco', 'Deco', 'interior and exterior deco', 'deco', 1, NULL, 1, '2018-11-26 22:37:24'),
(5, 1, 'Painting', 'Painting', 'Painting', 'Painting', 1, NULL, 1, '2018-11-26 22:37:52');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `comment` varchar(5000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` varchar(5000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_categories`
--

CREATE TABLE `gallery_categories` (
  `id` int(11) NOT NULL,
  `lang_id` int(11) DEFAULT '1',
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gallery_categories`
--

INSERT INTO `gallery_categories` (`id`, `lang_id`, `name`, `created_at`) VALUES
(1, 1, 'Ceiling', '2018-11-26 21:54:21'),
(2, 1, 'Wallpaper', '2018-11-26 21:54:45'),
(3, 1, 'Deco', '2018-11-26 21:54:53'),
(4, 1, 'Painting', '2018-11-26 21:55:14');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(11) NOT NULL,
  `site_lang` int(11) NOT NULL DEFAULT '1',
  `layout` varchar(100) DEFAULT 'layout_1',
  `slider_active` int(11) DEFAULT '1',
  `site_color` varchar(100) DEFAULT 'default',
  `show_pageviews` int(11) DEFAULT '1',
  `show_rss` int(11) DEFAULT '1',
  `logo_path` varchar(255) DEFAULT NULL,
  `favicon_path` varchar(255) DEFAULT NULL,
  `google_analytics` text,
  `mail_protocol` varchar(100) DEFAULT 'smtp',
  `mail_host` varchar(255) DEFAULT NULL,
  `mail_port` varchar(255) DEFAULT '587',
  `mail_username` varchar(255) DEFAULT NULL,
  `mail_password` varchar(255) DEFAULT NULL,
  `mail_title` varchar(255) DEFAULT NULL,
  `primary_font` varchar(255) DEFAULT 'open_sans',
  `secondary_font` varchar(255) DEFAULT 'roboto',
  `tertiary_font` varchar(255) DEFAULT 'verdana',
  `facebook_comment` text,
  `pagination_per_page` int(11) DEFAULT '6',
  `menu_limit` int(11) DEFAULT '5',
  `multilingual_system` int(11) DEFAULT '1',
  `registration_system` int(11) DEFAULT '1',
  `comment_system` int(11) DEFAULT '1',
  `emoji_reactions` int(11) DEFAULT '1',
  `head_code` text,
  `inf_key` varchar(500) NOT NULL,
  `purchase_code` varchar(500) NOT NULL,
  `recaptcha_site_key` varchar(500) DEFAULT NULL,
  `recaptcha_secret_key` varchar(500) DEFAULT NULL,
  `recaptcha_lang` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_lang`, `layout`, `slider_active`, `site_color`, `show_pageviews`, `show_rss`, `logo_path`, `favicon_path`, `google_analytics`, `mail_protocol`, `mail_host`, `mail_port`, `mail_username`, `mail_password`, `mail_title`, `primary_font`, `secondary_font`, `tertiary_font`, `facebook_comment`, `pagination_per_page`, `menu_limit`, `multilingual_system`, `registration_system`, `comment_system`, `emoji_reactions`, `head_code`, `inf_key`, `purchase_code`, `recaptcha_site_key`, `recaptcha_secret_key`, `recaptcha_lang`, `created_at`) VALUES
(1, 1, 'layout_1', 1, 'default', 1, 1, 'uploads/logo/logo_5bfc6a254e739.png', 'uploads/logo/favicon_5bfc68b6b10de.png', '', 'smtp', 'localhost', '25', '', '', 'Phormart ventures', 'open_sans', 'roboto', 'verdana', '', 6, 6, 1, 1, 1, 1, '', '', '', '6LdMO30UAAAAANMBLB3-_vvIDvicmKWGJ_-pTXAn', '6LdMO30UAAAAADqVJO6-5lLLD37zKIfL61hdHH5r', 'en', '2017-07-06 00:11:07');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image_big` varchar(255) DEFAULT NULL,
  `image_mid` varchar(255) DEFAULT NULL,
  `image_small` varchar(255) DEFAULT NULL,
  `image_slider` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_form` varchar(255) NOT NULL,
  `language_code` varchar(100) NOT NULL,
  `folder_name` varchar(255) NOT NULL,
  `text_direction` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `language_order` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `short_form`, `language_code`, `folder_name`, `text_direction`, `status`, `language_order`) VALUES
(1, 'English', 'en', 'en_us', 'default', 'ltr', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `lang_id` int(11) DEFAULT '1',
  `title` varchar(500) DEFAULT NULL,
  `page_description` varchar(500) DEFAULT NULL,
  `page_keywords` varchar(500) DEFAULT NULL,
  `slug` varchar(500) DEFAULT NULL,
  `is_custom` int(11) DEFAULT '1',
  `page_content` text,
  `page_order` int(11) DEFAULT '5',
  `page_active` int(11) DEFAULT '1',
  `title_active` int(11) DEFAULT '1',
  `breadcrumb_active` int(11) DEFAULT '1',
  `right_column_active` int(11) DEFAULT '1',
  `need_auth` int(11) DEFAULT '0',
  `location` varchar(255) DEFAULT 'header',
  `link` varchar(1000) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `lang_id`, `title`, `page_description`, `page_keywords`, `slug`, `is_custom`, `page_content`, `page_order`, `page_active`, `title_active`, `breadcrumb_active`, `right_column_active`, `need_auth`, `location`, `link`, `parent_id`, `created_at`) VALUES
(2, 1, 'Gallery', 'Gallery Page', 'gallery,infinite', 'gallery', 0, NULL, 2, 1, 1, 1, 1, 0, 'header', NULL, 0, '2017-12-20 23:22:50'),
(3, 1, 'Contact', 'Contact Page', 'contact,infinite', 'contact', 0, NULL, 3, 1, 1, 1, 1, 0, 'header', NULL, 0, '2017-12-20 23:23:51'),
(4, 1, 'Login', 'Login Page', 'login,infinite', 'login', 0, NULL, 4, 1, 1, 1, 1, 0, 'none', NULL, 0, '2017-12-20 23:24:51'),
(5, 1, 'Register', 'Register Page', 'register,infinite', 'register', 0, NULL, 5, 1, 1, 1, 1, 0, 'none', NULL, 0, '2017-12-20 23:25:55'),
(6, 1, 'Change Password', 'Change Password Page', 'change password,infinite', 'change-password', 0, NULL, 6, 1, 1, 1, 1, 0, 'none', NULL, 0, '2017-12-20 23:26:44'),
(7, 1, 'Update Profile', 'Update Profile Page', 'update profile,infinite', 'profile-update', 0, NULL, 7, 1, 1, 1, 1, 0, 'none', NULL, 0, '2017-12-20 23:27:23'),
(8, 1, 'Reading List', 'Reading List Page', 'reading list,infinite', 'reading-list', 0, NULL, 8, 1, 1, 1, 1, 0, 'none', NULL, 0, '2017-12-20 23:28:19'),
(9, 1, 'Reset Password', 'Reset Password Page', 'reset password,infinite', 'reset-password', 0, NULL, 9, 1, 1, 1, 1, 0, 'none', NULL, 0, '2017-12-20 23:29:06'),
(10, 1, 'RSS Feeds', 'RSS Feeds Page', 'RSS feeds,infinite', 'rss-feeds', 0, NULL, 10, 1, 1, 1, 1, 0, 'none', NULL, 0, '2017-12-20 23:29:45');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `lang_id` int(11) DEFAULT '1',
  `title` varchar(500) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `path_big` varchar(255) DEFAULT NULL,
  `path_small` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `lang_id`, `title`, `category_id`, `path_big`, `path_small`, `created_at`) VALUES
(1, 1, 'P.O.P', 1, 'uploads/gallery/image_1920x_5bfc6bff37082.jpg', 'uploads/gallery/image_500x_5bfc6bff72501.jpg', '2018-11-26 21:56:15'),
(2, 1, 'P.O.P', 1, 'uploads/gallery/image_1920x_5bfc6c0c37f2c.jpg', 'uploads/gallery/image_500x_5bfc6c0c6a1d9.jpg', '2018-11-26 21:56:28'),
(3, 1, 'P.O.P', 1, 'uploads/gallery/image_1920x_5bfc6c19529a5.jpg', 'uploads/gallery/image_500x_5bfc6c197eb74.jpg', '2018-11-26 21:56:41'),
(4, 1, 'P.O.P', 1, 'uploads/gallery/image_1920x_5bfc6c23713d0.jpg', 'uploads/gallery/image_500x_5bfc6c23c3ad3.jpg', '2018-11-26 21:56:51'),
(5, 1, 'P.O.P', 1, 'uploads/gallery/image_1920x_5bfc6c2c226f2.jpg', 'uploads/gallery/image_500x_5bfc6c2c69cb7.jpg', '2018-11-26 21:57:00'),
(6, 1, 'P.O.P', 1, 'uploads/gallery/image_1920x_5bfc6c3859330.jpg', 'uploads/gallery/image_500x_5bfc6c38bd4c2.jpg', '2018-11-26 21:57:12'),
(7, 1, 'P.O.P', 1, 'uploads/gallery/image_1920x_5bfc6c44e6d30.jpg', 'uploads/gallery/image_500x_5bfc6c45489a8.jpg', '2018-11-26 21:57:25'),
(8, 1, 'P.O.P', 1, 'uploads/gallery/image_1920x_5bfc6c4f69777.jpg', 'uploads/gallery/image_500x_5bfc6c4f90448.jpg', '2018-11-26 21:57:35'),
(9, 1, 'P.O.P', 1, 'uploads/gallery/image_1920x_5bfc6c594612d.jpg', 'uploads/gallery/image_500x_5bfc6c596fd28.jpg', '2018-11-26 21:57:45'),
(10, 1, 'P.O.P', 1, 'uploads/gallery/image_1920x_5bfc6c64292a3.jpg', 'uploads/gallery/image_500x_5bfc6c648e3f5.jpg', '2018-11-26 21:57:56'),
(11, 1, 'wellpaper', 2, 'uploads/gallery/image_1920x_5bfc6c821f3a6.jpg', 'uploads/gallery/image_500x_5bfc6c8289704.jpg', '2018-11-26 21:58:26'),
(12, 1, 'P.O.P', 1, 'uploads/gallery/image_1920x_5bfc6cb13b0f4.jpg', 'uploads/gallery/image_500x_5bfc6cb1ae3fb.jpg', '2018-11-26 21:59:13'),
(13, 1, 'P.O.P', 1, 'uploads/gallery/image_1920x_5bfc6cc170224.jpg', 'uploads/gallery/image_500x_5bfc6cc1c234b.jpg', '2018-11-26 21:59:29'),
(14, 1, 'P.O.P', 1, 'uploads/gallery/image_1920x_5bfc6ccd710a1.jpg', 'uploads/gallery/image_500x_5bfc6ccdd587e.jpg', '2018-11-26 21:59:42'),
(15, 1, 'P.O.P', 1, 'uploads/gallery/image_1920x_5bfc6cdc50385.jpg', 'uploads/gallery/image_500x_5bfc6cdc884f6.jpg', '2018-11-26 21:59:56'),
(16, 1, 'P.O.P', 1, 'uploads/gallery/image_1920x_5bfc6cea1639b.jpg', 'uploads/gallery/image_500x_5bfc6cea83836.jpg', '2018-11-26 22:00:10'),
(17, 1, 'P.O.P', 1, 'uploads/gallery/image_1920x_5bfc6cf6e78ac.jpg', 'uploads/gallery/image_500x_5bfc6cf722464.jpg', '2018-11-26 22:00:23'),
(18, 1, 'P.O.P', 1, 'uploads/gallery/image_1920x_5bfc6d0201671.jpg', 'uploads/gallery/image_500x_5bfc6d0238755.jpg', '2018-11-26 22:00:34'),
(19, 1, 'P.O.P', 1, 'uploads/gallery/image_1920x_5bfc6d12bbaa1.jpg', 'uploads/gallery/image_500x_5bfc6d12ef59a.jpg', '2018-11-26 22:00:51'),
(20, 1, 'P.O.P', 1, 'uploads/gallery/image_1920x_5bfc6d2228ec6.jpg', 'uploads/gallery/image_500x_5bfc6d2273be1.jpg', '2018-11-26 22:01:06'),
(21, 1, 'P.O.P', 1, 'uploads/gallery/image_1920x_5bfc6d3074b12.jpg', 'uploads/gallery/image_500x_5bfc6d30a2eeb.jpg', '2018-11-26 22:01:20'),
(22, 1, '', 1, 'uploads/gallery/image_1920x_5bfc6d3d23372.jpg', 'uploads/gallery/image_500x_5bfc6d3d74fcf.jpg', '2018-11-26 22:01:33'),
(23, 1, 'P.O.P', 1, 'uploads/gallery/image_1920x_5bfc6d4d7829e.jpg', 'uploads/gallery/image_500x_5bfc6d4dac4cd.jpg', '2018-11-26 22:01:49'),
(24, 1, 'P.O.P', 1, 'uploads/gallery/image_1920x_5bfc6d61699d1.jpg', 'uploads/gallery/image_500x_5bfc6d61bf5dd.jpg', '2018-11-26 22:02:09'),
(25, 1, 'P.O.P', 1, 'uploads/gallery/image_1920x_5bfc6d6ec40e9.jpg', 'uploads/gallery/image_500x_5bfc6d6f1cb36.jpg', '2018-11-26 22:02:23'),
(26, 1, '', 3, 'uploads/gallery/image_1920x_5bfc6d7b54792.jpg', 'uploads/gallery/image_500x_5bfc6d7b88229.jpg', '2018-11-26 22:02:35');

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `id` int(11) NOT NULL,
  `lang_id` int(11) DEFAULT '1',
  `question` text,
  `option1` text,
  `option2` text,
  `option3` text,
  `option4` text,
  `option5` text,
  `option6` text,
  `option7` text,
  `option8` text,
  `option9` text,
  `option10` text,
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `poll_votes`
--

CREATE TABLE `poll_votes` (
  `id` int(11) NOT NULL,
  `poll_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `vote` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `lang_id` int(11) DEFAULT '1',
  `title` varchar(500) DEFAULT NULL,
  `title_slug` varchar(500) DEFAULT NULL,
  `summary` varchar(1000) DEFAULT NULL,
  `content` longtext,
  `keywords` varchar(500) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `image_big` varchar(255) DEFAULT NULL,
  `image_mid` varchar(255) DEFAULT NULL,
  `image_small` varchar(255) DEFAULT NULL,
  `image_slider` varchar(255) DEFAULT NULL,
  `is_slider` int(11) DEFAULT '0',
  `is_picked` int(11) DEFAULT '0',
  `hit` int(11) DEFAULT '0',
  `slider_order` int(11) DEFAULT '0',
  `optional_url` varchar(1000) DEFAULT NULL,
  `need_auth` int(11) DEFAULT '0',
  `visibility` int(11) DEFAULT '1',
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `post_images`
--

CREATE TABLE `post_images` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `image_path` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reactions`
--

CREATE TABLE `reactions` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `re_like` int(11) DEFAULT '0',
  `re_dislike` int(11) DEFAULT '0',
  `re_love` int(11) DEFAULT '0',
  `re_funny` int(11) DEFAULT '0',
  `re_angry` int(11) DEFAULT '0',
  `re_sad` int(11) DEFAULT '0',
  `re_wow` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reading_lists`
--

CREATE TABLE `reading_lists` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `lang_id` int(11) DEFAULT '1',
  `application_name` varchar(255) DEFAULT 'Infinite',
  `site_title` varchar(255) DEFAULT NULL,
  `home_title` varchar(255) DEFAULT NULL,
  `site_description` varchar(500) DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `facebook_url` varchar(500) DEFAULT NULL,
  `twitter_url` varchar(500) DEFAULT NULL,
  `google_url` varchar(500) DEFAULT NULL,
  `instagram_url` varchar(500) DEFAULT NULL,
  `pinterest_url` varchar(500) DEFAULT NULL,
  `linkedin_url` varchar(500) DEFAULT NULL,
  `vk_url` varchar(500) DEFAULT NULL,
  `optional_url_button_name` varchar(500) DEFAULT 'Click Here to Visit',
  `about_footer` varchar(1000) DEFAULT NULL,
  `contact_text` text,
  `contact_address` varchar(500) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `copyright` varchar(500) DEFAULT 'Copyright © 2018 Infinite - All Rights Reserved.',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `lang_id`, `application_name`, `site_title`, `home_title`, `site_description`, `keywords`, `facebook_url`, `twitter_url`, `google_url`, `instagram_url`, `pinterest_url`, `linkedin_url`, `vk_url`, `optional_url_button_name`, `about_footer`, `contact_text`, `contact_address`, `contact_email`, `contact_phone`, `copyright`, `created_at`) VALUES
(1, 1, 'Phormart Ventures', 'Phormart Ventures - Blog', 'Blog', 'Phormart Ventures - Blog', 'Phormart Ventures, Blog, Magazine, Phormart', 'https://www.facebook.com/Phormartworks/', '', '', '', '', '', '', 'Click Here To See More', '', '<p>PHORMAR&nbsp;VENTURES</p>\r\n', 'info@phormart.com', 'phormartworks@gmail.com', '+233 544 953 452', 'Copyright © 2018 Phormart Ventures- All Rights Reserved. Designed By <a href=\"https://solveitgh.com\">SolveIT Solutions</a>', '2018-07-12 04:15:40');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `tag_slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT 'name@domain.com',
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(100) DEFAULT 'user',
  `avatar` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `about_me` varchar(5000) DEFAULT NULL,
  `facebook_url` varchar(500) DEFAULT NULL,
  `twitter_url` varchar(500) DEFAULT NULL,
  `google_url` varchar(500) DEFAULT NULL,
  `instagram_url` varchar(500) DEFAULT NULL,
  `pinterest_url` varchar(500) DEFAULT NULL,
  `linkedin_url` varchar(500) DEFAULT NULL,
  `vk_url` varchar(500) DEFAULT NULL,
  `youtube_url` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `slug`, `email`, `password`, `role`, `avatar`, `status`, `about_me`, `facebook_url`, `twitter_url`, `google_url`, `instagram_url`, `pinterest_url`, `linkedin_url`, `vk_url`, `youtube_url`, `created_at`) VALUES
(1, 'phormart2018!', 'phormart2018', 'info@phormart.com', '$2a$08$dw519tbYSrqzvx0hF9Y2Ve.XkMd175amqSVqRQq8/J.d0mULH/D6C', 'admin', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-11-26 21:29:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ad_spaces`
--
ALTER TABLE `ad_spaces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
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
-- Indexes for table `gallery_categories`
--
ALTER TABLE `gallery_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll_votes`
--
ALTER TABLE `poll_votes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_images`
--
ALTER TABLE `post_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reactions`
--
ALTER TABLE `reactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reading_lists`
--
ALTER TABLE `reading_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ad_spaces`
--
ALTER TABLE `ad_spaces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_categories`
--
ALTER TABLE `gallery_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poll_votes`
--
ALTER TABLE `poll_votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_images`
--
ALTER TABLE `post_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reactions`
--
ALTER TABLE `reactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reading_lists`
--
ALTER TABLE `reading_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
