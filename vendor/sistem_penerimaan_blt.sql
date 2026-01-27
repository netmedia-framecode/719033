-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 27 Jan 2026 pada 01.42
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
(13, '5319014501660001', '5319013007088748', 'AGNES ES', 'P', '0000-00-00', 62, 'KK', 'Petani'),
(14, '5319011510770001', '5319013009150000', 'ALOISIUS GO\'ONG', 'L', '0000-00-00', 45, 'KK', 'Petani'),
(15, '5319010509660001', '5319012809160005', 'ALOYSIUS SANI', 'L', '0000-00-00', 55, 'KK', 'Petani'),
(16, '5319012307910006', '5319011905160015', 'APOLONIUS JEBARUS', 'L', '0000-00-00', 31, 'KK', 'Petani'),
(17, '5319020120290004', '5319021811130003', 'BENEDIKTUS TUTUR', 'L', '0000-00-00', 0, 'KK', 'Petani'),
(18, '5319014107570140', '5319014107570140', 'BIATA SUHUNG', 'P', '0000-00-00', 61, 'KK', 'Petani'),
(19, '5319016801680002', '5319012908170001', 'BIBIANA BAUL', 'P', '0000-00-00', 53, 'KK', 'Petani'),
(20, '5319014107570146', '5319013007088707', 'BIBIANA BI', 'P', '0000-00-00', 65, 'KK', 'Petani'),
(21, '5319014107420074', '5319013007088519', 'BIBIANA PIPI', 'P', '0000-00-00', 50, 'KK', 'Petani'),
(22, '5319010107600186', '', 'BLASIUS GAUT', 'L', '0000-00-00', 61, 'KK', 'Petani'),
(23, '5319010107470089', '5319013007088536', 'DAMIANUS LAGUR', 'L', '0000-00-00', 74, 'KK', 'Petani'),
(24, '5319010107810095', '5319013007088672', 'DARIUS TANTING', 'L', '0000-00-00', 41, 'KK', 'Petani'),
(25, '5319012909800002', '5319010210120006', 'DIOLEKSI ARDI', 'L', '0000-00-00', 42, 'KK', 'Petani'),
(26, '5319011111130005', '5319013011257001', 'DOMINIKUS KUMAT', 'L', '0000-00-00', 64, 'KK', 'Petani'),
(27, '5319010107670132', '5319013007088589', 'DONATUS ADUR', 'L', '0000-00-00', 55, 'KK', 'Petani'),
(28, '5319011307620001', '5319013007088618', 'DONATUS JEBARUS', 'L', '0000-00-00', 56, 'KK', 'Petani'),
(29, '5319010107400118', '', 'DONATUS TAUK', 'L', '0000-00-00', 0, '', 'Petani'),
(30, '5319016104010001', '5319011706210002', 'ELISABET APRILIANI', 'P', '0000-00-00', 20, 'Istri', 'Petani'),
(31, '5319016703540001', '5319012002140012', 'ELISABET NAHUNG', 'P', '0000-00-00', 67, 'KK', 'Petani'),
(32, '5319014107750003', '5319011310140000', 'EMILIA EMBUNG', 'P', '0000-00-00', 39, 'KK', 'Petani'),
(33, '5319014107560088', '', 'EUSEBIUS DIANTO NAGUR', 'L', '0000-00-00', 0, '', 'Petani'),
(34, '5319012712950004', '5319011005210004', 'FANSIANUS NDOS', 'L', '0000-00-00', 27, 'KK', 'Petani'),
(35, '5319012607820002', '5319013007088559', 'FERDIANUS NANDUS', 'L', '0000-00-00', 40, 'KK', 'Petani'),
(36, '5319010107850131', '', 'FERDINANDUS JEBARUS', 'L', '0000-00-00', 37, 'KK', 'Petani'),
(37, '5319020605820003', '5319022407120003', 'FERDINANDUS TARI', 'L', '0000-00-00', 39, 'KK', 'Petani'),
(38, '5319017112690004', '5319013007088732', 'FERONIKA ENUS', 'P', '0000-00-00', 52, 'Istri', 'Petani'),
(39, '5319012407790002', '5319012910120003', 'FLORIANUS JEBARUS', 'L', '0000-00-00', 43, 'KK', 'Petani'),
(40, '5319014107810105', '5319010804160002', 'FRANSISKA ESENG', 'P', '0000-00-00', 41, 'Istri', 'Petani'),
(41, '5319010107630134', '5319013007088567', 'FRANSISKUS JEMA', 'L', '0000-00-00', 58, 'KK', 'Petani'),
(42, '5319011806920002', '', 'GREGORIUS K. GUNTUR', 'L', '0000-00-00', 0, '', 'Petani'),
(43, '5319015307930002', '5319010906210005', 'HENDRIKA IMAN', 'P', '0000-00-00', 29, 'Istri', 'Petani'),
(44, '5319010107580143', '5319013007088670', 'HENDRIKUS PAPUT', 'P', '0000-00-00', 62, 'KK', 'Petani'),
(45, '5319010107560060', '', 'HENDRIKUS SANAR', 'L', '0000-00-00', 55, 'KK', 'Petani'),
(46, '5319011307750002', '5319011111130006', 'HENDRIKUS SURUNG', 'L', '0000-00-00', 47, 'KK', 'Petani'),
(47, '5319011109820002', '5319010410160010', 'HIASINTUS FELISTU', 'L', '0000-00-00', 40, 'KK', 'Petani'),
(48, '5319012707820003', '5319011603160014', 'HIRONIMUS JOHAN ', 'L', '0000-00-00', 39, 'KK', 'Petani'),
(49, '5319012806940000', '', 'IRENIUS KANTA', 'L', '0000-00-00', 28, 'KK', 'Petani'),
(50, '5319011406890002', '5319011310160004', 'IVANTUS JEBARUS', 'L', '0000-00-00', 32, 'KK', 'Petani'),
(51, '5319010107590107', '5319013007088633', 'KANISIUS ADOL', 'L', '0000-00-00', -63, 'KK', 'Petani'),
(52, '5319012106690002', '5319011111130008', 'KANISIUS JEHUMAN', 'L', '0000-00-00', -53, 'KK', 'Petani'),
(53, '5319015811640001', '5319012111190002', 'KAROLINA SADIPA', 'P', '0000-00-00', 58, 'KK', 'Petani'),
(54, '5319014712670001', '5319013103160001', 'KATARINA DES', 'P', '0000-00-00', 55, 'KK', 'Petani'),
(55, '5319014107540028', '5319013007088580', 'KATARINA NA', 'P', '0000-00-00', 66, 'KK', 'Petani'),
(56, '5319014107540082', '5319010602150001', 'KATARINA NUET', 'P', '0000-00-00', 68, 'KK', 'Petani'),
(57, '5319015405700002', '5319012301180002', 'KATARINA RIN', 'P', '0000-00-00', 51, 'KK', 'Petani'),
(58, '5319013103930002', '', 'KONSTANTINUS JENORUT', 'P', '0000-00-00', 29, 'KK', 'Petani'),
(59, '5319011508670001', '5319012812120016', 'LAGUS JENARU', 'L', '0000-00-00', 55, 'KK', 'Petani'),
(60, '5.31008E+15', '', 'LASARUS JEHANAT', 'L', '0000-00-00', 71, 'KK', 'Petani'),
(61, '5319010705890001', '', 'LEONARDUS JONTAL', 'L', '0000-00-00', 32, 'KK', 'Petani'),
(62, '5319013012640005', '5319011912120007', 'LINUS SEMADI', 'L', '0000-00-00', 57, 'KK', 'Petani'),
(63, '5319010107620154', '5319013007088526', 'LODOVIKUS ANDI', 'L', '0000-00-00', 59, 'KK', 'Petani'),
(64, '5310156508990001', '', 'LUSIA NINUT', 'P', '0000-00-00', 24, 'Istri', 'Petani'),
(65, '5319014107580121', '5319013007088718', 'LUSIA SUKE', 'P', '0000-00-00', 64, 'KK', 'Petani'),
(66, '5319010104710002', '5319013007088600', 'MAKSIMUS AHAS', 'L', '0000-00-00', 50, 'KK', 'Petani'),
(67, '5319010506900004', '5319010410170011', 'MAKSIMUS RUDI', 'L', '0000-00-00', 32, 'KK', 'Petani'),
(68, '5319016811740003', '5319012402160004', 'MARGARETA HILA ', 'P', '0000-00-00', 48, 'KK', 'Petani'),
(69, '5319011207620001', '5319013007088535', 'MARIA GORETI BULUS', 'P', '0000-00-00', 60, 'KK', 'Petani'),
(70, '5319014105520001', '', 'MARIA JEMAMU', 'P', '0000-00-00', 70, 'KK', 'Petani'),
(71, '5319010508540001', '5319010904130001', 'MARTINUS LALUNG', 'L', '0000-00-00', 67, 'KK', 'Petani'),
(72, '5319013112810000', '5319012409210006', 'MASELUS MONE GOA', 'L', '0000-00-00', 40, 'KK', 'Petani'),
(73, '5319016605880002', '', 'MEDIANUS ANGGAL', 'L', '0000-00-00', 0, '', 'Petani'),
(74, '5319012210710001', '5319013007088513', 'MELKIOR MAGUR', 'L', '0000-00-00', 50, 'KK', 'Petani'),
(75, '5319010107640127', '5319013007088543', 'MIKAEL JERUBUT', 'L', '0000-00-00', 57, 'KK', 'Petani'),
(76, '5319014107480056', '5319011901170003', 'MONIKA MIMA', 'P', '0000-00-00', 62, 'KK', 'Petani'),
(77, '', '', 'MONIKA ONIK', 'P', '0000-00-00', 0, 'KK', 'Petani'),
(78, '5310910107470091', '5319013007088646', 'NIKOLAUS MATUR', 'L', '0000-00-00', 75, 'KK', 'Petani'),
(79, '5319014107590110', '5319013007088702', 'PAULINA MIN', 'P', '0000-00-00', 60, 'KK', 'Petani'),
(80, '5319010107570130', '', 'PAULUS RADAS', 'L', '0000-00-00', 0, '', 'Petani'),
(81, '5319012501900001', '', 'PAULUS RIAN MARUS', 'L', '0000-00-00', 0, 'KK', 'Petani'),
(82, '5319011207610001', '5319012002140007', 'PETRUS AMPUT', 'L', '0000-00-00', 60, 'KK', 'Petani'),
(83, '5319010107440030', '5319013007088578', 'PETRUS ARIT', 'L', '0000-00-00', 82, 'KK', 'Petani'),
(84, '5319012204650001', '5319011111130003', 'PETRUS DAOT', 'L', '0000-00-00', 56, 'KK', 'Petani'),
(85, '5319012510770004', '5319011905160017', 'PETRUS GANTUR', 'L', '0000-00-00', 45, 'KK', 'Petani'),
(86, '5319010107640129', '5319011703140003', 'PETRUS JERANU', 'L', '0000-00-00', 62, 'KK', 'Petani'),
(87, '5319010107530089', '5319013007088562', 'PETRUS PANAT', 'L', '0000-00-00', 68, 'KK', 'Petani'),
(88, '5319010107300051', '5319013007088613', 'PETRUS TARU', 'L', '0000-00-00', 79, 'KK', 'Petani'),
(89, '5319011708580000', '5319013007088679', 'PIUS PAPU', 'L', '0000-00-00', 64, 'KK', 'Petani'),
(90, '5319012502160002', '5319012502160002', 'RONILIUS ANDUR', 'L', '0000-00-00', 38, 'KK', 'Petani'),
(91, '5319015701910002', '5319011802210001', 'ROSALIA ASIL', 'P', '0000-00-00', 30, 'KK', 'Petani'),
(92, '53190150008820003', '', 'ROVINA MAMUT', 'P', '0000-00-00', 0, '', 'Petani'),
(93, '5319012403770000', '5319013007088630', 'SAULUS O. GENTAR', 'L', '0000-00-00', 45, 'KK', 'Petani'),
(94, '5319013012500001', '5319011311130007', 'SIPRIANUS JEMEHOT', 'L', '0000-00-00', 71, 'KK', 'Petani'),
(95, '5319010107750130', '5319012609140001', 'STANISLAUS CARU', 'L', '0000-00-00', 42, 'KK', 'Petani'),
(96, '5319011301690001', '5319013007088531', 'STANISLAUS TAN', 'L', '0000-00-00', 50, 'KK', 'Petani'),
(97, '5319015008820003', '5319010303140006', 'THERESIA NAUT', 'P', '0000-00-00', 47, 'KK', 'Petani'),
(98, '5319010107570132', '5319013007088580', 'THOMAS DORA', 'L', '0000-00-00', 64, 'KK', 'Petani'),
(99, '5319010101900006', '', 'UBALDUS TANTU', 'L', '0000-00-00', 0, '', 'Petani'),
(100, '5319010107650196', '5319013007088568', 'VALENTINUS AMAT', 'L', '0000-00-00', 57, 'KK', 'Petani'),
(101, '5319012108830002', '5319013007088570', 'VENIBALDUS AMIR', 'L', '0000-00-00', 38, 'KK', 'Petani'),
(102, '5319014107660012', '5319013007088520', 'VERONIKA SEDIA', 'P', '0000-00-00', 55, 'KK', 'Petani'),
(103, '5319025103020004', '5319012409210003', 'VIKRIANA LIDIA GANUL', 'P', '0003-11-02', 20, 'Istri', 'Petani'),
(104, '5319011312810001', '5319013007088681', 'WIHELMINA ENA', 'P', '0000-00-00', 41, 'KK', 'Petani'),
(105, '5319014305800002', '5319013007088647', 'YASTIKA YASINTA JUN', 'P', '0000-00-00', 42, 'Istri', 'Petani'),
(106, '5319016406850004', '', 'YOHANA JENI', 'P', '0000-00-00', 37, 'Istri', 'Petani'),
(107, '5319010107780058', '5319011907170017', 'YOHANES PARING', 'L', '0000-00-00', 44, 'KK', 'Petani'),
(108, '5319010107440029', '5319013007088560', 'YOHANES SEBATU', 'L', '0000-00-00', 57, 'KK', 'Petani'),
(109, '5310122209900002', '5319013101180001', 'YOHANES WADA', 'L', '0000-00-00', 32, 'KK', 'Petani'),
(110, '5319011211900000', '5319010208210002', 'YOSAFAT L. WONDO', 'L', '0000-00-00', 31, 'KK', 'Petani'),
(111, '5319010105670001', '5319013007088629', 'YOSEP LULUS', 'L', '0000-00-00', 55, 'KK', 'Petani'),
(112, '5319011903620001', '5319013007088515', 'YOSEP RANGGA', 'L', '0000-00-00', 59, 'KK', 'Petani');

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
(1, '1644038058.jpeg', '#4e73de', 2);

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
(23, 2, 19, 0.969444, 1),
(24, 2, 13, 0.783333, 2),
(25, 2, 14, 0.783333, 3),
(26, 2, 15, 0.783333, 4),
(27, 2, 17, 0.752778, 5),
(28, 2, 16, 0.675, 6),
(29, 2, 18, 0.675, 7);

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
(1, 'C1', 'Keluarga tidak mampu', 'cost', 2, 0.241667),
(2, 'C2', 'Pekerjaan', 'cost', 1, 0.408333),
(3, 'C3', 'Disabilitas', 'benefit', 3, 0.158333),
(4, 'C4', 'Anak Yatim/Yatim piatu', 'benefit', 4, 0.102778),
(5, 'C5', 'Lansia', 'benefit', 5, 0.0611111),
(8, 'C6', 'Ibu Menyusui', 'benefit', 6, 0.0277778);

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
(2, '2026', '2026-01-01', 'Aktif', 'Bantuan dari LSM');

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
(2, 'prosedur_seleksi_3031669007.jpeg', 'https://www.youtube.com/watch?v=fU7h6nHEs_s', 'Penerimaan BLT', 'Desa Golo Kantar di Kabupaten Manggarai Timur mayoritas penduduknya adalah petani tradisional yang masih menghadapi tingkat kemiskinan cukup tinggi, sehingga program Bantuan Langsung Tunai (BLT) menjadi tumpuan penting bagi kesejahteraan warga. Namun, proses seleksi penerima bantuan selama ini masih dilakukan secara manual dan subjektif, sehingga sering kali memicu kendala transparansi serta ketidakefisienan dalam pembagian anggaran yang terbatas. Untuk itu, penerapan Sistem Pendukung Keputusan (SPK) dengan metode ROC dan SAW menjadi solusi strategis guna mengubah data kriteria seperti status ekonomi dan kepemilikan KTP menjadi peringkat prioritas yang objektif. Melalui sistem ini, penyaluran BLT di Desa Golo Kantar diharapkan menjadi lebih tepat sasaran, cepat, dan akuntabel sesuai dengan prinsip manajemen organisasi modern.');

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
(96, 2, 13, 8, 3),
(97, 2, 13, 3, 3),
(98, 2, 13, 15, 1),
(99, 2, 13, 20, 1),
(100, 2, 13, 24, 2),
(101, 2, 13, 35, 1),
(102, 2, 14, 8, 3),
(103, 2, 14, 3, 3),
(104, 2, 14, 15, 1),
(105, 2, 14, 20, 1),
(106, 2, 14, 24, 2),
(107, 2, 14, 35, 1),
(108, 2, 15, 8, 3),
(109, 2, 15, 3, 3),
(110, 2, 15, 15, 1),
(111, 2, 15, 20, 1),
(112, 2, 15, 24, 2),
(113, 2, 15, 35, 1),
(114, 2, 16, 9, 4),
(115, 2, 16, 4, 4),
(116, 2, 16, 15, 1),
(117, 2, 16, 20, 1),
(118, 2, 16, 24, 2),
(119, 2, 16, 35, 1),
(120, 2, 17, 8, 3),
(121, 2, 17, 3, 3),
(122, 2, 17, 15, 1),
(123, 2, 17, 20, 1),
(124, 2, 17, 25, 1),
(125, 2, 17, 35, 1),
(126, 2, 18, 9, 4),
(127, 2, 18, 4, 4),
(128, 2, 18, 15, 1),
(129, 2, 18, 20, 1),
(130, 2, 18, 24, 2),
(131, 2, 18, 35, 1),
(132, 2, 19, 7, 2),
(133, 2, 19, 2, 2),
(134, 2, 19, 15, 1),
(135, 2, 19, 20, 1),
(136, 2, 19, 25, 1),
(137, 2, 19, 35, 1);

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
(1, 1, 'Sangat miskin (tidak punya rumah&amp;penghasilan rendah)', '', 1),
(2, 1, 'Miskin Penhasilan di Bawah UMR', '', 2),
(3, 1, 'Cukup Mampu', '', 3),
(4, 1, 'Mampu', '', 4),
(5, 1, 'Sangat mampu', '', 5),
(6, 2, 'Tidak bekerja /Pengangguran', '', 1),
(7, 2, 'Buruh harian/Serabutan', '', 2),
(8, 2, 'Petani /nelayan', '', 3),
(9, 2, 'Wiraswasta Kecil', '', 4),
(10, 2, 'Pegawai Negeri/Pegawai Tetap', '', 5),
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
(22, 5, 'Usia 65-70 tahun', '', 4),
(23, 5, 'Usia 60-64 tahun', '', 3),
(24, 5, 'Usia 50-59 tahun', '', 2),
(25, 5, 'Usia &lt; 50 tahun', '', 1),
(31, 8, 'Menyusui bayi &lt; 6 bulan', '', 5),
(32, 8, 'Menyusui bayi 6-12 bulan', '', 4),
(33, 8, 'Memiliki bayi &lt; 2 tahun (tidak menyusui)', '', 3),
(34, 8, 'Ibu hamil', '', 2),
(35, 8, 'Tidak menyusui / tidak memiliki bayi', '', 1);

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
(4, 'tentang_3031669007.jpeg', 'Tentang Penerimaan BLT', 'Prosedur seleksi penerimaan BLT di Desa Golo Kantar diawali dengan pengumpulan data masyarakat yang mayoritas bekerja sebagai petani tradisional dengan tingkat kerentanan ekonomi tinggi. Tahapan selanjutnya melibatkan digitalisasi data calon penerima berdasarkan kriteria objektif seperti status keluarga miskin, kepemilikan KTP, dan kondisi kehilangan mata pencaharian. Data tersebut kemudian diolah menggunakan Sistem Pendukung Keputusan yang mengintegrasikan metode Rank Order Centroid (ROC) untuk menentukan bobot prioritas kriteria dan metode Simple Additive Weighting (SAW) untuk menghitung skor akhir serta perankingan setiap alternatif. Melalui mekanisme sistematis ini, proses seleksi yang sebelumnya manual dan subjektif berubah menjadi proses yang cepat, transparan, dan akuntabel, sehingga penetapan prioritas penerima bantuan dilakukan berdasarkan hasil peringkat tertinggi yang paling layak menerima bantuan sesuai anggaran yang tersedia.');

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
(2, 2, 1, NULL, NULL, 'admin', 'default.svg', 'admin@gmail.com', '$2y$10$//KMATh3ibPoI3nHFp7x/u7vnAbo2WyUgmI4x0CVVrH8ajFhMvbjG', '2025-10-22 19:21:35', '2025-10-22 19:21:35'),
(4, 2, 1, '2y10Bu48HfMS09FAdetW9Pd7qIAhy9nHVbU8puE948xR469y6xVNcm', '314520', 'Nia', 'default.svg', 'anthaniagende26@gmail.com', '$2y$10$v.xFWp8SAcjKEym5vnMEZOJb.G4gfBLSGrMB2TpsxwfpLpt.df.mC', '2026-01-12 07:56:09', '2026-01-12 07:56:47');

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
(4, 'bi bi-list-check', 'Pembobotan Kriteria'),
(5, 'bi bi-list-check', 'Seleksi dan Hasil'),
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
(2, 'Administrator');

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
(5, 4, 1, 'Kriteria', 'pembobotan-kriteria/kriteria'),
(6, 4, 1, 'Sub Kriteria', 'pembobotan-kriteria/sub-kriteria'),
(7, 4, 1, 'Pembobotan Nilai', 'pembobotan-kriteria/pembobotan-nilai'),
(8, 5, 1, 'Data Penduduk', 'seleksi-dan-hasil/data-penduduk'),
(9, 5, 1, 'Penilaian Penduduk', 'seleksi-dan-hasil/penilaian-penduduk'),
(10, 5, 1, 'Hasil Seleksi', 'seleksi-dan-hasil/hasil-seleksi'),
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
(1, '3408279069.png', 'Sistem Penerimaan BLT', '', '#719033', 'Anthania Gende');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT untuk tabel `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `hasil_akhir`
--
ALTER TABLE `hasil_akhir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `periode`
--
ALTER TABLE `periode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `prosedur_seleksi`
--
ALTER TABLE `prosedur_seleksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `skor_alternatif`
--
ALTER TABLE `skor_alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `tentang`
--
ALTER TABLE `tentang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
