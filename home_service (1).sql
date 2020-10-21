-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2020 at 04:38 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `home_service`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `created_at`, `updated_at`) VALUES
(1, '2020-04-23 02:46:19', '2020-04-23 02:46:19');

-- --------------------------------------------------------

--
-- Table structure for table `about_translations`
--

CREATE TABLE `about_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `about_id` int(10) UNSIGNED NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_translations`
--

INSERT INTO `about_translations` (`id`, `about_id`, `body`, `locale`) VALUES
(1, 1, 'من نحن من نحن من نحن من نحن من نحن', 'ar'),
(2, 1, 'about us  about us  about us  about us', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identity_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience_years` int(11) NOT NULL,
  `hourly_wage` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expire_date` date NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identity_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `plan_id` int(10) UNSIGNED NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL,
  `job_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `name`, `identity_number`, `email`, `password`, `location`, `phone`, `experience`, `experience_years`, `hourly_wage`, `expire_date`, `image`, `identity_image`, `details`, `api_token`, `fcm_token`, `active`, `plan_id`, `city_id`, `job_id`, `created_at`, `updated_at`) VALUES
(19, 'Mohamed Eid', '123123123123', 'test@test.com', '$2y$10$3ffGqjS/RKtZ3l34bUbZq.ZolLfUSiL62uXv4vrBpYYwkb.rJ16iq', '123123123,123123123', '01015960452', 'باك اند ديفولوبر تست تس تس تست تست تست', 1, '50', '2020-11-20', '16031970421147713170.png', '16031970421378609210.png', NULL, 'lom1Ndfi6w5Tpa9ehCebZ1jOdDZZA82042pNiQIZd6bJfDk9FN3c4VdVrILKoGxYe1UlJQKlcpFfHJqwYyPbW9iVhyqXymDCdB5c', '123123123123123', 1, 1, 1, 3, '2020-10-20 12:30:42', '2020-10-20 13:06:01');

-- --------------------------------------------------------

--
-- Table structure for table `agent_bank_accounts`
--

CREATE TABLE `agent_bank_accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iban` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_id` int(10) UNSIGNED NOT NULL,
  `agent_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `agent_service`
--

CREATE TABLE `agent_service` (
  `id` int(10) UNSIGNED NOT NULL,
  `agent_id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agent_service`
--

INSERT INTO `agent_service` (`id`, `agent_id`, `service_id`, `created_at`, `updated_at`) VALUES
(3, 19, 1, '2020-10-20 12:30:42', '2020-10-20 12:30:42'),
(4, 19, 2, '2020-10-20 12:30:42', '2020-10-20 12:30:42');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(10) UNSIGNED NOT NULL,
  `account` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iban` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `account`, `iban`, `image`, `created_at`, `updated_at`) VALUES
(2, '0255555555555', 'KSA125555555555555', 'd2ZF2IPz8I6aEkc6ujUvqVRLjj8FzXF8Rs1fxmIe.png', '2020-05-04 18:58:43', '2020-05-04 18:58:43'),
(3, '0255555555555', 'KSA125555555555555', '9mw1WO2zFi6zOX9PZBTTkZKXIpsUgikNyNmHzVVP.png', '2020-05-04 18:59:39', '2020-05-06 15:10:03'),
(4, '0255555555555', 'KSA125555555555555', 'YcUsrioSt035cdu3CjbSzElMsGaMEyt5xFMCg5Tf.png', '2020-05-04 19:00:50', '2020-05-06 15:10:44');

-- --------------------------------------------------------

--
-- Table structure for table `bank_transfers`
--

