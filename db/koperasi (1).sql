-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2018 at 07:41 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `histori_kredit`
--

CREATE TABLE `histori_kredit` (
  `id` int(11) NOT NULL,
  `id_kredit` int(11) NOT NULL,
  `id_users` int(11) DEFAULT NULL,
  `pokok` decimal(18,4) NOT NULL,
  `bunga` decimal(18,4) NOT NULL,
  `denda` decimal(18,4) NOT NULL,
  `sisa_pokok` decimal(18,4) NOT NULL,
  `create_at` date NOT NULL,
  `id_kredit_denda_old` int(11) NOT NULL DEFAULT '0',
  `id_kredit_denda_new` int(11) NOT NULL DEFAULT '0',
  `id_kredit_denda_d` int(11) NOT NULL DEFAULT '0',
  `h_tunggakan_pokok` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `h_tunggakan_bunga` decimal(18,4) NOT NULL DEFAULT '0.0000'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `histori_kredit`
--

INSERT INTO `histori_kredit` (`id`, `id_kredit`, `id_users`, `pokok`, `bunga`, `denda`, `sisa_pokok`, `create_at`, `id_kredit_denda_old`, `id_kredit_denda_new`, `id_kredit_denda_d`, `h_tunggakan_pokok`, `h_tunggakan_bunga`) VALUES
(5, 1, 1, '200000.0000', '80000.0000', '151200.0000', '2000000.0000', '2018-08-12', 3, 10, 11, '100000.0000', '40000.0000'),
(6, 2, 1, '200000.0000', '80000.0000', '130200.0000', '2000000.0000', '2018-08-12', 4, 11, 9, '100000.0000', '40000.0000');

-- --------------------------------------------------------

--
-- Table structure for table `histori_tabungan`
--

CREATE TABLE `histori_tabungan` (
  `id` int(11) NOT NULL,
  `id_tabungan` int(11) NOT NULL,
  `id_users` int(11) DEFAULT NULL,
  `simpan` decimal(18,4) NOT NULL,
  `ambil` decimal(18,4) NOT NULL,
  `bunga` decimal(18,4) NOT NULL,
  `bunga_persen` int(11) NOT NULL,
  `histori_saldo` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `last_saldo` decimal(18,4) NOT NULL,
  `create_at` date NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `histori_tabungan`
--

INSERT INTO `histori_tabungan` (`id`, `id_tabungan`, `id_users`, `simpan`, `ambil`, `bunga`, `bunga_persen`, `histori_saldo`, `last_saldo`, `create_at`, `type`) VALUES
(1, 1, 1, '1000000.0000', '0.0000', '0.0000', 0, '1000000.0000', '0.0000', '2018-08-03', 0),
(2, 1, 1, '0.0000', '100000.0000', '0.0000', 0, '900000.0000', '0.0000', '2018-08-03', 0),
(3, 2, 1, '5000000.0000', '0.0000', '0.0000', 0, '5000000.0000', '0.0000', '2018-08-03', 0),
(4, 2, 1, '0.0000', '2500000.0000', '0.0000', 0, '2500000.0000', '0.0000', '2018-08-03', 0),
(32, 1, NULL, '0.0000', '0.0000', '18000.0000', 2, '918000.0000', '0.0000', '2018-08-28', 0),
(33, 2, NULL, '0.0000', '0.0000', '50000.0000', 2, '2550000.0000', '0.0000', '2018-08-28', 0),
(34, 1, NULL, '0.0000', '0.0000', '18360.0000', 2, '936360.0000', '0.0000', '2018-09-28', 0),
(35, 2, NULL, '0.0000', '0.0000', '51000.0000', 2, '2601000.0000', '0.0000', '2018-09-28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_umum`
--

CREATE TABLE `jurnal_umum` (
  `id_jurnal` int(11) NOT NULL,
  `debit` decimal(18,4) NOT NULL,
  `kredit` decimal(18,4) NOT NULL,
  `menu` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `create_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kredit`
--

CREATE TABLE `kredit` (
  `id_kredit` int(11) NOT NULL,
  `id_nasabah` int(11) NOT NULL,
  `id_users` int(11) DEFAULT NULL,
  `no_rek` varchar(200) NOT NULL,
  `penanggung_jawab1` varchar(200) NOT NULL,
  `penanggung_jawab2` varchar(200) NOT NULL,
  `jaminan` text NOT NULL,
  `tanggal_akad` date NOT NULL,
  `jangka_waktu` varchar(200) NOT NULL,
  `jatuh_tempo` date NOT NULL,
  `bunga_persen` decimal(18,4) NOT NULL,
  `plafond` decimal(18,4) NOT NULL,
  `pokok` decimal(18,4) NOT NULL,
  `bunga` decimal(18,4) NOT NULL,
  `total_angsuran` decimal(18,4) NOT NULL,
  `tunggakan_pokok` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `tunggakan_bunga` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `administrasi` decimal(18,4) NOT NULL,
  `materai` decimal(18,4) NOT NULL,
  `simpanan_anggota` decimal(18,4) NOT NULL,
  `notaris` decimal(18,4) NOT NULL,
  `tabungan` decimal(18,4) NOT NULL,
  `type` int(11) NOT NULL,
  `create_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kredit`
--

INSERT INTO `kredit` (`id_kredit`, `id_nasabah`, `id_users`, `no_rek`, `penanggung_jawab1`, `penanggung_jawab2`, `jaminan`, `tanggal_akad`, `jangka_waktu`, `jatuh_tempo`, `bunga_persen`, `plafond`, `pokok`, `bunga`, `total_angsuran`, `tunggakan_pokok`, `tunggakan_bunga`, `administrasi`, `materai`, `simpanan_anggota`, `notaris`, `tabungan`, `type`, `create_at`) VALUES
(1, 2, 1, '9090-0000001', 'OKY DWI HARTANTO', 'HARTANTO DWI OKY', 'JAMINAN TEST 1', '2018-08-05', '20 BULAN', '2020-04-05', '2.0000', '2000000.0000', '100000.0000', '40000.0000', '2800000.0000', '0.0000', '0.0000', '53000.0000', '6000.0000', '85000.0000', '10000.0000', '20000.0000', 1, '2018-08-05'),
(2, 2, 1, '9090-0000002', 'DWI OKY HARTANTO', 'HARTANTO OKY DWI', 'JAMINAN TEST 2', '2018-08-16', '30 BULAN', '2020-04-16', '2.0000', '2000000.0000', '100000.0000', '40000.0000', '2800000.0000', '0.0000', '0.0000', '20000.0000', '6000.0000', '53000.0000', '48000.0000', '20000.0000', 1, '2018-08-10');

-- --------------------------------------------------------

--
-- Table structure for table `kredit_denda`
--

CREATE TABLE `kredit_denda` (
  `id` int(11) NOT NULL,
  `id_kredit` int(11) NOT NULL,
  `pokok` decimal(18,4) NOT NULL,
  `bunga` decimal(18,4) NOT NULL,
  `denda` decimal(18,4) NOT NULL,
  `denda_day` int(11) DEFAULT '0',
  `create_at` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kredit_denda`
--

INSERT INTO `kredit_denda` (`id`, `id_kredit`, `pokok`, `bunga`, `denda`, `denda_day`, `create_at`, `status`) VALUES
(3, 1, '0.0000', '0.0000', '8400.0000', 2, '2018-09-05', 0),
(4, 2, '0.0000', '0.0000', '0.0000', 31, '2018-09-10', 0),
(10, 1, '100000.0000', '40000.0000', '8400.0000', 2, '2018-09-05', 0),
(11, 2, '100000.0000', '40000.0000', '0.0000', 0, '2018-09-16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kredit_denda_d`
--

CREATE TABLE `kredit_denda_d` (
  `id` int(11) NOT NULL,
  `id_kredit` int(11) NOT NULL,
  `create_at` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kredit_denda_d`
--

INSERT INTO `kredit_denda_d` (`id`, `id_kredit`, `create_at`, `status`) VALUES
(9, 2, '2018-10-11', 1),
(11, 1, '2018-10-11', 1),
(12, 1, '2018-09-07', 0),
(13, 1, '2018-09-07', 0),
(14, 1, '2018-09-07', 0),
(15, 1, '2018-09-07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `nasabah`
--

CREATE TABLE `nasabah` (
  `id_nasabah` int(11) NOT NULL,
  `id_users` int(11) DEFAULT NULL,
  `no_unik` varchar(200) NOT NULL,
  `no_ktp` varchar(200) DEFAULT NULL,
  `nama_nasabah` varchar(200) NOT NULL,
  `alamat_nasabah` text NOT NULL,
  `pekerjaan_nasabah` varchar(200) NOT NULL,
  `jenis_kelamin` varchar(100) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `create_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nasabah`
--

INSERT INTO `nasabah` (`id_nasabah`, `id_users`, `no_unik`, `no_ktp`, `nama_nasabah`, `alamat_nasabah`, `pekerjaan_nasabah`, `jenis_kelamin`, `tanggal_lahir`, `create_at`) VALUES
(2, 1, '111', '2525', 'Stef', '-', 'Programer', 'laki-laki', '2018-08-10', '2018-07-26'),
(3, 1, '0658988', '558', 'Dwi', '-', 'Dokter', 'perempuan', '1994-02-24', '2018-08-03');

-- --------------------------------------------------------

--
-- Table structure for table `tabungan`
--

CREATE TABLE `tabungan` (
  `id_tabungan` int(11) NOT NULL,
  `no_rek` varchar(200) NOT NULL,
  `id_nasabah` int(11) NOT NULL,
  `id_users` int(11) DEFAULT NULL,
  `no_telp` varchar(200) NOT NULL,
  `hak_waris` text NOT NULL,
  `saldo` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `bunga` decimal(18,4) NOT NULL,
  `jangka_waktu` varchar(100) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `create_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabungan`
--

INSERT INTO `tabungan` (`id_tabungan`, `no_rek`, `id_nasabah`, `id_users`, `no_telp`, `hak_waris`, `saldo`, `bunga`, `jangka_waktu`, `type`, `create_at`) VALUES
(1, '8080-0000001', 2, 1, '08577', '-', '936360.0000', '2.0000', NULL, 1, '2018-08-03'),
(2, '8080-0000002', 3, 1, '08556', '-', '2601000.0000', '2.0000', NULL, 1, '2018-08-03');

-- --------------------------------------------------------

--
-- Table structure for table `tabungan_bunga`
--

CREATE TABLE `tabungan_bunga` (
  `id` int(11) NOT NULL,
  `id_tabungan` int(11) NOT NULL,
  `create_at` date NOT NULL,
  `bunga` decimal(18,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabungan_bunga`
--

INSERT INTO `tabungan_bunga` (`id`, `id_tabungan`, `create_at`, `bunga`) VALUES
(27, 1, '2018-08-28', '18000.0000'),
(28, 2, '2018-08-28', '50000.0000'),
(29, 1, '2018-09-28', '18360.0000'),
(30, 2, '2018-09-28', '51000.0000');

-- --------------------------------------------------------

--
-- Table structure for table `tabungan_status`
--

CREATE TABLE `tabungan_status` (
  `id` int(11) NOT NULL,
  `create_at` date NOT NULL,
  `status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabungan_status`
--

INSERT INTO `tabungan_status` (`id`, `create_at`, `status`) VALUES
(1, '2018-08-28', 1),
(4, '2018-09-28', 1),
(5, '2018-10-28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` varchar(100) NOT NULL,
  `foto` text,
  `flag` int(11) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `nama`, `username`, `password`, `alamat`, `jenis_kelamin`, `foto`, `flag`, `level`) VALUES
(1, 'oky123', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'Semarang', 'laki-laki', 'http://koperasi.org/images/avatar.png', 1, 0),
(6, 'dwi', 'dwi', '202cb962ac59075b964b07152d234b70', '-', 'laki-laki', 'http://koperasi.org/storage/file/users/foto/placeholder_1532606428.png', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_role`
--

CREATE TABLE `users_role` (
  `id_users_role` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_role`
--

INSERT INTO `users_role` (`id_users_role`, `id_users`, `role`) VALUES
(43, 6, 1),
(44, 6, 52),
(45, 6, 41);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `histori_kredit`
--
ALTER TABLE `histori_kredit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kredit` (`id_kredit`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `histori_tabungan`
--
ALTER TABLE `histori_tabungan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nasabah` (`id_tabungan`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  ADD PRIMARY KEY (`id_jurnal`);

--
-- Indexes for table `kredit`
--
ALTER TABLE `kredit`
  ADD PRIMARY KEY (`id_kredit`),
  ADD KEY `id_nasabah` (`id_nasabah`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `kredit_denda`
--
ALTER TABLE `kredit_denda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kredit_denda_ibfk_1` (`id_kredit`);

--
-- Indexes for table `kredit_denda_d`
--
ALTER TABLE `kredit_denda_d`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kredit_denda_d_ibfk_1` (`id_kredit`);

--
-- Indexes for table `nasabah`
--
ALTER TABLE `nasabah`
  ADD PRIMARY KEY (`id_nasabah`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `tabungan`
--
ALTER TABLE `tabungan`
  ADD PRIMARY KEY (`id_tabungan`),
  ADD KEY `id_nasabah` (`id_nasabah`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `tabungan_bunga`
--
ALTER TABLE `tabungan_bunga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabungan_status`
--
ALTER TABLE `tabungan_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- Indexes for table `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`id_users_role`),
  ADD KEY `users_role_ibfk_1` (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `histori_kredit`
--
ALTER TABLE `histori_kredit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `histori_tabungan`
--
ALTER TABLE `histori_tabungan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  MODIFY `id_jurnal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kredit`
--
ALTER TABLE `kredit`
  MODIFY `id_kredit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kredit_denda`
--
ALTER TABLE `kredit_denda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kredit_denda_d`
--
ALTER TABLE `kredit_denda_d`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `nasabah`
--
ALTER TABLE `nasabah`
  MODIFY `id_nasabah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tabungan`
--
ALTER TABLE `tabungan`
  MODIFY `id_tabungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tabungan_bunga`
--
ALTER TABLE `tabungan_bunga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tabungan_status`
--
ALTER TABLE `tabungan_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id_users_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `histori_kredit`
--
ALTER TABLE `histori_kredit`
  ADD CONSTRAINT `histori_kredit_ibfk_1` FOREIGN KEY (`id_kredit`) REFERENCES `kredit` (`id_kredit`) ON DELETE CASCADE,
  ADD CONSTRAINT `histori_kredit_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE SET NULL;

--
-- Constraints for table `histori_tabungan`
--
ALTER TABLE `histori_tabungan`
  ADD CONSTRAINT `histori_tabungan_ibfk_1` FOREIGN KEY (`id_tabungan`) REFERENCES `tabungan` (`id_tabungan`) ON DELETE CASCADE,
  ADD CONSTRAINT `histori_tabungan_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE SET NULL;

--
-- Constraints for table `kredit`
--
ALTER TABLE `kredit`
  ADD CONSTRAINT `kredit_ibfk_1` FOREIGN KEY (`id_nasabah`) REFERENCES `nasabah` (`id_nasabah`) ON DELETE CASCADE,
  ADD CONSTRAINT `kredit_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE SET NULL;

--
-- Constraints for table `kredit_denda`
--
ALTER TABLE `kredit_denda`
  ADD CONSTRAINT `kredit_denda_ibfk_1` FOREIGN KEY (`id_kredit`) REFERENCES `kredit` (`id_kredit`) ON DELETE CASCADE;

--
-- Constraints for table `kredit_denda_d`
--
ALTER TABLE `kredit_denda_d`
  ADD CONSTRAINT `kredit_denda_d_ibfk_1` FOREIGN KEY (`id_kredit`) REFERENCES `kredit` (`id_kredit`) ON DELETE CASCADE;

--
-- Constraints for table `nasabah`
--
ALTER TABLE `nasabah`
  ADD CONSTRAINT `nasabah_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE SET NULL;

--
-- Constraints for table `tabungan`
--
ALTER TABLE `tabungan`
  ADD CONSTRAINT `tabungan_ibfk_1` FOREIGN KEY (`id_nasabah`) REFERENCES `nasabah` (`id_nasabah`) ON DELETE CASCADE,
  ADD CONSTRAINT `tabungan_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE SET NULL;

--
-- Constraints for table `users_role`
--
ALTER TABLE `users_role`
  ADD CONSTRAINT `users_role_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
