-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2021 at 10:51 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `novecology`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `title`, `details`, `image`, `created_at`, `updated_at`) VALUES
(2, 'An accompanying individual', 'Technical excellence, integrity and customer satisfaction are at the heart of our values. A trusted expert at your side to support you throughout your project and answer all your questions.\r\n\r\nWe mobilize our team of experienced professionals to guarantee a complete offer and support from A to Z to carry out your energy renovation work as quickly as possible, from the constitution of your file to the completion of your site.', '2.svg', '2021-10-14 04:14:25', '2021-10-14 04:14:25'),
(3, 'Our job is to make your home both comfortable and energy efficient.', 'Novecology offers turnkey energy saving solutions for individual and collective housing. We work on construction sites, new or renovation, whatever their size. 4 good reasons to eco-renovate your home now.\r\n\r\nBenefit from State premiums to finance your work at a lower cost: Solutions start from € 1.\r\n\r\nSignificantly reduce your heating bills: A more efficient heating or insulation installation can represent a saving of 45% on the energy consumed.\r\n\r\nEnsure the completion of your site by a craftsman \"Recognized Guarantor of the Environment\": Guarantee of confidence, our company is \"Recognized Guarantor of the Environment\" (QUALIBAT - RGE) and operates in compliance with standards and excellence technical.\r\n\r\nImprove the comfort of your home: Summer as in winter, this greatly improves your comfor', '3.svg', '2021-10-14 04:14:56', '2021-10-14 04:14:56');

-- --------------------------------------------------------

--
-- Table structure for table `advice`
--

CREATE TABLE `advice` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `advice`
--

INSERT INTO `advice` (`id`, `title`, `image`, `category_id`, `created_at`, `updated_at`) VALUES
(12, 'Le premier de article de Nicolas', '12.jpg', 6, '2021-11-09 04:00:39', '2021-11-09 04:00:39'),
(14, 'Le premier de article de Nicolas', '14.jpg', 8, '2021-11-09 04:01:07', '2021-11-09 04:01:07'),
(15, 'Le premier de article de Nicolas', '15.jpg', 6, '2021-11-09 04:01:21', '2021-11-09 04:01:21'),
(16, 'Le premier de article de Nicolas', '16.jpg', 6, '2021-11-09 04:01:35', '2021-11-09 04:01:35');

-- --------------------------------------------------------

--
-- Table structure for table `advice_and_grants`
--

