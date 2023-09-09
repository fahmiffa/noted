-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.10.2-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table doc.contents
CREATE TABLE IF NOT EXISTS `contents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doc.contents: ~2 rows (approximately)
/*!40000 ALTER TABLE `contents` DISABLE KEYS */;
INSERT INTO `contents` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(3, 'Kelengkapan Dokumen', '2023-06-30 15:33:48', '2023-06-30 15:33:48');
/*!40000 ALTER TABLE `contents` ENABLE KEYS */;

-- Dumping structure for table doc.districts
CREATE TABLE IF NOT EXISTS `districts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doc.districts: ~2 rows (approximately)
/*!40000 ALTER TABLE `districts` DISABLE KEYS */;
INSERT INTO `districts` (`id`, `nama`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'Tegal Selatan', NULL, '2023-07-01 13:43:59', '2023-07-01 13:43:59'),
	(2, 'Tegal Timur', NULL, '2023-07-01 13:44:13', '2023-07-01 13:44:13'),
	(3, 'Tegal Barat', NULL, '2023-07-01 13:44:24', '2023-07-01 13:44:24');
/*!40000 ALTER TABLE `districts` ENABLE KEYS */;

-- Dumping structure for table doc.docs
CREATE TABLE IF NOT EXISTS `docs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `nama` varchar(191) NOT NULL,
  `alamat` text NOT NULL,
  `noreg` varchar(191) NOT NULL,
  `nodoc` varchar(191) NOT NULL,
  `data2` varchar(191) NOT NULL,
  `catatan` varchar(191) NOT NULL,
  `status` varchar(191) NOT NULL,
  `dokumen` varchar(191) DEFAULT NULL,
  `users_id` bigint(20) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doc.docs: ~0 rows (approximately)
/*!40000 ALTER TABLE `docs` DISABLE KEYS */;
INSERT INTO `docs` (`id`, `tanggal`, `nama`, `alamat`, `noreg`, `nodoc`, `data2`, `catatan`, `status`, `dokumen`, `users_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, '2023-07-12', 'op', 'Indonesia', '234A', '210KC', 'ok', 'run', 'on going', 'pile_1689149010.pdf', 1, NULL, '2023-07-12 15:03:30', '2023-07-12 15:03:30');
/*!40000 ALTER TABLE `docs` ENABLE KEYS */;

-- Dumping structure for table doc.forms
CREATE TABLE IF NOT EXISTS `forms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) DEFAULT NULL,
  `title` varchar(191) NOT NULL,
  `users_id` bigint(20) NOT NULL,
  `headers_id` bigint(20) NOT NULL,
  `contents_id` bigint(20) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doc.forms: ~2 rows (approximately)
/*!40000 ALTER TABLE `forms` DISABLE KEYS */;
INSERT INTO `forms` (`id`, `name`, `title`, `users_id`, `headers_id`, `contents_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'Formulir 1', 'PEMBERITAHUAN HASIL VERIFIKASI KELENGKAPAN DOKUMEN', 1, 2, 3, NULL, '2023-06-30 16:25:01', '2023-07-03 02:27:16');
/*!40000 ALTER TABLE `forms` ENABLE KEYS */;

-- Dumping structure for table doc.formulirs
CREATE TABLE IF NOT EXISTS `formulirs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nomor` varchar(191) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `noreg` varchar(191) DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `tipe` varchar(191) DEFAULT NULL,
  `users_id` bigint(20) DEFAULT NULL,
  `forms_id` bigint(20) DEFAULT NULL,
  `villages_id` bigint(20) DEFAULT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`items`)),
  `other` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`other`)),
  `dokumen` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doc.formulirs: ~0 rows (approximately)
