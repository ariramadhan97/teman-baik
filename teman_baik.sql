-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.0.30 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk teman_baik
CREATE DATABASE IF NOT EXISTS `teman_baik` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `teman_baik`;

-- membuang struktur untuk table teman_baik.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel teman_baik.failed_jobs: ~0 rows (lebih kurang)

-- membuang struktur untuk table teman_baik.instansis
CREATE TABLE IF NOT EXISTS `instansis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_instansi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_wa1` char(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_wa2` char(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_wa3` char(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel teman_baik.instansis: ~3 rows (lebih kurang)
INSERT INTO `instansis` (`id`, `nama_instansi`, `email1`, `email2`, `email3`, `no_wa1`, `no_wa2`, `no_wa3`, `created_at`, `updated_at`) VALUES
	(1, 'DPMPTSP', 'aarii1515@gmail.com', NULL, NULL, '087815651985', NULL, NULL, '2024-10-21 17:04:42', '2024-10-23 16:21:58'),
	(3, 'pengadilan 2', 'aarii1515@gmail.com', NULL, NULL, NULL, NULL, NULL, '2024-10-24 02:19:39', '2024-10-24 02:19:39');

-- membuang struktur untuk table teman_baik.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel teman_baik.migrations: ~0 rows (lebih kurang)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2024_09_17_063443_create_instansis_table', 1),
	(6, '2024_10_01_025409_create_pengaduans_table', 1),
	(7, '2024_10_01_040219_create_statuses_table', 1);

-- membuang struktur untuk table teman_baik.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel teman_baik.password_reset_tokens: ~0 rows (lebih kurang)

-- membuang struktur untuk table teman_baik.pengaduans
CREATE TABLE IF NOT EXISTS `pengaduans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `is_aduan` tinyint(1) NOT NULL,
  `tgl_aduan` date NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_instansi` bigint unsigned NOT NULL,
  `id_status` bigint unsigned NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` char(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aduan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `penginput` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jawaban` text COLLATE utf8mb4_unicode_ci,
  `samarkan` tinyint(1) NOT NULL,
  `nama_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_file_eviden` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel teman_baik.pengaduans: ~5 rows (lebih kurang)
INSERT INTO `pengaduans` (`id`, `is_aduan`, `tgl_aduan`, `nama`, `id_instansi`, `id_status`, `alamat`, `telepon`, `aduan`, `penginput`, `jawaban`, `samarkan`, `nama_file`, `nama_file_eviden`, `created_at`, `updated_at`) VALUES
	(1, 1, '2024-10-01', 'Ari', 1, 2, 'Jl. Belitung Darat', '087815651985', 'Ini isi aduan', 'admin', NULL, 0, 'form_20241022011140.jpg', '', '2024-10-21 17:11:40', '2024-10-28 01:56:20'),
	(2, 0, '2024-10-27', 'nama', 1, 1, 'Jl. Sultan Adam No.49, Surgi Mufti, Kec. Banjarmasin Utara', '0878565656', 'tes', 'mandiri', NULL, 1, 'ttd_20241027112705.png', '', '2024-10-27 03:27:05', '2024-10-27 03:27:05'),
	(3, 0, '2024-10-27', 'nama', 1, 1, 'Jl. Sultan Adam No.49, Surgi Mufti, Kec. Banjarmasin Utara', '0878565656', 'tes', 'mandiri', NULL, 1, 'ttd_20241027112854.png', '', '2024-10-27 03:28:54', '2024-10-27 03:28:54'),
	(4, 1, '2024-10-28', 'TES A', 1, 1, 'Jl. Sultan Adam No.49, Surgi Mufti, Kec. Banjarmasin Utara', '087815651985', 'ini contoh pengaduan ke teman baik', 'mandiri', NULL, 1, 'ttd_20241028093210.png', '', '2024-10-28 01:32:11', '2024-10-28 01:32:11'),
	(5, 1, '2024-10-28', 'TES A', 1, 1, 'Jl. Sultan Adam No.49, Surgi Mufti, Kec. Banjarmasin Utara', '087815651985', 'ini contoh pengaduan ke teman baik', 'mandiri', NULL, 1, 'ttd_20241028093436.png', '', '2024-10-28 01:34:36', '2024-10-28 01:34:36');

-- membuang struktur untuk table teman_baik.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel teman_baik.personal_access_tokens: ~0 rows (lebih kurang)

-- membuang struktur untuk table teman_baik.statuses
CREATE TABLE IF NOT EXISTS `statuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel teman_baik.statuses: ~4 rows (lebih kurang)
INSERT INTO `statuses` (`id`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'diterima', NULL, NULL),
	(2, 'dikirim', NULL, NULL),
	(3, 'dijawab', NULL, NULL),
	(4, 'ditolak', NULL, NULL);

-- membuang struktur untuk table teman_baik.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel teman_baik.users: ~1 rows (lebih kurang)
INSERT INTO `users` (`id`, `nama`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'admin.dpmptsp', '$2y$12$7yDc1D7DKBTykfJ9EfalEOHi0pVFUIYkiZE1zfZ4ltoDcKal6JDeu', NULL, '2024-10-21 03:31:02', '2024-10-21 03:31:02');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
