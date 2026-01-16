-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 16, 2026 at 01:12 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_penerimaan_blt`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `no_kk` varchar(20) DEFAULT NULL,
  `nama_lengkap` varchar(150) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `umur` int(11) DEFAULT NULL,
  `status_keluarga` varchar(50) DEFAULT NULL,
  `pekerjaan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id`, `nik`, `no_kk`, `nama_lengkap`, `jenis_kelamin`, `tgl_lahir`, `umur`, `status_keluarga`, `pekerjaan`) VALUES
(13, '5319010509660001', '5319012809160005', 'ALOYSIUS SANI', 'L', '1966-09-05', 59, 'Kepala Keluarga', 'Petani'),
(14, '5319014107750003', '5319011310140000', 'EMILIA EMBUNG', 'P', '1982-08-10', 43, 'Istri', 'Petani'),
(15, '5319014107570140', '5319014107570140', 'Biata Suhung', 'P', '1960-12-28', 65, 'Istri', 'Petani'),
(16, '5319010107580143', '5319013007088670', 'Hendirkus Paput', 'L', '1960-12-31', 65, 'Kepala Keluarga', 'Petani'),
(17, '5319010107590107', '5319013007088633', 'Kanisius Adol', 'P', '1958-07-11', 67, 'Kepala Keluarga', 'Petani'),
(18, '5319011708580000', '5319013007088679', 'Pius Papu', 'L', '1958-08-17', 67, 'Kepala Keluarga', 'Petani');

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `id` int(11) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `bg` varchar(35) DEFAULT NULL,
  `model` int(11) DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`id`, `image`, `bg`, `model`) VALUES
(1, 'auth.png', '#4e73de', 2);

-- --------------------------------------------------------

--
-- Table structure for table `hasil_akhir`
--

CREATE TABLE `hasil_akhir` (
  `id` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `skor` float DEFAULT NULL,
  `peringkat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasil_akhir`
--

INSERT INTO `hasil_akhir` (`id`, `id_periode`, `id_alternatif`, `skor`, `peringkat`) VALUES
(11, 2, 18, 0.82037, 1),
(12, 2, 16, 0.76412, 2),
(13, 2, 14, 0.751018, 3),
(14, 2, 13, 0.74, 4),
(15, 2, 17, 0.738426, 5),
(16, 2, 15, 0.730741, 6);

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subjek` varchar(255) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `tgl_buat` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`id`, `nama`, `email`, `subjek`, `pesan`, `tgl_buat`) VALUES
(2, 'tes', 'tes@gmail.com', 'tes', 'tes', '2025-12-15 15:11:01'),
(3, 'Arlan', 'arlan270899@gmail.com', 'Testing', 'ini pesan uji coba', '2025-12-15 15:11:36');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `kode_kriteria` varchar(10) NOT NULL,
  `nama_kriteria` varchar(100) NOT NULL,
  `jenis` enum('benefit','cost') DEFAULT NULL,
  `prioritas` int(11) DEFAULT NULL,
  `bobot_roc` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `kode_kriteria`, `nama_kriteria`, `jenis`, `prioritas`, `bobot_roc`) VALUES
(1, 'C1', 'Keluarga tidak mampu', 'cost', 2, 0.241667),
(2, 'C2', 'Pekerjaan', 'cost', 1, 0.408333),
(3, 'C3', 'Disabilitas', 'benefit', 3, 0.158333),
(4, 'C4', 'Anak Yatim/Yatim piatu', 'benefit', 4, 0.102778),
(5, 'C5', 'Lansia', 'benefit', 5, 0.0611111),
(6, 'C6', 'Ibu menyusui', 'benefit', 6, 0.0277778);

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `id` int(11) NOT NULL,
  `nama_periode` varchar(100) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `status` enum('Aktif','Selesai','Pending') DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id`, `nama_periode`, `tanggal_mulai`, `status`, `keterangan`) VALUES
(2, '2026', '2026-01-01', 'Aktif', '');

-- --------------------------------------------------------

--
-- Table structure for table `prosedur_seleksi`
--

CREATE TABLE `prosedur_seleksi` (
  `id` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `link_video` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prosedur_seleksi`
--