CREATE TABLE `advice_and_grants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `advice_and_grants`
--

INSERT INTO `advice_and_grants` (`id`, `title`, `thumbnail`, `details`, `image1`, `image2`, `image3`, `image4`, `category_id`, `created_at`, `updated_at`) VALUES
(8, 'Le premier de article de Nicolas', '8-thumbnail.jpg', '<div>&nbsp;</div><div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae elit at lorem placerat interdum vel eu lorem. Fusce tincidunt lorem sit amet sodales consequat. Aenean mattis sodales quam vitae molestie. Mauris vulputate justo aliquet interdum lobortis. Aliquam erat volutpat. Curabitur feugiat sollicitudin tellus ac iaculis. In vitae rutrum sapien, eget pretium velit. Aliquam erat volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum eget risus vitae tellus dapibus dapibus vitae ac dui.<br><br></div><div>Aliquam vehicula vitae sem ut pellentesque. Donec vel velit felis. Quisque in elit est. Etiam id mi sed lacus viverra blandit. Fusce sollicitudin, orci luctus vulputate varius, tellus magna interdum leo, sed fermentum mi arcu id turpis. Donec ac metus at nisl posuere rhoncus volutpat a est. Curabitur tincidunt blandit arcu et porttitor. Etiam leo lorem, gravida vel semper sit amet, fringilla id erat.<br><br></div><div>Morbi tortor quam, pretium a ex at, dignissim ultrices sem. Donec urna nisl, varius et leo et, commodo fermentum velit. Quisque auctor imperdiet felis id bibendum. Donec dignissim enim sed metus imperdiet, at dignissi&nbsp;</div>', '8-image1.jpg', '8-image3.jpg', '8-image3.jpg', '8-image4.jpg', 6, '2021-11-13 01:29:30', '2021-11-13 01:29:30'),
(13, 'Le premier de article de Nicolas', '13-thumbnail.jpg', '<div>&nbsp;</div><div>&nbsp;</div><div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae elit at lorem placerat interdum vel eu lorem. Fusce tincidunt lorem sit amet sodales consequat. Aenean mattis sodales quam vitae molestie. Mauris vulputate justo aliquet interdum lobortis. Aliquam erat volutpat. Curabitur feugiat sollicitudin tellus ac iaculis. In vitae rutrum sapien, eget pretium velit. Aliquam erat volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum eget risus vitae tellus dapibus dapibus vitae ac dui.<br><br></div><div>Aliquam vehicula vitae sem ut pellentesque. Donec vel velit felis. Quisque in elit est. Etiam id mi sed lacus viverra blandit. Fusce sollicitudin, orci luctus vulputate varius, tellus magna interdum leo, sed fermentum mi arcu id turpis. Donec ac metus at nisl posuere rhoncus volutpat a est. Curabitur tincidunt blandit arcu et porttitor. Etiam leo lorem, gravida vel semper sit amet, fringilla id erat.<br><br></div><div>Morbi tortor quam, pretium a ex at, dignissim ultrices sem. Donec urna nisl, varius et leo et, commodo fermentum velit. Quisque auctor imperdiet felis id bibendum. Donec dignissim enim sed metus imperdiet, at dignissi&nbsp;</div>', '13-image1.jpg', '13-image3.jpg', '13-image3.jpg', '13-image4.jpg', 6, '2021-11-13 03:01:19', '2021-11-13 03:01:19'),
(14, 'Le premier de article de Nicolas', '14-thumbnail.jpg', '<div>&nbsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae elit at lorem placerat interdum vel eu lorem. Fusce tincidunt lorem sit amet sodales consequat. Aenean mattis sodales quam vitae molestie. Mauris vulputate justo aliquet interdum lobortis. Aliquam erat volutpat. Curabitur feugiat sollicitudin tellus ac iaculis. In vitae rutrum sapien, eget pretium velit. Aliquam erat volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum eget risus vitae tellus dapibus dapibus vitae ac dui.<br><br></div><div>Aliquam vehicula vitae sem ut pellentesque. Donec vel velit felis. Quisque in elit est. Etiam id mi sed lacus viverra blandit. Fusce sollicitudin, orci luctus vulputate varius, tellus magna interdum leo, sed fermentum mi arcu id turpis. Donec ac metus at nisl posuere rhoncus volutpat a est. Curabitur tincidunt blandit arcu et porttitor. Etiam leo lorem, gravida vel semper sit amet, fringilla id erat.<br><br></div><div>Morbi tortor quam, pretium a ex at, dignissim ultrices sem. Donec urna nisl, varius et leo et, commodo fermentum velit. Quisque auctor imperdiet felis id bibendum. Donec dignissim enim sed metus imperdiet, at dignissi&nbsp;</div>', '14-image1.jpg', '14-image3.jpg', '14-image3.jpg', '14-image4.jpg', 6, '2021-11-13 03:01:51', '2021-11-13 03:01:51'),
(15, 'Le premier de article de Nicolas', '15-thumbnail.jpg', '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae elit at lorem placerat interdum vel eu lorem. Fusce tincidunt lorem sit amet sodales consequat. Aenean mattis sodales quam vitae molestie. Mauris vulputate justo aliquet interdum lobortis. Aliquam erat volutpat. Curabitur feugiat sollicitudin tellus ac iaculis. In vitae rutrum sapien, eget pretium velit. Aliquam erat volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum eget risus vitae tellus dapibus dapibus vitae ac dui.<br><br></div><div>Aliquam vehicula vitae sem ut pellentesque. Donec vel velit felis. Quisque in elit est. Etiam id mi sed lacus viverra blandit. Fusce sollicitudin, orci luctus vulputate varius, tellus magna interdum leo, sed fermentum mi arcu id turpis. Donec ac metus at nisl posuere rhoncus volutpat a est. Curabitur tincidunt blandit arcu et porttitor. Etiam leo lorem, gravida vel semper sit amet, fringilla id erat.<br><br></div><div>Morbi tortor quam, pretium a ex at, dignissim ultrices sem. Donec urna nisl, varius et leo et, commodo fermentum velit. Quisque auctor imperdiet felis id bibendum. Donec dignissim enim sed metus imperdiet, at dignissi&nbsp;</div>', '15-image1.jpg', '15-image3.jpg', '15-image3.jpg', '15-image4.jpg', 8, '2021-11-13 03:02:26', '2021-11-13 03:02:26'),
(16, 'Le premier de article de Nicolas', '16-thumbnail.jpg', '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae elit at lorem placerat interdum vel eu lorem. Fusce tincidunt lorem sit amet sodales consequat. Aenean mattis sodales quam vitae molestie. Mauris vulputate justo aliquet interdum lobortis. Aliquam erat volutpat. Curabitur feugiat sollicitudin tellus ac iaculis. In vitae rutrum sapien, eget pretium velit. Aliquam erat volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum eget risus vitae tellus dapibus dapibus vitae ac dui.<br><br></div><div>Aliquam vehicula vitae sem ut pellentesque. Donec vel velit felis. Quisque in elit est. Etiam id mi sed lacus viverra blandit. Fusce sollicitudin, orci luctus vulputate varius, tellus magna interdum leo, sed fermentum mi arcu id turpis. Donec ac metus at nisl posuere rhoncus volutpat a est. Curabitur tincidunt blandit arcu et porttitor. Etiam leo lorem, gravida vel semper sit amet, fringilla id erat.<br><br></div><div>Morbi tortor quam, pretium a ex at, dignissim ultrices sem. Donec urna nisl, varius et leo et, commodo fermentum velit. Quisque auctor imperdiet felis id bibendum. Donec dignissim enim sed metus imperdiet, at dignissi&nbsp;</div>', '16-image1.jpg', '16-image3.jpg', '16-image3.jpg', '16-image4.jpg', 8, '2021-11-13 03:02:56', '2021-11-13 03:02:56'),
(17, 'Le premier de article de Nicolas', '17-thumbnail.jpg', '<div>&nbsp;</div><div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae elit at lorem placerat interdum vel eu lorem. Fusce tincidunt lorem sit amet sodales consequat. Aenean mattis sodales quam vitae molestie. Mauris vulputate justo aliquet interdum lobortis. Aliquam erat volutpat. Curabitur feugiat sollicitudin tellus ac iaculis. In vitae rutrum sapien, eget pretium velit. Aliquam erat volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum eget risus vitae tellus dapibus dapibus vitae ac dui.<br><br></div><div>Aliquam vehicula vitae sem ut pellentesque. Donec vel velit felis. Quisque in elit est. Etiam id mi sed lacus viverra blandit. Fusce sollicitudin, orci luctus vulputate varius, tellus magna interdum leo, sed fermentum mi arcu id turpis. Donec ac metus at nisl posuere rhoncus volutpat a est. Curabitur tincidunt blandit arcu et porttitor. Etiam leo lorem, gravida vel semper sit amet, fringilla id erat.<br><br></div><div>Morbi tortor quam, pretium a ex at, dignissim ultrices sem. Donec urna nisl, varius et leo et, commodo fermentum velit. Quisque auctor imperdiet felis id bibendum. Donec dignissim enim sed metus imperdiet, at dignissi&nbsp;</div>', '17-image1.jpg', '17-image3.jpg', '17-image3.jpg', '17-image4.jpg', 11, '2021-11-13 03:03:21', '2021-11-13 03:03:21'),
(18, 'Le premier de article de Nicolas', '18-thumbnail.jpg', '<div>&nbsp;</div><div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae elit at lorem placerat interdum vel eu lorem. Fusce tincidunt lorem sit amet sodales consequat. Aenean mattis sodales quam vitae molestie. Mauris vulputate justo aliquet interdum lobortis. Aliquam erat volutpat. Curabitur feugiat sollicitudin tellus ac iaculis. In vitae rutrum sapien, eget pretium velit. Aliquam erat volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum eget risus vitae tellus dapibus dapibus vitae ac dui.<br><br></div><div>Aliquam vehicula vitae sem ut pellentesque. Donec vel velit felis. Quisque in elit est. Etiam id mi sed lacus viverra blandit. Fusce sollicitudin, orci luctus vulputate varius, tellus magna interdum leo, sed fermentum mi arcu id turpis. Donec ac metus at nisl posuere rhoncus volutpat a est. Curabitur tincidunt blandit arcu et porttitor. Etiam leo lorem, gravida vel semper sit amet, fringilla id erat.<br><br></div><div>Morbi tortor quam, pretium a ex at, dignissim ultrices sem. Donec urna nisl, varius et leo et, commodo fermentum velit. Quisque auctor imperdiet felis id bibendum. Donec dignissim enim sed metus imperdiet, at dignissi&nbsp;</div>', '18-image1.jpg', '18-image3.jpg', '18-image3.jpg', '18-image4.jpg', 11, '2021-11-13 03:04:00', '2021-11-13 08:44:19');

-- --------------------------------------------------------

--
-- Table structure for table `advice_faqs`
--

CREATE TABLE `advice_faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `advice_id` int(11) NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_line` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_line` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `first_line`, `second_line`, `banner_image`, `created_at`, `updated_at`) VALUES
(3, 'La rénovation énergétique', 'pour tous', '3.jpg', '2021-11-01 10:12:14', '2021-11-13 00:56:53'),
(4, 'La rénovation énergétique', 'pour tous', '4.jpg', '2021-11-01 10:39:45', '2021-11-01 10:39:45');

-- --------------------------------------------------------

