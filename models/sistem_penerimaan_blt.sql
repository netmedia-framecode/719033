-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 15 Des 2025 pada 07.18
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

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
-- Struktur dari tabel `alternatif`
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
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id`, `nik`, `no_kk`, `nama_lengkap`, `jenis_kelamin`, `tgl_lahir`, `umur`, `status_keluarga`, `pekerjaan`) VALUES
(3, '5371011205800001', '5371011001000001', 'Budi Santoso', 'L', '1980-05-12', 45, 'Kepala Keluarga', 'Petani'),
(4, '5371016008750002', '5371011001000002', 'Siti Aminah', 'P', '1975-08-20', 50, 'Kepala Keluarga', 'Pedagang Kecil'),
(5, '5371011003630003', '5371011001000003', 'Ahmad Hidayat', 'L', '1963-03-10', 62, 'Kepala Keluarga', 'Buruh Harian Lepas'),
(6, '5371014511900004', '5371011001000004', 'Sri Wahyuni', 'P', '1990-11-05', 35, 'Istri', 'Ibu Rumah Tangga'),
(7, '5371011507880005', '5371011001000005', 'Joko Susilo', 'L', '1988-07-15', 37, 'Kepala Keluarga', 'Nelayan'),
(8, '5371010101550006', '5371011001000006', 'Mbah Suroto', 'L', '1955-01-01', 70, 'Kepala Keluarga', 'Tidak Bekerja'),
(9, '5371016512820007', '5371011001000007', 'Rina Marlina', 'P', '1982-12-25', 43, 'Kepala Keluarga', 'Penjahit'),
(10, '5371011402950008', '5371011001000008', 'Doni Pratama', 'L', '1995-02-14', 30, 'Anak', 'Honorer'),
(11, '5371010909700009', '5371011001000009', 'Yanto Basna', 'L', '1970-09-09', 55, 'Kepala Keluarga', 'Tukang Ojek'),
(12, '5371017006850010', '5371011001000010', 'Maria Yosefa', 'P', '1985-06-30', 40, 'Istri', 'Petani');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth`
--

