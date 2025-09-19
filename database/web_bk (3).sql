-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2025 at 09:47 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_bk`
--

-- --------------------------------------------------------

--
-- Table structure for table `catatan_konseling`
--

CREATE TABLE `catatan_konseling` (
  `catatan_id` int(11) NOT NULL,
  `jadwal_id` int(11) DEFAULT NULL,
  `ringkasan_masalah` text DEFAULT NULL,
  `solusi` text DEFAULT NULL,
  `tanggal_catatan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `edukasi`
--

CREATE TABLE `edukasi` (
  `edukasi_id` int(11) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `link` text DEFAULT NULL,
  `jenis` enum('vidio','foto','link') DEFAULT NULL,
  `file_edukasi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `edukasi`
--

INSERT INTO `edukasi` (`edukasi_id`, `judul`, `link`, `jenis`, `file_edukasi`) VALUES
(3, 'UAS', NULL, 'foto', 'Nilai_PBO_TI.pdf'),
(5, 'sasa', 'https://fauzanramadhan12.github.io/porto/html/', 'link', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `guru_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama_guru` varchar(100) DEFAULT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `status_guru` enum('bk','biasa') DEFAULT NULL,
  `foto_guru` varchar(255) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_konseling`
--

CREATE TABLE `jadwal_konseling` (
  `jadwal_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `tempat` varchar(100) DEFAULT NULL,
  `topik` text DEFAULT NULL,
  `status` enum('terjadwal','selesai','batal') DEFAULT 'terjadwal',
  `link_zoom` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pelanggaran`
--

CREATE TABLE `jenis_pelanggaran` (
  `jenis_id` int(11) NOT NULL,
  `nama_pelanggaran` varchar(100) DEFAULT NULL,
  `poin_pengurang` int(11) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_pelanggaran`
--

INSERT INTO `jenis_pelanggaran` (`jenis_id`, `nama_pelanggaran`, `poin_pengurang`, `kategori`) VALUES
(2, 'Tidak memakai seragam', 20, 'Pelanggaran Ringan'),
(3, 'Membuat keributan di kelas', 15, 'Pelanggaran Ringan'),
(4, 'Keluar kelas tanpa izin guru', 20, 'Pelanggaran Ringan'),
(7, 'Merokok di lingkungan sekolah', 60, 'Pelanggaran Sedang'),
(8, 'Membully teman / Berkelahi', 80, 'Pelanggaran Sedang'),
(9, 'Membolos tanpa keterangan', 80, 'Pelanggaran Sedang'),
(10, 'Mencuri barang milik teman/guru/sekolah', 99, 'Pelanggaran Sedang'),
(13, 'Melawan guru', 120, 'Pelanggaran Berat'),
(14, 'Membawa senjata tajam / benda berbahaya', 140, 'Pelanggaran Sedang'),
(15, 'Mengonsumsi / membawa narkoba, alkohol', 150, 'Pelanggaran Berat'),
(16, 'Merusak fasilitas sekolah', 150, 'Pelanggaran Berat'),
(17, 'Membolos saat ujian', 150, 'Pelanggaran Berat');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_pengaduan`
--

CREATE TABLE `laporan_pengaduan` (
  `laporan_id` int(11) NOT NULL,
  `siswa_id` int(11) DEFAULT NULL,
  `guru_id` int(11) DEFAULT NULL,
  `judul_laporan` varchar(100) NOT NULL,
  `ket_laporan` text NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `foto_laporan` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan_pengaduan`
--

INSERT INTO `laporan_pengaduan` (`laporan_id`, `siswa_id`, `guru_id`, `judul_laporan`, `ket_laporan`, `nama_siswa`, `foto_laporan`, `create_at`, `update_at`) VALUES
(1, 1, NULL, 'Merokok dikelas', '<p>melihat alex meroko di ruangan depan</p>', 'Alex MAruli', 'almet_unama.png', '2025-08-24 21:47:39', '2025-08-25 11:34:20'),
(4, 1, NULL, 'assadsad', '<p>asdasdasdasda</p>', 'Alfi Zahara', 'WhatsApp_Image_2025-08-04_at_12_22_29_20006e25.jpg', '2025-08-25 12:34:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `minat_bakat`
--

CREATE TABLE `minat_bakat` (
  `minat_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `minat` varchar(100) NOT NULL,
  `bakat` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal_input` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `minat_bakat`
--

INSERT INTO `minat_bakat` (`minat_id`, `siswa_id`, `minat`, `bakat`, `deskripsi`, `tanggal_input`) VALUES
(2, 1, 'Olahraga', 'Futsal', 'Ingin menjadi pemain futsal', '2025-08-06');

-- --------------------------------------------------------

--
-- Table structure for table `orangtua`
--

CREATE TABLE `orangtua` (
  `wali_id` int(11) NOT NULL,
  `siswa_id` int(11) DEFAULT NULL,
  `nama_wali` varchar(100) DEFAULT NULL,
  `hubungan` varchar(50) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran_siswa`
--

CREATE TABLE `pelanggaran_siswa` (
  `pelanggaran_id` int(11) NOT NULL,
  `siswa_id` int(11) DEFAULT NULL,
  `jenis_id` int(11) DEFAULT NULL,
  `semester_id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggaran_siswa`
--

INSERT INTO `pelanggaran_siswa` (`pelanggaran_id`, `siswa_id`, `jenis_id`, `semester_id`, `tanggal`, `deskripsi`, `lokasi`, `create_at`, `update_at`) VALUES
(13, 1, 13, 3, '2024-01-13', '<p>Melawan saat guru memberi nasehat&nbsp;</p>', 'Ruangan Kelas', '2025-05-01 11:15:06', NULL),
(14, 1, 8, 3, '2025-06-12', '<p>Membuli teman sekelas</p>', 'Kelas', '2025-08-06 14:46:40', NULL),
(15, 1, 16, 4, '2025-08-01', '<p>Membakar Taman Sekolaah</p>', 'Taman', '2025-08-06 14:47:22', NULL),
(16, 1, 2, 1, '2023-03-16', '<p>Tidak Membawa Dasi</p>', 'Lapangan', '2025-08-06 14:47:50', NULL),
(17, 1, 7, 1, '2025-08-01', '<p>Merokok</p>', 'Gudang', '2025-08-06 15:55:42', NULL),
(18, 2, 17, 1, '2025-07-01', '<p>Melakukan bolos ujian</p>', 'Kelas', '2025-08-06 16:32:38', NULL),
(19, 3, 2, 1, '2025-07-31', '<p>saat upacara</p>', 'tidak menggunkaan dasi', '2025-08-06 16:33:21', NULL),
(20, 1, 2, 1, '2025-08-07', '<p>wesdasc</p>', 'JL.SUMATRA RT.41 JELUTUN', '2025-08-07 10:37:41', NULL),
(21, 1, 2, 2, '2025-08-01', '<p>saxzcxz</p>', 'wa', '2025-08-08 11:59:54', NULL),
(22, 1, 2, 2, '2025-08-01', '<p>czascz</p>', 'aszxsa', '2025-08-08 12:00:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_konseling`
--

CREATE TABLE `pengajuan_konseling` (
  `pengajuan_id` int(11) NOT NULL,
  `siswa_id` int(11) DEFAULT NULL,
  `alasan` text DEFAULT NULL,
  `tanggal_pengajuan` date DEFAULT NULL,
  `tanggal_setuju` datetime DEFAULT NULL,
  `status` enum('menunggu','disetujui','ditolak') DEFAULT 'menunggu',
  `catatan` text DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan_konseling`
--

INSERT INTO `pengajuan_konseling` (`pengajuan_id`, `siswa_id`, `alasan`, `tanggal_pengajuan`, `tanggal_setuju`, `status`, `catatan`, `create_at`, `update_at`) VALUES
(4, 1, '<p>mau mengasukan banya al</p>', '2025-08-08', '2025-08-08 11:50:24', 'disetujui', '<p>Oke</p>', '2025-08-08 10:57:31', '2025-08-08 11:50:24'),
(5, 1, '<p>Mau melakukan banyak sesuatu</p>', '2025-08-22', '2025-08-08 11:05:30', 'disetujui', '<p>Oke langsung saja&nbsp;</p>', '2025-08-08 11:04:59', '2025-08-08 11:05:30');

-- --------------------------------------------------------

--
-- Table structure for table `pengembangan_diri`
--

CREATE TABLE `pengembangan_diri` (
  `pengembangan_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `tingkat` varchar(50) DEFAULT NULL,
  `tahun_mulai` varchar(4) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengembangan_diri`
--

INSERT INTO `pengembangan_diri` (`pengembangan_id`, `siswa_id`, `jenis`, `deskripsi`, `tingkat`, `tahun_mulai`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 2, 'Minat', '<p>Membaca buku sains dan teknologi</p>', 'Terampil', '2020', '<p>Aktif ikut lomba membaca cepat</p>', '2025-09-02 10:09:04', '2025-09-02 10:14:06'),
(2, 2, 'Bakat', '<p>Public Speaking</p>', 'Mahir', '2021', '<p>Pernah jadi MC di acara sekolah</p>', '2025-09-02 10:10:36', '2025-09-02 10:10:36');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester_id` int(11) NOT NULL,
  `nama_semester` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semester_id`, `nama_semester`, `status`) VALUES
(1, 'Semester Ganjil 2023/2024', 0),
(2, 'Semester Genap 2023/2024', 1),
(3, 'Semester Ganjil 2024/2025', 0),
(4, 'Semester Genap 2024/2025', 0);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `siswa_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `nisn` varchar(20) DEFAULT NULL,
  `nis` varchar(10) DEFAULT NULL,
  `kelas` enum('X','XI','XII','LULUS') DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `no_siswa` varchar(15) DEFAULT NULL,
  `no_ortu` varchar(15) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `agama` varchar(15) DEFAULT NULL,
  `rt` varchar(3) DEFAULT NULL,
  `rw` varchar(3) DEFAULT NULL,
  `kelurahan` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `foto_siswa` varchar(255) DEFAULT NULL,
  `naik_kelas` enum('YA','TIDAK') DEFAULT 'YA',
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`siswa_id`, `user_id`, `nama_lengkap`, `nisn`, `nis`, `kelas`, `jenis_kelamin`, `no_siswa`, `no_ortu`, `tanggal_lahir`, `tempat_lahir`, `nama_ibu`, `alamat`, `nik`, `agama`, `rt`, `rw`, `kelurahan`, `kecamatan`, `foto_siswa`, `naik_kelas`, `update_at`) VALUES
(1, 5, 'ABDUL HAKIM', '0063533292', '2482', 'X', 'L', '083133098437', '6288706510567', '2006-07-21', 'Kuala TUngkal', 'JURAIDAH', 'Kelapa Gading', '1506022107060001', 'Islam', '18', '0', 'Tungkal Harapan', 'Kec. Tungkal Ilir', 'logopendidikan.png', 'YA', '2025-09-02 16:17:49'),
(2, 6, 'ABDUL SHOMAD', '0078311039', '2589', 'X', 'L', '082374258547', NULL, '2007-07-10', 'BETARA KIRI', 'SAMSIAH', 'BETARA KIRI', '1506041007070002', 'Islam', '10', '0', 'BETARA KIRI', 'Kec. Kuala Betara', 'logopendidikan1.png', 'YA', '2025-09-02 16:18:50'),
(3, 7, 'ADINDA TRIANI', '0079847330', '2350', 'X', 'P', '083133098704', NULL, '2007-03-04', 'TANJUNG JABUNG BARAT', 'SITI ZAHARA', 'KELAPA GADING', '1506024403070008', 'Islam', '0', '0', 'Tungkal Harapan', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(4, 8, 'AGUNG WAHYU PRASETYO', '0083927455', '2415', 'X', 'L', NULL, NULL, '2008-03-31', 'TANJUNG JABUNG BARAT', 'AINUN JARIAH', 'JALAN PARIT DASIKIN', '1506023103080001', 'Islam', NULL, NULL, 'KUALA INDAH', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(5, 9, 'AGUS SALIM', '0087596186', '2383', 'X', 'L', NULL, NULL, '2008-08-20', 'TANJUNG JABUNG BARAT', 'SAFIA', 'JALAN KIHAJAR DEWANTARA', '1506122008080001', 'Islam', NULL, NULL, 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(6, 10, 'Ahmad Dani', '0085504393', '2588', 'X', 'L', '082281187374', NULL, '2008-11-30', 'Pangkal Duri', 'Salamah', 'Parit 14', '1507033011080001', 'Islam', '6', '0', 'Dataran Pinang', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(7, 11, 'Ahmad Kenzie Al-Banna', '0087979917', '2484', 'X', 'L', '085266473129', NULL, '2008-11-14', 'Jambi', 'Astirini Nurmala Sari', 'Jl. H. Abd. Rahman', '1506021411080002', 'Islam', '11', '0', 'Patunas', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(8, 12, 'AHMAD ZAINURI', '3096717291', '2592', 'X', 'L', NULL, NULL, '2009-02-19', 'JEMBER', 'LIANA', 'PARIT 12', '6207091902090001', 'Islam', '3', NULL, 'SUNGAI GEBAR', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(9, 13, 'AHMAT ALI HERLANSAH', '0075461427', '2587', 'X', 'L', NULL, NULL, '2007-10-10', 'Tanjung Jabung Barat', 'SALBIAH', 'JL TEMPALO', '1506021010070001', 'Islam', '0', '0', 'TUNGKAL III', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(10, 14, 'AHMAT PUJIYANSAH', '0082773312', '2416', 'X', 'L', NULL, NULL, '2008-08-19', 'KUALA TUNGKAL', 'ROZIAH', 'Jl. Parit 1 Darat', '1506021908080001', 'Islam', NULL, NULL, 'Sriwijaya', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(11, 15, 'AISYAH', '0099868921', '2545', 'X', 'P', NULL, NULL, '2009-01-19', 'TANJUNG JABUNG BARAT', 'HUSNUL FATIMAH', 'Kihajar Dewantara', '1506025901090001', 'Islam', NULL, NULL, 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(12, 16, 'AKMAL AKBAR', '0088601039', '2447', 'X', 'L', '082385951255', NULL, '2008-08-12', 'PEMATANG PAUH', 'SUTRIA NINGSIH', 'JL,. BERINGIN', '1506011208080001', 'Islam', '14', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(13, 17, 'ALDO RISKY SAPUTRA', '0071742934', '2448', 'X', 'L', '088287610796', NULL, '2007-05-18', 'Kuala Tungkal', 'Diana', 'Panglima Cama ', '1506021805070001', 'Islam', '7', '0', 'Patunas', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(14, 18, 'Alfa Azzahra', '0086295682', '2546', 'X', 'P', '085268404455', NULL, '2008-11-05', 'Jambi', 'Nur Alvi', 'Jalan Sriwijaya Ujung', '1506024511080001', 'Islam', '14', '0', 'SRIWIJAYA', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(15, 19, 'Alfi Zahara', '0077656898', '2305', 'X', 'P', '083173448046', NULL, '2007-06-19', 'Kuala Tungkal', 'Aliyah', 'Jl. Agus Nginot', '1506025906070001', 'Islam', '9', NULL, 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(16, 20, 'ALIYA NATASYA', '0075695516', '2306', 'X', 'P', '083133098513', NULL, '2007-01-01', 'Bangka', 'BADAR YANTI', 'Kepala Gading', '1506024101070008', 'Islam', '0', '0', 'Tungkal Harapan', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(17, 21, 'ALVINA LAURA', '0089000623', '2578', 'X', 'P', '082180761746', NULL, '2008-01-16', 'KUALA TUNGKAL', 'SUPIAH', 'Jl Rimba', '1506025601080001', 'Islam', '14', '0', 'SUNGAI NIBUNG', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(18, 22, 'AMELIA SAFITRI', '0098735143', '2486', 'X', 'P', '085188403721', NULL, '2009-09-30', 'KUALA TUNGKAL', 'MEGAWATI', 'KETAPANG', '1506027009090003', 'Islam', '6', '0', 'TUNGKAL HARAPAN', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(19, 23, 'ANDINI PUTRI ALI', '0085033572', '2417', 'X', 'P', '081366954612', NULL, '2008-03-09', 'Kuala Tungkal', 'Seftina Susi', 'Bhayangkara', '1506024903090003', 'Islam', '5', '0', 'Tungkal III', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(20, 24, 'ANGGI SAPUTRA', '0050872020', '2351', 'X', 'L', NULL, NULL, '2007-01-26', 'PARIT KERAMAT', 'SAFIYAH', 'Jl. Panglima H. Saman', '1506026601070008', 'Islam', '21', '0', 'Tungkal Iii', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(21, 25, 'ANGGUN AULIA', '0073324904', '2449', 'X', 'P', NULL, NULL, '2007-05-20', 'TANJUNG JABUNG BARAT', 'SITI AISAH', 'JALAN LINTAS KUALA INDAH', '1506046005070001', 'Islam', NULL, NULL, 'KUALA INDAH', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(22, 26, 'ANGGUN CITRA AULIA', '0086814119', '2488', 'X', 'P', NULL, NULL, '2008-11-10', 'Tanjung Jabung Barat', 'NENG ETI HANDAYANI ', 'Dusun Muda Pembengis', '1506115011080002', 'Islam', NULL, NULL, 'Desa/Kel. Pembengis', 'Kec. Bram Itam', NULL, 'YA', NULL),
(23, 27, 'ANISA NANDA UTAMI', '0087420494', '2323', 'X', 'P', NULL, NULL, '2008-05-06', 'TANJUNG JABUNG BARAT', 'SAINAH', 'KP. PELAYANGAN', '1506114605080001', 'Islam', '5', '0', 'Desa/Kel. Bram Itam Raya', 'Kec. Bram Itam', NULL, 'YA', NULL),
(24, 28, 'ANISA NURCAHYANI', '0074217061', '2328', 'X', 'P', '083171889832', NULL, '2007-02-24', 'PALEMBANG', 'ALISAH', 'JL. GANG MAWAR', '1506026402070003', 'Islam', '6', '0', 'Tungkal Harapan', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(25, 29, 'Aqilla Wirdatun Naja', '0088672132', '2576', 'X', 'P', '082320183089', NULL, '2008-11-26', 'Jambi', 'Mailisa', 'Jl. Kihajar Dewantara', '1571086611080001', 'Islam', '11', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(26, 30, 'ATQAN ALFATHIR RIZKY', '0086911669', '2384', 'X', 'L', '085266601555', NULL, '2008-09-04', 'Kuala Tungkal', 'Siti Hamisah', 'Pemuda', '1506020409080004', 'Islam', '11', '0', 'Patunas', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(27, 31, 'AULAZIYANA ABIDAH', '0085750465', '2580', 'X', 'P', '081368219732', NULL, '2008-12-19', 'Tanjung Jabung Barat', 'MISLIANI', 'Pulau Pinang', '1506045912080002', 'Islam', '4', NULL, 'Desa/Kel. BETARA KANAN', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(28, 32, 'AULIA MIRANDA', '0075831915', '2515', 'X', 'P', '085765616577', NULL, '2007-08-10', 'BATAM', 'FITRIANI', 'TANJUNG UMA NO.58', '2171065008079001', 'Islam', '1', '5', 'TANJUNG UMA', 'Kec. Lubuk Baja', NULL, 'YA', NULL),
(29, 33, 'AULIA RAHMI', '0095258043', '2516', 'X', 'P', NULL, NULL, '2009-11-05', 'TANJUNG JABUNG BARAT', 'SUHAIDAH', 'Desa Kuala Indah', '1506124511090001', 'Islam', '4', NULL, 'Kuala Indah', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(30, 34, 'Azura Valentina', '0097436783', '2489', 'X', 'P', '082138470105', NULL, '2009-02-13', 'Kuala Tungkal', 'Heri Yanti', 'Jalan Beringin', '1506025302090005', 'Islam', '1', '4', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(31, 35, 'BADALI SAPUTRA', '0088918512', '2517', 'X', 'L', NULL, NULL, '2008-10-08', 'Kuala Tungkal', 'Raudhah', 'Jalan Kihajar Dewantara', '1506020810080002', 'Islam', '3', NULL, 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(32, 36, 'BAHRUL AZMI', '3073838543', '2307', 'X', 'L', NULL, NULL, '2007-05-05', 'TANJUNG JABUNG BARAT', 'MARDIAH', 'JL. BERINGIN KUALA TUNGKAL', '1506120505070001', 'Islam', '0', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(33, 37, 'BHAGAS ALFIAN SUHADA', '3096355039', '2548', 'X', 'L', NULL, NULL, '2009-05-14', 'TEMBILAHAN ', 'NURNA NINGSIH', '-', '1404011405090002', 'Islam', '0', '0', '-', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(34, 38, 'BINTANG ADE PUTRA', '0084798113', '2418', 'X', 'L', NULL, NULL, '2008-08-10', 'KUALA TUNGKAL', 'YAYUK SRIRAHAYU', 'BTN. PARIT 2', '1506021008080003', 'Islam', '1', '0', 'BERINGIN', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(35, 39, 'CERYLE YURCEL ARSYAWINATA', '0085556156', '2385', 'X', 'P', '082268865035', NULL, '2008-10-10', 'Kuala Tungkal', 'Rissya', 'Kihajar Dewantara', '1506025010080001', 'Islam', '13', '0', 'Patunas', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(36, 40, 'Cornelis Robert Dharmawan', '0084461721', '2581', 'X', 'L', '089528332454', NULL, '2008-02-26', 'Blitar', 'Lilis Suwarti', 'Jl. Kihajar Dewantara', '3505092602080001', 'Islam', '9', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(37, 41, 'DAFFA SAPUTRA', '0066809640', '2329', 'XI', 'L', '085366551075', NULL, '2006-12-13', 'Kuala Tungkal', 'Lasmaini', 'BTN Pengabuan Permai', '1506021312060007', 'Islam', '20', '0', 'Tungkal Iii', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(38, 42, 'DANIEL AGUSTINUS SIMANJUNTAK', '0088991130', '2386', 'XI', 'L', '085347200324', NULL, '2008-08-28', 'KUALA TUNGKAL', 'PETRISIA HUTAGALUNG', 'PROF SRI SOEDEWI,MS SH', '1506022808080001', 'Kristen', '0', '0', 'SUNGAI NIBUNG', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(39, 43, 'DANNY KHAIRONI', '0067515420', '2596', 'XI', 'L', '081368883058', NULL, '2006-04-24', 'KUALA TUNGKAL', 'MARLINA', 'RT.04 PSR.MINGGU', '1506022404060011', 'Islam', '4', '0', 'SUNGAI RAMBAI', 'Kec. Senyerang', NULL, 'YA', NULL),
(40, 44, 'DARWIS SAPUTRA', '0089012202', '2593', 'XI', 'L', NULL, NULL, '2008-11-25', 'SUNGAI BATANG', 'SITI JUBAIDAH', 'DUSUN ALAM SARI', '1404202311080001', 'Islam', '4', NULL, 'SUNGAI GEBAR', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(41, 45, 'DEA ARISKA', '0059670023', '2352', 'XI', 'P', '083171623508', NULL, '2005-05-25', 'TANJAB BARAT', 'YUSNITA', 'PARIT LAPIS', '1506026505050002', 'Islam', '14', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(42, 46, 'DECA SAPITRI', '3088757166', '2490', 'XI', 'P', NULL, NULL, '2008-10-05', 'Kuala Tungkal', 'Siti Patimah', 'Jl. Beringin Ujung', '1506024510080003', 'Islam', '8', NULL, 'Patunas', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(43, 47, 'DEFRI ARRAHMANALLAH', '0086888431', '2450', 'XI', 'L', NULL, NULL, '2008-11-03', 'Kuala Tungkal', 'HALIMAH', 'JL. Parit 1 Darat', '1506020311080003', 'Islam', '13', NULL, 'Sriwijaya', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(44, 48, 'DELIA ASTRI', '0072094574', '2353', 'XI', 'P', '083133097910', NULL, '2007-01-17', 'KUALA TUNGKAL', 'ELI', 'RAMAYANA', '1506025701070001', 'Islam', '5', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(45, 49, 'Dena Afriyani', '3071764025', '2354', 'XI', 'P', '083171877674', NULL, '2007-04-02', 'Bekasi', 'Nany Nuryani', 'Jl. Setia Kawan', '1671054204070003', 'Islam', NULL, NULL, 'Tungkal Iii', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(46, 50, 'DHARA KURNIA IDRIS', '0087616153', '2451', 'XI', 'P', NULL, NULL, '2008-08-13', 'PULAU KIJANG', 'NURNA NINGSIH', 'Jl Kihajar Dewantara', '1404015308080001', 'Islam', NULL, NULL, 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(47, 51, 'DJUWITA AGATHA FAJAR', '0072362045', '2330', 'XI', 'P', '081278048579', NULL, '2007-08-06', 'KUALA TUNGKAL', 'SITI HAJAR', 'DUSUN BUMI SUCI RT. 03', '1506024608070001', 'Islam', NULL, NULL, 'Desa/Kel. BERAM ITAM KANAN', 'Kec. Bram Itam', NULL, 'YA', NULL),
(48, 52, 'DWI AZZURA PRAMA DITA', '0071032735', '2419', 'XI', 'P', '082199688441', NULL, '2007-10-28', 'Kuala Tungkal', 'Kamellya', 'Jl. Jendral Sudirman', '1506026810070004', 'Islam', '10', NULL, 'Sriwijaya', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(49, 53, 'DZUNUR\'AIN FATIMAH AZZAHRA', '0063189741', '2309', 'XI', 'P', '08237763543', NULL, '2006-11-15', 'Kuala Tungkal', 'Erfinawaty', 'Jl. Panglima Ujung', '1506025511060001', 'Islam', '0', '0', 'Tungkal Iii', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(50, 54, 'EL SYAUQI', '3098998989', '2518', 'XI', 'L', NULL, NULL, '2009-04-20', 'TANJAB BARAT', 'NAJMAH', 'Jl. Jend. Sudirman', '1506022004090001', 'Islam', NULL, NULL, 'SRIWIJAYA', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(51, 55, 'ELPA WARDA', '0089307729', '2454', 'XI', 'P', '082286311843', NULL, '2008-04-10', 'TERJUN JAYA', 'RINI', 'Terjun Jaya', '1506045004080001', 'Islam', '11', '0', 'TERJUN GAJAH', 'Kec. Betara', NULL, 'YA', NULL),
(52, 56, 'ELSA DIVA YANTI', '0068241891', '2355', 'XI', 'P', '089512367192', NULL, '2006-10-29', 'KAMPUNG BARU', 'FITRI YANTI', 'DUSUN HARAPAN', '1506115110060001', 'Islam', '1', '0', 'Desa/Kel. BERAM ITAM KIRI', 'Kec. Bram Itam', NULL, 'YA', NULL),
(53, 57, 'ELSA NABILA', '0052744437', '2356', 'XI', 'P', NULL, NULL, '2005-03-18', 'TANJUNG JABUNG BARAT', 'ROSTRIYANA', 'JL. BERINGIN KUALA TUNGKAL', '1506125803050001', 'Islam', '0', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(54, 58, 'ELSA NADILA', '0079495308', '2420', 'XI', 'P', NULL, NULL, '2007-03-17', 'Tanjung jabung barat', 'rostriyana', 'dusun betara makmur', '1506045703070001', 'Islam', '5', '0', 'betara kanan', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(55, 59, 'ELSA SEPBRINA', '0059467877', '2452', 'XI', 'P', '089652108196', NULL, '2005-09-03', 'KUALA TUNGKAL', 'HERLINAWATI', 'JLN. KELAPA GADING', '1506024309050001', 'Islam', '11', '0', 'TUNGKAL HARAPAN', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(56, 60, 'ELVIRA KESYA PUTRI. S', '0087607819', '2597', 'XI', 'P', '0895619942050', NULL, '2008-07-10', 'Kuala Tungkal', 'Mike Armalina, A.Md', 'Piere Tendean', '1506025007080002', 'Islam', '3', '0', 'Tungkal III', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(57, 61, 'ENGGI DESTIO', '0069007599', '2331', 'XI', 'L', '085266800602', NULL, '2006-12-05', 'Kuala Tungkal', 'Siti Hannah', 'Kihajar Dewantara', '1506020512060001', 'Islam', '2', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(58, 62, 'FARHAN NUR HUDA RAHMADI', '0096372732', '2549', 'XI', 'L', '085367356627', NULL, '2009-09-14', 'Muara Tebo', 'DEYNA APRILIYANA', 'Jl Beringin', '1509011409090001', 'Islam', '14', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(59, 63, 'Fauzan', '0098112956', '2491', 'XI', 'L', '081278280079', NULL, '2009-07-23', 'Tanjung Jabung Barat', 'Eziyarnis', 'KH Dewantara Parit II', '1506022307090001', 'Islam', '2', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(60, 64, 'FEBY DWI LESTARI', '3074486058', '2421', 'XI', 'P', NULL, NULL, '2007-01-31', 'BATAM', 'SEPTI', 'Jl. Kihajar Dewantara', '2171097101079001', 'Islam', NULL, NULL, 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(61, 65, 'GEBI SABRINA AMANDA', '0084561872', '2422', 'XI', 'P', '0895620026487', NULL, '2008-06-25', 'TANJUNG JABUNG BARAT', 'SYAMSINA', 'TUNGKAL HARAPAN', '1506026506080002', 'Islam', '18', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(62, 66, 'HAIKAL AKBAR', '0081302757', '2519', 'XI', 'L', NULL, NULL, '2008-08-23', 'KUALA TUNGKAL', 'SITI HAWA', 'GANG BARU, PARIT GOMPONG', '1506022308080001', 'Islam', '0', '0', 'SUNGAI NIBUNG', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(63, 67, 'HANA TALITHA AZZAHRA', '0062585980', '2332', 'XI', 'P', NULL, NULL, '2006-12-29', 'JAMBI', 'NUNUNG HASANAH', 'JL. BERINGIN KUALA TUNGKAL', '1506026912060004', 'Islam', '0', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(64, 68, 'Hardiansyah', '0087941261', '2492', 'XI', 'L', '082289454643', NULL, '2008-01-19', 'Tanjung Jabung Barat', 'Masdiana', 'Parit 14', '1506121901080001', 'Islam', '7', '0', 'Dataran Pinang', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(65, 69, 'HELIA SALMAH', '0074326174', '2579', 'XI', 'P', NULL, NULL, '2007-04-13', 'Tanjung Jabung Barat', 'FATMAWATI', 'Jl Kihajar Dewantara', '1506025304070003', 'Islam', NULL, NULL, 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(66, 70, 'HUMAIRA ATQIYA', '0085346362', '2387', 'XI', 'P', NULL, NULL, '2008-08-10', 'KUALA TUNGKAL', 'SAPRIYANI', 'JL AHMAD I', '1506025008080002', 'Islam', '17', '0', 'TUNGKAL HARAPAN', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(67, 71, 'HUSNUL HATIMAH', '0085172039', '2455', 'XI', 'P', '083867299395', NULL, '2008-06-01', 'TANJAB BARAT', 'ERNAWATI', 'HIDAYAT', '1506024106080002', 'Islam', '3', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(68, 72, 'HUSNUL KHATIMAH', '0071117772', '2310', 'XI', 'P', NULL, NULL, '2007-02-04', 'KUALA TUNGKAL', 'ANISA', 'JL. BERINGIN KUALA TUNGKAL', '1506024402070004', 'Islam', '0', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(69, 73, 'HUSNUL KHATIMAH', '0082189534', '2388', 'XI', 'P', '085366029637', NULL, '2008-08-15', 'KUALA TUNGKAL', 'ROHAYATI', 'lrg sepakat', '1506025508080001', 'Islam', '17', '0', 'TUNGKAL II', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(70, 74, 'ILHAM MAULANA', '0087683074', '2423', 'XI', 'L', '082177542261', NULL, '2008-03-19', 'Kuala Tungkal', 'Lesi Lestuti Wilandari', 'BTN Permata Hijau', '1506021903080002', 'Islam', '12', '0', 'Patunas', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(71, 75, 'INDAH DAVITRI', '0096927178', '2551', 'XI', 'P', '082170391895', NULL, '2009-02-02', 'SOLOK', 'FITRI NITA', 'JL. SUKA JAYA', '1372014202090003', 'Islam', '0', '0', 'SUNGAI NIBUNG', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(72, 76, 'IRFAN PERMANA PUTRA', '0099395729', '2552', 'XI', 'L', '085266411775', NULL, '2009-05-27', 'TANJUNG JABUNG BARAT', 'MARDIANA', 'JL. BERINGIN UJUNG', '1506022705090003', 'Islam', '8', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(73, 77, 'IRHAM RAMADHAN', '0084957651', '2456', 'XI', 'L', '082280379945', NULL, '2009-09-05', 'TANJUNG JABUNG BARAT', 'NURAINI', 'KAMPUNG HIDAYAT', '1506020509090005', 'Islam', '4', '0', 'TELUK SIALANG', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(74, 78, 'IVO LAROSA ANDRETA HEALTHY', '0098539469', '2553', 'XI', 'P', '081244592308', NULL, '2009-06-27', 'Pekan Baru', 'Resita Simangunsong', 'Jl. Wijaya Kusuma', '1506026706090001', 'Kristen', '6', '0', 'SUNGAI NIBUNG', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(75, 79, 'JESSICA PUTRI RAHMADANI', '0099728976', '2493', 'XI', 'P', NULL, NULL, '2009-09-11', 'PANJANG', 'YENRI NASTA', 'Jalan Beringin', '1871075109090001', 'Islam', '8', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(76, 80, 'JUMA\' ATIAH', '0093649583', '2585', 'XI', 'P', '081271921263', NULL, '2009-01-29', 'TANJUNG JABUNG BARAT', 'SITI RAHMAH', 'Pasar Parit Deli', '1506126901090001', 'Islam', '12', '0', 'BETARA KIRI', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(77, 81, 'JUNAIDA', '3090631599', '2520', 'XI', 'P', NULL, NULL, '2009-05-15', 'Tanjung Jabung Barat', 'Pauziah', 'Jl. Parit Satu Darat', '1506025505090002', 'Islam', NULL, NULL, 'Sriwijaya', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(78, 82, 'Junaidi', '0097945443', '2554', 'XI', 'L', '082178136382', NULL, '2009-03-20', 'Kuala Tungkal', 'Sanainah', 'Parit 2 Kh. Dewantara', '1506022003090001', 'Islam', '2', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(79, 83, 'KEISHA AZZAHRA', '0089463100', '2424', 'XI', 'P', '083172265454', NULL, '2008-06-12', 'KUALA TUNGKAL', 'FIQRIA ULFA', 'JL. BTN PENGABUAN PERMAI', '1506025206080001', 'Islam', '4', '0', 'TUNGKAL III', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(80, 84, 'KELFIANRA', '0088644949', '2390', 'XI', 'L', NULL, NULL, '2008-02-14', 'KUALA TUNGKAL', 'MARIANI', 'Jl. Kihajar Dewantara', '1506021402080002', 'Islam', NULL, NULL, 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(81, 85, 'KEVIN PRATAMA SIREGAR', '0076428574', '2358', 'XI', 'L', NULL, NULL, '2007-07-26', 'Kuala Tungkal', 'Rosdiana', 'Jl. Beringin', '1506022607070002', 'Islam', NULL, NULL, 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(82, 86, 'Keysha Valentina Angruela', '3089984527', '2391', 'XI', 'P', NULL, NULL, '2008-02-14', 'Kuala Tungkal', 'Febri Hastuti', 'Perum Permata Hijau', '1506025402080003', 'Islam', '12', '0', 'Patunas', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(83, 87, 'KHAIRUNNISA', '0081890239', '2521', 'XI', 'P', NULL, NULL, '2008-12-15', 'Kuala Tungkal', 'Nur anik', 'jl siswa', '1506025512080002', 'Islam', NULL, NULL, 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(84, 88, 'KHALISA MUTIA ZAHRA', '0071199364', '2334', 'XI', 'P', '081992628495', NULL, '2007-05-26', 'JAMBI', 'HERNI ZAYANTI', 'JL.H IBRAHIM', '1506026605070006', 'Islam', '22', '6', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(85, 89, 'KHIZANAATUL HIKMAH', '0069978755', '2335', 'XI', 'P', '083133098507', NULL, '2006-12-06', 'KUALA INDAH', 'FARIDAH', 'Kuala indah', '1506124612060001', 'Islam', '5', '0', 'Kuala Indah', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(86, 90, 'LAYLI RAMADANI', '0079779554', '2359', 'XI', 'P', '085287227247', NULL, '2007-09-25', 'Tanjung Jabung Barat', 'ERMAWATI', 'SUNGAI SAREN', '1506116509070001', 'Islam', '11', '0', 'Desa/Kel. BERAM ITAM KIRI', 'Kec. Bram Itam', NULL, 'YA', NULL),
(87, 91, 'LILI AZWINA', '0073717788', '2311', 'XI', 'P', NULL, NULL, '2007-03-30', 'TANJUNG JABUNG BARAT', 'SALASIAH', 'JL. BERINGIN KUALA TUNGKAL', '1506127003070001', 'Islam', '0', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(88, 92, 'LULUK WIDIYANA ANISYATIN ALYAH', '0083188580', '2483', 'XI', 'P', '085314716239', NULL, '2008-09-25', 'KUALA TUNGKAL', 'ROSDIANA', 'GANG ALFALAH', '1506026509080001', 'Islam', '11', '0', 'TUNGKAL HARAPAN', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(89, 93, 'M RAFA PUTRA RAMADHAN', '0088225299', '2427', 'XI', 'L', '089652109904', NULL, '2008-08-21', 'TANJUNG JABUNG BARAT', 'LIZA NOVIANTI', 'JL KELAPA MANIS', '1506022108080001', 'Islam', '16', '0', 'TUNGKAL HARAPAN', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(90, 94, 'M REHAN INDRA SAPUTRA', '0069740505', '2425', 'XI', 'L', '082299954364', NULL, '2006-08-02', 'KUALA TUNGKAL', 'MASNAH', 'JL HIDAYAT', '1506020208060005', 'Islam', '0', '0', 'Tungkal Iv Kota', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(91, 95, 'M. AGIL ROMADHONI', '0071883833', '2392', 'XI', 'L', NULL, NULL, '2007-09-13', 'TANJUNG JABUNG BARAT', 'NURSYAIMAH', 'PARIT 2', '1506021309070006', 'Islam', '2', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(92, 96, 'm. akbar', '0073405262', '2494', 'XI', 'L', '083172673682', NULL, '2007-04-30', 'kuala tungkal', 'marni', 'JL. KIHAJAR DEWANTARA', '1506023004070004', 'Islam', '2', '0', 'patunas', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(93, 97, 'M. ALFIN', '0083581240', '2457', 'XI', 'L', NULL, NULL, '2008-07-09', 'tanjung jabung barat', 'LASTARI', 'JL. BERINGIN UJUNG', '1506020907080001', 'Islam', '14', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(94, 98, 'M. ANDIKA', '0089107814', '2555', 'XI', 'L', '085268677833', NULL, '2008-10-29', 'Kuala Tungkal', 'ERNI YUSNITA', 'Lorong Papadaan', '1506022910080002', 'Islam', '3', '0', 'Tungkal Ii', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(95, 99, 'M. AUFA AZZAM', '0091815514', '2556', 'XI', 'L', NULL, NULL, '2009-08-04', 'KUALA TUNGKAL', 'HELPI DIANA', 'jl parit gompong', '1506020408090001', 'Islam', NULL, NULL, 'SUNGAI NIBUNG', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(96, 100, 'M. AZIRWAN', '0055640009', '2495', 'XI', 'L', NULL, NULL, '2008-12-16', 'TEMBILAHAN', 'NUR AZIZZAH', 'Jalan Kihajar Dewantara', '1404040612080002', 'Islam', '15', NULL, 'SRIWIJAYA', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(97, 101, 'M. BILLY RAMADHAN', '0065916998', '2360', 'XI', 'L', NULL, NULL, '2006-10-08', 'KUALA TUNGKAL', 'DARMI', 'JL. BERINGIN KUALA TUNGKAL', '1506020810060005', 'Islam', '0', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(98, 102, 'M. DAFFA ANNASHIH', '0082244055', '2496', 'XI', 'L', '082182289168', NULL, '2008-03-29', 'Kuala tungkal', 'SUNARSIH', 'JL. BERINGIN UJUNG', '1506022903080001', 'Islam', '14', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(99, 103, 'M. DAFFA JALLALUDDIN RUMMI', '0075096416', '2336', 'XI', 'L', NULL, NULL, '2007-05-27', 'JAMBI', 'ELDA MAYANTI', 'JL. KAPT. PIERRE TENDEAN', '1571012705070181', 'Islam', '5', '0', 'Tungkal Iii', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(100, 104, 'M. DAVI', '0071949123', '2361', 'XI', 'L', '083133097915', NULL, '2006-11-24', 'KUALA TUNGKAL', 'SITI AMINAH', 'KELAPA GADING', '1506022411060003', 'Islam', '0', '0', 'Tungkal Harapan', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(101, 105, 'M. DENI', '0084584027', '2523', 'XI', 'L', NULL, NULL, '2008-02-22', 'betara kanan', 'nilawati', 'Betara Kanan', '1506122202080001', 'Islam', '5', NULL, 'BETARA KANAN', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(102, 106, 'M. FACHRY', '0086750958', '2524', 'XI', 'L', '085142325317', NULL, '2008-06-27', 'Kuala Tungkal', 'LIDAWATI', 'Perum Permata Hijau', '1506022706080002', 'Islam', '20', NULL, 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(103, 107, 'M. Fahriansyah', '0081522729', '2497', 'XI', 'L', '085789323156', NULL, '2008-08-29', 'Kuala Tungkal', 'Hana', 'Jl. H. A. Rauf', '1506022908080003', 'Islam', '20', '0', 'Patunas', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(104, 108, 'M. FATHUR RAMADHAN', '0067689011', '2312', 'XI', 'L', NULL, NULL, '2006-10-19', 'KUALA TUNGKAL', 'JUNAIDAH', 'JL. BERINGIN KUALA TUNGKAL', '1506021910060004', 'Islam', '0', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(105, 109, 'M. FEBRIAN KAHFI', '0078734432', '2458', 'XI', 'L', NULL, NULL, '2007-01-01', 'TANJUNG JABUNG BARAT', 'ARBIAH', 'JALAN KI HAJAR DEWANTARA', '1506020101070006', 'Islam', '2', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(106, 110, 'M. Fikri Salman', '0108383182', '2498', 'XI', 'L', '082179975234', NULL, '2010-02-15', 'TANJUNG JABUNG BARAT', 'SURYANI', 'BERINGIN UJUNG', '1506021502100002', 'Islam', '1', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(107, 111, 'm. ghopron wahid', '0088426487', '2558', 'XI', 'L', NULL, NULL, '2008-08-27', 'Kuala Tungkal', 'siti abasiah', 'Jalan Kihajar Dewantara', '1506022708080001', 'Islam', '13', NULL, 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(108, 112, 'M. GILANG RAMADAN', '0082327736', '2595', 'XI', 'L', NULL, NULL, '2008-09-22', 'SERDANG JAYA', 'JUMIATI', 'BLOK M', '1506042209080001', 'Islam', '9', '0', 'MANDALA JAYA', 'Kec. Betara', NULL, 'YA', NULL),
(109, 113, 'M. HADRI', '0085720059', '2393', 'XII', 'L', NULL, NULL, '2008-11-04', 'TANJUNG JABUNG BARAT', 'KHADIJAH', 'JALAN KIHAJAR DEWANTARA', '1506120402080002', 'Islam', NULL, NULL, 'PATUNAS', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(110, 114, 'M. HAFIZ AKBAR', '0091232323', '2525', 'XII', 'L', '081373588107', NULL, '2009-10-20', 'SUNGAI GEBAR', 'EKA WAHYUNI', 'DUSUN MEKAR KENCANA SUNGAI GEBAR', '1506122010090002', 'Islam', '1', '0', 'SUNGAI GEBAR', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(111, 115, 'M. IDI PANGESTU', '3073299843', '2337', 'XII', 'L', NULL, NULL, '2007-05-25', 'TANJAB BARAT', 'SITI ROHAYATI', 'JL. BERINGIN KUALA TUNGKAL', '1506022505070004', 'Islam', '0', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(112, 116, 'M. IKHSAN SUAIBI', '0081100877', '2426', 'XII', 'L', NULL, NULL, '2008-05-01', 'BETARA KANAN', 'ROSITA', 'JALAN BERINGIN', '1506120105080001', 'Islam', NULL, NULL, 'PATUNAS', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(113, 117, 'M. IKRAM BADALI', '0084927642', '2459', 'XII', 'L', NULL, NULL, '2008-02-20', 'BETARA KANAN', 'SITI HADIJAH', 'BETARA KANAN', '1506122002080002', 'Islam', NULL, NULL, 'BETARA KANAN', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(114, 118, 'M. ILHAM RAMADAN', '0087730136', '2394', 'XII', 'L', NULL, NULL, '2008-09-18', 'TANJUNG JABUNG BARAT', 'JASMIATI', 'BERINGIN UJUNG', '1506021809080002', 'Islam', '8', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(115, 119, 'M. IQROM RAYHAN', '0081068533', '2526', 'XII', 'L', '083121698425', NULL, '2008-10-09', 'Kuala Tungkal', 'SAIDAH', 'BTN Pengabuan Permai', '1506020910080002', 'Islam', '4', '0', 'Tungkal Iii', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(116, 120, 'M. LUTHFI HAKIM', '0098904126', '2527', 'XII', 'L', '083121614249', NULL, '2009-07-17', 'TANJUNG JABUNG BARAT', 'BASIAH', 'BERINGIN UJUNG', '1506021707090003', 'Islam', '1', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(117, 121, 'M. NAUFAL WAFII FADLURRAHMAN', '0094126670', '2499', 'XII', 'L', '085377559079', NULL, '2009-12-01', 'Kuala Tungkal', 'RENI KRISNA SEPTIYANI', 'Perum Permata Hijau Blok E', '1506020112090001', 'Islam', '12', NULL, 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(118, 122, 'M. NAUFAL ZAKI', '3088056776', '2460', 'XII', 'L', NULL, NULL, '2008-07-13', 'KUALA TUNGKAL', 'ELIS SURYANI', 'JALAN BERKAH 2 PARIT LAPIS', '1506021307080001', 'Islam', NULL, NULL, 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(119, 123, 'M. PADTLI RAMDANI', '0084328828', '2502', 'XII', 'L', NULL, NULL, '2008-09-08', 'KUALA TUNGKAL', 'MASTIAH', 'Jalan Kihajar Dewantara', '1506020809080003', 'Islam', '9', NULL, 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(120, 124, 'M. PRAYUDA ADHA', '0084827187', '2500', 'XII', 'L', NULL, NULL, '2008-12-09', 'Pulau Kijang', 'Sapna', 'jl siswa', '1506020912080002', 'Islam', NULL, NULL, 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(121, 125, 'M. REZEKI ROMADHAN', '0082635141', '2528', 'XII', 'L', NULL, NULL, '2008-12-15', 'TANJUNG JABUNG BARAT', 'LAMSIAH', 'JL. BTN SELEMPANG MERAH', '1506021512080001', 'Islam', '7', '0', 'SUNGAI NIBUNG', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(122, 126, 'M. RIANDRI', '3078228747', '2338', 'XII', 'L', NULL, NULL, '2006-11-10', 'BETARA KANAN', 'KHADIJAH', 'JL. BERINGIN KUALA TUNGKAL', '1506121011060002', 'Islam', '0', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(123, 127, 'm. ridwan', '0083657325', '2559', 'XII', 'L', NULL, NULL, '2008-12-24', 'kuala tungkal', 'jumaiyah', 'Parit 2', '1506022412080002', 'Islam', '2', NULL, 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(124, 128, 'M. RISKI WIJAYA', '0061852767', '2362', 'XII', 'L', '083133098416', NULL, '2006-05-22', 'KUALA TUNGKAL', 'PATIAH', 'JALAN AL FALAH', '1506022205060001', 'Islam', '10', '0', 'Tungkal Harapan', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(125, 129, 'M. RIZKI AZHARI', '0085818549', '2529', 'XII', 'L', '082289459970', NULL, '2008-04-08', 'KUALA TUNGKAL', 'NURHAYATI', 'JL. BERINGIN', '1506020804080001', 'Islam', '1', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(126, 130, 'M. RIZKI MAULANA', '0099113640', '2560', 'XII', 'L', NULL, NULL, '2009-08-15', 'Kuala Tungkal', 'MARIYANA', 'Jl. Kelapa Gading', '1506021508090005', 'Islam', NULL, NULL, 'Tungkal Harapan', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(127, 131, 'M. RIZKY HIDAYAT', '0088536965', '2461', 'XII', 'L', '081632240326', NULL, '2008-05-11', 'KUALA TUNGKAL', 'DAHLIA', 'BTN SELEMPANG MERAH.PARIT GOMPONG', '1506021105080001', 'Islam', '0', '0', 'SUNGAI NIBUNG', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(128, 132, 'm. rizqi mubarak', '0074686369', '2429', 'XII', 'L', NULL, NULL, '2007-03-17', 'betara kanan', 'rosita', 'dusun betara makmur', '1506121703070001', 'Islam', '4', '0', 'betara kanan', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(129, 133, 'M. SAHLAL MAHPUT', '3097817805', '2564', 'XII', 'L', NULL, NULL, '2009-02-14', 'Teluk Sialang', 'Rahmawita', 'Parit 10 Teluk Sialang', '1506021402090002', 'Islam', '5', NULL, 'TELUK SIALANG', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(130, 134, 'M. Syah Ronny Agung Widodo', '0085217966', '2395', 'XII', 'L', '081274008189', NULL, '2008-02-26', 'Kuala Tungkal', 'Rini Sri Astuti', 'Jl. Lorong Satria', '1506022602080003', 'Islam', '9', '0', 'Desa/Kel. Talang Babat', 'Kec. Muara Sabak Barat', NULL, 'YA', NULL),
(131, 135, 'M.ADIB FABIAN', '0089800907', '2430', 'XII', 'L', NULL, NULL, '2008-02-08', 'KUALA TUNGKAL', 'HELPI DIANI', 'JL. WONO ASRI', '1506020802080001', 'Islam', '4', '0', 'SUNGAI NIBUNG', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(132, 136, 'M.ALIF', '0081775999', '2522', 'XII', 'L', NULL, NULL, '2008-11-17', 'TANJUNG JABUNG BARAT', 'NURBIYAH', 'KUALA INDAH', '1506121711080002', 'Islam', '12', '0', 'KUALA INDAH', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(133, 137, 'M.ARNO RJA', '3074801574', '2313', 'XII', 'L', NULL, NULL, '2007-02-11', 'SUNGAI BANDUNG', 'HADIJAH', 'JL. BERINGIN KUALA TUNGKAL', '1404101102070001', 'Islam', '0', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(134, 138, 'M.HABIBI', '0063736621', '2314', 'XII', 'L', NULL, NULL, '2006-01-22', 'BETARA KANAN', 'NUR ASIYAH', 'JL. BERINGIN KUALA TUNGKAL', '1506042201060001', 'Islam', '0', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(135, 139, 'M.IQBAL', '0082561604', '2431', 'XII', 'L', '081368006599', NULL, '2008-03-03', 'Sumsel', 'IRA MAYASANTI', 'Jl. Kh. Dewantara', '1506110309080002', 'Islam', '15', '0', 'Patunas', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(136, 140, 'M.KHAIRULLAH', '0076579752', '2363', 'XII', 'L', NULL, NULL, '2007-04-03', 'KUALA TUNGKAL', 'Siti Aisyah', 'JL. BERINGIN KUALA TUNGKAL', '1506020304070002', 'Islam', '0', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(137, 141, 'M.RAFLI', '0084502529', '2432', 'XII', 'L', NULL, NULL, '2008-05-02', 'KUALA TUNGKAL', 'Siti Aminah', 'Jl Kihajar Dewantara', '1506020205080001', 'Islam', NULL, NULL, 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(138, 142, 'MABILA ORIZA SATIVA', '0082120719', '2364', 'XII', 'P', '081311967636', NULL, '2008-01-21', 'KUALA TUNGKAL', 'INDO AMMA', 'KOMPLEK BTN PERMATA HIJAU', '1506026101080003', 'Islam', '20', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(139, 143, 'MAISARAH NUR RIZKI', '0083460923', '2462', 'XII', 'P', '085368438099', NULL, '2008-03-10', 'Kuala tungkal', 'MARIANA', 'JL. BERINGIN UJUNG', '1506025003080004', 'Islam', '8', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(140, 144, 'Marhadian', '0099548618', '2594', 'XII', 'L', NULL, NULL, '2009-07-19', 'Pulau Burung', 'Santi', 'DUSUN ALAM SARI', '1404081907090003', 'Islam', '4', NULL, 'SUNGAI GEBAR', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(141, 145, 'MARLA ADINDA DEWINSA BAHRI', '0072021086', '2365', 'XII', 'P', '085809947669', NULL, '2007-11-28', 'Kuala Tungkal', 'Weny Priyani', 'Jl. Siswa Ujung', '1506024211070002', 'Islam', '2', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(142, 146, 'MARSYA AGUSTINA', '0096159606', '2561', 'XII', 'P', '082289519887', NULL, '2009-08-04', 'KUALA TUNGKAL', 'JUNITA SARI', 'Jl. Pangeran Diponogoro', '1506024408090001', 'Islam', '24', '0', 'Tungkal Harapan', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(143, 147, 'MAULY ALFHATY', '0081681794', '2398', 'XII', 'P', '088269720970', NULL, '2008-08-05', 'KUALA TUNGKAL', 'ASNAWATI', 'Jl. Dahlia', '1506024508080006', 'Islam', '1', '0', 'Tungkal IV Kota', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(144, 148, 'MESI LARASATI', '0069492114', '2485', 'XII', 'P', '083836353790', NULL, '2006-02-07', 'Kuala Tungkal', 'Laila', 'Lorong Sederhana', '1506024702060006', 'Islam', '8', '0', 'Kampung Nelayan', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(145, 149, 'MIA AULIA RAMADHANI', '0097885468', '2562', 'XII', 'P', '085383776186', NULL, '2009-09-08', 'KUALA TUNGKAL', 'NURSIHAN', 'H. HASYIM', '1506024809090002', 'Islam', '11', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(146, 150, 'MISTYA ARSILA', '3061313056', '2530', 'XII', 'P', NULL, NULL, '2006-11-16', 'KUALA TUNGKAL', 'NURHAYATI', 'JL. PARIT SATU DARAT', '1506025611060005', 'Islam', NULL, NULL, 'SRIWIJAYA', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(147, 151, 'MOHD. RIDHO NOVIAN', '0079025307', '2399', 'XII', 'L', NULL, NULL, '2007-10-31', 'TANJUNG JABUNG BARAT', 'MISRIAH', 'KELAPA GADING', '1506023110070003', 'Islam', '0', '0', 'TUNGKAL HARAPAN', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(148, 152, 'MUHAMAD RYHAN ALHAPIP', '0093558478', '2533', 'XII', 'L', NULL, NULL, '2009-07-30', 'P.10 TELUK SIALANG', 'YATI', 'DUSUN HIDAYAT', '1506023007090001', 'Islam', '5', '5', 'TELUK SIALANG', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(149, 153, 'MUHAMMAD AGUNG', '0086829469', '2501', 'XII', 'L', NULL, NULL, '2008-12-31', 'Kuala Tungkal', 'HERI HERMIYATI', 'jl. Kemakmuran', '1506023112100006', 'Islam', '0', '0', 'tungkla harapan', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(150, 154, 'MUHAMMAD ALFIN', '0084397994', '2433', 'XII', 'L', NULL, NULL, '2008-04-20', 'KUALA TUNGKAL', 'ARPIAH', 'KUALA INDAH', '1506122004080001', 'Islam', '2', '0', 'KUALA INDAH', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(151, 155, 'MUHAMMAD ALLEF', '3084560977', '2434', 'XII', 'L', NULL, NULL, '2008-01-26', 'MUAR JOHOR', 'RITA', 'Jl. Sriwijaya', '1403012601080001', 'Islam', NULL, NULL, 'SRIWIJAYA', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(152, 156, 'MUHAMMAD ALPIN KIROM', '0071740111', '2340', 'XII', 'L', '082253246692', NULL, '2007-06-07', 'Kuala Tungkal', 'Asma Ridha', 'Jl. K. H Dewantara', '1506020706070004', 'Islam', '0', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(153, 157, 'MUHAMMAD ANDRE', '0074121426', '2401', 'XII', 'L', NULL, NULL, '2007-11-16', 'Kuala Tungkal', 'MASNI', 'Jl. Panglima H. saman', '1506021611070005', 'Islam', '8', NULL, 'Tungkal III', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(154, 158, 'muhammad aufa nafil', '0076828375', '2315', 'XII', 'L', '088706531252', NULL, '2007-05-12', 'kuala tungkal', 'SUCI WARNI', 'ketapang', '1506021205070004', 'Islam', '6', '0', 'Tungkal Harapan', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(155, 159, 'Muhammad Daffa Al Amin', '0087600768', '2435', 'XII', 'L', '082176416244', NULL, '2008-03-23', 'Kuala Tungkal', 'Sri Costilawati', 'Jl. Kihajar Dewantara', '1506022303080008', 'Islam', '15', '0', 'Tungkal IV Kota', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(156, 160, 'MUHAMMAD FADLI', '0061255605', '2341', 'XII', 'L', NULL, NULL, '2006-08-08', 'BETARA KIRI', 'NURJANAH', 'JL. BERINGIN KUALA TUNGKAL', '1506120808060001', 'Islam', '0', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(157, 161, 'Muhammad Fairi Al Khatir', '0097404674', '2503', 'XII', 'L', '082282660954', NULL, '2009-10-09', 'Kuala Tungkal', 'Siwa', 'Jl. A. Rahman 1', '1506020910090003', 'Islam', '29', '0', 'Patunas', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(158, 162, 'Muhammad Ihsan Ramadani', '0078806374', '2316', 'XII', 'L', '083133098503', NULL, '2007-10-09', 'Kuala Tungkal', 'Een Nurhayati', 'JALAN KENANGA PUTIH', '1506020910070003', 'Islam', '7', '0', 'Tungkal Iv Kota', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(159, 163, 'MUHAMMAD IQBAL', '0064514053', '2366', 'XII', 'L', '088287901772', NULL, '2006-09-15', 'Sungai Guntung', 'Rahmatiah', 'Jl. Barito I', '1404081509060003', 'Islam', '0', '0', 'SUNGAI NIBUNG', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(160, 164, 'MUHAMMAD MARFEL', '0083422236', '2531', 'XII', 'L', '081318429960', NULL, '2008-12-09', 'Tanjung Jabung Barat', 'MARIAYAH', 'Jl. Kelapa Gading Gang Kenanga Putih', '1506020606580001', 'Islam', '9', '0', 'Tungkal Harapan', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(161, 165, 'MUHAMMAD MOHAN ALTHAF', '0094474563', '2504', 'XII', 'L', '081274965773', NULL, '2009-09-22', 'KUALA TUNGKAL', 'NADIRA', 'jl siswa', '1506022209090001', 'Islam', NULL, NULL, 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(162, 166, 'MUHAMMAD NOR AULIA', '0079182596', '2317', 'XII', 'L', '082373899962', NULL, '2007-05-22', 'KUALA TUNGKAL', 'IKA AGUSTINA', 'P. DIPONEGORO', '1506022205070005', 'Islam', '15', '0', 'Tungkal Iv Kota', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(163, 167, 'MUHAMMAD RAFA', '0077027409', '2464', 'XII', 'L', '083172222349', NULL, '2007-03-06', 'KUALA TUNGKAL', 'MARDIANA', 'JL. KAPTEN PIRE TEDEAN', '1506024107070038', 'Islam', '27', '0', 'TUNGKAL TIGA', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(164, 168, 'MUHAMMAD RENDRA', '0083510638', '2465', 'XII', 'L', '083121692827', NULL, '2007-11-08', 'KUALA TUNGKAL', 'RIDAWATI', 'PATUNAS', '1506020811070001', 'Islam', '12', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(165, 169, 'MUHAMMAD RIDHO AGUSTIAN', '0097828684', '2532', 'XII', 'L', NULL, NULL, '2009-08-02', 'TANJUNG JABUNG BARAT', 'NURLELA', 'KUALA INDAH', '1506120208090001', 'Islam', '0', '0', 'KUALA INDAH', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(166, 170, 'MUHAMMAD RISKI', '0074589614', '2367', 'XII', 'L', NULL, NULL, '2007-01-15', 'KUALA TUNGKAL', 'DEWI SADAH', 'JL. BERINGIN KUALA TUNGKAL', '1506021501070003', 'Islam', '0', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(167, 171, 'Muhammad Rizky', '0071797313', '2368', 'XII', 'L', '082180605277', NULL, '2007-03-22', 'Kuala Tungkal', 'Isdawati', 'Parit 1 Darat', '1506022203070002', 'Islam', '11', '0', 'SRIWIJAYA', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(168, 172, 'MUSLIMAH APRILIA', '3098158835', '2505', 'XII', 'P', NULL, NULL, '2009-04-30', 'KUALA TUNGKAL', 'HAIRIAH', 'TELUK SIALANG', '1506027004090001', 'Islam', NULL, NULL, 'TELUK SIALANG', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(169, 173, 'Mutia Khansa', '0087938932', '2437', 'XII', 'P', NULL, NULL, '2008-08-05', 'Kuala Tungkal', 'Aan Asnah', 'Jalan Raya Pancalang', '1506024508080004', 'Islam', '2', '2', 'Pancalang', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(170, 174, 'NABILAH NA\'ILAH SALWAA', '0086172312', '2466', 'XII', 'P', NULL, NULL, '2009-05-18', 'Mendahara Ilir', 'Siti Nurbaya', 'Jl Batang Hari', '1507035805090003', 'Islam', '0', '0', 'Mendahara Ilir', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(171, 175, 'NADIA AYU SEPTINA', '0074853068', '2402', 'XII', 'P', '085346863199', NULL, '2006-09-08', 'Kuala Tungkal', 'NANIK ASIH', 'Sido Mulyo', '1506024809060003', 'Islam', '10', NULL, 'Sriwijaya', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(172, 176, 'NAFIISAH TURESTA', '0083695920', '2575', 'XII', 'P', '088268257231', NULL, '2008-11-14', 'TAPAN', 'Tuti Mustapa Dewi', 'Perumahan Permata Hijau Blok H, No. 10', '1506025411080001', 'Islam', '20', '0', 'Patunas', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(173, 177, 'nafila marwa', '0073245753', '2342', 'XII', 'P', '085366046744', NULL, '2007-05-12', 'kuala tungkal', 'suci warni', 'ketapang', '1506025205070004', 'Islam', '6', '0', 'Tungkal Harapan', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(174, 178, 'Naila Safira', '0082576001', '2403', 'XII', 'P', '082378036776', NULL, '2008-07-04', 'TANJUNG JABUNG BARAT', 'Susiani', 'Jl. Kihajar Dewantara', '1506024407080001', 'Islam', '2', '0', 'Tungkal III', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(175, 179, 'Najla Nabilla', '0071683067', '2369', 'XII', 'P', '082380158462', NULL, '2007-06-27', 'Kuala Tungkal', 'Sri Manita', 'Parit 2 BTN Permata Hijau Blok D', '1506026706070004', 'Islam', '0', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(176, 180, 'NAJWA AQELA REZKI', '0088270250', '2404', 'XII', 'P', '085266022982', NULL, '2008-05-07', 'KUALA TUNGKAL', 'KHAIRUNNISA', 'KESEJAHTERAAN', '1506024705080003', 'Islam', '19', '0', 'TUNGKAL 3', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(177, 181, 'NAURA NISA SALSABILA', '0082164929', '2467', 'XII', 'P', '088276318254', NULL, '2008-06-23', 'Jambi', 'Herni Zayanti', 'Syarief Hidayatullah', '1506026306080002', 'Islam', '13', '0', 'Desa/Kel. Tungkal Ii', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(178, 182, 'NAYSILA WINI SAPUTRI', '0091727467', '2534', 'XII', 'P', '085838384075', NULL, '2009-01-03', 'JAMBI', 'HARYANI', 'Jl. H. M. Laban Parit Lapis', '1506024301090002', 'Islam', '1', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(179, 183, 'NAZA ADYA SILVANA', '0071123940', '2370', 'XII', 'P', '083133097921', NULL, '2007-10-11', 'KUALA TUNGKAL', 'AGUS LINA', 'KELAPA MANIS', '1506025110070001', 'Islam', '13', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(180, 184, 'Nazifatus Sabila', '0081128667', '2565', 'XII', 'P', '085363819540', NULL, '2008-11-14', 'Tanjung Jabung Barat', 'Sumiati', 'Parit 2', '1506025411080003', 'Islam', '2', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(181, 185, 'NAZWATUN AZIZAH', '0092326536', '2468', 'XII', 'P', NULL, NULL, '2009-05-12', 'KUALA TUNGKAL', 'MULIYANA', 'KAMPUNG NELAYAN', '1506025205090001', 'Islam', '0', '0', 'TUNGKAL 3', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(182, 186, 'NIA RAMADANI', '0058262291', '2371', 'XII', 'P', NULL, NULL, '2005-10-25', 'K. Tungkal', 'Megawati', 'Jl. KIhajar Dewantara', '1404026510050002', 'Islam', NULL, NULL, 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(183, 187, 'NIDAURRAHMAH', '0092103128', '2586', 'XII', 'P', NULL, NULL, '2009-06-22', 'TANJUNG JABUNG BARAT', 'TUMIRAH', 'DUSUN ALAM SARI', '1506126206090001', 'Islam', '4', NULL, 'SUNGAI GEBAR', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(184, 188, 'NOPRIYANSAH', '0094399429', '2535', 'XII', 'L', '089531627194', NULL, '2009-11-19', 'TANJUNG JABUNG BARAT', 'HALIMAH', 'Pulau Pinang', '1506121911090002', 'Islam', '7', '0', 'BETARA KANAN', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(185, 189, 'Novita Enjelina Manurung', '0068559619', '2372', 'XII', 'P', '085265498911', NULL, '2006-05-23', 'Torganda', 'Tiorlan Lumban Toruan', 'Jl Beringin', '1223046305060002', 'Kristen', '0', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(186, 190, 'NUR ANISA', '0099861105', '2566', 'XII', 'P', NULL, NULL, '2008-09-28', 'KUALA INDAH', 'ARBAIYAH', 'KUALA INDAH', '1506126809080001', 'Islam', '0', '0', 'KUALA INDAH', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(187, 191, 'NUR JHOHRA', '0097392555', '2536', 'XII', 'P', NULL, NULL, '2009-05-27', 'KUALA TUNGKAL', 'ASMAWATI', 'Jalan Parit Lapis', '1506026705090002', 'Islam', '14', NULL, 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(188, 192, 'Nur Milah Alifah', '0074778742', '2438', 'XII', 'P', '085268244831', NULL, '2007-12-28', 'Kuala Tungkal', 'Siti Masitah', 'Jl. H. Hasyim', '1506026812070001', 'Islam', '11', '0', 'Patunas', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(189, 193, 'NURAINI AZURA', '0087270692', '2405', 'XII', 'P', '085283458677', NULL, '2008-01-19', 'TANJUNG JABUNG BARAT', 'MAHMUDAH', 'KIHAJAR DEWANTARA', '1506025901080001', 'Islam', '11', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(190, 194, 'NURAMALIYANA', '3093310383', '2537', 'XII', 'P', NULL, NULL, '2009-02-19', 'Tanjung Jabung Barat', 'Manisah', 'Jl. Parit Satu Darat', '1506025902090002', 'Islam', '13', NULL, 'SRIWIJAYA', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(191, 195, 'NURFADILAH', '0089050618', '2469', 'XII', 'P', NULL, NULL, '2008-08-31', 'KUALA INDAH', 'FITRIYANI', 'KUALA INDAH', '1506127108080001', 'Islam', '5', '0', 'KUALA INDAH', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(192, 196, 'NURHAPNI', '0091190344', '2567', 'XII', 'P', NULL, NULL, '2009-05-14', 'Kuala Tungkal', 'Naimah', 'Jl Nurul Yaqin', '1506025405090003', 'Islam', '2', '0', 'Desa/Kel. Kuala Indah', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(193, 197, 'NURUL FARADILA', '3064301607', '2470', 'XII', 'P', NULL, NULL, '2006-03-23', 'SINAR KALIMANTAN', 'FATMAWATI', 'JALAN SULAWESI 2', '1507036303060001', 'Islam', NULL, NULL, 'TELUK SIALANG', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(194, 198, 'PRAYOGA', '0072185844', '2590', 'XII', 'L', '081273690251', NULL, '2007-10-27', 'Betara Kiri', 'IPANA', 'Betara Kiri', '1506122710070004', 'Islam', '7', '0', 'BETARA KIRI', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(195, 199, 'PUTRI NOVITA', '0081564391', '2320', 'XII', 'P', '085768063191', NULL, '2008-03-15', 'PATI', 'SITI ZUMROTUN', 'Parit Muda', '1506125503080001', 'Islam', '22', '0', 'Desa/Kel. BETARA KANAN', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(196, 200, 'PUTRI PIONA', '0086145255', '2439', 'XII', 'P', '085893434134', NULL, '2008-12-13', 'MENDAHARA ILIR', 'MERIANA', 'Berkah / Beringin Ujung', '1507035312080002', 'Islam', '8', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(197, 201, 'RADEN DAFA AL BAIHAQI', '0094371598', '2568', 'XII', 'L', NULL, NULL, '2009-10-29', 'KUALA TUNGKAL', 'MARLINA', 'KUALA INDAH', '1506122910090002', 'Islam', '0', '0', 'KUALA INDAH', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(198, 202, 'RAHMA DELA', '0085364284', '2440', 'XII', 'P', NULL, NULL, '2008-11-02', 'KUALA TUNGKAL', 'MUSDAYATI', 'JALAN KIHAJAR DEWANTARA', '1506024211080001', 'Islam', NULL, NULL, 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(199, 203, 'RAHMA WATI', '0085119774', '2373', 'XII', 'P', '083133098702', NULL, '2008-01-24', 'Sei Sijenggi', 'Ernawati', 'Jl Kihajar Dewantara', '1218026401080005', 'Islam', '0', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(200, 204, 'RAHMAH', '0095425016', '2583', 'XII', 'P', NULL, NULL, '2009-02-17', 'TANJUNG JABUNG BARAT', 'ATUN HASANAH', 'PARIT 10', '1506125702091001', 'Islam', '12', '0', 'TANJUNG PASIR', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(201, 205, 'Rahman Pratama', '3084091393', '2441', 'XII', 'L', '083174020800', NULL, '2008-06-05', 'Parit Satu', 'Roesmita', 'Karya Jaya', '1506120506080001', 'Islam', NULL, NULL, 'Suak Labu', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(202, 206, 'Rahmat Hidayat', '0092450799', '2507', 'XII', 'L', NULL, NULL, '2009-06-13', 'Kotabaru', 'Saripah', 'Jl. Prof Sri Soedewi', '1404091306090001', 'Islam', NULL, NULL, 'SUNGAI NIBUNG', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(203, 207, 'RAHMAT JUNADI', '0093359412', '2538', 'XII', 'L', NULL, NULL, '2009-09-26', 'Tanjung jabung barat', 'Wati', 'Betara Kanan', '1506062609090002', 'Islam', '12', '0', 'Talang Makmur', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(204, 208, 'RAHMAT RANDY DWI PUTRA', '0083443001', '2442', 'XII', 'L', '085253288117', NULL, '2008-12-24', 'KUALA TUNGKAL', 'ASMINARTI,S.Pd', 'BTN SELEMPANG MERAH', '1506022412080005', 'Islam', '7', '0', 'SUNGAI NIBUNG', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(205, 209, 'RAIHAN KURNIA SYAPUTRA', '0073636443', '2508', 'XII', 'L', NULL, NULL, '2007-11-16', 'Kuala Tungkal', 'Nur hasanah', 'Jl. Imam bonjol', '1506021611070006', 'Islam', NULL, NULL, 'Tungkal Empat Kota', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(206, 210, 'RAINA TASDIA', '0075405484', '2584', 'XII', 'P', '085269763615', NULL, '2007-08-19', 'BETARA KIRI', 'FARIDAH', 'Kampung Tengah', '1506125908070001', 'Islam', '3', '0', 'BETARA KIRI', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(207, 211, 'RAPI ACHMAD', '0084852143', '2591', 'XII', 'L', NULL, NULL, '2008-07-27', 'Tanjung Jabung Barat', 'BASIYAH', 'PARIT 9 TENGAH', '1506122707080001', 'Islam', '2', NULL, 'Tanjung Pasir', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(208, 212, 'RATU SIMA', '0074952416', '2539', 'XII', 'P', NULL, NULL, '2007-06-05', 'PARIT ATONG', 'AISAH', 'Jalan Siswa Ujung', '1506044506070002', 'Islam', '2', '0', 'Kuala Indah', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(209, 213, 'RIAN', '0044696597', '2343', 'XII', 'L', '083133098420', NULL, '2004-10-07', 'Kuala tungkal', 'SITI PATIMAH', 'JL. BERINGIN UJUNG', '1506020710040003', 'Islam', '8', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL);
INSERT INTO `siswa` (`siswa_id`, `user_id`, `nama_lengkap`, `nisn`, `nis`, `kelas`, `jenis_kelamin`, `no_siswa`, `no_ortu`, `tanggal_lahir`, `tempat_lahir`, `nama_ibu`, `alamat`, `nik`, `agama`, `rt`, `rw`, `kelurahan`, `kecamatan`, `foto_siswa`, `naik_kelas`, `update_at`) VALUES
(210, 214, 'Ridho Rizqullah', '0099328396', '2569', 'XII', 'L', '085384158396', NULL, '2009-07-04', 'Kuala Tungkal', 'Jumariah', 'Ki Hajar Dwwantara', '1506020407090005', 'Islam', '13', '0', 'Patunas', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(211, 215, 'RIFA RAHMADANI', '0089707512', '2577', 'XII', 'P', NULL, NULL, '2008-03-15', 'sungai saren', 'NURBAITI', 'Sungai Saren', '1506115503080002', 'Islam', NULL, NULL, 'Desa/Kel. BERAM ITAM KIRI', 'Kec. Bram Itam', NULL, 'YA', NULL),
(212, 216, 'RIFKA ASYKA  ZAFIRA', '0085949400', '2406', 'XII', 'P', '082181366728', NULL, '2008-10-09', 'Kuala Tungkal', 'EKA EFRIA LISA', 'Kalimantan', '1506024910080005', 'Islam', '14', '0', 'Desa/Kel. Tungkal Ii', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(213, 217, 'RIRI RINJANI KADHITA', '0096308132', '2509', 'XII', 'P', '08877366765', NULL, '2009-02-21', 'Kuala Tungkal', 'SANTI SARIPATI', 'Jl. Nasional', '1506026102090001', 'Islam', '2', '0', 'Tungkal Harapan', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(214, 218, 'RISKI EGI YANTI', '0051188462', '2374', 'XII', 'P', '082286190923', NULL, '2005-01-26', 'Jambi', 'NURYATI UMI MAKSUMA', 'Jl Andalas', '1571077001050021', 'Islam', '0', '0', 'Tungkal Iv Kota', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(215, 219, 'RIZKA AMELIA', '0078619043', '2321', 'XII', 'P', NULL, NULL, '2007-07-30', 'BETARA KANAN', 'MARDIANA', 'JL. BERINGIN KUALA TUNGKAL', '1506127007070001', 'Islam', '0', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(216, 220, 'Rizki Rahmat', '0053892635', '2344', 'XII', 'L', '083121532366', NULL, '2005-06-12', 'Kuala Tungkal', 'Ani Yusnita', 'Jalan Kihajar Dewantara', '1506021206050004', 'Islam', '15', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(217, 221, 'RIZKY ADITYA', '0092927299', '2540', 'XII', 'L', '082390192310', NULL, '2009-02-21', 'TALANG P. DEWA', 'MARYANI AMELISHA PUTRI', 'JL.KETAPANG GANG DAMAI', '1803062102090002', 'Islam', '5', '0', 'TUNGKAL HARAPAN', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(218, 222, 'SA\'ADATUL HUSNA', '3095404487', '2510', 'XII', 'P', NULL, NULL, '2009-03-06', 'TANJUNG JABUNG BARAT', 'SANIAH', 'Jl. Jend. Sudirman', '1506024603090003', 'Islam', NULL, NULL, 'Sriwijaya', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(219, 223, 'SAFA\'AT RUDIANSYAH', '0087865776', '2407', 'XII', 'L', NULL, NULL, '2008-11-10', 'Sungai Gebar ', 'JURAIDAH', 'Prt 2 Ilir', '1506121011090001', 'Islam', '1', '0', 'Sungai Gebar ', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(220, 224, 'SAFIRA', '0072397690', '2511', 'XII', 'P', '082182142384', NULL, '2007-12-20', 'KUALA TUNGKAL', 'JUMIAH', 'BERINGIN UJUNG', '1506026012070004', 'Islam', '1', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(221, 225, 'SAFRIANDI', '0069317004', '2322', 'XII', 'L', NULL, NULL, '2006-07-22', 'BETARA KANAN', 'Hadijah', 'JL. BERINGIN KUALA TUNGKAL', '1506042207060002', 'Islam', '0', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(222, 226, 'SAFRIANTI', '0067834972', '2345', 'XII', 'P', NULL, NULL, '2006-07-22', 'BETARA KANAN', 'HADIJAH', 'JL. BERINGIN KUALA TUNGKAL', '1506046207060001', 'Islam', '0', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(223, 227, 'SAHRIYANTO', '0075814514', '2375', 'XII', 'L', NULL, NULL, '2007-07-23', 'Sungai Limau', 'Jaimah', 'Sungai Limau', '1506022307070008', 'Islam', '0', '0', 'TELUK SIALANG', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(224, 228, 'SAPRIZAL', '0075236724', '2408', 'XII', 'L', NULL, NULL, '2007-06-19', 'KUALA TUNGKAL', 'KHADIJAH', 'JL.BERINGIN', '1506021906070002', 'Islam', '14', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(225, 229, 'Sasta Julia Normahendra', '0076277910', '2347', 'XII', 'P', NULL, NULL, '2007-07-08', 'BATAM', 'Nurlela', 'Jl. Sriwijaya', '1506024807070001', 'Islam', '2', '1', 'Tungkal Iv Kota', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(226, 230, 'Sismiati Zahara', '0077377053', '2323', 'XII', 'P', '081276694649', NULL, '2007-10-26', 'Kuala Tungkal', 'Siti Rahayu', 'Jl. Jenderal Sudirman', '1506026610070004', 'Islam', '10', NULL, 'Tungkal Iv Kota', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(227, 231, 'SITI FATIMAH', '0096031284', '2541', 'XII', 'P', '083133099733', NULL, '2009-06-24', 'Tanjung Jabung Barat', 'MASITAH', 'Panglima H. Saman', '1506026406090003', 'Islam', '8', '0', 'Tungkal Iii', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(228, 232, 'SITI FAUZA AZZAHRA', '0081080837', '2409', 'XII', 'P', '085268930946', NULL, '2008-01-19', 'TANJUNG JABUNG BARAT', 'SITI MASRURO', 'RT. 06', '1506125901080001', 'Islam', '6', '0', 'SUNGAI DUALAP', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(229, 233, 'SITI HADIJAH', '0084461066', '2570', 'XII', 'P', NULL, NULL, '2008-09-20', 'Tanjung jabung barat', 'ST aminah', 'Pulau Pinang', '1506126009080001', 'Islam', '4', NULL, 'Desa/Kel. BETARA KANAN', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(230, 234, 'SITI HAFIZA', '0084912877', '2472', 'XII', 'P', '082181946769', NULL, '2008-10-16', 'Kuala Tungkal', 'SUMERI', 'Jl. Beringin Ujung', '1506025611080002', 'Islam', NULL, NULL, 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(231, 235, 'SITI KHADIJAH', '0087292620', '2444', 'XII', 'P', '089512380281', NULL, '2008-07-21', 'KUALA TUNGKAL', 'KASTINAH', 'PERUMNAS LRG BANTEN 2', '1506026107080001', 'Islam', '0', '0', 'SUNGAI NIBUNG', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(232, 236, 'SITI ZULAIKA', '0072828782', '2324', 'XII', 'P', '085256526302', NULL, '2007-03-17', 'Kuala Tungkal', 'Nilawati', 'Jl. K.H Dewantara', '1506025703070001', 'Islam', '4', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(233, 237, 'SUCI ARIYANTI', '0085248340', '2512', 'XII', 'P', '082285989673', NULL, '2008-01-16', 'KUALA TUNGKAL', 'SITI RUDIAH', 'Jalan Parit Lapis', '1506025601080002', 'Islam', '14', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(234, 238, 'SULTAN NAUFAL ISKANDAR', '0068433943', '2480', 'XII', 'L', NULL, NULL, '2006-11-22', 'Kuala Tungkal', 'Mursinah', 'Jl. Kh. Dewantara', '1506022211060002', 'Islam', '6', NULL, 'Patunas', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(235, 239, 'SYAHIRA MARYANDA PUTRI', '0087408355', '2477', 'XII', 'P', NULL, NULL, '2008-03-24', 'Kuala Tungkal', 'Umi Soidah', 'Kihajar Dewantara', '1506026103080001', 'Islam', '9', '0', 'Patunas', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(236, 240, 'SYARI FATUL AULIA', '0084863255', '2474', 'XII', 'P', NULL, NULL, '2008-09-01', 'PARIT H. YAKUB', 'SITI RUSMITA', 'JL.KESAKTIAN', '1506114109080001', 'Islam', '4', '0', 'BRAM ITAM KIRI', 'Kec. Bram Itam', NULL, 'YA', NULL),
(237, 241, 'SYILLA NADIRA CHAIRUNNISA', '0093601516', '2542', 'XII', 'P', '08127828521', NULL, '2009-03-30', 'Kuala Tungkal', 'NILA TASWINI', 'Jl. Kelapa Gading', '1506027003090001', 'Islam', '11', '0', 'Tungkal Harapan', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(238, 242, 'Tesa Ferbriana Salsabela', '0093974873', '2572', 'XII', 'P', '082183308208', NULL, '2009-02-26', 'Tanjung Jabung Barat', 'Susanti', 'Jl. Poros BTN Pengabuan Permai Bengkinang Ujung', '1506026602090003', 'Islam', '4', '0', 'Tungkal III', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(239, 243, 'Tiara Arumulan', '0087925115', '2513', 'XII', 'P', '082179862406', NULL, '2008-11-06', 'Kuala Tungkal', 'Apryaningsih', 'Jl.  Ki Hajar Dewantara Asrama Kodim', '1506024611080001', 'Islam', '4', '0', 'Patunas', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(240, 244, 'TSANIA AZZAHRA', '0094068520', '2543', 'XII', 'P', '081373519237', NULL, '2009-07-28', 'Tanjung Jabung Barat', 'NURY HERAWATI', 'Jl. Musi Barito', '1506026807090002', 'Islam', '6', '0', 'SUNGAI NIBUNG', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(241, 245, 'UAIS AL QARIN', '0085597288', '2410', 'X', 'P', '083171258826', NULL, '2008-12-30', 'Kuala Tungkal', 'Rukiyah', 'Jl. Jendral Sudirman', '1506027012080005', 'Islam', '10', NULL, 'Patunas', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(242, 246, 'UMMI ISSOFA ASDIANTI', '0096297082', '2573', 'X', 'P', NULL, NULL, '2009-04-13', 'Sungai Bahar', 'WIWIK FUJI ASTUTIK', 'Jl Kihajar Dewantara', '1505075304090002', 'Islam', NULL, NULL, 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(243, 247, 'VALENE CALYSTA ANDRIANE', '0095426599', '2574', 'X', 'P', '085282868955', NULL, '2009-03-13', 'Kuala Tungkal', 'KARTINI', 'Jl. Kemakmuran', '1506025303090001', 'Kristen', '1', '0', 'Tungkal IV Kota', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(244, 248, 'VANISA RAHMA SAFIRA', '0089137090', '2445', 'X', 'P', '085840914832', NULL, '2008-05-01', 'KUALA TUNGKAL', 'DESSY KARLINA', 'Jl. Jenderal Ahmad Yani', '1506024105080002', 'Islam', '4', '0', 'Tungkal Iv Kota', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(245, 249, 'WAHYUNI WULANDARI', '0081416129', '2446', 'X', 'P', NULL, NULL, '2008-01-30', 'TANJUNG JABUNG BARAT', 'Muhyati', 'SUNGAI TAPAH', '1506027001080002', 'Islam', '0', '0', 'Kuala Dasal', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(246, 250, 'YETI ANGGRAINI', '0068941863', '2348', 'X', 'P', '082287445106', NULL, '2006-04-07', 'KUALA TUNGKAL', 'Nurbaiti', 'jl harapan', '1506044704060002', 'Islam', '9', '0', 'Tungkal Harapan', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(247, 251, 'YOGA AGUSTIARSA', '0086070245', '2475', 'X', 'L', '083121280500', NULL, '2008-08-31', 'Kuala Tungkal', 'Nurbaya', 'Parit II Lorong Arrahman', '1506023108080005', 'Islam', '11', '0', 'Patunas', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(248, 252, 'YOGI AGUSTIANSA', '0085251705', '2412', 'XII', 'L', '083898562995', NULL, '2008-08-31', 'Kuala Tungkal', 'Nurbaya', 'Syarief Hidayatullah', '1506023108080006', 'Islam', '13', '0', 'Tungkal II', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(249, 253, 'YOLA WULANDARI', '0079709285', '2326', 'XII', 'P', '085768275442', NULL, '2007-06-25', 'MUARA SABAK', 'SOPIAH', 'Kuala Indah', '1571026507070082', 'Islam', '0', '0', 'Kuala Indah', 'Kec. Kuala Betara', NULL, 'YA', NULL),
(250, 254, 'ZAKIA NAZWA', '0072164362', '2349', 'XII', 'P', '085282776248', NULL, '2007-05-26', 'KUALA TUNGKAL', 'RUSMINI', 'JL.BERINGIN', '1506026605070005', 'Islam', '14', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(251, 255, 'ZENNY PRAMUDITA', '0071731300', '2377', 'XII', 'P', '083133097933', NULL, '2007-03-25', 'Kuala Tungkal', 'Iperita Sundari', 'pangeran diponegori lrg. kenanga lama', '1506026503070002', 'Islam', '15', '0', 'Tungkal Iv Kota', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(252, 256, 'ZIKRI HAKIM', '0087379691', '2413', 'XI', 'L', NULL, NULL, '2008-07-08', 'KUALA TUNGKAL', 'NURIAH', 'JL.KIHAJAR DEWANTARA', '1506020807080001', 'Islam', '15', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(253, 257, 'ZULFA AZIZAH', '0093148831', '2544', 'XI', 'P', NULL, NULL, '2009-07-18', 'KUALA TUNGKAL', 'FARIDAH', 'Jl Kihajar Dewantara', '1506025807090001', 'Islam', '18', '0', 'PATUNAS', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(254, 258, 'ZULFIKAR AZMI', '0093746021', '2514', 'XI', 'L', '085368941288', NULL, '2009-10-25', 'Kuala Tungkal', 'SITI ZAHRAH', 'BTN Pengabuan Permai', '1506022510090003', 'Islam', '4', '0', 'Tungkal Iii', 'Kec. Tungkal Ilir', NULL, 'YA', NULL),
(255, 259, 'ZULKARNAIN FADILLAH', '0076518714', '2414', 'XI', 'L', NULL, NULL, '2007-06-18', 'BETARA KANAN', 'SITI FATIMAH', 'BETARA MAKMUR', '1506041806070001', 'Islam', '11', '0', 'BETARA KANAN', 'Kec. Kuala Betara', NULL, 'YA', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','guru','siswa') NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `create_at` datetime DEFAULT current_timestamp(),
  `session_id` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `current_login` datetime DEFAULT NULL,
  `status_akun` enum('1','2') NOT NULL DEFAULT '1',
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`, `email`, `create_at`, `session_id`, `last_login`, `current_login`, `status_akun`, `update_at`) VALUES
(1, 'admin', '$2y$10$zgjDlFsLrxx1GfEGxzaj6.k0B64IY2Uvy6c8r9azfmwYt6pqAdSIu', 'admin', 'admin@admin.com', '2025-05-28 21:36:37', '8cqp3n5iut2gf186v3obktcmgqsp42it', '2025-09-02 18:02:23', '2025-09-03 10:15:06', '1', NULL),
(4, 'aini', '$2y$10$Yx3Xx/0s8tjEA/L6gbXT1eLOnTbSR4OVTLyqgn95Rs1pgjiP0qaJO', 'guru', 'nurainitasari@gmail.com', '2025-05-29 09:19:32', NULL, '2025-09-03 10:51:00', '2025-09-03 10:13:56', '1', '2025-09-02 18:20:27'),
(5, 'ABDUL HAKIM', '$2y$10$HEcx.uGUklGkmCFpwuaUc.F.e.0FpZyQWdUOUG352sECKwY3kutiC', 'siswa', 'abdul.hakim@gmail.com', '2025-06-19 15:29:26', NULL, '2025-09-02 17:25:07', '2025-09-02 17:24:31', '1', NULL),
(6, 'ABDUL SHOMAD', '$2y$10$sXpg2tWglKzxdFNxdLshVeFzmsj.0wlkmHJOpIRi6CwXLhfeA0Qzy', 'siswa', 'abdul.shomad@gmail.com', '2025-06-19 15:29:27', NULL, '2025-09-02 17:24:17', '2025-09-02 16:18:44', '1', NULL),
(7, 'ADINDA TRIANI', '$2y$10$YiSfIQEORd/ZghpvkXWbj.hcf48IfDt4L0uc1/o.DBfDg8P7DbCym', 'siswa', 'adinda.triani@gmail.com', '2025-06-19 15:29:27', NULL, NULL, NULL, '1', NULL),
(8, 'AGUNG WAHYU PRASETYO', '$2y$10$Y7FkQwvYgFe6wx5xjKZQJ.zErg00MJnOzf0lVYrqhJTW9K8zYhMmS', 'siswa', 'agung.wahyu.prasetyo@gmail.com', '2025-06-19 15:29:27', NULL, NULL, NULL, '1', NULL),
(9, 'AGUS SALIM', '$2y$10$sGjfu3lS5G5vsaS2zvu4c.gVDVvfhnq2Uli8lzm1fEhPxBfRqD1sm', 'siswa', 'agus.salim@gmail.com', '2025-06-19 15:29:27', NULL, NULL, NULL, '1', NULL),
(10, 'Ahmad Dani', '$2y$10$OqtcgjcDp4UTGFg/0pZZV.EBPgTyqxcK99VdN6ZZgVvCdRx6f.d/O', 'siswa', 'ahmad.dani@gmail.com', '2025-06-19 15:29:27', NULL, NULL, NULL, '1', NULL),
(11, 'Ahmad Kenzie Al-Banna', '$2y$10$SRm4fND2OzWyQvFDSgHkGuSfvuGML3zr717wmdcnKHA2hgDNLYv66', 'siswa', 'ahmad.kenzie.albanna@gmail.com', '2025-06-19 15:29:27', NULL, NULL, NULL, '1', NULL),
(12, 'AHMAD ZAINURI', '$2y$10$Ud.JAqpFX..Zyc23dPOd0eGBPhAXd.pyX7UmvnUvCJ2Z3karYNktO', 'siswa', 'ahmad.zainuri@gmail.com', '2025-06-19 15:29:27', NULL, NULL, NULL, '1', NULL),
(13, 'AHMAT ALI HERLANSAH', '$2y$10$Zurn4eOBJV9SZHr927ufEebHxIjCR7J9/aX6qvllKM2ceJOyjYfQa', 'siswa', 'ahmat.ali.herlansah@gmail.com', '2025-06-19 15:29:27', NULL, NULL, NULL, '1', NULL),
(14, 'AHMAT PUJIYANSAH', '$2y$10$1LXWJI80/po9aBp0brEefOBUDkNuaaoqCtz4uE.mxcXb/UN4Wfzua', 'siswa', 'ahmat.pujiyansah@gmail.com', '2025-06-19 15:29:27', NULL, NULL, NULL, '1', NULL),
(15, 'AISYAH', '$2y$10$XzG5UNikv2xAIRyjvWIZsujTu9Q/.bs82jYNq2zb2qaww7krMcrTi', 'siswa', 'aisyah@gmail.com', '2025-06-19 15:29:28', NULL, NULL, NULL, '1', NULL),
(16, 'AKMAL AKBAR', '$2y$10$ronlE6QD9XbmixhuW679peGrSj4olvKXcmPmFJafiBYboE7V0W146', 'siswa', 'akmal.akbar@gmail.com', '2025-06-19 15:29:28', NULL, NULL, NULL, '1', NULL),
(17, 'ALDO RISKY SAPUTRA', '$2y$10$p5LTpQhDs9IVAnRtvX0s2efGyZZoHy1qLbk82EVobFs4avx6RY2Ga', 'siswa', 'aldo.risky.saputra@gmail.com', '2025-06-19 15:29:28', NULL, NULL, NULL, '1', NULL),
(18, 'Alfa Azzahra', '$2y$10$m5P02qqen.WjPHqMCvH3tOka30Z6eKCaQEMxnAPDeKuYu1qEDEH4i', 'siswa', 'alfa.azzahra@gmail.com', '2025-06-19 15:29:28', NULL, NULL, NULL, '1', NULL),
(19, 'Alfi Zahara', '$2y$10$PMzKCULFEvEqL8TxpQ/FeeF73UlZDgpxIDBWadaxXbQi5GYIpUnES', 'siswa', 'alfi.zahara@gmail.com', '2025-06-19 15:29:28', NULL, NULL, NULL, '1', NULL),
(20, 'ALIYA NATASYA', '$2y$10$y.t0Z6Rb1F1x7/5stpAxxOZaWw09BAwNJ8VpCrKhHPYTkzQqROec.', 'siswa', 'aliya.natasya@gmail.com', '2025-06-19 15:29:28', NULL, NULL, NULL, '1', NULL),
(21, 'ALVINA LAURA', '$2y$10$6TPlU4mz7mNM8n.IjP.tv.I3T7ZibKY6J7/FNmRMlSk4q8GcGZbs.', 'siswa', 'alvina.laura@gmail.com', '2025-06-19 15:29:28', NULL, NULL, NULL, '1', NULL),
(22, 'AMELIA SAFITRI', '$2y$10$k2MUA3tkIUcflJS/Ds7fleS5bflElijMBvp54UYXEYxAqKpmWD9uW', 'siswa', 'amelia.safitri@gmail.com', '2025-06-19 15:29:28', NULL, NULL, NULL, '1', NULL),
(23, 'ANDINI PUTRI ALI', '$2y$10$z3GsPoxynVwDZHNrUVkcs.uhZENd2p4OzVWiYbblPYDAL64.tew4O', 'siswa', 'andini.putri.ali@gmail.com', '2025-06-19 15:29:29', NULL, NULL, NULL, '1', NULL),
(24, 'ANGGI SAPUTRA', '$2y$10$79ejbkFDUq29YLm1pWzdfe30HObj2PSVruTIpuj4WV.3XbQN4fnPC', 'siswa', 'anggi.saputra@gmail.com', '2025-06-19 15:29:29', NULL, NULL, NULL, '1', NULL),
(25, 'ANGGUN AULIA', '$2y$10$akGo9hXIiNaqeBQDFocrCumJVhKejZRCgPQRhBJhRkGtzRQTKkxJm', 'siswa', 'anggun.aulia@gmail.com', '2025-06-19 15:29:29', NULL, NULL, NULL, '1', NULL),
(26, 'ANGGUN CITRA AULIA', '$2y$10$tHXEWH2S7Pk9MXuHAzYqz.Al6yurPhZubZtuan0Ry5lWiUkYl1yhG', 'siswa', 'anggun.citra.aulia@gmail.com', '2025-06-19 15:29:29', NULL, NULL, NULL, '1', NULL),
(27, 'ANISA NANDA UTAMI', '$2y$10$q.x7lXsIFybj6yaDJbD8ae295Gi3zz42KPyIdPXK6adYA1zgeLZO2', 'siswa', 'anisa.nanda.utami@gmail.com', '2025-06-19 15:29:29', NULL, NULL, NULL, '1', NULL),
(28, 'ANISA NURCAHYANI', '$2y$10$gJbU8Jncas.35mbL52awiOZhYGexLJgicouFUHuzEcIfynrBHRzX6', 'siswa', 'anisa.nurcahyani@gmail.com', '2025-06-19 15:29:29', NULL, NULL, NULL, '1', NULL),
(29, 'Aqilla Wirdatun Naja', '$2y$10$07wl4owZ68uajazUTUrWIeMNiq9q.nzMj7Pjm3FKkr88C3ZY.YX5q', 'siswa', 'aqilla.wirdatun.naja@gmail.com', '2025-06-19 15:29:29', NULL, NULL, NULL, '1', NULL),
(30, 'ATQAN ALFATHIR RIZKY', '$2y$10$xzUY12cuUHmMCwWkWNYFIuM/0ygqrbnfFAbdqQ4UoZye6QnJOye7m', 'siswa', 'atqan.alfathir.rizky@gmail.com', '2025-06-19 15:29:30', NULL, NULL, NULL, '1', NULL),
(31, 'AULAZIYANA ABIDAH', '$2y$10$ybXzCSm1lh4KeM9ypE7hSuSzokkC0c2EHdkR8HOKlKXoVh3oRj0bq', 'siswa', 'aulaziyana.abidah@gmail.com', '2025-06-19 15:29:30', NULL, NULL, NULL, '1', NULL),
(32, 'AULIA MIRANDA', '$2y$10$H8s3Rk1N7Hfd3Duyzk8SUubGUNfNh5AkZBuAtJ2J1e1eRWSrhSJEO', 'siswa', 'aulia.miranda@gmail.com', '2025-06-19 15:29:30', NULL, NULL, NULL, '1', NULL),
(33, 'AULIA RAHMI', '$2y$10$5Mm0WtHGxnYcbAJJd7r2/uZ2OFE.pJDx7NcHMgfaf18FOkd7JFFj6', 'siswa', 'aulia.rahmi@gmail.com', '2025-06-19 15:29:30', NULL, NULL, NULL, '1', NULL),
(34, 'Azura Valentina', '$2y$10$iC8mIpOxcDmfsc9UzufzgOJ9bsjVJt65oSzyyVSwSdq2/Sq.yKcue', 'siswa', 'azura.valentina@gmail.com', '2025-06-19 15:29:31', NULL, NULL, NULL, '1', NULL),
(35, 'BADALI SAPUTRA', '$2y$10$lpawYOfU6GdeHPRivqIIo.dri4ATXfch0SYeMlRcfLz31zy0Gi6AW', 'siswa', 'badali.saputra@gmail.com', '2025-06-19 15:29:31', NULL, NULL, NULL, '1', NULL),
(36, 'BAHRUL AZMI', '$2y$10$hKYq9jPrbBnjy1WTC9G9Qu5cj9YImdVk.6V5uJ1Sj39GBAY4YIGMi', 'siswa', 'bahrul.azmi@gmail.com', '2025-06-19 15:29:31', NULL, NULL, NULL, '1', NULL),
(37, 'BHAGAS ALFIAN SUHADA', '$2y$10$ZFAH1XTG0cOIxd1SNjOBFe4LvWlzOEM/nvOZA9lFYpG413TLeVunG', 'siswa', 'bhagas.alfian.suhada@gmail.com', '2025-06-19 15:29:32', NULL, NULL, NULL, '1', NULL),
(38, 'BINTANG ADE PUTRA', '$2y$10$x0ydZPSMsPnQ7O6ckof7lulpPRPkpFve6Ald3.RXD9VVwah5gKPWG', 'siswa', 'bintang.ade.putra@gmail.com', '2025-06-19 15:29:32', NULL, NULL, NULL, '1', NULL),
(39, 'CERYLE YURCEL ARSYAWINATA', '$2y$10$HQpduXF34qwBr/2UMplx7us0lEVRBLwnNWqveBLDrZGLfz4l4UaiS', 'siswa', 'ceryle.yurcel.arsyawinata@gmail.com', '2025-06-19 15:29:32', NULL, NULL, NULL, '1', NULL),
(40, 'Cornelis Robert Dharmawan', '$2y$10$o7kTwsVHiW2i6.agHbKdpuCOqU.QnAO4TkeZrbhQP6o.KoZZpvZuG', 'siswa', 'cornelis.robert.dharmawan@gmail.com', '2025-06-19 15:29:32', NULL, NULL, NULL, '1', NULL),
(41, 'DAFFA SAPUTRA', '$2y$10$IuWZOK5A8UoRCVdxrXUfiu0eqtpDvfLVO7krjBtKk7WAMYafBWJLe', 'siswa', 'daffa.saputra@gmail.com', '2025-06-19 15:29:32', NULL, NULL, NULL, '1', NULL),
(42, 'DANIEL AGUSTINUS SIMANJUNTAK', '$2y$10$hvqn3zsHI/xbgK1s04Pb3.foafX4Jia0M9us4ZlugbSU9.sDC0IIG', 'siswa', 'daniel.agustinus.simanjuntak@gmail.com', '2025-06-19 15:29:32', NULL, NULL, NULL, '1', NULL),
(43, 'DANNY KHAIRONI', '$2y$10$CZXTTuNKm8Lqw0S4B1sEGOR0hTeUPtuaZUoXEBypBxWrsNqJYR5KG', 'siswa', 'danny.khaironi@gmail.com', '2025-06-19 15:29:33', NULL, NULL, NULL, '1', NULL),
(44, 'DARWIS SAPUTRA', '$2y$10$J8nxOE/tUHmKPMk29JSr0uklEdBl8qiW3hIJ2ZyoFSY2I5FRniGhy', 'siswa', 'darwis.saputra@gmail.com', '2025-06-19 15:29:33', NULL, NULL, NULL, '1', NULL),
(45, 'DEA ARISKA', '$2y$10$VtKwBP0119IUwWa4IZIV6OLIBRRVgyR36aMFdAYCAn8p6dGP1duKe', 'siswa', 'dea.ariska@gmail.com', '2025-06-19 15:29:33', NULL, NULL, NULL, '1', NULL),
(46, 'DECA SAPITRI', '$2y$10$dtPA1bVu6z7yRUVv0itfSuAFb5GZWsoiy67G9TgV0Q7mU3iBvg/Aq', 'siswa', 'deca.sapitri@gmail.com', '2025-06-19 15:29:33', NULL, NULL, NULL, '1', NULL),
(47, 'DEFRI ARRAHMANALLAH', '$2y$10$/NmsRIpLF3rL78M9JkZ4oemxC1Lty.9BPuEWwuarsT43JIPAjjIJW', 'siswa', 'defri.arrahmanallah@gmail.com', '2025-06-19 15:29:34', NULL, NULL, NULL, '1', NULL),
(48, 'DELIA ASTRI', '$2y$10$cNAu5gtHnJIUPdlxikNpM.Kumh/VcnOgtVssez7lkNestzPHVoaQ2', 'siswa', 'delia.astri@gmail.com', '2025-06-19 15:29:34', NULL, NULL, NULL, '1', NULL),
(49, 'Dena Afriyani', '$2y$10$1hZO0SqzXbGB6XauUxVsweLzOHOin1pb819Hb5h17FDOmQkaRQP3m', 'siswa', 'dena.afriyani@gmail.com', '2025-06-19 15:29:34', NULL, NULL, NULL, '1', NULL),
(50, 'DHARA KURNIA IDRIS', '$2y$10$HDKsPJLgHUDIHDttuyUuKu.sfoVTr60mOmGUUKB/7JbgRVacHWMHG', 'siswa', 'dhara.kurnia.idris@gmail.com', '2025-06-19 15:29:35', NULL, NULL, NULL, '1', NULL),
(51, 'DJUWITA AGATHA FAJAR', '$2y$10$xKSrA9/U9ChDnWgy9j.HKOIjU4AIeO./mBNbNZk3c.0gXKTr7yTr2', 'siswa', 'djuwita.agatha.fajar@gmail.com', '2025-06-19 15:29:35', NULL, NULL, NULL, '1', NULL),
(52, 'DWI AZZURA PRAMA DITA', '$2y$10$rLW8E4a2DpnScDp5k4ymMOdKapNr62pqvAJhEQdNZi9SBq7iYgavG', 'siswa', 'dwi.azzura.prama.dita@gmail.com', '2025-06-19 15:29:36', NULL, NULL, NULL, '1', NULL),
(53, 'DZUNUR\'AIN FATIMAH AZZAHRA', '$2y$10$UchSq3HEnoOK1WphQZL5NuTI2nGnTTEY94gE0mhwROQLADSfFD3/K', 'siswa', 'dzunurain.fatimah.azzahra@gmail.com', '2025-06-19 15:29:36', NULL, NULL, NULL, '1', NULL),
(54, 'EL SYAUQI', '$2y$10$6sWAqHFCuUvzkW9PusBCAuvM0eTBvupV73D3wI2iJb3kJ5kEOjy3i', 'siswa', 'el.syauqi@gmail.com', '2025-06-19 15:29:37', NULL, NULL, NULL, '1', NULL),
(55, 'ELPA WARDA', '$2y$10$7Vu.efaaYAbD0da2c6wQA.vwyb8UuholeYR.yM8yCbKxH1jXNm.jy', 'siswa', 'elpa.warda@gmail.com', '2025-06-19 15:29:37', NULL, NULL, NULL, '1', NULL),
(56, 'ELSA DIVA YANTI', '$2y$10$RMPuksfYSBzQ8ocE1rPt9.iIWNwV3DImpso3naAVy.Gv8hA5rSzFS', 'siswa', 'elsa.diva.yanti@gmail.com', '2025-06-19 15:29:37', NULL, NULL, NULL, '1', NULL),
(57, 'ELSA NABILA', '$2y$10$NabSSNGFURxCuztVfAymWuXO7GUnBRf5QsAUTtrzGXi.hWmsQ0CEu', 'siswa', 'elsa.nabila@gmail.com', '2025-06-19 15:29:37', NULL, NULL, NULL, '1', NULL),
(58, 'ELSA NADILA', '$2y$10$txCYcPJDsG3.2bzn32aTHeu16K2ovjIJnVy.yNQyI7j/BHn9Q2O1e', 'siswa', 'elsa.nadila@gmail.com', '2025-06-19 15:29:37', NULL, NULL, NULL, '1', NULL),
(59, 'ELSA SEPBRINA', '$2y$10$Cl/qbe4FPaGsxMwYIrPOXOfPA9u6UCTXTdd8M5A87xoMS0bWISXqu', 'siswa', 'elsa.sepbrina@gmail.com', '2025-06-19 15:29:37', NULL, NULL, NULL, '1', NULL),
(60, 'ELVIRA KESYA PUTRI. S', '$2y$10$B6PvyAaDbsSbc/b3W/JXJ.lNsV2tWJU/iVQInyy474KEd.GH.mR1u', 'siswa', 'elvira.kesya.putri.s@gmail.com', '2025-06-19 15:29:38', NULL, NULL, NULL, '1', NULL),
(61, 'ENGGI DESTIO', '$2y$10$wDYIK5x9/bexaR1w6N2NzuBjZzPKr/vXkzws2mM6EE.CQdpXSqlbW', 'siswa', 'enggi.destio@gmail.com', '2025-06-19 15:29:38', NULL, NULL, NULL, '1', NULL),
(62, 'FARHAN NUR HUDA RAHMADI', '$2y$10$m97H3e2noJTtPNVKw0ATbuDWeLC.dUUNV9sEtXYkIbQH6sY5Ta8Au', 'siswa', 'farhan.nur.huda.rahmadi@gmail.com', '2025-06-19 15:29:38', NULL, NULL, NULL, '1', NULL),
(63, 'Fauzan', '$2y$10$Mz9y6XkkYVKGXmrS4Z2.Kuxqtfr6xqx1dMvtkumYCcx5VxlnNwVDe', 'siswa', 'fauzan@gmail.com', '2025-06-19 15:29:38', NULL, NULL, NULL, '1', NULL),
(64, 'FEBY DWI LESTARI', '$2y$10$dVPRi3fYTB6sgyAjeg14Z.EghGfohMJ/wWgfeYCu/9ugO658KVN1G', 'siswa', 'feby.dwi.lestari@gmail.com', '2025-06-19 15:29:38', NULL, NULL, NULL, '1', NULL),
(65, 'GEBI SABRINA AMANDA', '$2y$10$S6Pm41oaryepCNCkMhjCk.awAGqLl.ftlxlq/00Vgg9siYhyxkW1K', 'siswa', 'gebi.sabrina.amanda@gmail.com', '2025-06-19 15:29:38', NULL, NULL, NULL, '1', NULL),
(66, 'HAIKAL AKBAR', '$2y$10$4LwOwwVHbZtBBs.AXC8nxOm78fvVPZ.Hz6uC6.s9FldT7MNmi0svq', 'siswa', 'haikal.akbar@gmail.com', '2025-06-19 15:29:38', NULL, NULL, NULL, '1', NULL),
(67, 'HANA TALITHA AZZAHRA', '$2y$10$tW17GyXl.nIZlJ.e9BPltug1Ie.taVJnuBuIbA4Ui1krZC3XkCPX.', 'siswa', 'hana.talitha.azzahra@gmail.com', '2025-06-19 15:29:39', NULL, NULL, NULL, '1', NULL),
(68, 'Hardiansyah', '$2y$10$WPlo146elwziYDm8jyCSmeGh3If0qitmrDMQHPJmfzhMPGBLqCQ1S', 'siswa', 'hardiansyah@gmail.com', '2025-06-19 15:29:39', NULL, NULL, NULL, '1', NULL),
(69, 'HELIA SALMAH', '$2y$10$40UfyTzgdoN4bKHxDw/el.S3eVh8V3dqs6DUW.IZi//C8Ycfs..uK', 'siswa', 'helia.salmah@gmail.com', '2025-06-19 15:29:39', NULL, NULL, NULL, '1', NULL),
(70, 'HUMAIRA ATQIYA', '$2y$10$ZrRIUIrkzyOF/4OWoaf49urK2zlbqu4B4qpaRzeYQICMXO2dAReb2', 'siswa', 'humaira.atqiya@gmail.com', '2025-06-19 15:29:39', NULL, NULL, NULL, '1', NULL),
(71, 'HUSNUL HATIMAH', '$2y$10$A83jA7PqXAkZ88xU6mEj3ufkAZYig90wxVdthBDHcNeYgRE9V1SE2', 'siswa', 'husnul.hatimah@gmail.com', '2025-06-19 15:29:39', NULL, NULL, NULL, '1', NULL),
(72, 'HUSNUL KHATIMAH', '$2y$10$jQBSpbnvlvPDiv.Og5HNhOtuBjlXz1cgqUxP0ie7v5WUP6s7c/hYu', 'siswa', 'husnul.khatimah@gmail.com', '2025-06-19 15:29:39', NULL, NULL, NULL, '1', NULL),
(73, 'HUSNUL KHATIMAH', '$2y$10$j0RDOAYVs25fHze5FLAEpunQP6MhrUa/MUwVkVTCFiKY1wXlOHWcC', 'siswa', 'husnul.khatimah@gmail.com', '2025-06-19 15:29:39', NULL, NULL, NULL, '1', NULL),
(74, 'ILHAM MAULANA', '$2y$10$JyImuttrVWZlAK28RaO9T.ui3cZekkaV2KSGsLO5uAyRJnqnAileW', 'siswa', 'ilham.maulana@gmail.com', '2025-06-19 15:29:40', NULL, NULL, NULL, '1', NULL),
(75, 'INDAH DAVITRI', '$2y$10$U0z7itGHvzrDY5KImqo7POCghX/QxfZinMB2AqksPfLOz7Eit/6D2', 'siswa', 'indah.davitri@gmail.com', '2025-06-19 15:29:40', NULL, NULL, NULL, '1', NULL),
(76, 'IRFAN PERMANA PUTRA', '$2y$10$euEMcWhTmnAvP.NrTkZ3ZeMQaoeTiTNd1bbtZeXN/9kM32snCr9v.', 'siswa', 'irfan.permana.putra@gmail.com', '2025-06-19 15:29:40', NULL, NULL, NULL, '1', NULL),
(77, 'IRHAM RAMADHAN', '$2y$10$NFYuJmhb1eZsfqh5t8WzXe.Iya2M7Rzp4jd7HJl.td1/VWkVjrhcy', 'siswa', 'irham.ramadhan@gmail.com', '2025-06-19 15:29:40', NULL, NULL, NULL, '1', NULL),
(78, 'IVO LAROSA ANDRETA HEALTHY', '$2y$10$TuBFlcAecrt1ooXcvYetK.IpTHfLWL8Pr49Fp1B70Sg89FZOX7osS', 'siswa', 'ivo.larosa.andreta.healthy@gmail.com', '2025-06-19 15:29:40', NULL, NULL, NULL, '1', NULL),
(79, 'JESSICA PUTRI RAHMADANI', '$2y$10$2rV4c6V9IwCY33wlBolzc.KASRoQDY4RnMI5mtOMIdTzmKVN.7HOm', 'siswa', 'jessica.putri.rahmadani@gmail.com', '2025-06-19 15:29:40', NULL, NULL, NULL, '1', NULL),
(80, 'JUMA\' ATIAH', '$2y$10$N3MH38ahbAGD8MIAGWD7ieFcj545q0ddEIc7gbkFy1Y/iyV2xVsfC', 'siswa', 'juma.atiah@gmail.com', '2025-06-19 15:29:40', NULL, NULL, NULL, '1', NULL),
(81, 'JUNAIDA', '$2y$10$IjB2z1UUB3it63mQuVx4zuVuJUwiVEndtM3MlWFcI4kAPREPk3m0O', 'siswa', 'junaida@gmail.com', '2025-06-19 15:29:40', NULL, NULL, NULL, '1', NULL),
(82, 'Junaidi', '$2y$10$DLIWvbA0is98bhEJZRnid.M/YbNJqo3tDjK98EtziMq/Oy3CuQzQW', 'siswa', 'junaidi@gmail.com', '2025-06-19 15:29:41', NULL, NULL, NULL, '1', NULL),
(83, 'KEISHA AZZAHRA', '$2y$10$WRSaod5Jt6LfPM.zfeEPie9BZVOB9xIkAbKXBVYab/AxWL3tKIAB6', 'siswa', 'keisha.azzahra@gmail.com', '2025-06-19 15:29:41', NULL, NULL, NULL, '1', NULL),
(84, 'KELFIANRA', '$2y$10$8xFZtvMPJpzPAjDVjMbphuQddPP.Sfn/J17aJYEKz3ESHaEI/3yNW', 'siswa', 'kelfianra@gmail.com', '2025-06-19 15:29:41', NULL, NULL, NULL, '1', NULL),
(85, 'KEVIN PRATAMA SIREGAR', '$2y$10$DkClvmlq/1tILOlFBLJe0utKdYUEcYbtW0rxPe7m5ZnrrNgbxw9zG', 'siswa', 'kevin.pratama.siregar@gmail.com', '2025-06-19 15:29:41', NULL, NULL, NULL, '1', NULL),
(86, 'Keysha Valentina Angruela', '$2y$10$EZ8mQDc579wHMOLZ/iDE4.LzJVBRwyDsKMtQimjXN/WPssWDVQUV.', 'siswa', 'keysha.valentina.angruela@gmail.com', '2025-06-19 15:29:41', NULL, NULL, NULL, '1', NULL),
(87, 'KHAIRUNNISA', '$2y$10$dWP8ay2a/7vaa9vS/SK88OX8kduNUnzyfAqxXEXUEiS8VEbkp3nO.', 'siswa', 'khairunnisa@gmail.com', '2025-06-19 15:29:41', NULL, NULL, NULL, '1', NULL),
(88, 'KHALISA MUTIA ZAHRA', '$2y$10$cUQRpjv3VeVY5Nv.qhG8jeMVPRp7q3WXS30lQ.gviIFKgwUM3VWfK', 'siswa', 'khalisa.mutia.zahra@gmail.com', '2025-06-19 15:29:41', NULL, NULL, NULL, '1', NULL),
(89, 'KHIZANAATUL HIKMAH', '$2y$10$GOgPQFydJS/9n8n8c0O3SO5BVpQFa9Hs3snla2uQABTV8vlJx5yzy', 'siswa', 'khizanaatul.hikmah@gmail.com', '2025-06-19 15:29:42', NULL, NULL, NULL, '1', NULL),
(90, 'LAYLI RAMADANI', '$2y$10$8wHtPYjCNHSnIZYAuSDtuueeVzkwWLwOPD/Io/bs8a2A/d4vhnULm', 'siswa', 'layli.ramadani@gmail.com', '2025-06-19 15:29:42', NULL, NULL, NULL, '1', NULL),
(91, 'LILI AZWINA', '$2y$10$392zkOEpD84PZ6k5Dya2g.yOJFWmusLZ.GRisimodt7qO5wEDfe42', 'siswa', 'lili.azwina@gmail.com', '2025-06-19 15:29:42', NULL, NULL, NULL, '1', NULL),
(92, 'LULUK WIDIYANA ANISYATIN ALYAH', '$2y$10$ooK0G8rAKf8ihK0vS3naN.43rMGckj7b93FUF4BLtaemK9J79CFhW', 'siswa', 'luluk.widiyana.anisyatin.alyah@gmail.com', '2025-06-19 15:29:42', NULL, NULL, NULL, '1', NULL),
(93, 'M RAFA PUTRA RAMADHAN', '$2y$10$EcWZ0ikkmcKU15UevX.pUO7eaVdHYSbwGreQTIr7Eh.2VQfUyZEjK', 'siswa', 'm.rafa.putra.ramadhan@gmail.com', '2025-06-19 15:29:42', NULL, NULL, NULL, '1', NULL),
(94, 'M REHAN INDRA SAPUTRA', '$2y$10$jjhNS2a1tNyCA2D5rcTd/ekmyUkpj9KTZmflJwfiSZPW7FUInWhCy', 'siswa', 'm.rehan.indra.saputra@gmail.com', '2025-06-19 15:29:42', NULL, NULL, NULL, '1', NULL),
(95, 'M. AGIL ROMADHONI', '$2y$10$uqtLmpa39jXeqwGdJNUpHe5W8KDIyXKOJhhr4L2p3oHvcczThRp3u', 'siswa', 'm.agil.romadhoni@gmail.com', '2025-06-19 15:29:42', NULL, NULL, NULL, '1', NULL),
(96, 'm. akbar', '$2y$10$5u9jKv4now.Wd/6/KNWFIOaESSOhl3K.Qk6BYe1DwOvzVC5sidMeu', 'siswa', 'm.akbar@gmail.com', '2025-06-19 15:29:42', NULL, NULL, NULL, '1', NULL),
(97, 'M. ALFIN', '$2y$10$43Z1JuAJBzC8lRoBKBJeAe2o4lcWSmvsmUzn59jB1wA84cN56WJ.G', 'siswa', 'm.alfin@gmail.com', '2025-06-19 15:29:43', NULL, NULL, NULL, '1', NULL),
(98, 'M. ANDIKA', '$2y$10$moSHOEgeGmYi6ayYt0NX6euRU7H9fStNLbyjXvp/ubERLymrcHEh2', 'siswa', 'm.andika@gmail.com', '2025-06-19 15:29:43', NULL, NULL, NULL, '1', NULL),
(99, 'M. AUFA AZZAM', '$2y$10$Kam9HtHz8rjX/m1PrqgkbO2t/pDwwEipuNyDRGrhYmoPD0U0Bm8ei', 'siswa', 'm.aufa.azzam@gmail.com', '2025-06-19 15:29:43', NULL, NULL, NULL, '1', NULL),
(100, 'M. AZIRWAN', '$2y$10$ixEWtzJaoHU9d/gKOV9lbuGEhDlA.KShGb2M4vTipZZTmdDfKZo2O', 'siswa', 'm.azirwan@gmail.com', '2025-06-19 15:29:43', NULL, NULL, NULL, '1', NULL),
(101, 'M. BILLY RAMADHAN', '$2y$10$/Kq6an4CdwyNrDG4abd9gOBg6TUIsakScFOoWhhDkRjDnHlDh2s6m', 'siswa', 'm.billy.ramadhan@gmail.com', '2025-06-19 15:29:43', NULL, NULL, NULL, '1', NULL),
(102, 'M. DAFFA ANNASHIH', '$2y$10$kHmAb4LCMhU6MFo/.D31a.8RFBUdhvtDoxIN/WVcLUeYf3KkoFC/6', 'siswa', 'm.daffa.annashih@gmail.com', '2025-06-19 15:29:43', NULL, NULL, NULL, '1', NULL),
(103, 'M. DAFFA JALLALUDDIN RUMMI', '$2y$10$xZxK9w7rpbQDiFxBeWSSzOQsTB8ZCZliEB9jkarw5o2jT7Wf/NTle', 'siswa', 'm.daffa.jallaluddin.rummi@gmail.com', '2025-06-19 15:29:43', NULL, NULL, NULL, '1', NULL),
(104, 'M. DAVI', '$2y$10$6pI6f/eS8CZYTqPxWUdV4.AyCRgJLyjJ4WLbe.R1BZrbK/a7HpPqq', 'siswa', 'm.davi@gmail.com', '2025-06-19 15:29:44', NULL, NULL, NULL, '1', NULL),
(105, 'M. DENI', '$2y$10$I1bGOUDwWv2Q5SAAi62xKOeFe5fHmeRW9MrbOyxnnleGd6DiMldFm', 'siswa', 'm.deni@gmail.com', '2025-06-19 15:29:44', NULL, NULL, NULL, '1', NULL),
(106, 'M. FACHRY', '$2y$10$CUhpRU26MIaG5In.nxWeKubdgypvTYyzk9TVgp65nPRU3Y9K7BOmW', 'siswa', 'm.fachry@gmail.com', '2025-06-19 15:29:44', NULL, NULL, NULL, '1', NULL),
(107, 'M. Fahriansyah', '$2y$10$hL2dlISHurBNxLIPSipzO.mxhHLgM.0jQq0Q6URGs4SqkezhONu0S', 'siswa', 'm.fahriansyah@gmail.com', '2025-06-19 15:29:44', NULL, NULL, NULL, '1', NULL),
(108, 'M. FATHUR RAMADHAN', '$2y$10$d077k/2e1GYVqKmi/dy/v.BQ8IpXPVNMbpvVvGqVWiPOdUFIexbI.', 'siswa', 'm.fathur.ramadhan@gmail.com', '2025-06-19 15:29:44', NULL, NULL, NULL, '1', NULL),
(109, 'M. FEBRIAN KAHFI', '$2y$10$/RejCrEpVcSWvFvftYXZTu/pH.MMsxYBmqCDNfmrseNzzUMvu.Aby', 'siswa', 'm.febrian.kahfi@gmail.com', '2025-06-19 15:29:44', NULL, NULL, NULL, '1', NULL),
(110, 'M. Fikri Salman', '$2y$10$iem1FJ46QMLxqfiWmnXYGeN/FaMqE6jDBBGKn5MTGx96RxVrP04AW', 'siswa', 'm.fikri.salman@gmail.com', '2025-06-19 15:29:45', NULL, NULL, NULL, '1', NULL),
(111, 'm. ghopron wahid', '$2y$10$A3YotvZDwaa.Hrm9nXDTp.jDLLSDefFw5eIlslPhtjHmOFHBVvHT.', 'siswa', 'm.ghopron.wahid@gmail.com', '2025-06-19 15:29:45', NULL, NULL, NULL, '1', NULL),
(112, 'M. GILANG RAMADAN', '$2y$10$MUIEDAkhkL78T0yj9Fk2iuqsrZHxefCYcV4w1lE2g.epJGjglP/Si', 'siswa', 'm.gilang.ramadan@gmail.com', '2025-06-19 15:29:45', NULL, NULL, NULL, '1', NULL),
(113, 'M. HADRI', '$2y$10$xJ7H3BspjmJuM9EZBcINGenXraY.kOnAyRqp5Rz2YK559myOqHPUy', 'siswa', 'm.hadri@gmail.com', '2025-06-19 15:29:45', NULL, NULL, NULL, '1', NULL),
(114, 'M. HAFIZ AKBAR', '$2y$10$ledwaEWFB/ULe5OwzmInJOU.PJCWaWccTb/ZQXtZdrOUDYZzeXyMK', 'siswa', 'm.hafiz.akbar@gmail.com', '2025-06-19 15:29:45', NULL, NULL, NULL, '1', NULL),
(115, 'M. IDI PANGESTU', '$2y$10$W7oy908oXH29.iHiEEAUSOMZ5T7jZIpsg1XzBeAorHliTa0OVKmQK', 'siswa', 'm.idi.pangestu@gmail.com', '2025-06-19 15:29:45', NULL, NULL, NULL, '1', NULL),
(116, 'M. IKHSAN SUAIBI', '$2y$10$Ij.OYEVQDdpi.ZGvKIJH7.mb7eqvaWW9/ZQXG2d6usHVYvzXdk.pS', 'siswa', 'm.ikhsan.suaibi@gmail.com', '2025-06-19 15:29:45', NULL, NULL, NULL, '1', NULL),
(117, 'M. IKRAM BADALI', '$2y$10$RpOyZZ3PP5iy73yzzrFvPeijUWNChIrGmASye1Ewp2/uvX/ujSyKW', 'siswa', 'm.ikram.badali@gmail.com', '2025-06-19 15:29:46', NULL, NULL, NULL, '1', NULL),
(118, 'M. ILHAM RAMADAN', '$2y$10$5rDAEu7NuAM02eo4feji5.bLMQ8TSJpHPaC/Id.PEzM1NaQI/yhBu', 'siswa', 'm.ilham.ramadan@gmail.com', '2025-06-19 15:29:46', NULL, NULL, NULL, '1', NULL),
(119, 'M. IQROM RAYHAN', '$2y$10$T6HDyO6wnlcgvyxlRnIa5.SFH7a4l8NaxxATaDhmNS8IOW.0ixU2m', 'siswa', 'm.iqrom.rayhan@gmail.com', '2025-06-19 15:29:46', NULL, NULL, NULL, '1', NULL),
(120, 'M. LUTHFI HAKIM', '$2y$10$f/ZalqpVjl9rSDGPCxTGeu8o9Hr.FMy14uPl/cpbpDRaHJ.xe857y', 'siswa', 'm.luthfi.hakim@gmail.com', '2025-06-19 15:29:46', NULL, NULL, NULL, '1', NULL),
(121, 'M. NAUFAL WAFII FADLURRAHMAN', '$2y$10$so0naeXJ5c8N7EgzYHvOS.Aseof6o/8MtS4sI5w3zKAkFhYd/FG8u', 'siswa', 'm.naufal.wafii.fadlurrahman@gmail.com', '2025-06-19 15:29:46', NULL, NULL, NULL, '1', NULL),
(122, 'M. NAUFAL ZAKI', '$2y$10$e3XeqUXYzBi6YLOK.esKAOcWR.wzAe1MyaWI1bm7avevUe4DVMNQ.', 'siswa', 'm.naufal.zaki@gmail.com', '2025-06-19 15:29:46', NULL, NULL, NULL, '1', NULL),
(123, 'M. PADTLI RAMDANI', '$2y$10$DzPTfH/YU3iVvMAUqYy1SOkaSa9Lf9yjz30m/2WRUR9NV457z/9zm', 'siswa', 'm.padtli.ramdani@gmail.com', '2025-06-19 15:29:46', NULL, NULL, NULL, '1', NULL),
(124, 'M. PRAYUDA ADHA', '$2y$10$pX3YT5Z9DAKsgu/YMsSJq.vfuw3neWoe914AXQ2CEZJLQEyqyl4wu', 'siswa', 'm.prayuda.adha@gmail.com', '2025-06-19 15:29:46', NULL, NULL, NULL, '1', NULL),
(125, 'M. REZEKI ROMADHAN', '$2y$10$Q/jW10.bgUoescgiuoYlSubZUWu0RQ9TPwkbiN2JoW6Y.c0ezQa.6', 'siswa', 'm.rezeki.romadhan@gmail.com', '2025-06-19 15:29:47', NULL, NULL, NULL, '1', NULL),
(126, 'M. RIANDRI', '$2y$10$uiqCXfv7cZTqeSMsWuieeukXnJ4.h2qe8ucFdnchZgNERrRhdxdUu', 'siswa', 'm.riandri@gmail.com', '2025-06-19 15:29:48', NULL, NULL, NULL, '1', NULL),
(127, 'm. ridwan', '$2y$10$wBLxfvFH1J9kO8d8UwltPe0lb9RBxEYVlU1jc6EUeK9iz0taWNmbq', 'siswa', 'm.ridwan@gmail.com', '2025-06-19 15:29:48', NULL, NULL, NULL, '1', NULL),
(128, 'M. RISKI WIJAYA', '$2y$10$OIIQcQThDvs9dSXb5JPWgeIyQrbLcjNIjP9MppRo8r4NiTwdCJGBm', 'siswa', 'm.riski.wijaya@gmail.com', '2025-06-19 15:29:48', NULL, NULL, NULL, '1', NULL),
(129, 'M. RIZKI AZHARI', '$2y$10$Bwy5gyj76BIeCDKbNxBtnutalSf.Ss7XC/0itXt8NIQbErDH6yBtq', 'siswa', 'm.rizki.azhari@gmail.com', '2025-06-19 15:29:48', NULL, NULL, NULL, '1', NULL),
(130, 'M. RIZKI MAULANA', '$2y$10$1iRUdUR2WDptFmm9eMnNrOYewW72KwmX9.V4iJbp1BTl8UmkbPm82', 'siswa', 'm.rizki.maulana@gmail.com', '2025-06-19 15:29:48', NULL, NULL, NULL, '1', NULL),
(131, 'M. RIZKY HIDAYAT', '$2y$10$Wqtuywef9btfN6pp.p4Bu.JFVHvCsBn83s9HoZXpx5gzO0abQ3r7m', 'siswa', 'm.rizky.hidayat@gmail.com', '2025-06-19 15:29:49', NULL, NULL, NULL, '1', NULL),
(132, 'm. rizqi mubarak', '$2y$10$ECFjCYtrYqQX/2XZjH5ob.F0Rw5gFaeuqfJN1KnUndWgIM4HbVehq', 'siswa', 'm.rizqi.mubarak@gmail.com', '2025-06-19 15:29:49', NULL, NULL, NULL, '1', NULL),
(133, 'M. SAHLAL MAHPUT', '$2y$10$ZniBCdsItGiAtF1wD0ZTxuQcZFF9f31.YeSjhROzFAShRJGs2TKWG', 'siswa', 'm.sahlal.mahput@gmail.com', '2025-06-19 15:29:49', NULL, NULL, NULL, '1', NULL),
(134, 'M. Syah Ronny Agung Widodo', '$2y$10$PtirVJ4.8bga.xlWfNn0f.Y/g2QyOz8RhNx1UuOdzqWcPGbXQwp9m', 'siswa', 'm.syah.ronny.agung.widodo@gmail.com', '2025-06-19 15:29:50', NULL, NULL, NULL, '1', NULL),
(135, 'M.ADIB FABIAN', '$2y$10$1LtS4x8BkGEuMjy5gqy4NuYNljLWQyGbCYRGDh5Zb2jlLEZKqxUgW', 'siswa', 'madib.fabian@gmail.com', '2025-06-19 15:29:50', NULL, NULL, NULL, '1', NULL),
(136, 'M.ALIF', '$2y$10$ygiooz6wcp5/tJwjDXRAqOCpcbiyO38G6qzJQKRPwwWaIyr5NnW6y', 'siswa', 'malif@gmail.com', '2025-06-19 15:29:50', NULL, NULL, NULL, '1', NULL),
(137, 'M.ARNO RJA', '$2y$10$nspGhzfyqGzJ/YPAS3DbGO.Wj4qADsO/yhh6pEe2w1WBhjVswe27i', 'siswa', 'marno.rja@gmail.com', '2025-06-19 15:29:51', NULL, NULL, NULL, '1', NULL),
(138, 'M.HABIBI', '$2y$10$ISpBqozXoxfvxBGPVnOpx.4wFwZ/bNuZXf2PiUv6ULGEe1D7187GG', 'siswa', 'mhabibi@gmail.com', '2025-06-19 15:29:51', NULL, NULL, NULL, '1', NULL),
(139, 'M.IQBAL', '$2y$10$fZpHkxsZSsP9YzTEObOHlujU8LNQtH0MdZtrE5Jb2ejOCQ4IyPhdi', 'siswa', 'miqbal@gmail.com', '2025-06-19 15:29:51', NULL, NULL, NULL, '1', NULL),
(140, 'M.KHAIRULLAH', '$2y$10$SOMOjP4DA/5MIlJXUOtmlOkxyKjg6bnV6RsvjmPZiL55NNdIG9gT6', 'siswa', 'mkhairullah@gmail.com', '2025-06-19 15:29:51', NULL, NULL, NULL, '1', NULL),
(141, 'M.RAFLI', '$2y$10$BsgBeerhwaUeTD4fpHavfObb/aoCrQEiyrFar73Y76Gvg5Smqfvv6', 'siswa', 'mrafli@gmail.com', '2025-06-19 15:29:52', NULL, NULL, NULL, '1', NULL),
(142, 'MABILA ORIZA SATIVA', '$2y$10$AV3XK2S1GgDOysXlbfOuF.8WN85H4unlYF4Uui3xp3N2fCSGukdLS', 'siswa', 'mabila.oriza.sativa@gmail.com', '2025-06-19 15:29:52', NULL, NULL, NULL, '1', NULL),
(143, 'MAISARAH NUR RIZKI', '$2y$10$HiV.wfEbETR9SziJ54WyneNJcnIkh/sD7R1m3Pq1/qeDH6QZfpnPq', 'siswa', 'maisarah.nur.rizki@gmail.com', '2025-06-19 15:29:52', NULL, NULL, NULL, '1', NULL),
(144, 'Marhadian', '$2y$10$DClh08QUS7bPD86XgohjOOxwKAJXsTCE80B2oBk1Kn4fD1ytYyn06', 'siswa', 'marhadian@gmail.com', '2025-06-19 15:29:53', NULL, NULL, NULL, '1', NULL),
(145, 'MARLA ADINDA DEWINSA BAHRI', '$2y$10$5rmPI3uO7l/s4kSG2td0cODatdl7K2RItGDFdSeFq2c6C70ZSI0ja', 'siswa', 'marla.adinda.dewinsa.bahri@gmail.com', '2025-06-19 15:29:53', NULL, NULL, NULL, '1', NULL),
(146, 'MARSYA AGUSTINA', '$2y$10$RvojfArR8NJyOEiTXWXwWeZzxTHhq/vu8ePxho73wqRKusJR7vWLu', 'siswa', 'marsya.agustina@gmail.com', '2025-06-19 15:29:53', NULL, NULL, NULL, '1', NULL),
(147, 'MAULY ALFHATY', '$2y$10$weD9FKsReYKO.nHXxoLwKu.e.5zUTkw.ejt/Hz2a.KJ9RPMoKp0Dq', 'siswa', 'mauly.alfhaty@gmail.com', '2025-06-19 15:29:53', NULL, NULL, NULL, '1', NULL),
(148, 'MESI LARASATI', '$2y$10$OYmwzpMyyIRAtHCjXlHQPO9eKtgQX9eLUGh.00sa1K2GCajbt0wEC', 'siswa', 'mesi.larasati@gmail.com', '2025-06-19 15:29:53', NULL, NULL, NULL, '1', NULL),
(149, 'MIA AULIA RAMADHANI', '$2y$10$gFjXe31SnDNC.UX5fTXiy.II5s2PPPh2Glb71AEK3yjJoDKEgwiyS', 'siswa', 'mia.aulia.ramadhani@gmail.com', '2025-06-19 15:29:53', NULL, NULL, NULL, '1', NULL),
(150, 'MISTYA ARSILA', '$2y$10$Yuy1KTPiY226KjRfFm4ifeuJx.JvRdWCJrXKddeY1nbhuYcL99SjC', 'siswa', 'mistya.arsila@gmail.com', '2025-06-19 15:29:53', NULL, NULL, NULL, '1', NULL),
(151, 'MOHD. RIDHO NOVIAN', '$2y$10$jI5zHUK8t66nTlx6YgXine1uFCEOagrXApuJG0BqlzNb1oWr3RFwe', 'siswa', 'mohd.ridho.novian@gmail.com', '2025-06-19 15:29:54', NULL, NULL, NULL, '1', NULL),
(152, 'MUHAMAD RYHAN ALHAPIP', '$2y$10$uOP1cCJYeB77aTozH0IJue1on4.s8iUH2cz0mEup04pS/MXP30CS2', 'siswa', 'muhamad.ryhan.alhapip@gmail.com', '2025-06-19 15:29:54', NULL, NULL, NULL, '1', NULL),
(153, 'MUHAMMAD AGUNG', '$2y$10$CdiczvoOzpvJxntnk4g3JeheUUURLI.D.EpTMeeDiD5jNsr7ekyte', 'siswa', 'muhammad.agung@gmail.com', '2025-06-19 15:29:54', NULL, NULL, NULL, '1', NULL),
(154, 'MUHAMMAD ALFIN', '$2y$10$F8Ng91mnIEIT1diUICxKI.9iRUN3ZYMF1BO9SQAU2CFTx/tBQ8Guq', 'siswa', 'muhammad.alfin@gmail.com', '2025-06-19 15:29:54', NULL, NULL, NULL, '1', NULL),
(155, 'MUHAMMAD ALLEF', '$2y$10$pL/9d7p/Ef2.LPRN4cfrdevGDRyh/51zcR61IJL/RXTzez5x8q1OC', 'siswa', 'muhammad.allef@gmail.com', '2025-06-19 15:29:54', NULL, NULL, NULL, '1', NULL),
(156, 'MUHAMMAD ALPIN KIROM', '$2y$10$wdwAheRbhjy1nbIXsY9chehGlB49v/oP3NRrcVQfUQ/BDCtWJHZBK', 'siswa', 'muhammad.alpin.kirom@gmail.com', '2025-06-19 15:29:54', NULL, NULL, NULL, '1', NULL),
(157, 'MUHAMMAD ANDRE', '$2y$10$aF23mYTJJuN1RS7dAOJ0vO66QdMsbBN4DeM.Rte6r5flfHjq49DdK', 'siswa', 'muhammad.andre@gmail.com', '2025-06-19 15:29:54', NULL, NULL, NULL, '1', NULL),
(158, 'muhammad aufa nafil', '$2y$10$LY/cG1AE7DZKNmbs/3GiPe8xludVZ48w4ReQwGKYw0LMg1vbYTvEC', 'siswa', 'muhammad.aufa.nafil@gmail.com', '2025-06-19 15:29:54', NULL, NULL, NULL, '1', NULL),
(159, 'Muhammad Daffa Al Amin', '$2y$10$F1Iumtg.jPjeyiCwB8CtdeceZZs6g.r16B7xvZ50QHVOTee4W72A2', 'siswa', 'muhammad.daffa.al.amin@gmail.com', '2025-06-19 15:29:55', NULL, NULL, NULL, '1', NULL),
(160, 'MUHAMMAD FADLI', '$2y$10$.pzWaV5UKWCG4sUMuWXCIORsMfbyEPfVvNofox2oiIYnl70xwy0Oq', 'siswa', 'muhammad.fadli@gmail.com', '2025-06-19 15:29:55', NULL, NULL, NULL, '1', NULL),
(161, 'Muhammad Fairi Al Khatir', '$2y$10$JdNznQhotsPab8NjM7kf4ukE22uz9tMggxDUofaqP9WHnpF0EXpUy', 'siswa', 'muhammad.fairi.al.khatir@gmail.com', '2025-06-19 15:29:55', NULL, NULL, NULL, '1', NULL),
(162, 'Muhammad Ihsan Ramadani', '$2y$10$5VRvjyMpv1xvqvRD61oH8uIxjD4EejRdKUQbGQBu8jKXjXm7.2Ml2', 'siswa', 'muhammad.ihsan.ramadani@gmail.com', '2025-06-19 15:29:55', NULL, NULL, NULL, '1', NULL),
(163, 'MUHAMMAD IQBAL', '$2y$10$Vi4IDPP3wM/ElMCrsH3Os.t96f/kLlx/3S5GTpT09jhjstbT1tu.W', 'siswa', 'muhammad.iqbal@gmail.com', '2025-06-19 15:29:55', NULL, NULL, NULL, '1', NULL),
(164, 'MUHAMMAD MARFEL', '$2y$10$0JVz6CrsTxBffFGrZbbd..ayzm0i5GzGhJFwvKtaF1SOKBZ5aMg9O', 'siswa', 'muhammad.marfel@gmail.com', '2025-06-19 15:29:55', NULL, NULL, NULL, '1', NULL),
(165, 'MUHAMMAD MOHAN ALTHAF', '$2y$10$73i8synVCcIigiyGxohKDeTxLkSuD2FRTgNM8oy1e2jyGKXQG/LdO', 'siswa', 'muhammad.mohan.althaf@gmail.com', '2025-06-19 15:29:55', NULL, NULL, NULL, '1', NULL),
(166, 'MUHAMMAD NOR AULIA', '$2y$10$Wn30c36Wmg968XU1J5LAQuqSqaxhL6xDCU8Cix5XlLg2EZwM9HLo6', 'siswa', 'muhammad.nor.aulia@gmail.com', '2025-06-19 15:29:55', NULL, NULL, NULL, '1', NULL),
(167, 'MUHAMMAD RAFA', '$2y$10$GYf5t.5ZJsmG6aIcD0ZKW.n1/j5LjF8hSCFW8aam70Z7Aa9wg4hNu', 'siswa', 'muhammad.rafa@gmail.com', '2025-06-19 15:29:56', NULL, NULL, NULL, '1', NULL),
(168, 'MUHAMMAD RENDRA', '$2y$10$rES9KFWBQIM/hGzsfjOK6eCn7vxWHNF3CrfA4DSL2NctNd6k5gsfS', 'siswa', 'muhammad.rendra@gmail.com', '2025-06-19 15:29:56', NULL, NULL, NULL, '1', NULL),
(169, 'MUHAMMAD RIDHO AGUSTIAN', '$2y$10$DS9zZpTPxT9OI1C49QskI.KsEkxwhraRxm4pQlign16PzHpIyeUOe', 'siswa', 'muhammad.ridho.agustian@gmail.com', '2025-06-19 15:29:56', NULL, NULL, NULL, '1', NULL),
(170, 'MUHAMMAD RISKI', '$2y$10$l.ZqXB51llJGpAZQfVZph.poDEEGZX030hBXHPSwmID3NUgAEOFdq', 'siswa', 'muhammad.riski@gmail.com', '2025-06-19 15:29:56', NULL, NULL, NULL, '1', NULL),
(171, 'Muhammad Rizky', '$2y$10$Wpgj4kdrFJhA68r3LBRRGuD1JizLk1u01zDzcVcJmKdt.4I8j.Ltq', 'siswa', 'muhammad.rizky@gmail.com', '2025-06-19 15:29:56', NULL, NULL, NULL, '1', NULL),
(172, 'MUSLIMAH APRILIA', '$2y$10$cge8hfaCJ90uc.S4RoyrLOTUOq6Arc19P27SylOYRV51P9C8bgibC', 'siswa', 'muslimah.aprilia@gmail.com', '2025-06-19 15:29:56', NULL, NULL, NULL, '1', NULL),
(173, 'Mutia Khansa', '$2y$10$U36wK7NJW1V2YJ71CSfsm.CR5ADKRPPYdumvO75IQOo1Rj3xwXC06', 'siswa', 'mutia.khansa@gmail.com', '2025-06-19 15:29:56', NULL, NULL, NULL, '1', NULL),
(174, 'NABILAH NA\'ILAH SALWAA', '$2y$10$1umxh0Gok1QlMxLQ0gVxjuceXOYDaJao7q0Z0AS2bPVSs8qVHT0mO', 'siswa', 'nabilah.nailah.salwaa@gmail.com', '2025-06-19 15:29:56', NULL, NULL, NULL, '1', NULL),
(175, 'NADIA AYU SEPTINA', '$2y$10$OqrVvxPOcZfsCrGWOmcgwOSvDw//f/lMa49Gg/cHhOeT72CnW6npC', 'siswa', 'nadia.ayu.septina@gmail.com', '2025-06-19 15:29:57', NULL, NULL, NULL, '1', NULL),
(176, 'NAFIISAH TURESTA', '$2y$10$xbCReDi5gWErLBKR5kxM3OzObMtL2PRLA1nkmTxSi8E5BRXb2p/1W', 'siswa', 'nafiisah.turesta@gmail.com', '2025-06-19 15:29:57', NULL, NULL, NULL, '1', NULL),
(177, 'nafila marwa', '$2y$10$YTNnAv5BvlNV0ZpT2AnSduulX5gVn5oJx6YJFm6bklI7.00wrTOs2', 'siswa', 'nafila.marwa@gmail.com', '2025-06-19 15:29:57', NULL, NULL, NULL, '1', NULL),
(178, 'Naila Safira', '$2y$10$FIHP3OPYZyU8HMJhGafMTOPguQlXuCALTohQA6KpXXjBfhoJKmBnu', 'siswa', 'naila.safira@gmail.com', '2025-06-19 15:29:57', NULL, NULL, NULL, '1', NULL),
(179, 'Najla Nabilla', '$2y$10$B/e3NHlVyAQVSUyKS7irIuT6GhwEvExDJX/dHwrjXaIKmdeRjlTNW', 'siswa', 'najla.nabilla@gmail.com', '2025-06-19 15:29:57', NULL, NULL, NULL, '1', NULL),
(180, 'NAJWA AQELA REZKI', '$2y$10$C5yi8Bdm0rUY2aQ.Hd/0qeIg5OVoL8xm0sghPGdy6PdkOjDJPhDKC', 'siswa', 'najwa.aqela.rezki@gmail.com', '2025-06-19 15:29:57', NULL, NULL, NULL, '1', NULL),
(181, 'NAURA NISA SALSABILA', '$2y$10$Vbjsmy41jVBgZdwclkykCu44Q7Pv.1v5rLL8fS2UE0JOLrU0Ob0Oq', 'siswa', 'naura.nisa.salsabila@gmail.com', '2025-06-19 15:29:57', NULL, NULL, NULL, '1', NULL),
(182, 'NAYSILA WINI SAPUTRI', '$2y$10$0kgIDPEG8N3K3wMXLg/UCegMW...CUJ2jJbr5zLM0M7rEx1WrwWJC', 'siswa', 'naysila.wini.saputri@gmail.com', '2025-06-19 15:29:57', NULL, NULL, NULL, '1', NULL),
(183, 'NAZA ADYA SILVANA', '$2y$10$7/XAt7d4Y/jrYaZS4lT.bOffLBqRonWEQawwxHcb9dgOjWlbHyc1a', 'siswa', 'naza.adya.silvana@gmail.com', '2025-06-19 15:29:58', NULL, NULL, NULL, '1', NULL),
(184, 'Nazifatus Sabila', '$2y$10$n7mZ2Q5sHretFHWNt3LM/OBSC/lOBzvuabjX.fyaPQfKGSIVHN3/q', 'siswa', 'nazifatus.sabila@gmail.com', '2025-06-19 15:29:58', NULL, NULL, NULL, '1', NULL),
(185, 'NAZWATUN AZIZAH', '$2y$10$U0u1uk1XSjt./fzqAdGu7O0TG9cUJsfl9yJvQEGdKZ73E4M/rBvNK', 'siswa', 'nazwatun.azizah@gmail.com', '2025-06-19 15:29:58', NULL, NULL, NULL, '1', NULL),
(186, 'NIA RAMADANI', '$2y$10$Q6QXlkveaeoaq6mTA/RZ9ubfALcNN1x2T2mMuG4LDhRlApX4WS0ke', 'siswa', 'nia.ramadani@gmail.com', '2025-06-19 15:29:58', NULL, NULL, NULL, '1', NULL),
(187, 'NIDAURRAHMAH', '$2y$10$5ZYHWAVbI6O0ilAXmPNL8OwhXtA.nNaGG2Hol2PKYtzuQ6bOZfeLC', 'siswa', 'nidaurrahmah@gmail.com', '2025-06-19 15:29:58', NULL, NULL, NULL, '1', NULL),
(188, 'NOPRIYANSAH', '$2y$10$Kah09qurnEEiUBisO7bAx.Os/2og79NJyY1SqBIs1VLsqY6p7Pl5u', 'siswa', 'nopriyansah@gmail.com', '2025-06-19 15:29:58', NULL, NULL, NULL, '1', NULL),
(189, 'Novita Enjelina Manurung', '$2y$10$RvwBbbVL.y42Bdcb7XxTE.yWlCwKBOmzX/.N3/GQfzJ4MpXIATZGq', 'siswa', 'novita.enjelina.manurung@gmail.com', '2025-06-19 15:29:58', NULL, NULL, NULL, '1', NULL),
(190, 'NUR ANISA', '$2y$10$q2p58BgTsX9zW5fxRtoCK.cb05vB.ygqodZwsHKMVemo0os7jjCHi', 'siswa', 'nur.anisa@gmail.com', '2025-06-19 15:29:58', NULL, NULL, NULL, '1', NULL),
(191, 'NUR JHOHRA', '$2y$10$.D3OG.jYl21hauVJnICRgu.dxsdpuqHUEWAFTgpdbJzv.Sf4gBPZi', 'siswa', 'nur.jhohra@gmail.com', '2025-06-19 15:29:58', NULL, NULL, NULL, '1', NULL),
(192, 'Nur Milah Alifah', '$2y$10$h5KZu0WxoeaqfrAb.oDK8eHL71IsyudE44MGPIFgvZ4lkVnhXN1yO', 'siswa', 'nur.milah.alifah@gmail.com', '2025-06-19 15:29:59', NULL, NULL, NULL, '1', NULL),
(193, 'NURAINI AZURA', '$2y$10$KyZlL39N3MckuYSI2EX/reSMe4P1MjcZkcYE6aq4QFoHXQnHnLtQy', 'siswa', 'nuraini.azura@gmail.com', '2025-06-19 15:29:59', NULL, NULL, NULL, '1', NULL),
(194, 'NURAMALIYANA', '$2y$10$lWxBkgVLt2czgTSzO1vUEutXO9iKqrY8Eas7x/21LPtyJ5ZZzIwSK', 'siswa', 'nuramaliyana@gmail.com', '2025-06-19 15:29:59', NULL, NULL, NULL, '1', NULL),
(195, 'NURFADILAH', '$2y$10$2L14Ajk64DBpgXNcwHQKlOBRWUmwXjaxb1vWM/gja5qM8ivN2dKXG', 'siswa', 'nurfadilah@gmail.com', '2025-06-19 15:29:59', NULL, NULL, NULL, '1', NULL),
(196, 'NURHAPNI', '$2y$10$J7FpDbyWtQJcJphhcEO2NeYFM4BqJbKn17OcosL3ONnJP5uNXTeo2', 'siswa', 'nurhapni@gmail.com', '2025-06-19 15:29:59', NULL, NULL, NULL, '1', NULL),
(197, 'NURUL FARADILA', '$2y$10$WN4SqfBXkdGbGJQHHr2no.LMxQbjWtHnj.Z4e/G4jJYWCEAxprCDe', 'siswa', 'nurul.faradila@gmail.com', '2025-06-19 15:29:59', NULL, NULL, NULL, '1', NULL),
(198, 'PRAYOGA', '$2y$10$2r94J/reJDU5FTQVJ4EUcO02QdESnIr6Fw325SZfx3fL07bsd7hNm', 'siswa', 'prayoga@gmail.com', '2025-06-19 15:29:59', NULL, NULL, NULL, '1', NULL),
(199, 'PUTRI NOVITA', '$2y$10$cbcw1bRF8U49c8AhSriWBOapwa8bFsEshHARYcnhUORnPK1iqGdlS', 'siswa', 'putri.novita@gmail.com', '2025-06-19 15:29:59', NULL, NULL, NULL, '1', NULL),
(200, 'PUTRI PIONA', '$2y$10$Ps/Dx3k9iL/8rDvfH7Tyuuc6n2JZtwfiNyrhUM5tSTNcF2xD283Re', 'siswa', 'putri.piona@gmail.com', '2025-06-19 15:29:59', NULL, NULL, NULL, '1', NULL),
(201, 'RADEN DAFA AL BAIHAQI', '$2y$10$Ap2gvmTQItrR0aOPtmzBse4ry3cpV0Pw.3IQh9K3dhjegdO0e6NoC', 'siswa', 'raden.dafa.al.baihaqi@gmail.com', '2025-06-19 15:30:00', NULL, NULL, NULL, '1', NULL),
(202, 'RAHMA DELA', '$2y$10$BQ/7nIt7p3.Sku1J7fZJVub4QJ9fnv435A7VBS7Z67OjCbPJ7VDqy', 'siswa', 'rahma.dela@gmail.com', '2025-06-19 15:30:00', NULL, NULL, NULL, '1', NULL),
(203, 'RAHMA WATI', '$2y$10$8755XVxYjPCAyHxuXsAkJu/Swq9Vqy0fbqFPorfOt0ilDBWSnzUsW', 'siswa', 'rahma.wati@gmail.com', '2025-06-19 15:30:00', NULL, NULL, NULL, '1', NULL),
(204, 'RAHMAH', '$2y$10$ETXydB.P7EowL.eB6j4VXuBU4IpTXGcFsTqiDB9pzub2vwviAL2iS', 'siswa', 'rahmah@gmail.com', '2025-06-19 15:30:00', NULL, NULL, NULL, '1', NULL),
(205, 'Rahman Pratama', '$2y$10$h2FeX7B1WEfGsgYWs5MqDu8uRRH1T6T.Pl06w7LhZYnrNS6PK4hrW', 'siswa', 'rahman.pratama@gmail.com', '2025-06-19 15:30:00', NULL, NULL, NULL, '1', NULL),
(206, 'Rahmat Hidayat', '$2y$10$bsAjrjmzpc7EsU.1h5/HSetcbjj49j1EQU.ELgzLBQTkYbv4hpF1e', 'siswa', 'rahmat.hidayat@gmail.com', '2025-06-19 15:30:00', NULL, NULL, NULL, '1', NULL),
(207, 'RAHMAT JUNADI', '$2y$10$mNajcDOzeeMeJxQygVjVcey.8T5pLGpyKwSLBd578iWltM6usEQ5i', 'siswa', 'rahmat.junadi@gmail.com', '2025-06-19 15:30:00', NULL, NULL, NULL, '1', NULL),
(208, 'RAHMAT RANDY DWI PUTRA', '$2y$10$kZ4MykV30eebjgu55hqZWOtieslRfSi8ROjUpkKrxym7KPVgrCHI2', 'siswa', 'rahmat.randy.dwi.putra@gmail.com', '2025-06-19 15:30:01', NULL, NULL, NULL, '1', NULL),
(209, 'RAIHAN KURNIA SYAPUTRA', '$2y$10$mckn2XXiroyedMeSggXLQu9QvxSA31Aigsn8LSkFGkHhctpwCroj.', 'siswa', 'raihan.kurnia.syaputra@gmail.com', '2025-06-19 15:30:01', NULL, NULL, NULL, '1', NULL),
(210, 'RAINA TASDIA', '$2y$10$xKcTScTQ0lsMxpHw8Ll9P.DPx/KMYqHiVUcIyKgW65Wo8o5EInymq', 'siswa', 'raina.tasdia@gmail.com', '2025-06-19 15:30:01', NULL, NULL, NULL, '1', NULL),
(211, 'RAPI ACHMAD', '$2y$10$NCgQiaFa5sy7beNoZtvJROrMOnaiQwRcU0ytvBQUJAeAHUhas581y', 'siswa', 'rapi.achmad@gmail.com', '2025-06-19 15:30:01', NULL, NULL, NULL, '1', NULL),
(212, 'RATU SIMA', '$2y$10$8SUb1BVbwB5lmeBsKeb2HeX816Kx80v7foctIP2AOL.MeCINP7hf.', 'siswa', 'ratu.sima@gmail.com', '2025-06-19 15:30:01', NULL, NULL, NULL, '1', NULL),
(213, 'RIAN', '$2y$10$qiCzU441pqEUItECDtXeeuWCCJ2WBcjj9x40yceCFwGXDe8Bf5Oje', 'siswa', 'rian@gmail.com', '2025-06-19 15:30:01', NULL, NULL, NULL, '1', NULL),
(214, 'Ridho Rizqullah', '$2y$10$NVs1y7etPnsFsHvFga6pp.IeuCChd/P/hXKadBx/AswLDt4XAfaMu', 'siswa', 'ridho.rizqullah@gmail.com', '2025-06-19 15:30:01', NULL, NULL, NULL, '1', NULL),
(215, 'RIFA RAHMADANI', '$2y$10$m4Pyvm5GgI2.XTKFiyDrUegN8KaRRXAq9ESPRKnlSIQx1RIPwJGnq', 'siswa', 'rifa.rahmadani@gmail.com', '2025-06-19 15:30:01', NULL, NULL, NULL, '1', NULL),
(216, 'RIFKA ASYKA  ZAFIRA', '$2y$10$dJ2cNeVHtuZm8/0r3gRkOufdLD9ID3k27q4mMuYwueBRprMF8XD5a', 'siswa', 'rifka.asyka.zafira@gmail.com', '2025-06-19 15:30:01', NULL, NULL, NULL, '1', NULL),
(217, 'RIRI RINJANI KADHITA', '$2y$10$DOhvQu2glNGVMKiYBTtJXOjTpgvnzkHZxJqj/Rzju3U8fDn3s.UgW', 'siswa', 'riri.rinjani.kadhita@gmail.com', '2025-06-19 15:30:02', NULL, NULL, NULL, '1', NULL),
(218, 'RISKI EGI YANTI', '$2y$10$Dc0x2usQcMI6kyQoCN5tDOa1QEEH4SgPpqV8mxvRNGpIyLNYK7mfq', 'siswa', 'riski.egi.yanti@gmail.com', '2025-06-19 15:30:02', NULL, NULL, NULL, '1', NULL),
(219, 'RIZKA AMELIA', '$2y$10$7yVTAgSOes0Rg0S0emCXGehNEIy8ezN4ItQNyUa0vbjjCZVg.ceEy', 'siswa', 'rizka.amelia@gmail.com', '2025-06-19 15:30:02', NULL, NULL, NULL, '1', NULL),
(220, 'Rizki Rahmat', '$2y$10$pXG5ivS82hD4lX9IufGtie4gBVSs15v7dFfUmTg8JT8CjZs8g8Rma', 'siswa', 'rizki.rahmat@gmail.com', '2025-06-19 15:30:02', NULL, NULL, NULL, '1', NULL),
(221, 'RIZKY ADITYA', '$2y$10$fURo/tKYL8WK6HU5FmnHs.FXehg6LZTRTrJPv8z.A/xomMf4Y/eX6', 'siswa', 'rizky.aditya@gmail.com', '2025-06-19 15:30:02', NULL, NULL, NULL, '1', NULL),
(222, 'SA\'ADATUL HUSNA', '$2y$10$6zc5zj8S2K8mj8PmJHCCyespxQcQV2Obto4XsRDMu18u7ZVovO/RK', 'siswa', 'saadatul.husna@gmail.com', '2025-06-19 15:30:02', NULL, NULL, NULL, '1', NULL),
(223, 'SAFA\'AT RUDIANSYAH', '$2y$10$E/kh4ic30v/Ys1rRHeKfseCbkiIM4Gkugd6yB8siJoaOLwXjsJ0YW', 'siswa', 'safaat.rudiansyah@gmail.com', '2025-06-19 15:30:02', NULL, NULL, NULL, '1', NULL),
(224, 'SAFIRA', '$2y$10$3Trj3avHipEJ9rC4jsabXuJAam6NOf0MaDUfE/Wi4bOFBBTENf5Qi', 'siswa', 'safira@gmail.com', '2025-06-19 15:30:02', NULL, NULL, NULL, '1', NULL),
(225, 'SAFRIANDI', '$2y$10$K8ssLHdVXeOf29eqYs/JguqQguAoY0RxW8KpmXfSyF60frpD1W5vm', 'siswa', 'safriandi@gmail.com', '2025-06-19 15:30:03', NULL, NULL, NULL, '1', NULL),
(226, 'SAFRIANTI', '$2y$10$MZ2Lowdk1lyLGDFenJ1mLODa92SrFS4gRCm7Hm83HSp2xPZmrpR.S', 'siswa', 'safrianti@gmail.com', '2025-06-19 15:30:03', NULL, NULL, NULL, '1', NULL),
(227, 'SAHRIYANTO', '$2y$10$g5GdZV.hFHalHI/CGy6M3uOcziTNqDRP.Ng.W/u.uCJeWvSc6sR92', 'siswa', 'sahriyanto@gmail.com', '2025-06-19 15:30:03', NULL, NULL, NULL, '1', NULL),
(228, 'SAPRIZAL', '$2y$10$0XOuEvRWQs9hoeaCvaujQOB34uwzwfQ2c3weQSyRAyFATMtbBJ5vO', 'siswa', 'saprizal@gmail.com', '2025-06-19 15:30:03', NULL, NULL, NULL, '1', NULL),
(229, 'Sasta Julia Normahendra', '$2y$10$fmlXOLYhdKTzUT7WiQJpUOswQOGIxp05qwoT0TiniAjfUEeSqzjvy', 'siswa', 'sasta.julia.normahendra@gmail.com', '2025-06-19 15:30:03', NULL, NULL, NULL, '1', NULL),
(230, 'Sismiati Zahara', '$2y$10$ESlpaw4sgO6q80SIJyehk.NCfY97FpMqXJADWpPf317jw3ByhqIMG', 'siswa', 'sismiati.zahara@gmail.com', '2025-06-19 15:30:03', NULL, NULL, NULL, '1', NULL),
(231, 'SITI FATIMAH', '$2y$10$lbkSAnbFAubAzDgiXlGYNuLqu8kKvZBruWBeImYDDmkQI9Sk1oBmC', 'siswa', 'siti.fatimah@gmail.com', '2025-06-19 15:30:04', NULL, NULL, NULL, '1', NULL),
(232, 'SITI FAUZA AZZAHRA', '$2y$10$agLw1gQ4SenhUJ01gcsPIu3uKFxJB8EuSPLfKG0.qi.E98EZyn4kS', 'siswa', 'siti.fauza.azzahra@gmail.com', '2025-06-19 15:30:04', NULL, NULL, NULL, '1', NULL),
(233, 'SITI HADIJAH', '$2y$10$Jm7ZrK3H76MDxd7lOHsB9eNeXO4N8i0IAiyiUtyBJF46HPjC.magm', 'siswa', 'siti.hadijah@gmail.com', '2025-06-19 15:30:04', NULL, NULL, NULL, '1', NULL),
(234, 'SITI HAFIZA', '$2y$10$pSp0jQvT6uGnjlBG8xIAqO7T.vvPOvWSg13Las5EpLrSUF9Vn/cfK', 'siswa', 'siti.hafiza@gmail.com', '2025-06-19 15:30:04', NULL, NULL, NULL, '1', NULL),
(235, 'SITI KHADIJAH', '$2y$10$iJ0hXdPO74tAe1lNW7NQTuq5pZrWU..sJHyC26l9wdLaHTPWpuNvK', 'siswa', 'siti.khadijah@gmail.com', '2025-06-19 15:30:05', NULL, NULL, NULL, '1', NULL),
(236, 'SITI ZULAIKA', '$2y$10$tNDFmD1H7cVxkGtlrQK.6uDDlINNpT2Jn177wtcoqcA/qMJoopppi', 'siswa', 'siti.zulaika@gmail.com', '2025-06-19 15:30:05', NULL, NULL, NULL, '1', NULL),
(237, 'SUCI ARIYANTI', '$2y$10$vTMT5P5oXcQhEluiWD11te74kaAi3tvLa.VicAgTkALdYkGNbNZaO', 'siswa', 'suci.ariyanti@gmail.com', '2025-06-19 15:30:05', NULL, NULL, NULL, '1', NULL),
(238, 'SULTAN NAUFAL ISKANDAR', '$2y$10$yGvjidR9vPMc24jr.l4ine/4.0xfCO3Sn7.Sj6hus4L38Ge1/J5Xi', 'siswa', 'sultan.naufal.iskandar@gmail.com', '2025-06-19 15:30:05', NULL, NULL, NULL, '1', NULL),
(239, 'SYAHIRA MARYANDA PUTRI', '$2y$10$pE7nAvXwLgoaW2LWZclybefzbTGI2TM0XUO4f83sjjtZvKMTpqWVe', 'siswa', 'syahira.maryanda.putri@gmail.com', '2025-06-19 15:30:06', NULL, NULL, NULL, '1', NULL),
(240, 'SYARI FATUL AULIA', '$2y$10$ebJ0Vdj0qbcq0kkeS2ymbeBRV8jD.VoQtAyabZLjNNAxxG3N9VdHi', 'siswa', 'syari.fatul.aulia@gmail.com', '2025-06-19 15:30:06', NULL, NULL, NULL, '1', NULL),
(241, 'SYILLA NADIRA CHAIRUNNISA', '$2y$10$ew4n1yITZJV3vkcp1VsMNuIhzIlnIUh7f83rkc8qDGwHHeNuTGeMy', 'siswa', 'syilla.nadira.chairunnisa@gmail.com', '2025-06-19 15:30:06', NULL, NULL, NULL, '1', NULL),
(242, 'Tesa Ferbriana Salsabela', '$2y$10$pwcr3SS9wkIsoBxev07JOOQ/7CDh9nuNk/Ud1JMoXjRIak74yInmO', 'siswa', 'tesa.ferbriana.salsabela@gmail.com', '2025-06-19 15:30:07', NULL, NULL, NULL, '1', NULL),
(243, 'Tiara Arumulan', '$2y$10$PARKcaN39gtQucBnbfs0YeO0vXIffnjCkN1Qt0xDSp1tj3ZrhAlvq', 'siswa', 'tiara.arumulan@gmail.com', '2025-06-19 15:30:07', NULL, NULL, NULL, '1', NULL),
(244, 'TSANIA AZZAHRA', '$2y$10$AzpvXb9NtIY8tRu4Ho1hlOui4LI.rAbaUVWQcAp3R5txOMn4m0/sm', 'siswa', 'tsania.azzahra@gmail.com', '2025-06-19 15:30:07', NULL, NULL, NULL, '1', NULL),
(245, 'UAIS AL QARIN', '$2y$10$CNSoeY3km63ES5ATMLVRz.syJKkDAxc18QzRKRq1DkGW.r9ilSeC6', 'siswa', 'uais.al.qarin@gmail.com', '2025-06-19 15:30:07', NULL, NULL, NULL, '1', NULL),
(246, 'UMMI ISSOFA ASDIANTI', '$2y$10$bEb9mWCXpdtnbD8XoGteKe9gA31CqzO0gAilBiAHcNeO84VPRjGdq', 'siswa', 'ummi.issofa.asdianti@gmail.com', '2025-06-19 15:30:09', NULL, NULL, NULL, '1', NULL),
(247, 'VALENE CALYSTA ANDRIANE', '$2y$10$.3Kun1CMpuzsfmcY7QSVm.cEgmLA19DtOWmmHWttgVswlL1GVzDwm', 'siswa', 'valene.calysta.andriane@gmail.com', '2025-06-19 15:30:10', NULL, NULL, NULL, '1', NULL),
(248, 'VANISA RAHMA SAFIRA', '$2y$10$5Huc8354jNqD2SPDnKL14uLINmCP3no75bZfNGxBhKzg8PVqCoH0m', 'siswa', 'vanisa.rahma.safira@gmail.com', '2025-06-19 15:30:10', NULL, NULL, NULL, '1', NULL),
(249, 'WAHYUNI WULANDARI', '$2y$10$qYlk9AGUARx/DEo6/70l0OawMBqaxLPUB9sajDmXFoe7QPLpmp3Vu', 'siswa', 'wahyuni.wulandari@gmail.com', '2025-06-19 15:30:10', NULL, NULL, NULL, '1', NULL),
(250, 'YETI ANGGRAINI', '$2y$10$zyE07FAO1G9vJhdEhyJNdeT288I04nOJh8MxD.xn.e/SeH27dWohG', 'siswa', 'yeti.anggraini@gmail.com', '2025-06-19 15:30:10', NULL, NULL, NULL, '1', NULL),
(251, 'YOGA AGUSTIARSA', '$2y$10$x0d/j2lXwfVi7AZ2i1RSWOVsd..gQ8v8.e4XYr2kAIMgbSklpMqHu', 'siswa', 'yoga.agustiarsa@gmail.com', '2025-06-19 15:30:10', NULL, NULL, NULL, '1', NULL),
(252, 'YOGI AGUSTIANSA', '$2y$10$lWFJ4Gvu32Dsq7ywTwOGUOHFsfyq2XzqmKljlEfwnTtZjVTOToHIy', 'siswa', 'yogi.agustiansa@gmail.com', '2025-06-19 15:30:11', NULL, NULL, NULL, '1', NULL),
(253, 'YOLA WULANDARI', '$2y$10$HCZW8ff6yj8J1XxGlrmHkO2HSIo1fanjWDcS5fivp9n2hAB9KLo8.', 'siswa', 'yola.wulandari@gmail.com', '2025-06-19 15:30:11', NULL, NULL, NULL, '1', NULL),
(254, 'ZAKIA NAZWA', '$2y$10$RHmsfsc.wI.XD3aq/j4XTeapuPWCkAnchEIbzbaoQmHRcMFMtJu9q', 'siswa', 'zakia.nazwa@gmail.com', '2025-06-19 15:30:11', NULL, NULL, NULL, '1', NULL),
(255, 'ZENNY PRAMUDITA', '$2y$10$HY461OFQPn.KTouFcp5yauzbb2eP8.vne8msd4JQt0VVtPKWpD8Ma', 'siswa', 'zenny.pramudita@gmail.com', '2025-06-19 15:30:11', NULL, NULL, NULL, '1', NULL),
(256, 'ZIKRI HAKIM', '$2y$10$e8./J8alqAGepOvtAlxuAezM8n75b6P5QjrzCm/83I3j5zQSaAEbO', 'siswa', 'zikri.hakim@gmail.com', '2025-06-19 15:30:11', NULL, NULL, NULL, '1', NULL),
(257, 'ZULFA AZIZAH', '$2y$10$wUTE5UNlJraXbRFnHAOpP.mUlQFPVGqbMUgUqj44Pu27FJdBoTO8e', 'siswa', 'zulfa.azizah@gmail.com', '2025-06-19 15:30:11', NULL, NULL, NULL, '1', NULL),
(258, 'ZULFIKAR AZMI', '$2y$10$RSG.pfeZmrG4EYOCv.np/OH9TTCKY9LuQ3jtgwQ5XyMEmZWctzKxW', 'siswa', 'zulfikar.azmi@gmail.com', '2025-06-19 15:30:11', NULL, NULL, NULL, '1', NULL),
(259, 'ZULKARNAIN FADILLAH', '$2y$10$GsB5FLs4WzJJtLCqP8gl4O3BvOq47VaEzE5udophnlwySQYssiyU6', 'siswa', 'zulkarnain.fadillah@gmail.com', '2025-06-19 15:30:11', NULL, NULL, NULL, '1', NULL),
(260, 'adam', '$2y$10$aa1T/ckVwtvoPGtuFKF8W.1doexRMWt4b6re5F7lvlKza5sEPja8m', 'guru', 'adam@gmail.com', '2025-08-01 10:55:44', '0jk3qmtdv5ih9qab2sb237959fkdse5k', '2025-09-02 15:26:08', '2025-09-03 10:51:04', '1', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catatan_konseling`
--
ALTER TABLE `catatan_konseling`
  ADD PRIMARY KEY (`catatan_id`),
  ADD KEY `catatan_konseling_ibfk_1` (`jadwal_id`);

--
-- Indexes for table `edukasi`
--
ALTER TABLE `edukasi`
  ADD PRIMARY KEY (`edukasi_id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`guru_id`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `jadwal_konseling`
--
ALTER TABLE `jadwal_konseling`
  ADD PRIMARY KEY (`jadwal_id`),
  ADD KEY `jadwal_konseling_ibfk_1` (`siswa_id`),
  ADD KEY `jadwal_konseling_ibfk_2` (`guru_id`);

--
-- Indexes for table `jenis_pelanggaran`
--
ALTER TABLE `jenis_pelanggaran`
  ADD PRIMARY KEY (`jenis_id`);

--
-- Indexes for table `laporan_pengaduan`
--
ALTER TABLE `laporan_pengaduan`
  ADD PRIMARY KEY (`laporan_id`),
  ADD KEY `siswa_id` (`siswa_id`),
  ADD KEY `guru_id` (`guru_id`);

--
-- Indexes for table `minat_bakat`
--
ALTER TABLE `minat_bakat`
  ADD PRIMARY KEY (`minat_id`),
  ADD UNIQUE KEY `siswa_id` (`siswa_id`);

--
-- Indexes for table `orangtua`
--
ALTER TABLE `orangtua`
  ADD PRIMARY KEY (`wali_id`),
  ADD KEY `siswa_id` (`siswa_id`);

--
-- Indexes for table `pelanggaran_siswa`
--
ALTER TABLE `pelanggaran_siswa`
  ADD PRIMARY KEY (`pelanggaran_id`),
  ADD KEY `jenis_id` (`jenis_id`),
  ADD KEY `pelanggaran_siswa_ibfk_1` (`siswa_id`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Indexes for table `pengajuan_konseling`
--
ALTER TABLE `pengajuan_konseling`
  ADD PRIMARY KEY (`pengajuan_id`),
  ADD KEY `pengajuan_konseling_ibfk_1` (`siswa_id`);

--
-- Indexes for table `pengembangan_diri`
--
ALTER TABLE `pengembangan_diri`
  ADD PRIMARY KEY (`pengembangan_id`),
  ADD KEY `siswa_id` (`siswa_id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`siswa_id`),
  ADD UNIQUE KEY `nisn` (`nisn`),
  ADD KEY `siswa_ibfk_1` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catatan_konseling`
--
ALTER TABLE `catatan_konseling`
  MODIFY `catatan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `edukasi`
--
ALTER TABLE `edukasi`
  MODIFY `edukasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `guru_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jadwal_konseling`
--
ALTER TABLE `jadwal_konseling`
  MODIFY `jadwal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `jenis_pelanggaran`
--
ALTER TABLE `jenis_pelanggaran`
  MODIFY `jenis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `laporan_pengaduan`
--
ALTER TABLE `laporan_pengaduan`
  MODIFY `laporan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `minat_bakat`
--
ALTER TABLE `minat_bakat`
  MODIFY `minat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orangtua`
--
ALTER TABLE `orangtua`
  MODIFY `wali_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelanggaran_siswa`
--
ALTER TABLE `pelanggaran_siswa`
  MODIFY `pelanggaran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pengajuan_konseling`
--
ALTER TABLE `pengajuan_konseling`
  MODIFY `pengajuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengembangan_diri`
--
ALTER TABLE `pengembangan_diri`
  MODIFY `pengembangan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `siswa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `catatan_konseling`
--
ALTER TABLE `catatan_konseling`
  ADD CONSTRAINT `catatan_konseling_ibfk_1` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal_konseling` (`jadwal_id`) ON DELETE CASCADE;

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `jadwal_konseling`
--
ALTER TABLE `jadwal_konseling`
  ADD CONSTRAINT `jadwal_konseling_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`siswa_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_konseling_ibfk_2` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`guru_id`) ON DELETE CASCADE;

--
-- Constraints for table `laporan_pengaduan`
--
ALTER TABLE `laporan_pengaduan`
  ADD CONSTRAINT `guru_id` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`guru_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `siswa_id` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`siswa_id`) ON DELETE CASCADE;

--
-- Constraints for table `minat_bakat`
--
ALTER TABLE `minat_bakat`
  ADD CONSTRAINT `minat_bakat_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`siswa_id`) ON DELETE CASCADE;

--
-- Constraints for table `orangtua`
--
ALTER TABLE `orangtua`
  ADD CONSTRAINT `orangtua_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`siswa_id`);

--
-- Constraints for table `pelanggaran_siswa`
--
ALTER TABLE `pelanggaran_siswa`
  ADD CONSTRAINT `jenis_id` FOREIGN KEY (`jenis_id`) REFERENCES `jenis_pelanggaran` (`jenis_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pelanggaran_siswa_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`siswa_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pelanggaran_siswa_ibfk_2` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`) ON DELETE CASCADE;

--
-- Constraints for table `pengajuan_konseling`
--
ALTER TABLE `pengajuan_konseling`
  ADD CONSTRAINT `pengajuan_konseling_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`siswa_id`) ON DELETE CASCADE;

--
-- Constraints for table `pengembangan_diri`
--
ALTER TABLE `pengembangan_diri`
  ADD CONSTRAINT `pengembangan_diri_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`siswa_id`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