--
-- Table structure for table `bienvenues`
--

CREATE TABLE `bienvenues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bienvenue_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bienvenues`
--

INSERT INTO `bienvenues` (`id`, `bienvenue_text`, `video`, `created_at`, `updated_at`) VALUES
(1, 'Novecology est une société française spécialisé dans la mise en œuvre de travaux de rénovation énergétiques de qualité au service des particuliers et des professionnels.', '1.mp4', NULL, '2021-10-13 07:21:07');

-- --------------------------------------------------------

--
-- Table structure for table `clint_opinions`
--

CREATE TABLE `clint_opinions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opinion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clint_opinions`
--

INSERT INTO `clint_opinions` (`id`, `name`, `opinion`, `created_at`, `updated_at`) VALUES
(2, 'Name', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', '2021-10-16 10:17:28', '2021-11-03 05:11:07'),
(3, 'name', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', '2021-10-16 10:17:37', '2021-10-16 10:17:37'),
(4, 'name', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', '2021-10-16 10:17:47', '2021-10-16 10:17:47'),
(5, 'name', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', '2021-10-16 10:17:54', '2021-10-16 10:17:54'),
(6, 'name', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', '2021-10-16 10:18:04', '2021-10-16 10:18:04'),
(7, 'name', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', '2021-10-16 10:18:11', '2021-10-16 10:18:11');

-- --------------------------------------------------------

--
-- Table structure for table `color_settings`
--

CREATE TABLE `color_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `theme_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `color_settings`
--

INSERT INTO `color_settings` (`id`, `theme_color`, `footer_color`, `created_at`, `updated_at`) VALUES
(1, '#40b120', '#000000', NULL, '2021-10-23 07:00:08');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` bigint(20) NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_status` enum('read','unreade') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unreade',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `title`, `subtitle`, `details`, `updated_at`) VALUES
(1, 'Contactez nos experts', 'Conseil, devis, aide financière, des professionnels à votre écoute', '<div><br>Faire appel à Novecology,<br>c’est vous assurer d’avoir un expert dédié<br>à votre écoute écoute.<br><br></div>', '2021-11-10 05:03:11');

-- --------------------------------------------------------

--
-- Table structure for table `expertises`
--

CREATE TABLE `expertises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expertises_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expertises`
--

INSERT INTO `expertises` (`id`, `expertises_text`, `created_at`, `updated_at`) VALUES
(1, 'Nous sommes des spécialistes dans les solutions d’economie d’energie. Nous proposons différentes prestations d’amélioration de I’habitat : isolation des combles, rampants, sous sols, point singulier, calorifugeage, pompe à chaleur, chaudière à granule.', NULL, '2021-10-13 07:40:53');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favicons`
--

CREATE TABLE `favicons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favicons`
--

INSERT INTO `favicons` (`id`, `image`, `created_at`, `updated_at`) VALUES
(1, '1.jpg', '2021-10-14 05:22:32', '2021-10-14 05:22:32');

-- --------------------------------------------------------

--
-- Table structure for table `footer_column_settings`
--

CREATE TABLE `footer_column_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_no` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footer_column_settings`
--

INSERT INTO `footer_column_settings` (`id`, `title`, `link`, `column_no`, `created_at`, `updated_at`) VALUES
(21, 'Title 1', 'http://127.0.0.1:8000/more/page/le-premier-de-article-de-nicolas-DjGdu6Oulz', '1st', '2021-11-11 05:41:25', '2021-11-11 05:41:25'),
(22, 'Title 1', 'http://127.0.0.1:8000/more/page/le-premier-de-article-de-nicolas-mE0uqRrO4W', '1st', '2021-11-11 05:41:35', '2021-11-11 05:41:35'),
(23, 'Title 1', 'http://127.0.0.1:8000/more/page/le-premier-de-article-de-nicolas-mE0uqRrO4W', '1st', '2021-11-11 05:42:31', '2021-11-11 05:42:31'),
(24, 'Title 2', 'http://127.0.0.1:8000/more/page/le-premier-de-article-de-nicolas-DjGdu6Oulz', '2nd', '2021-11-11 05:42:39', '2021-11-11 05:42:39'),
(25, 'Title 2', 'http://127.0.0.1:8000/more/page/le-premier-de-article-de-nicolas-DjGdu6Oulz', '2nd', '2021-11-11 05:42:48', '2021-11-11 05:42:48'),
(26, 'Title 2', 'http://127.0.0.1:8000/more/page/le-premier-de-article-de-nicolas-DjGdu6Oulz', '2nd', '2021-11-11 05:42:57', '2021-11-11 05:43:04'),
(30, 'Le premier de article de Nicolas', 'http://127.0.0.1:8000/more/page/le-premier-de-article-de-nicolas-mE0uqRrO4W', '3rd', '2021-11-11 07:24:25', '2021-11-11 07:24:25');

-- --------------------------------------------------------

--
-- Table structure for table `footer_settings`
--

CREATE TABLE `footer_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `copyright` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_column` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_column` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `third_column` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footer_settings`
--

INSERT INTO `footer_settings` (`id`, `address`, `email`, `phone`, `copyright`, `first_column`, `second_column`, `third_column`, `created_at`, `updated_at`) VALUES
(1, '184 mohin rod e, St A/bans vc 0321, Autralia', 'admin@admin.com', '+07712345685', 'Copy write © by SoClose', 'NOVECOLOGY', 'NOS SOLUTIONS POUR PARTICULIERS', 'NOS DERNIERS CONSEILS', '2021-11-11 07:25:33', '2021-11-11 07:25:33');

-- --------------------------------------------------------

--
-- Table structure for table `grant_categories`
--

CREATE TABLE `grant_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grant_categories`
--

INSERT INTO `grant_categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(6, 'Isolation', '2021-11-09 03:59:19', '2021-11-09 03:59:19'),
(8, 'Tous nos conseils', '2021-11-09 03:59:37', '2021-11-09 03:59:37'),
(11, 'Conseils & subventions', '2021-11-13 02:59:49', '2021-11-13 02:59:49');

-- --------------------------------------------------------

--
-- Table structure for table `logos`
--

CREATE TABLE `logos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logos`
--

INSERT INTO `logos` (`id`, `image`, `image2`, `created_at`, `updated_at`) VALUES
(1, '1-white.png', '1-color.png', '2021-11-11 07:05:53', '2021-11-11 07:05:53');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10, '2014_10_12_000000_create_users_table', 1),
(11, '2014_10_12_100000_create_password_resets_table', 1),
(12, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(13, '2019_08_19_000000_create_failed_jobs_table', 1),
(14, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(15, '2020_05_21_100000_create_teams_table', 1),
(16, '2020_05_21_200000_create_team_user_table', 1),
(17, '2020_05_21_300000_create_team_invitations_table', 1),
(18, '2021_10_11_104638_create_sessions_table', 1),
(21, '2021_10_13_115246_create_bienvenues_table', 3),
(22, '2021_10_13_132313_create_expertises_table', 4),
(23, '2021_10_13_134853_create_work_withs_table', 5),
(24, '2021_10_14_094150_create_abouts_table', 6),
(25, '2021_10_14_104600_create_logos_table', 7),
(26, '2021_10_14_111126_create_favicons_table', 8),
(31, '2021_10_16_132253_create_suppliers_table', 12),
(32, '2021_10_16_150731_create_clint_opinions_table', 13),
(33, '2021_10_18_125753_create_theme_colors_table', 14),
(34, '2021_10_18_140212_create_color_settings_table', 15),
(35, '2021_10_22_101644_create_advice_table', 16),
(36, '2021_10_22_111321_create_advice_details_table', 17),
(37, '2021_10_22_112637_create_advice_reasons_table', 17),
(38, '2021_10_23_130306_create_our_societies_table', 18),
(40, '2021_10_23_152847_create_contacts_table', 19),
(42, '2021_10_26_083159_create_simulate_projects_table', 20),
(43, '2021_10_13_091356_create_banners_table', 21),
(44, '2021_11_02_094432_create_footer_settings_table', 22),
(45, '2021_11_02_113101_create_footer_column_settings_table', 23),
(46, '2021_11_03_085253_create_social_link_settings_table', 24),
(47, '2021_11_03_101629_create_subscribes_table', 25),
(48, '2021_11_09_063513_create_grant_categories_table', 26),
(49, '2021_11_09_124622_create_pages_table', 27),
(50, '2021_11_10_092107_create_our_services_table', 28),
(52, '2021_11_10_095727_create_contact_us_table', 29),
(55, '2021_11_10_132101_create_advice_and_grants_table', 31),
(56, '2021_11_10_112944_create_our_solutions_table', 32),
(57, '2021_11_10_145803_create_our_solution_details_table', 33),
(58, '2021_11_11_064607_create_advice_faqs_table', 34),
(59, '2021_11_13_111909_create_user_messages_table', 35),
(60, '2021_10_16_084433_create_solution_resons_table', 36);

-- --------------------------------------------------------

--
-- Table structure for table `our_services`
--

CREATE TABLE `our_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `our_services`
--

INSERT INTO `our_services` (`id`, `title`, `details`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Le premier de article de Nicolas', '<div>&nbsp;<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&nbsp;</div>', '2.svg', '2021-11-10 03:43:17', '2021-11-10 03:43:17'),
(3, 'Le premier de article de Nicolas', '<div>&nbsp;<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&nbsp;</div>', '3.svg', '2021-11-10 03:43:28', '2021-11-10 03:43:28'),
(4, 'Le premier de article de Nicolas', '<div>&nbsp;<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&nbsp;</div>', '4.svg', '2021-11-10 03:43:39', '2021-11-10 03:43:39');

-- --------------------------------------------------------

--
-- Table structure for table `our_societies`
--

CREATE TABLE `our_societies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `our_societies`
--

INSERT INTO `our_societies` (`id`, `title`, `details`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Vos besoins, notre mission', '<div>&nbsp;</div><div>Novecology a pour mission de promouvoir les économies d’énergie auprès des foyers les plus modestes par ses différentes actions d’information, d’incitation et de mise en oeuvre.<br><br></div><div>Grâce aux dispositifs des Certificats d’Economie d‘Energie (CEE), nous sommes en mesure de financer à 100% de nombreuses opérations en matière d’économie d’énergie chez les ménages exposés à la précarité énergétique.<br><br></div><div>Ces différents programmes de travaux accompagnent les foyers les plus modestes dans le but d’améliorer la performance énergétique de leur logement. Ces économies d’énergie se transformeront directement en pouvoir d’acha&nbsp;<br><br></div>', '2.svg', '2021-10-23 07:49:17', '2021-10-23 07:49:17'),
(3, 'Notre promesse', '<div>&nbsp;The energy transition is the major challenge of the 21st century. Energy-intensive homes represent a real challenge for the years to come. The big challenge of tomorrow will be to renovate the existing housing stock in an efficient way. Within our company, we fight against this energy poverty because the improvement of our habitat, well-being and comfort are essential for each of us. Each renovated home is an additional step towards the energy transition of our country. Our goal is to offer as many French people as possible, in particular the most modest, access to energy comfort by carrying out quality work at the fairest price.&nbsp;</div>', '3.svg', '2021-10-23 07:49:52', '2021-10-23 07:49:52'),
(4, 'An accompanying individual', '<div>&nbsp;Technical excellence, integrity and customer satisfaction are at the heart of our values. A trusted expert at your side to support you throughout your project and answer all your questions. We mobilize our team of experienced professionals to guarantee a complete offer and support from A to Z to carry out your energy renovation work as quickly as possible, from the constitution of your file to the completion of your sit&nbsp;</div>', '4.svg', '2021-10-23 07:50:20', '2021-10-23 07:50:20'),
(6, 'Nos qualifications', '<div>&nbsp;</div><div>Notre équipe de <strong>professionnels qualifiés </strong>fait preuve de savoir-faire pour vous garantir l’ <strong>efficacité énergétique </strong>de votre logement ou bâtiment.<br><br></div><div>Preuve de notre qualité, notre <strong>société est triplement certifée Qualibat RGE, Qualit’ENR et Chauffage +.<br></strong><br></div><div>Vous avez l’esprit tranquille car <strong>vous bénéficiez alors de toutes les garanties civiles et décennales.</strong>&nbsp;<br><br></div>', '6.svg', '2021-10-23 07:55:59', '2021-10-23 07:55:59');

-- --------------------------------------------------------

--
-- Table structure for table `our_solutions`
--

CREATE TABLE `our_solutions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `our_solutions`
--

INSERT INTO `our_solutions` (`id`, `title`, `image`, `created_at`, `updated_at`) VALUES
(43, 'Isoler mes rampants de toiture', '43.jpg', '2021-11-15 14:48:30', '2021-11-15 14:48:30'),
(44, 'le Isoler mes rampants de toiture', '44.jpg', '2021-11-15 15:29:56', '2021-11-15 15:29:56'),
(45, 'Lorem Ipsum is simply dummy text of the type.', '45.jpg', '2021-11-15 15:32:57', '2021-11-15 15:32:57');

-- --------------------------------------------------------

--
-- Table structure for table `our_solution_details`
--

CREATE TABLE `our_solution_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `solution_id` int(11) NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `our_solution_details`
--

INSERT INTO `our_solution_details` (`id`, `solution_id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(25, 43, 'Pourquoi isoler ses rampants de toiture ?', 'De la même manière qu’il est important d’isoler ses combles perdus, l’isolation sous toiture des rampants est primordiale pour bénéficier d’un confort thermique optimal, été comme hiver.\r\n\r\nL’isolation des rampants de toiture ne doit pas être négligée car une toiture non ou mal isolée occasionnera des déperditions thermiques allant jusqu’à 30%.\r\n\r\nIsoler les rampants de toiture permettra de réduire votre facture énergétique tout en améliorant la performance thermique globale de votre foyer, et également de protéger votre foyer des infiltrations d’eau.', '2021-11-15 14:48:30', '2021-11-15 15:23:04'),
(26, 43, 'Quelles sont les aides & subventions pour isoler ses rampants de toiture ?', 'De la même manière qu’il est important d’isoler ses combles perdus, l’isolation sous toiture des rampants est primordiale pour bénéficier d’un confort thermique optimal, été comme hiver.\r\n\r\nL’isolation des rampants de toiture ne doit pas être négligée car une toiture non ou mal isolée occasionnera des déperditions thermiques allant jusqu’à 30%.\r\n\r\nIsoler les rampants de toiture permettra de réduire votre facture énergétique tout en améliorant la performance thermique globale de votre foyer, et également de protéger votre foyer des infiltrations d’eau.', '2021-11-15 14:48:30', '2021-11-15 14:48:30'),
(28, 44, 'Pourquoi isoler ses rampants de toiture ?', 'De la même manière qu’il est important d’isoler ses combles perdus, l’isolation sous toiture des rampants est primordiale pour bénéficier d’un confort thermique optimal, été comme hiver.\r\n\r\nL’isolation des rampants de toiture ne doit pas être négligée car une toiture non ou mal isolée occasionnera des déperditions thermiques allant jusqu’à 30%.\r\n\r\nIsoler les rampants de toiture permettra de réduire votre facture énergétique tout en améliorant la performance thermique globale de votre foyer, et également de protéger votre foyer des infiltrations d’eau.', '2021-11-15 15:29:56', '2021-11-15 15:29:56'),
(29, 44, 'Quelles sont les aides & subventions pour isoler ses rampants de toiture ?', 'De la même manière qu’il est important d’isoler ses combles perdus, l’isolation sous toiture des rampants est primordiale pour bénéficier d’un confort thermique optimal, été comme hiver.\r\n\r\nL’isolation des rampants de toiture ne doit pas être négligée car une toiture non ou mal isolée occasionnera des déperditions thermiques allant jusqu’à 30%.', '2021-11-15 15:29:56', '2021-11-15 15:29:56'),
(30, 45, 'Quelles sont les aides & subventions pour isoler ses rampants de toiture ?', 'L’isolation des rampants de toiture ne doit pas être négligée car une toiture non ou mal isolée occasionnera des déperditions thermiques allant jusqu’à 30%.\r\n\r\nIsoler les rampants de toiture permettra de réduire votre facture énergétique tout en améliorant la performance thermique globale de votre foyer, et également de protéger votre foyer des infiltrations d’eau.', '2021-11-15 15:32:57', '2021-11-15 15:32:57'),
(31, 45, 'Pourquoi isoler ses rampants de toiture ?', 'De la même manière qu’il est important d’isoler ses combles perdus, l’isolation sous toiture des rampants est primordiale pour bénéficier d’un confort thermique optimal, été comme hiver.\r\n\r\nL’isolation des rampants de toiture ne doit pas être négligée car une toiture non ou mal isolée occasionnera des déperditions thermiques allant jusqu’à 30%.\r\n\r\nIsoler les rampants de toiture permettra de réduire votre facture énergétique tout en améliorant la performance thermique globale de votre foyer, et également de protéger votre foyer des infiltrations d’eau.', '2021-11-15 15:32:57', '2021-11-15 15:32:57');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `list` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `slug`, `link`, `title`, `subtitle`, `thumbnail`, `short_description`, `long_description`, `list`, `image`, `created_at`, `updated_at`) VALUES
(5, 'le-premier-de-article-de-nicolas-DjGdu6Oulz', 'http://127.0.0.1:8000/more/page/le-premier-de-article-de-nicolas-DjGdu6Oulz', 'Le premier de article de Nicolas', 'This is the subtitle', '5-thumbnail.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '<div>&nbsp;</div><blockquote>adipiscing elit. Integer posuere erat a ante.</blockquote><div>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione tempora qui molestias autem eius odit dicta ipsa eligendi exercitationem. Ipsum sed, id est quia officia in quis explicabo eligendi atque. Culpa, repudiandae commodi. Ab veritatis accusantium voluptates debitis ipsa numquam exercitationem corrupti autem magni quaerat earum, similique dolorum at pariatur excepturi error sint soluta cum tenetur, amet sunt magnam. Voluptates possimus doloremque, error quo soluta illum quidem voluptatum quis sit nostrum sapiente. Dolores veritatis cupiditate odio hic! Alias fugit a illum similique iure aut numquam odio molestiae hic! Obcaecati cum excepturi eius eligendi nihil. Eveniet suscipit in nihil doloribus dolore laboriosam inventore quis cumque consequatur, sapiente repudiandae voluptatibus? Maiores, repudiandae, debitis obcaecati tenetur dicta aperiam tempora tempore, perspiciatis ipsam ipsum eligendi esse ratione nostrum. Animi ipsam illum quae laborum? Eveniet quasi iste exercitationem magni voluptatum dicta id quod reprehenderit? Quidem ab, eveniet dicta incidunt porro veritatis dolores labore quae nihil repudiandae accusamus beatae ex nisi magnam eos cum voluptatum dolor nam impedit minima repellendus quia placeat quasi? Repudiandae, magnam officia, temporibus culpa facilis explicabo, velit expedita ab officiis similique placeat illo doloremque eos. Omnis cumque, officiis a autem eaque quaerat quidem rerum labore eveniet vero voluptates quae facilis necessitatibus, aliquam fugit id veniam voluptatum dolorem obcaecati iusto itaque, officia quis dignissimos! Eveniet nisi voluptate aspernatur autem voluptatum rerum suscipit velit esse libero tempora cumque, hic necessitatibus id numquam similique illum nihil ipsam officia dignissimos quia et. Corporis, natus facere voluptas officia exercitationem impedit laudantium earum consectetur expedita soluta quod possimus provident, incidunt excepturi dolore minus vitae placeat! Vel enim maiores et voluptatem consequuntur facilis maxime delectus impedit similique perferendis accusantium, vero modi cumque dolorem facere hic. Molestias numquam, illum dolor molestiae perferendis officia sint ducimus perspiciatis, aliquam maxime dignissimos ipsum! Eveniet aspernatur, pariatur, quas sapiente, aliquam ullam incidunt illum ipsum harum sit porro repudiandae sint aut doloribus modi voluptates unde assumenda? Eius explicabo repudiandae, est labore voluptas tenetur impedit porro quis qui quod facilis consectetur officia id asperiores obcaecati quos. Laudantium, quas, unde, nobis obcaecati nulla possimus inventore quasi amet magnam in ab officiis temporibus. Quam exercitationem quod aliquid dolor id nesciunt excepturi magnam consequuntur numquam reiciendis itaque accusantium at vel, placeat tenetur, obcaecati, repellendus nemo. Nemo, beatae ipsum, eveniet quia laborum eos temporibus quisquam dolorem ad necessitatibus nihil autem quaerat officia sunt accusamus quibusdam facere magni fuga reiciendis consequatur. Quam, placeat vitae illo maxime, harum non quia quisquam incidunt expedita delectus quod alias. Aut delectus facere eos perspiciatis quo totam ut eveniet iure reprehenderit tenetur molestiae labore, nobis recusandae fugit ab. Facilis, laudantium cum explicabo ea quaerat maiores quibusdam molestias illum! Cum facilis, placeat totam minus magnam exercitationem corrupti? Quia beatae, illo voluptates laudantium voluptatibus assumenda sed ratione ipsa deserunt vitae aut. Harum quo nihil ducimus aperiam consequatur saepe fugit aut, incidunt temporibus aliquam obcaecati at tempore accusantium labore non quos possimus odio sit? Delectus ratione quo sit labore saepe sunt vero. Qui natus architecto, aut ex consequuntur quia. Aut perspiciatis dicta molestias ipsam nisi, pariatur dignissimos sint quam.&nbsp;<br><br></div>', '<div>&nbsp;</div><ul><li><strong>Lorem ipsum :</strong> dolor sit amet consectetur adipisicing elit. Ea, libero?</li><li><strong>Lorem ipsum :</strong> dolor sit amet Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam ipsa suscipit porro, reprehenderit eius nam? consectetur adipisicing elit. Ea, libero?</li><li><strong>Lorem ipsum :</strong> dolor sit amet consectetur adipisicing elit. Ea, libero?</li><li><strong>Lorem ipsum :</strong> dolor sit amet Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam ipsa suscipit porro, reprehenderit eius nam? consectetur adipisicing elit. Ea, libero?</li><li><strong>Lorem ipsum :</strong> dolor sit amet consectetur adipisicing elit. Ea, libero?</li><li><strong>Lorem ipsum :</strong> dolor sit amet Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam ipsa suscipit porro, reprehenderit eius nam? consectetur adipisicing elit. Ea, libero?</li></ul><div>&nbsp;</div>', '5-image.jpg', '2021-11-09 09:04:52', '2021-11-11 03:51:26'),
(6, 'le-premier-de-article-de-nicolas-mE0uqRrO4W', 'http://127.0.0.1:8000/more/page/le-premier-de-article-de-nicolas-mE0uqRrO4W', 'Le premier de article de Nicolas', 'This is the subtitle', '6-thumbnail.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '<div>&nbsp;Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione tempora qui molestias autem eius odit dicta ipsa eligendi exercitationem. Ipsum sed, id est quia officia in quis explicabo eligendi atque. Culpa, repudiandae commodi. Ab veritatis accusantium voluptates debitis ipsa numquam exercitationem corrupti autem magni quaerat earum, similique dolorum at pariatur excepturi error sint soluta cum tenetur, amet sunt magnam. Voluptates possimus doloremque, error quo soluta illum quidem voluptatum quis sit nostrum sapiente. Dolores veritatis cupiditate odio hic! Alias fugit a illum similique iure aut numquam odio molestiae hic! Obcaecati cum excepturi eius eligendi nihil. Eveniet suscipit in nihil doloribus dolore laboriosam inventore quis cumque consequatur, sapiente repudiandae voluptatibus? Maiores, repudiandae, debitis obcaecati tenetur dicta aperiam tempora tempore, perspiciatis ipsam ipsum eligendi esse ratione nostrum. Animi ipsam illum quae laborum? Eveniet quasi iste exercitationem magni voluptatum dicta id quod reprehenderit? Quidem ab, eveniet dicta incidunt porro veritatis dolores labore quae nihil repudiandae accusamus beatae ex nisi magnam eos cum voluptatum dolor nam impedit minima repellendus quia placeat quasi? Repudiandae, magnam officia, temporibus culpa facilis explicabo, velit expedita ab officiis similique placeat illo doloremque eos. Omnis cumque, officiis a autem eaque quaerat quidem rerum labore eveniet vero voluptates quae facilis necessitatibus, aliquam fugit id veniam voluptatum dolorem obcaecati iusto itaque, officia quis dignissimos! Eveniet nisi voluptate aspernatur autem voluptatum rerum suscipit velit esse libero tempora cumque, hic necessitatibus id numquam similique illum nihil ipsam officia dignissimos quia et. Corporis, natus facere voluptas officia exercitationem impedit laudantium earum consectetur expedita soluta quod possimus provident, incidunt excepturi dolore minus vitae placeat! Vel enim maiores et voluptatem consequuntur facilis maxime delectus impedit similique perferendis accusantium, vero modi cumque dolorem facere hic. Molestias numquam, illum dolor molestiae perferendis officia sint ducimus perspiciatis, aliquam maxime dignissimos ipsum! Eveniet aspernatur, pariatur, quas sapiente, aliquam ullam incidunt illum ipsum harum sit porro repudiandae sint aut doloribus modi voluptates unde assumenda? Eius explicabo repudiandae, est labore voluptas tenetur impedit porro quis qui quod facilis consectetur officia id asperiores obcaecati quos. Laudantium, quas, unde, nobis obcaecati nulla possimus inventore quasi amet magnam in ab officiis temporibus. Quam exercitationem quod aliquid dolor id nesciunt excepturi magnam consequuntur numquam reiciendis itaque accusantium at vel, placeat tenetur, obcaecati, repellendus nemo. Nemo, beatae ipsum, eveniet quia laborum eos temporibus quisquam dolorem ad necessitatibus nihil autem quaerat officia sunt accusamus quibusdam facere magni fuga reiciendis consequatur. Quam, placeat vitae illo maxime, harum non quia quisquam incidunt expedita delectus quod alias. Aut delectus facere eos perspiciatis quo totam ut eveniet iure reprehenderit tenetur molestiae labore, nobis recusandae fugit ab. Facilis, laudantium cum explicabo ea quaerat maiores quibusdam molestias illum! Cum facilis, placeat totam minus magnam exercitationem corrupti? Quia beatae, illo voluptates laudantium voluptatibus assumenda sed ratione ipsa deserunt vitae aut. Harum quo nihil ducimus aperiam consequatur saepe fugit aut, incidunt temporibus aliquam obcaecati at tempore accusantium labore non quos possimus odio sit? Delectus ratione quo sit labore saepe sunt vero. Qui natus architecto, aut ex consequuntur quia. Aut perspiciatis dicta molestias ipsam nisi, pariatur dignissimos sint quam.&nbsp;</div>', '<div>&nbsp;</div><ul><li><strong>Lorem ipsum :</strong> dolor sit amet consectetur adipisicing elit. Ea, libero?</li><li><strong>Lorem ipsum :</strong> dolor sit amet Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam ipsa suscipit porro, reprehenderit eius nam? consectetur adipisicing elit. Ea, libero?</li><li><strong>Lorem ipsum :</strong> dolor sit amet consectetur adipisicing elit. Ea, libero?</li><li><strong>Lorem ipsum :</strong> dolor sit amet Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam ipsa suscipit porro, reprehenderit eius nam? consectetur adipisicing elit. Ea, libero?</li><li><strong>Lorem ipsum :</strong> dolor sit amet consectetur adipisicing elit. Ea, libero?</li><li><strong>Lorem ipsum :</strong> dolor sit amet Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam ipsa suscipit porro, reprehenderit eius nam? consectetur adipisicing elit. Ea, libero?</li></ul><div>&nbsp;</div>', '6-image.jpg', '2021-11-11 04:08:39', '2021-11-11 04:08:39');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Mm3dudvuC40E6RI96x9oRK8Wd4UXOvqJw09CZl8F', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUzFOWFNIa1VkVVBvUk5PZzlPcUxhQnlMNjh1NXdRTFA2aHNhMVNweCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJGFXZFV6eVdHVndYOFU3OE1WT1doQS5yU3JyUm9tUHBBZFUxM1o3dzNOWWtOQ0tlM01FcS9pIjtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozODoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2Zyb250ZW5kL2NvbnRhY3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1637013043);

-- --------------------------------------------------------

--
-- Table structure for table `simulate_projects`
--

CREATE TABLE `simulate_projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` bigint(20) NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_status` enum('read','unreade') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unreade',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_link_settings`
--

CREATE TABLE `social_link_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_link_settings`
--

INSERT INTO `social_link_settings` (`id`, `icon`, `link`, `created_at`, `updated_at`) VALUES
(2, '<i class=\"fab fa-facebook-f\"></i>', 'https://soclose.co/', '2021-11-03 03:47:23', '2021-11-03 03:47:23'),
(3, '<i class=\"fab fa-youtube\"></i>', 'https://soclose.co/', '2021-11-03 03:47:55', '2021-11-03 03:47:55');

-- --------------------------------------------------------

--
-- Table structure for table `solution_resons`
--

CREATE TABLE `solution_resons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `our_solutions_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `solution_resons`
--

INSERT INTO `solution_resons` (`id`, `our_solutions_id`, `title`, `details`, `image`, `created_at`, `updated_at`) VALUES
(5, 43, 'financer vos travaux à moindre coût', 'Les solutions sont à partir de 1€', '1716528675088848.png', '2021-11-15 14:48:30', '2021-11-15 14:48:30'),
(6, 43, 'confort de votre habitation', 'Été comme en hiver, cela permet d’améliorer grandement votre confort', '1716528675095724.png', '2021-11-15 14:48:30', '2021-11-15 14:48:30'),
(7, 43, 'par unartisan « reconnu garant de l’environnement »', 'Gage de confiance, notre entreprise est « reconnu garant de l’environnement » (qualibat – RGE) et exerce dans le respect des normes et de l’excellence technique.', '1716528675106529.png', '2021-11-15 14:48:30', '2021-11-15 14:48:30'),
(8, 43, 'Réduisez considérablement vos factures en chauffage', 'Gage de confiance, notre entreprise est « reconnu garant de l’environnement » (qualibat – rge) et exerce dans le respect des normes et de l’excellence technique.', '1716528675112379.png', '2021-11-15 14:48:30', '2021-11-15 14:48:30'),
(9, 44, 'Bénéficiez des primes de l’Etat pour financer vos travaux à moindre coût', 'Les solutions sont à partir de 1€.', '1716531281703647.png', '2021-11-15 15:29:56', '2021-11-15 15:29:56'),
(10, 44, 'confort de votre habitation', 'Été comme en hiver, cela permet d’améliorer grandement votre confort', '1716531281714343.png', '2021-11-15 15:29:56', '2021-11-15 15:29:56'),
(11, 44, 'par unartisan « reconnu garant de l’environnement »', 'Gage de confiance, notre entreprise est « reconnu garant de l’environnement » (qualibat – RGE) et exerce dans le respect des normes et de l’excellence technique.', '1716531281720784.png', '2021-11-15 15:29:56', '2021-11-15 15:29:56'),
(12, 44, 'Réduisez considérablement vos factures en chauffage', 'Gage de confiance, notre entreprise est « reconnu garant de l’environnement » (qualibat – rge) et exerce dans le respect des normes et de l’excellence technique.', '1716531281727755.png', '2021-11-15 15:29:56', '2021-11-15 15:29:56'),
(13, 45, 'financer vos travaux à moindre coût', 'Les solutions sont à partir de 1€.', '1716531471722807.png', '2021-11-15 15:32:57', '2021-11-15 15:32:57'),
(14, 45, 'confort de votre habitation', 'Été comme en hiver, cela permet d’améliorer grandement votre confort', '1716531471728436.png', '2021-11-15 15:32:57', '2021-11-15 15:32:57'),
(15, 45, 'par unartisan « reconnu garant de l’environnement »', 'Gage de confiance, notre entreprise est « reconnu garant de l’environnement » (qualibat – RGE) et exerce dans le respect des normes et de l’excellence technique.', '1716531471732942.png', '2021-11-15 15:32:57', '2021-11-15 15:32:57'),
(16, 45, 'Réduisez considérablement vos factures en chauffage', 'Gage de confiance, notre entreprise est « reconnu garant de l’environnement » (qualibat – rge) et exerce dans le respect des normes et de l’excellence technique.', '1716531471738085.png', '2021-11-15 15:32:57', '2021-11-15 15:32:57');

-- --------------------------------------------------------

--
-- Table structure for table `subscribes`
--

CREATE TABLE `subscribes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribes`
--

INSERT INTO `subscribes` (`id`, `email`, `created_at`, `updated_at`) VALUES
(3, 'reporter@gmail.com', '2021-09-03 05:03:17', '2021-04-03 05:03:17'),
(4, 'sumon@mail.com', '2021-11-03 05:03:24', '2021-10-03 05:03:24'),
(5, 'admin@admin.com', '2021-11-13 04:24:37', '2021-11-13 04:24:37'),
(6, 'test@mail.com', '2021-11-13 04:38:28', '2021-11-13 04:38:28'),
(7, 'test@gmail.com', '2021-10-13 04:39:56', '2021-11-13 04:39:56'),
(8, 'cse.diu@mail.com', '2021-10-13 04:41:26', '2021-10-13 04:41:26');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `image`, `created_at`, `updated_at`) VALUES
(1, '1.jpg', '2021-10-16 08:47:39', '2021-10-16 08:47:39'),
(3, '3.jpg', '2021-10-16 08:55:08', '2021-10-16 08:55:08'),
(4, '4.jpg', '2021-10-16 08:55:16', '2021-10-16 08:55:16'),
(5, '5.jpg', '2021-10-16 08:55:22', '2021-10-16 08:55:22'),
(6, '6.jpg', '2021-10-16 08:55:30', '2021-10-16 08:55:30'),
(7, '7.jpg', '2021-10-16 08:55:37', '2021-10-16 08:55:37'),
(8, '8.jpg', '2021-10-16 08:55:48', '2021-10-16 08:55:48');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_team` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `user_id`, `name`, `personal_team`, `created_at`, `updated_at`) VALUES
(1, 1, 'Super\'s Team', 1, '2021-10-11 08:50:29', '2021-10-11 08:50:29'),
(2, 2, 'Admin\'s Team', 1, '2021-10-11 08:52:06', '2021-10-11 08:52:06'),
(3, 3, 'user\'s Team', 1, '2021-10-11 08:59:05', '2021-10-11 08:59:05');

-- --------------------------------------------------------

--
-- Table structure for table `team_invitations`
--

CREATE TABLE `team_invitations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_user`
--

CREATE TABLE `team_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `theme_colors`
--

CREATE TABLE `theme_colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `theme_settings`
--

CREATE TABLE `theme_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `theme` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'light-layout',
  `nav` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'expanded',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `theme_settings`
--

INSERT INTO `theme_settings` (`id`, `user_id`, `theme`, `nav`, `created_at`, `updated_at`) VALUES
(1, 1, 'dark-layout', 'expanded', NULL, '2021-11-15 15:24:30'),
(2, 2, 'dark-layout', 'collapsed', NULL, '2021-11-12 01:03:26'),
(3, 3, 'dark-layout', 'collapsed', NULL, '2021-11-12 01:03:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('s_admin','admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `role`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@admin.com', NULL, '$2y$10$aWdUzyWGVwX8U78MVOWhA.rSrrRomPpAdU13Z7w3NYkNCKe3MEq/i', NULL, NULL, 's_admin', 'nVyWejhz6utmTobM5VzElaciDMXdkuZcTACBvcXnNDgYjqgC6l9ubVDMy12C', 1, NULL, '2021-10-11 08:50:29', '2021-10-11 08:50:30'),
(2, 'Admin', 'admin@admin.com', NULL, '$2y$10$9OrlE8HcDDjYOLOHV2cIfOzBJIOkS2OxpehTKAEcxuhIduTH90Q2S', NULL, NULL, 'admin', NULL, 2, NULL, '2021-10-11 08:52:06', '2021-10-11 08:52:06'),
(3, 'user', 'user@admin.com', NULL, '$2y$10$QpcfLYAU7VMYrm/zsnpkA.zgY13rqJDeYs8wzSChnXab13JrizMOq', NULL, NULL, 'user', NULL, 3, NULL, '2021-10-11 08:59:05', '2021-10-11 08:59:06');

-- --------------------------------------------------------

--
-- Table structure for table `user_messages`
--

CREATE TABLE `user_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `work_withs`
--

CREATE TABLE `work_withs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_withs`
--

INSERT INTO `work_withs` (`id`, `title`, `details`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Votre diagnostic simple & immédiat', 'En fonction des paramètres de votre habitat, nous définissons une solution performante pour vous rendre la vie plus agréable et vous accompagner sur votre projet de rénovation énergétique.', '2.jpg', '2021-10-13 09:31:33', '2021-10-14 03:15:19'),
(3, 'Vos travaux avec un expert', 'En fonction des paramètres de votre habitat, nous définissons une solution performante pour vous rendre la vie plus agréable et vous accompagner sur votre projet de rénovation énergétique.', '3.jpg', '2021-10-14 03:16:23', '2021-10-14 03:16:23'),
(4, 'Une entreprise Reconnue Garant de l\'Environnement (RGE)', 'En fonction des paramètres de votre habitat, nous définissons une solution performante pour vous rendre la vie plus agréable et vous accompagner sur votre projet de rénovation énergétique.', '4.jpg', '2021-10-14 03:16:43', '2021-10-14 03:16:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advice`
--
ALTER TABLE `advice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advice_and_grants`
--
ALTER TABLE `advice_and_grants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advice_faqs`
--
ALTER TABLE `advice_faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bienvenues`
--
ALTER TABLE `bienvenues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clint_opinions`
--
ALTER TABLE `clint_opinions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color_settings`
--
ALTER TABLE `color_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expertises`
--
ALTER TABLE `expertises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `favicons`
--
ALTER TABLE `favicons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer_column_settings`
--
ALTER TABLE `footer_column_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer_settings`
--
ALTER TABLE `footer_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grant_categories`
--
ALTER TABLE `grant_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logos`
--
ALTER TABLE `logos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `our_services`
--
ALTER TABLE `our_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `our_societies`
--
ALTER TABLE `our_societies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `our_solutions`
--
ALTER TABLE `our_solutions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `our_solution_details`
--
ALTER TABLE `our_solution_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `simulate_projects`
--
ALTER TABLE `simulate_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_link_settings`
--
ALTER TABLE `social_link_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `solution_resons`
--
ALTER TABLE `solution_resons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribes`
--
ALTER TABLE `subscribes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_user_id_index` (`user_id`);

--
-- Indexes for table `team_invitations`
--
ALTER TABLE `team_invitations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_invitations_team_id_email_unique` (`team_id`,`email`);

--
-- Indexes for table `team_user`
--
ALTER TABLE `team_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_user_team_id_user_id_unique` (`team_id`,`user_id`);

--
-- Indexes for table `theme_colors`
--
ALTER TABLE `theme_colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theme_settings`
--
ALTER TABLE `theme_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_messages`
--
ALTER TABLE `user_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_withs`
--
ALTER TABLE `work_withs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `advice`
--
ALTER TABLE `advice`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `advice_and_grants`
--
ALTER TABLE `advice_and_grants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `advice_faqs`
--
ALTER TABLE `advice_faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bienvenues`
--
ALTER TABLE `bienvenues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clint_opinions`
--
ALTER TABLE `clint_opinions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `color_settings`
--
ALTER TABLE `color_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expertises`
--
ALTER TABLE `expertises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favicons`
--
ALTER TABLE `favicons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `footer_column_settings`
--
ALTER TABLE `footer_column_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `footer_settings`
--
ALTER TABLE `footer_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `grant_categories`
--
ALTER TABLE `grant_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `logos`
--
ALTER TABLE `logos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `our_services`
--
ALTER TABLE `our_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `our_societies`
--
ALTER TABLE `our_societies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `our_solutions`
--
ALTER TABLE `our_solutions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `our_solution_details`
--
ALTER TABLE `our_solution_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `simulate_projects`
--
ALTER TABLE `simulate_projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `social_link_settings`
--
ALTER TABLE `social_link_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `solution_resons`
--
ALTER TABLE `solution_resons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `subscribes`
--
ALTER TABLE `subscribes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `team_invitations`
--
ALTER TABLE `team_invitations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_user`
--
ALTER TABLE `team_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `theme_colors`
--
ALTER TABLE `theme_colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `theme_settings`
--
ALTER TABLE `theme_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_messages`
--
ALTER TABLE `user_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `work_withs`
--
ALTER TABLE `work_withs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `team_invitations`
--
ALTER TABLE `team_invitations`
  ADD CONSTRAINT `team_invitations_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