CREATE TABLE `auth` (
  `id` int(11) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `bg` varchar(35) DEFAULT NULL,
  `model` int(11) DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `auth`
--

INSERT INTO `auth` (`id`, `image`, `bg`, `model`) VALUES
(1, 'auth.png', '#4e73de', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_akhir`
--

CREATE TABLE `hasil_akhir` (
  `id` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `skor` float DEFAULT NULL,
  `peringkat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hasil_akhir`
--

INSERT INTO `hasil_akhir` (`id`, `id_periode`, `id_alternatif`, `skor`, `peringkat`) VALUES
(1, 2, 10, 0.806528, 1),
(2, 2, 6, 0.800278, 2),
(3, 2, 4, 0.779166, 3),
(4, 2, 9, 0.706065, 4),
(5, 2, 8, 0.703519, 5),
(6, 2, 12, 0.700972, 6),
(7, 2, 11, 0.683843, 7),
(8, 2, 7, 0.594537, 8),
(9, 2, 5, 0.416806, 9),
(10, 2, 3, 0.386528, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontak`
--

CREATE TABLE `kontak` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subjek` varchar(255) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `tgl_buat` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
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
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id`, `kode_kriteria`, `nama_kriteria`, `jenis`, `prioritas`, `bobot_roc`) VALUES
(1, 'C1', 'Keluarga tidak mampu', 'benefit', 1, 0.408333),
(2, 'C2', 'Pekerjaan', 'benefit', 2, 0.241667),
(3, 'C3', 'Disabilitas', 'benefit', 3, 0.158333),
(4, 'C4', 'Anak Yatim/Yatim piatu', 'cost', 4, 0.102778),
(5, 'C5', 'Lansia', 'cost', 5, 0.0611111),
(6, 'C6', 'Ibu menyusui', 'cost', 6, 0.0277778);

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode`
--

CREATE TABLE `periode` (
  `id` int(11) NOT NULL,
  `nama_periode` varchar(100) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `status` enum('Aktif','Selesai','Pending') DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `periode`
--

INSERT INTO `periode` (`id`, `nama_periode`, `tanggal_mulai`, `status`, `keterangan`) VALUES
(2, '2025', '2025-12-15', 'Aktif', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `prosedur_seleksi`
--

CREATE TABLE `prosedur_seleksi` (
  `id` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `link_video` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `prosedur_seleksi`
--

INSERT INTO `prosedur_seleksi` (`id`, `gambar`, `link_video`, `judul`, `deskripsi`) VALUES
(2, 'prosedur_seleksi_2051397802.png', 'https://www.youtube.com/watch?v=x6_9a4yA-gY', 'Penerimaan BLT', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum modi esse deserunt, quia placeat praesentium? Dolore dolorem incidunt quod odit cupiditate consequatur laboriosam eaque architecto assumenda, suscipit exercitationem cum, similique delectus, doloremque non eligendi rem eum nam aut esse earum magni facilis laudantium? Provident fuga qui explicabo minus deleniti soluta, voluptatum veniam ipsa aliquam adipisci quasi, facere facilis, id aliquid quae! Dolore, harum. Officia est exercitationem nisi laudantium a consequuntur veniam excepturi pariatur eum quibusdam, voluptates porro ea, expedita cupiditate animi accusamus tenetur in ratione, ex deserunt! Est quia nam modi eveniet dignissimos eos ipsum quibusdam quidem corporis culpa. Porro.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `skor_alternatif`
--

CREATE TABLE `skor_alternatif` (
  `id` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `id_sub_kriteria` int(11) NOT NULL,
  `skor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `skor_alternatif`
--

INSERT INTO `skor_alternatif` (`id`, `id_periode`, `id_alternatif`, `id_sub_kriteria`, `skor`) VALUES
(2, 2, 5, 4, 2),
(3, 2, 5, 10, 1),
(4, 2, 5, 15, 1),
(5, 2, 5, 19, 2),
(6, 2, 5, 25, 1),
(7, 2, 5, 30, 1),
(8, 2, 3, 5, 1),
(9, 2, 3, 10, 1),
(10, 2, 3, 15, 1),
(11, 2, 3, 20, 1),
(12, 2, 3, 25, 1),
(13, 2, 3, 30, 1),
(14, 2, 10, 2, 4),
(15, 2, 10, 8, 3),
(16, 2, 10, 13, 3),
(17, 2, 10, 19, 2),
(18, 2, 10, 25, 1),
(19, 2, 10, 30, 1),
(20, 2, 7, 3, 3),
(21, 2, 7, 9, 2),
(22, 2, 7, 14, 2),
(23, 2, 7, 18, 3),
(24, 2, 7, 25, 1),
(25, 2, 7, 30, 1),
(26, 2, 12, 2, 4),
(27, 2, 12, 8, 3),
(28, 2, 12, 15, 1),
(29, 2, 12, 19, 2),
(30, 2, 12, 25, 1),
(31, 2, 12, 30, 1),
(32, 2, 8, 2, 4),
(33, 2, 8, 7, 4),
(34, 2, 8, 15, 1),
(35, 2, 8, 18, 3),
(36, 2, 8, 23, 3),
(37, 2, 8, 30, 1),
(38, 2, 9, 2, 4),
(39, 2, 9, 8, 3),
(40, 2, 9, 14, 2),
(41, 2, 9, 18, 3),
(42, 2, 9, 24, 2),
(43, 2, 9, 30, 1),
(44, 2, 4, 1, 5),
(45, 2, 4, 8, 3),
(46, 2, 4, 14, 2),
(47, 2, 4, 17, 4),
(48, 2, 4, 24, 2),
(49, 2, 4, 30, 1),
(50, 2, 6, 2, 4),
(51, 2, 6, 7, 4),
(52, 2, 6, 14, 2),
(53, 2, 6, 19, 2),
(54, 2, 6, 25, 1),
(55, 2, 6, 29, 2),
(56, 2, 11, 2, 4),
(57, 2, 11, 8, 3),
(58, 2, 11, 15, 1),
(59, 2, 11, 18, 3),
(60, 2, 11, 25, 1),
(61, 2, 11, 30, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nama_sub_kriteria` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `bobot` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sub_kriteria`
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
-- Struktur dari tabel `tentang`
--

CREATE TABLE `tentang` (
  `id` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tentang`
--

INSERT INTO `tentang` (`id`, `gambar`, `judul`, `deskripsi`) VALUES
(4, 'tentang_2861603529.png', 'Tentang Penerimaan BLT', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum modi esse deserunt, quia placeat praesentium? Dolore dolorem incidunt quod odit cupiditate consequatur laboriosam eaque architecto assumenda, suscipit exercitationem cum, similique delectus, doloremque non eligendi rem eum nam aut esse earum magni facilis laudantium? Provident fuga qui explicabo minus deleniti soluta, voluptatum veniam ipsa aliquam adipisci quasi, facere facilis, id aliquid quae! Dolore, harum. Officia est exercitationem nisi laudantium a consequuntur veniam excepturi pariatur eum quibusdam, voluptates porro ea, expedita cupiditate animi accusamus tenetur in ratione, ex deserunt! Est quia nam modi eveniet dignissimos eos ipsum quibusdam quidem corporis culpa. Porro.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `id_role`, `id_active`, `en_user`, `token`, `name`, `image`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, 'developer', 'default.svg', 'developer@gmail.com', '$2y$10$//KMATh3ibPoI3nHFp7x/u7vnAbo2WyUgmI4x0CVVrH8ajFhMvbjG', '2025-10-22 19:21:35', '2025-10-22 19:21:35'),
(2, 2, 1, NULL, NULL, 'admin', 'default.svg', 'admin@gmail.com', '$2y$10$//KMATh3ibPoI3nHFp7x/u7vnAbo2WyUgmI4x0CVVrH8ajFhMvbjG', '2025-10-22 19:21:35', '2025-10-22 19:21:35');

--
-- Trigger `users`
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
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id_access_menu` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id_access_menu`, `id_role`, `id_menu`) VALUES
(1, 1, 1),
(3, 2, 3),
(4, 2, 4),
(5, 2, 5),
(6, 2, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_sub_menu`
--

CREATE TABLE `user_access_sub_menu` (
  `id_access_sub_menu` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_sub_menu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_access_sub_menu`
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
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id_menu` int(11) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `menu` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id_menu`, `icon`, `menu`) VALUES
(1, 'bi bi-people', 'User Management'),
(3, 'bi bi-database-fill-gear', 'Master Data'),
(4, 'bi bi-list-check', 'Metode ROC'),
(5, 'bi bi-list-check', 'Metode SAW'),
(6, 'bi bi-megaphone', 'Informasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id_role`, `role`) VALUES
(1, 'Developer'),
(2, 'Administrator'),
(3, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_status`
--

CREATE TABLE `user_status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_status`
--

INSERT INTO `user_status` (`id_status`, `status`) VALUES
(1, 'Active'),
(2, 'No Active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id_sub_menu` int(11) NOT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `id_active` int(11) DEFAULT 2,
  `title` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_sub_menu`
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
-- Struktur dari tabel `utilities`
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
-- Dumping data untuk tabel `utilities`
--

INSERT INTO `utilities` (`id`, `logo`, `name_web`, `keyword`, `description`, `author`) VALUES
(1, 'logo.png', 'Sistem Penerimaan BLT', '', '#719033', 'Anthania Gende');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indeks untuk tabel `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hasil_akhir`
--
ALTER TABLE `hasil_akhir`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_periode` (`id_periode`),
  ADD KEY `id_alternatif` (`id_alternatif`);

--
-- Indeks untuk tabel `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `prosedur_seleksi`
--
ALTER TABLE `prosedur_seleksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `skor_alternatif`
--
ALTER TABLE `skor_alternatif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_periode` (`id_periode`),
  ADD KEY `id_alternatif` (`id_alternatif`),
  ADD KEY `id_sub_kriteria` (`id_sub_kriteria`);

--
-- Indeks untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indeks untuk tabel `tentang`
--
ALTER TABLE `tentang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_active` (`id_active`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id_access_menu`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indeks untuk tabel `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  ADD PRIMARY KEY (`id_access_sub_menu`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_sub_menu` (`id_sub_menu`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `user_status`
--
ALTER TABLE `user_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id_sub_menu`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_active` (`id_active`);

--
-- Indeks untuk tabel `utilities`
--
ALTER TABLE `utilities`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `hasil_akhir`
--
ALTER TABLE `hasil_akhir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `periode`
--
ALTER TABLE `periode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `prosedur_seleksi`
--
ALTER TABLE `prosedur_seleksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `skor_alternatif`
--
ALTER TABLE `skor_alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tentang`
--
ALTER TABLE `tentang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id_access_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  MODIFY `id_access_sub_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_status`
--
ALTER TABLE `user_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id_sub_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `utilities`
--
ALTER TABLE `utilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hasil_akhir`
--
ALTER TABLE `hasil_akhir`
  ADD CONSTRAINT `hasil_akhir_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hasil_akhir_ibfk_2` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `skor_alternatif`
--
ALTER TABLE `skor_alternatif`
  ADD CONSTRAINT `skor_alternatif_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `skor_alternatif_ibfk_2` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `skor_alternatif_ibfk_3` FOREIGN KEY (`id_sub_kriteria`) REFERENCES `sub_kriteria` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_active`) REFERENCES `user_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD CONSTRAINT `user_access_menu_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_access_menu_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `user_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  ADD CONSTRAINT `user_access_sub_menu_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_access_sub_menu_ibfk_2` FOREIGN KEY (`id_sub_menu`) REFERENCES `user_sub_menu` (`id_sub_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD CONSTRAINT `user_sub_menu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `user_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_sub_menu_ibfk_2` FOREIGN KEY (`id_active`) REFERENCES `user_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
