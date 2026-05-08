-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Jun 2026 pada 07.39
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `content`, `created_by`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Selamat Datang di PerManah', 'Perpustakaan  hadir untuk memberikan akses mudah ke ribuan koleksi buku. Daftar sekarang dan nikmati kemudahan meminjam buku secara digital!', 2, 1, '2026-01-20 11:24:11', '2026-01-21 19:23:12'),
(2, 'Jam Operasional Perpustakaan', 'Perpustakaan buka Senin - Jumat pukul 08.00 - 16.00 WIB. Sabtu-Minggu dan hari libur nasional tutup.', 2, 1, '2026-01-20 11:24:11', '2026-01-20 11:24:11'),
(3, 'Koleksi Buku Baru Telah Tiba!', 'Kami telah menambahkan 10 judul buku baru dalam berbagai kategori. Segera cek katalog buku kami!', 3, 1, '2026-01-20 11:24:11', '2026-01-20 11:24:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `available` int(11) NOT NULL DEFAULT 0,
  `price` int(11) NOT NULL DEFAULT 0,
  `category` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `cover_image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `isbn`, `publisher`, `year`, `stock`, `available`, `price`, `category`, `description`, `cover_image`, `created_at`, `updated_at`) VALUES
(11, 'Laskar Pelangi', 'Andrea Hirata', '9789793062794', 'Bentang Pustaka', '2005', 10, 10, 0, 'Fiksi', 'Novel tentang perjuangan pendidikan', 'covers/1769048514_laskar-pelangi-sampul.jpg', '2026-01-21 19:04:19', '2026-01-21 19:21:54'),
(12, 'Bumi Manusia', 'Pramoedya Ananta Toer', '9789799731236', 'Hasta Mitra', '1980', 8, 7, 0, 'Fiksi', 'Novel sejarah Indonesia', 'covers/1769047591_batch-bumi-manusia.jpg', '2026-01-21 19:04:20', '2026-06-04 23:49:27'),
(13, 'Atomic Habits', 'James Clear', '9780735211292', 'Penguin', '2018', 12, 12, 0, 'Non-Fiksi', 'Pengembangan diri', 'covers/1769047674_atomatic-habits.jpg', '2026-01-21 19:04:20', '2026-03-21 19:38:12'),
(14, 'Sapiens', 'Yuval Noah Harari', '9780062316097', 'Harper', '2011', 7, 7, 0, 'Non-Fiksi', 'Sejarah umat manusia', 'covers/1769047739_sapies.jpeg', '2026-01-21 19:04:20', '2026-01-21 19:08:59'),
(15, 'Matematika SMA', 'Sukino', '9786024270987', 'Erlangga', '2020', 20, 20, 0, 'Pendidikan', 'Buku pelajaran matematika', 'covers/1769047807_mtk.jpg', '2026-01-21 19:04:20', '2026-01-21 19:10:07'),
(16, 'Fisika Dasar', 'Halliday', '9780470469088', 'Wiley', '2014', 5, 5, 0, 'Pendidikan', 'Konsep fisika dasar', 'covers/1769047873_fisika.jpg', '2026-01-21 19:04:20', '2026-01-21 19:11:13'),
(17, 'Biologi Umum', 'Campbell', '9780134093413', 'Pearson', '2015', 6, 6, 0, 'Sains', 'Ilmu biologi', 'covers/1769047932_bologi.jpg', '2026-01-21 19:04:20', '2026-01-21 19:12:12'),
(18, 'Teknologi Informasi', 'Abdul Kadir', '9789797569875', 'Andi', '2019', 9, 9, 0, 'Teknologi', 'Dasar TI', 'covers/1769047996_tekin.jpg', '2026-01-21 19:04:20', '2026-01-21 19:13:16'),
(19, 'Pemrograman Python', 'Eric Matthes', '9781593279288', 'No Starch', '2021', 11, 11, 0, 'Teknologi', 'Belajar Python', 'covers/1769048075_python.jpg', '2026-01-21 19:04:20', '2026-01-21 19:14:35'),
(20, 'Sejarah Indonesia', 'Sartono Kartodirdjo', '9789794071825', 'Gramedia', '2008', 4, 4, 0, 'Sejarah', 'Sejarah nasional', 'covers/1769048151_sejarah.jpg', '2026-01-21 19:04:20', '2026-01-21 19:15:51'),
(21, 'Revolusi Dunia', 'Peter Stearns', '9780195170612', 'Oxford', '2010', 3, 3, 0, 'Sejarah', 'Sejarah dunia', 'covers/1769048211_revo.jpg', '2026-01-21 19:04:20', '2026-01-21 19:16:51'),
(22, 'BJ Habibie', 'Ramadhan KH', '9789797091240', 'Republika', '2004', 5, 5, 0, 'Biografi', 'Kisah hidup Habibie', 'covers/1769048282_bj-habibi.jpg', '2026-01-21 19:04:20', '2026-01-21 19:18:03'),
(23, 'Steve Jobs', 'Walter Isaacson', '9781451648539', 'Simon & Schuster', '2011', 6, 6, 0, 'Biografi', 'Biografi Steve Jobs', 'covers/1769048346_steven.jpg', '2026-01-21 19:04:20', '2026-01-21 19:19:06'),
(24, 'Ilmu Pendidikan', 'Hasbullah', '9789795262062', 'Rajawali', '2016', 10, 10, 0, 'Pendidikan', 'Dasar pendidikan', 'covers/1769048406_dasar-dasar-ilmu-pendidikan-hasbullah-648x958.png', '2026-01-21 19:04:20', '2026-01-21 19:20:06'),
(25, 'Psikologi Pendidikan', 'Slavin', '9780205576364', 'Pearson', '2018', 7, 7, 0, 'Pendidikan', 'Psikologi belajar', 'covers/1769048465_pisikologi.jpg', '2026-01-21 19:04:20', '2026-01-21 19:21:05'),
(26, 'Bumi Manusia', 'Pramoedya Ananta Toer', '9789799731237', 'masta mista', '1980', 8, 8, 0, 'Fiksi', ',', 'covers/1770089738_batch-bumi-manusia.jpg', '2026-02-02 20:35:38', '2026-02-02 20:35:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `borrowings`
--

CREATE TABLE `borrowings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `borrow_date` date NOT NULL,
  `due_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `late_fee` int(11) NOT NULL DEFAULT 0,
  `overdue_status` enum('ontime','late') NOT NULL DEFAULT 'ontime',
  `late_notified_at` timestamp NULL DEFAULT NULL,
  `is_lost` tinyint(1) NOT NULL DEFAULT 0,
  `replacement_fee` int(11) DEFAULT NULL,
  `is_fee_paid` tinyint(1) NOT NULL DEFAULT 0,
  `fee_paid_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','approved','returned','rejected') NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `terms_accepted` tinyint(1) NOT NULL DEFAULT 0,
  `notified_at` timestamp NULL DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
  `processed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `borrowings`
--

INSERT INTO `borrowings` (`id`, `user_id`, `book_id`, `borrow_date`, `due_date`, `return_date`, `late_fee`, `overdue_status`, `late_notified_at`, `is_lost`, `replacement_fee`, `is_fee_paid`, `fee_paid_at`, `status`, `notes`, `terms_accepted`, `notified_at`, `rejection_reason`, `processed_by`, `created_at`, `updated_at`) VALUES
(19, 19, 12, '2026-02-02', '2026-02-09', '2026-05-02', 164000, 'ontime', NULL, 0, NULL, 0, NULL, 'returned', NULL, 1, NULL, NULL, 2, '2026-02-02 03:53:37', '2026-05-02 04:00:29'),
(20, 20, 12, '2026-02-03', '2026-02-10', '2026-02-03', 0, 'ontime', NULL, 1, 0, 0, NULL, 'returned', NULL, 1, NULL, NULL, 2, '2026-02-02 20:20:33', '2026-02-02 20:23:51'),
(21, 20, 12, '2026-02-05', '2026-02-12', '2026-06-05', 226000, 'ontime', NULL, 0, NULL, 0, NULL, 'returned', NULL, 1, NULL, NULL, 2, '2026-02-04 23:43:31', '2026-06-04 23:49:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `extension_requests`
--

CREATE TABLE `extension_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `borrowing_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `requested_days` int(11) NOT NULL,
  `reason` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `processed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `jobs`
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
-- Struktur dari tabel `job_batches`
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
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_01_01_000001_add_role_to_users_table', 1),
(5, '2024_01_01_000002_create_books_table', 1),
(6, '2024_01_01_000003_create_borrowings_table', 1),
(7, '2024_01_01_000004_create_announcements_table', 1),
(8, '2024_01_02_000001_add_terms_to_borrowings_table', 1),
(9, '2025_10_14_063347_create_extension_requests_table', 1),
(10, '2025_10_15_035344_add_profile_photo_to_users_table', 1),
(11, '2025_12_21_191900_add_nisn_to_users_table', 1),
(12, '2025_12_22_000000_add_ktm_photo_to_users_table', 1),
(13, '2025_12_22_000001_add_price_to_books_table', 1),
(14, '2025_12_22_000002_add_fees_to_borrowings_table', 1),
(15, '2025_12_22_000003_create_payments_table', 1),
(16, '2025_12_22_000004_add_fee_paid_to_borrowings', 1),
(17, '2026_01_12_000001_add_plain_password_to_users_table', 1),
(18, '2026_01_13_000002_add_overdue_status_and_late_notified_to_borrowings_table', 1),
(19, '2026_01_20_000000_add_status_to_users_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `borrowing_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `method` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `nisn` varchar(10) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','petugas','anggota') NOT NULL DEFAULT 'anggota',
  `status` enum('active','pending','inactive','banned') NOT NULL DEFAULT 'active',
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `membership_date` date DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `ktm_photo` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `plain_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `nisn`, `email`, `role`, `status`, `phone`, `address`, `membership_date`, `profile_photo`, `ktm_photo`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `plain_password`) VALUES
(1, 'Kepala Sekolah', NULL, 'kepsek@Permanah.com', 'admin', 'active', NULL, NULL, NULL, 'profile-photos/WyWHaPK0cx8dcuaulrVRR5FXSfTni8uccg6uuIoz.jpg', NULL, NULL, '$2y$12$EKxstVInee7jUumSRHEqaOxzooJRPzrABwMbouYFyhoS.hjhJWJZS', NULL, '2026-01-20 11:24:07', '2026-01-20 11:26:01', NULL),
(2, 'Petugas Staf', NULL, 'staf@permanah.com', 'petugas', 'active', '081234567890', NULL, NULL, 'profile-photos/kg9MmmKJI3EoWOHbKQIlHTaTecfWX4F7vp0pcQY8.jpg', NULL, NULL, '$2y$12$6BknanedtqcfS37OTgX8nueNrz0xAHFZxfRRjcwP5IAGYNE4w6b4i', NULL, '2026-01-20 11:24:07', '2026-01-21 19:24:24', NULL),
(3, 'Petugas 2', NULL, 'petugas2@bookhive.com', 'petugas', 'active', '081234567891', NULL, NULL, NULL, NULL, NULL, '$2y$12$qvW65pMUId7bYiN5QnMEUOC9Hq2aXRohD39aKRL9XqjYxDpXuWCZS', NULL, '2026-01-20 11:24:07', '2026-01-20 11:24:07', NULL),
(4, 'Anggota 1', NULL, 'anggota1@bookhive.com', 'anggota', 'active', '081234567801', 'Jl. Contoh No. 1, Jakarta', '2025-12-03', NULL, NULL, NULL, '$2y$12$rX8nVUSKuWsSqDpqKvZmWeKwXQwMh6patvSFvP4KuNt5Xb9.DwoKa', NULL, '2026-01-20 11:24:07', '2026-01-20 11:24:07', NULL),
(19, 'cek', '3213213231', 'ponpesnh24@gmail.com', 'anggota', 'active', '082219252632', 'kp', '2026-02-02', 'profile-photos/r3TEX942UiMzzvpW4HgBTPD2P8FxjMOuYgVOHrAl.jpg', 'ktm_photos/w1xWvLULRkR6koM6MrOcwXN2AaQ6MCzQ7a1rySa3.jpg', NULL, '$2y$12$v5zNtW9Mg9mEM2Y5iNzxJuhZXL1fDkGffkUjvKHa21mvQKj4H3Yvu', NULL, '2026-02-02 03:51:52', '2026-02-02 03:59:04', NULL),
(20, 'Abdul Gani', '7365728001', 'agani1393@gmail.com', 'anggota', 'active', '082219252632', 'Kp. Pugeran Desa Sukamaju', '2026-02-03', NULL, 'ktm_photos/m0Add1SbT5zETEYjh5x6rQgzoi24ZDEPyJeTxa9F.jpg', NULL, '$2y$12$UaOzLk9I6Pu3G8/TTX4xGuqI8qVrZsp8M./JWan7SfjOmIoH1JzPO', NULL, '2026-02-02 20:16:58', '2026-02-02 20:18:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `announcements_created_by_foreign` (`created_by`);

--
-- Indeks untuk tabel `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `books_isbn_unique` (`isbn`);

--
-- Indeks untuk tabel `borrowings`
--
ALTER TABLE `borrowings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrowings_user_id_foreign` (`user_id`),
  ADD KEY `borrowings_book_id_foreign` (`book_id`),
  ADD KEY `borrowings_processed_by_foreign` (`processed_by`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `extension_requests`
--
ALTER TABLE `extension_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `extension_requests_borrowing_id_foreign` (`borrowing_id`),
  ADD KEY `extension_requests_user_id_foreign` (`user_id`),
  ADD KEY `extension_requests_processed_by_foreign` (`processed_by`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_user_id_foreign` (`user_id`),
  ADD KEY `payments_borrowing_id_foreign` (`borrowing_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `borrowings`
--
ALTER TABLE `borrowings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `extension_requests`
--
ALTER TABLE `extension_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `borrowings`
--
ALTER TABLE `borrowings`
  ADD CONSTRAINT `borrowings_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `borrowings_processed_by_foreign` FOREIGN KEY (`processed_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `borrowings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `extension_requests`
--
ALTER TABLE `extension_requests`
  ADD CONSTRAINT `extension_requests_borrowing_id_foreign` FOREIGN KEY (`borrowing_id`) REFERENCES `borrowings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `extension_requests_processed_by_foreign` FOREIGN KEY (`processed_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `extension_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_borrowing_id_foreign` FOREIGN KEY (`borrowing_id`) REFERENCES `borrowings` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