INSERT INTO `prosedur_seleksi` (`id`, `gambar`, `link_video`, `judul`, `deskripsi`) VALUES
(2, 'prosedur_seleksi_2051397802.png', 'https://www.youtube.com/watch?v=mEVFJnhM050', 'Penerimaan BLT', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum modi esse deserunt, quia placeat praesentium? Dolore dolorem incidunt quod odit cupiditate consequatur laboriosam eaque architecto assumenda, suscipit exercitationem cum, similique delectus, doloremque non eligendi rem eum nam aut esse earum magni facilis laudantium? Provident fuga qui explicabo minus deleniti soluta, voluptatum veniam ipsa aliquam adipisci quasi, facere facilis, id aliquid quae! Dolore, harum. Officia est exercitationem nisi laudantium a consequuntur veniam excepturi pariatur eum quibusdam, voluptates porro ea, expedita cupiditate animi accusamus tenetur in ratione, ex deserunt! Est quia nam modi eveniet dignissimos eos ipsum quibusdam quidem corporis culpa. Porro.');

-- --------------------------------------------------------

--
-- Table structure for table `skor_alternatif`
--

CREATE TABLE `skor_alternatif` (
  `id` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `id_sub_kriteria` int(11) NOT NULL,
  `skor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skor_alternatif`
--

INSERT INTO `skor_alternatif` (`id`, `id_periode`, `id_alternatif`, `id_sub_kriteria`, `skor`) VALUES
(62, 2, 13, 1, 5),
(63, 2, 13, 6, 5),
(64, 2, 13, 12, 4),
(65, 2, 13, 17, 4),
(66, 2, 13, 22, 4),
(67, 2, 13, 28, 3),
(68, 2, 15, 1, 5),
(69, 2, 15, 7, 4),
(70, 2, 15, 12, 4),
(71, 2, 15, 18, 3),
(72, 2, 15, 23, 3),
(73, 2, 15, 29, 2),
(74, 2, 14, 1, 5),
(75, 2, 14, 6, 5),
(76, 2, 14, 12, 4),
(77, 2, 14, 17, 4),
(78, 2, 14, 22, 4),
(79, 2, 14, 29, 2),
(80, 2, 16, 2, 4),
(81, 2, 16, 7, 4),
(82, 2, 16, 13, 3),
(83, 2, 16, 17, 4),
(84, 2, 16, 23, 3),
(85, 2, 16, 30, 1),
(86, 2, 17, 2, 4),
(87, 2, 17, 7, 4),
(88, 2, 17, 13, 3),
(89, 2, 17, 18, 3),
(90, 2, 17, 23, 3),
(91, 2, 17, 30, 1),
(92, 2, 18, 3, 3),
(93, 2, 18, 8, 3),
(94, 2, 18, 14, 2),
(95, 2, 18, 19, 2),
(96, 2, 18, 24, 2),
(97, 2, 18, 30, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nama_sub_kriteria` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `bobot` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id`, `id_kriteria`, `nama_sub_kriteria`, `deskripsi`, `bobot`) VALUES
(1, 1, 'Sangat miskin (tidak punya rumah&amp;penghasilan rendah)', '', 5),
(2, 1, 'Miskin Penhasilan di Bawah UMR', '', 4),
(3, 1, 'Cukup Mampu', '', 3),
(4, 1, 'Mampu', '', 2),
(5, 1, 'Sangat mampu', '', 1),
(6, 2, 'Tidak bekerja /Pengangguran', '', 5),
(7, 2, 'Buruh harian/Serabutan', '', 4),
(8, 2, 'Petani /nelayan', '', 3),
(9, 2, 'Wiraswasta Kecil', '', 2),
(10, 2, 'Pegawai Negeri/Pegawai Tetap', '', 1),
(11, 3, 'Disabilitas sangat berat', '', 5),
(12, 3, 'Disabilitas berat', '', 4),
(13, 3, 'Disabilitas sedang', '', 3),
(14, 3, 'Disabilitas ringan', '', 2),
(15, 3, 'Tidak memiliki disabilitas', '', 1),
(16, 4, 'Yatim piatu', '', 5),
(17, 4, 'Yatim', '', 4),
(18, 4, 'Piatu', '', 3),
(19, 4, 'Orang tua lengkap namun tidak bekerja', '', 2),
(20, 4, 'Orang tua lengkap dan bekerja', '', 1),
(21, 5, 'Usia &gt; 70 tahun', '', 5),
(22, 5, 'Usia 65–70 tahun', '', 4),
(23, 5, 'Usia 60–64 tahun', '', 3),
(24, 5, 'Usia 50–59 tahun', '', 2),
(25, 5, 'Usia &lt; 50 tahun', '', 1),
(26, 6, 'Menyusui bayi &lt; 6 bulan', '', 5),
(27, 6, 'Menyusui bayi 6–12 bulan', '', 4),
(28, 6, 'Memiliki bayi &lt; 2 tahun (tidak menyusui)', '', 3),
(29, 6, 'Ibu hamil', '', 2),
(30, 6, 'Tidak menyusui / tidak memiliki bayi', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tentang`
--

CREATE TABLE `tentang` (
  `id` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tentang`
--

INSERT INTO `tentang` (`id`, `gambar`, `judul`, `deskripsi`) VALUES
(4, 'tentang_2861603529.png', 'Tentang Penerimaan BLT', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum modi esse deserunt, quia placeat praesentium? Dolore dolorem incidunt quod odit cupiditate consequatur laboriosam eaque architecto assumenda, suscipit exercitationem cum, similique delectus, doloremque non eligendi rem eum nam aut esse earum magni facilis laudantium? Provident fuga qui explicabo minus deleniti soluta, voluptatum veniam ipsa aliquam adipisci quasi, facere facilis, id aliquid quae! Dolore, harum. Officia est exercitationem nisi laudantium a consequuntur veniam excepturi pariatur eum quibusdam, voluptates porro ea, expedita cupiditate animi accusamus tenetur in ratione, ex deserunt! Est quia nam modi eveniet dignissimos eos ipsum quibusdam quidem corporis culpa. Porro.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_active` int(11) DEFAULT 2,
  `en_user` varchar(75) DEFAULT NULL,
  `token` char(6) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT 'default.svg',
  `email` varchar(75) DEFAULT NULL,
  `password` varchar(75) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `id_role`, `id_active`, `en_user`, `token`, `name`, `image`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, 'developer', 'default.svg', 'developer@gmail.com', '$2y$10$//KMATh3ibPoI3nHFp7x/u7vnAbo2WyUgmI4x0CVVrH8ajFhMvbjG', '2025-10-22 19:21:35', '2025-10-22 19:21:35'),
(2, 2, 1, NULL, NULL, 'admin', 'default.svg', 'admin@gmail.com', '$2y$10$//KMATh3ibPoI3nHFp7x/u7vnAbo2WyUgmI4x0CVVrH8ajFhMvbjG', '2025-10-22 19:21:35', '2025-10-22 19:21:35');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `insert_users` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
    SET NEW.id_role = (
        SELECT id_role
        FROM `user_role`
        ORDER BY id_role DESC
        LIMIT 1
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id_access_menu` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id_access_menu`, `id_role`, `id_menu`) VALUES
(1, 1, 1),
(3, 2, 3),
(4, 2, 4),
(5, 2, 5),
(6, 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_sub_menu`
--

CREATE TABLE `user_access_sub_menu` (
  `id_access_sub_menu` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_sub_menu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_access_sub_menu`
--

INSERT INTO `user_access_sub_menu` (`id_access_sub_menu`, `id_role`, `id_sub_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(4, 2, 4),
(5, 2, 5),
(6, 2, 6),
(7, 2, 7),
(8, 2, 8),
(9, 2, 9),
(10, 2, 10),
(11, 2, 11),
(12, 2, 12),
(13, 2, 13);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id_menu` int(11) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `menu` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id_menu`, `icon`, `menu`) VALUES
(1, 'bi bi-people', 'User Management'),
(3, 'bi bi-database-fill-gear', 'Master Data'),
(4, 'bi bi-list-check', 'Metode ROC'),
(5, 'bi bi-list-check', 'Metode SAW'),
(6, 'bi bi-megaphone', 'Informasi');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id_role`, `role`) VALUES
(1, 'Developer'),
(2, 'Administrator'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user_status`
--

CREATE TABLE `user_status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_status`
--

INSERT INTO `user_status` (`id_status`, `status`) VALUES
(1, 'Active'),
(2, 'No Active');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id_sub_menu` int(11) NOT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `id_active` int(11) DEFAULT 2,
  `title` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id_sub_menu`, `id_menu`, `id_active`, `title`, `url`) VALUES
(1, 1, 1, 'Users', 'user-management/users'),
(2, 1, 1, 'Role', 'user-management/role'),
(4, 3, 1, 'Periode', 'master-data/periode'),
(5, 4, 1, 'Kriteria', 'metode-roc/kriteria'),
(6, 4, 1, 'Sub Kriteria', 'metode-roc/sub-kriteria'),
(7, 4, 1, 'Pembobotan Nilai', 'metode-roc/pembobotan-nilai'),
(8, 5, 1, 'Data Alternatif', 'metode-saw/data-alternatif'),
(9, 5, 1, 'Penilaian Alternatif', 'metode-saw/penilaian-alternatif'),
(10, 5, 1, 'Hasil Seleksi', 'metode-saw/hasil-seleksi'),
(11, 6, 1, 'Tentang Kami', 'informasi/tentang-kami'),
(12, 6, 1, 'Prosedur Seleksi', 'informasi/prosedur-seleksi'),
(13, 6, 1, 'Pesan Masuk', 'informasi/pesan-masuk');

-- --------------------------------------------------------

--
-- Table structure for table `utilities`
--

CREATE TABLE `utilities` (
  `id` int(11) NOT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `name_web` varchar(75) DEFAULT NULL,
  `keyword` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilities`
--

INSERT INTO `utilities` (`id`, `logo`, `name_web`, `keyword`, `description`, `author`) VALUES
(1, 'logo.png', 'Sistem Penerimaan BLT', '', '#719033', 'Anthania Gende');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasil_akhir`
--
ALTER TABLE `hasil_akhir`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_periode` (`id_periode`),
  ADD KEY `id_alternatif` (`id_alternatif`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prosedur_seleksi`
--
ALTER TABLE `prosedur_seleksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skor_alternatif`
--
ALTER TABLE `skor_alternatif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_periode` (`id_periode`),
  ADD KEY `id_alternatif` (`id_alternatif`),
  ADD KEY `id_sub_kriteria` (`id_sub_kriteria`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `tentang`
--
ALTER TABLE `tentang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_active` (`id_active`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id_access_menu`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  ADD PRIMARY KEY (`id_access_sub_menu`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_sub_menu` (`id_sub_menu`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `user_status`
--
ALTER TABLE `user_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id_sub_menu`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_active` (`id_active`);

--
-- Indexes for table `utilities`
--
ALTER TABLE `utilities`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hasil_akhir`
--
ALTER TABLE `hasil_akhir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prosedur_seleksi`
--
ALTER TABLE `prosedur_seleksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `skor_alternatif`
--
ALTER TABLE `skor_alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tentang`
--
ALTER TABLE `tentang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id_access_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  MODIFY `id_access_sub_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_status`
--
ALTER TABLE `user_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id_sub_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `utilities`
--
ALTER TABLE `utilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil_akhir`
--
ALTER TABLE `hasil_akhir`
  ADD CONSTRAINT `hasil_akhir_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hasil_akhir_ibfk_2` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `skor_alternatif`
--
ALTER TABLE `skor_alternatif`
  ADD CONSTRAINT `skor_alternatif_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `skor_alternatif_ibfk_2` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `skor_alternatif_ibfk_3` FOREIGN KEY (`id_sub_kriteria`) REFERENCES `sub_kriteria` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_active`) REFERENCES `user_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD CONSTRAINT `user_access_menu_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_access_menu_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `user_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  ADD CONSTRAINT `user_access_sub_menu_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_access_sub_menu_ibfk_2` FOREIGN KEY (`id_sub_menu`) REFERENCES `user_sub_menu` (`id_sub_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD CONSTRAINT `user_sub_menu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `user_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_sub_menu_ibfk_2` FOREIGN KEY (`id_active`) REFERENCES `user_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
