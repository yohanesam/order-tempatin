-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 08, 2020 at 06:15 PM
-- Server version: 10.3.23-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsit_tempatin`
--
CREATE DATABASE IF NOT EXISTS `skripsit_tempatin` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `skripsit_tempatin`;

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `id_building` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `building_type_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_bangunan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_bangunan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_lantai` int(11) NOT NULL,
  `deskripsi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `negara` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_pos` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_tempat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`id_building`, `user_id`, `building_type_id`, `nama_bangunan`, `foto_bangunan`, `jumlah_lantai`, `deskripsi`, `alamat`, `kota`, `provinsi`, `negara`, `kode_pos`, `status_tempat`, `created_at`, `updated_at`) VALUES
(1, 7, '2', 'Wisma 76', '[\"SNOWDEN.jpg\",\"Snowden-Movie-Review-Oliver-Stone-Edward-Snowden.jpg\"]', 12, '<font size=\"5\">Sewa</font>', 'Jl. Letjen, palmerah, bogor', '151', '6', 'Indonesia', '1111', 'draft', '2020-04-03 10:38:05', '2020-07-07 08:27:37'),
(2, 7, '3', 'The HOP', '[\"hop.png\",\"hop1.png\",\"hop2.png\"]', 2, '<a href=\"https://www.instagram.com/hop_bip/\">@HOP_BIP</a><div>House Of Production&nbsp;<a href=\"https://www.instagram.com/bip_inc/\">@bip_inc</a></div>', 'Jl. Ridwan Rais, Perumahan Politeknik No.7, Beji Tim., Kecamatan Beji.', '22', '9', 'Indonesia', '16422', 'publish', '2020-04-09 11:05:13', '2020-07-07 08:27:51');

-- --------------------------------------------------------

--
-- Table structure for table `building_types`
--

CREATE TABLE `building_types` (
  `id_building_type` bigint(20) UNSIGNED NOT NULL,
  `nama_tipe` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_tipe` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `building_types`
--

INSERT INTO `building_types` (`id_building_type`, `nama_tipe`, `status_tipe`, `created_at`, `updated_at`) VALUES
(1, 'Restoran', 'draft', '2020-04-01 12:17:49', '2020-04-01 12:17:49'),
(2, 'Gedung', 'publish', '2020-04-01 12:19:06', '2020-04-01 12:20:18'),
(3, 'Rumah', 'draft', '2020-04-01 12:19:20', '2020-04-01 12:19:20'),
(4, 'Ruko', 'draft', '2020-04-01 12:19:32', '2020-04-01 12:19:32');

-- --------------------------------------------------------

--
-- Table structure for table `category_details`
--

