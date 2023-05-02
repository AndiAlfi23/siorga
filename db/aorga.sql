-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2021 at 03:50 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aorga`
--
-- --------------------------------------------------------

--
-- Table structure for table `t_menu`
--

CREATE TABLE `t_menu` (
  `id_menu` int(11) NOT NULL,
  `menu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_menu`
--

INSERT INTO `t_menu` (`id_menu`, `menu`) VALUES
(1, 'Admin'),
(2, 'Jabatan'),
(3, 'Member'),
(5, 'Anggota'),
(6, 'Kegiatan'),
(7, 'Bendahara');

-- --------------------------------------------------------


--
-- Table structure for table `t_role`
--

CREATE TABLE `t_role` (
  `level` int(11) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_role`
--

INSERT INTO `t_role` (`level`, `role`) VALUES
(1, 'Admin'),
(2, 'User1'),
(3, 'User2'),
(4, 'User3');

-- --------------------------------------------------------

--
-- Table structure for table `t_menu_access`
--

CREATE TABLE `t_menu_access` (
  `id_am` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_menu_access`
--

INSERT INTO `t_menu_access` (`id_am`, `id_menu`, `level`) VALUES
(1, 1, 1),
(4, 3, 1),
(5, 3, 2),
(6, 3, 3),
(7, 3, 4),
(9, 5, 2),
(11, 6, 2),
(13, 7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `t_sub_menu`
--

CREATE TABLE `t_sub_menu` (
  `id_sm` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_sub_menu`
--

INSERT INTO `t_sub_menu` (`id_sm`, `id_menu`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'Admin', 'mdi mdi-view-dashboard', 1),
(2, 1, 'Role Management', 'Admin/role', 'mdi mdi-account-key', 1),
(3, 1, 'Menu Management', 'Admin/menu', 'mdi mdi-folder', 1),
(4, 1, 'Sub Menu Management', 'Admin/submenu', 'mdi mdi-folder-multiple', 1),
(5, 2, 'Jabatan', 'Jabatan', 'mdi mdi-star', 1),
(13, 3, 'Dashboard', 'Member', 'mdi mdi-home', 1),
(14, 3, 'Anggota', 'Member/anggota', 'mdi mdi-account-multiple', 1),
(15, 5, 'Tambah Anggota', 'Anggota', 'mdi mdi-account-plus', 1),
(16, 3, 'Kegiatan', 'Member/kegiatan', 'mdi mdi-calendar-multiple-check', 1),
(17, 6, 'Tambah Kegiatan', 'Kegiatan', 'mdi mdi-calendar-plus', 1),
(18, 7, 'Peraturan Keuangan', 'Bendahara', 'mdi mdi-auto-fix', 1),
(19, 7, 'Daftar Tagihan', 'Bendahara/tagihan', 'mdi mdi-cash-multiple', 1),
(20, 3, 'Histori Tagihan', 'Member/history_tg', 'mdi mdi-cash-usd', 1),
(21, 3, 'Histori Pembayaran', 'Member/history_pb', 'mdi mdi-cash-usd', 1),
(24, 3, 'Histori Pengeluaran', 'Member/history_pk', 'mdi mdi-cash-usd', 1),
(25, 3, 'Histori Login', 'Member/history', 'mdi mdi-update', 1),
(29, 3, 'Tentang', 'Member/about', 'mdi mdi-information-outline', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_token`
--

CREATE TABLE `t_token` (
  `id_token` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date_created` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(225) NOT NULL
) 

ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_jabatan`
--

CREATE TABLE `t_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `level` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_jabatan`
--

INSERT INTO `t_jabatan` (`id_jabatan`, `nama_jabatan`, `level`) VALUES
(1, 'Ketua Himpunan', 2),
(2, 'Wakil Ketua', 2),
(3, 'Sekertaris 1', 4),
(4, 'Sekertaris 2', 4),
(5, 'Bendahara 1', 3),
(6, 'Bendahara 2', 3),
(7, 'Koordinator RisTek', 4),
(8, 'Koordinator PSDM', 1),
(9, 'Koordinator SKM', 4),
(10, 'Koordinator Kwu', 4),
(11, 'Koordinator Kominfo', 4),
(12, 'Divisi RisTek', 4),
(13, 'Divisi PSDM', 4),
(14, 'Divisi SKM', 4),
(15, 'Divisi Kwu', 4),
(16, 'Divisi Kominfo', 4);

-- --------------------------------------------------------

--
-- Table structure for table `t_anggota`
--

CREATE TABLE `t_anggota` (
  `id_mhs` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(1) NOT NULL,
  `npm` varchar(50) DEFAULT NULL,
  `nama` varchar(128) NOT NULL,
  `alamat` varchar(225) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `picture` varchar(128) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_history`
--

CREATE TABLE `t_history` (
  `id_history` int(11) NOT NULL,
  `dt` datetime NOT NULL,
  `ip_address` varchar(128) NOT NULL,
  `browser` varchar(128) NOT NULL,
  `platform` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_kegiatan`
--

CREATE TABLE `t_kegiatan` (
  `no_kegiatan` int(11) NOT NULL,
  `tgl_kegiatan` date NOT NULL,
  `nama_kegiatan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_absen`
--

CREATE TABLE `t_absen` (
  `no_absen` int(11) NOT NULL,
  `no_kegiatan` int(11) NOT NULL,
  `id_mhs` int(11) NOT NULL,
  `status` enum('Hadir','Sakit','Izin','Alfa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_cash_rule`
--

CREATE TABLE `t_cash_rule` (
  `id_cr` int(11) NOT NULL,
  `cash_rule` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_cash_rule`
--

INSERT INTO `t_cash_rule` (`id_cr`, `cash_rule`, `created_at`, `updated_at`) VALUES
(1, 'Uang Kas Rp 10.000 per bulan', '2020-11-25 14:57:51', '2020-11-26 20:58:05'),
(2, 'Telat bayar akan di denda Rp 5.000', '2020-11-25 14:59:45', '2020-11-26 20:58:00'),
(3, 'Tidak bayar Kas akan ditagih sampai akhir jabatan', '2020-11-25 15:00:23', '2020-11-26 20:57:55'),
(4, 'Tidak mengikuti rapat formal tanpa keterangan, akan di denda Rp 20.000', '2020-11-25 15:01:22', '2020-11-26 20:57:48');

-- --------------------------------------------------------

--
-- Table structure for table `t_tagihan`
--

CREATE TABLE `t_tagihan` (
  `no_tg` int(11) NOT NULL,
  `nama_tagihan` varchar(256) NOT NULL,
  `jml_tagihan` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `expired_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_tagihan_anggota`
--

CREATE TABLE `t_tagihan_anggota` (
  `no_ta` int(11) NOT NULL,
  `id_mhs` int(11) NOT NULL,
  `no_tg` int(11) NOT NULL,
  `dibayar` int(11) NOT NULL,
  `pesan` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_pembayaran`
--

CREATE TABLE `t_pembayaran` (
  `no_pb` int(11) NOT NULL,
  `no_tg` int(11) NOT NULL,
  `id_mhs` int(11) NOT NULL,
  `nominal_bayar` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_pengeluaran`
--

CREATE TABLE `t_pengeluaran` (
  `no_pk` int(11) NOT NULL,
  `tgl_pk` date NOT NULL,
  `nama_pengeluaran` varchar(128) NOT NULL,
  `jml_pk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Indexes for table `t_absen`
--
ALTER TABLE `t_absen`
  ADD PRIMARY KEY (`no_absen`);

--
-- Indexes for table `t_anggota`
--
ALTER TABLE `t_anggota`
  ADD PRIMARY KEY (`id_mhs`);

--
-- Indexes for table `t_cash_rule`
--
ALTER TABLE `t_cash_rule`
  ADD PRIMARY KEY (`id_cr`);

--
-- Indexes for table `t_history`
--
ALTER TABLE `t_history`
  ADD PRIMARY KEY (`id_history`);

--
-- Indexes for table `t_jabatan`
--
ALTER TABLE `t_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `t_kegiatan`
--
ALTER TABLE `t_kegiatan`
  ADD PRIMARY KEY (`no_kegiatan`);

--
-- Indexes for table `t_menu`
--
ALTER TABLE `t_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `t_menu_access`
--
ALTER TABLE `t_menu_access`
  ADD PRIMARY KEY (`id_am`);

--
-- Indexes for table `t_pembayaran`
--
ALTER TABLE `t_pembayaran`
  ADD PRIMARY KEY (`no_pb`);

--
-- Indexes for table `t_pengeluaran`
--
ALTER TABLE `t_pengeluaran`
  ADD PRIMARY KEY (`no_pk`);

--
-- Indexes for table `t_role`
--
ALTER TABLE `t_role`
  ADD PRIMARY KEY (`level`);

--
-- Indexes for table `t_sub_menu`
--
ALTER TABLE `t_sub_menu`
  ADD PRIMARY KEY (`id_sm`);

--
-- Indexes for table `t_tagihan`
--
ALTER TABLE `t_tagihan`
  ADD PRIMARY KEY (`no_tg`);

--
-- Indexes for table `t_tagihan_anggota`
--
ALTER TABLE `t_tagihan_anggota`
  ADD PRIMARY KEY (`no_ta`);

--
-- Indexes for table `t_token`
--
ALTER TABLE `t_token`
  ADD PRIMARY KEY (`id_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_absen`
--
ALTER TABLE `t_absen`
  MODIFY `no_absen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_anggota`
--
ALTER TABLE `t_anggota`
  MODIFY `id_mhs` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_cash_rule`
--
ALTER TABLE `t_cash_rule`
  MODIFY `id_cr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_history`
--
ALTER TABLE `t_history`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_jabatan`
--
ALTER TABLE `t_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `t_kegiatan`
--
ALTER TABLE `t_kegiatan`
  MODIFY `no_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `t_menu`
--
ALTER TABLE `t_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_menu_access`
--
ALTER TABLE `t_menu_access`
  MODIFY `id_am` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `t_pembayaran`
--
ALTER TABLE `t_pembayaran`
  MODIFY `no_pb` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_pengeluaran`
--
ALTER TABLE `t_pengeluaran`
  MODIFY `no_pk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_role`
--
ALTER TABLE `t_role`
  MODIFY `level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_sub_menu`
--
ALTER TABLE `t_sub_menu`
  MODIFY `id_sm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `t_tagihan`
--
ALTER TABLE `t_tagihan`
  MODIFY `no_tg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `t_tagihan_anggota`
--
ALTER TABLE `t_tagihan_anggota`
  MODIFY `no_ta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_token`
--
ALTER TABLE `t_token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT;
  
-------------------------------------------------------------------------

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