/*!40000 ALTER TABLE `formulirs` DISABLE KEYS */;
INSERT INTO `formulirs` (`id`, `nomor`, `name`, `tanggal`, `noreg`, `status`, `tipe`, `users_id`, `forms_id`, `villages_id`, `items`, `other`, `dokumen`, `created_at`, `updated_at`) VALUES
	(3, '0001/SPm-SIMBG/VII/2023', 'le minerale', '2023-07-15', '250KA', 'on going', 'field', 1, 1, 1, '{"no":"0001\\/SPm-SIMBG\\/VII\\/2023","header":["250KA","pbg","tes","085","Kab. Tegal","Jembatan","run","Kerandon, Kaligangsa"],"items":{"1":"1","2":"1","7":"0","8":"0","9":"0","10":"0","11":"0","4":"0","12":"0","13":"0","5":"0","6":"0","14":"0","15":"0","16":"0","17":"0"},"sub":{"1":"0","4":"0","5":"0","6":"0","7":"0","8":"0","9":"0","10":"0","11":"0","12":"0","13":"0","14":"0","15":"0","16":"0","17":"0","18":"0","19":"0","20":"0","21":"0","22":"0","23":"0","24":"0","25":"0","26":"0","27":"0","28":"0","29":"0","30":"0","31":"0","32":"0","33":"2"},"saranItem":{"1":"Lorem ipsum, atau ringkasnya lipsum, adalah teks standar yang ditempatkan untuk mendemostrasikan elemen grafis atau presentasi visual seperti font, tipografi, dan tata letak","2":null,"7":null,"8":null,"9":null,"10":null,"11":null,"4":null,"12":null,"13":null,"5":null,"6":null,"14":null,"15":null,"16":null,"17":null},"saranSub":{"1":null,"4":null,"5":null,"6":null,"7":null,"8":null,"9":null,"10":null,"11":null,"12":null,"13":null,"14":null,"15":null,"16":null,"17":null,"18":null,"19":null,"20":null,"21":null,"22":null,"23":null,"24":null,"25":null,"26":null,"27":null,"28":null,"29":null,"30":null,"31":null,"32":null,"33":null},"saran":"<p><span style=\\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\\"><b>Lorem ipsum,<\\/b> atau ringkasnya lipsum, adalah teks standar yang ditempatkan untuk mendemostrasikan elemen grafis atau presentasi visual seperti font, tipografi, dan tata letak<\\/span><\\/p>","nameOther":["other",null,null,null,null],"other":["1","0","0","0","0"],"saranOther":["Lorem ipsum, atau ringkasnya lipsum, adalah teks standar yang ditempatkan untuk mendemostrasikan elemen grafis atau presentasi visual seperti font, tipografi, dan tata letak",null,null,null,null]}', NULL, NULL, '2023-07-15 00:23:14', '2023-07-15 00:23:14');
/*!40000 ALTER TABLE `formulirs` ENABLE KEYS */;

-- Dumping structure for table doc.headers
CREATE TABLE IF NOT EXISTS `headers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `item` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`item`)),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doc.headers: ~1 rows (approximately)
/*!40000 ALTER TABLE `headers` DISABLE KEYS */;
INSERT INTO `headers` (`id`, `name`, `item`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(2, 'header 1', '["No. Registrasi","Pengajuan","Nama Pemohon","No. Telp. \\/ HP","Alamat Pemohon",null,"Nama Bangunan","Fungsi","Alamat Bangunan"]', NULL, '2023-06-30 15:09:08', '2023-07-01 08:11:24');
/*!40000 ALTER TABLE `headers` ENABLE KEYS */;

-- Dumping structure for table doc.items
CREATE TABLE IF NOT EXISTS `items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `titles_id` bigint(20) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doc.items: ~15 rows (approximately)
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` (`id`, `name`, `titles_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'KTP / KITAS Pemohon dan Surat Kuasa (jika diwakilkan)', 1, NULL, '2023-06-30 15:57:29', '2023-06-30 15:57:29'),
	(2, 'Nomor Induk Berusaha (NIB)', 1, NULL, '2023-06-30 15:58:59', '2023-06-30 16:00:24'),
	(4, 'Dokumen Arsitektur', 4, NULL, '2023-06-30 16:01:03', '2023-06-30 16:01:03'),
	(5, 'Izin Mendirikan Bangunan Bangunan Eksisting (jika ada)', 5, NULL, '2023-07-01 08:10:46', '2023-07-01 08:10:46'),
	(6, 'Laporan Kelaikan Fungsi Bangunan Gedung / Daftar Simak', 5, NULL, '2023-07-01 08:13:06', '2023-07-01 08:13:06'),
	(7, 'Bukti Kepemilikan Tanah dan Ijin Pemanfaatan Tanah jika pemohon bukan pemilik tanah', 1, NULL, '2023-07-03 02:28:27', '2023-07-03 02:28:27'),
	(8, 'Bukti Lunas Pajak Bumi dan Bangunan', 1, NULL, '2023-07-03 02:28:39', '2023-07-03 02:28:39'),
	(9, 'Informasi Tata Ruang/ITR/IKPR dan/atau PKKPR', 1, NULL, '2023-07-03 02:28:49', '2023-07-03 02:28:49'),
	(10, 'Surat Keterangan Tanah tidak dalam sengketa yang diketahui oleh kepala desa / lurah', 1, NULL, '2023-07-03 02:29:05', '2023-07-03 02:29:05'),
	(11, 'Dokumen Lingkungan (SPPL/UKL-UPL/AMDAL dan ANDALALIN jika diperlukan)', 1, NULL, '2023-07-03 02:29:23', '2023-07-03 02:29:23'),
	(12, 'Dokumen Struktur', 4, NULL, '2023-07-03 02:32:15', '2023-07-03 02:32:15'),
	(13, 'Dokumen Utilitas', 4, NULL, '2023-07-03 02:32:27', '2023-07-03 02:32:27'),
	(14, 'Surat Pernyataan Laik Fungsi dari Pengkaji Teknis', 5, NULL, '2023-07-03 02:35:54', '2023-07-03 02:35:54'),
	(15, 'As-Build Drawing', 5, NULL, '2023-07-03 02:36:12', '2023-07-03 02:36:12'),
	(16, 'Data Pengkaji Teknis Bersertifikat (Perorangan/Badan Usaha)', 5, NULL, '2023-07-03 02:36:26', '2023-07-03 02:36:26'),
	(17, 'Dokumen pengujian atau perizinan lainnya yang diperlukan', 5, NULL, '2023-07-03 02:36:48', '2023-07-03 02:36:48');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;

