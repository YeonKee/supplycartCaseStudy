-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2023 at 03:53 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `supplycartcs`
--

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
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `description` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_id`, `user_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 9, 'You have added product Milo into your cart.', '2023-12-21 04:39:46', '2023-12-21 04:39:46'),
(2, 9, 'You have added product Milo x1 into your cart.', '2023-12-21 04:40:26', '2023-12-21 04:40:26'),
(3, 9, 'You have added product Apple x1 into your cart.', '2023-12-21 04:40:37', '2023-12-21 04:40:37'),
(4, 9, 'You have removed product Milo from your cart.', '2023-12-21 04:40:47', '2023-12-21 04:40:47'),
(5, 9, 'You have make a purchase for order 6.', '2023-12-21 04:40:57', '2023-12-21 04:40:57'),
(6, 9, 'You have added product iPhone 15 Pro x1 into your cart.', '2023-12-21 04:41:36', '2023-12-21 04:41:36'),
(7, 9, 'You have make a purchase for order 7.', '2023-12-21 04:41:42', '2023-12-21 04:41:42'),
(8, 9, 'You have added product Milo x1 into your cart.', '2023-12-21 12:52:49', '2023-12-21 12:52:49'),
(9, 9, 'You have successfully logged out from your account.', '2023-12-21 12:57:46', '2023-12-21 12:57:46'),
(10, 9, 'You have logged in.', '2023-12-21 12:58:02', '2023-12-21 12:58:02'),
(11, 9, 'You have successfully logged out from your account.', '2023-12-21 12:58:35', '2023-12-21 12:58:35'),
(14, 11, 'You have created a account using email soyk-wm20@student.tarc.edu.my.', '2023-12-21 13:10:02', '2023-12-21 13:10:02'),
(15, 11, 'You have successfully verify your email.', '2023-12-21 13:10:34', '2023-12-21 13:10:34'),
(16, 11, 'You have logged in.', '2023-12-21 13:10:39', '2023-12-21 13:10:39'),
(17, 11, 'You have successfully logged out from your account.', '2023-12-21 13:12:01', '2023-12-21 13:12:01'),
(18, 11, 'You have logged in.', '2023-12-21 13:14:05', '2023-12-21 13:14:05'),
(19, 11, 'You have successfully logged out from your account.', '2023-12-21 13:14:08', '2023-12-21 13:14:08'),
(20, 9, 'You have logged in.', '2023-12-21 13:14:16', '2023-12-21 13:14:16'),
(21, 9, 'You have successfully logged out from your account.', '2023-12-21 13:14:41', '2023-12-21 13:14:41');

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_12_19_160600_create_orders_table', 1),
(6, '2023_12_19_160641_create_products_table', 1),
(7, '2023_12_19_162159_create_logs_table', 1),
(8, '2023_12_19_162228_create_order___products_table', 1),
(9, '2023_12_19_164432_add_point_users', 2),
(10, '2023_12_20_102052_add_image_products', 3),
(11, '2023_12_21_071536_edit_rank_users', 4),
(12, '2023_12_21_095939_add_address_user_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` varchar(10) NOT NULL,
  `payment_method` varchar(30) DEFAULT NULL,
  `delivery_address` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `status`, `payment_method`, `delivery_address`, `created_at`, `updated_at`) VALUES
(1, 9, 'Paid', 'COD', 'Setapak, Danau Kota', '2023-12-20 23:27:46', '2023-12-21 03:14:34'),
(2, 9, 'Paid', 'COD', 'Setapak, Danau Kota', '2023-12-21 03:15:51', '2023-12-21 03:15:56'),
(3, 9, 'Paid', 'COD', 'Setapak, Danau Kota', '2023-12-21 03:16:34', '2023-12-21 03:30:18'),
(4, 9, 'Paid', 'Credit/Debit', 'Setapak, Danau Kota', '2023-12-21 03:30:25', '2023-12-21 04:12:03'),
(5, 9, 'Paid', 'Credit/Debit', 'Setapak, Danau Kota', '2023-12-21 04:12:10', '2023-12-21 04:14:34'),
(6, 9, 'Paid', 'COD', 'Setapak, Danau Kota', '2023-12-21 04:14:36', '2023-12-21 04:40:57'),
(7, 9, 'Paid', 'COD', 'Setapak, Danau Kota', '2023-12-21 04:41:34', '2023-12-21 04:41:42'),
(8, 9, 'Cart', NULL, NULL, '2023-12-21 12:52:49', '2023-12-21 12:52:49'),
(9, 11, 'Cart', NULL, NULL, '2023-12-21 13:11:01', '2023-12-21 13:11:01');

