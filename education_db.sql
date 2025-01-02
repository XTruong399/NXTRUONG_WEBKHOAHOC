-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 01, 2025 lúc 03:06 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `education_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_phone` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_email`, `admin_password`, `admin_name`, `admin_phone`, `created_at`, `updated_at`) VALUES
(1, 'admin@mail.com', '$2y$10$MtfEh8r.4FO7lTCEuq3HH.Cw28UwWTDHT7ucbbK/ZDtUZ9Uq.Skc.', 'Ng.Xuan.Truong', '12345678', '2024-12-13 14:03:45', NULL),
(3, 'admin1@mail.com', '111111', 'ahihi', 'admin1@mail.com', '2024-12-27 04:52:00', '2024-12-27 04:52:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `Pro_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `Pro_id`, `quantity`, `created_at`, `updated_at`) VALUES
(41, 4, 3, 1, '2024-12-27 04:44:20', '2024-12-27 04:44:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `cate_id` int(11) NOT NULL,
  `cate_name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`cate_id`, `cate_name`, `description`) VALUES
(1, 'Kinh Doanh', ''),
(2, 'CNTT', ''),
(3, 'Âm Nhạc', 'Âm nhạc');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
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
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_12_13_135040_create_admins_table', 1),
(6, '2024_12_16_170728_create_cate_table', 2),
(7, '2024_12_16_171647_create_users_table', 3),
(8, '2024_12_16_173628_create_products_table', 4),
(9, '2024_12_21_033106_create_cart_items_table', 5),
(12, '2024_12_21_033106_create_carts_table', 1),
(13, '2024_12_23_153229_create_categories_table', 1),
(14, '2024_12_27_164439_create_order_details_table', 6),
(15, '2024_12_27_163848_create_orders_table', 1),
(16, '2024_12_27_165324_create_orders_table', 1),
(17, '2024_12_27_170702_create_order_details_table', 7),
(18, '2024_12_15_153229_create_categories_table', 8),
(19, '2024_12_16_090000_create_products_table', 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'completed',
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `Pro_id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
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
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `Pro_id` bigint(20) UNSIGNED NOT NULL,
  `Pro_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `discount_price` decimal(10,0) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `cate_id` int(11) NOT NULL,
  `bestseller` tinyint(1) NOT NULL,
  `popular` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`Pro_id`, `Pro_name`, `slug`, `description`, `price`, `discount_price`, `stock`, `cate_id`, `bestseller`, `popular`, `created_at`, `updated_at`) VALUES
(2, 'Khóa học Laravel', 'khoa-hoc-laravel', 'Khóa học Laravel từ cơ bản đến nâng cao', 500000, 400000, 10, 0, 0, 1, '2024-12-17 14:27:00', NULL),
(3, 'Khóa học Lập trình PHP', 'khoa-hoc-lap-trinh-php', 'Học lập trình PHP từ cơ bản đến nâng cao', 2000000, 1800000, 100, 0, 0, 1, '2024-12-18 06:32:44', '2024-12-18 06:32:44'),
(4, 'Khóa học Python', 'khoa-hoc-python', 'Khóa học lập trình Python từ cơ bản đến nâng cao', 1800000, 1500000, 50, 0, 0, 0, '2024-12-18 06:32:44', '2024-12-18 06:32:44'),
(5, 'Khóa học AI', 'khoa-hoc-ai', 'Khóa học về trí tuệ nhân tạo và Machine Learning nâng cao', 3000000, 2700000, 30, 0, 0, 1, '2024-12-18 06:32:44', '2024-12-18 06:32:44'),
(6, 'Khóa học Lập trình PHP nâng cao nâng cao', 'khoa-hoc-lap-trinh-php nang cao', 'Học lập trình PHP từ cơ bản đến nâng cao', 1200000, 900000, 100, 0, 0, 1, '2024-12-18 06:32:44', '2024-12-18 06:32:44'),
(7, 'Khóa học Python nâng cao', 'khoa-hoc-python nâng cao', 'Khóa học lập trình Python từ cơ bản đến nâng cao', 2800000, 1700000, 50, 0, 0, 1, '2024-12-18 06:32:44', '2024-12-18 06:32:44'),
(8, 'Khóa học AI nâng cao', 'khoa-hoc-ai nâng cao', 'Khóa học về trí tuệ nhân tạo và Machine Learning', 2100000, 2000000, 30, 0, 0, 1, '2024-12-18 06:32:44', '2024-12-18 06:32:44'),
(9, 'English for Beginners', 'english-for-beginners', 'A comprehensive course for English language beginners.', 500000, 450000, 100, 0, 0, 1, '2024-12-18 12:24:41', '2024-12-18 12:24:41'),
(10, 'Advanced English Grammar', 'advanced-english-grammar', 'Master advanced grammar concepts and elevate your English proficiency.', 700000, 650000, 50, 0, 0, 1, '2024-12-18 12:24:41', '2024-12-18 12:24:41'),
(11, 'Business English Communication', 'business-english-communication', 'Learn essential English skills for effective business communication.', 800000, 750000, 70, 0, 0, 1, '2024-12-18 12:24:41', '2024-12-18 12:24:41'),
(12, 'IELTS Preparation Course', 'ielts-preparation-course', 'Prepare for the IELTS exam with expert guidance and tips.', 1000000, 900000, 30, 0, 0, 1, '2024-12-18 12:24:41', '2024-12-18 12:24:41'),
(13, 'Khóa học Kinh doanh cơ bản@', 'khoa-hoc-kinh-doanh-co-ban', 'Khóa học này sẽ giúp bạn hiểu về các khái niệm cơ bản trong kinh doanh.', 500000, 450000, 100, 1, 0, 0, NULL, '2024-12-27 05:52:44'),
(14, 'Khóa học Marketing trực tuyến', 'khoa-hoc-marketing-truc-tuyen', 'Khóa học này giúp bạn nắm vững các kỹ năng marketing trực tuyến.', 700000, 650000, 50, 1, 0, 0, NULL, NULL),
(15, 'Khóa học Lập kế hoạch kinh doanh', 'khoa-hoc-lap-ke-hoach-kinh-doanh', 'Khóa học này giúp bạn xây dựng một kế hoạch kinh doanh hiệu quả.', 600000, 550000, 70, 1, 0, 0, NULL, NULL),
(16, 'Khóa học Quản lý tài chính doanh nghiệp', 'khoa-hoc-quan-ly-tai-chinh-doanh-nghiep', 'Khóa học giúp bạn quản lý tài chính doanh nghiệp hiệu quả.', 800000, 750000, 120, 1, 0, 0, NULL, NULL),
(17, 'Khóa học Xây dựng thương hiệu cá nhân', 'khoa-hoc-xay-dung-thuong-hieu-ca-nhan', 'Khóa học giúp bạn xây dựng thương hiệu cá nhân mạnh mẽ.', 550000, 500000, 80, 1, 0, 0, NULL, NULL),
(18, 'Khóa học Kỹ năng lãnh đạo trong kinh doanh', 'khoa-hoc-ky-nang-lanh-dao-trong-kinh-doanh', 'Khóa học này giúp bạn phát triển kỹ năng lãnh đạo trong môi trường kinh doanh.', 650000, 600000, 90, 1, 0, 0, NULL, NULL),
(19, 'Khóa học Quản trị chiến lược kinh doanh', 'khoa-hoc-quan-tri-chien-luoc-kinh-doanh', 'Khóa học này giúp bạn học cách quản trị chiến lược trong kinh doanh.', 750000, 700000, 60, 1, 0, 0, NULL, NULL),
(20, 'Khóa học Phân tích thị trường và đối thủ', 'khoa-hoc-phan-tich-thi-truong-va-doi-thu', 'Khóa học giúp bạn phân tích thị trường và đối thủ cạnh tranh trong kinh doanh.', 450000, 400000, 110, 1, 0, 0, NULL, NULL),
(21, 'Khóa học Quản lý dự án kinh doanh', 'khoa-hoc-quan-ly-du-an-kinh-doanh', 'Khóa học giúp bạn hiểu về quản lý dự án trong lĩnh vực kinh doanh.', 600000, 550000, 75, 1, 0, 0, NULL, NULL),
(22, 'Khóa học Tăng trưởng doanh thu và lợi nhuận@123', 'khoa-hoc-tang-truong-doanh-thu-va-loi-nhuan', 'Khóa học giúp bạn học các chiến lược tăng trưởng doanh thu và lợi nhuận cho doanh nghiệp.', 850000, 800000, 50, 2, 0, 0, NULL, '2024-12-27 05:50:44'),
(23, 'Lập trình Web với PHP và Laravel', 'lap-trinh-web-voi-php-va-laravel', 'abc', 222222, NULL, 22, 2, 0, 0, '2024-12-27 07:56:43', '2024-12-27 07:56:43'),
(24, 'Lập trình Web với PHP và Laravel', 'lap-trinh-web-voi-php-va-laravel', 'abc', 222222, NULL, 22, 2, 0, 0, '2024-12-27 07:57:11', '2024-12-27 07:57:11'),
(25, 'Khóa học MySQL cơ bản', 'khoa-hoc-mysql-co-ban', 'Học các khái niệm cơ bản về cơ sở dữ liệu MySQL.', 500000, 450000, 100, 0, 1, 0, '2024-12-27 16:28:32', '2024-12-27 16:28:32'),
(26, 'Khóa học MySQL nâng cao', 'khoa-hoc-mysql-nang-cao', 'Nâng cao kỹ năng quản lý và tối ưu hóa cơ sở dữ liệu MySQL.', 700000, 650000, 80, 0, 1, 0, '2024-12-27 16:28:32', '2024-12-27 16:28:32'),
(27, 'MySQL cho lập trình viên', 'mysql-cho-lap-trinh-vien', 'Khóa học chuyên sâu về sử dụng MySQL trong lập trình.', 800000, 750000, 50, 0, 1, 0, '2024-12-27 16:28:32', '2024-12-27 16:28:32'),
(28, 'Tối ưu hóa truy vấn MySQL', 'toi-uu-hoa-truy-van-mysql', 'Học cách viết truy vấn hiệu quả và tối ưu hóa MySQL.', 600000, 550000, 60, 0, 1, 0, '2024-12-27 16:28:32', '2024-12-27 16:28:32'),
(29, 'Quản trị cơ sở dữ liệu MySQL', 'quan-tri-co-so-du-lieu-mysql', 'Học cách quản lý và vận hành cơ sở dữ liệu MySQL.', 900000, 850000, 40, 0, 1, 0, '2024-12-27 16:28:32', '2024-12-27 16:28:32'),
(30, 'MySQL cho doanh nghiệp', 'mysql-cho-doanh-nghiep', 'Khóa học chuyên sâu về MySQL áp dụng cho doanh nghiệp.', 1000000, 950000, 30, 0, 1, 0, '2024-12-27 16:28:32', '2024-12-27 16:28:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `email`, `password`, `phone`, `role`, `created_at`, `updated_at`) VALUES
(4, 'truongahihi', 'admin@mail.com', '$2y$10$MtfEh8r.4FO7lTCEuq3HH.Cw28UwWTDHT7ucbbK/ZDtUZ9Uq.Skc.', '133131', 'admin', '2024-12-19 06:31:40', '2024-12-19 06:31:40'),
(5, 'truongahihi', 'user@mail.com', '$2y$10$6F6KFTCH5S0EzD3WR/yiAe8kjTxtk6O0LiKrOs8A7DYD0DwHwVpty', '133131', 'student', '2024-12-19 06:33:02', '2024-12-19 06:33:02'),
(6, 'Nguyễn Xuân Trường', 'user3@mail.com', '$2y$10$Yp5KK872MGEcJTMFy0KEWu7/nuKwrSYmJJ56RdvKtZg5aB7OoRXRG', '090902123', 'student', '2024-12-20 23:40:41', '2024-12-20 23:40:41'),
(16, 'trường nè', 'user1@mail.com', '$2y$10$Lt.Lc39PCPOQpHIQdLCMye.2DCWCJzGMYO/atJflnRAti/h9YvPq6', '133131', 'student', '2024-12-22 09:18:35', '2024-12-22 09:18:35');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_Pro_id_foreign` (`Pro_id`) USING BTREE;

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_pro_id_foreign` (`Pro_id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Pro_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `Pro_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_pro_id_foreign` FOREIGN KEY (`Pro_id`) REFERENCES `products` (`Pro_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_pro_id_foreign` FOREIGN KEY (`Pro_id`) REFERENCES `products` (`Pro_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
