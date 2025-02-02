-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2025 at 06:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'รหัสผู้ใช้',
  `car_id` bigint(20) UNSIGNED NOT NULL COMMENT 'รหัสรถยนต์',
  `usage_type` varchar(255) NOT NULL COMMENT 'ประเภทการใช้งาน',
  `purpose` varchar(255) NOT NULL COMMENT 'เพื่อ',
  `subject` varchar(255) NOT NULL COMMENT 'เรื่อง',
  `location` varchar(255) NOT NULL COMMENT 'สถานที่',
  `start_date` date NOT NULL COMMENT 'วันที่เริ่มต้นการจอง',
  `end_date` date NOT NULL COMMENT 'วันที่สิ้นสุดการจอง',
  `count_days` int(11) NOT NULL COMMENT 'จำนวนวัน',
  `start_time` time NOT NULL COMMENT 'เวลาเริ่มต้นการจอง',
  `end_time` time NOT NULL COMMENT 'เวลาสิ้นสุดการจอง',
  `count_hours` int(11) NOT NULL COMMENT 'จำนวนชั่วโมง',
  `count_minutes` int(11) NOT NULL COMMENT 'จำนวนนาที',
  `count_people` int(11) NOT NULL COMMENT 'จำนวนคน',
  `note` text DEFAULT NULL COMMENT 'หมายเหตุ',
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending' COMMENT 'สถานะการจอง',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `car_id`, `usage_type`, `purpose`, `subject`, `location`, `start_date`, `end_date`, `count_days`, `start_time`, `end_time`, `count_hours`, `count_minutes`, `count_people`, `note`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'test4', 'test4', 'test4', 'test4', '2025-02-06', '2025-02-07', 2, '08:00:00', '17:30:00', 9, 30, 5, 'test4', 'approved', '2025-01-30 08:53:18', '2025-01-30 10:52:47'),
(2, 2, 1, 'test1', 'test1', 'test1', 'test1', '2025-02-01', '2025-02-03', 3, '08:00:00', '18:00:00', 10, 0, 5, 'test1', 'pending', '2025-01-30 08:54:06', '2025-01-30 08:54:06'),
(3, 1, 1, 'test3', 'test3', 'test3', 'test3', '2025-02-04', '2025-02-05', 2, '08:00:00', '18:00:00', 10, 0, 3, 'test3', 'rejected', '2025-01-30 09:47:28', '2025-01-30 10:53:20'),
(4, 2, 1, 'test3', 'test3', 'test3', 'test3', '2025-02-08', '2025-02-09', 2, '08:30:00', '16:30:00', 8, 0, 4, 'test3', 'approved', '2025-01-30 11:16:06', '2025-01-30 11:23:34'),
(5, 2, 1, 'test2', 'test2', 'test2', 'test2', '2025-02-10', '2025-02-12', 3, '01:22:00', '03:22:00', 2, 0, 5, 'test2', 'pending', '2025-01-30 11:22:34', '2025-01-30 11:22:34'),
(6, 4, 1, 'test5', 'test5', 'test5', 'test5', '2025-01-31', '2025-01-31', 1, '10:30:00', '16:00:00', 5, 30, 5, 'test5', 'pending', '2025-01-30 20:36:53', '2025-01-30 20:36:53');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'ชื่อรถ',
  `license_plate` varchar(255) NOT NULL COMMENT 'ทะเบียนรถ',
  `brand` varchar(255) NOT NULL COMMENT 'ยี่ห้อรถ',
  `model` varchar(255) NOT NULL COMMENT 'รุ่นรถ',
  `seat_count` int(11) NOT NULL COMMENT 'จำนวนที่นั่ง',
  `vin` varchar(255) NOT NULL COMMENT 'เลขตัวถัง (Vehicle Identification Number)',
  `warranty_expiration_date` date NOT NULL COMMENT 'วันหมดอายุประกัน',
  `tax_act_expiration_date` date NOT NULL COMMENT 'วันหมดอายุภาษี/พรบ.',
  `status` enum('available','in_use','maintenance') NOT NULL DEFAULT 'available' COMMENT 'สถานะรถ',
  `note` text DEFAULT NULL COMMENT 'หมายเหตุ',
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'รายการรูปภาพของรถ' CHECK (json_valid(`images`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `name`, `license_plate`, `brand`, `model`, `seat_count`, `vin`, `warranty_expiration_date`, `tax_act_expiration_date`, `status`, `note`, `images`, `created_at`, `updated_at`) VALUES
(1, 'Toyota Corolla', '5กท-1234', 'Toyota', 'Corolla', 4, '1HGBH41JXMN109186', '2025-02-28', '2025-02-28', 'available', 'รถใหม่พร้อมใช้งาน', '\"[\\\"images\\\\\\/cars\\\\\\/1738250482-679b98f23f4ca.jpg\\\",\\\"images\\\\\\/cars\\\\\\/1738250482-679b98f23f9a5.jpg\\\",\\\"images\\\\\\/cars\\\\\\/1738250482-679b98f23fc73.jpg\\\",\\\"images\\\\\\/cars\\\\\\/1738250482-679b98f23ff9e.jpg\\\",\\\"images\\\\\\/cars\\\\\\/1738250482-679b98f240294.jpg\\\"]\"', '2025-01-30 08:21:22', '2025-01-30 08:21:22');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(11, '0001_01_01_000000_create_users_table', 1),
(12, '0001_01_01_000001_create_cache_table', 1),
(13, '0001_01_01_000002_create_jobs_table', 1),
(14, '2025_01_30_061851_create_cars_table', 1),
(16, '2025_01_30_061914_create_bookings_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('OX51vLpkGXH5jNIiex4Rhfnci2BTdvjXY2b939Dk', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiREEyOHhaTEdkSExFOW1KVElVVWx1U0cwVlp0RzBwS1pGYjgwQmloMCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1738515597),
('t7c7uQRrGuX6jxzaaKlOMqQF21rDbOd5wqdoyPYb', 1, '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6 Mobile/15E148 Safari/604.1', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZjBBWHl5ZWl6bE5ZT05CSFB2THZhcHRRSEVuV2N2cmltNmFZOXRyeiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI2OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1738316850);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'ชื่อ-นามสกุล',
  `position` varchar(255) NOT NULL COMMENT 'ตำแหน่ง',
  `email` varchar(255) NOT NULL COMMENT 'อีเมล',
  `phone` varchar(255) NOT NULL COMMENT 'เบอร์โทรศัพท์',
  `password` varchar(255) NOT NULL COMMENT 'รหัสผ่าน',
  `role` enum('user','admin') NOT NULL DEFAULT 'user' COMMENT 'บทบาทผู้ใช้',
  `remember_token` varchar(100) DEFAULT NULL COMMENT 'Token สำหรับจำสถานะล็อกอิน',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `position`, `email`, `phone`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', 'admin@gmail.com', '0925728232', '$2y$12$l4gRhtKA9ADMq9GIiPIiqODEEIwoYuzNJxnxgIBeaESrawO/X1wP.', 'admin', NULL, '2025-01-30 08:17:49', '2025-01-30 08:17:49'),
(2, 'user1', 'user1', 'user1@gmail.com', '0925728233', '$2y$12$qES5NY8n.E5JnD3v5pt7hu/dNu9sDoUyp8fZEWlSW2ZFAUUQ31FqC', 'user', NULL, '2025-01-30 08:19:58', '2025-01-30 08:19:58'),
(3, 'user2', 'user2', 'user2@gmail.com', '0925728234', '$2y$12$670EwZhzExTX1KqzWDsRX.sa.CJvcGo.DnSDMBElY/f8RCJb86uPW', 'user', NULL, '2025-01-30 08:20:16', '2025-01-30 08:20:16'),
(4, 'user6', 'user6', 'user6@gmail.com', '0925728567', '$2y$12$ZNLyQPu5C3pMI22r53TYEe6nUgX6fqqhjnknj3Hxv46gHOaqxxlHm', 'user', NULL, '2025-01-30 12:05:22', '2025-01-30 12:05:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_car_id_foreign` (`car_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cars_license_plate_unique` (`license_plate`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_foreign` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