-- Dumping structure for table doc.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doc.migrations: ~11 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(7, '2014_10_12_000000_create_users_table', 1),
	(8, '2023_06_01_124944_create_docs_table', 1),
	(9, '2023_06_22_083326_create_districts_table', 1),
	(10, '2023_06_22_083354_create_villages_table', 1),
	(16, '2023_06_30_132455_create_items_table', 2),
	(17, '2023_06_30_132759_create_titles_table', 2),
	(18, '2023_06_30_133037_create_subs_table', 2),
	(19, '2023_06_30_133648_create_headers_table', 2),
	(20, '2023_06_30_143548_create_contents_table', 2),
	(22, '2023_06_26_000635_create_forms_table', 3),
	(31, '2023_07_03_005607_create_formulirs_table', 4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table doc.subs
CREATE TABLE IF NOT EXISTS `subs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `items_id` bigint(20) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doc.subs: ~31 rows (approximately)
/*!40000 ALTER TABLE `subs` DISABLE KEYS */;
INSERT INTO `subs` (`id`, `name`, `items_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'Gambar situasi / Denah lokasi', 4, NULL, '2023-06-30 16:07:29', '2023-07-01 00:31:23'),
	(4, 'Denah bangunan (termasuk basement jika ada)', 4, NULL, '2023-07-03 02:29:44', '2023-07-03 02:29:44'),
	(5, 'Tampak depan dan samping (kanan-kiri) Bangunan', 4, NULL, '2023-07-03 02:29:58', '2023-07-03 02:29:58'),
	(6, 'Potongan melintang dan membujur', 4, NULL, '2023-07-03 02:30:14', '2023-07-03 02:30:14'),
	(7, 'Siteplan / masterplan', 4, NULL, '2023-07-03 02:30:37', '2023-07-03 02:30:37'),
	(8, 'Denah / lokasi resapan, fasum, fasos, dan RTH', 4, NULL, '2023-07-03 02:30:54', '2023-07-03 02:30:54'),
	(9, 'Denah dan detail jalan dan drainase', 4, NULL, '2023-07-03 02:31:09', '2023-07-03 02:31:09'),
	(10, 'Denah dan detail pondasi', 12, NULL, '2023-07-03 02:33:11', '2023-07-03 02:33:11'),
	(11, 'Denah dan detail penulangan (sloof, kolom, balok, dll)', 12, NULL, '2023-07-03 02:33:25', '2023-07-03 02:33:25'),
	(12, 'Denah dan detail atap / kuda-kuda', 12, NULL, '2023-07-03 02:33:41', '2023-07-03 02:33:41'),
	(13, 'Denah dan detail tangga (untuk bangunan 2 lantai/lebih)', 12, NULL, '2023-07-03 02:33:56', '2023-07-03 02:33:56'),
	(14, 'Data penyelidikan tanah *', 12, NULL, '2023-07-03 02:34:10', '2023-07-03 02:34:10'),
	(15, 'Perhitungan struktur', 12, NULL, '2023-07-03 02:34:25', '2023-07-03 02:34:25'),
	(16, 'Denah instalasi listrik (saklar, lampu, stopkontak, dll)', 13, NULL, '2023-07-03 02:34:41', '2023-07-03 02:34:41'),
	(17, 'Denah instalasi air bersih dan kotor', 13, NULL, '2023-07-03 02:34:54', '2023-07-03 02:34:54'),
	(18, 'Denah instalasi proteksi petir (jika ada)', 13, NULL, '2023-07-03 02:35:10', '2023-07-03 02:35:10'),
	(19, 'SLO & NIDI Listrik', 17, NULL, '2023-07-03 02:37:23', '2023-07-03 02:37:23'),
	(20, 'Persetujuan Teknis BMAL/IPAL', 17, NULL, '2023-07-03 02:37:36', '2023-07-03 02:37:36'),
	(21, 'Persetujuan Studi Kelayakan Air Tanah', 17, NULL, '2023-07-03 02:37:54', '2023-07-03 02:37:54'),
	(22, 'Pemeriksaan/Pengujian Penyalur Petir', 17, NULL, '2023-07-03 02:38:07', '2023-07-03 02:38:07'),
	(23, 'Pemeriksaan/Pengujian Genset', 17, NULL, '2023-07-03 02:38:21', '2023-07-03 02:38:21'),
	(24, 'Pemeriksaan/Pengujian Instalasi Listrik', 17, NULL, '2023-07-03 02:38:36', '2023-07-03 02:38:36'),
	(25, 'Pemeriksaan/Pengujian Proteksi Kebakaran, APAR', 17, NULL, '2023-07-03 02:38:52', '2023-07-03 02:38:52'),
	(26, 'Pemeriksaan/Pengujian Proteksi Kebakaran, Fire Alarm', 17, NULL, '2023-07-03 02:39:26', '2023-07-03 02:39:26'),
	(27, 'Pemeriksaan/Pengujian Proteksi Kebakaran, Hydrant', 17, NULL, '2023-07-03 02:39:54', '2023-07-03 02:39:54'),
	(28, 'Pemeriksaan/Pengujian Proteksi Kebakaran, Sprlinker', 17, NULL, '2023-07-03 02:40:11', '2023-07-03 02:40:11'),
	(29, 'Pemeriksaan/Pengujian Lift', 17, NULL, '2023-07-03 02:40:24', '2023-07-03 02:40:24'),
	(30, 'Pemeriksaan/Pengujian Air Bersih, Pencahayaan, Kebisingan, dan Kualitas Udara', 17, NULL, '2023-07-03 02:40:38', '2023-07-03 02:40:38'),
	(31, 'Pemeriksaan/Pengujian Beton', 17, NULL, '2023-07-03 02:40:51', '2023-07-03 02:40:51'),
	(32, 'Pemeriksaan/Pengujian Radiasi', 17, NULL, '2023-07-03 02:41:06', '2023-07-03 02:41:06'),
	(33, 'Pengelolaan Limbah (B3/Domestik/dll)', 17, NULL, '2023-07-03 02:41:19', '2023-07-03 02:41:19');