CREATE TABLE `bank_transfers` (
  `id` int(10) UNSIGNED NOT NULL,
  `sender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent_id` int(10) UNSIGNED NOT NULL,
  `bank_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_translations`
--

CREATE TABLE `bank_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `bank_id` int(10) UNSIGNED NOT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_translations`
--

INSERT INTO `bank_translations` (`id`, `bank_id`, `bank_name`, `name`, `locale`) VALUES
(1, 1, 'الاهلي', 'تست', 'ar'),
(2, 1, 'Alahly', 'tet', 'en'),
(3, 2, 'البنك الاهلي', 'فلان الفلاني علان', 'ar'),
(4, 2, 'Ahli Bank', 'So and so, so and so', 'en'),
(5, 3, 'مصرف الراجحي', 'فلان الفلاني علان', 'ar'),
(6, 3, 'Al Rajhi Bank', 'So and so, so and so', 'en'),
(7, 4, 'مصرف الانماء', 'فلان الفلاني علان', 'ar'),
(8, 4, 'Development Bank', 'So and so, so and so', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `created_at`, `updated_at`) VALUES
(19, 0, '2020-09-17 15:43:04', '2020-09-17 15:43:04'),
(20, 0, '2020-09-17 15:43:29', '2020-09-17 15:43:29'),
(21, 0, '2020-09-17 15:43:47', '2020-09-17 15:43:47'),
(22, 17, '2020-09-17 17:20:09', '2020-09-17 17:20:09'),
(23, 18, '2020-09-17 17:33:06', '2020-09-17 17:33:35');

-- --------------------------------------------------------

--
-- Table structure for table `category_translations`
--

CREATE TABLE `category_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_translations`
--

INSERT INTO `category_translations` (`id`, `category_id`, `name`, `image`, `locale`) VALUES
(29, 19, 'سوبر ماركت', 'jSedwiMO0e1LN4mfMZIsGMS5SHsoQFl4WI4QE5wm.png', 'ar'),
(30, 19, 'Super Market', 'j0D9YeY53kVXWX3xSopE7mnAJU43yz5sFMS26Win.png', 'en'),
(31, 20, 'لحوم', 'gMlFI7TRnySm2eEhZXKytQy6GPRBNspGUGCPmEu9.png', 'ar'),
(32, 20, 'Meat', 'Mwu8AcZgzHnTS6ulm2KVMD8aAEU8G1H3n1ynoOdp.png', 'en'),
(33, 21, 'دجاج', '1OCgDR9qtrhBMUzurcWqkrE4xUduCkTmBMuZHIHO.png', 'ar'),
(34, 21, 'chickens', 'GsLoWu0Wt2ixtK70cvOTMAlPmNe1lsy2WFUS539b.png', 'en'),
(35, 22, 'مطاعم', 'CNdzHUWVIlUo02rbgbt1XcprmU3TsSoEgZxKQ8I0.png', 'ar'),
(36, 22, 'Restaurants', 'oP6U3ZPZM0MPQwjC4JRo87uYc2fhLlM0MPbn7rtq.png', 'en'),
(37, 23, 'فرعي', 'RvxUrTG3372X5O0WExwMEUKnD7f7mPXzXmiLhjet.png', 'ar'),
(38, 23, 'فرعي', 'cQv6vrElqpSUQT3qtceoHWBdwiWz0QP1U0OMhxFO.png', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-10-17 20:29:25', '2020-10-17 20:29:25'),
(2, 1, '2020-10-17 20:33:10', '2020-10-17 20:33:10');

-- --------------------------------------------------------

--
-- Table structure for table `city_translations`
--

CREATE TABLE `city_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `city_translations`
--

INSERT INTO `city_translations` (`id`, `city_id`, `name`, `locale`, `created_at`, `updated_at`) VALUES
(1, 1, 'المنصوره', 'ar', NULL, NULL),
(2, 1, 'Al Mansoura', 'en', NULL, NULL),
(3, 2, 'تست', 'ar', NULL, NULL),
(4, 2, 'test', 'en', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `created_at`, `updated_at`) VALUES
(1, '2020-10-17 20:09:02', '2020-10-17 20:09:02');

-- --------------------------------------------------------

--
-- Table structure for table `country_translations`
--

CREATE TABLE `country_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `country_translations`
--

INSERT INTO `country_translations` (`id`, `country_id`, `name`, `locale`, `created_at`, `updated_at`) VALUES
(1, 1, 'مصر', 'ar', NULL, NULL),
(2, 1, 'Egypt', 'en', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `coupon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offer` int(11) NOT NULL,
  `expire_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon`, `offer`, `expire_date`, `created_at`, `updated_at`) VALUES
(1, 'cccc', 10, '2020-08-29', '2020-08-05 19:07:18', '2020-08-05 19:14:56');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(10) UNSIGNED NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL,
  `delivered_cost` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `city_id`, `delivered_cost`, `created_at`, `updated_at`) VALUES
(101, 7, 0, '2020-09-17 16:57:27', '2020-09-17 16:57:27'),
(102, 7, 0, '2020-09-17 16:57:40', '2020-09-17 16:57:40'),
(103, 6, 0, '2020-09-17 17:00:48', '2020-09-17 17:00:48'),
(104, 6, 0, '2020-09-17 17:01:02', '2020-09-17 17:01:02');

-- --------------------------------------------------------

--
-- Table structure for table `district_translations`
--

CREATE TABLE `district_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `district_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `district_translations`
--

INSERT INTO `district_translations` (`id`, `district_id`, `name`, `locale`) VALUES
(201, 101, 'الرياض', 'ar'),
(202, 101, 'Riyadh', 'en'),
(203, 102, 'جدة', 'ar'),
(204, 102, 'Jeddah', 'en'),
(205, 103, 'بغداد', 'ar'),
(206, 103, 'Baghdad', 'en'),
(207, 104, 'البصرة', 'ar'),
(208, 104, 'Basra', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE `downloads` (
  `id` int(10) UNSIGNED NOT NULL,
  `play_store_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_store_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `downloads`
--

INSERT INTO `downloads` (`id`, `play_store_link`, `app_store_link`, `created_at`, `updated_at`) VALUES
(1, 'https://play.google.com/store/apps/details?id=com.mrhbaa.kabsh.client', 'https://apps.apple.com/us/app/id1510035790', '2020-05-10 23:44:44', '2020-05-11 10:36:48');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(52, 13, 'KPHXHT9pCmcERHBl.png', '2020-09-17 16:27:33', '2020-09-17 16:27:33'),
(53, 14, '7XlS2RXiEG7LWgOc.png', '2020-09-17 16:30:51', '2020-09-17 16:30:51'),
(54, 17, 'wmGeGM4ndrvzwAL5.png', '2020-09-19 12:43:39', '2020-09-19 12:43:39');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 20, '2020-10-17 21:20:26', '2020-10-17 21:22:11'),
(2, 23, '2020-10-17 21:32:56', '2020-10-17 21:32:56'),
(3, 22, '2020-10-20 11:24:14', '2020-10-20 11:24:14');

-- --------------------------------------------------------

--
-- Table structure for table `job_translations`
--

CREATE TABLE `job_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `job_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_translations`
--

INSERT INTO `job_translations` (`id`, `job_id`, `name`, `locale`, `created_at`, `updated_at`) VALUES
(1, 1, 'تست2', 'ar', NULL, NULL),
(2, 1, 'test2', 'en', NULL, NULL),
(3, 2, 'name ar', 'ar', NULL, NULL),
(4, 2, 'name en', 'en', NULL, NULL),
(5, 3, 'وظيفه 3', 'ar', NULL, NULL),
(6, 3, 'job 3', 'en', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_04_07_043851_create_cities_table', 1),
(4, '2020_04_07_184906_create_districts_table', 1),
(5, '2020_04_07_204105_laratrust_setup_tables', 1),
(6, '2020_04_08_054217_create_products_table', 1),
(7, '2020_04_08_062627_create_product_translations_table', 1),
(8, '2020_04_08_090921_create_clients_table', 1),
(9, '2020_04_08_194101_create_city_translations_table', 1),
(10, '2020_04_08_205240_create_details_table', 1),
(11, '2020_04_08_205329_create_detail_translations_table', 1),
(12, '2020_04_08_233312_create_subdetails_table', 1),
(13, '2020_04_08_233459_create_subdetail_translations_table', 1),
(14, '2020_04_09_184952_create_district_translations_table', 1),
(15, '2020_04_10_021307_create_shoppingcart_table', 1),
(16, '2020_04_10_025157_create_carts_table', 1),
(19, '2020_04_17_190347_create_deliverytimes_table', 2),
(20, '2020_04_17_190528_create_deliverytime_translations_table', 2),
(21, '2020_04_23_045325_create_abouts_table', 3),
(22, '2020_04_23_045524_create_about_translations_table', 3),
(23, '2020_04_25_001235_create_service_numbers_table', 4),
(24, '2020_05_04_192336_create_banks_table', 5),
(25, '2020_05_04_194846_create_bank_translations_table', 5),
(27, '2020_05_09_211159_create_members_table', 6),
(28, '2020_05_11_020425_create_downloads_table', 7),
(29, '2020_06_24_053603_create_categories_table', 8),
(30, '2020_06_24_053727_create_category_translations_table', 8),
(31, '2020_08_03_214134_create_codes_table', 9),
(33, '2020_08_04_161835_create_sizes_table', 10),
(34, '2020_08_04_161908_create_colors_table', 10),
(35, '2020_08_04_162008_create_color_translations_table', 10),
(36, '2020_08_04_163748_create_images_table', 10),
(38, '2020_08_05_204031_create_orders_table', 12),
(39, '2020_08_04_161753_create_coupons_table', 13),
(40, '2020_08_14_150106_create_rates_table', 14),
(41, '2020_08_14_154220_create_taxes_table', 14),
(42, '2020_08_19_190622_create_notifications_table', 15),
(43, '2020_08_20_173845_create_terms_table', 16),
(44, '2020_08_20_173853_create_term_translations_table', 16),
(45, '2020_08_29_230307_create_special_orders_table', 17),
(46, '2020_08_30_064316_create_videos_table', 18),
(47, '2020_08_05_185500_create_shopping_carts_table', 19),
(52, '2020_09_03_234100_create_vendors_table', 20),
(53, '2020_09_03_234415_create_vendor_translations_table', 20),
(57, '2020_09_07_101623_create_members_table', 21),
(58, '2020_09_13_101541_create_sliders_table', 22),
(59, '2020_10_16_171217_create_jobs_table', 23),
(60, '2020_10_16_174225_create_services_table', 23),
(61, '2020_10_16_174311_create_service_translations_table', 23),
(62, '2020_10_16_174559_create_job_translations_table', 23),
(67, '2020_10_17_152757_create_countries_table', 24),
(68, '2020_10_17_152901_create_cities_table', 24),
(69, '2020_10_17_153015_create_country_translations_table', 24),
(70, '2020_10_17_153305_create_city_translations_table', 24),
(72, '2020_10_17_203300_create_plans_table', 25),
(73, '2020_10_17_204245_create_agents_table', 26),
(74, '2020_10_17_202228_create_clients_table', 27),
(75, '2020_10_17_205411_create_bank_transfers_table', 27),
(76, '2020_10_17_205758_create_agent_bank_accounts_table', 27),
(77, '2020_10_17_212109_create_agent_service_table', 28);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'create_users', 'Create Users', 'Create Users', '2020-04-13 18:56:17', '2020-04-13 18:56:17'),
(2, 'read_users', 'Read Users', 'Read Users', '2020-04-13 18:56:17', '2020-04-13 18:56:17'),
(3, 'update_users', 'Update Users', 'Update Users', '2020-04-13 18:56:17', '2020-04-13 18:56:17'),
(4, 'delete_users', 'Delete Users', 'Delete Users', '2020-04-13 18:56:17', '2020-04-13 18:56:17'),
(5, 'create_products', 'Create Products', 'Create Products', '2020-04-13 18:56:18', '2020-04-13 18:56:18'),
(6, 'read_products', 'Read Products', 'Read Products', '2020-04-13 18:56:18', '2020-04-13 18:56:18'),
(7, 'update_products', 'Update Products', 'Update Products', '2020-04-13 18:56:18', '2020-04-13 18:56:18'),
(8, 'delete_products', 'Delete Products', 'Delete Products', '2020-04-13 18:56:18', '2020-04-13 18:56:18'),
(9, 'create_cities', 'Create Cities', 'Create Cities', '2020-04-13 18:56:18', '2020-04-13 18:56:18'),
(10, 'read_cities', 'Read Cities', 'Read Cities', '2020-04-13 18:56:18', '2020-04-13 18:56:18'),
(11, 'update_cities', 'Update Cities', 'Update Cities', '2020-04-13 18:56:19', '2020-04-13 18:56:19'),
(12, 'delete_cities', 'Delete Cities', 'Delete Cities', '2020-04-13 18:56:19', '2020-04-13 18:56:19'),
(13, 'create_districts', 'Create Districts', 'Create Districts', '2020-04-13 18:56:19', '2020-04-13 18:56:19'),
(14, 'read_districts', 'Read Districts', 'Read Districts', '2020-04-13 18:56:19', '2020-04-13 18:56:19'),
(15, 'update_districts', 'Update Districts', 'Update Districts', '2020-04-13 18:56:19', '2020-04-13 18:56:19'),
(16, 'delete_districts', 'Delete Districts', 'Delete Districts', '2020-04-13 18:56:19', '2020-04-13 18:56:19'),
(17, 'read_details', 'Read Details', 'Read Details', '2020-04-13 15:56:17', '2020-04-13 15:56:17'),
(18, 'create_details', 'Create Details', 'Create Details', '2020-04-13 15:56:17', '2020-04-13 15:56:17'),
(19, 'update_details', 'Update Details', 'Update Details', '2020-04-13 15:56:17', '2020-04-13 15:56:17'),
(20, 'delete_details', 'Delete Details', 'Delete Details', '2020-04-13 15:56:17', '2020-04-13 15:56:17'),
(21, 'create_subdetails', 'Create subdetails', 'Create subdetails', '2020-04-13 15:56:17', '2020-04-13 15:56:17'),
(22, 'read_subdetails', 'Read subdetails', 'Read subdetails', '2020-04-13 15:56:17', '2020-04-13 15:56:17'),
(23, 'update_subdetails', 'Update subdetails', 'Update subdetails', '2020-04-13 15:56:17', '2020-04-13 15:56:17'),
(24, 'delete_subdetails', 'Delete subdetails', 'Delete subdetails', '2020-04-13 15:56:17', '2020-04-13 15:56:17'),
(25, 'read_sales', 'Read sales', 'Read sales', '2020-04-13 15:56:17', '2020-04-13 15:56:17'),
(26, 'read_orders', 'Read orders', 'Read orders', '2020-04-13 15:56:17', '2020-04-13 15:56:17'),
(27, 'update_orders', 'Update orders', 'Update orders', '2020-04-13 15:56:17', '2020-04-13 15:56:17'),
(28, 'delete_orders', 'Delete orders', 'Delete orders', '2020-04-13 15:56:17', '2020-04-13 15:56:17'),
(29, 'read_members', 'Read members', 'Read members', '2020-04-13 15:56:17', '2020-04-13 15:56:17'),
(30, 'read_service_numbers', 'Read service_numbers', 'Read service_numbers', '2020-04-13 15:56:17', '2020-04-13 15:56:17'),
(31, 'update_service_numbers', 'Update service_numbers', 'Update service_numbers', '2020-04-13 15:56:17', '2020-04-13 15:56:17'),
(32, 'create_banks', 'Create banks', 'Create banks', '2020-04-13 15:56:17', '2020-04-13 15:56:17'),
(33, 'read_banks', 'Read banks', 'Read banks', '2020-04-13 15:56:17', '2020-04-13 15:56:17'),
(34, 'update_banks', 'Update banks', 'Update banks', '2020-04-13 15:56:17', '2020-04-13 15:56:17'),
(35, 'delete_banks', 'Delete banks', 'Delete banks', '2020-04-13 15:56:17', '2020-04-13 15:56:17'),
(36, 'read_categories', 'Read Categories', 'Read Categories', '2020-04-13 16:56:17', '2020-04-13 16:56:17'),
(37, 'create_categories', 'Create Categories', 'Create Categories', '2020-04-13 16:56:17', '2020-04-13 16:56:17'),
(38, 'update_categories', 'Update Categories', 'Update Categories', '2020-04-13 16:56:17', '2020-04-13 16:56:17'),
(39, 'delete_categories', 'Delete Categories', 'Delete Categories', '2020-04-13 16:56:17', '2020-04-13 16:56:17'),
(40, 'create_coupons', 'Create Coupons', 'Create Coupons', '2020-04-13 16:56:17', '2020-04-13 16:56:17'),
(41, 'read_coupons', 'Read Coupons', 'Read Coupons', '2020-04-13 16:56:17', '2020-04-13 16:56:17'),
(42, 'update_coupons', 'Update Coupons', 'Update Coupons', '2020-04-13 16:56:17', '2020-04-13 16:56:17'),
(43, 'delete_coupons', 'Delete Coupons', 'Delete Coupons', '2020-04-13 16:56:17', '2020-04-13 16:56:17'),
(44, 'create_notifications', 'Create Notifications', 'Create Notifications', '2020-04-13 16:56:17', '2020-04-13 16:56:17'),
(45, 'update_about_us', 'Update About Us', 'Update About Us', '2020-04-13 16:56:17', '2020-04-13 16:56:17'),
(46, 'update_terms', 'Update Terms', 'Update Terms', '2020-04-13 16:56:17', '2020-04-13 16:56:17');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_user`
--

INSERT INTO `permission_user` (`permission_id`, `user_id`, `user_type`) VALUES
(1, 4, 'App\\User'),
(2, 4, 'App\\User'),
(3, 4, 'App\\User'),
(5, 4, 'App\\User'),
(6, 4, 'App\\User'),
(7, 4, 'App\\User'),
(8, 4, 'App\\User'),
(9, 4, 'App\\User'),
(10, 4, 'App\\User'),
(11, 4, 'App\\User'),
(12, 4, 'App\\User'),
(13, 4, 'App\\User'),
(14, 4, 'App\\User'),
(15, 4, 'App\\User'),
(16, 4, 'App\\User'),
(17, 4, 'App\\User'),
(19, 4, 'App\\User'),
(22, 4, 'App\\User'),
(23, 4, 'App\\User'),
(24, 4, 'App\\User'),
(25, 4, 'App\\User'),
(26, 4, 'App\\User'),
(30, 4, 'App\\User'),
(31, 4, 'App\\User'),
(33, 4, 'App\\User'),
(1, 5, 'App\\User'),
(2, 5, 'App\\User'),
(3, 5, 'App\\User'),
(4, 5, 'App\\User'),
(5, 5, 'App\\User'),
(6, 5, 'App\\User'),
(7, 5, 'App\\User'),
(8, 5, 'App\\User'),
(9, 5, 'App\\User'),
(10, 5, 'App\\User'),
(11, 5, 'App\\User'),
(12, 5, 'App\\User'),
(13, 5, 'App\\User'),
(14, 5, 'App\\User'),
(15, 5, 'App\\User'),
(16, 5, 'App\\User'),
(17, 5, 'App\\User'),
(18, 5, 'App\\User'),
(19, 5, 'App\\User'),
(20, 5, 'App\\User'),
(21, 5, 'App\\User'),
(22, 5, 'App\\User'),
(23, 5, 'App\\User'),
(24, 5, 'App\\User'),
(25, 5, 'App\\User'),
(26, 5, 'App\\User'),
(27, 5, 'App\\User'),
(28, 5, 'App\\User'),
(29, 5, 'App\\User'),
(30, 5, 'App\\User'),
(31, 5, 'App\\User'),
(32, 5, 'App\\User'),
(33, 5, 'App\\User'),
(34, 5, 'App\\User'),
(35, 5, 'App\\User'),
(1, 7, 'App\\User'),
(2, 7, 'App\\User'),
(3, 7, 'App\\User'),
(4, 7, 'App\\User'),
(5, 7, 'App\\User'),
(6, 7, 'App\\User'),
(7, 7, 'App\\User'),
(8, 7, 'App\\User'),
(9, 7, 'App\\User'),
(10, 7, 'App\\User'),
(11, 7, 'App\\User'),
(12, 7, 'App\\User'),
(13, 7, 'App\\User'),
(14, 7, 'App\\User'),
(15, 7, 'App\\User'),
(16, 7, 'App\\User'),
(17, 7, 'App\\User'),
(18, 7, 'App\\User'),
(19, 7, 'App\\User'),
(20, 7, 'App\\User'),
(21, 7, 'App\\User'),
(22, 7, 'App\\User'),
(23, 7, 'App\\User'),
(24, 7, 'App\\User'),
(26, 7, 'App\\User'),
(27, 7, 'App\\User'),
(28, 7, 'App\\User'),
(29, 7, 'App\\User'),
(30, 7, 'App\\User'),
(31, 7, 'App\\User'),
(32, 7, 'App\\User'),
(33, 7, 'App\\User'),
(34, 7, 'App\\User'),
(35, 7, 'App\\User'),
(36, 7, 'App\\User'),
(37, 7, 'App\\User'),
(38, 7, 'App\\User'),
(39, 7, 'App\\User'),
(40, 7, 'App\\User'),
(41, 7, 'App\\User'),
(42, 7, 'App\\User'),
(43, 7, 'App\\User'),
(44, 7, 'App\\User'),
(45, 7, 'App\\User'),
(46, 7, 'App\\User');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(10) UNSIGNED NOT NULL,
  `month_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `month_count`, `created_at`, `updated_at`) VALUES
(1, 6, '2020-10-17 20:54:10', '2020-10-17 20:54:10'),
(2, 3, '2020-10-17 20:55:55', '2020-10-17 20:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `rate` int(11) NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'Super Admin', 'Super Admin', '2020-04-13 18:56:16', '2020-04-13 18:56:16'),
(2, 'admin', 'Admin', 'Admin', '2020-04-13 18:56:21', '2020-04-13 18:56:21');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(2, 4, 'App\\User'),
(2, 5, 'App\\User'),
(2, 7, 'App\\User');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 22, '2020-10-17 21:30:27', '2020-10-17 21:34:01'),
(2, 22, '2020-10-17 21:46:42', '2020-10-17 21:46:42'),
(3, 19, '2020-10-17 21:46:54', '2020-10-17 21:46:54');

-- --------------------------------------------------------

--
-- Table structure for table `service_translations`
--

CREATE TABLE `service_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_translations`
--

INSERT INTO `service_translations` (`id`, `service_id`, `name`, `locale`, `created_at`, `updated_at`) VALUES
(1, 1, 'تست2', 'ar', NULL, NULL),
(2, 1, 'test2', 'en', NULL, NULL),
(3, 2, 'تست', 'ar', NULL, NULL),
(4, 2, 'test', 'en', NULL, NULL),
(5, 3, 'تست112', 'ar', NULL, NULL),
(6, 3, 'test121', 'en', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `created_at`, `updated_at`) VALUES
(1, '2020-08-20 15:47:45', '2020-08-20 15:47:45');

-- --------------------------------------------------------

--
-- Table structure for table `term_translations`
--

CREATE TABLE `term_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `term_translations`
--

INSERT INTO `term_translations` (`id`, `term_id`, `body`, `locale`) VALUES
(1, 1, 'شروط واحكااام شروط واحكااام شروط واحكااام شروط واحكااام', 'ar'),
(2, 1, 'terms and conditions\r\nterms and conditions\r\nterms and conditions\r\nterms and conditions\r\nterms and conditions\r\nterms and conditions', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `image`, `email_verified_at`, `password`, `api_token`, `fcm_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 'Backend', '2Dev', 'test@test.com', 'default.png', NULL, '$2y$10$/m7n9TcXdvca5qhKJev14.oXutvJhSUKMW2GSw9FD/bU.9ba6ayPu', NULL, NULL, '99meiJQIXRJ54wPEgtcllddo8IgxTpf0lYa0wMWc32Z22XKsSxEyKU8ALwfo', '2020-06-16 21:49:58', '2020-06-24 03:47:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `about_translations`
--
ALTER TABLE `about_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `about_translations_about_id_locale_unique` (`about_id`,`locale`),
  ADD KEY `about_translations_locale_index` (`locale`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agents_plan_id_foreign` (`plan_id`),
  ADD KEY `agents_city_id_foreign` (`city_id`),
  ADD KEY `agents_job_id_foreign` (`job_id`);

--
-- Indexes for table `agent_bank_accounts`
--
ALTER TABLE `agent_bank_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agent_bank_accounts_bank_id_foreign` (`bank_id`),
  ADD KEY `agent_bank_accounts_agent_id_foreign` (`agent_id`);

--
-- Indexes for table `agent_service`
--
ALTER TABLE `agent_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agent_service_agent_id_foreign` (`agent_id`),
  ADD KEY `agent_service_service_id_foreign` (`service_id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_transfers`
--
ALTER TABLE `bank_transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_transfers_agent_id_foreign` (`agent_id`),
  ADD KEY `bank_transfers_bank_id_foreign` (`bank_id`);

--
-- Indexes for table `bank_translations`
--
ALTER TABLE `bank_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bank_translations_bank_id_locale_unique` (`bank_id`,`locale`),
  ADD KEY `bank_translations_locale_index` (`locale`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_translations`
--
ALTER TABLE `category_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_translations_category_id_locale_unique` (`category_id`,`locale`),
  ADD KEY `category_translations_locale_index` (`locale`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_country_id_foreign` (`country_id`);

--
-- Indexes for table `city_translations`
--
ALTER TABLE `city_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `city_translations_city_id_locale_unique` (`city_id`,`locale`),
  ADD KEY `city_translations_locale_index` (`locale`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_city_id_foreign` (`city_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country_translations`
--
ALTER TABLE `country_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `country_translations_country_id_locale_unique` (`country_id`,`locale`),
  ADD KEY `country_translations_locale_index` (`locale`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `districts_city_id_foreign` (`city_id`);

--
-- Indexes for table `district_translations`
--
ALTER TABLE `district_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `district_translations_district_id_locale_unique` (`district_id`,`locale`),
  ADD KEY `district_translations_locale_index` (`locale`);

--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_product_id_foreign` (`product_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_category_id_foreign` (`category_id`);

--
-- Indexes for table `job_translations`
--
ALTER TABLE `job_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `job_translations_job_id_locale_unique` (`job_id`,`locale`),
  ADD KEY `job_translations_locale_index` (`locale`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  ADD KEY `permission_user_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rates_product_id_foreign` (`product_id`),
  ADD KEY `rates_client_id_foreign` (`client_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_category_id_foreign` (`category_id`);

--
-- Indexes for table `service_translations`
--
ALTER TABLE `service_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_translations_service_id_locale_unique` (`service_id`,`locale`),
  ADD KEY `service_translations_locale_index` (`locale`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `term_translations`
--
ALTER TABLE `term_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `term_translations_term_id_locale_unique` (`term_id`,`locale`),
  ADD KEY `term_translations_locale_index` (`locale`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `about_translations`
--
ALTER TABLE `about_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `agent_bank_accounts`
--
ALTER TABLE `agent_bank_accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agent_service`
--
ALTER TABLE `agent_service`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bank_transfers`
--
ALTER TABLE `bank_transfers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_translations`
--
ALTER TABLE `bank_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `category_translations`
--
ALTER TABLE `category_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `city_translations`
--
ALTER TABLE `city_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `country_translations`
--
ALTER TABLE `country_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `district_translations`
--
ALTER TABLE `district_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job_translations`
--
ALTER TABLE `job_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service_translations`
--
ALTER TABLE `service_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `term_translations`
--
ALTER TABLE `term_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agents`
--
ALTER TABLE `agents`
  ADD CONSTRAINT `agents_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `agents_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `agent_bank_accounts`
--
ALTER TABLE `agent_bank_accounts`
  ADD CONSTRAINT `agent_bank_accounts_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `agent_bank_accounts_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `agent_service`
--
ALTER TABLE `agent_service`
  ADD CONSTRAINT `agent_service_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `agent_service_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bank_transfers`
--
ALTER TABLE `bank_transfers`
  ADD CONSTRAINT `bank_transfers_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bank_transfers_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `category_translations`
--
ALTER TABLE `category_translations`
  ADD CONSTRAINT `category_translations_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `city_translations`
--
ALTER TABLE `city_translations`
  ADD CONSTRAINT `city_translations_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `country_translations`
--
ALTER TABLE `country_translations`
  ADD CONSTRAINT `country_translations_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `district_translations`
--
ALTER TABLE `district_translations`
  ADD CONSTRAINT `district_translations_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
