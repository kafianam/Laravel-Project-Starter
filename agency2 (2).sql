-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2025 at 07:48 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agency2`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_02_24_140329_create_products_table', 1),
(6, '2025_02_24_172829_add_role_to_users_table', 2),
(7, '2025_02_25_124351_add_role_to_users_table', 3),
(8, '2025_02_25_174746_create_services_table', 4),
(9, '2025_04_12_181712_create_visa_processing_forms_table', 5),
(10, '2025_04_15_014555_update_visa_processing_forms_table', 6),
(11, '2025_04_17_104340_create_bookings_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `product_code`, `description`, `created_at`, `updated_at`) VALUES
(1, 'test', '100', 'test', 'testsese', '2025-02-24 10:32:16', '2025-02-24 10:32:16');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name`, `fee`, `created_at`, `updated_at`) VALUES
(3, 'singapore visa', 1000.00, '2025-02-26 04:57:56', '2025-02-26 04:57:56'),
(4, 'Germany Visa', 5000.00, '2025-02-26 05:20:20', '2025-02-26 05:20:20'),
(5, 'Indian Visa', 3000.00, '2025-04-16 23:30:34', '2025-04-16 23:30:34'),
(6, 'test service', 1050.00, '2025-04-21 02:21:40', '2025-04-21 02:21:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(2, 'Admin', 'admin@example.com', '2025-02-24 16:11:42', '$2y$10$QlFCTOR3VRiFxd8ob6oUfuid/Xqadccc2PZQk1tLm6etM3Dv7RhzS', NULL, '2025-02-24 16:11:42', '2025-02-24 10:30:17', 'admin'),
(3, 'Taskin', 'taskin@example.com', NULL, '$2y$10$ppf..8rfauWSqDZ8a6Ujh.gXU.Qj4ntduAbkJ88W3ZQ18l2QQORv6', NULL, '2025-02-25 07:05:14', '2025-02-25 07:05:14', 'customer'),
(4, 'Agent  Anam', 'agentanam@example.com', NULL, '$2y$10$X0fl7rZ5H4O.GWQbByh1tOkFufRHDnHspSoqFbTtl3LPLZllsHapm', NULL, '2025-02-25 08:15:27', '2025-02-25 08:15:27', 'customer'),
(6, 'Agent Topu', 'agenttopu@example.com', NULL, '$2y$10$7S1jkj5YQ.orkf49XeagIu5D/IyRAf9hmaOV/R4G8L9dS6K4lPoWe', 'jrl4JiygW7RYZeCEZGFZcyQw7T6oPJmZ57heGNWprSBQuQgaXmZn6fAV70wh', '2025-02-25 08:35:51', '2025-02-25 08:35:51', 'agent'),
(7, 'Test Customer', 'kafianam@gmail.com', NULL, '$2y$10$2jDo9AxyVGP/o14YZXwNcOMq2bLKFvNKGNFRbDXFvZAEEVTBzZdpi', NULL, '2025-04-18 21:59:10', '2025-04-18 21:59:10', 'customer'),
(9, 'Test Customer', 'kafianam+customer01@gmail.com', NULL, '$2y$10$1ZHqs2vUVuor2XR/2ROwrOCk8v0wJWLF6mljccM2onOmTDQgiMyTm', NULL, '2025-04-18 22:07:22', '2025-04-18 22:07:22', 'customer'),
(11, 'Customer Tom', 'customer01@yopmail.com', NULL, '$2y$10$RPXjSYbhY3I4o8rypt8MeeLU6cI2FDSSxZymIQ7WI33AO4nuhJ4fS', NULL, '2025-04-18 23:30:40', '2025-04-18 23:30:40', 'customer'),
(13, 'Customer02', 'customer02@yaopmail.com', NULL, '$2y$10$RLffI3J3AO10OVUbNmCZYusrFzNsR/s0CDAZ.4UgqyUA9hrMCZo2G', NULL, '2025-04-23 22:15:46', '2025-04-23 22:15:46', 'customer'),
(14, 'customer03', 'customer03@yopmail.com', NULL, '$2y$10$MN0Vh/jki75.N2nvsb0l1.amjcOaRrP9ZrnIFEN.taYoFVc9MPMeK', NULL, '2025-04-23 23:47:56', '2025-04-23 23:47:56', 'customer'),
(15, 'customer04', 'customer04@yopmail.com', NULL, '$2y$10$QNonOz3WzoyCENoplxAAjucHmnSHL8Mf68o2jo8K/xqF15lgNkOrS', NULL, '2025-04-23 23:53:17', '2025-04-23 23:53:17', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `visa_processing_forms`
--

CREATE TABLE `visa_processing_forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `passport_number` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `travel_from` varchar(255) DEFAULT NULL,
  `travel_type` varchar(255) DEFAULT NULL,
  `expected_travel_date` date DEFAULT NULL,
  `primary_contact` varchar(255) DEFAULT NULL,
  `emergency_contact` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `passport_copy` varchar(255) DEFAULT NULL,
  `ticket_copy` varchar(255) DEFAULT NULL,
  `hotel_booking` varchar(255) DEFAULT NULL,
  `other_doc` varchar(255) DEFAULT NULL,
  `advance_purchase` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`advance_purchase`)),
  `application_submit_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `application_status` enum('Pending','Processing','On Hold','Approved','Cancel','Reject') NOT NULL DEFAULT 'Pending',
  `payment_status` enum('Paid','Unpaid') NOT NULL DEFAULT 'Unpaid',
  `payment_method` enum('Cash','Bkash','Rocket','Nagod','Cheque','Online Bank Transfer') NOT NULL DEFAULT 'Cash',
  `payment_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visa_processing_forms`
--

INSERT INTO `visa_processing_forms` (`id`, `user_id`, `service_id`, `name`, `passport_number`, `nationality`, `travel_from`, `travel_type`, `expected_travel_date`, `primary_contact`, `emergency_contact`, `email`, `passport_copy`, `ticket_copy`, `hotel_booking`, `other_doc`, `advance_purchase`, `application_submit_date`, `application_status`, `payment_status`, `payment_method`, `payment_date`, `created_at`, `updated_at`) VALUES
(3, 2, 3, 'Fariza Anam', '12222', 'Bangladesh', 'Bangladesh', 'Business', NULL, '01922194850', '01344194850', 'admin@example.com', 'documents/Fe8H7Bb7yYECFRdkeP7OmUvxa5Vxz9Pwv3DabSel.jpg', 'documents/8GirvYgqgwxbunGQui6D1KXo5sPOaZ7rUVWKQLQd.jpg', 'documents/ZAesdlb7QHEPO86FPS0aET6wcWi7wX2F6F88jNuQ.png', 'documents/lsnaYBXIl37byhPrU6D76guCxsQh5IhV1PpqANc9', '[\"Hotel Accommodation\",\"Tickets & Transfer\"]', '2025-04-18 17:43:53', 'Approved', 'Unpaid', 'Cash', NULL, '2025-04-18 11:43:53', '2025-04-26 10:25:35'),
(4, 2, 4, 'Fariza Anam', '12222', 'Bangladesh', 'Bangladesh', 'Business', NULL, '01922194850', '01344194850', 'admin@example.com', 'documents/bpMdIYt1AJLwQJ09Kbc9Pgnfb4CfJ2xm3s3ikKRP.jpg', 'documents/w6ARd1Hy3IsLJmnDLFuCGHTOUuylml1fNdSHbevM.jpg', 'documents/DiAOIAQA5uVGfCxXo6fKRhOCKO2xXLvA47RfMTq8.png', 'documents/ikNMN8TBWnzRW0NAngMnUAFty1uNnCW0Yn3nAcb2', '[\"Tickets & Transfer\",\"Tour Packages\"]', '2025-04-18 17:52:41', 'Approved', 'Unpaid', 'Cash', NULL, '2025-04-18 11:52:41', '2025-04-26 09:51:59'),
(5, 11, 3, 'Fariza Anam', '12222', 'Bangladesh', 'Bangladesh', 'Business', NULL, '01922194850', '01344194850', 'admin@example.com', NULL, NULL, NULL, NULL, '[\"Hotel Accommodation\"]', '2025-04-24 03:48:35', 'Approved', 'Unpaid', 'Cash', NULL, '2025-04-23 21:48:35', '2025-04-25 04:11:49'),
(6, 13, 4, 'Titu khan', '12222', 'Bangladesh', 'Bangladesh', 'Business', NULL, '01922194850', '01344194850', 'admin@example.com', NULL, NULL, NULL, NULL, '[\"Hotel Accommodation\"]', '2025-04-24 04:52:57', 'Approved', 'Unpaid', 'Cash', NULL, '2025-04-23 22:52:57', '2025-04-26 10:52:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visa_processing_forms`
--
ALTER TABLE `visa_processing_forms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_id` (`service_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `visa_processing_forms`
--
ALTER TABLE `visa_processing_forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `visa_processing_forms`
--
ALTER TABLE `visa_processing_forms`
  ADD CONSTRAINT `visa_processing_forms_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