/*!40000 ALTER TABLE `subs` ENABLE KEYS */;

-- Dumping structure for table doc.titles
CREATE TABLE IF NOT EXISTS `titles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `contents_id` bigint(20) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doc.titles: ~3 rows (approximately)
/*!40000 ALTER TABLE `titles` DISABLE KEYS */;
INSERT INTO `titles` (`id`, `name`, `contents_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'Dokumen Administrasi', 3, NULL, '2023-06-30 15:42:29', '2023-06-30 15:42:29'),
	(4, 'Dokumen Teknis', 3, NULL, '2023-06-30 16:00:43', '2023-06-30 16:00:43'),
	(5, 'Dokumen Pendukung Lainnya (Untuk SLF)', 3, NULL, '2023-07-01 08:10:20', '2023-07-01 08:10:20');
/*!40000 ALTER TABLE `titles` ENABLE KEYS */;

-- Dumping structure for table doc.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `role` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doc.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `role`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'root', 'admin@admin.com', 'admin', '$2y$10$zWl62ePZSwoiSccMwIiN4uhJAM206cJfMmyw83R4srnORzMjCPIp6', NULL, '2023-06-28 02:04:26', '2023-06-28 02:04:26', NULL),
	(2, 'user', 'user@user.com', 'operator', '$2y$10$HAblUkQm.9PxSROdGg9PAeBAgXxhrBdk7Cw6W9Vc5gXCSHD1.mLEW', NULL, '2023-06-28 02:04:27', '2023-06-28 02:04:27', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table doc.villages
CREATE TABLE IF NOT EXISTS `villages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) NOT NULL,
  `districts_id` bigint(20) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table doc.villages: ~3 rows (approximately)
/*!40000 ALTER TABLE `villages` DISABLE KEYS */;
INSERT INTO `villages` (`id`, `nama`, `districts_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'Kaligangsa', 3, NULL, '2023-07-01 13:44:39', '2023-07-01 13:44:39'),
	(2, 'Martoloyo', 2, NULL, '2023-07-13 22:47:36', '2023-07-13 22:47:36'),
	(3, 'Debong', 1, NULL, '2023-07-13 22:47:50', '2023-07-13 22:47:59');
/*!40000 ALTER TABLE `villages` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