CREATE TABLE `category_details` (
  `id_category_detail` bigint(20) UNSIGNED NOT NULL,
  `room_category_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_details`
--

INSERT INTO `category_details` (`id_category_detail`, `room_category_id`, `room_id`, `created_at`, `updated_at`) VALUES
(2, 7, 2, '2020-04-14 02:01:50', '2020-04-14 02:01:50'),
(3, 10, 3, '2020-04-14 02:06:29', '2020-04-14 02:06:29'),
(16, 7, 4, '2020-05-18 23:20:17', '2020-05-18 23:20:17'),
(17, 9, 4, '2020-05-18 23:20:17', '2020-05-18 23:20:17'),
(18, 10, 4, '2020-05-18 23:20:17', '2020-05-18 23:20:17'),
(19, 11, 4, '2020-05-18 23:20:17', '2020-05-18 23:20:17'),
(20, 12, 4, '2020-05-18 23:20:17', '2020-05-18 23:20:17'),
(27, 9, 1, '2020-07-07 17:06:22', '2020-07-07 17:06:22');

-- --------------------------------------------------------

--
-- Table structure for table `facility_categories`
--

CREATE TABLE `facility_categories` (
  `id_facility_category` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 2,
  `nama_fasilitas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_fasilitas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facility_categories`
--

INSERT INTO `facility_categories` (`id_facility_category`, `user_id`, `nama_fasilitas`, `gambar_fasilitas`, `created_at`, `updated_at`) VALUES
(1, 2, '24/7 Access', 'fasilitas/24_access.png', '2020-03-24 19:47:33', '2020-06-22 18:53:42'),
(2, 2, 'Airconditioning Use', 'fasilitas/air_conditioner.png', '2020-03-24 19:48:23', '2020-06-22 18:57:09'),
(3, 2, 'Coffee', 'fasilitas/cofee.png', '2020-03-24 19:48:40', '2020-06-22 18:57:30'),
(4, 2, 'Lights and Sounds', 'fasilitas/sound.png', '2020-03-24 19:49:34', '2020-06-22 18:58:47'),
(5, 2, 'Office Suite', 'fasilitas/office_suites.png', '2020-03-24 19:49:57', '2020-06-22 19:08:56'),
(6, 2, 'Printer', 'fasilitas/printer.png', '2020-03-24 19:50:18', '2020-06-22 18:59:36'),
(7, 2, 'Reception Area', 'fasilitas/reception_area.png', '2020-03-24 19:50:56', '2020-06-22 19:00:19'),
(8, 2, 'Tea', 'fasilitas/tea.png', '2020-03-24 19:51:12', '2020-06-22 19:00:51'),
(9, 2, 'Wifi Access', 'fasilitas/wifi.png', '2020-03-24 19:51:34', '2020-06-22 19:01:00'),
(10, 2, 'High Speed Internet', 'fasilitas/high_speed_internet.png', '2020-03-24 19:53:42', '2020-06-22 19:01:13'),
(11, 2, 'Charge Plug', 'fasilitas/charge_plug.png', '2020-06-25 01:38:55', '2020-06-25 01:38:55');

-- --------------------------------------------------------

--
-- Table structure for table `facility_details`
--

CREATE TABLE `facility_details` (
  `id_facility_detail` bigint(20) UNSIGNED NOT NULL,
  `facility_category_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `merk_fasilitas` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_fasilitas` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_fasilitas` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facility_details`
--

INSERT INTO `facility_details` (`id_facility_detail`, `facility_category_id`, `room_id`, `merk_fasilitas`, `foto_fasilitas`, `status_fasilitas`, `created_at`, `updated_at`) VALUES
(3, 2, 2, '', '', '', '2020-04-14 02:01:50', '2020-04-14 02:01:50'),
(4, 4, 2, '', '', '', '2020-04-14 02:01:51', '2020-04-14 02:01:51'),
(5, 9, 2, '', '', '', '2020-04-14 02:01:51', '2020-04-14 02:01:51'),
(6, 3, 3, '', '', '', '2020-04-14 02:06:29', '2020-04-14 02:06:29'),
(7, 8, 3, '', '', '', '2020-04-14 02:06:29', '2020-04-14 02:06:29'),
(8, 9, 3, '', '', '', '2020-04-14 02:06:30', '2020-04-14 02:06:30'),
(53, 9, 1, NULL, NULL, NULL, '2020-07-07 17:06:22', '2020-07-07 17:06:22'),
(52, 2, 1, NULL, NULL, NULL, '2020-07-07 17:06:22', '2020-07-07 17:06:22'),
(32, 1, 4, '', '', '', '2020-05-18 23:20:18', '2020-05-18 23:20:18'),
(33, 2, 4, '', '', '', '2020-05-18 23:20:18', '2020-05-18 23:20:18'),
(34, 3, 4, '', '', '', '2020-05-18 23:20:19', '2020-05-18 23:20:19'),
(35, 4, 4, '', '', '', '2020-05-18 23:20:19', '2020-05-18 23:20:19'),
(36, 5, 4, '', '', '', '2020-05-18 23:20:19', '2020-05-18 23:20:19'),
(37, 6, 4, '', '', '', '2020-05-18 23:20:19', '2020-05-18 23:20:19'),
(38, 7, 4, '', '', '', '2020-05-18 23:20:19', '2020-05-18 23:20:19'),
(39, 8, 4, '', '', '', '2020-05-18 23:20:19', '2020-05-18 23:20:19'),
(40, 9, 4, '', '', '', '2020-05-18 23:20:19', '2020-05-18 23:20:19'),
(41, 10, 4, '', '', '', '2020-05-18 23:20:19', '2020-05-18 23:20:19');

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id_form` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_formulir` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_data` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_formulir` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id_form`, `user_id`, `nama_formulir`, `nama_data`, `status_formulir`, `created_at`, `updated_at`) VALUES
(12, 7, 'Formulir Hop', 'Customer Hop', 'publish', '2020-04-13 01:53:41', '2020-04-13 16:38:47'),
(13, 1, 'Formulir Individu', 'Individu', 'publish', '2020-04-13 01:56:17', '2020-04-13 01:56:17'),
(14, 1, 'Formulir Komunitas', 'Komunitas', 'draft', '2020-04-13 01:57:15', '2020-04-13 03:22:42');

-- --------------------------------------------------------

--
-- Table structure for table `form_contents`
--

CREATE TABLE `form_contents` (
  `id_form_content` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `form_detail_id` int(11) NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form_contents`
--

INSERT INTO `form_contents` (`id_form_content`, `order_id`, `form_detail_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 2, 65, 'Aryo', '2020-07-05 03:51:46', '2020-07-05 03:51:46'),
(2, 2, 66, '12-13 tahun', '2020-07-05 03:51:46', '2020-07-05 03:51:46'),
(3, 2, 67, 'kumpul remaja', '2020-07-05 03:51:46', '2020-07-05 03:51:46'),
(4, 3, 35, 'Aryo', '2020-07-05 03:59:31', '2020-07-05 03:59:31'),
(5, 3, 36, '12-13 tahun', '2020-07-05 03:59:31', '2020-07-05 03:59:31'),
(6, 3, 37, 'kumpul remaja', '2020-07-05 03:59:31', '2020-07-05 03:59:31'),
(7, 15, 48, 'contoh 1', '2020-07-07 18:13:49', '2020-07-07 18:13:49'),
(8, 15, 47, 'sepak bola', '2020-07-07 18:13:49', '2020-07-07 18:13:49'),
(9, 16, 48, 'contoh 1', '2020-07-07 18:34:06', '2020-07-07 18:34:06'),
(10, 16, 47, 'sepak bola', '2020-07-07 18:34:06', '2020-07-07 18:34:06'),
(11, 17, 48, 'contoh 1', '2020-07-07 20:43:43', '2020-07-07 20:43:43'),
(12, 17, 47, 'sepak bola', '2020-07-07 20:43:43', '2020-07-07 20:43:43');

-- --------------------------------------------------------

--
-- Table structure for table `form_details`
--

CREATE TABLE `form_details` (
  `id_form_detail` bigint(20) UNSIGNED NOT NULL,
  `form_id` int(11) NOT NULL,
  `nama_kolom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_input` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_awal` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form_details`
--

INSERT INTO `form_details` (`id_form_detail`, `form_id`, `nama_kolom`, `tipe_input`, `input_awal`, `status_value`, `created_at`, `updated_at`) VALUES
(36, 13, 'Umur', 'checkbox', '[\"12-13 tahun\",\" 17-20 tahun\",\" 30 tahun keatas\"]', '0', '2020-06-30 20:08:30', '2020-06-30 20:08:30'),
(35, 13, 'Nama', 'text', '[\"test nama\"]', '0', '2020-06-30 20:08:30', '2020-06-30 20:08:30'),
(38, 14, 'Nama Komunitas', 'text', '[\"tulis nama...\"]', '1', '2020-06-30 20:08:42', '2020-06-30 20:08:42'),
(48, 12, 'cek box', 'checkbox', '[\"contoh 1\",\" contoh 2\"]', '1', '2020-07-01 17:50:08', '2020-07-01 17:50:08'),
(47, 12, 'Hobi', 'selection', '[\"sepak bola\",\" memasak\",\" fotografi\"]', '1', '2020-07-01 17:50:08', '2020-07-01 17:50:08'),
(37, 13, 'Skill', 'selection', '[\"IT\",\" TG\",\" Elektro\"]', '0', '2020-06-30 20:08:30', '2020-06-30 20:08:30'),
(46, 12, 'Tujuan Acara', 'textarea', '[\"\"]', '1', '2020-07-01 17:50:08', '2020-07-01 17:50:08'),
(45, 12, 'Umur', 'radio', '[\"12 tahun\",\"13 tahun\"]', '1', '2020-07-01 17:50:08', '2020-07-01 17:50:08'),
(44, 12, 'Nama', 'text', '[\"\"]', '1', '2020-07-01 17:50:08', '2020-07-01 17:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_03_10_053911_create_buildings_table', 1),
(4, '2020_03_10_054237_create_rooms_table', 1),
(5, '2020_03_10_054424_create_room_categories_table', 1),
(6, '2020_03_10_054723_create_category_details_table', 1),
(7, '2020_03_10_054746_create_setups_table', 1),
(8, '2020_03_10_055139_create_setup_details_table', 1),
(9, '2020_03_10_055206_create_building_types_table', 1),
(10, '2020_03_10_070718_create_facility_categories_table', 1),
(11, '2020_03_10_071303_create_facility_details_table', 1),
(12, '2020_03_10_071504_create_packages_table', 1),
(13, '2020_03_10_071523_create_package_details_table', 1),
(14, '2020_03_10_071646_create_promos_table', 1),
(15, '2020_03_10_071710_create_promo_details_table', 1),
(16, '2020_03_10_071757_create_orders_table', 1),
(17, '2020_03_10_071814_create_order_details_table', 1),
(18, '2020_03_10_071947_create_forms_table', 1),
(19, '2020_03_10_072002_create_form_details_table', 1),
(20, '2020_03_10_072025_create_form_contents_table', 1),
(21, '2020_03_10_072046_create_schedules_table', 1),
(22, '2020_03_10_072126_create_reviews_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `form_id` int(11) DEFAULT NULL,
  `setup_id` int(11) DEFAULT NULL,
  `promo_detail_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `method_pay` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost_total` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_order` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `invoice_id`, `user_id`, `room_id`, `form_id`, `setup_id`, `promo_detail_id`, `start_date`, `end_date`, `method_pay`, `cost_total`, `status_order`, `created_at`, `updated_at`) VALUES
(1, NULL, 3, 3, 12, NULL, NULL, NULL, NULL, NULL, '260000', 'UNPAID', '2020-07-04 21:13:56', '2020-07-04 21:13:56'),
(2, NULL, 3, 3, 12, NULL, NULL, NULL, NULL, NULL, '260000', 'UNPAID', '2020-07-05 03:51:46', '2020-07-05 03:51:46'),
(3, NULL, 3, 3, 12, NULL, NULL, NULL, NULL, NULL, '260000', 'UNPAID', '2020-07-05 03:59:31', '2020-07-05 03:59:31'),
(4, NULL, 3, 1, 12, 1, 2, '2020-06-29', '2020-07-03', NULL, NULL, 'UNPAID', '2020-07-07 17:01:22', '2020-07-07 17:01:22'),
(5, NULL, 3, 1, 12, 1, NULL, '2020-06-29', '2020-07-03', NULL, NULL, 'UNPAID', '2020-07-07 17:01:31', '2020-07-07 17:01:31'),
(6, NULL, 3, 1, 12, 1, NULL, '2020-06-29', '2020-07-03', NULL, NULL, 'UNPAID', '2020-07-07 17:05:02', '2020-07-07 17:05:02'),
(7, NULL, 3, 1, 12, 1, NULL, '2020-06-29', '2020-07-03', NULL, NULL, 'UNPAID', '2020-07-07 17:05:07', '2020-07-07 17:05:07'),
(8, NULL, 3, 1, 12, 1, NULL, '2020-06-29', '2020-07-03', NULL, NULL, 'UNPAID', '2020-07-07 17:05:11', '2020-07-07 17:05:11'),
(9, NULL, 3, 1, 12, 1, NULL, '2020-06-29', '2020-07-03', NULL, NULL, 'UNPAID', '2020-07-07 17:05:15', '2020-07-07 17:05:15'),
(10, NULL, 3, 1, 12, 1, NULL, '2020-06-29', '2020-07-03', NULL, NULL, 'UNPAID', '2020-07-07 17:05:35', '2020-07-07 17:05:35'),
(11, NULL, 3, 1, 12, 1, NULL, '2020-06-29', '2020-07-03', NULL, NULL, 'UNPAID', '2020-07-07 17:06:41', '2020-07-07 17:06:41'),
(12, NULL, 3, 1, 12, 1, NULL, '2020-06-29', '2020-07-03', NULL, NULL, 'UNPAID', '2020-07-07 17:26:44', '2020-07-07 17:26:44'),
(13, NULL, 3, 1, 12, 1, NULL, '2020-06-29', '2020-07-03', NULL, NULL, 'UNPAID', '2020-07-07 18:07:18', '2020-07-07 18:07:18'),
(14, NULL, 3, 1, 12, 1, NULL, '2020-06-29', '2020-07-03', NULL, NULL, 'UNPAID', '2020-07-07 18:08:15', '2020-07-07 18:08:15'),
(15, NULL, 3, 1, 12, 1, NULL, '2020-06-29', '2020-07-03', NULL, '860000', 'UNPAID', '2020-07-07 18:13:49', '2020-07-07 18:13:49'),
(16, NULL, 3, 1, 12, 1, NULL, '2020-06-29', '2020-07-03', NULL, '860000', 'UNPAID', '2020-07-07 18:34:06', '2020-07-07 18:34:06'),
(17, NULL, 3, 1, 12, 1, NULL, '2020-06-29', '2020-07-03', NULL, '860000', 'UNPAID', '2020-07-07 20:43:43', '2020-07-07 20:43:43');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id_order_detail` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `date_day` date DEFAULT NULL,
  `jam_mulai` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jam_selesai` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_package` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id_order_detail`, `order_id`, `package_id`, `schedule_id`, `date_day`, `jam_mulai`, `jam_selesai`, `total_package`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 7, NULL, '06:00', '12:00', 1, '2020-07-04 21:13:56', '2020-07-04 21:13:56'),
(2, 1, 1, 7, NULL, '12:00', '13:00', 1, '2020-07-04 21:13:56', '2020-07-04 21:13:56'),
(3, 2, 4, 7, NULL, '06:00', '12:00', 1, '2020-07-05 03:51:46', '2020-07-05 03:51:46'),
(4, 2, 1, 7, NULL, '12:00', '13:00', 1, '2020-07-05 03:51:46', '2020-07-05 03:51:46'),
(5, 3, 4, 7, NULL, '06:00', '12:00', 1, '2020-07-05 03:59:31', '2020-07-05 03:59:31'),
(6, 3, 1, 7, NULL, '12:00', '13:00', 1, '2020-07-05 03:59:31', '2020-07-05 03:59:31'),
(7, 15, 4, NULL, NULL, '10:00:00', '23:59:59', 2, '2020-07-07 18:13:49', '2020-07-07 18:13:49'),
(8, 15, 4, NULL, NULL, '00:00:00', '23:59:59', 2, '2020-07-07 18:13:49', '2020-07-07 18:13:49'),
(9, 15, 4, NULL, NULL, '06:00:00', '23:59:59', 2, '2020-07-07 18:13:49', '2020-07-07 18:13:49'),
(10, 15, 4, NULL, NULL, '06:00:00', '23:59:59', 2, '2020-07-07 18:13:49', '2020-07-07 18:13:49'),
(11, 15, 1, NULL, NULL, '06:00:00', '12:00:00', 6, '2020-07-07 18:13:49', '2020-07-07 18:13:49'),
(12, 16, 4, NULL, NULL, '10:00:00', '23:59:59', 2, '2020-07-07 18:34:06', '2020-07-07 18:34:06'),
(13, 16, 4, NULL, NULL, '00:00:00', '23:59:59', 2, '2020-07-07 18:34:06', '2020-07-07 18:34:06'),
(14, 16, 4, NULL, NULL, '06:00:00', '23:59:59', 2, '2020-07-07 18:34:06', '2020-07-07 18:34:06'),
(15, 16, 4, NULL, NULL, '06:00:00', '23:59:59', 2, '2020-07-07 18:34:06', '2020-07-07 18:34:06'),
(16, 16, 1, NULL, NULL, '06:00:00', '12:00:00', 6, '2020-07-07 18:34:06', '2020-07-07 18:34:06'),
(17, 17, 4, 17, NULL, '10:00:00', '23:59:59', 2, '2020-07-07 20:43:43', '2020-07-07 20:43:43'),
(18, 17, 4, 18, NULL, '00:00:00', '23:59:59', 2, '2020-07-07 20:43:43', '2020-07-07 20:43:43'),
(19, 17, 4, 19, NULL, '06:00:00', '23:59:59', 2, '2020-07-07 20:43:43', '2020-07-07 20:43:43'),
(20, 17, 4, 20, NULL, '06:00:00', '23:59:59', 2, '2020-07-07 20:43:43', '2020-07-07 20:43:43'),
(21, 17, 1, 21, NULL, '06:00:00', '12:00:00', 6, '2020-07-07 20:43:43', '2020-07-07 20:43:43');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id_package` bigint(20) UNSIGNED NOT NULL,
  `nama_paket` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `durasi` int(11) NOT NULL,
  `status_paket` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id_package`, `nama_paket`, `durasi`, `status_paket`, `created_at`, `updated_at`) VALUES
(1, 'Hourly', 1, 'hour', '2020-03-31 21:02:50', '2020-03-31 21:07:57'),
(2, 'Daily', 1, 'day', '2020-03-31 21:10:07', '2020-03-31 21:10:07'),
(3, 'Monthly', 1, 'month', '2020-03-31 21:10:39', '2020-03-31 21:11:15'),
(4, 'Half Day', 6, 'hour', '2020-04-09 11:12:57', '2020-04-09 11:12:57');

-- --------------------------------------------------------

--
-- Table structure for table `package_details`
--

CREATE TABLE `package_details` (
  `id_package_detail` bigint(20) UNSIGNED NOT NULL,
  `room_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `harga` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_details`
--

INSERT INTO `package_details` (`id_package_detail`, `room_id`, `package_id`, `harga`, `created_at`, `updated_at`) VALUES
(2, 2, 1, '60000', '2020-04-14 02:01:51', '2020-04-14 02:01:51'),
(3, 3, 3, '25000', '2020-04-14 02:06:30', '2020-04-14 02:06:30'),
(26, 1, 1, '40000', '2020-07-07 17:06:22', '2020-07-07 17:06:22'),
(25, 1, 4, '200000', '2020-07-07 17:06:22', '2020-07-07 17:06:22'),
(12, 4, 2, '200000', '2020-05-18 23:20:19', '2020-05-18 23:20:19'),
(13, 4, 3, '3000000', '2020-05-18 23:20:19', '2020-05-18 23:20:19'),
(14, 4, 1, '60000', '2020-05-18 23:20:19', '2020-05-18 23:20:19');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promos`
--

CREATE TABLE `promos` (
  `id_promo` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `gambar_promo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_promo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diskon` int(11) DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL,
  `batas_durasi_per_jam` int(11) DEFAULT NULL,
  `kuota` int(11) DEFAULT NULL,
  `deskripsi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `role_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_or_building_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_penyebaran` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promos`
--

INSERT INTO `promos` (`id_promo`, `user_id`, `gambar_promo`, `nama_promo`, `diskon`, `nominal`, `batas_durasi_per_jam`, `kuota`, `deskripsi`, `start_date`, `end_date`, `role_id`, `room_or_building_id`, `status_penyebaran`, `created_at`, `updated_at`) VALUES
(1, 7, 'promo/183464.jpg', 'promo hop', NULL, 10000, 60, 10, 'apa aja dah', '2020-06-25', '2020-06-25', '1', NULL, NULL, '2020-06-25 09:13:53', '2020-06-25 09:23:57'),
(2, 7, 'promo/dp.PNG', 'Promo masa &quot;new normal&quot;', NULL, 200000, 10, 100, 'Promo masa \"new normal\" untuk ruang meeting THE HOP sampai dua ratus ribu', '2020-06-25', '2020-07-09', '1', NULL, '4', '2020-06-25 09:14:53', '2020-06-25 09:24:07'),
(3, 2, '', 'promo akhir bulan', 20, NULL, 24, 100, 'berlaku untuk semua ruangan. minimal penywaan selama 1 hari dan tidak berlaku kelipatan', '2020-06-28', '2020-06-28', '0', '[\"1\"]', '3', '2020-06-27 21:57:22', '2020-06-27 21:58:45');

-- --------------------------------------------------------

--
-- Table structure for table `promo_details`
--

CREATE TABLE `promo_details` (
  `id_promo_detail` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status_pakai` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `deskripsi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id_room` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL,
  `form_id` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ruangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_ruangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aturan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `lantai` int(11) NOT NULL,
  `foto_denah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_ruangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id_room`, `user_id`, `building_id`, `form_id`, `nama_ruangan`, `foto_ruangan`, `deskripsi`, `aturan`, `kapasitas`, `lantai`, `foto_denah`, `status_ruangan`, `created_at`, `updated_at`) VALUES
(1, 7, 2, '[\"12\"]', 'Meeting Room HOP', '[\"mr.png\"]', 'mahasiswa 50K', 'jaga kebersihan', 4, 2, '21af424ac99862464e7d3d99674789b9.png', 'publish', '2020-06-15 09:04:31', '2020-06-15 09:04:31');

-- --------------------------------------------------------

--
-- Table structure for table `room_categories`
--

CREATE TABLE `room_categories` (
  `id_room_category` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_kategori` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_categories`
--

INSERT INTO `room_categories` (`id_room_category`, `nama_kategori`, `gambar_kategori`, `created_at`, `updated_at`) VALUES
(7, 'Studio', 'fa-camera', '2020-03-19 03:31:01', '2020-03-19 03:31:01'),
(9, 'Meeting Room', 'fa-users', '2020-03-19 03:54:32', '2020-03-19 03:54:32'),
(10, 'Co-Working Space', 'fa-laptop', '2020-03-19 03:59:32', '2020-03-20 21:47:57'),
(11, 'Workshop', 'fa-area-chart', '2020-03-24 03:22:14', '2020-03-24 03:22:14'),
(12, 'Family Gathering', 'fa-birthday-cake', '2020-03-24 03:23:18', '2020-03-24 03:23:18');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id_schedule` bigint(20) UNSIGNED NOT NULL,
  `room_id` int(11) NOT NULL,
  `hari` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_buka` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_tutup` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_jadwal` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id_schedule`, `room_id`, `hari`, `jam_buka`, `jam_tutup`, `status_jadwal`, `created_at`, `updated_at`) VALUES
(20, 1, '5', '06:00:00', '23:59:59', 'public', '2020-07-07 17:06:22', '2020-07-07 17:06:22'),
(19, 1, '4', '06:00:00', '23:59:59', 'public', '2020-07-07 17:06:22', '2020-07-07 17:06:22'),
(18, 1, '3', '00:00:00', '23:59:59', 'public', '2020-07-07 17:06:22', '2020-07-07 17:06:22'),
(17, 1, '2', '00:00:00', '23:59:59', 'public', '2020-07-07 17:06:22', '2020-07-07 17:06:22'),
(21, 1, '6', '06:00:00', '23:59:59', 'public', '2020-07-07 17:06:22', '2020-07-07 17:06:22');

-- --------------------------------------------------------

--
-- Table structure for table `setups`
--

CREATE TABLE `setups` (
  `id_setup` bigint(20) UNSIGNED NOT NULL,
  `nama_setup` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_setup` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setups`
--

INSERT INTO `setups` (`id_setup`, `nama_setup`, `gambar_setup`, `created_at`, `updated_at`) VALUES
(1, 'Board', 'setup/board.png', '2020-03-24 06:46:32', '2020-06-23 18:47:10'),
(2, 'Classroom', 'setup/classroom.png', '2020-03-24 06:46:49', '2020-06-23 18:49:18'),
(3, 'Hollow Square', 'setup/hollow_square.png', '2020-03-24 06:47:06', '2020-06-23 18:49:25'),
(4, 'Reception Cocktail', 'setup/reception_cocktail.png', '2020-03-24 06:47:19', '2020-06-23 18:50:08'),
(5, 'Round Banquet', 'setup/round_banquet.png', '2020-03-24 06:47:31', '2020-06-23 18:50:15'),
(6, 'Theater', 'setup/theater.png', '2020-03-24 06:47:47', '2020-06-23 18:50:22'),
(7, 'U-Shape', 'setup/u_shape.png', '2020-03-24 06:48:13', '2020-06-23 18:50:30');

-- --------------------------------------------------------

--
-- Table structure for table `setup_details`
--

CREATE TABLE `setup_details` (
  `id_setup_detail` bigint(20) UNSIGNED NOT NULL,
  `setup_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setup_details`
--

INSERT INTO `setup_details` (`id_setup_detail`, `setup_id`, `room_id`, `created_at`, `updated_at`) VALUES
(2, 1, 3, '2020-04-14 02:06:29', '2020-04-14 02:06:29'),
(13, 1, 4, '2020-05-18 23:20:17', '2020-05-18 23:20:17'),
(14, 2, 4, '2020-05-18 23:20:17', '2020-05-18 23:20:17'),
(15, 3, 4, '2020-05-18 23:20:18', '2020-05-18 23:20:18'),
(16, 4, 4, '2020-05-18 23:20:18', '2020-05-18 23:20:18'),
(17, 5, 4, '2020-05-18 23:20:18', '2020-05-18 23:20:18'),
(18, 6, 4, '2020-05-18 23:20:18', '2020-05-18 23:20:18'),
(19, 7, 4, '2020-05-18 23:20:18', '2020-05-18 23:20:18'),
(26, 1, 1, '2020-07-07 17:06:22', '2020-07-07 17:06:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `foto_profile` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `status_user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `foto_profile`, `nama_user`, `email`, `email_verified_at`, `password`, `role_id`, `status_user`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'foto/ws.png', 'Aryo', 'aryo100@gmail.com', NULL, '$2y$10$dJpPBIBhC1q1lwD2zjLnaehOaqDQJeIanUceJRACTvpJwUB855Uxi', 1, 'approved', 'MZk2zmBZeq9XwSprteN705IEGHAGyGrGkiaevi7IQkH1s4S5HvbWKifNmgNL', '2020-03-12 03:14:43', '2020-06-22 19:45:09'),
(2, NULL, 'Admin', 'admin', NULL, '$2y$10$dJpPBIBhC1q1lwD2zjLnaehOaqDQJeIanUceJRACTvpJwUB855Uxi', 0, 'approved', '8lNFvxKqaHwKTeFovkPxCqR6FuNZ78geztccRbsk7bvYuWrRmg7DcUBPBh7Q', '2020-03-12 03:14:43', '2020-07-01 17:49:53'),
(3, 'foto/image_picker3242888407964781859.jpg', 'yohanes', 'yohanes.manullang.tik16@mhsw.pnj.ac.id', NULL, '$2y$10$fUHcFoe5v2iXa6UtjHkOnuTv31eEgGa8OHUeYMBSjbc0YWKUJurJ2', 2, 'unapproved', 'Qt1qWFiZfV3Wkw1CAYaFouJwdjWJK06LHOQuuuxbtcHXhYePq02EgSzcCRoC', '2020-03-25 19:49:49', '2020-07-05 15:36:01'),
(7, 'foto/image_picker4351936976974959254.jpg', 'hopp', 'hop@gmail.com', NULL, '$2y$10$5j23J02ljvavaNjEun.VIeaec3ZCgfBFGYaQFfz0I8GY5Y/iRiAKG', 1, 'approved', 'cHcuFx31V2kAWO176L6o9OGxeBKRgHcZ51nLKssiU7juE9JLyRmtk40uJVQd', '2020-03-25 21:15:44', '2020-07-07 17:04:20'),
(10, NULL, 'AdminA', 'adminA', NULL, '$2y$10$2./FnR54luompYYya6lgy.9LSRBISVgzCFk6UJmw5T013R0tSTNde', 1, 'unapproved', NULL, '2020-06-15 08:36:33', '2020-06-15 08:43:44'),
(11, 'foto/63384.jpg', 'Hid', 'hid', NULL, '$2y$10$8RHD1.tM9fonZi1H2qwb9O9bZ2nupuSKxpqlWCIqbHqa7wof7N/US', 2, 'unapproved', NULL, '2020-06-17 05:02:33', '2020-06-17 05:04:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`id_building`);

--
-- Indexes for table `building_types`
--
ALTER TABLE `building_types`
  ADD PRIMARY KEY (`id_building_type`);

--
-- Indexes for table `category_details`
--
ALTER TABLE `category_details`
  ADD PRIMARY KEY (`id_category_detail`);

--
-- Indexes for table `facility_categories`
--
ALTER TABLE `facility_categories`
  ADD PRIMARY KEY (`id_facility_category`);

--
-- Indexes for table `facility_details`
--
ALTER TABLE `facility_details`
  ADD PRIMARY KEY (`id_facility_detail`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id_form`);

--
-- Indexes for table `form_contents`
--
ALTER TABLE `form_contents`
  ADD PRIMARY KEY (`id_form_content`);

--
-- Indexes for table `form_details`
--
ALTER TABLE `form_details`
  ADD PRIMARY KEY (`id_form_detail`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id_order_detail`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id_package`);

--
-- Indexes for table `package_details`
--
ALTER TABLE `package_details`
  ADD PRIMARY KEY (`id_package_detail`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`id_promo`);

--
-- Indexes for table `promo_details`
--
ALTER TABLE `promo_details`
  ADD PRIMARY KEY (`id_promo_detail`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id_room`);

--
-- Indexes for table `room_categories`
--
ALTER TABLE `room_categories`
  ADD PRIMARY KEY (`id_room_category`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id_schedule`);

--
-- Indexes for table `setups`
--
ALTER TABLE `setups`
  ADD PRIMARY KEY (`id_setup`);

--
-- Indexes for table `setup_details`
--
ALTER TABLE `setup_details`
  ADD PRIMARY KEY (`id_setup_detail`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buildings`
--
ALTER TABLE `buildings`
  MODIFY `id_building` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `building_types`
--
ALTER TABLE `building_types`
  MODIFY `id_building_type` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category_details`
--
ALTER TABLE `category_details`
  MODIFY `id_category_detail` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `facility_categories`
--
ALTER TABLE `facility_categories`
  MODIFY `id_facility_category` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `facility_details`
--
ALTER TABLE `facility_details`
  MODIFY `id_facility_detail` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id_form` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `form_contents`
--
ALTER TABLE `form_contents`
  MODIFY `id_form_content` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `form_details`
--
ALTER TABLE `form_details`
  MODIFY `id_form_detail` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id_order_detail` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id_package` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `package_details`
--
ALTER TABLE `package_details`
  MODIFY `id_package_detail` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `promos`
--
ALTER TABLE `promos`
  MODIFY `id_promo` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `promo_details`
--
ALTER TABLE `promo_details`
  MODIFY `id_promo_detail` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id_room` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `room_categories`
--
ALTER TABLE `room_categories`
  MODIFY `id_room_category` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id_schedule` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `setups`
--
ALTER TABLE `setups`
  MODIFY `id_setup` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `setup_details`
--
ALTER TABLE `setup_details`
  MODIFY `id_setup_detail` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