-- --------------------------------------------------------

--
-- Table structure for table `order__products`
--

CREATE TABLE `order__products` (
  `order_prod_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `prod_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order__products`
--

INSERT INTO `order__products` (`order_prod_id`, `order_id`, `prod_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 8, 1.00, '2023-12-21 00:19:40', '2023-12-21 00:22:53'),
(4, 1, 3, 1, 5399.10, '2023-12-21 00:24:21', '2023-12-21 00:24:21'),
(5, 2, 1, 1, 30.00, '2023-12-21 03:15:51', '2023-12-21 03:15:51'),
(8, 3, 1, 1, 30.00, '2023-12-21 03:30:12', '2023-12-21 03:30:12'),
(9, 4, 1, 1, 29.10, '2023-12-21 04:11:58', '2023-12-21 04:11:58'),
(10, 5, 1, 1, 29.10, '2023-12-21 04:12:31', '2023-12-21 04:12:31'),
(12, 6, 2, 1, 2.91, '2023-12-21 04:40:37', '2023-12-21 04:40:37'),
(13, 7, 3, 1, 5819.03, '2023-12-21 04:41:36', '2023-12-21 04:41:36'),
(14, 8, 1, 1, 27.00, '2023-12-21 12:52:49', '2023-12-21 12:52:49');

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
  `prod_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `price` double(10,2) NOT NULL,
  `total_quantity` int(11) NOT NULL,
  `sold_quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `name`, `image`, `category`, `brand`, `price`, `total_quantity`, `sold_quantity`, `created_at`, `updated_at`) VALUES
(1, 'Milo', '07f9510ba5.png', 'Drinks', 'Nestle', 30.00, 100, 25, '2023-12-20 03:04:31', '2023-12-21 04:14:34'),
(2, 'Apple', 'c905d3855f.png', 'Fruits', 'Others', 3.00, 100, 1, '2023-12-20 03:11:19', '2023-12-21 04:40:57'),
(3, 'iPhone 15 Pro', '09bd15a068.png', 'Gadgets', 'Apple', 5999.00, 100, 2, '2023-12-20 04:20:19', '2023-12-21 04:41:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `is_email_verified` int(11) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `point` int(11) NOT NULL,
  `rank` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `address`, `email`, `is_email_verified`, `password`, `point`, `rank`, `created_at`, `updated_at`) VALUES
(9, 'So Yeon Kee', 'Setapak, Danau Kota', 'yeon101702@gmail.com', 1, '$2y$10$PVvdlceiMNu0JcMLlDqw8e9hnAo0zj2woqDbWbZlHTIc5dmh79mye', 11375, 'Platinum', '2023-12-20 21:34:05', '2023-12-21 04:41:42'),
(11, 'Yeon Kee So', 'Lot 62, Light Industries Building Bandar Penampang Baru', 'soyk-wm20@student.tarc.edu.my', 1, '$2y$10$6z50DljWFmPqbi5C2hq.Z.QYlcwviiF06R1n6EWkrZywx0iYkzHPi', 0, 'Classic', '2023-12-21 13:10:02', '2023-12-21 13:10:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order__products`
--
ALTER TABLE `order__products`
  ADD PRIMARY KEY (`order_prod_id`),
  ADD KEY `order__products_order_id_foreign` (`order_id`),
  ADD KEY `order__products_prod_id_foreign` (`prod_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
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
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order__products`
--
ALTER TABLE `order__products`
  MODIFY `order_prod_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order__products`
--
ALTER TABLE `order__products`
  ADD CONSTRAINT `order__products_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order__products_prod_id_foreign` FOREIGN KEY (`prod_id`) REFERENCES `products` (`prod_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
