-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 07, 2024 at 04:38 PM
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
-- Database: `pptsb`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `delCabang` (IN `cabangId` INT)   DELETE FROM cabang WHERE id_cabang = cabangId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delJenis` (IN `jenisId` INT)   DELETE FROM jenis_kegiatan WHERE id_jenis_kegiatan = jenisId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delSektor` (IN `sektorId` INT)   DELETE FROM sektor WHERE id_sektor = sektorId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delWaktu` (IN `waktuId` INT)   DELETE FROM waktu_kegiatan WHERE id_waktu_kegiatan = waktuId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllCabang` ()   SELECT * FROM cabang$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllJenis` ()   SELECT * FROM jenis_kegiatan$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllSektor` ()   SELECT * FROM sektor$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllWaktu` ()   SELECT * FROM waktu_kegiatan$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getCabang` (IN `cabangId` INT)   SELECT * FROM cabang WHERE id_cabang = cabangId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getJenis` (IN `jenisId` INT)   SELECT * FROM jenis_kegiatan WHERE id_jenis_kegiatan = jenisId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getSektor` (IN `sektorId` INT)   SELECT * FROM sektor WHERE id_sektor = sektorId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getWaktu` (IN `waktuId` INT)   SELECT * FROM waktu_kegiatan WHERE id_waktu_kegiatan = waktuId$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama_lengkap` text NOT NULL,
  `id_registrasi` int(16) NOT NULL,
  `NIK` int(16) NOT NULL,
  `pekerjaan` varchar(25) NOT NULL,
  `tempat_lahir` text NOT NULL,
  `jenis_kelamin` enum('Perempuan','Laki - Laki','','') NOT NULL,
  `id_hub_keluarga` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_sektor` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` int(16) NOT NULL,
  `foto_anggota` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE `cabang` (
  `id_cabang` int(11) NOT NULL,
  `kode_cabang` int(11) NOT NULL,
  `nama_cabang` text NOT NULL,
  `alamat` text NOT NULL,
  `kepala_cabang` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cabang`
--

INSERT INTO `cabang` (`id_cabang`, `kode_cabang`, `nama_cabang`, `alamat`, `kepala_cabang`, `created_at`, `updated_at`) VALUES
(1, 112056, 'Cabang Baru', 'Jalan Contoh 123', 'Nama Kepala Cabang Baru', '2024-03-07 07:46:04', '2024-03-07 07:48:47'),
(3, 11422044, 'siantar', 'Jl. Makadame Raya no.8', 'Pematangsiantar', '2024-03-06 21:04:52', '2024-03-06 21:04:52'),
(4, 11422012, 'usu', 'Jl. Hadji Salim', 'Medan', '2024-03-07 04:08:00', '2024-03-07 04:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pindah`
--

CREATE TABLE `detail_pindah` (
  `id_det_reg_pindah` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `head_pindah`
--

CREATE TABLE `head_pindah` (
  `id_head_reg_pindah` int(11) NOT NULL,
  `id_registrasi` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `no_surat_pindah` int(25) NOT NULL,
  `tgl_pindah` datetime NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_sektor_tujuan` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hubungan_keluarga`
--

CREATE TABLE `hubungan_keluarga` (
  `id_hub_keluarga` int(11) NOT NULL,
  `nama_hub_keluarga` varchar(25) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `nama_jabatan` text NOT NULL,
  `tgl_pengukuhan` datetime NOT NULL,
  `akhir_jabatan` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kegiatan`
--

CREATE TABLE `jenis_kegiatan` (
  `id_jenis_kegiatan` int(11) NOT NULL,
  `nama_jenis_kegiatan` text NOT NULL,
  `keterangan` text NOT NULL,
  `id_sektor` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_kegiatan`
--

INSERT INTO `jenis_kegiatan` (`id_jenis_kegiatan`, `nama_jenis_kegiatan`, `keterangan`, `id_sektor`, `created_at`, `updated_at`) VALUES
(1, 'Beasiswa', 'Beasiswa peraih juara 1 umum', 1, '2024-03-07 14:55:38', '2024-03-07 14:55:38');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_status`
--

CREATE TABLE `jenis_status` (
  `id_jenis_status` int(11) NOT NULL,
  `jenis_status` char(16) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registrasi`
--

CREATE TABLE `registrasi` (
  `id_registrasi` int(11) NOT NULL,
  `no_registrasi` int(25) NOT NULL,
  `tgl_registrasi` datetime NOT NULL,
  `id_sektor` int(11) NOT NULL,
  `id_status_registrasi` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sektor`
--

CREATE TABLE `sektor` (
  `id_sektor` int(11) NOT NULL,
  `id_cabang` int(11) NOT NULL,
  `kode_sektor` int(11) NOT NULL,
  `nama_sektor` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  `kepala_sektor` text NOT NULL,
  `tgl_berdiri` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sektor`
--

INSERT INTO `sektor` (`id_sektor`, `id_cabang`, `kode_sektor`, `nama_sektor`, `alamat`, `kepala_sektor`, `tgl_berdiri`, `created_at`, `updated_at`) VALUES
(1, 1, 21151, 'Palmarum', 'Perumnas sekitarnya', 'Mr. Gilberd', '2024-03-07 12:34:56', '2024-03-07 14:23:22', '2024-03-07 14:23:22');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `status` char(16) NOT NULL,
  `id_jenis_status` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `waktu_kegiatan`
--

CREATE TABLE `waktu_kegiatan` (
  `id_waktu_kegiatan` int(11) NOT NULL,
  `id_jenis_kegiatan` int(11) NOT NULL,
  `nama_kegiatan` text NOT NULL,
  `lokasi_kegiatan` text NOT NULL,
  `waktu_kegiatan` datetime NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `waktu_kegiatan`
--

INSERT INTO `waktu_kegiatan` (`id_waktu_kegiatan`, `id_jenis_kegiatan`, `nama_kegiatan`, `lokasi_kegiatan`, `waktu_kegiatan`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Acara Penyerahan', 'Perumnas', '2024-03-07 12:34:56', 'Semoga datang semua', '2024-03-07 15:32:15', '2024-03-07 15:32:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `id_hub_keluarga` (`id_hub_keluarga`),
  ADD KEY `id_sektor` (`id_sektor`),
  ADD KEY `id_status` (`id_status`);

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id_cabang`);

--
-- Indexes for table `detail_pindah`
--
ALTER TABLE `detail_pindah`
  ADD PRIMARY KEY (`id_det_reg_pindah`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `head_pindah`
--
ALTER TABLE `head_pindah`
  ADD PRIMARY KEY (`id_head_reg_pindah`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_registrasi` (`id_registrasi`);

--
-- Indexes for table `hubungan_keluarga`
--
ALTER TABLE `hubungan_keluarga`
  ADD PRIMARY KEY (`id_hub_keluarga`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `jenis_kegiatan`
--
ALTER TABLE `jenis_kegiatan`
  ADD PRIMARY KEY (`id_jenis_kegiatan`),
  ADD KEY `id_sektor` (`id_sektor`);

--
-- Indexes for table `jenis_status`
--
ALTER TABLE `jenis_status`
  ADD PRIMARY KEY (`id_jenis_status`);

--
-- Indexes for table `registrasi`
--
ALTER TABLE `registrasi`
  ADD PRIMARY KEY (`id_registrasi`),
  ADD KEY `id_sektor` (`id_sektor`);

--
-- Indexes for table `sektor`
--
ALTER TABLE `sektor`
  ADD PRIMARY KEY (`id_sektor`),
  ADD KEY `id_cabang` (`id_cabang`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`),
  ADD KEY `id_jenis_status` (`id_jenis_status`);

--
-- Indexes for table `waktu_kegiatan`
--
ALTER TABLE `waktu_kegiatan`
  ADD PRIMARY KEY (`id_waktu_kegiatan`),
  ADD KEY `id_jenis_kegiatan` (`id_jenis_kegiatan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cabang`
--
ALTER TABLE `cabang`
  MODIFY `id_cabang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `detail_pindah`
--
ALTER TABLE `detail_pindah`
  MODIFY `id_det_reg_pindah` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `head_pindah`
--
ALTER TABLE `head_pindah`
  MODIFY `id_head_reg_pindah` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hubungan_keluarga`
--
ALTER TABLE `hubungan_keluarga`
  MODIFY `id_hub_keluarga` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_kegiatan`
--
ALTER TABLE `jenis_kegiatan`
  MODIFY `id_jenis_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jenis_status`
--
ALTER TABLE `jenis_status`
  MODIFY `id_jenis_status` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registrasi`
--
ALTER TABLE `registrasi`
  MODIFY `id_registrasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sektor`
--
ALTER TABLE `sektor`
  MODIFY `id_sektor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `waktu_kegiatan`
--
ALTER TABLE `waktu_kegiatan`
  MODIFY `id_waktu_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `anggota_ibfk_1` FOREIGN KEY (`id_hub_keluarga`) REFERENCES `hubungan_keluarga` (`id_hub_keluarga`),
  ADD CONSTRAINT `anggota_ibfk_2` FOREIGN KEY (`id_sektor`) REFERENCES `sektor` (`id_sektor`),
  ADD CONSTRAINT `anggota_ibfk_3` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`);

--
-- Constraints for table `detail_pindah`
--
ALTER TABLE `detail_pindah`
  ADD CONSTRAINT `detail_pindah_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`);

--
-- Constraints for table `head_pindah`
--
ALTER TABLE `head_pindah`
  ADD CONSTRAINT `head_pindah_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`),
  ADD CONSTRAINT `head_pindah_ibfk_2` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`),
  ADD CONSTRAINT `head_pindah_ibfk_3` FOREIGN KEY (`id_registrasi`) REFERENCES `registrasi` (`id_registrasi`);

--
-- Constraints for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD CONSTRAINT `jabatan_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`);

--
-- Constraints for table `jenis_kegiatan`
--
ALTER TABLE `jenis_kegiatan`
  ADD CONSTRAINT `jenis_kegiatan_ibfk_1` FOREIGN KEY (`id_sektor`) REFERENCES `sektor` (`id_sektor`);

--
-- Constraints for table `registrasi`
--
ALTER TABLE `registrasi`
  ADD CONSTRAINT `registrasi_ibfk_1` FOREIGN KEY (`id_sektor`) REFERENCES `sektor` (`id_sektor`);

--
-- Constraints for table `sektor`
--
ALTER TABLE `sektor`
  ADD CONSTRAINT `sektor_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`);

--
-- Constraints for table `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`id_jenis_status`) REFERENCES `jenis_status` (`id_jenis_status`);

--
-- Constraints for table `waktu_kegiatan`
--
ALTER TABLE `waktu_kegiatan`
  ADD CONSTRAINT `waktu_kegiatan_ibfk_1` FOREIGN KEY (`id_jenis_kegiatan`) REFERENCES `jenis_kegiatan` (`id_jenis_kegiatan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
